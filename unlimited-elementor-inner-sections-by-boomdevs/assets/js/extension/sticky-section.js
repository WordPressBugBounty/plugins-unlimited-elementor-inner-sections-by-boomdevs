/**
 * Handles all sticky logic on the frontend:
 *  - Sticky Position : top | bottom | column
 *  - Sticky Until    : stop at a CSS ID
 *  - Sticky Offset   : px gap from viewport edge
 *  - Background/Shadow change when sticky activates
 *  - Device Control  : skip sticky on specific breakpoints
 *  - Entrance Animation: fade | slide-down | slide-up
 */
(function ($) {
  "use strict";

  // ─────────────────────────────────────────────────────────────────────────
  // BREAKPOINT DETECTION
  // Matches Elementor's default breakpoints
  // ─────────────────────────────────────────────────────────────────────────
  var getDevice = function () {
    var w = window.innerWidth;
    if (w <= 767) return "mobile";
    if (w <= 1024) return "tablet";
    return "desktop";
  };

  // ─────────────────────────────────────────────────────────────────────────
  // ENTRANCE ANIMATION
  // Called once when the element becomes sticky for the first time
  // ─────────────────────────────────────────────────────────────────────────
  var playEntranceAnimation = function ($el, type, duration) {
    if (!type || type === "none") return;

    $el.css({ "animation-duration": duration + "ms" });
    $el.addClass("pea-sticky-anim-" + type);

    // Remove class after animation ends so it can replay next time
    setTimeout(function () {
      $el.removeClass("pea-sticky-anim-" + type);
    }, duration + 50);
  };

  // ─────────────────────────────────────────────────────────────────────────
  // SINGLE ELEMENT STICKY HANDLER
  // ─────────────────────────────────────────────────────────────────────────
  var PeaStickyHandler = function ($el) {
    var raw = $el.attr("data-pea-sticky");
    if (!raw) return;

    var cfg;
    try {
      cfg = JSON.parse(raw);
    } catch (e) {
      return;
    }

    if (!cfg || !cfg.enabled) return;

    // Device check — bail if sticky is disabled for this breakpoint
    var device = getDevice();
    if (device === "desktop" && !cfg.desktop) return;
    if (device === "tablet" && !cfg.tablet) return;
    if (device === "mobile" && !cfg.mobile) return;

    var position = cfg.position || "top";
    var offset = parseInt(cfg.offset, 10) || 0;
    var untilSel = cfg.until || "";
    var animation = cfg.animation || "none";
    var animDur = parseInt(cfg.animDuration, 10) || 400;

    var bgEnable = !!cfg.bgEnable;
    var bgColor = cfg.bgColor || "rgba(255,255,255,1)";
    var transition = parseInt(cfg.transition, 10) || 300;
    var shadowEnable = !!cfg.shadowEnable;
    var shadowColor = cfg.shadowColor || "rgba(0,0,0,0.12)";

    // ── COLUMN MODE ───────────────────────────────────────────────────────
    // Sticky within its parent container rather than the viewport.
    // Uses position:sticky on the element itself.
    if (position === "column") {
      $el.css({
        position: "sticky",
        top: offset + "px",
        "z-index": 99,
      });

      // Apply bg/shadow as permanent style for column mode
      if (bgEnable) {
        $el.css({
          "background-color": bgColor,
          transition:
            "background-color " +
            transition +
            "ms ease, box-shadow " +
            transition +
            "ms ease",
        });
        if (shadowEnable) {
          $el.css("box-shadow", "0 4px 24px " + shadowColor);
        }
      }
      return; // Column mode requires no scroll listener
    }

    // ── TOP / BOTTOM MODE ─────────────────────────────────────────────────
    var $placeholder = null; // Reserve space when element is lifted out of flow
    var isSticky = false;
    var originalStyle = {}; // Store original inline styles for restore

    // Snapshot of the element's natural layout position
    var elNaturalTop = 0;
    var elNaturalBottom = 0;
    var elHeight = 0;
    var elWidth = 0;

    // Read natural position once before any scroll
    var cacheNaturalMetrics = function () {
      // Temporarily detach sticky so measurements are natural
      $el.removeClass("pea-is-sticky");
      if ($placeholder) {
        $placeholder.css("height", 0);
      }

      var rect = $el[0].getBoundingClientRect();
      var scrollY = window.pageYOffset;
      elNaturalTop = rect.top + scrollY;
      elNaturalBottom = rect.bottom + scrollY;
      elHeight = $el.outerHeight(true);
      elWidth = $el.outerWidth();
    };

    // Create a transparent placeholder div to hold the space
    var ensurePlaceholder = function () {
      if (!$placeholder) {
        $placeholder = $(
          '<div class="pea-sticky-placeholder" aria-hidden="true"></div>',
        );
        $el.after($placeholder);
      }
    };

    var makeSticky = function () {
      if (isSticky) return;
      isSticky = true;

      ensurePlaceholder();
      $placeholder.css({
        height: elHeight + "px",
        width: elWidth + "px",
        display: "block",
      });

      $el.addClass("pea-is-sticky");

      var stickyCSS = {
        position: "fixed",
        "z-index": 9999,
        width: elWidth + "px",
        left: $placeholder.offset().left + "px",
      };

      if (position === "top") {
        stickyCSS.top = offset + "px";
        stickyCSS.bottom = "auto";
      } else {
        stickyCSS.bottom = offset + "px";
        stickyCSS.top = "auto";
      }

      // Background change
      if (bgEnable) {
        stickyCSS["background-color"] = bgColor;
        stickyCSS["transition"] =
          "background-color " +
          transition +
          "ms ease, box-shadow " +
          transition +
          "ms ease";
        if (shadowEnable) {
          stickyCSS["box-shadow"] = "0 4px 24px " + shadowColor;
        }
      }

      $el.css(stickyCSS);

      // Entrance animation (play once per sticky activation)
      playEntranceAnimation($el, animation, animDur);
    };

    var makeUnSticky = function () {
      if (!isSticky) return;
      isSticky = false;

      $el.removeClass("pea-is-sticky");
      $el.css({
        position: "",
        top: "",
        bottom: "",
        left: "",
        width: "",
        "z-index": "",
        "background-color": "",
        "box-shadow": "",
        transition: "",
      });

      if ($placeholder) {
        $placeholder.css({ height: 0, display: "none" });
      }
    };

    // ── SCROLL HANDLER ────────────────────────────────────────────────────
    var onScroll = function () {
      var scrollY = window.pageYOffset;
      var vpHeight = window.innerHeight;

      // ── "Sticky Until" stop logic ──
      var shouldStop = false;

      if (untilSel) {
          var $stopEl = $(untilSel);

          if ($stopEl.length && position === "top") {
              var stopTop = $stopEl.offset().top;

              shouldStop = scrollY + offset + elHeight >= stopTop;
          }
      }

      // ── Top position ──
      if (position === "top") {
        if (scrollY + offset >= elNaturalTop && !shouldStop) {
            makeSticky();
        } else {
            makeUnSticky();
        }
        return;
      }

      // ── Bottom position ──
      if (position === "bottom") {
        // Stick when the element's natural bottom is scrolled out of viewport
        if (scrollY + vpHeight <= elNaturalBottom) {
          makeSticky();
        } else {
          makeUnSticky();
        }
      }
    };

    // ── RESIZE HANDLER ────────────────────────────────────────────────────
    var onResize = function () {
      makeUnSticky();
      cacheNaturalMetrics();

      // Re-check device
      var newDevice = getDevice();
      if (newDevice === "desktop" && !cfg.desktop) return;
      if (newDevice === "tablet" && !cfg.tablet) return;
      if (newDevice === "mobile" && !cfg.mobile) return;

      onScroll();
    };

    // ── INIT ─────────────────────────────────────────────────────────────
    cacheNaturalMetrics();

    // Use passive listeners for performance
    window.addEventListener("scroll", onScroll, { passive: true });
    window.addEventListener("resize", debounce(onResize, 150), {
      passive: true,
    });

    // Run once on init in case page loads already scrolled
    onScroll();
  };

  // ─────────────────────────────────────────────────────────────────────────
  // DEBOUNCE UTILITY
  // ─────────────────────────────────────────────────────────────────────────
  var debounce = function (fn, delay) {
    var timer;
    return function () {
      clearTimeout(timer);
      timer = setTimeout(fn, delay);
    };
  };

  // ─────────────────────────────────────────────────────────────────────────
  // ELEMENTOR FRONTEND INIT
  // Init sticky on sections, columns, and containers
  // ─────────────────────────────────────────────────────────────────────────
  var initAllStickyElements = function ($scope) {
    // The scope itself might be a sticky element
    if ($scope.is("[data-pea-sticky]")) {
      PeaStickyHandler($scope);
    }
    // Or it contains sticky elements
    $scope.find("[data-pea-sticky]").each(function () {
      PeaStickyHandler($(this));
    });
  };

  $(window).on("elementor/frontend/init", function () {
    // Section
    elementorFrontend.hooks.addAction(
      "frontend/element_ready/section",
      initAllStickyElements,
    );
    // Column
    elementorFrontend.hooks.addAction(
      "frontend/element_ready/column",
      initAllStickyElements,
    );
    // Container (Flexbox / Grid)
    elementorFrontend.hooks.addAction(
      "frontend/element_ready/container",
      initAllStickyElements,
    );
  });

  // Also init on DOMContentLoaded for non-widget page loads
  $(document).ready(function () {
    $("[data-pea-sticky]").each(function () {
      PeaStickyHandler($(this));
    });
  });
})(jQuery);
