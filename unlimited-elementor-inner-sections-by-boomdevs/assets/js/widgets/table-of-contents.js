(function ($) {
  $(window).on("elementor/frontend/init", function () {
    var elementorFrontend = window.elementorFrontend;

    elementorFrontend.hooks.addAction(
      "frontend/element_ready/pea_table_of_contents.default",
      TableOfContents
    );
  });

  function TableOfContents($scope) {
    var $widget = $scope.find(".pea-table-of-contents").first();
    var $list = $widget.find(".pea-table-of-contents__list");
    var $empty = $widget.find(".pea-table-of-contents__empty");
    var $root = $scope.closest(".elementor");
    var htmlTags = getHtmlTags($widget.data("html-tags"));
    var excludeSelectors = getSelectors($widget.data("exclude-selectors"));
    var selector = htmlTags.join(",");
    var smoothScroll = $widget.data("smooth-scroll") === "yes";
    var markerView = $widget.data("marker-view") || "disc";
    var markerIconHtml = $.trim(
      $widget.find(".pea-table-of-contents__marker-template").html() || ""
    );
    var minimizedOn = getMinimizedBreakpoints($widget.data("minimized-on"));
    var hierarchicalView = $widget.data("hierarchical-view") !== "no";
    var collapseSubitems = hierarchicalView && $widget.data("collapse-subitems") === "yes";
    var noHeadingsMessage = $.trim($widget.data("no-headings-message") || "");

    if (!$widget.length || !$list.length) {
      return;
    }

    renderTableOfContents();
    bindAutoRefresh($widget, $root, selector, renderTableOfContents);

    function renderTableOfContents() {
      var usedIds = {};
      var items = [];

      $widget.addClass("pea-table-of-contents--is-loading");
      $widget.removeClass("pea-table-of-contents--is-empty");

      if (!selector || !$root.length) {
        showEmptyState($widget, $list, $empty, noHeadingsMessage);
        return;
      }

      $list.empty();
      $empty.empty();

      $root.find(selector).each(function () {
        var $heading = $(this);
        var text = $.trim($heading.text());
        var headingId = $heading.attr("id");
        var generatedId = headingId || createSlug(text);

        if (
          !text ||
          $heading.closest(".pea-table-of-contents").length ||
          isExcludedHeading($heading, excludeSelectors)
        ) {
          return;
        }

        if (!headingId) {
          headingId = getUniqueId(generatedId, usedIds);
          $heading.attr("id", headingId);
        } else if (usedIds[headingId]) {
          headingId = getUniqueId(generatedId, usedIds);
          $heading.attr("id", headingId);
        }

        usedIds[headingId] = true;

        items.push({
          id: headingId,
          text: text,
          rank: getItemRank(this),
        });
      });

      if (!items.length) {
        showEmptyState($widget, $list, $empty, noHeadingsMessage);
        return;
      }

      $widget.show();
      renderItems(
        getRenderableItems(items, hierarchicalView),
        $list,
        markerView,
        collapseSubitems,
        markerIconHtml
      );
      $widget.removeClass("pea-table-of-contents--is-loading");
      $widget.removeClass("pea-table-of-contents--is-empty");

      bindCollapseToggle($widget);
      bindResponsiveMinimizedState($widget, minimizedOn);
      bindSubitemToggle($widget, collapseSubitems);
      bindSlideoutMarkers($widget, items);
      bindSmoothScroll($list, smoothScroll);
      bindStickyPosition($widget, $scope);
      bindActiveSection($widget, items, $scope, collapseSubitems);
    }
  }

  function showEmptyState($widget, $list, $empty, message) {
    $widget.show();
    $widget.removeClass("pea-table-of-contents--is-loading").addClass("pea-table-of-contents--is-empty");
    $list.empty();

    if ($empty.length) {
      $empty.text(message || "No headings found.");
    }
  }

  function getHtmlTags(htmlTags) {
    if ($.isArray(htmlTags) && htmlTags.length) {
      return htmlTags;
    }

    return ["h2", "h3"];
  }

  function getSelectors(selectors) {
    if ($.isArray(selectors) && selectors.length) {
      return selectors;
    }

    return [];
  }

  function isExcludedHeading($heading, excludeSelectors) {
    var isExcluded = false;

    if (!excludeSelectors.length) {
      return false;
    }

    $.each(excludeSelectors, function (_, selector) {
      if (!selector) {
        return;
      }

      try {
        if ($heading.is(selector) || $heading.closest(selector).length) {
          isExcluded = true;
          return false;
        }
      } catch (error) {
        return;
      }
    });

    return isExcluded;
  }

  function getMinimizedBreakpoints(minimizedOn) {
    var allowedBreakpoints = ["mobile", "tablet", "desktop"];
    var breakpoints = $.isArray(minimizedOn)
      ? minimizedOn
      : minimizedOn
      ? [minimizedOn]
      : [];

    return $.grep(breakpoints, function (breakpoint) {
      return $.inArray(breakpoint, allowedBreakpoints) !== -1;
    });
  }

  function createSlug(text) {
    var slug = text
      .toLowerCase()
      .replace(/[^a-z0-9]+/g, "-")
      .replace(/^-+|-+$/g, "");

    return slug || "section";
  }

  function getUniqueId(baseId, usedIds) {
    var uniqueId = baseId;
    var count = 2;

    while (usedIds[uniqueId] || document.getElementById(uniqueId)) {
      uniqueId = baseId + "-" + count;
      count++;
    }

    return uniqueId;
  }

  function getItemRank(element) {
    var tagName = (element.tagName || "").toLowerCase();
    var match = tagName.match(/^h([1-6])$/);

    return match ? parseInt(match[1], 10) : 0;
  }

  function buildTree(items) {
    var root = [];
    var stack = [{ rank: -1, children: root }];

    $.each(items, function (_, item) {
      var node = {
        id: item.id,
        text: item.text,
        rank: item.rank,
        children: [],
      };

      while (
        stack.length > 1 &&
        node.rank <= stack[stack.length - 1].rank
      ) {
        stack.pop();
      }

      stack[stack.length - 1].children.push(node);
      stack.push(node);
    });

    return root;
  }

  function getRenderableItems(items, hierarchicalView) {
    if (hierarchicalView) {
      return buildTree(items);
    }

    return $.map(items, function (item) {
      return {
        id: item.id,
        text: item.text,
        rank: item.rank,
        children: [],
      };
    });
  }

  function renderItems(items, $list, markerView, collapseSubitems, markerIconHtml) {
    $.each(items, function (_, item) {
      var $item = $("<li />", {
        class: "pea-table-of-contents__item",
      });
      var $row = $("<div />", {
        class: "pea-table-of-contents__item-row",
      }).appendTo($item);

      if (markerView === "icons" && markerIconHtml) {
        $("<span />", {
          class: "pea-table-of-contents__marker-icon",
          "aria-hidden": "true",
          html: markerIconHtml,
        }).appendTo($row);
      }

      $("<a />", {
        class: "pea-table-of-contents__link",
        href: "#" + item.id,
        text: item.text,
      }).appendTo($row);

      if (item.children.length) {
        $item.addClass("pea-table-of-contents__item--has-children");

        if (collapseSubitems) {
          $item.addClass("pea-table-of-contents__item--subitems-collapsed");

          $("<button />", {
            type: "button",
            class: "pea-table-of-contents__subtoggle",
            "aria-expanded": "false",
            "aria-label": "Toggle subitems",
          }).append(
            $("<span />", {
              class: "pea-table-of-contents__subtoggle-icon pea-table-of-contents__subtoggle-icon--expand",
              "aria-hidden": "true",
              html: "+",
            }),
            $("<span />", {
              class: "pea-table-of-contents__subtoggle-icon pea-table-of-contents__subtoggle-icon--collapse",
              "aria-hidden": "true",
              html: "-",
            })
          ).appendTo($row);
        }

        var $sublist = createSublist(markerView);

        renderItems(
          item.children,
          $sublist,
          markerView,
          collapseSubitems,
          markerIconHtml
        );
        $item.append($sublist);
      }

      $list.append($item);
    });
  }

  function createSublist(markerView) {
    var tag = markerView === "decimal" ? "ol" : "ul";

    return $("<" + tag + " />", {
      class:
        "pea-table-of-contents__sublist pea-table-of-contents__sublist--" +
        markerView,
    });
  }

  function bindSmoothScroll($list, smoothScroll) {
    $list.off("click.peaTableOfContents");

    if (!smoothScroll) {
      return;
    }

    $list.on("click.peaTableOfContents", "a", function (event) {
      var targetId = $(this).attr("href");

      if (!targetId || targetId.charAt(0) !== "#") {
        return;
      }

      var $target = $(targetId);

      if (!$target.length) {
        return;
      }

      event.preventDefault();
      window.scrollTo({
        top: Math.max($target.offset().top - getViewportOffset($(window)), 0),
        behavior: "smooth",
      });
      window.history.pushState(null, "", targetId);
    });
  }

  function getViewportOffset($window) {
    return Math.max($window.height() * 0.1, 100);
  }

  function bindAutoRefresh($widget, $root, selector, renderTableOfContents) {
    var observer = $widget.data("peaTocObserver");
    var refreshTimer = null;

    if (observer) {
      observer.disconnect();
    }

    if (!selector || !$root.length || !$root[0] || typeof MutationObserver === "undefined") {
      return;
    }

    observer = new MutationObserver(function (mutations) {
      var shouldRefresh = false;

      $.each(mutations, function (_, mutation) {
        if (isWidgetMutation($widget, mutation.target)) {
          return;
        }

        if (
          mutation.type === "characterData" ||
          hasMatchingNodes($widget, selector, mutation.addedNodes) ||
          hasMatchingNodes($widget, selector, mutation.removedNodes)
        ) {
          shouldRefresh = true;
          return false;
        }
      });

      if (!shouldRefresh) {
        return;
      }

      window.clearTimeout(refreshTimer);
      refreshTimer = window.setTimeout(function () {
        if ($widget.length && document.body.contains($widget[0])) {
          renderTableOfContents();
        }
      }, 120);
    });

    observer.observe($root[0], {
      childList: true,
      subtree: true,
      characterData: true,
    });

    $widget.data("peaTocObserver", observer);
  }

  function isWidgetMutation($widget, target) {
    return target && ($(target).closest(".pea-table-of-contents")[0] === $widget[0]);
  }

  function hasMatchingNodes($widget, selector, nodes) {
    var hasMatch = false;

    $.each(nodes || [], function (_, node) {
      if (!node || node.nodeType !== 1 || isWidgetMutation($widget, node)) {
        return;
      }

      if (node.matches(selector) || $(node).find(selector).length) {
        hasMatch = true;
        return false;
      }
    });

    return hasMatch;
  }

  function bindSlideoutMarkers($widget, items) {
    var $markers = $widget.find(".pea-table-of-contents__slideout-markers");

    if (!$markers.length) {
      return;
    }

    $markers.empty();

    $.each(items, function (_, item) {
      $("<span />", {
        class: "pea-table-of-contents__slideout-marker",
        "data-target-id": item.id,
      }).appendTo($markers);
    });
  }

  function bindCollapseToggle($widget) {
    var $toggle = $widget.find(".pea-table-of-contents__toggle");

    if (!$toggle.length || $widget.data("collapsible-toc") !== "yes") {
      return;
    }

    $toggle.off("click.peaTableOfContents").on("click.peaTableOfContents", function () {
      var isCollapsed = $widget.toggleClass("pea-table-of-contents--is-collapsed").hasClass("pea-table-of-contents--is-collapsed");

      $(this).attr("aria-expanded", isCollapsed ? "false" : "true");
    });
  }

  function shouldMinimizeOn(minimizedOn) {
    var viewportWidth = window.innerWidth || document.documentElement.clientWidth || 0;

    return $.inArray("desktop", minimizedOn) !== -1 ||
      ($.inArray("tablet", minimizedOn) !== -1 && viewportWidth < 1024) ||
      ($.inArray("mobile", minimizedOn) !== -1 && viewportWidth < 767);
  }

  function bindResponsiveMinimizedState($widget, minimizedOn) {
    var $toggle = $widget.find(".pea-table-of-contents__toggle");
    var namespace = ".peaTableOfContentsMinimized-" + ($widget.closest("[data-id]").data("id") || "");
    var $window = $(window);
    var lastAutoMinimizedState = null;

    if (!$toggle.length || $widget.data("collapsible-toc") !== "yes" || !minimizedOn.length) {
      return;
    }

    function syncResponsiveMinimizedState() {
      var shouldCollapse = shouldMinimizeOn(minimizedOn);

      if (lastAutoMinimizedState === shouldCollapse) {
        return;
      }

      lastAutoMinimizedState = shouldCollapse;

      $widget.toggleClass("pea-table-of-contents--is-collapsed", shouldCollapse);
      $toggle.attr("aria-expanded", shouldCollapse ? "false" : "true");
    }

    $window.off(namespace).on("resize" + namespace, syncResponsiveMinimizedState);

    syncResponsiveMinimizedState();
  }

  function bindSubitemToggle($widget, collapseSubitems) {
    var $subtoggles = $widget.find(".pea-table-of-contents__subtoggle");

    $subtoggles.off("click.peaTableOfContents");

    if (!collapseSubitems || !$subtoggles.length) {
      return;
    }

    $subtoggles.on("click.peaTableOfContents", function () {
      var $item = $(this).closest(".pea-table-of-contents__item");
      var isCollapsed = $item.toggleClass("pea-table-of-contents__item--subitems-collapsed").hasClass("pea-table-of-contents__item--subitems-collapsed");

      $(this).attr("aria-expanded", isCollapsed ? "false" : "true");
    });
  }

  function expandActiveBranch($widget, activeId, collapseSubitems) {
    if (!collapseSubitems || !activeId) {
      return;
    }

    var $activeLink = $widget.find('.pea-table-of-contents__link[href="#' + activeId + '"]');

    if (!$activeLink.length) {
      return;
    }

    $activeLink.parents(".pea-table-of-contents__item--has-children").each(function () {
      var $item = $(this);

      $item.removeClass("pea-table-of-contents__item--subitems-collapsed");
      $item.children(".pea-table-of-contents__item-row").find(".pea-table-of-contents__subtoggle").attr("aria-expanded", "true");
    });
  }

  function bindActiveSection($widget, items, $scope, collapseSubitems) {
    var ids = $.map(items, function (item) {
      return item.id;
    });

    if (!ids.length) {
      return;
    }

    var namespace = ".peaTableOfContentsActive-" + ($scope.data("id") || "");
    var $window = $(window);
    var ticking = false;

    function syncActiveSection() {
      ticking = false;

      var scrollTop = $window.scrollTop();
      var viewportOffset = scrollTop + getViewportOffset($window);
      var viewportHeight = $window.height();
      var activeId = "";
      var visibleId = "";

      $.each(ids, function (_, id) {
        var element = document.getElementById(id);
        var rect;

        if (!element) {
          return false;
        }

        rect = element.getBoundingClientRect();

        if (!visibleId && rect.top >= 0 && rect.top <= viewportHeight) {
          visibleId = id;
        }

        if ($(element).offset().top > viewportOffset) {
          return false;
        }

        activeId = id;
      });

      activeId = visibleId || activeId;

      $widget
        .find(".pea-table-of-contents__slideout-marker, .pea-table-of-contents__link")
        .removeClass("is-active");

      $widget
        .find('.pea-table-of-contents__slideout-marker[data-target-id="' + activeId + '"]')
        .addClass("is-active");

      $widget
        .find('.pea-table-of-contents__link[href="#' + activeId + '"]')
        .addClass("is-active");

      expandActiveBranch($widget, activeId, collapseSubitems);
    }

    function requestSync() {
      if (ticking) {
        return;
      }

      ticking = true;
      window.requestAnimationFrame(syncActiveSection);
    }

    $window.off(namespace).on("scroll" + namespace + " resize" + namespace, requestSync);

    requestSync();
  }

  function bindStickyPosition($widget, $scope) {
    if (!$widget.hasClass("pea-table-of-contents--sticky")) {
      return;
    }

    var namespace = ".peaTableOfContentsSticky-" + ($scope.data("id") || "");
    var $window = $(window);
    var $placeholder = $widget.prev(".pea-table-of-contents__sticky-placeholder");
    var stickyPosition = $widget.data("sticky-position") || "top";
    var stickyTopOffset = parseInt($widget.data("sticky-top-offset"), 10);
    var stickyBottomOffset = parseInt($widget.data("sticky-bottom-offset"), 10);
    var ticking = false;
    var lastScrollTop = $window.scrollTop();
    var bothAnchor = "top";

    stickyTopOffset = isNaN(stickyTopOffset)
      ? parseInt($widget.css("--pea-toc-sticky-top-offset"), 10) || 20
      : stickyTopOffset;
    stickyBottomOffset = isNaN(stickyBottomOffset)
      ? parseInt($widget.css("--pea-toc-sticky-bottom-offset"), 10) || 20
      : stickyBottomOffset;

    if (!$placeholder.length) {
      $placeholder = $("<div />", {
        class: "pea-table-of-contents__sticky-placeholder",
        "aria-hidden": "true",
      }).insertBefore($widget);
    }

    function syncStickyState() {
      ticking = false;

      var placeholderTop = $placeholder.offset().top;
      var scrollTop = $window.scrollTop();
      var viewportHeight = $window.height();
      var widgetHeight = $widget.outerHeight();
      var shouldFixTop = scrollTop + stickyTopOffset > placeholderTop;
      var shouldFixBottom = scrollTop + viewportHeight - stickyBottomOffset < placeholderTop + widgetHeight;
      var shouldFix = shouldFixTop;
      var stickyTopValue = "top" === stickyPosition ? stickyTopOffset + "px" : "auto";
      var stickyBottomValue = "bottom" === stickyPosition ? stickyBottomOffset + "px" : "auto";

      if ("bottom" === stickyPosition) {
        shouldFix = shouldFixBottom;
      } else if ("both" === stickyPosition) {
        shouldFix = shouldFixTop || shouldFixBottom;

        if (shouldFixBottom && !shouldFixTop) {
          bothAnchor = "bottom";
        } else if (shouldFixTop && !shouldFixBottom) {
          bothAnchor = "top";
        } else if (scrollTop > lastScrollTop) {
          bothAnchor = "top";
        } else if (scrollTop < lastScrollTop) {
          bothAnchor = "bottom";
        }

        stickyTopValue = "top" === bothAnchor ? stickyTopOffset + "px" : "auto";
        stickyBottomValue = "bottom" === bothAnchor ? stickyBottomOffset + "px" : "auto";
      }

      if (!shouldFix) {
        $widget.removeClass("pea-table-of-contents--is-fixed").css({
          "--pea-toc-sticky-left": "",
          "--pea-toc-sticky-top": "",
          "--pea-toc-sticky-bottom": "",
          "--pea-toc-sticky-width": "",
          "--pea-toc-sticky-max-height": "",
          "--pea-toc-sticky-overflow-y": "",
        });
        $placeholder.height(0);
        lastScrollTop = scrollTop;
        return;
      }

      var rect = $placeholder[0].getBoundingClientRect();

      $widget.addClass("pea-table-of-contents--is-fixed").css({
        "--pea-toc-sticky-left": rect.left + "px",
        "--pea-toc-sticky-top": stickyTopValue,
        "--pea-toc-sticky-bottom": stickyBottomValue,
        "--pea-toc-sticky-width": rect.width + "px",
        "--pea-toc-sticky-max-height": "both" === stickyPosition ? Math.max(viewportHeight - stickyTopOffset - stickyBottomOffset, 0) + "px" : "",
        "--pea-toc-sticky-overflow-y": "both" === stickyPosition ? "auto" : "",
      });
      $placeholder.height(widgetHeight);
      lastScrollTop = scrollTop;
    }

    function requestSync() {
      if (ticking) {
        return;
      }

      ticking = true;
      window.requestAnimationFrame(syncStickyState);
    }

    $window.off(namespace).on("scroll" + namespace + " resize" + namespace, requestSync);

    requestSync();
  }
})(jQuery);
