(function ($) {
    jQuery(window).on('elementor/frontend/init', function () {
        var Counter = function ($scope, $) {
            if ('undefined' == typeof $scope) { return; }
            
            const wrapper = $scope[0]; // Convert jQuery object to DOM element
            
            function formatNumberWithSpaceSeparator(num, decimalPlaces) {
                const [intPart, decPart] = num.toFixed(decimalPlaces).split('.');
                const intWithSpace = intPart.replace(/\B(?=(\d{3})+(?!\d))/g, ' ');
                return decPart ? `${intWithSpace}.${decPart}` : intWithSpace;
            }
            
            function animateCounter(counterElement) {
                const start = parseFloat(counterElement.getAttribute('counter-start')) || 0;
                const end = parseFloat(counterElement.getAttribute('counter-end')) || 0;
                const duration = parseInt(counterElement.getAttribute('counter-duration'), 10) || 2000;
                const separatorEnabled = counterElement.getAttribute('separator-switch') === 'true';
                const separatorType = counterElement.getAttribute('separator-type') || 'comma';
                
                let startTime = null;
                
                function step(timestamp) {
                    if (!startTime) startTime = timestamp;
                    
                    const progress = Math.min((timestamp - startTime) / duration, 1);
                    const current = progress * (end - start) + start;
                    
                    const hasDecimal = !Number.isInteger(start) || !Number.isInteger(end);
                    const decimalPlaces = hasDecimal ? 1 : 0;
                    
                    let formattedNumber;
                    
                    if (separatorEnabled) {
                        switch (separatorType) {
                            case 'comma':
                                formattedNumber = current.toLocaleString('en-US', {
                                    minimumFractionDigits: decimalPlaces,
                                    maximumFractionDigits: decimalPlaces
                                });
                                break;
                            case 'dot':
                                formattedNumber = current.toLocaleString('de-DE', {
                                    minimumFractionDigits: decimalPlaces,
                                    maximumFractionDigits: decimalPlaces
                                });
                                break;
                            case 'space':
                                formattedNumber = formatNumberWithSpaceSeparator(current, decimalPlaces);
                                break;
                            default:
                                formattedNumber = current.toLocaleString(undefined, {
                                    minimumFractionDigits: decimalPlaces,
                                    maximumFractionDigits: decimalPlaces
                                });
                        }
                    } else {
                        formattedNumber = hasDecimal ? current.toFixed(decimalPlaces) : Math.round(current).toString();
                    }
                    
                    counterElement.textContent = formattedNumber;
                    
                    if (progress < 1) {
                        window.requestAnimationFrame(step);
                    }
                }
                
                window.requestAnimationFrame(step);
            }
            
            function initCounter() {
                const counters = wrapper.querySelectorAll('.pea-counter-number');
                
                counters.forEach(function (counter) {
                    // Reset animation state for Elementor editor
                    if (elementorFrontend.isEditMode()) {
                        counter.dataset.animated = "false";
                    }
                    
                    if (counter.dataset.animated === "true") return;
                    
                    var observer = new IntersectionObserver(function (entries) {
                        entries.forEach(function (entry) {
                            if (entry.isIntersecting) {
                                animateCounter(counter);
                                counter.dataset.animated = "true";
                                observer.disconnect();
                            }
                        });
                    }, { threshold: 0.5 });
                    
                    observer.observe(counter);
                });
            }
            
            initCounter();
            
            // // Reinitialize when widget settings change in editor
            // if (elementorFrontend.isEditMode()) {
            //     elementor.hooks.addAction('panel/open_editor/widget', function (panel, model, view) {
            //         if (view.model.get('widgetType') === 'pea_counter') {
            //             initCounter();
            //         }
            //     });
            // }
        }
        
        elementorFrontend.hooks.addAction('frontend/element_ready/pea_counter.default', Counter);
    });
})(jQuery);