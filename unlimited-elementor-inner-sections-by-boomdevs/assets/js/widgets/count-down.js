(function ($) {
    jQuery(window).on('elementor/frontend/init', function () {
        var CountDown = function ($scope, $) {
            if ('undefined' == typeof $scope) { return; }
            
            const wrapper = $scope[0]; // Convert jQuery object to DOM element
            
            // Find the countdown container within this widget instance
            var countdownContainer = wrapper.querySelector("[data-target-date]");
            
            if (!countdownContainer) return;
            
            var targetDate = countdownContainer.getAttribute("data-target-date");
            if (!targetDate) return;
            
            var daysElem = countdownContainer.querySelector(".days");
            var hoursElem = countdownContainer.querySelector(".hours");
            var minutesElem = countdownContainer.querySelector(".minutes");
            var secondsElem = countdownContainer.querySelector(".seconds");
            
            function formatTime(time) {
                return time < 10 ? "0" + time : time;
            }
            
            function updateCountdown() {
                var now = new Date().getTime();
                var distance = new Date(targetDate).getTime() - now;
                
                if (distance < 0) {
                    // Countdown expired
                    daysElem && (daysElem.textContent = "00");
                    hoursElem && (hoursElem.textContent = "00");
                    minutesElem && (minutesElem.textContent = "00");
                    secondsElem && (secondsElem.textContent = "00");
                    
                    // Clear interval when countdown expires
                    if (countdownContainer.countdownInterval) {
                        clearInterval(countdownContainer.countdownInterval);
                    }
                    return;
                }
                
                var days = formatTime(Math.floor(distance / (1000 * 60 * 60 * 24)));
                var hours = formatTime(Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)));
                var minutes = formatTime(Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60)));
                var seconds = formatTime(Math.floor((distance % (1000 * 60)) / 1000));
                
                daysElem && (daysElem.textContent = days);
                hoursElem && (hoursElem.textContent = hours);
                minutesElem && (minutesElem.textContent = minutes);
                secondsElem && (secondsElem.textContent = seconds);
            }
            
            // Clear any existing interval (prevents duplicates on re-render)
            if (countdownContainer.countdownInterval) {
                clearInterval(countdownContainer.countdownInterval);
            }
            
            // Update countdown every second and store interval reference
            countdownContainer.countdownInterval = setInterval(updateCountdown, 1000);
            updateCountdown(); // Initial update
        }
        
        elementorFrontend.hooks.addAction('frontend/element_ready/pea_count_down.default', CountDown);
    });
})(jQuery);