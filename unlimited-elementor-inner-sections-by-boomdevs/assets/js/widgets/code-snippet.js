/**
 * Prime Code Snippet Widget — JavaScript
 * Prime Elementor Addons Pro
 *
 * Features:
 *  - Multi-Tab switching
 *  - Intelligent Copy-to-Clipboard
 *  - Download Button
 *  - Word Wrap Toggle
 *  - Line Numbers Toggle
 *  - Code Folding
 *  - Live Preview (HTML/CSS)
 *  - External File Fetching (GitHub / Gist)
 *  - Syntax Theme Application
 *  - Gradient Border injection
 *  - Prism.js re-highlight on tab switch
 */

(function ($) {
  "use strict";

  /* ============================================================
       Utility Helpers
       ============================================================ */

  /** Map our theme slug → Prism CSS theme filename */
  const PRISM_THEME_MAP = {
    dracula: "prism-dracula.min.css",
    monokai: "prism-okaidia.min.css",
    "oceanic-next": "prism-tomorrow.min.css",
    "one-dark": "prism-one-dark.min.css",
    nord: "prism-nord.min.css",
    "tomorrow-night": "prism-tomorrow.min.css",
    "solarized-dark": "prism-solarized-dark.min.css",
    "solarized-light": "prism-solarized-light-atom.min.css",
    "github-dark": "prism-github-dark.min.css",
    "github-light": "prism-github.min.css",
    "material-dark": "prism-material-dark.min.css",
    "material-light": "prism-material-light.min.css",
    "vs-dark": "prism-vsc-dark-plus.min.css",
    "vs-light": "prism-vs.min.css",
    "atom-dark": "prism-atom-dark.min.css",
    "ayu-dark": "prism-ayu-dark.min.css",
    "ayu-mirage": "prism-ayu-mirage.min.css",
    "night-owl": "prism-night-owl.min.css",
    cobalt: "prism-duotone-sea.min.css",
    twilight: "prism-twilight.min.css",
    zenburn: "prism-cb.min.css",
    "base16-ocean": "prism-base16-ateliersulphurpool.light.min.css",
  };

  /** Language → icon/badge emoji map */
  const LANG_ICONS = {
    html: "🌐",
    css: "🎨",
    javascript: "⚡",
    php: "🐘",
    python: "🐍",
    java: "☕",
    cpp: "⚙",
    c: "🔧",
    typescript: "🔷",
    json: "{}",
    bash: "$_",
    sql: "🗄",
    ruby: "💎",
    go: "🐹",
    rust: "🦀",
    swift: "🦅",
    kotlin: "K",
    yaml: "📄",
    markdown: "MD",
    xml: "</>",
  };

  /** Convert a GitHub URL or Gist URL to a raw content URL */
  function toRawGitHubURL(url) {
    if (!url) return null;

    // GitHub Gist - e.g.: https://gist.github.com/user/abc123
    if (url.includes("gist.github.com")) {
      const parts = url.split("/").filter(Boolean);
      const gistId = parts[parts.length - 1];
      return `https://api.github.com/gists/${gistId}`;
    }

    // Regular GitHub file - convert /blob/ to /raw/
    if (url.includes("github.com") && url.includes("/blob/")) {
      return url
        .replace("github.com", "raw.githubusercontent.com")
        .replace("/blob/", "/");
    }

    // Already raw
    if (url.includes("raw.githubusercontent.com")) {
      return url;
    }

    return null;
  }

  /** Escape HTML special chars */
  function escapeHTML(str) {
    return str
      .replace(/&/g, "&amp;")
      .replace(/</g, "&lt;")
      .replace(/>/g, "&gt;")
      .replace(/"/g, "&quot;");
  }

  /** Re-run Prism on an element */
  function rehighlight($el) {
    if (typeof Prism !== "undefined") {
      // Highlight code elements
      $el.find("pre code").each(function () {
        Prism.highlightElement(this);
      });

      // Re-init line-numbers plugin
      if (Prism.plugins && Prism.plugins.lineNumbers) {
        $el.find("pre.line-numbers").each(function () {
          Prism.plugins.lineNumbers.resize(this);
        });
      }

      // Re-init line-highlight plugin
      if (Prism.plugins && Prism.plugins.lineHighlight) {
        $el.find("pre[data-line]").each(function () {
          // Remove old highlight elements
          $(this).find(".line-highlight").remove();
          // Reinitialize line highlighting
          Prism.plugins.lineHighlight.highlightLines(this);
        });
      }
    }
  }

  /* ============================================================
       Global Event Handlers (Document Level)
       These work even when DOM is dynamically updated
       ============================================================ */

  // Tabs - click anywhere on document
  $(document).on(
    "click",
    ".prime-code-snippet-wrapper .prime-cs-tab",
    function (e) {
      e.preventDefault();
      e.stopPropagation();

      const $tab = $(this);
      const $wrapper = $tab.closest(".prime-code-snippet-wrapper");
      const tabIdx = $tab.data("tab");

      if (!$wrapper.length) return;

      console.log("Code Snippet: Tab clicked - " + tabIdx);

      // Remove active from all tabs and panels
      $wrapper.find(".prime-cs-tab").removeClass("active");
      $wrapper.find(".prime-cs-panel").removeClass("active");

      // Add active to clicked tab
      $tab.addClass("active");

      // Show corresponding panel
      $wrapper
        .find(".prime-cs-panel[data-tab='" + tabIdx + "']")
        .addClass("active");

      // Re-highlight code
      setTimeout(function () {
        const $activePanel = $wrapper.find(".prime-cs-panel.active");
        if ($activePanel.length && typeof Prism !== "undefined") {
          $activePanel.find("pre code").each(function () {
            Prism.highlightElement(this);
          });
          // Re-init line-numbers
          if (Prism.plugins && Prism.plugins.lineNumbers) {
            $activePanel.find("pre.line-numbers").each(function () {
              Prism.plugins.lineNumbers.resize(this);
            });
          }
          // Re-init line-highlight
          if (Prism.plugins && Prism.plugins.lineHighlight) {
            $activePanel.find("pre[data-line]").each(function () {
              $(this).find(".line-highlight").remove();
              Prism.plugins.lineHighlight.highlightLines(this);
            });
          }
        }
      }, 50);
    },
  );

  // Copy button
  $(document).on(
    "click",
    ".prime-code-snippet-wrapper .prime-cs-copy-btn",
    function (e) {
      e.preventDefault();
      e.stopPropagation();

      const $btn = $(this);
      const $wrapper = $btn.closest(".prime-code-snippet-wrapper");
      const $label = $btn.find(".prime-cs-copy-label");

      if (!$wrapper.length) {
        console.warn("Code Snippet: Wrapper not found for copy button");
        return;
      }

      let $activePanel = $wrapper.find(".prime-cs-panel.active");
      if (!$activePanel.length) {
        $activePanel = $wrapper.find(".prime-cs-panel").first();
      }

      const codeText = $activePanel.find("code").text();
      if (!codeText) {
        console.warn("Code Snippet: No code found to copy");
        return;
      }

      const copyText = $wrapper.data("copy-text") || "Copy";
      const copiedText = $wrapper.data("copied-text") || "Copied!";

      // Helper for fallback copy when Clipboard API is unavailable
      const doFallbackCopy = () => {
        const $tmp = $("<textarea/>")
          .css({ position: "fixed", opacity: 0 })
          .val(codeText)
          .appendTo("body");
        $tmp[0].select();
        try {
          document.execCommand("copy");
          $btn.addClass("prime-copied");
          if ($label.length) $label.text(copiedText);

          setTimeout(function () {
            $btn.removeClass("prime-copied");
            if ($label.length) $label.text(copyText);
          }, 2200);
        } catch (e) {
          console.error("Code Snippet: Copy failed:", e);
        } finally {
          $tmp.remove();
        }
      };

      // Safety check: if navigator.clipboard is undefined (non-secure context), use fallback immediately
      if (!navigator.clipboard || !navigator.clipboard.writeText) {
        doFallbackCopy();
        return;
      }

      navigator.clipboard
        .writeText(codeText)
        .then(function () {
          $btn.addClass("prime-copied");
          if ($label.length) $label.text(copiedText);

          setTimeout(function () {
            $btn.removeClass("prime-copied");
            if ($label.length) $label.text(copyText);
          }, 2200);
        })
        .catch(function (err) {
          console.warn(
            "Code Snippet: Clipboard API failed, using fallback...",
            err,
          );
          doFallbackCopy();
        });
    },
  );

  // Download button
  $(document).on(
    "click",
    ".prime-code-snippet-wrapper .prime-cs-download-btn",
    function (e) {
      e.preventDefault();
      e.stopPropagation();

      const $btn = $(this);
      const $wrapper = $btn.closest(".prime-code-snippet-wrapper");

      if (!$wrapper.length) {
        console.warn("Code Snippet: Wrapper not found for download button");
        return;
      }

      let $activePanel = $wrapper.find(".prime-cs-panel.active");
      if (!$activePanel.length) {
        $activePanel = $wrapper.find(".prime-cs-panel").first();
      }

      const filename = $activePanel.data("filename") || "code.txt";
      const codeText = $activePanel.find("code").text();

      if (!codeText) {
        console.warn("Code Snippet: No code found to download");
        return;
      }

      // Get MIME type
      const ext = filename.split(".").pop().toLowerCase();
      const mimeMap = {
        js: "application/javascript",
        css: "text/css",
        html: "text/html",
        php: "application/x-php",
        json: "application/json",
        xml: "application/xml",
        py: "text/x-python",
        rb: "text/x-ruby",
        go: "text/x-go",
        rs: "text/x-rust",
        sh: "text/x-shellscript",
        sql: "text/x-sql",
        md: "text/markdown",
        yml: "text/yaml",
        yaml: "text/yaml",
      };
      const mimeType = mimeMap[ext] || "text/plain";

      const blob = new Blob([codeText], { type: mimeType });
      const url = URL.createObjectURL(blob);
      const link = document.createElement("a");
      link.href = url;
      link.download = filename;
      document.body.appendChild(link);
      link.click();
      document.body.removeChild(link);
      URL.revokeObjectURL(url);
    },
  );

  // Word Wrap button
  $(document).on(
    "click",
    ".prime-code-snippet-wrapper .prime-cs-wrap-btn",
    function (e) {
      e.preventDefault();
      e.stopPropagation();

      const $btn = $(this);
      const $wrapper = $btn.closest(".prime-code-snippet-wrapper");

      if (!$wrapper.length) return;

      $wrapper.toggleClass("prime-word-wrap");
      $btn.toggleClass("prime-wrap-active");
    },
  );

  // Refresh button
  $(document).on(
    "click",
    ".prime-code-snippet-wrapper .prime-cs-refresh-btn",
    function (e) {
      e.preventDefault();
      e.stopPropagation();

      const $btn = $(this);
      const $wrapper = $btn.closest(".prime-code-snippet-wrapper");

      if (!$wrapper.length) return;

      let $activePanel = $wrapper.find(".prime-cs-panel.active");
      if (!$activePanel.length)
        $activePanel = $wrapper.find(".prime-cs-panel").first();

      const githubUrl = $activePanel.data("github-url");
      if (!githubUrl) {
        console.warn("No GitHub URL found");
        return;
      }

      const rawURL = toRawGitHubURL(githubUrl);
      if (!rawURL) {
        console.warn("Code Snippet: Invalid GitHub URL");
        return;
      }

      const $codeWrap = $activePanel.find(".prime-cs-code-wrap");
      const $pre = $activePanel.find("pre");
      const $code = $activePanel.find("code");

      $codeWrap.html(
        '<div class="prime-cs-fetching" style="padding: 20px; text-align: center;">' +
          '<div class="prime-cs-spinner" style="width: 20px; height: 20px; border: 2px solid rgba(124,58,237,0.3); border-top-color: #7c3aed; border-radius: 50%; margin: 0 auto 10px; animation: spin 1s linear infinite;"></div>' +
          "<span>Fetching code...</span></div>",
      );

      const isGistAPI = rawURL.includes("api.github.com/gists/");

      fetch(rawURL)
        .then(function (res) {
          if (!res.ok) throw new Error("HTTP " + res.status);
          return res.json ? (isGistAPI ? res.json() : res.text()) : res.text();
        })
        .then(function (data) {
          let codeContent = "";

          if (isGistAPI) {
            const files = data.files;
            const firstFile = Object.values(files)[0];
            codeContent = firstFile ? firstFile.content : "";
          } else {
            codeContent = data;
          }

          const lang = $code.attr("class") || "language-markup";
          const hlLines = $pre.attr("data-line") || "";
          const lineNumsClass =
            $wrapper.data("line-numbers") == "1" ? " line-numbers" : "";

          $codeWrap.html(
            `<pre class="${lang.replace("language-", "")}${lineNumsClass}"${
              hlLines ? ` data-line="${hlLines}"` : ""
            }>` +
              `<code class="${lang}">${escapeHTML(codeContent)}</code></pre>`,
          );

          rehighlight($activePanel);
        })
        .catch(function (err) {
          $codeWrap.html(
            `<div class="prime-cs-fetch-error" style="padding: 20px; color: #ff6b6b;">` +
              `<span>⚠️</span> <span>Failed to refresh code: ${err.message}</span></div>`,
          );
        });
    },
  );

  function initWidget($wrapper) {
    if (!$wrapper || !$wrapper.length) {
      return;
    }

    if ($wrapper.data("prime-cs-inited")) {
      return;
    }

    $wrapper.data("prime-cs-inited", true);

    const theme = $wrapper.data("theme") || "dracula";
    const maxHeight = parseInt($wrapper.data("max-height")) || 400;
    const lineNums = $wrapper.data("line-numbers") == "1";
    const wordWrap = $wrapper.data("word-wrap") == "1";
    const folding = $wrapper.data("folding") == "1";
    const livePreview = $wrapper.data("live-preview") == "1";
    const copyText = $wrapper.data("copy-text") || "Copy";
    const copiedText = $wrapper.data("copied-text") || "Copied!";
    const gradBorder = $wrapper.data("grad-border") == "1";
    const gradColor1 = $wrapper.data("grad-color1") || "#7c3aed";
    const gradColor2 = $wrapper.data("grad-color2") || "#06b6d4";
    const gradWidth = parseInt($wrapper.data("grad-width")) || 2;

    /* ---- Load Dynamic Prism Theme CSS ---- */
    const themeFile = PRISM_THEME_MAP[theme] || "prism-dracula.min.css";
    const themeURL =
      "https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/" + themeFile;

    // Check if this theme CSS is already loaded
    if (!document.querySelector(`link[href="${themeURL}"]`)) {
      const link = document.createElement("link");
      link.rel = "stylesheet";
      link.href = themeURL;
      document.head.appendChild(link);
    }

    /* ---- Gradient Border ---- */
    if (gradBorder) {
      $wrapper.addClass("prime-gradient-border");
      $wrapper.css({
        "--prime-grad-width": gradWidth + "px",
        "--prime-grad-bg": `linear-gradient(135deg, ${gradColor1}, ${gradColor2})`,
      });
    }

    /* ---- Set max height on all code wraps ---- */
    $wrapper.find(".prime-cs-code-wrap").css("max-height", maxHeight + "px");

    /* ---- Apply word wrap state ---- */
    if (wordWrap) {
      $wrapper.addClass("prime-word-wrap");
      $wrapper.find(".prime-cs-wrap-btn").addClass("prime-wrap-active");
    }

    /* ---- Show Refresh Button if GitHub URLs exist ---- */
    const hasGitHub =
      $wrapper.find(".prime-cs-panel[data-github-url]").length > 0;
    if (hasGitHub) {
      $wrapper.find(".prime-cs-refresh-btn").show();
    }

    /* ---- Fetch External GitHub/Gist files ---- */
    $wrapper.find(".prime-cs-panel[data-github-url]").each(function () {
      const $panel = $(this);
      const githubUrl = $panel.data("github-url");
      if (!githubUrl) return;

      const rawURL = toRawGitHubURL(githubUrl);
      if (!rawURL) return;

      const $codeWrap = $panel.find(".prime-cs-code-wrap");
      const $pre = $panel.find("pre");
      const $code = $panel.find("code");

      // Show loading indicator
      $codeWrap.html(
        '<div class="prime-cs-fetching">' +
          '<div class="prime-cs-spinner"></div>' +
          "<span>Fetching code...</span></div>",
      );

      // Is it a Gist API call?
      const isGistAPI = rawURL.includes("api.github.com/gists/");

      fetch(rawURL)
        .then(function (res) {
          if (!res.ok) throw new Error("HTTP " + res.status);
          return res.json ? (isGistAPI ? res.json() : res.text()) : res.text();
        })
        .then(function (data) {
          let codeContent = "";

          if (isGistAPI) {
            // Grab first file from gist
            const files = data.files;
            const firstFile = Object.values(files)[0];
            codeContent = firstFile ? firstFile.content : "";
          } else {
            codeContent = data;
          }

          // Rebuild the pre/code elements
          const lang = $panel.find("code").attr("class") || "language-markup";
          const hlLines = $pre.attr("data-line") || "";
          const lineNumsClass = lineNums ? " line-numbers" : "";

          $codeWrap.html(
            `<pre class="${lang.replace("language-", "")}${lineNumsClass}"${
              hlLines ? ` data-line="${hlLines}"` : ""
            }>` +
              `<code class="${lang}">${escapeHTML(codeContent)}</code></pre>`,
          );

          rehighlight($panel);
          if (livePreview) updateLivePreview($panel);
        })
        .catch(function (err) {
          $codeWrap.html(
            `<div class="prime-cs-fetch-error">` +
              `<span>⚠️</span><span>Failed to fetch code: ${err.message}</span></div>`,
          );
        });
    });

    /* ---- Run initial Prism highlight ---- */
    rehighlight($wrapper);

    /* ---- Verify buttons exist before attaching handlers ---- */
    const hasCopyBtn = $wrapper.find(".prime-cs-copy-btn").length > 0;
    const hasDownloadBtn = $wrapper.find(".prime-cs-download-btn").length > 0;
    const hasWrapBtn = $wrapper.find(".prime-cs-wrap-btn").length > 0;
    const hasRefreshBtn = $wrapper.find(".prime-cs-refresh-btn").length > 0;

    if (!hasCopyBtn && !hasDownloadBtn && !hasWrapBtn && !hasRefreshBtn) {
      console.warn(
        "Code Snippet: No control buttons found in the widget. Check HTML structure.",
      );
    }

    /* ---- Code Folding ---- */
    if (folding) {
      initCodeFolding($wrapper);
    }

    /* ---- Live Preview ---- */
    if (livePreview) {
      $wrapper.find(".prime-cs-panel.active").each(function () {
        updateLivePreview($(this));
      });

      // Update live preview on code changes (Elementor editor context)
      $wrapper.on("prime:code-updated", ".prime-cs-panel", function () {
        updateLivePreview($(this));
      });
    }
  }

  /* ============================================================
       Code Folding
       ============================================================ */
  function initCodeFolding($wrapper) {
    $wrapper.find("pre code").each(function () {
      const $code = $(this);
      const lines = $code.text().split("\n");
      if (lines.length < 5) return; // Too short to fold

      // We create folding UI for blocks wrapped in { } or function blocks
      // Simple approach: add a fold toggle at the top of the pre
      const $pre = $code.closest("pre");
      const $wrap = $pre.closest(".prime-cs-code-wrap");

      if ($wrap.find(".prime-cs-fold-controls").length) return;

      const $controls = $(
        '<div class="prime-cs-fold-controls" style="display:flex;align-items:center;padding:6px 16px;border-bottom:1px solid var(--prime-cs-border);gap:8px;background:var(--prime-cs-header-bg);"></div>',
      );

      const $foldBtn = $(
        '<button class="prime-cs-fold-btn" title="Collapse/Expand code">▼</button>',
      );
      const $foldLabel = $(
        '<span style="font-size:11px;color:var(--prime-cs-subtext);font-family:sans-serif;">Collapse</span>',
      );

      $controls.append($foldBtn).append($foldLabel);
      $wrap.prepend($controls);

      let folded = false;

      $foldBtn.on("click", function () {
        folded = !folded;
        if (folded) {
          // Show only first 3 lines
          const firstLines = lines.slice(0, 3).join("\n") + "\n  ...";
          $code.data("full-code", $code.text());
          $code.text(firstLines);
          rehighlight($code.closest(".prime-cs-panel"));
          $foldBtn.text("▶");
          $foldLabel.text("Expand (" + (lines.length - 3) + " lines hidden)");
        } else {
          $code.text($code.data("full-code") || lines.join("\n"));
          rehighlight($code.closest(".prime-cs-panel"));
          $foldBtn.text("▼");
          $foldLabel.text("Collapse");
        }
      });
    });
  }

  /* ============================================================
       Live Preview
       ============================================================ */
  function updateLivePreview($panel) {
    const $frame = $panel.find(".prime-cs-preview-frame");
    if (!$frame.length) return;

    const lang = $panel.find("code").attr("class") || "";
    const code = $panel.find("code").text();

    let frameContent = "";

    if (lang.includes("css")) {
      frameContent = `<!DOCTYPE html><html><head><style>${code}</style></head>
<body><div class="preview-wrapper" style="padding:16px;font-family:sans-serif;">
<h1>Heading Preview</h1><p>Paragraph text preview.</p>
<a href="#">Link preview</a><br><br>
<button>Button preview</button>
</div></body></html>`;
    } else if (lang.includes("html")) {
      frameContent = code;
    }

    const doc = $frame[0].contentDocument || $frame[0].contentWindow.document;
    doc.open();
    doc.write(frameContent);
    doc.close();

    // Auto-resize iframe
    setTimeout(function () {
      try {
        const h = doc.body.scrollHeight;
        $frame.css("height", Math.max(150, Math.min(h + 24, 500)) + "px");
      } catch (e) {}
    }, 100);
  }

  /* ============================================================
       MIME Type Helper
       ============================================================ */
  function getMimeType(filename) {
    const ext = filename.split(".").pop().toLowerCase();
    const map = {
      js: "application/javascript",
      ts: "application/typescript",
      css: "text/css",
      html: "text/html",
      php: "application/x-php",
      json: "application/json",
      xml: "application/xml",
      py: "text/x-python",
      rb: "text/x-ruby",
      go: "text/x-go",
      rs: "text/x-rust",
      sh: "text/x-shellscript",
      sql: "text/x-sql",
      md: "text/markdown",
      yml: "text/yaml",
      yaml: "text/yaml",
    };
    return map[ext] || "text/plain";
  }

  /* ============================================================
       Elementor Widget Handler
       ============================================================ */
  function PrimeCodeSnippetHandler($scope) {
    const $wrapper = $scope.find(".prime-code-snippet-wrapper");
    if ($wrapper.length) {
      console.log("Code Snippet: Frontend init...");
      // Remove any previous initialization flag to force re-init
      $wrapper.removeData("prime-cs-inited");
      initWidget($wrapper);
    }
  }

  /* Register with Elementor Frontend */
  $(window).on("elementor/frontend/init", function () {
    if (typeof elementorFrontend !== "undefined") {
      console.log("Code Snippet: Registering frontend hook...");
      elementorFrontend.hooks.addAction(
        "frontend/element_ready/pea_code_snippet.default",
        PrimeCodeSnippetHandler,
      );
    }
  });

  /* ============================================================
       Also init on plain DOM ready (non-Elementor pages)
       ============================================================ */
  $(document).ready(function () {
    $(".prime-code-snippet-wrapper").each(function () {
      initWidget($(this));
    });
  });

  /* ============================================================
       Elementor Editor Live Updates
       Use render hook to catch template re-renders in editor
       ============================================================ */
  if (
    typeof elementor !== "undefined" &&
    typeof elementor.channels !== "undefined"
  ) {
    console.log("Code Snippet: Setting up Elementor editor integration...");

    // Listen for when the editor renders/re-renders our widget
    elementor.channels.editor.on("editor:render", function () {
      // Delay to ensure DOM is updated
      setTimeout(function () {
        console.log(
          "Code Snippet: Editor render detected, initializing all widgets...",
        );
        $(".prime-code-snippet-wrapper").each(function () {
          $(this).removeData("prime-cs-inited");
          initWidget($(this));
        });
      }, 50);
    });
  }

  /* ============================================================
       Alternative Editor Hook for Settings Changes
       ============================================================ */
  if (typeof elementor !== "undefined") {
    elementor.hooks.addAction(
      "panel/open_editor/widget/pea_code_snippet",
      function (panel, model, view) {
        console.log("Code Snippet: Editor panel opened, initializing...");

        // Initialize on panel open
        setTimeout(function () {
          const $wrapper = view.$el.find(".prime-code-snippet-wrapper");
          if ($wrapper.length) {
            $wrapper.removeData("prime-cs-inited");
            initWidget($wrapper);
          }
        }, 100);

        // Re-initialize when ANY setting changes
        model.on("change", function () {
          console.log("Code Snippet: Settings changed, re-initializing...");
          setTimeout(function () {
            const $wrapper = view.$el.find(".prime-code-snippet-wrapper");
            if ($wrapper.length) {
              $wrapper.removeData("prime-cs-inited");
              initWidget($wrapper);
            }
          }, 100);
        });
      },
    );
  }
})(jQuery);
