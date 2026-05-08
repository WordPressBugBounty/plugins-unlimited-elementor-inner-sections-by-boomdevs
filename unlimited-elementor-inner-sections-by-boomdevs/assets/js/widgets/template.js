/**
 * Editor behaviour:
 *  1. Watches the template_id SELECT2 control for changes
 *  2. When a template is selected:
 *     - Updates the "Edit Template" button href to the Elementor editor URL
 *     - Shows the button
 *  3. When template is cleared → hides the button
 *
 * The SELECT2 search is already handled natively by Elementor's SELECT2
 * control — we just hook into its change event.
 *
 * Also registers an AJAX-backed search for the template select so users
 * can search by typing (Elementor SELECT2 supports this natively when
 * options are pre-loaded; for very large libraries we use the AJAX handler
 * registered in PHP).
 */

(function ($) {
  "use strict";

  // ─────────────────────────────────────────────────────────────────────────
  // EDITOR LOGIC
  // ─────────────────────────────────────────────────────────────────────────
  if (window.elementor) {
    $(window).on("elementor:init", function () {
      /**
       * Init the template widget panel behaviour for a given panel/model.
       */
      var initTemplatePanel = function (panel, model) {
        // Small delay to let Elementor finish rendering the panel controls
        setTimeout(function () {
          updateEditButton(model);
        }, 150);

        // Watch for template_id changes
        model.off("change:settings", null, "pea-template");
        model.on(
          "change:settings",
          function () {
            updateEditButton(model);
          },
          "pea-template",
        );
      };

      /**
       * Build the Elementor editor URL for a given post ID.
       */
      var getEditorUrl = function (postId) {
        // Use the admin URL pattern Elementor uses
        return (
          (window.peaTemplateWidgetData && window.peaTemplateWidgetData.adminUrl
            ? window.peaTemplateWidgetData.adminUrl
            : "/wp-admin/") +
          "post.php?post=" +
          postId +
          "&action=elementor"
        );
      };

      /**
       * Update the "Edit Template" button in the panel:
       *  - Sets correct href with the template's editor URL
       *  - Shows/hides the button based on whether a template is selected
       */
      var updateEditButton = function (model) {
        var templateId = model.getSetting("template_id");
        var $btn = $(".pea-edit-template-btn");

        if (!$btn.length) return;

        if (templateId) {
          var url = getEditorUrl(templateId);
          $btn
            .attr("href", url)
            .attr("data-template-id", templateId)
            .closest(".pea-edit-template-wrap")
            .show();
          $btn.parent().show();
        } else {
          $btn.attr("href", "#").attr("data-template-id", "").parent().hide();
        }
      };

      // Hook into widget panel open
      elementor.hooks.addAction(
        "panel/open_editor/widget/pea_template_widget",
        function (panel, model) {
          initTemplatePanel(panel, model);
        },
      );

      // Also re-init when any control changes (catches SELECT2 change)
      elementor.channels.editor.on("change", function () {
        var currentModel =
          elementor.getPanelView &&
          elementor.getPanelView() &&
          elementor.getPanelView().getCurrentPageView &&
          elementor.getPanelView().getCurrentPageView() &&
          elementor.getPanelView().getCurrentPageView().model;

        if (
          currentModel &&
          currentModel.get("widgetType") === "pea_template_widget"
        ) {
          updateEditButton(currentModel);
        }
      });
    });
  }

  // ─────────────────────────────────────────────────────────────────────────
  // FRONTEND INIT (for any frontend JS needs)
  // Currently templates render server-side so no frontend JS is needed,
  // but we hook in case child widgets need re-init after template loads.
  // ─────────────────────────────────────────────────────────────────────────
  $(window).on("elementor/frontend/init", function () {
    elementorFrontend.hooks.addAction(
      "frontend/element_ready/pea_template_widget.default",
      function ($scope) {
        // Re-trigger frontend init for any nested widgets inside the template
        // This ensures widgets like accordions, charts etc. initialise correctly
        // when they are rendered inside a Template Widget.
        $scope.find("[data-widget_type]").each(function () {
          var widgetType = $(this).data("widget_type");
          if (widgetType) {
            elementorFrontend.hooks.doAction(
              "frontend/element_ready/" + widgetType,
              $(this),
              $,
            );
          }
        });
      },
    );
  });
})(jQuery);
