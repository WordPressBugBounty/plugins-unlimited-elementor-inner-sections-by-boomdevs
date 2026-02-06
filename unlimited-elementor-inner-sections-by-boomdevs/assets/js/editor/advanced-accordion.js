!(function () {
    "use strict";
    var React = window.React;
    
    jQuery(function ($) {
        let isElementTypeRegistered = false;
        
        /**
         * Initializes and registers the custom Advanced Accordion element type
         * @returns {boolean} True if registration succeeded, false otherwise
         */
        const registerAdvancedAccordionElement = () => {
            // Prevent duplicate registration
            if (isElementTypeRegistered) {
                return true;
            }
            
            // Get nested elements component from Elementor
            const nestedElementsComponent = 
                ($e?.components?.get?.("nested-elements/nested-repeater") || 
                 $e?.components?.get?.("nested-elements"))?.exports || null;
            
            if (!nestedElementsComponent) {
                return false;
            }
            
            // Extract base classes for view and model
            const NestedViewBase = nestedElementsComponent.NestedViewBase || nestedElementsComponent.NestedView;
            const NestedModelBase = nestedElementsComponent.NestedRepeaterModel || nestedElementsComponent.NestedModelBase;
            
            /**
             * Custom view class for Advanced Accordion
             * Extends Elementor's nested view functionality
             */
            class AdvancedAccordionView extends NestedViewBase {
                /**
                 * Filters and updates child elements with data index
                 * @param {Object} element - The element to filter
                 * @param {number} index - The index position
                 * @returns {boolean} Always returns true
                 */
                filter(element, index) {
                    // Set data index on element (supports both methods)
                    if (typeof element?.set === "function") {
                        element.set("dataIndex", index + 1);
                    } else if (element?.attributes) {
                        element.attributes.dataIndex = index + 1;
                    }
                    return true;
                }
                
                /**
                 * Called when a child view is added
                 * @param {Object} childView - The newly added child view
                 */
                onAddChild(childView) {
                    this.moveContainerToContent();
                }
                
                /**
                 * Called when the view is rendered
                 */
                onRender() {
                    super.onRender();
                    this.moveContainerToContent();
                }
                
                /**
                 * Moves accordion containers to their correct position within content wrappers
                 * This ensures proper DOM structure for accordion functionality
                 */
                moveContainerToContent() {
                    setTimeout(() => {
                        this.$el.find('.pea-advanced-accordion-item').each(function() {
                            const $accordionItem = $(this);
                            const $contentWrapper = $accordionItem.find('.pea-accordion-content');
                            
                            // Find container element (excluding title and content wrappers)
                            const $container = $accordionItem
                                .find('> .e-con, > .elementor-element')
                                .not('.pea-accordion-item-title-wrapper, .pea-accordion-content-wrapper')
                                .first();
                            
                            // Move container into content wrapper if needed
                            if ($container.length && $contentWrapper.length) {
                                if (!$container.parent().hasClass('pea-accordion-content')) {
                                    $contentWrapper.append($container);
                                }
                            }
                        });
                    }, 50);
                }
            }
            
            /**
             * Creates the empty view component shown when no items exist
             * @returns {React.Element} React element with add button
             */
            function createEmptyView() {
                return React.createElement(
                    "div",
                    { className: "elementor-first-add" },
                    React.createElement("div", {
                        className: "elementor-icon eicon-plus",
                        onClick: () => $e.route("panel/elements/categories"),
                    })
                );
            }
            
            /**
             * Custom element type class for Advanced Accordion
             * Defines the element's behavior and configuration
             */
            class AdvancedAccordionElementType extends elementor.modules.elements.types.Base {
                getType() {
                    return "pea_advanced_accordion";
                }
                
                getView() {
                    return AdvancedAccordionView;
                }
                
                getEmptyView() {
                    return createEmptyView;
                }
                
                getModel() {
                    return NestedModelBase;
                }
                
                getInitialConfig() {
                    return {
                        ...super.getInitialConfig(),
                        defaults: {
                            repeater_title_setting: "accordion_title"
                        }
                    };
                }
            }
            
            // Register the custom element type with Elementor
            elementor.elementsManager.registerElementType(new AdvancedAccordionElementType());
            isElementTypeRegistered = true;
            
            return true;
        };
        
        // Register when Elementor initializes components
        elementorCommon.elements.$window.on("elementor/init-components", async () => {
            try {
                await elementor.modules.nestedElements;
            } catch (error) {
                // Silently handle errors if nested elements module fails to load
            }
            registerAdvancedAccordionElement();
        });
        
        // Try immediate registration
        registerAdvancedAccordionElement();
        
        // Set up event listener for nested element type loaded
        const $window = elementorCommon?.elements?.$window;
        if ($window) {
            $window
                .off("elementor/nested-element-type-loaded.pea")
                .one("elementor/nested-element-type-loaded.pea", registerAdvancedAccordionElement);
        }
        
        // Fallback: Keep trying until registration succeeds
        const registrationInterval = setInterval(() => {
            if (registerAdvancedAccordionElement()) {
                clearInterval(registrationInterval);
            }
        }, 50);
    });
})();
