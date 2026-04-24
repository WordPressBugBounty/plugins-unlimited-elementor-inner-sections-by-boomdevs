(function ($) {
    'use strict';

    const instances = new Map();
    const RIVE_FILE_RE = /\.riv($|[?#])/i;
    const getNodeScale = node => {
        if (!node) return 1;
        const rect = node.getBoundingClientRect();
        const widthScale = node.offsetWidth > 0 ? rect.width / node.offsetWidth : 1;
        const heightScale = node.offsetHeight > 0 ? rect.height / node.offsetHeight : 1;
        const scale = Math.min(widthScale || 1, heightScale || 1);
        return Number.isFinite(scale) && scale > 0 ? scale : 1;
    };

    const setStatus = (el, msg, note) => {
        let node = el.querySelector('[data-rive-status="dynamic"]');
        if (!msg) {
            node?.remove();
            return;
        }
        if (!node) {
            node = document.createElement('div');
            node.setAttribute('data-rive-status', 'dynamic');
            el.appendChild(node);
        }
        node.className = `pea-rive-animation-status ${note ? 'pea-rive-animation-note' : 'pea-rive-animation-error'}`;
        node.textContent = msg;
    };

    const getErrorMessage = error => error?.message || error?.data || 'Failed to load.';

    const ensureWasmUrl = () => {
        const loader = window.rive?.RuntimeLoader;
        if (!loader?.setWasmUrl) return '';
        const wasmUrl = window.PeaRiveRuntime?.wasmUrl || '';

        if (!wasmUrl) return '';
        if (loader.__peaConfiguredWasmUrl === wasmUrl) return wasmUrl;

        loader.setWasmUrl(wasmUrl);
        loader.__peaConfiguredWasmUrl = wasmUrl;
        return wasmUrl;
    };

    const destroy = el => {
        instances.get(el)?.();
        instances.delete(el);
    };

    const setup = el => {
        destroy(el);

        const canvas = el.querySelector('.pea-rive-animation-canvas');
        const src = el.dataset.riveSrc;
        if (!canvas || !src) return setStatus(el, '');
        if (!RIVE_FILE_RE.test(src)) return setStatus(el, 'Invalid file type.');
        if (!window.rive?.Rive) return setStatus(el, 'Rive runtime unavailable.');

        setStatus(el, '');

        const { Rive, Layout, Fit, Alignment, LoopType } = window.rive;
        const autoplay = el.dataset.autoplay === 'true';
        const fitKey = (el.dataset.fit || 'contain').toLowerCase();
        const fitMap = {
            contain: Fit?.Contain || 'contain',
            cover: Fit?.Cover || 'cover',
            fill: Fit?.Fill || 'fill'
        };
        const fitMode = fitMap[fitKey] || fitMap.contain;
        const alignMode = Alignment?.Center || 'center';
        const editorMode = !!window.elementorFrontend?.isEditMode?.();
        const frameElement = window.frameElement || null;
        let rive = null;
        let rafId = 0;
        let resizeRafId = 0;
        let loadResizeTimeoutId = 0;
        let io;
        let isInViewport = true;
        let isTabVisible = !document.hidden;
        const getEffectiveDpr = () => {
            let dpr = window.devicePixelRatio || 1;
            if (window.top && window.top !== window) {
                try {
                    dpr = Math.max(dpr, window.top.devicePixelRatio || 1);
                } catch (e) {
                    // Ignore cross-origin access errors.
                }
            }

            let scale = getNodeScale(el);
            if (editorMode) {
                scale = Math.min(scale, getNodeScale(frameElement));
            }
            if (scale > 0 && scale < 1) {
                dpr /= scale;
            }

            return Math.min(4, Math.max(1, dpr > 0 ? dpr : 1));
        };

        const resize = () => {
            if (!el.isConnected || !isInViewport || !isTabVisible) {
                return;
            }
            const dpr = getEffectiveDpr();
            if (editorMode) {
                const rect = canvas.getBoundingClientRect();
                if (rect.width > 0 && rect.height > 0) {
                    const width = Math.round(rect.width * dpr);
                    const height = Math.round(rect.height * dpr);
                    if (canvas.width !== width) {
                        canvas.width = width;
                    }
                    if (canvas.height !== height) {
                        canvas.height = height;
                    }
                }
            }
            if (rive?.resizeToCanvas) {
                rive.resizeToCanvas();
            }
            if (!rive?.resizeDrawingSurfaceToCanvas) return;
            rive.resizeDrawingSurfaceToCanvas(dpr);
        };

        const scheduleResize = () => {
            if (resizeRafId) return;
            resizeRafId = window.requestAnimationFrame(() => {
                resizeRafId = 0;
                resize();
            });
        };
        const syncPlaybackState = () => {
            if (!rive) {
                return;
            }
            if (!isInViewport || !isTabVisible) {
                rive.pause?.();
                return;
            }
            if (!autoplay) {
                return;
            }
            if (rive.play) {
                if (rive.stateMachineNames?.length) {
                    rive.play(rive.stateMachineNames);
                } else if (rive.animationNames?.length) {
                    rive.play(rive.animationNames);
                }
            }
        };
        const onVisibilityChange = () => {
            isTabVisible = !document.hidden;
            syncPlaybackState();
        };

        const init = () => {
            ensureWasmUrl();

            rive = new Rive({
                src,
                canvas,
                autoplay,
                layout: new Layout({ fit: fitMode, alignment: alignMode }),
                onLoad() {
                    scheduleResize();
                    loadResizeTimeoutId = window.setTimeout(scheduleResize, 50);
                    if (el.dataset.loop === 'true' && rive?.animationNames?.length && rive?.setLooping) {
                        rive.setLooping(rive.animationNames[0], LoopType?.Loop || 'loop');
                    }
                    if (autoplay && rive?.play) {
                        if (rive.stateMachineNames?.length) {
                            rive.play(rive.stateMachineNames);
                        } else if (rive.animationNames?.length) {
                            rive.play(rive.animationNames);
                        }
                    }
                    syncPlaybackState();
                },
                onLoadError: e => setStatus(el, getErrorMessage(e))
            });
        };

        const waitForVisibleCanvas = (attempt = 0) => {
            const rect = canvas.getBoundingClientRect();
            if (rect.width > 0 && rect.height > 0) {
                init();
                return;
            }
            if (attempt >= 40) {
                init();
                return;
            }
            rafId = window.requestAnimationFrame(() => waitForVisibleCanvas(attempt + 1));
        };

        waitForVisibleCanvas();

        let ro;
        let frameObserver;
        let topResizeTarget;
        if (typeof ResizeObserver !== 'undefined') {
            ro = new ResizeObserver(scheduleResize);
            ro.observe(el);
        } else {
            window.addEventListener('resize', scheduleResize);
        }
        if (editorMode && typeof MutationObserver !== 'undefined' && frameElement) {
            frameObserver = new MutationObserver(scheduleResize);
            frameObserver.observe(frameElement, {
                attributes: true,
                attributeFilter: ['style', 'class']
            });
        }
        if (editorMode && window.top && window.top !== window) {
            try {
                topResizeTarget = window.top;
                topResizeTarget.addEventListener('resize', scheduleResize);
            } catch (e) {
                topResizeTarget = null;
            }
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
            if (loadResizeTimeoutId) {
                window.clearTimeout(loadResizeTimeoutId);
                loadResizeTimeoutId = 0;
            }
            if (rafId) {
                window.cancelAnimationFrame(rafId);
                rafId = 0;
            }
            if (resizeRafId) {
                window.cancelAnimationFrame(resizeRafId);
                resizeRafId = 0;
            }
            rive?.cleanup?.();
            if (ro) {
                ro.disconnect();
            } else {
                window.removeEventListener('resize', scheduleResize);
            }
            io?.disconnect();
            document.removeEventListener('visibilitychange', onVisibilityChange);
            frameObserver?.disconnect();
            topResizeTarget?.removeEventListener('resize', scheduleResize);
        });
    };

    const boot = (root = document) => {
        root.querySelectorAll('.pea-rive-animation-inner').forEach(setup);
    };

    $(window).on('elementor/frontend/init', () => {
        elementorFrontend.hooks.addAction('frontend/element_ready/pea_rive_animation.default', $scope => boot($scope[0]));
    });
    $(window).on('load', () => boot());
})(jQuery);
