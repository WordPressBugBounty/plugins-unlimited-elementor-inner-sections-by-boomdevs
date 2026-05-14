/**
 * scrollbar-styler.js  —  Elementor editor live-preview controller.
 *
 * ─── Why window.OverlayScrollbars is always undefined ───────────────────────
 * Both the ES5 and ES6 browser builds expose the library like this:
 *
 *   var OverlayScrollbarsGlobal = (function(t){ … t.OverlayScrollbars = qn … })({});
 *
 * So the constructor lives at:
 *   window.OverlayScrollbarsGlobal.OverlayScrollbars   ✓ correct
 *   window.OverlayScrollbars                           ✗ always undefined
 *
 * Additionally, for the EDITOR live-preview the library must be resolved from
 * the PREVIEW IFRAME's window (not the editor panel's window), because that is
 * where the frontend script loads it.
 *
 * resolveOS( win ) handles both builds and both window contexts.
 *
 * ─── Why elementor.settings.kit ─────────────────────────────────────────────
 * elementor.settings.page  → settings of the currently-edited page/post.
 * elementor.settings.kit   → the active Kit (= Site Settings / Global Styles).
 * Our tab is registered in the Kit, so every addChangeCallback must go there.
 */
(function ($) {
    'use strict';

    /* -------------------------------------------------------------------------
     *  resolveOS( win )
     *  Returns the OverlayScrollbars constructor from any window object, or
     *  null if the library has not been loaded there yet.
     *
     *  Handles:
     *    window.OverlayScrollbarsGlobal.OverlayScrollbars  — ES5 & ES6 browser builds
     *    window.OverlayScrollbars                          — hypothetical direct assign
     * ---------------------------------------------------------------------- */
    function resolveOS( win ) {
        if ( ! win ) return null;

        var g = win.OverlayScrollbarsGlobal;
        if ( g && typeof g.OverlayScrollbars === 'function' ) {
            return g.OverlayScrollbars;
        }

        if ( typeof win.OverlayScrollbars === 'function' ) {
            return win.OverlayScrollbars;
        }

        return null;
    }


    /* -------------------------------------------------------------------------
     *  PrimeScrollbarLivePreview
     * ---------------------------------------------------------------------- */
    class PrimeScrollbarLivePreview {

        constructor() {
            this.config  = window.PrimeScrollbarConfig || { keys: {} };
            this.keys    = this.config.keys;
            this.styleId = 'prime-scrollbar-live-preview';
            this._sbInstance = null;

            this._init();
        }

        _init() {
            if ( ! window.elementor ) return;

            // elementor.on( 'document:loaded', () => {
            //     this._bindControls();
            //     this._render();
            // } );

            elementor.on( 'preview:loaded', () => {
                this._bindControls();
                this._render();
            } );
        }

        _bindControls() {
            // if ( ! elementor.settings?.kit ) return;

            Object.values( this.keys ).forEach( ( controlName ) => {
                elementor.settings.page.addChangeCallback(
                    controlName,
                    () => this._render()
                );
            } );
        }

        _getSettings() {
            return elementor.settings?.page?.model?.attributes || {};
        }

        _getPreviewDocument() {
            const $preview = elementor.$preview;
            if ( ! $preview?.length ) return null;
            const iframe = $preview[0];
            return iframe.contentDocument || iframe.contentWindow?.document || null;
        }

        /**
         * The preview iframe's window — this is where OverlayScrollbarsGlobal lives.
         */
        _getPreviewWindow() {
            const $preview = elementor.$preview;
            if ( ! $preview?.length ) return null;
            return $preview[0].contentWindow || null;
        }

        _getPreviewRoot() {
            const doc = this._getPreviewDocument();
            return doc ? doc.documentElement : null;
        }

        _render() {
            const settings = this._getSettings();
            this._injectCSS( this._buildCSS( settings ) );
            this._initScrollbar( settings );
        }

        _injectCSS( css ) {
            const doc = this._getPreviewDocument();
            if ( ! doc ) return;
            
            let el = doc.getElementById( this.styleId );
            if ( ! el ) {
                el = doc.createElement( 'style' );
                el.id = this.styleId;
                ( doc.head || doc.documentElement ).appendChild( el );
            }
            el.textContent = css;
        }

        _buildCSS( settings ) {
            const K = this.keys;

            const width       = this._sliderVal( settings, K.width,       '10px'    );
            const trackColor  = this._colorVal(  settings, K.trackColor,  '#f1f1f1' );
            const trackHover  = this._colorVal(  settings, K.trackHover,  '#e5e5e5' );
            const trackRadius = this._sliderVal( settings, K.trackRadius, '0px'     );
            const thumbColor  = this._colorVal(  settings, K.thumbColor,  '#aaaaaa' );
            const thumbHover  = this._colorVal(  settings, K.thumbHover,  '#666666' );
            const thumbRadius = this._sliderVal( settings, K.thumbRadius, '10px'    );

            const isHidden = settings[ K.hide ]     === 'yes';
            const isSmooth = settings[ K.smooth ]   === 'yes';
            const isLeft   = settings[ K.position ] === 'left';

            const lines = [];
            
            lines.push(
                `.prime-scrollbar-theme { --os-size: ${ width }; }`,

                `.prime-scrollbar-theme .os-scrollbar-track {`,
                `    background: ${ trackColor };`,
                `    border-radius: ${ trackRadius };`,
                `}`,
                `.prime-scrollbar-theme .os-scrollbar-track:hover { background: ${ trackHover }; }`,

                `.prime-scrollbar-theme .os-scrollbar-handle {`,
                `    background: ${ thumbColor };`,
                `    border-radius: ${ thumbRadius };`,
                `}`,
                `.prime-scrollbar-theme .os-scrollbar-handle:hover { background: ${ thumbHover }; }`
            );

            if ( isLeft ) {
                lines.push(
                    `.pea-scrollbar-left .os-scrollbar-vertical { left: 0 !important; right: auto !important; }`
                );
            }

            if ( isHidden ) {
                lines.push(
                    `.prime-scrollbar-theme { display: none !important }`,
                );
            }

            if ( isSmooth ) {
                lines.push( `html { scroll-behavior: smooth; }` );
            }

            return lines.join( '\n' );
        }

        _initScrollbar( settings ) {
            const K    = this.keys;
            const root = this._getPreviewRoot();

            if ( this._sbInstance ) {
                this._sbInstance.destroy();
                this._sbInstance = null;
            }

            // if ( settings[ K.hide ] === 'yes' ) return;

            // Resolve from the PREVIEW window — that's where the frontend JS loaded it.
            // Both builds use OverlayScrollbarsGlobal.OverlayScrollbars, not window.OverlayScrollbars.
            const OS = resolveOS( this._getPreviewWindow() );

            if ( ! root || ! OS ) {
                console.warn(
                    '[PEA Scrollbar] OverlayScrollbars not found in preview window.',
                    '\nExpected: previewWindow.OverlayScrollbarsGlobal.OverlayScrollbars',
                    '\nGot:', this._getPreviewWindow()?.OverlayScrollbarsGlobal
                );
                return;
            }
            // else{
                
            //     console.log(
            //         '[PEA Scrollbar] OverlayScrollbars found in preview window.',
            //         '\nroot:', root,
            //         '\nOS:', OS,
            //         '\nGot:', this._getPreviewWindow()?.OverlayScrollbarsGlobal
            //     );
            // }

            this._sbInstance = new PrimeScrollbar( root.querySelector( '.elementor-page' ), OS, {
                autoHide     : settings[ K.autoHide ]      || 'scroll',
                autoHideDelay: parseInt( settings[ K.autoHideDelay ] ?? 800, 10 ),
                wheelSpeed   : this._sliderNum( settings, K.wheelSpeed, 1 ),
                position     : settings[ K.position ]      || 'right',
            } );
        }

        _sliderVal( s, key, fallback = '' ) {
            const v = s[ key ];
            return ( v && v.size !== '' && v.size !== undefined && v.unit )
                ? `${ v.size }${ v.unit }` : fallback;
        }

        _sliderNum( s, key, fallback = 1 ) {
            const v = s[ key ];
            return ( v && v.size !== '' && v.size !== undefined )
                ? parseFloat( v.size ) : fallback;
        }

        _colorVal( s, key, fallback = '' ) {
            return s[ key ] || fallback;
        }
    }


    /* -------------------------------------------------------------------------
     *  PrimeScrollbar
     *  Thin wrapper that also handles position class + wheel-speed multiplier.
     *  OS is passed in as an argument — the caller decides which window it came from.
     * ---------------------------------------------------------------------- */
    class PrimeScrollbar {

        constructor( element, OS, options ) {
            this.element        = element;
            this.OS             = OS;
            this.options        = options;
            this._osInstance    = null;
            this._wheelListener = null;

            this._init();
        }

        _init() {
            if ( ! this.OS ) return;

            this._osInstance = this.OS( this.element, {
                scrollbars: {
                    theme        : 'os-theme-dark prime-scrollbar-theme',
                    autoHide     : this.options.autoHide      || 'scroll',
                    autoHideDelay: this.options.autoHideDelay ?? 800,
                    clickScroll  : true,
                    dragScroll   : true,
                    pointers     : [ 'mouse', 'touch', 'pen' ],
                    visibility   : 'auto'
                },
                overflow: { x: 'hidden', y: 'scroll' },
                update  : { elementEvents: [ [ 'img', 'load' ] ], debounce: [ 0, 33 ] },
            } );

            this._applyPosition();
            this._bindWheelSpeed();
        }

        _applyPosition() {
            this.element.classList.remove( 'pea-scrollbar-left' );
            if ( this.options.position === 'left' ) {
                this.element.classList.add( 'pea-scrollbar-left' );
            }
        }

        _bindWheelSpeed() {
            const speed = parseFloat( this.options.wheelSpeed );
            if ( ! speed || speed === 1 || ! this._osInstance ) return;

            const viewport = this._osInstance.elements()?.viewport;
            if ( ! viewport ) return;

            this._wheelListener = ( e ) => {
                e.preventDefault();
                viewport.scrollTop += e.deltaY * speed;
            };
            viewport.addEventListener( 'wheel', this._wheelListener, { passive: false } );
        }

        destroy() {
            if ( this._osInstance ) {
                if ( this._wheelListener ) {
                    const viewport = this._osInstance.elements()?.viewport;
                    viewport?.removeEventListener( 'wheel', this._wheelListener );
                    this._wheelListener = null;
                }
                this._osInstance.destroy();
                this._osInstance = null;
            }
            this.element.classList.remove( 'pea-scrollbar-left' );
        }
    }


    $( document ).ready( () => {
        new PrimeScrollbarLivePreview();
    } );

} )( jQuery );