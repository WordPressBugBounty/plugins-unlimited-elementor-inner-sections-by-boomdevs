/**
 * Prime Elementor Addons Pro — PDF Viewer Widget JS
 *
 * ROOT CAUSE FIX: "Found 0 viewer(s) on page"
 *
 * The Elementor editor renders widget previews inside a sandboxed <iframe>.
 * The original script ran `document.querySelectorAll(...)` on the PARENT
 * frame document — which has no `.pea-pdf-viewer-wrap` elements at all.
 * The widget DOM lives inside the iframe's document.
 *
 * Fix strategy:
 *  1. `initAll(document)` still handles normal frontend page loads.
 *  2. The Elementor `frontend/element_ready` hook fires INSIDE the iframe
 *     context and passes a $scope wrapping exactly the widget's root element
 *     — so we mount directly from $scope, no querySelectorAll on the wrong doc.
 *  3. Multiple retry timers catch slow Elementor boots inside the iframe.
 */

(function () {
  "use strict";

  var WORKER_CDN =
    "https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js";

  /* =====================================================================
       PDF.js bootstrap
    ===================================================================== */

  function initPdfJs() {
    if (typeof pdfjsLib !== "undefined" && pdfjsLib.getDocument) {
      if (!pdfjsLib.GlobalWorkerOptions.workerSrc) {
        pdfjsLib.GlobalWorkerOptions.workerSrc = WORKER_CDN;
      }
      return true;
    }
    return false;
  }

  function waitForPdfJs(callback, timeout) {
    timeout = timeout === undefined ? 10000 : timeout;
    var deadline = Date.now() + timeout;
    (function poll() {
      if (initPdfJs()) {
        callback();
        return;
      }
      if (Date.now() >= deadline) {
        callback();
        return;
      }
      setTimeout(poll, 100);
    })();
  }

  /* =====================================================================
       PdfViewerWidget
    ===================================================================== */

  function PdfViewerWidget(container) {
    this.container = container;
    this.config = this._parseConfig();
    this.pdfDoc = null;
    this.currentPage = parseInt(this.config.startPage, 10) || 1;
    this.totalPages = 0;
    this.zoom =
      typeof this.config.initialScale !== "undefined"
        ? parseFloat(this.config.initialScale)
        : 1;
    this.rotation = parseInt(this.config.rotation, 10) || 0;
    this._renderTask = null;
    this._destroyed = false;
    this._initialized = false;

    if (!this.config.pdfUrl) return; // placeholder — no PDF chosen yet

    var self = this;
    waitForPdfJs(function () {
      self._init();
    });
  }

  PdfViewerWidget.prototype._parseConfig = function () {
    try {
      return JSON.parse(this.container.getAttribute("data-config") || "{}");
    } catch (e) {
      console.error("[PEA PDF] Bad config JSON:", e);
      return {};
    }
  };

  PdfViewerWidget.prototype._init = function () {
    if (this._initialized || this._destroyed) return;
    this._initialized = true;
    this._cacheElements();
    this._bindEvents();
    this._loadPdf();
  };

  PdfViewerWidget.prototype._cacheElements = function () {
    var c = this.container;
    this.el = {
      canvas: c.querySelector(".pea-pdf-canvas"),
      canvasWrap: c.querySelector(".pea-pdf-canvas-container"),
      loading: c.querySelector(".pea-pdf-loading"),
      error: c.querySelector(".pea-pdf-error"),
      errorText: c.querySelector(".pea-pdf-error-text"),
      btnPrev: c.querySelectorAll(".pea-pdf-btn-prev"),
      btnNext: c.querySelectorAll(".pea-pdf-btn-next"),
      btnZoomOut: c.querySelectorAll(".pea-pdf-btn-zoom-out"),
      btnZoomIn: c.querySelectorAll(".pea-pdf-btn-zoom-in"),
      btnFullscreen: c.querySelectorAll(".pea-pdf-btn-fullscreen"),
      zoomLevel: c.querySelectorAll(".pea-pdf-zoom-level"),
      // btnFs: c.querySelectorAll(".pea-pdf-btn-fullscreen"),
      btnPrint: c.querySelectorAll(".pea-pdf-btn-print"),
      pageInput: c.querySelectorAll(".pea-pdf-page-input"),
      totalPagesEl: c.querySelectorAll(".pea-pdf-total-pages"),
    };
  };

  PdfViewerWidget.prototype._bindEvents = function () {
    var self = this;

    // Use event delegation for all toolbar buttons to prevent duplicate listeners
    this._onToolbarClick = function (e) {
      var btn = e.target.closest(
        "button, a, .pea-pdf-btn, [class*='pea-pdf-btn-']",
      );
      if (!btn) return;

      if (btn.classList.contains("pea-pdf-btn-prev")) {
        e.preventDefault();
        self.prevPage();
      } else if (btn.classList.contains("pea-pdf-btn-next")) {
        e.preventDefault();
        self.nextPage();
      } else if (btn.classList.contains("pea-pdf-btn-zoom-out")) {
        e.preventDefault();
        self.zoomOut();
      } else if (btn.classList.contains("pea-pdf-btn-zoom-in")) {
        e.preventDefault();
        self.zoomIn();
      } else if (btn.classList.contains("pea-pdf-btn-fullscreen")) {
        e.preventDefault();
        self.toggleFullscreen();
      } else if (btn.classList.contains("pea-pdf-btn-print")) {
        e.preventDefault();
        self.printPdf();
      }
    };
    this.container.addEventListener("click", this._onToolbarClick);

    self.el.pageInput.forEach(function (inp) {
      inp.addEventListener("change", function (e) {
        self.goToPage(parseInt(e.target.value, 10) || 1);
      });
      inp.addEventListener("keypress", function (e) {
        if (e.key === "Enter") {
          e.preventDefault();
          self.goToPage(parseInt(e.target.value, 10) || 1);
        }
      });
    });
    this._onKeyDownBound = function (e) {
      self._onKeyDown(e);
    };
    document.addEventListener("keydown", this._onKeyDownBound);
  };

  /* ── PDF loading ── */

  PdfViewerWidget.prototype._loadPdf = function () {
    var self = this;
    self._showLoading(true);
    self._hideError();
    if (self.pdfDoc) {
      self.pdfDoc.destroy();
      self.pdfDoc = null;
    }

    pdfjsLib
      .getDocument({ url: self.config.pdfUrl, withCredentials: false })
      .promise.then(function (pdf) {
        if (self._destroyed) return;
        self.pdfDoc = pdf;
        self.totalPages = pdf.numPages;
        self._updateTotalPages();
        self._renderPage(self.currentPage);
      })
      .catch(function (e) {
        console.error("[PEA PDF] Load failed:", e);
        self._showLoading(false);
        self._showError(self.config.errorText || "Failed to load PDF.");
      });
  };

  /* ── Rendering ── */

  PdfViewerWidget.prototype._renderPage = function (pageNum) {
    var self = this;
    if (!self.pdfDoc || pageNum < 1 || pageNum > self.totalPages) return;

    if (self._renderTask) {
      try {
        self._renderTask.cancel();
      } catch (e) {
        /* ignore */
      }
      self._renderTask = null;
    }

    self.currentPage = pageNum;
    self._updatePageInput();
    self._updateNavButtons();

    self.pdfDoc
      .getPage(pageNum)
      .then(function (page) {
        if (self._destroyed) return;
        var viewport = page.getViewport({
          scale: self.zoom,
          rotation: self.rotation,
        });
        var canvas = self.el.canvas;
        if (!canvas) return;
        var ctx = canvas.getContext("2d");
        if (!ctx) return;

        canvas.height = viewport.height;
        canvas.width = viewport.width;

        var task = page.render({ canvasContext: ctx, viewport: viewport });
        self._renderTask = task;

        task.promise
          .then(function () {
            if (self._destroyed) return;
            self._renderTask = null;
            self._showLoading(false); // hide spinner ✓
            if (self.el.canvasWrap) {
              self.el.canvasWrap.style.display = "flex"; // show PDF ✓
            }
          })
          .catch(function (e) {
            if (e && e.name === "RenderingCancelledException") return;
            if (self._destroyed) return;
            self._showLoading(false);
            self._showError("Failed to render page " + pageNum);
          });
      })
      .catch(function (e) {
        console.error("[PEA PDF] getPage error:", e);
        if (self._destroyed) return;
        self._showLoading(false);
        self._showError("Failed to load page " + pageNum);
      });
  };

  /* ── Navigation ── */
  PdfViewerWidget.prototype.prevPage = function () {
    if (this.currentPage > 1) this.goToPage(this.currentPage - 1);
  };
  PdfViewerWidget.prototype.nextPage = function () {
    if (this.currentPage < this.totalPages) this.goToPage(this.currentPage + 1);
  };
  PdfViewerWidget.prototype.goToPage = function (n) {
    if (n >= 1 && n <= this.totalPages) this._renderPage(n);
  };

  /* ── Zoom ── */
  PdfViewerWidget.prototype.zoomIn = function () {
    this.zoom = Math.min(+(this.zoom + 0.1).toFixed(2), 3);
    this._updateZoomDisplay();
    this._renderPage(this.currentPage);
  };
  PdfViewerWidget.prototype.zoomOut = function () {
    this.zoom = Math.max(+(this.zoom - 0.1).toFixed(2), 0);
    this._updateZoomDisplay();
    this._renderPage(this.currentPage);
  };
  PdfViewerWidget.prototype._updateZoomDisplay = function () {
    var pct = Math.round(this.zoom * 100) + "%";
    this.el.zoomLevel.forEach(function (el) {
      el.textContent = pct;
    });
  };

  /* ── Fullscreen ── */
  PdfViewerWidget.prototype.toggleFullscreen = function () {
    var self = this;
    self.container.classList.toggle("pea-pdf-fullscreen");
    document.body.classList.toggle("pea-pdf-fullscreen-active");
    setTimeout(function () {
      if (self._destroyed) return;
      self._renderPage(self.currentPage);
    }, 150);
  };

  /* ── Print ── */
  PdfViewerWidget.prototype.printPdf = function () {
    if (!this.pdfDoc) return;
    var win = window.open(this.config.pdfUrl, "_blank");
    if (win)
      win.onload = function () {
        win.print();
      };
  };

  /* ── Keyboard ── */
  PdfViewerWidget.prototype._onKeyDown = function (e) {
    if (!this.container.offsetParent) return;
    switch (e.key) {
      case "ArrowLeft":
      case "ArrowUp":
        e.preventDefault();
        this.prevPage();
        break;
      case "ArrowRight":
      case "ArrowDown":
        e.preventDefault();
        this.nextPage();
        break;
      case "+":
      case "=":
        e.preventDefault();
        this.zoomIn();
        break;
      case "-":
      case "_":
        e.preventDefault();
        this.zoomOut();
        break;
      default:
        if ((e.key === "f" || e.key === "F") && (e.ctrlKey || e.metaKey)) {
          e.preventDefault();
          this.toggleFullscreen();
        }
    }
  };

  /* - UI state - */
  PdfViewerWidget.prototype._showLoading = function (v) {
    if (this.el.loading) this.el.loading.style.display = v ? "flex" : "none";
  };
  PdfViewerWidget.prototype._hideError = function () {
    if (this.el.error) this.el.error.style.display = "none";
  };
  PdfViewerWidget.prototype._showError = function (msg) {
    if (!this.el.error) return;
    if (this.el.errorText) this.el.errorText.textContent = msg;
    this.el.error.style.display = "flex";
  };
  PdfViewerWidget.prototype._updatePageInput = function () {
    var v = this.currentPage;
    this.el.pageInput.forEach(function (i) {
      i.value = v;
    });
  };
  PdfViewerWidget.prototype._updateTotalPages = function () {
    var v = this.totalPages;
    this.el.totalPagesEl.forEach(function (el) {
      el.textContent = v;
    });
    this.el.pageInput.forEach(function (i) {
      i.max = v;
    });
  };
  PdfViewerWidget.prototype._updateNavButtons = function () {
    var f = this.currentPage === 1,
      l = this.currentPage === this.totalPages;
    this.el.btnPrev.forEach(function (b) {
      b.disabled = f;
      b.setAttribute("aria-disabled", f);
    });
    this.el.btnNext.forEach(function (b) {
      b.disabled = l;
      b.setAttribute("aria-disabled", l);
    });
  };
  PdfViewerWidget.prototype.destroy = function () {
    if (this._renderTask) {
      try {
        this._renderTask.cancel();
      } catch (e) {
        /* ignore */
      }
    }
    if (this.pdfDoc) {
      try {
        this.pdfDoc.destroy();
      } catch (e) {}
      this.pdfDoc = null;
    }
    if (this._onToolbarClick) {
      this.container.removeEventListener("click", this._onToolbarClick);
    }
    if (this._onKeyDownBound) {
      document.removeEventListener("keydown", this._onKeyDownBound);
    }
    this._initialized = false;
    this._destroyed = true;
  };

  /* =====================================================================
       Mount helpers
    ===================================================================== */

  function mountViewer(el) {
    var configStr = el.getAttribute("data-config");
    if (el._peaPdfInst) {
      if (el._peaPdfLastConfig === configStr) return;
      el._peaPdfInst.destroy();
      el._peaPdfInst = null;
    }
    el._peaPdfLastConfig = configStr;
    el._peaPdfInst = new PdfViewerWidget(el);
  }

  function initAll(root) {
    (root || document)
      .querySelectorAll(".pea-pdf-viewer-wrap[data-config]")
      .forEach(mountViewer);
  }

  /* =====================================================================
       Elementor hook
       ─────────────────────────────────────────────────────────────────────
       KEY FIX: The Elementor editor wraps widget previews in an <iframe>.
       This script runs INSIDE that iframe. `window.elementorFrontend` is
       the frontend object of the IFRAME, and the hook fires with $scope
       pointing to the exact widget element — no querySelectorAll on wrong doc.

       We mount directly from $scope so it works regardless of DOM depth.
    ===================================================================== */

  function mountFromScope($scope) {
    if (!$scope) return;

    // jQuery path (standard Elementor)
    if (typeof $scope.find === "function") {
      // Try children first
      var $found = $scope.find(".pea-pdf-viewer-wrap[data-config]");
      if ($found.length) {
        $found.each(function () {
          mountViewer(this);
        });
        return;
      }
      // $scope itself might be the wrap (some Elementor versions)
      var node = $scope[0] || $scope.get(0);
      if (
        node &&
        node.classList &&
        node.classList.contains("pea-pdf-viewer-wrap")
      ) {
        mountViewer(node);
        return;
      }
    }

    // Plain DOM element path
    if ($scope.querySelectorAll) {
      var els = $scope.querySelectorAll(".pea-pdf-viewer-wrap[data-config]");
      if (els.length) {
        els.forEach(mountViewer);
        return;
      }
      if (
        $scope.classList &&
        $scope.classList.contains("pea-pdf-viewer-wrap")
      ) {
        mountViewer($scope);
      }
    }
  }

  function registerElementorHook() {
    if (!window.elementorFrontend || !window.elementorFrontend.hooks) return;

    window.elementorFrontend.hooks.addAction(
      "frontend/element_ready/pea_pdf_viewer.default",
      function ($scope) {
        mountFromScope($scope);
      },
    );
  }

  function registerElementorInitListener() {
    if (typeof window.jQuery === "function") {
      window.jQuery(window).on("elementor/frontend/init", function () {
        registerElementorHook();
      });
    }
  }

  /* =====================================================================
       Boot sequence
       1. Immediate initAll — catches frontend pages where DOM is ready
       2. DOMContentLoaded — catches frontend pages where DOM isn't ready yet
       3. registerElementorHook + init listener — catches Elementor editor widget renders
       4. Retry timers — catch slow Elementor iframe boot
    ===================================================================== */

  // 1 & 2 — frontend
  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", function () {
      initAll(document);
    });
  } else {
    initAll(document);
  }

  // 3 — Elementor hook (immediate attempt)
  registerElementorHook();
  registerElementorInitListener();

  // 4 — retries for slow iframe environments
  setTimeout(function () {
    registerElementorHook();
    initAll(document); // also re-scan in case hook was missed
  }, 300);

  setTimeout(function () {
    registerElementorHook();
    initAll(document);
  }, 1000);

  setTimeout(function () {
    registerElementorHook();
    initAll(document);
  }, 2500);
})();
