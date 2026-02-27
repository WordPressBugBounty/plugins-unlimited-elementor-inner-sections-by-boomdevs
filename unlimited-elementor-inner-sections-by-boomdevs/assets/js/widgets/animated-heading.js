(function ($) {
  function AnimatedHeadingHandler(wrapper) {
    if (wrapper.data("pea-init")) return;
    wrapper.data("pea-init", true);

    var items = wrapper.find(".pea-animated-heading-animation-item");
    var animationType = wrapper.data("animation");
    var current = 0;

    if (!items.length) return;

    items.hide();
    items.eq(0).show();

    if (animationType === "Typing") {
      function typeEffect(element, text, i = 0, callback) {
        if (i < text.length) {
          element.text(text.substring(0, i + 1));
          setTimeout(function () {
            typeEffect(element, text, i + 1, callback);
          }, 100);
        } else {
          if (callback) callback();
        }
      }

      function deleteEffect(element, text, i = text.length, callback) {
        if (i >= 0) {
          element.text(text.substring(0, i));
          setTimeout(function () {
            deleteEffect(element, text, i - 1, callback);
          }, 50);
        } else {
          if (callback) callback();
        }
      }

      function startTypingLoop() {
        var element = items.eq(current);
        var text = element.data("text") || element.text();

        element.show();

        typeEffect(element, text, 0, function () {
          setTimeout(function () {
            deleteEffect(element, text, text.length, function () {
              element.hide();
              current = (current + 1) % items.length;
              startTypingLoop();
            });
          }, 1000);
        });
      }

      items.each(function () {
        var $this = $(this);
        $this.data("text", $this.text());
        $this.text("");
      });

      startTypingLoop();
    }

    if (animationType === "Fade-in") {
      items.eq(current).show();

      setInterval(function () {
        var nextIndex = (current + 1) % items.length;

        items.eq(current).fadeOut(800, function () {
          items.eq(nextIndex).fadeIn(800);
          current = nextIndex;
        });
      }, 2000);
    }

    if (animationType === "FlipWave") {
      wrapper.css({
        position: "relative",
        perspective: "1000px",
      });

      items.hide();

      function splitLetters(element) {
        var text = element.text();
        element.empty();

        var letters = [];

        for (let i = 0; i < text.length; i++) {
          var char = text[i] === " " ? "&nbsp;" : text[i];
          var span = $("<span>" + char + "</span>");
          span.css({
            display: "inline-block",
            transform: "rotateX(90deg)",
            transformOrigin: "bottom",
            transition: "transform 0.4s ease, opacity 0.4s ease",
            opacity: "0",
          });

          element.append(span);
          letters.push(span);
        }

        return letters;
      }

      function animateLettersIn(letters, callback) {
        letters.forEach(function (letter, index) {
          setTimeout(function () {
            letter.css({
              transform: "rotateX(0deg)",
              opacity: "1",
            });
          }, index * 80);
        });

        setTimeout(callback, letters.length * 80 + 500);
      }

      function animateLettersOut(letters, callback) {
        letters.forEach(function (letter, index) {
          setTimeout(function () {
            letter.css({
              transform: "rotateX(-90deg)",
              opacity: "0",
            });
          }, index * 60);
        });

        setTimeout(callback, letters.length * 60 + 500);
      }

      var current = 0;

      function startLoop() {
        var currentItem = items.eq(current);
        currentItem.show();

        var letters = splitLetters(currentItem);

        animateLettersIn(letters, function () {
          setTimeout(function () {
            animateLettersOut(letters, function () {
              currentItem.hide().text(currentItem.data("original-text"));

              current = (current + 1) % items.length;

              startLoop();
            });
          }, 1000);
        });
      }

      items.each(function () {
        var $this = $(this);
        $this.data("original-text", $this.text());
      });

      startLoop();
    }

    if (animationType === "Swirl") {
      wrapper.addClass("pea-animated-heading-swirl-main-wrapper");

      var items = wrapper.find(".pea-animated-heading-animation-item");
      items.hide();

      function splitSwirlLetters(element) {
        var text = element.text();
        element.empty();
        var letters = [];

        var innerWrapper = $(
          '<span class="pea-animated-heading-dynamic-text"></span>',
        );
        element.append(innerWrapper);
        for (let i = 0; i < text.length; i++) {
          var char = text[i] === " " ? "&nbsp;" : text[i];
          var span = $(
            '<span class="pea-animated-heading-dynamic-letter">' +
            char +
            "</span>",
          );
          innerWrapper.append(span);
          letters.push(span);
        }
        return { letters: letters, innerWrapper: innerWrapper };
      }

      var current = 0;

      function startSwirlLoop() {
        var currentItem = items.eq(current);
        currentItem.show();

        var result = splitSwirlLetters(currentItem);
        var letters = result.letters;

        letters.forEach(function (letter, index) {
          setTimeout(function () {
            letter.addClass("pea-animated-heading-animation-in");
          }, index * 30);
        });

        setTimeout(function () {
          letters.forEach(function (letter, index) {
            setTimeout(function () {
              letter.addClass("pea-animated-heading-animation-out");
            }, index * 30);
          });

          setTimeout(function () {
            currentItem.hide().text(currentItem.data("original-text"));
            current = (current + 1) % items.length;
            startSwirlLoop();
          }, letters.length * 30 + 500);
        }, 3000);
      }

      items.each(function () {
        var $this = $(this);
        $this.data("original-text", $this.text());
      });

      startSwirlLoop();
    }
  }

  $(document).ready(function () {
    $(".pea-animated-heading-wrapper").each(function () {
      AnimatedHeadingHandler($(this));
    });
  });

  $(window).on("elementor/frontend/init", function () {
    elementorFrontend.hooks.addAction(
      "frontend/element_ready/animated-heading.default",
      function ($scope) {
        var wrapper = $scope.find(".pea-animated-heading-wrapper");
        AnimatedHeadingHandler(wrapper);
      },
    );
  });
})(jQuery);