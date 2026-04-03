/**
 * Advanced Slider Editor Js
 */
(function () {
    "use strict";

    const ReactLib = window.React;
    let isRegistered = false;

    /**
     * Register Advanced Slider Nested Element
     */
    function registerAdvancedSlider() {

        // Prevent multiple registrations
        if (isRegistered) return true;

        // Get Nested Elements module
        const nestedModule =
            ($e?.components?.get?.("nested-elements/nested-repeater") ||
                $e?.components?.get?.("nested-elements"))?.exports || null;

        if (!nestedModule) return false;

        const BaseView = nestedModule.NestedViewBase || nestedModule.NestedView;
        const BaseModel = nestedModule.NestedRepeaterModel || nestedModule.NestedModelBase;

        /**
         * Custom View Class
         */
        class AdvancedSliderView extends BaseView {

            initialize() {
                super.initialize();

                this.listenTo(this.collection, 'add remove', () => {
                    this.safeRefresh();
                });
            }

            // CRITICAL: Tell Elementor where to render child elements
            getChildViewContainer(compositeView, itemView) {
                // Find the correct slide wrapper for this child
                if (itemView) {
                    const slideId = itemView.model?.get('id');
                    if (slideId) {
                        const el = this.$el.find('.elementor-repeater-item-' + slideId + ' > .pea-advanced-slider-item').get(0)
                            || this.$el.find('.elementor-repeater-item-' + slideId).get(0);
                        if (el) return Backbone.$(el);
                    }
                }
                return this.$el.find('.pea-swiper-wrapper');
            }

            filter(model, index) {
                if (typeof model?.set === 'function') {
                    model.set('dataIndex', index + 1);
                } else if (model?.attributes) {
                    model.attributes.dataIndex = index + 1;
                }
                return true;
            }

            safeRefresh() {
                setTimeout(() => {
                    this.render();
                }, 500);
            }
        }

        /**
         * Empty State View (shown when no slides exist)
         */
        function EmptyView() {
            return ReactLib.createElement(
                "div",
                { className: "elementor-first-add" },
                ReactLib.createElement("div", {
                    className: "elementor-icon eicon-plus",
                    onClick: () => $e.route("panel/elements/categories"),
                })
            );
        }

        /**
         * Register Elementor Element Type
         */
        class AdvancedSliderElement extends elementor.modules.elements.types.Base {

            getType() {
                return "pea_advanced_slider";
            }

            getView() {
                return AdvancedSliderView;
            }

            getEmptyView() {
                return EmptyView;
            }

            getModel() {
                return BaseModel;
            }

            // getInitialConfig() {
            //     return {
            //         ...super.getInitialConfig(),
            //         defaults: {
            //             repeater_title_setting: "slide_title",
            //         },
            //     };
            // }
        }

        elementor.elementsManager.registerElementType(
            new AdvancedSliderElement()
        );

        isRegistered = true;
        return true;
    }

    /**
     * Wait for Elementor to Initialize
     */
    jQuery(function () {

        // Try immediately
        registerAdvancedSlider();

        // On Elementor component init
        elementorCommon.elements.$window.on(
            "elementor/init-components",
            async function () {
                try {
                    await elementor.modules.nestedElements;
                } catch (e) { }
                registerAdvancedSlider();
            }
        );

        // When nested element type loads
        const win = elementorCommon?.elements?.$window;
        if (win) {
            win
                .off("elementor/nested-element-type-loaded.pea")
                .one("elementor/nested-element-type-loaded.pea", registerAdvancedSlider);
        }

        // Fallback interval (kept from your original logic)
        const interval = setInterval(function () {
            if (registerAdvancedSlider()) {
                clearInterval(interval);
            }
        }, 50);
    });

})();