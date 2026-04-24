(function ($) {
    'use strict';

    const instances = new Map();
    const HOVER_ACTIONS = new Set(['pause', 'play', 'reverse']);
    const JSON_FILE_RE = /\.json($|[?#])/i;
    const clamp = (value, min, max) => Math.min(max, Math.max(min, value));

    const setStatus = (el, msg) => {
        let node = el.querySelector('[data-lottie-status="dynamic"]');
        if (!msg) {
            node?.remove();
            return;
        }
        if (!node) {
            node = document.createElement('div');
            node.setAttribute('data-lottie-status', 'dynamic');
            el.appendChild(node);
        }
        node.className = 'pea-lottie-animation-status pea-lottie-animation-error';
        node.textContent = msg;
    };

    const destroy = el => {
        instances.get(el)?.();
        instances.delete(el);
    };

    const getLottieRuntime = () => {
        const frontendUtils = window.elementorFrontend?.utils || {};
        const candidates = [
            window.lottie,
            window.bodymovin,
            frontendUtils.lottie,
            frontendUtils.animations?.lottie,
            frontendUtils.animation?.lottie
        ];

        return candidates.find(runtime => runtime?.loadAnimation) || null;
    };

    const bindHoverAction = (el, animation, baseDirection, autoplay, action) => {
        if (!action || !HOVER_ACTIONS.has(action)) {
            return () => {};
        }

        const restore = () => {
            animation.setDirection?.(baseDirection);
            if (action === 'play') {
                animation.pause?.();
                return;
            }
            if (autoplay) {
                animation.play?.();
            } else {
                animation.pause?.();
            }
        };

        const onEnter = () => {
            if (action === 'pause') {
                animation.pause?.();
            } else if (action === 'play') {
                animation.setDirection?.(baseDirection);
                animation.play?.();
            } else {
                animation.setDirection?.(-1);
                animation.play?.();
            }
        };

        el.addEventListener('mouseenter', onEnter);
        el.addEventListener('mouseleave', restore);
        if (action === 'play') {
            restore();
        }

        return () => {
            el.removeEventListener('mouseenter', onEnter);
            el.removeEventListener('mouseleave', restore);
        };
    };

    const setup = el => {
        destroy(el);

        const container = el.querySelector('.pea-lottie-animation-player');
        const path = el.dataset.lottieSrc;
        if (!container || !path) return setStatus(el, '');
        if (!JSON_FILE_RE.test(path)) return setStatus(el, 'Invalid file type.');
        const runtime = getLottieRuntime();
        if (!runtime) return setStatus(el, 'Lottie runtime unavailable.');

        setStatus(el, '');
        const parsedSpeed = parseFloat(el.dataset.speed);
        const speed = Number.isFinite(parsedSpeed) ? clamp(parsedSpeed, 0.1, 5) : 1;
        const autoplay = el.dataset.autoplay === 'true';
        const hoverAction = (el.dataset.hoverAction || '').toLowerCase();
        const shouldAutoplay = autoplay && hoverAction !== 'play';
        const direction = el.dataset.reverse === 'true' ? -1 : 1;
        let resizeRafId = 0;
        let ro;
        let io;
        let isInViewport = true;
        let isTabVisible = !document.hidden;

        const scheduleResize = () => {
            if (resizeRafId) return;
            resizeRafId = window.requestAnimationFrame(() => {
                resizeRafId = 0;
                if (!el.isConnected || !isInViewport || !isTabVisible) {
                    return;
                }
                animation.resize?.();
            });
        };

        const loadOptions = {
            container,
            renderer: 'canvas',
            loop: el.dataset.loop === 'true',
            autoplay: shouldAutoplay,
            path,
            rendererSettings: {
                preserveAspectRatio: 'xMidYMid meet',
                progressiveLoad: true
            }
        };

        const animation = runtime.loadAnimation(loadOptions);

        animation.setSpeed?.(speed);
        animation.setDirection?.(direction);
        const unbindHoverAction = bindHoverAction(el, animation, direction, autoplay, hoverAction);
        const syncPlaybackState = () => {
            if (!animation) {
                return;
            }
            if (!isInViewport || !isTabVisible) {
                animation.pause?.();
                return;
            }
            if (shouldAutoplay) {
                animation.play?.();
            }
        };
        const onVisibilityChange = () => {
            isTabVisible = !document.hidden;
            syncPlaybackState();
        };
        const onDataFailed = () => setStatus(el, 'Failed to load.');
        const onDomLoaded = () => {
            if (hoverAction === 'play') {
                const firstFrame = direction === -1
                    ? Math.max(0, (animation.totalFrames || 1) - 1)
                    : 0;
                animation.goToAndStop?.(firstFrame, true);
                animation.pause?.();
            }
            scheduleResize();
            syncPlaybackState();
        };
        animation.addEventListener?.('data_failed', onDataFailed);
        animation.addEventListener?.('DOMLoaded', onDomLoaded);
        if (typeof ResizeObserver !== 'undefined') {
            ro = new ResizeObserver(scheduleResize);
            ro.observe(el);
        } else {
            window.addEventListener('resize', scheduleResize);
        }
        if (typeof IntersectionObserver !== 'undefined') {
            io = new IntersectionObserver(entries => {
                const entry = entries[0];
                isInViewport = !!entry?.isIntersecting;
                syncPlaybackState();
                if (isInViewport) {
                    scheduleResize();
                }
            }, { threshold: 0.01 });
            io.observe(el);
        }
        document.addEventListener('visibilitychange', onVisibilityChange, { passive: true });
        instances.set(el, () => {
            if (resizeRafId) {
                window.cancelAnimationFrame(resizeRafId);
                resizeRafId = 0;
            }
            ro?.disconnect();
            io?.disconnect();
            if (!ro) {
                window.removeEventListener('resize', scheduleResize);
            }
            document.removeEventListener('visibilitychange', onVisibilityChange);
            animation.removeEventListener?.('data_failed', onDataFailed);
            animation.removeEventListener?.('DOMLoaded', onDomLoaded);
            unbindHoverAction();
            animation.destroy?.();
        });
    };

    const boot = (root = document) => {
        root.querySelectorAll('.pea-lottie-animation-inner').forEach(el => setup(el));
    };

    $(window).on('elementor/frontend/init', () => {
        elementorFrontend.hooks.addAction('frontend/element_ready/pea_lottie_animation.default', $scope => boot($scope[0]));
    });
    $(window).on('load', () => boot());
})(jQuery);
