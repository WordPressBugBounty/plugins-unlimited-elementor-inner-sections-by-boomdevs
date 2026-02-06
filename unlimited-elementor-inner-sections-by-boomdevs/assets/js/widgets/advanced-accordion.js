(function($) {
    'use strict';

    const AdvancedAccordionHandler = elementorModules.frontend.handlers.Base.extend({

        // store per-item observers and parent observer
        observers: [],
        parentObserver: null,
        _parentObserverTimer: null,

        getDefaultSettings() {
            return {
                selectors: {
                    item: '.pea-advanced-accordion-item',
                    title: '.pea-accordion-item-title-wrapper',
                    contentWrapper: '.pea-accordion-content-wrapper',
                    innerWrapper: '.pea-advanced-accordion-inner-wrapper'
                },
                activeClass: 'active',
            };
        },

        getDefaultElements() {
            const selectors = this.getSettings('selectors');
            const $scope = this.$element; // widget wrapper

            return {
                $items: $scope.find(selectors.item),
                $innerWrapper: $scope.find(selectors.innerWrapper).first()
            };
        },

        bindEvents() {
            // Use delegation so new items automatically work
            const selectors = this.getSettings('selectors');
            const activeClass = this.getSettings('activeClass');

            this.$element.off('click.faAdvancedAccordion') // prevent duplicate binding
                .on('click.faAdvancedAccordion', selectors.title, (event) => {
                    event.stopPropagation();

                    const $title = $(event.currentTarget);
                    const $item = $title.closest(selectors.item);
                    const $contentWrapper = $item.find(selectors.contentWrapper).first();

                    if (!$contentWrapper.length) {
                        return;
                    }

                    const isActive = $title.hasClass(activeClass);

                    // Limit to this widget only
                    const $allItems = this.$element.find(selectors.item);

                    $allItems.each(function() {
                        const $it = $(this);
                        const $t = $it.find(selectors.title).first();
                        const $cw = $it.find(selectors.contentWrapper).first();

                        $t.removeClass(activeClass);
                        $cw.removeClass(activeClass).css('max-height', '0px');
                    });

                    if (!isActive) {
                        $title.addClass(activeClass);
                        $contentWrapper.addClass(activeClass);
                        $contentWrapper.css('max-height', $contentWrapper.prop('scrollHeight') + 'px');
                    }
                });
        },

        // Called when widget is first initialized
        onInit() {
            elementorModules.frontend.handlers.Base.prototype.onInit.apply(this, arguments);
            this.refreshItems();
            this.observeContentChanges();
            this.observeParentForNewItems(); // <--- NEW: watch parent wrapper for added items
             
            if (!elementorFrontend.isEditMode()) return; // Only in editor

        },

        // Called when controls that affect markup change in the editor
        onElementChange(propertyName) {
            if (propertyName.startsWith('accordion_items')) {
                this.refreshItems();
                this.observeContentChanges();
                this.observeParentForNewItems(); // ensure parent observer attached after re-render
            }
        },

        refreshItems() {
            const selectors = this.getSettings('selectors');
            const activeClass = this.getSettings('activeClass');

            const $items = this.$element.find(selectors.item);

            $items.each(function() {
                const $item = $(this);
                const $title = $item.find(selectors.title).first();
                const $contentWrapper = $item.find(selectors.contentWrapper).first();

                if (!$title.length || !$contentWrapper.length) {
                    return;
                }

                // Remove any inline state first
                const isActive = $title.hasClass(activeClass);
                if (isActive) {
                    $contentWrapper.css('max-height', $contentWrapper.prop('scrollHeight') + 'px');
                } else {
                    $contentWrapper.css('max-height', '0px');
                }
            });
        },

        observeContentChanges() {
            // Clear previous observers
            if (this.observers.length) {
                this.observers.forEach(obs => obs.disconnect());
                this.observers = [];
            }

            const selectors = this.getSettings('selectors');
            const $items = this.$element.find(selectors.item);

            $items.each((i, item) => {
                const $content = $(item).find(selectors.contentWrapper).first()[0];
                if (!$content) return;

                const observer = new MutationObserver(() => {
                    const $wrapper = $(item).find(selectors.contentWrapper);

                    if ($wrapper.hasClass('active')) {
                        // small delay to allow nested widget rendering to finish
                        setTimeout(() => {
                            $wrapper.css('max-height', $wrapper.prop('scrollHeight') + 'px');
                        }, 80);
                    }
                });

                observer.observe($content, { childList: true, subtree: true });

                // Store observer
                this.observers.push(observer);
            });
        },

        observeParentForNewItems() {
            const selectors = this.getSettings('selectors');
            const $inner = this.$element.find(selectors.innerWrapper).first();

            // Disconnect previous parent observer
            if (this.parentObserver) {
                try { this.parentObserver.disconnect(); } catch(e) {}
                this.parentObserver = null;
            }

            if (!$inner || !$inner.length) {
                return;
            }

            // create observer to detect new repeater item nodes added to the inner wrapper
            const parent = $inner.get(0);

            const parentObserver = new MutationObserver((mutations) => {
                // debounce multiple mutation events
                if (this._parentObserverTimer) {
                    clearTimeout(this._parentObserverTimer);
                }
                this._parentObserverTimer = setTimeout(() => {
                    // When items change, refresh and re-attach content observers
                    this.refreshItems();
                    this.observeContentChanges();

                    // Also re-bind events (delegated click remains but re-binding is safe)
                    this.bindEvents();
                }, 40);
            });

            parentObserver.observe(parent, { childList: true, subtree: false });

            this.parentObserver = parentObserver;
        },

        // optional: cleanup if element removed (good practice)
        onDestroy() {
            if (this.parentObserver) {
                try { this.parentObserver.disconnect(); } catch (e) {}
                this.parentObserver = null;
            }
            if (this.observers.length) {
                this.observers.forEach(obs => obs.disconnect());
                this.observers = [];
            }
            elementorModules.frontend.handlers.Base.prototype.onDestroy.apply(this, arguments);
        }

    });

    $(window).on('elementor/frontend/init', function() {
        const addHandler = ($element) => {
            elementorFrontend.elementsHandler.addHandler(AdvancedAccordionHandler, { $element });
        };

        elementorFrontend.hooks.addAction(
            'frontend/element_ready/pea_advanced_accordion.default',
            addHandler
        );
    });

})(jQuery);
