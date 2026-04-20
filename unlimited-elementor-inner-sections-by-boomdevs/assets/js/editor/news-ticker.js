(function () {
    'use strict';

    const ReactLib = window.React;
    let isRegistered = false;

    function registerNewsTicker() {
        if (isRegistered) return true;

        const nestedModule =
            ($e?.components?.get?.('nested-elements/nested-repeater') ||
                $e?.components?.get?.('nested-elements'))?.exports || null;

        if (!nestedModule) return false;

        const BaseView  = nestedModule.NestedViewBase || nestedModule.NestedView;
        const BaseModel = nestedModule.NestedRepeaterModel || nestedModule.NestedModelBase;

        // View 

        class NewsTickerView extends BaseView {

            initialize() {
                super.initialize();
                this.listenTo(this.collection, 'add remove', () => {
                    this.safeRefresh();
                });
            }

            getChildViewContainer(compositeView, itemView) {
                if (itemView) {
                    const slideId = itemView.model?.get('id');
                    if (slideId) {
                        const el =
                            this.$el.find('.elementor-repeater-item-' + slideId + ' > .pea-ticker-item').get(0) ||
                            this.$el.find('.elementor-repeater-item-' + slideId).get(0);
                        if (el) return Backbone.$(el);
                    }
                }
                return this.$el.find('.pea-ticker-swiper-wrapper');
            }

            filter(model, index) {
                if (typeof model?.set === 'function') {
                    model.set('dataIndex', index + 1);
                } else if (model?.attributes) {
                    model.attributes.dataIndex = index + 1;
                }
                return true;
            }

            safeRefresh() {
                setTimeout(() => this.render(), 500);
            }
        }

        // Empty view 

        function EmptyView() {
            return ReactLib.createElement(
                'div',
                { className: 'elementor-first-add' },
                ReactLib.createElement('div', {
                    className: 'elementor-icon eicon-plus',
                    onClick: () => $e.route('panel/elements/categories'),
                })
            );
        }

        // Element type

        class NewsTickerElement extends elementor.modules.elements.types.Base {
            getType()      { return 'pea_news_ticker'; }
            getView()      { return NewsTickerView; }
            getEmptyView() { return EmptyView; }
            getModel()     { return BaseModel; }
        }

        elementor.elementsManager.registerElementType(new NewsTickerElement());
        isRegistered = true;
        return true;
    }

    // Bootstrap 

    jQuery(function () {
        registerNewsTicker();

        elementorCommon.elements.$window.on('elementor/init-components', async function () {
            try { await elementor.modules.nestedElements; } catch (e) { }
            registerNewsTicker();
        });

        const win = elementorCommon?.elements?.$window;
        if (win) {
            win.off('elementor/nested-element-type-loaded.pea-news-ticker')
                .one('elementor/nested-element-type-loaded.pea-news-ticker', registerNewsTicker);
        }

        const interval = setInterval(function () {
            if (registerNewsTicker()) clearInterval(interval);
        }, 50);
    });

})();