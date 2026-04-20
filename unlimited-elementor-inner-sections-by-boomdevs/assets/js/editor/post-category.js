(function ($) {
    'use strict';

    $(window).on('elementor:init', function () {
        elementor.hooks.addAction('panel/open_editor/widget/pea_post_category', function (panel, model, view) {
            const settingsModel = view.model.get('settings');

            function getSettingArray(settingKey) {
                const value = view.model.getSetting(settingKey);

                if (Array.isArray(value)) {
                    return value.map(String);
                }

                if (typeof value === 'string' && value.trim() !== '') {
                    return value.split(',').map(function (item) {
                        return item.trim();
                    }).filter(Boolean);
                }

                return [];
            }

            function getControlSelect(controlName) {
                return panel.$el.find('.elementor-control-' + controlName + ' select');
            }

            function fillControlOptions($control, options, selectedValues) {
                if (!$control.length) {
                    return;
                }

                $control.empty();

                Object.entries(options).forEach(function (entry) {
                    const value = String(entry[0]);
                    const label = entry[1];
                    const option = new Option(label, value, false, selectedValues.includes(value));

                    $control.append(option);
                });

                $control.val(selectedValues).trigger('change');
            }

            function syncTermFilters() {
                const taxonomy = String(view.model.getSetting('taxonomy') || '');
                const includeControl = getControlSelect('include_term_ids');
                const excludeControl = getControlSelect('exclude_term_ids');

                if (!taxonomy || (!includeControl.length && !excludeControl.length)) {
                    return;
                }

                const savedInclude = getSettingArray('include_term_ids');
                const savedExclude = getSettingArray('exclude_term_ids');

                includeControl.empty().append(new Option('Loading...', '', false, false));
                excludeControl.empty().append(new Option('Loading...', '', false, false));

                $.ajax({
                    url: window.ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'pea_get_terms_by_taxonomy',
                        taxonomy: taxonomy,
                        pea_editor_nonce_check: peaEditor.pea_editor_nonce
                    }
                }).done(function (response) {
                    if (!response || !response.success || !response.data) {
                        return;
                    }

                    const options = response.data;
                    const availableIds = Object.keys(options).map(String);
                    const validInclude = savedInclude.filter(function (id) {
                        return availableIds.includes(String(id));
                    });
                    const validExclude = savedExclude.filter(function (id) {
                        return availableIds.includes(String(id));
                    });

                    fillControlOptions(includeControl, options, validInclude);
                    fillControlOptions(excludeControl, options, validExclude);
                }).fail(function () {
                    includeControl.empty();
                    excludeControl.empty();
                });
            }

            settingsModel.off('change:taxonomy.peaPostCategory');
            settingsModel.off('change:selection_type.peaPostCategory');

            settingsModel.on('change:taxonomy.peaPostCategory', syncTermFilters);
            settingsModel.on('change:selection_type.peaPostCategory', function () {
                setTimeout(syncTermFilters, 50);
            });

            syncTermFilters();

            elementor.channels.editor.off('section:activated.peaPostCategory');
            elementor.channels.editor.on('section:activated.peaPostCategory', function (sectionName) {
                if (sectionName === 'section_general') {
                    setTimeout(syncTermFilters, 50);
                }
            });
        });
    });
})(jQuery);
