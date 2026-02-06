(function ($) {
    jQuery(window).on('elementor/frontend/init', function () {

        var AdvancedMenu = function ($scope, $) {
            if ('undefined' == typeof $scope) { return; }

            var $main = $scope.find(".pea-main-nav");
            var $wrapper = $scope.find(".pea-advanced-menu-wrapper");
            var widget_id = $wrapper.attr('widget-id');
            var dropdown_click = $wrapper.attr('open-dropdown-on-click');
            var show_dropdown_icon = $wrapper.attr('show-dropdown-icon');

            // 1. Mobile Toggle
            $scope.find('.toggle-icon.open').on("click", function () {
                $main.toggleClass('open-nav');
                $scope.find('.pea--collapse').toggleClass('responsiv_nav');
                
                // Use setTimeout instead of setInterval for better performance
                if ($main.hasClass('open-nav')) {
                    setTimeout(function() {
                        fullWidthMobileDropdown();
                    }, 50);
                }
            });

            // 2. SmartMenu Config
            let smartMenuOptions = {
                subMenusSubOffsetX: 0,
                subMenusSubOffsetY: 0,
                collapsibleBehavior: 'toggle'
            };

            if (dropdown_click === "yes") {
                smartMenuOptions.showOnClick = true;
                smartMenuOptions.noMouseOver = true;
            }
            
            if (dropdown_click !== "yes" && show_dropdown_icon !== "yes") {
                smartMenuOptions.subIndicators = false;
            }

            // Init Smart Menu
            $scope.find('#pea-menu-' + widget_id).smartmenus(smartMenuOptions);

            // 3. Resize Listener
            $(window).smartresize(function() {
                if ($main.hasClass('open-nav')) {
                    fullWidthMobileDropdown();
                }
            });

            // 4. The Corrected Full Width Function
            function fullWidthMobileDropdown() {
                // Security Check
                if ( ! $scope.hasClass( 'pea-mobile-menu-full-width-yes' ) || !($scope.find('.pea--collapse').hasClass('responsiv_nav')) ) {
                    $scope.find('.pea--collapse').removeAttr('style');
                    return;
                }

                var $dropdown = $scope.find('.responsiv_nav');
                
                // STEP A: Get correct viewport width (excludes scrollbar)
                var viewportWidth = $(window).width(); 

                // STEP B: Calculate distance from left edge of screen to the WIDGET (not column)
                // We use $main because that is usually the relative parent
                var offsetLeft = $main.offset().left;

                // STEP C: Apply Styles
                $dropdown.css({
                    'width': viewportWidth + 'px',
                    'left': '-' + offsetLeft + 'px',
                    'right': 'auto', // Reset right to avoid conflicts
                    'box-sizing': 'border-box' // Ensures padding doesn't add extra pixels
                });
            }
        }

        elementorFrontend.hooks.addAction(
            'frontend/element_ready/pea_advanced_menu.default',
            AdvancedMenu
        );
    });
})(jQuery);
// Resize Function - Debounce
(function($,sr){

  var debounce = function (func, threshold, execAsap) {
      var timeout;

      return function debounced () {
          var obj = this, args = arguments;
          function delayed () {
              if (!execAsap)
                  func.apply(obj, args);
              timeout = null;
          };

          if (timeout)
              clearTimeout(timeout);
          else if (execAsap)
              func.apply(obj, args);

          timeout = setTimeout(delayed, threshold || 100);
      };
  }
  // smartresize 
  jQuery.fn[sr] = function(fn){  return fn ? this.bind('resize', debounce(fn)) : this.trigger(sr); };

})(jQuery,'smartresize');