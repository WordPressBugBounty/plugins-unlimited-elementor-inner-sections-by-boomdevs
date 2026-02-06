(function ($) {
    jQuery(window).on('elementor/frontend/init', function () {

        function AdvancedTabs($scope) {

            const root = $scope.find('.pea-tabs-wrap').get(0);
            if (!root) return;

            const tablist = root.querySelector('.pea-tabs-panel');
            if (!tablist) return;

            const getTabItems = () =>
                [...tablist.querySelectorAll('.pea-tab')];

            const getPanels = () =>
                [...root.querySelectorAll('.pea-tabs-item-wrapper')];

            function setActive(index) {
                const tabItems = getTabItems();
                const panels = getPanels();

                const max = tabItems.length - 1;
                const i = Math.min(Math.max(index, 0), max);

                root.dataset.tabActive = String(i);

                tabItems.forEach((li, idx) => {
                    const active = idx === i;
                    li.classList.toggle('pea-tabs-active', active);
                    li.setAttribute('aria-selected', active);
                    li.setAttribute('tabindex', active ? '0' : '-1');
                });

                panels.forEach((panel, idx) => {
                    panel.style.display = idx === i ? 'block' : 'none';
                });
            }

            const initial = parseInt(root.dataset.tabActive || 1, 10) - 1;
            setActive(initial);

            // 🔥 Delegate click (always works)
            $(tablist).on('click', '.pea-tab', function () {
                const idx = $(this).index();
                setActive(idx);
            });

            // 🔥 Delegate keyboard navigation (always works)
            $(tablist).on('keydown', '.pea-tab', function (e) {
                const tabItems = getTabItems();
                const idx = $(this).index();

                let newIndex = idx;

                switch (e.key) {
                    case 'ArrowLeft':
                        e.preventDefault();
                        newIndex = idx > 0 ? idx - 1 : tabItems.length - 1;
                        break;

                    case 'ArrowRight':
                        e.preventDefault();
                        newIndex = idx < tabItems.length - 1 ? idx + 1 : 0;
                        break;

                    case 'Home':
                        e.preventDefault();
                        newIndex = 0;
                        break;

                    case 'End':
                        e.preventDefault();
                        newIndex = tabItems.length - 1;
                        break;

                    case 'Enter':
                    case ' ':
                        e.preventDefault();
                        setActive(idx);
                        return;

                    default:
                        return;
                }

                setActive(newIndex);
                $(getTabItems()[newIndex]).focus();
            });
        }

        elementorFrontend.hooks.addAction(
            'frontend/element_ready/pea_advanced_tabs.default',
            AdvancedTabs
        );

    });
})(jQuery);
