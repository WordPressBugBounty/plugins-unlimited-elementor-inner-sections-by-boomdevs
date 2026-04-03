(function ($) {
    'use strict';

    const MarqueeCarouselHandler = elementorModules.frontend.handlers.Base.extend({

        swiperInstances: [],

        getDefaultSettings() {
            return {
                selectors: {
                    wrapper: '.pea-marquee-carousel-wrapper',
                    swiper: '.pea-marquee-swiper',
                },
            };
        },

        getDefaultElements() {
            const s = this.getSettings('selectors');
            return {
                $wrappers: this.$element.find(s.wrapper),
            };
        },

        bindEvents() { },

        onInit() {
            elementorModules.frontend.handlers.Base.prototype.onInit.apply(this, arguments);
            this.initMarquees();
        },

        onElementChange() {
            this.reInitMarquees();
        },

        initMarquees() {
            const selectors = this.getSettings('selectors');
            const self = this;

            this.elements.$wrappers.each(function () {
                const $wrapper = $(this);
                const rawSettings = $wrapper.data('swiper-settings');
                const pauseOnHover = $wrapper.data('pause-on-hover') === 'yes';

                if (!rawSettings) return;

                let opts = rawSettings;
                if (typeof rawSettings === 'string') {
                    try { opts = JSON.parse(rawSettings); } catch (e) {
                        console.warn('[PEA Marquee] Invalid JSON settings:', e);
                        return;
                    }
                }

                const swiperEl = $wrapper.find(selectors.swiper)[0];
                if (!swiperEl) return;

                // Destroy previous instance
                if (swiperEl.swiper) {
                    swiperEl.swiper.destroy(true, true);
                }

                opts.loop = true;
                opts.freeMode = { enabled: true, momentum: false };
                opts.watchSlidesProgress = true;

                if (opts.autoplay) {
                    opts.autoplay.delay = 0;
                } else {
                    opts.autoplay = { delay: 0, disableOnInteraction: false };
                }

                const instance = new Swiper(swiperEl, opts);
                self.swiperInstances.push(instance);

                // Pause on hover support
                if (pauseOnHover) {
                    swiperEl.addEventListener('mouseenter', function () {
                        instance.autoplay.stop();
                    });
                    swiperEl.addEventListener('mouseleave', function () {
                        instance.autoplay.start();
                    });
                }
            });
        },

        reInitMarquees() {
            this.destroyMarquees();
            this.initMarquees();
        },

        destroyMarquees() {
            this.swiperInstances.forEach(function (inst) {
                try { inst.destroy(true, true); } catch (e) { }
            });
            this.swiperInstances = [];
        },

        onDestroy() {
            this.destroyMarquees();
            elementorModules.frontend.handlers.Base.prototype.onDestroy.apply(this, arguments);
        },
    });

    $(window).on('elementor/frontend/init', function () {
        const addHandler = function ($element) {
            elementorFrontend.elementsHandler.addHandler(MarqueeCarouselHandler, { $element });
        };

        elementorFrontend.hooks.addAction(
            'frontend/element_ready/pea_marquee_carousel.default',
            addHandler
        );
    });

})(jQuery);