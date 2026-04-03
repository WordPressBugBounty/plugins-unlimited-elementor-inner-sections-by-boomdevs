/**
 * Advanced Slider Frontend Js
 */
(function ($) {
    'use strict';

    const AdvancedSliderHandler = elementorModules.frontend.handlers.Base.extend({

        swiperInstances: [],

        getDefaultSettings() {
            return {
                selectors: {
                    sliderContainer: '.pea-advanced-slider-wrapper',
                    swiper: '.pea-swiper'
                }
            };
        },

        getDefaultElements() {
            const selectors = this.getSettings('selectors');

            return {
                $sliderContainers: this.$element.find(selectors.sliderContainer)
            };
        },

        bindEvents() {
            // No click events needed
        },

        onInit() {
            elementorModules.frontend.handlers.Base.prototype.onInit.apply(this, arguments);
            this.initSliders();
        },

        onElementChange(propertyName) {
            if (propertyName) {
                this.reInitSliders();
            }
        },

        initSliders() {
            const selectors = this.getSettings('selectors');
            const self = this;

            this.elements.$sliderContainers.each(function () {

                const $container = $(this);
                const swiperSettings = $container.data('swiper-settings');

                if (!swiperSettings) return;

                let sliderOptions = swiperSettings;

                if (typeof swiperSettings === 'string') {
                    try {
                        sliderOptions = JSON.parse(swiperSettings);
                    } catch (e) {
                        console.warn('Invalid Swiper JSON:', e);
                        return;
                    }
                }

                const swiperElement = $container.find(selectors.swiper)[0];
                if (!swiperElement) return;

                if (swiperElement.swiper) {
                    swiperElement.swiper.destroy(true, true);
                }

                if (sliderOptions.effect === 'creative') {
                    sliderOptions.watchSlidesProgress = true;
                    sliderOptions.creativeEffect = {
                        prev: {
                            shadow: true,
                            translate: [0, 0, -400]
                        },
                        next: {
                            translate: ['100%', 0, 0]
                        },
                    };
                }

                const instance = new Swiper(swiperElement, sliderOptions);
                self.swiperInstances.push(instance);
            });
        },

        reInitSliders() {
            this.destroySliders();
            this.cleanupPaginationClasses();
            this.initSliders();
        },

        /**
         * Remove all Swiper-added pagination type classes before re-init.
         * This prevents stale classes (e.g. swiper-pagination-bullets) from
         * persisting in the editor when the pagination type is changed.
         */
        cleanupPaginationClasses() {
            const paginationTypeClasses = [
                'swiper-pagination-bullets',
                'swiper-pagination-progressbar',
                'swiper-pagination-fraction',
                'swiper-pagination-hidden',
                'swiper-pagination-lock',
            ];

            this.$element.find('.swiper-pagination').each(function () {
                const $pagination = $(this);
                $pagination.removeClass(paginationTypeClasses.join(' '));

                // Also remove any inline styles Swiper may have injected
                $pagination.removeAttr('style');

                // Clean up bullet children left by previous init
                $pagination.empty();
            });

            // Also clean up stale Swiper-generated classes on the swiper wrapper
            this.$element.find('.swiper-wrapper').removeClass('swiper-wrapper-initialized');
        },

        destroySliders() {
            if (this.swiperInstances.length) {
                this.swiperInstances.forEach(instance => {
                    try {
                        instance.destroy(true, true);
                    } catch (e) { }
                });
                this.swiperInstances = [];
            }
        },

        onDestroy() {
            this.destroySliders();
            elementorModules.frontend.handlers.Base.prototype.onDestroy.apply(this, arguments);
        }

    });

    $(window).on('elementor/frontend/init', function () {

        const addHandler = function ($element) {
            elementorFrontend.elementsHandler.addHandler(AdvancedSliderHandler, {
                $element
            });
        };

        elementorFrontend.hooks.addAction(
            'frontend/element_ready/pea_advanced_slider.default',
            addHandler
        );

    });

})(jQuery);