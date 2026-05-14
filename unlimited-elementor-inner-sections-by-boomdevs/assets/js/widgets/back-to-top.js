(function ($) {
  $(window).on("elementor/frontend/init", function () {
    var elementorFrontend = window.elementorFrontend;
    elementorFrontend.hooks.addAction(
      "frontend/element_ready/pea_back_to_top.default",
      BackToTop
    );
  });

  function BackToTop() {

    var $backToTop = $("#backToTop");
    var $buttonInner = $backToTop.find(".pea_back_to_top_content_wropper");

    $backToTop.removeClass("pea-show");

    $(window).on("scroll.backToTop", function () {
      if ($(this).scrollTop() > 100) {
        $backToTop.addClass("pea-show");
      } else {
        $backToTop.removeClass("pea-show");
      }
    });

    $backToTop.on("click", function () {

      $buttonInner.addClass("active");
      $("html, body").animate({ scrollTop: 0 }, 600, function () {
        $buttonInner.removeClass("active");
      });

      return false;
    });
  }
})(jQuery);