( function () {
    'use strict';

    /**
     * PEA Custom CSS - Editor Live Processor
     * Mirrors PHP process_css() logic exactly.
     */
    
    elementor.hooks.addFilter(
        'editor/style/styleText',
        function (styleText, context) {

            if ( ! context ) {
                return styleText;
            }


            /**
             * CSS Processor (JS version of PHP process_css)
             */
            function processCss( rawCss, uniqueSelector ) {

                let css = rawCss.trim();
                if ( ! css ) return '';

                // Replace explicit "selector" keyword first
                css = css.replace( /selector/g, uniqueSelector );

                // Scope remaining CSS rules
                css = css.replace(
                    /([^{]+)\{([\s\S]*?)\}/g,
                    ( match, selectors, declarations ) => {

                        selectors = selectors.trim();

                        // Skip @ rules (media, keyframes, font-face, etc.)
                        if ( selectors.startsWith('@') ) {
                            return match;
                        }

                        // Already scoped
                        if ( selectors.includes( uniqueSelector ) ) {
                            return selectors + '{' + declarations + '}';
                        }

                        const scopedSelectors = [];

                        selectors.split(',').forEach( sel => {
                            sel = sel.trim();
                            if ( ! sel ) return;

                            // If selector starts with . or # it might be ON the element itself
                            // Generate BOTH: combined (same element) + descendant (child)
                            if ( /^[.#]/.test( sel ) ) {
                                scopedSelectors.push( uniqueSelector + sel );       // same element
                                scopedSelectors.push( uniqueSelector + ' ' + sel ); // child
                            } else {
                                scopedSelectors.push( uniqueSelector + ' ' + sel ); // tag/pseudo — child only
                            }
                        });

                        return scopedSelectors.join(', ') + '{' + declarations + '}';
                    }
                );

                return css;
            }

            const model    = context.model;
            const settings = model.get( 'settings' );

            if ( ! settings ) {
                return styleText;
            }

            const customCss = settings.get( 'pea_custom_css' );

            if ( ! customCss ) {
                return styleText;
            }

            let uniqueSelector;

            // Document level CSS
            if ( 'document' === model.get( 'elType' ) ) {
                uniqueSelector = elementor.config.document.settings.cssWrapperSelector;
            } else {

                const documentId = elementor.config.document.id;
                // console.log(documentId);
                uniqueSelector = '.elementor-' + documentId + ' .elementor-element.elementor-element-' + model.get( 'id' );
            }

            const processedCss = processCss( customCss, uniqueSelector );

            return styleText + processedCss;
        },
        99
    );

} )();
