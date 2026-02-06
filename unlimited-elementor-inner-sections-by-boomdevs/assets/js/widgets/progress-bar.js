(function($) {
    'use strict';

    var ProgressBar = function($scope, $) {
        if ('undefined' == typeof $scope) { return; }
        const wrapper = $scope[0];
        const items = wrapper.querySelectorAll('.pea-progressbar-item');

        items.forEach(item => {
            if (item.hasAttribute('data-progressbar-init')) return;
            item.setAttribute('data-progressbar-init', 'true');

            const target = parseInt(item.dataset.progress);
            const type = (item.dataset.progressbarType).toLowerCase();
            const duration =  parseInt(item.dataset.duration) || 1500; // Animation duration in ms

            const lineEl = item.querySelector('.pea-progressbar-line');
            const numberEls = item.querySelectorAll('.pea-progressbar-number');

            // Start empty
            if (type === 'vertical') {
                lineEl.style.height = '0%';
                lineEl.style.bottom = '0';
                lineEl.style.top = 'auto';
                lineEl.style.transition = `height ${duration}ms ease-out`;
            } else {
                lineEl.style.width = '0%';
                lineEl.style.transition = `width ${duration}ms ease-out`;
            }

            let animated = false;

            function animate() {
                if (animated) return;
                animated = true;

                const startTime = performance.now();

                // Animate the progress bar line via CSS
                requestAnimationFrame(() => {
                    if (type === 'vertical') {
                        lineEl.style.height = target + '%';
                        lineEl.style.width = '100%';
                    } else {
                        lineEl.style.width = target + '%';
                        lineEl.style.height = '100%';
                    }
                });

                // Animate the counter with requestAnimationFrame
                function updateCounter(currentTime) {
                    const elapsed = currentTime - startTime;
                    const progress = Math.min(elapsed / duration, 1);
                    const currentValue = Math.round(progress * target);

                    numberEls.forEach(n => (n.textContent = currentValue + '%'));

                    if (progress < 1) {
                        requestAnimationFrame(updateCounter);
                    }
                }

                requestAnimationFrame(updateCounter);
            }

            // Scroll trigger with IntersectionObserver
            const io = new IntersectionObserver(
                entries => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            animate();
                            io.unobserve(item);
                        }
                    });
                },
                { threshold: 0.5 }
            );

            io.observe(item);
        });
    };

    // Elementor frontend handler
    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/pea_progress_bar.default', ProgressBar);
    });

})(jQuery);
