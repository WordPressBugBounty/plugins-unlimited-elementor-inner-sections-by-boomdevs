(function ($) {
    'use strict';

    // SVG icons
    const SVG_PAUSE = `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
        <path fill-rule="evenodd" clip-rule="evenodd"
            d="M6.75 5.25C6.75 4.83579 7.08579 4.5 7.5 4.5H9C9.41421 4.5 9.75 4.83579 9.75 5.25V18.75C9.75 19.1642
            9.41421 19.5 9 19.5H7.5C7.30109 19.5 7.11032 19.421 6.96967 19.2803C6.82902 19.1397 6.75 18.9489 6.75
            18.75L6.75 5.25ZM14.25 5.25C14.25 4.83579 14.5858 4.5 15 4.5H16.5C16.6989 4.5 16.8897 4.57902 17.0303
            4.71967C17.171 4.86032 17.25 5.05109 17.25 5.25V18.75C17.25 19.1642 16.9142 19.5 16.5 19.5H15C14.5858
            19.5 14.25 19.1642 14.25 18.75V5.25Z" fill="#0F172A"/>
    </svg>`;

    const SVG_PLAY = `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
        <path d="M6.75 5.25L17.25 12L6.75 18.75V5.25Z" fill="#0F172A"/>
    </svg>`;

    // Core ticker initialiser
    function initTickerOnWrapper($wrapper) {
        const swiperEl     = $wrapper.find('.pea-ticker-swiper')[0];
        const rawSettings  = $wrapper.data('swiper-settings');
        const pauseOnHover = $wrapper.data('pause-on-hover') === 'yes';
        const tickerMode   = $wrapper.data('ticker-mode') || 'marquee';

        const isMarquee    = tickerMode === 'marquee';

        if (!swiperEl || !rawSettings) return null;

        // Parse settings
        let opts = rawSettings;
        if (typeof rawSettings === 'string') {
            try { opts = JSON.parse(rawSettings); } catch (e) {
                console.warn('[PEA Ticker] Invalid JSON settings:', e);
                return null;
            }
        }

        // Deep-clone so we don't mutate the data-attribute object
        opts = JSON.parse(JSON.stringify(opts));

        // Destroy any pre-existing Swiper on this element
        if (swiperEl.swiper) {
            swiperEl.swiper.destroy(true, true);
        }

        opts.loop = true;

        /* Swiper 11 autoplay + freeMode + delay:0 does not pause/resume reliably — we drive marquee via rAF. */
        let marqueeReverse = false;
        let marqueeSpeedMs = 8000;

        if (isMarquee) {
            opts.freeMode                      = { enabled: true, momentum: false };
            opts.autoplay                      = opts.autoplay || {};
            marqueeReverse                     = Boolean(opts.autoplay.reverseDirection);
            marqueeSpeedMs                     = Math.max(500, Number(opts.speed) || 8000);
            opts.speed                         = marqueeSpeedMs;
            opts.autoplay                      = false;
        } else {
            opts.freeMode                      = false;
            opts.autoplay                      = opts.autoplay || {};
            if (!opts.autoplay.delay || opts.autoplay.delay === 0) {
                opts.autoplay.delay = 3000;
            }
            opts.autoplay.disableOnInteraction = false;
            opts.autoplay.pauseOnMouseEnter    = false;
        }

        opts.watchSlidesProgress = true;

        const slideCount = $wrapper.find('.swiper-slide').length;
        if (slideCount < 2) {
            opts.loop = false;
        }

        const instance       = new Swiper(swiperEl, opts);
        instance._peaPlaying = true;
        instance._peaUserPaused = false;
        instance._peaHoverPaused = false;
        instance._peaMarqueeRafId = null;
        instance._peaMarqueeLastTs = null;
        instance._peaMarqueeSpeedMs = marqueeSpeedMs;
        instance._peaMarqueeSign = marqueeReverse ? 1 : -1;
        instance._peaMarqueeFrameCount = 0;

        const resizeNs = '.peaTickerMarquee.' + Math.random().toString(36).slice(2, 10);

        function computeMarqueeStride() {
            const w = instance.wrapperEl;
            if (!w) return 1;
            const loopOn = Boolean(instance.params && instance.params.loop);
            if (loopOn && slideCount >= 2) {
                return Math.max(1, w.scrollWidth / 2);
            }
            const minT = typeof instance.minTranslate === 'function' ? instance.minTranslate() : -1e9;
            const maxT = typeof instance.maxTranslate === 'function' ? instance.maxTranslate() : 0;
            return Math.max(1, Math.abs(maxT - minT));
        }

        function stopMarqueeRaf() {
            if (instance._peaMarqueeRafId != null) {
                cancelAnimationFrame(instance._peaMarqueeRafId);
                instance._peaMarqueeRafId = null;
            }
            instance._peaMarqueeLastTs = null;
        }

        function marqueeTick(timestamp) {
            if (!instance || !instance._peaPlaying) {
                stopMarqueeRaf();
                return;
            }
            if (instance._peaMarqueeLastTs == null) {
                instance._peaMarqueeLastTs = timestamp;
            }
            const dt = timestamp - instance._peaMarqueeLastTs;
            instance._peaMarqueeLastTs = timestamp;

            const speedMs = instance._peaMarqueeSpeedMs || 8000;
            const stride = computeMarqueeStride();
            const pxPerMs = stride / speedMs;
            const sign = instance._peaMarqueeSign;

            let t = typeof instance.getTranslate === 'function' ? instance.getTranslate() : 0;
            if (!Number.isFinite(t)) t = 0;
            t += sign * pxPerMs * dt;

            const loopOn = Boolean(instance.params && instance.params.loop);
            if (loopOn && slideCount >= 2) {
                const s = stride;
                if (sign < 0) {
                    while (t <= -s) t += s;
                    while (t > 0) t -= s;
                } else {
                    while (t < 0) t += s;
                    while (t >= s) t -= s;
                }
            } else {
                const minT = typeof instance.minTranslate === 'function' ? instance.minTranslate() : -1e9;
                const maxT = typeof instance.maxTranslate === 'function' ? instance.maxTranslate() : 0;
                t = Math.min(maxT, Math.max(minT, t));
            }

            if (typeof instance.setTransition === 'function') {
                instance.setTransition(0);
            }
            if (typeof instance.setTranslate === 'function') {
                instance.setTranslate(t);
            }
            instance._peaFrozenTranslate = t;

            instance._peaMarqueeFrameCount += 1;
            if (loopOn && instance._peaMarqueeFrameCount % 60 === 0 && typeof instance.loopFix === 'function') {
                instance.loopFix();
            }

            instance._peaMarqueeRafId = requestAnimationFrame(marqueeTick);
        }

        function startMarqueeRaf() {
            if (!isMarquee || !instance) return;
            stopMarqueeRaf();
            if (!instance._peaPlaying) return;
            instance._peaMarqueeLastTs = null;
            instance._peaMarqueeRafId = requestAnimationFrame(marqueeTick);
        }

        function peaTickerCleanup() {
            stopMarqueeRaf();
            $(window).off('resize' + resizeNs);
        }

        instance._peaTickerCleanup = peaTickerCleanup;

        if (isMarquee) {
            $(window).on('resize' + resizeNs, function () {
                instance._peaMarqueeFrameCount = 0;
            });
            startMarqueeRaf();
        }

        // Helpers 
        function freezeWrapper() {
            if (!isMarquee || !instance) return;
            const current = typeof instance.getTranslate === 'function' ? instance.getTranslate() : 0;
            instance._peaFrozenTranslate = Number.isFinite(current) ? current : 0;
            if (typeof instance.setTransition === 'function') instance.setTransition(0);
            if (typeof instance.setTranslate === 'function') instance.setTranslate(instance._peaFrozenTranslate);
        }

        function unfreezeWrapper() {
            if (!isMarquee || !instance) return;
            const fallback = typeof instance.getTranslate === 'function' ? instance.getTranslate() : 0;
            const target = Number.isFinite(instance._peaFrozenTranslate) ? instance._peaFrozenTranslate : fallback;
            if (typeof instance.setTransition === 'function') instance.setTransition(0);
            if (typeof instance.setTranslate === 'function' && Number.isFinite(target)) {
                instance.setTranslate(target);
            }
        }

        function applyExactFrozenTranslate() {
            if (!instance || !isMarquee) return;
            const t = Number.isFinite(instance._peaFrozenTranslate)
                ? instance._peaFrozenTranslate
                : (typeof instance.getTranslate === 'function' ? instance.getTranslate() : 0);
            if (!Number.isFinite(t)) return;
            instance._peaFrozenTranslate = t;
            if (typeof instance.setTransition === 'function') {
                instance.setTransition(0);
            }
            if (typeof instance.setTranslate === 'function') {
                instance.setTranslate(t);
            }
        }

        function safePause() {
            if (isMarquee) {
                stopMarqueeRaf();
                freezeWrapper();
                instance._peaPlaying = false;
                return;
            }
            if (!instance?.autoplay) return;
            if (typeof instance.autoplay.pause === 'function') {
                instance.autoplay.pause();
            } else {
                instance.autoplay.stop();
            }
            instance._peaPlaying = false;
        }

        function safePlay() {
            if (isMarquee) {
                instance._peaPlaying = true;
                applyExactFrozenTranslate();
                startMarqueeRaf();
                return;
            }
            if (!instance?.autoplay) return;
            instance._peaPlaying = true;
            unfreezeWrapper();
            if (typeof instance.update === 'function') {
                instance.update();
            }
            if (typeof instance.autoplay.resume === 'function') {
                instance.autoplay.resume();
            } else {
                instance.autoplay.start();
            }
            requestAnimationFrame(function () {
                if (!instance || !instance._peaPlaying) return;
                if (typeof instance.autoplay.resume === 'function') {
                    instance.autoplay.resume();
                } else if (typeof instance.autoplay.start === 'function') {
                    instance.autoplay.start();
                }
            });
        }

        function nudgeMarquee(direction) {
            if (!instance || !isMarquee) return;

            const wasPlaying = instance._peaPlaying;

            if (wasPlaying) {
                stopMarqueeRaf();
            }

            freezeWrapper();

            let base = typeof instance.getTranslate === 'function' ? instance.getTranslate() : 0;
            if (!Number.isFinite(base)) {
                base = Number.isFinite(instance._peaFrozenTranslate) ? instance._peaFrozenTranslate : 0;
            }

            const viewportW = swiperEl.offsetWidth || 400;
            const step = viewportW * 0.15 * direction;
            let target = base + step;

            const loopOn = Boolean(instance.params && instance.params.loop);
            if (!loopOn) {
                const minT = typeof instance.minTranslate === 'function' ? instance.minTranslate() : null;
                const maxT = typeof instance.maxTranslate === 'function' ? instance.maxTranslate() : null;
                if (minT !== null && maxT !== null && Number.isFinite(minT) && Number.isFinite(maxT)) {
                    target = Math.min(maxT, Math.max(minT, target));
                }
            }

            instance._peaFrozenTranslate = target;

            $(swiperEl).find('.swiper-wrapper').css({ 'transition-duration': '', 'transform': '' });

            if (typeof instance.setTransition === 'function') {
                instance.setTransition(300);
            }
            if (typeof instance.setTranslate === 'function') {
                instance.setTranslate(target);
            }

            setTimeout(function () {
                if (!instance) return;
                if (typeof instance.setTransition === 'function') {
                    instance.setTransition(0);
                }
                if (loopOn && typeof instance.loopFix === 'function') {
                    instance.loopFix();
                }
                if (typeof instance.getTranslate === 'function') {
                    const t = instance.getTranslate();
                    if (Number.isFinite(t)) {
                        instance._peaFrozenTranslate = t;
                    }
                }
                if (wasPlaying) {
                    instance._peaPlaying = true;
                    safePlay();
                } else {
                    instance._peaPlaying = false;
                    freezeWrapper();
                }
            }, 320);
        }

        $wrapper.find('.pea-ticker-prev').off('click.pea').on('click.pea', function (e) {
            e.preventDefault();
            if (!instance) return;
            if (isMarquee) {
                nudgeMarquee(+1);
            } else {
                instance.slidePrev();
            }
        });

        $wrapper.find('.pea-ticker-next').off('click.pea').on('click.pea', function (e) {
            e.preventDefault();
            if (!instance) return;
            if (isMarquee) {
                nudgeMarquee(-1);
            } else {
                instance.slideNext();
            }
        });

        // Pause / Play

        $wrapper.find('.pea-ticker-pause-play').off('click.pea').on('click.pea', function (e) {
            e.preventDefault();

            if (!isMarquee && !instance?.autoplay) return;

            const $btn = $(this);

            if (!instance._peaUserPaused) {
                instance._peaUserPaused = true;
                safePause();
                $btn.attr('data-playing', 'false').html(SVG_PLAY).attr('aria-label', 'Play');
            } else {
                instance._peaUserPaused = false;
                safePlay();
                $btn.attr('data-playing', 'true').html(SVG_PAUSE).attr('aria-label', 'Pause');
            }
        });

        // Hover pause

        if (pauseOnHover) {
            swiperEl.addEventListener('mouseenter', function () {
                if (instance && !instance._peaUserPaused && !instance._peaHoverPaused) {
                    instance._peaHoverPaused = true;
                    safePause();
                }
            });
            swiperEl.addEventListener('mouseleave', function () {
                if (instance && instance._peaHoverPaused) {
                    instance._peaHoverPaused = false;
                }
                if (instance && !instance._peaUserPaused) {
                    safePlay();
                }
            });
        }

        // Clock

        let timerInterval = null;
        const $timerEl = $wrapper.find('.pea-ticker-timer-value');

        if ($timerEl.length) {
            timerInterval = initClock($timerEl);
        }

        return { instance, timerInterval };
    }

    // Live clock helper

    function initClock($el) {
        const tick = () => {
            const now  = new Date();
            let   h    = now.getHours();
            const m    = ('0' + now.getMinutes()).slice(-2);
            const ampm = h >= 12 ? 'PM' : 'AM';
            h = h % 12 || 12;                         
            $el.text(h + ':' + m + ' ' + ampm);
        };

        tick();                                        
        return setInterval(tick, 1000);
    }

    // Elementor handler
    const NewsTickerHandler = elementorModules.frontend.handlers.Base.extend({

        _instances: [],

        getDefaultSettings() {
            return { selectors: { wrapper: '.pea-ticker-wrapper' } };
        },

        getDefaultElements() {
            const s = this.getSettings('selectors');
            return { $wrappers: this.$element.find(s.wrapper) };
        },

        bindEvents() { },

        onInit() {
            elementorModules.frontend.handlers.Base.prototype.onInit.apply(this, arguments);
            this.initAll();
        },

        onElementChange() {
            this.destroyAll();
            this.initAll();
        },

        initAll() {
            const self = this;
            this.elements.$wrappers.each(function () {
                const result = initTickerOnWrapper($(this));
                if (result) self._instances.push(result);
            });
        },

        destroyAll() {
            this._instances.forEach(function ({ instance, timerInterval }) {
                if (instance && typeof instance._peaTickerCleanup === 'function') {
                    try { instance._peaTickerCleanup(); } catch (e) { }
                }
                try { instance.destroy(true, true); } catch (e) { }
                if (timerInterval) clearInterval(timerInterval);
            });
            this._instances = [];
        },

        onDestroy() {
            this.destroyAll();
            elementorModules.frontend.handlers.Base.prototype.onDestroy.apply(this, arguments);
        },
    });

    // Register
    $(window).on('elementor/frontend/init', function () {
        const addHandler = function ($element) {
            elementorFrontend.elementsHandler.addHandler(NewsTickerHandler, { $element });
        };

        elementorFrontend.hooks.addAction(
            'frontend/element_ready/pea_news_ticker.default',
            addHandler
        );
    });

})(jQuery);