/**
 * Simple Elementor Pro Widget Notice Customizer
 * Prime Elementor Addons
 */

(function () {
    'use strict';

    // ================================
    // EASY CONFIG – CHANGE ONLY THIS
    // ================================
    const SETTINGS = {
        widgetPrefix: 'pea_', // your widget icon prefix
        upgradeUrl: 'https://primeelementoraddons.com/pricing',
        buttonText: 'Upgrade Prime Elementor Addons',
        customClass: 'pea-upgrade-btn'
    };

    // ================================
    // INIT
    // ================================
    function init() {

        // Listen when user clicks a locked widget
        parent.document.addEventListener('click', function (e) {

            const widget = e.target.closest('.elementor-element--promotion');
            if (!widget) return;

            // Check if this is YOUR widget
            const icon = widget.querySelector('.icon i');
            if (!icon || !icon.className.includes(SETTINGS.widgetPrefix)) {
                const pea_updgrad_btn = document.querySelector('.pea-upgrade-btn');

                if (pea_updgrad_btn) {
                    pea_updgrad_btn.remove();
                }
                return;
            }

            // Wait a little for dialog to open
            setTimeout(() => {
                customizeDialog();
            }, 100);
        });
    }

    // ================================
    // CUSTOMIZE DIALOG
    // ================================
    function customizeDialog() {

        const dialog = parent.document.querySelector('#elementor-element--promotion__dialog');
        if (!dialog) return;

        const defaultBtn = dialog.querySelector('.dialog-buttons-action');
        if (!defaultBtn) return;

        // Hide Elementor default button
        defaultBtn.style.display = 'none';

        // If already created, just show it
        let customBtn = dialog.querySelector('.' + SETTINGS.customClass);
        if (customBtn) {
            customBtn.style.display = '';
            return;
        }

        // Create new button
        customBtn = document.createElement('a');
        customBtn.href = SETTINGS.upgradeUrl;
        customBtn.target = '_blank';
        customBtn.textContent = SETTINGS.buttonText;

        customBtn.className =
            'elementor-button go-pro dialog-button dialog-action dialog-buttons-action ' +
            SETTINGS.customClass;

        defaultBtn.insertAdjacentElement('afterend', customBtn);
    }

    // Run when editor loads
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

})();
