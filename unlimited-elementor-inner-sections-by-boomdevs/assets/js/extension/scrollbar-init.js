/**
 * scrollbar-init.js  —  Frontend (public) initialisation.
 *
 * Reads settings passed by PHP via wp_localize_script() as
 * window.PrimeScrollbarSettings, injects a <style> block, and boots
 * OverlayScrollbars on the chosen target element.
 *
 * ─── OverlayScrollbars global resolution ────────────────────────────────────
 * Both the ES5 and ES6 browser builds expose the library as:
 *
 *   var OverlayScrollbarsGlobal = (function(t){ … t.OverlayScrollbars = qn … })({});
 *
 * The constructor is therefore at:
 *   window.OverlayScrollbarsGlobal.OverlayScrollbars   ← correct
 *   window.OverlayScrollbars                           ← undefined  ✗
 *
 * The resolveOS() helper below handles both builds transparently.
 */
( function () {
    'use strict';

    /* ── Resolve OverlayScrollbars constructor ─────────────────────────────── */

    function resolveOS() {
        // ES5 & ES6 browser builds: constructor is a property of the namespace object.
        var g = window.OverlayScrollbarsGlobal;
        if ( g && typeof g.OverlayScrollbars === 'function' ) {
            return g.OverlayScrollbars;
        }
        // Fallback for any build that assigns the constructor directly.
        if ( typeof window.OverlayScrollbars === 'function' ) {
            return window.OverlayScrollbars;
        }
        return null;
    }

    /* ── Bail if PHP settings are missing ──────────────────────────────────── */

    var S = window.PrimeScrollbarSettings;
    if ( ! S ) return;

    /* ── Inject dynamic CSS ────────────────────────────────────────────────── */

    ( function injectCSS() {
        var lines = [];

        lines.push(
            '.prime-scrollbar-theme { --os-size: ' + S.width + '; }',

            '.prime-scrollbar-theme .os-scrollbar-track {',
            '    background: ' + S.trackColor + ';',
            '    border-radius: ' + S.trackRadius + ';',
            '}',
            '.prime-scrollbar-theme .os-scrollbar-track:hover { background: ' + S.trackHover + '; }',

            '.prime-scrollbar-theme .os-scrollbar-handle {',
            '    background: ' + S.thumbColor + ';',
            '    border-radius: ' + S.thumbRadius + ';',
            '}',
            '.prime-scrollbar-theme .os-scrollbar-handle:hover { background: ' + S.thumbHover + '; }'
        );

        if ( S.position === 'left' ) {
            lines.push(
                '.pea-scrollbar-left .os-scrollbar-vertical { left: 0 !important; right: auto !important; }'
            );
        }

        if ( S.hide === 'yes' ) {
            lines.push(
                '.prime-scrollbar-theme { display: none !important }',
                'html, body { scrollbar-width: none !important; -ms-overflow-style: none !important; }',
                'html::-webkit-scrollbar, body::-webkit-scrollbar { display: none !important; }'
            );
        }

        if ( S.smooth === 'yes' ) {
            lines.push( 'html { scroll-behavior: smooth; }' );
        }

        var style = document.createElement( 'style' );
        style.id          = 'prime-scrollbar-frontend-css';
        style.textContent = lines.join( '\n' );
        document.head.appendChild( style );
    } )();

    /* ── Boot OverlayScrollbars ────────────────────────────────────────────── */

    if ( S.hide === 'yes' ) return;  // hidden = native scrollbars, no OS needed

    var OS = resolveOS();

    if ( ! OS ) {
        console.warn(
            '[PEA Scrollbar] OverlayScrollbars not found.',
            '\nExpected: window.OverlayScrollbarsGlobal.OverlayScrollbars',
            '\nGot:', window.OverlayScrollbarsGlobal
        );
        return;
    }

    // Choose the target element based on "Apply To" control.
    // var target = ( S.applyTo === 'body' )
    //     ? document.body
    //     : document.scrollingElement;  // 'global' (default)
    // console.log(S.applyTo);
    // Apply position class before init so OS picks it up immediately.
    if ( S.position === 'left' ) {
        document.documentElement.classList.add( 'pea-scrollbar-left' );
    }

    var osInstance = OS( document.body, {
        scrollbars: {
            theme        : 'os-theme-dark prime-scrollbar-theme',
            autoHide     : S.autoHide      || 'scroll',
            autoHideDelay: S.autoHideDelay || 800,
            clickScroll  : true,
            dragScroll   : true,
            pointers     : [ 'mouse', 'touch', 'pen' ],

        },
        overflow: { x: 'hidden', y: 'scroll' },
        paddingAbsolute: true,  
        update  : { elementEvents: [ [ 'img', 'load' ] ], debounce: [ 0, 33 ] },
    } );

    /* ── Custom wheel speed ────────────────────────────────────────────────── */

    var wheelSpeed = parseFloat( S.wheelSpeed ) || 1;
    if ( wheelSpeed !== 1 && osInstance ) {
        var viewport = osInstance.elements && osInstance.elements().viewport;
        if ( viewport ) {
            viewport.addEventListener( 'wheel', function ( e ) {
                e.preventDefault();
                viewport.scrollTop += e.deltaY * wheelSpeed;
            }, { passive: false } );
        }
    }

} )();