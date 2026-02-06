// assets/js/editor.js
(function($) {
    'use strict';

    $(window).on('elementor:init', function() {

        elementor.hooks.addAction('panel/open_editor/widget/pea_advanced_heading', function(panel, model, view) {
            var advancedHeadingPresetStyles = {
                'preset-1': {
                    'heading_text': 'Advanced Heading',
                    'show_separator': 'no',
                    'heading_text_stroke_popover_toggle': 'yes',
                    'heading_text_stroke_color': '#399CFF',
                    'heading_text_stroke_width': {
                        'unit': 'px',
                        'size': 2,
                        'sizes': [] // Required for responsive
                    },
                    'heading_text_shadow_text_shadow_type': 'yes',
                    'heading_text_shadow_text_shadow': {
                        'color': '#399CFF1A',
                        'blur': 0,
                        'horizontal': 0,
                        'vertical': 18
                    },
                    'heading_text_gradient_color': '#ffffff',
                    'heading_typography_typography': 'custom',
                    'heading_typography_font_family': 'Plus Jakarta Sans',
                    'heading_typography_font_size': {
                        'unit': 'px',
                        'size': 72,
                        'sizes': [] // Required for responsive
                    },
                    'heading_typography_font_weight': '700',
                    'heading_typography_text_transform': 'capitalize',
                    'heading_typography_font_style': 'normal',
                    'heading_typography_text_decoration': 'none',
                    'heading_typography_line_height': {
                        'unit': '%',
                        'size': 130,
                        'sizes': []
                    },
                },
                'preset-2': {
                    'show_separator': 'yes',
                    'heading_text': 'Dash Underline',
                    'separator_style': 'dashed',
                    'separator_position': 'bottom',
                    'heading_text_shadow_text_shadow_type': 'no',
                    'heading_text_stroke_popover_toggle': 'no',
                    'heading_text_gradient_color': '#F89B2E',
                    'separator_color':  '#F89B2E',
                    'heading_typography_typography': 'custom',
                    'heading_typography_font_family': 'Plus Jakarta Sans',
                    'heading_typography_font_size': {
                        'unit': 'px',
                        'size': 48,
                        'sizes': [] // Required for responsive
                    },
                    'heading_typography_font_weight': '700',
                    'heading_typography_text_transform': 'capitalize',
                    'heading_typography_font_style': 'normal',
                    'heading_typography_text_decoration': 'none',
                    'heading_typography_line_height': {
                        'unit': '%',
                        'size': 130,
                        'sizes': []
                    },
                },
                'preset-3': {
                    'show_separator': 'yes',
                    'heading_text': 'Solid Underline',
                    'separator_style': 'solid',
                    'separator_position': 'bottom',
                    'heading_text_shadow_text_shadow_type': 'no',
                    'heading_text_stroke_popover_toggle': 'no',
                    'heading_text_gradient_color': '#4CAF50',
                    'separator_color':  '#4CAF50',
                    'heading_typography_typography': 'custom',
                    'heading_typography_font_family': 'Plus Jakarta Sans',
                    'heading_typography_font_size': {
                        'unit': 'px',
                        'size': 48,
                        'sizes': [] // Required for responsive
                    },
                    'heading_typography_font_weight': '700',
                    'heading_typography_text_transform': 'capitalize',
                    'heading_typography_font_style': 'normal',
                    'heading_typography_text_decoration': 'none',
                    'heading_typography_line_height': {
                        'unit': '%',
                        'size': 130,
                        'sizes': []
                    },
                },
                'preset-4': {
                    'heading_text': 'Active Line',
                    'heading_text_gradient_color': '#399CFF',
                    'heading_active_line_enable': 'yes', 
                    'heading_typography_typography': 'custom',
                    'heading_typography_font_family': 'Plus Jakarta Sans',
                    'heading_typography_font_size': {
                        'unit': 'px',
                        'size': 48,
                        'sizes': [] // Required for responsive
                    },
                    'heading_typography_font_weight': '700',
                    'heading_typography_text_transform': 'capitalize',
                    'heading_typography_font_style': 'normal',
                    'heading_typography_text_decoration': 'none',
                    'heading_typography_line_height': {
                        'unit': '%',
                        'size': 130,
                        'sizes': []
                    },
                },
                'preset-5': {
                    'heading_text': 'WP Massiah',
                    'heading_text_gradient_type': 'gradient',
                    'heading_text_gradient_color_start': '#8839FF',
                    'heading_text_gradient_color_start_loc': {
                        'unit': '%',
                        'size': 0.69,
                        'sizes': [] // Required for responsive
                    },
                    'heading_text_gradient_color_end': '#D7AAFF',
                    'heading_text_gradient_color_end_loc': {
                        'unit': '%',
                        'size': 99.5,
                        'sizes': [] // Required for responsive
                    },
                    'heading_text_gradient_color_angle': {
                        'unit': 'deg',
                        'size': 91.65,
                        'sizes': [] // Required for responsive
                    },
                    'heading_active_line_enable': 'yes', 
                    'heading_typography_typography': 'custom',
                    'heading_typography_font_family': 'Plus Jakarta Sans',
                    'heading_typography_font_size': {
                        'unit': 'px',
                        'size': 48,
                        'sizes': [] // Required for responsive
                    },
                    'heading_typography_font_weight': '700',
                    'heading_typography_text_transform': 'capitalize',
                    'heading_typography_font_style': 'normal',
                    'heading_typography_text_decoration': 'none',
                    'heading_typography_line_height': {
                        'unit': '%',
                        'size': 130,
                        'sizes': []
                    },
                    'heading_active_line_enable': 'no', 
                },
                'preset-6': {
                    'show_separator': 'yes',
                    'separator_style': 'none',
                    'separator_position': 'top',
                    'show_icon': 'yes',
                    'enable_svg_code': 'yes',
                    'icon_size': {
                        'unit': 'px',
                        'size': 62,
                        'sizes': []
                    },
                    'icon_bg_size': {
                        'unit': 'px',
                        'size': 62,
                        'sizes': []
                    },
                    'icon_margin': {
                        top: '0',
                        right: '0',
                        bottom: '24',
                        left: '0',
                        unit: 'px',
                        isLinked: true
                    },
                    'separator_spacing': {
                        'unit': 'px',
                        'size': 24,
                        'sizes': [] // Required for responsive
                    },
                    'heading_text': 'Line & Icon Style',
                    'heading_text_gradient_type': 'classic',
                    'heading_text_gradient_color': '#4CAF50',
                    'separator_color':  '#4CAF50',
                    'heading_active_line_enable': 'no', 
                    'heading_typography_typography': 'custom',
                    'heading_typography_font_family': 'Plus Jakarta Sans',
                    'heading_typography_font_size': {
                        'unit': 'px',
                        'size': 48,
                        'sizes': [] // Required for responsive
                    },
                    'heading_typography_font_weight': '700',
                    'heading_typography_text_transform': 'capitalize',
                    'heading_typography_font_style': 'normal',
                    'heading_typography_text_decoration': 'none',
                    'heading_typography_line_height': {
                        'unit': '%',
                        'size': 130,
                        'sizes': []
                    },
                    'heading_active_line_enable': 'no', 
                },
                'preset-7': {
                    'heading_text': 'Image Masking Made Effortless',
                    'alignment': 'center',
                    'enable_heading_text_img': 'yes',
                    'show_separator': 'no',
                    'show_icon': 'no',
                    'enable_svg_code': 'no',
                    'icon_size': {
                        'unit': 'px',
                        'size': 62,
                        'sizes': []
                    },
                    'icon_bg_size': {
                        'unit': 'px',
                        'size': 62,
                        'sizes': []
                    },
                    'icon_margin': {
                        'top': '0',
                        'right': '0',
                        'bottom': '24',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'separator_spacing': {
                        'unit': 'px',
                        'size': 24,
                        'sizes': [] // Required for responsive
                    },
                    'heading_text_gradient_type': 'classic',
                    'heading_text_gradient_color': '#4CAF50',
                    'separator_color':  '#4CAF50',
                    'heading_active_line_enable': 'no', 
                    'heading_typography_typography': 'custom',
                    'heading_typography_font_family': 'Plus Jakarta Sans',
                    'heading_typography_font_size': {
                        'unit': 'px',
                        'size': 160,
                        'sizes': [] // Required for responsive
                    },
                    'heading_typography_font_weight': '700',
                    'heading_typography_text_transform': 'capitalize',
                    'heading_typography_font_style': 'normal',
                    'heading_typography_text_decoration': 'none',
                    'heading_typography_line_height': {
                        'unit': '%',
                        'size': 130,
                        'sizes': []
                    },
                    'heading_active_line_enable': 'no', 
                },
            };

            panel.$el.off('change', '[data-setting="preset_styles"]');
            panel.$el.on('change', '[data-setting="preset_styles"]', function() {
                var selectedPreset = $(this).val();
                const allControls = view.model.get('settings').controls || {};

                _.each(allControls, function(control, key) {
                    if (key === 'preset_styles') {
                        view.model.setSetting(key, selectedPreset);
                        return;
                    }

                    if (selectedPreset !== 'default' && advancedHeadingPresetStyles[selectedPreset]) {
                        view.model.setSetting(key, advancedHeadingPresetStyles[selectedPreset][key] ?? control.default);
                    } else if (selectedPreset === 'default') {
                        view.model.setSetting(key, control.default);
                    }
                });
                
                view.model.renderRemoteServer();
            });

        });
        elementor.hooks.addAction('panel/open_editor/widget/pea_advanced_image', function(panel, model, view) {
            panel.$el.off('change', '[data-setting="image_styles"]');
            panel.$el.on('change', '[data-setting="image_styles"]', function() {
                view.model.renderRemoteServer();
            });
        });
        elementor.hooks.addAction('panel/open_editor/widget/pea_image_gallery', function(panel, model, view) {
            
            var ImageGalleryPresets = {
                'preset-1': {
                    'grid_height': {
                        'unit': 'px',
                        'size': 410,
                        'sizes': [] // Required for responsive
                    },
                    
                    'gallery_items': [
                        { 'gallery_image_name': 'Image 1'},
                        { 'gallery_image_name': 'Image 2'},
                        { 'gallery_image_name': 'Image 3'},
                        { 'gallery_image_name': 'Image 4'},
                        { 'gallery_image_name': 'Image 5'},
                        { 'gallery_image_name': 'Image 6'},
                    ],
                    'image_border_radius': {
                        'top': '32',
                        'right': '32',
                        'bottom': '32',
                        'left': '32',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'lightbox_icon_padding': {
                        'top': '16',
                        'right': '16',
                        'bottom': '16',
                        'left': '16',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'lightbox_icon_border_border': 'solid',
                    'lightbox_icon_border_width': {
                        'top': '3',
                        'right': '3',
                        'bottom': '3',
                        'left': '3',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'lightbox_icon_border_color': '#399CFF',
                    'lightbox_icon_hover_border_color': '#000',
                    'lightbox_icon_border_radius': {
                        'top': '20',
                        'right': '20',
                        'bottom': '20',
                        'left': '20',
                        'unit': 'px',
                        'isLinked': true
                    },
                },
                'preset-2': {
                    'image_styles': 'black_n_white',
                    'grid_height': {
                        'unit': 'px',
                        'size': 410,
                        'sizes': [] // Required for responsive
                    },
                    'image_gap': {
                        'unit': 'px',
                        'size': 6,
                        'sizes': [] // Required for responsive
                    },
                    'gallery_items': [
                        { 'gallery_image_name': 'Image 1'},
                        { 'gallery_image_name': 'Image 2'},
                        { 'gallery_image_name': 'Image 3'},
                        { 'gallery_image_name': 'Image 4'},
                        { 'gallery_image_name': 'Image 5'},
                        { 'gallery_image_name': 'Image 6'},
                    ],
                    'lightbox_icon_border_border': 'solid',
                    'lightbox_icon_border_width': {
                        'top': '2',
                        'right': '2',
                        'bottom': '2',
                        'left': '2',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'lightbox_icon_border_color': '#F89B2E',
                    'lightbox_icon_hover_border_color': '#000',
                    'lightbox_icon_border_radius': {
                        'top': '20',
                        'right': '20',
                        'bottom': '20',
                        'left': '20',
                        'unit': 'px',
                        'isLinked': true
                    },
                    // 'show_separator': 'no',
                    // 'heading_text_stroke_popover_toggle': 'yes',
                    // 'heading_text_stroke_color': '#399CFF',
                    // 'heading_text_shadow_text_shadow_type': 'yes',
                    // 'heading_text_shadow_text_shadow': {
                    //     'color': '#399CFF1A',
                    //     'blur': 0,
                    //     'horizontal': 0,
                    //     'vertical': 18
                    // },
                    // 'heading_text_gradient_color': '#ffffff',
                    // 'heading_typography_typography': 'custom',
                    // 'heading_typography_font_family': 'Plus Jakarta Sans',
                    // 'heading_typography_font_size': {
                    //     'unit': 'px',
                    //     'size': 72,
                    //     'sizes': [] // Required for responsive
                    // },
                    // 'heading_typography_font_weight': '700',
                    // 'heading_typography_text_transform': 'capitalize',
                    // 'heading_typography_font_style': 'normal',
                    // 'heading_typography_text_decoration': 'none',
                    // 'heading_typography_line_height': {
                    //     'unit': '%',
                    //     'size': 130,
                    //     'sizes': []
                    // },
                },
                'preset-3': {
                    'image_styles': 'color_overlay',
                    'overlay_style': 'overlay-from-bottom',
                    'layouts': 'masonry-layout',
                    'image_columns': {
                        'unit': 'px',
                        'size': 4,
                        'sizes': [] // Required for responsive
                    },
                    'grid_height': {
                        'unit': 'px',
                        'size': 410,
                        'sizes': [] // Required for responsive
                    },
                    'gallery_items': [
                        {   
                            'gallery_image_name': 'Image 1',
                            'gallery_image_column_span': 'span 2',
                            'gallery_image_row_span': 'span 2',
                        },
                        {   'gallery_image_name': 'Image 2',
                            'gallery_image_column_span': 'unset',
                            'gallery_image_row_span': 'span 2',
                        },
                        {   'gallery_image_name': 'Image 3',
                            'gallery_image_column_span': 'unset',
                            'gallery_image_row_span': 'unset',

                        },
                        {   'gallery_image_name': 'Image 4',
                            'gallery_image_column_span': 'unset',
                            'gallery_image_row_span': 'unset',

                        },
                    ],
                    'image_border_radius': {
                        'top': '24',
                        'right': '24',
                        'bottom': '24',
                        'left': '24',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'lightbox_icon_enable': 'no',
                },
                'preset-4': {
                    'image_styles': 'color_overlay',
                    'overlay_style': 'overlay-from-top',
                    'layouts': 'masonry-layout',
                    'image_columns': {
                        'unit': 'px',
                        'size': 4,
                        'sizes': [] // Required for responsive
                    },
                    'grid_height': {
                        'unit': 'px',
                        'size': 410,
                        'sizes': [] // Required for responsive
                    },
                    'gallery_items': [
                        {   
                            'gallery_image_name': 'Image 1',
                            'gallery_image_column_span': 'span 2',
                            'gallery_image_row_span': 'unset',
                        },
                        {   
                            'gallery_image_name': 'Image 2',
                            'gallery_image_column_span': 'unset',
                            'gallery_image_row_span': 'span 2',
                        },
                        {   
                            'gallery_image_name': 'Image 3',
                            'gallery_image_column_span': 'unset',
                            'gallery_image_row_span': 'unset',
                        },
                        {   'gallery_image_name': 'Image 4',
                            'gallery_image_column_span': 'unset',
                            'gallery_image_row_span': 'unset',
                        },
                        {   
                            'gallery_image_name': 'Image 5',
                            'gallery_image_column_span': 'unset',
                            'gallery_image_row_span': 'unset',
                        },
                        {   'gallery_image_name': 'Image 6',
                            'gallery_image_column_span': 'unset',
                            'gallery_image_row_span': 'unset',
                        },
                    ],
                    'image_border_radius': {
                        'top': '24',
                        'right': '24',
                        'bottom': '24',
                        'left': '24',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'lightbox_icon_enable': 'no',
                },
                'preset-5': {
                    'image_styles': 'color_overlay',
                    'overlay_style': 'overlay-from-left',
                    'layouts': 'masonry-layout',
                    'image_columns': {
                        'unit': 'px',
                        'size': 3,
                        'sizes': [] // Required for responsive
                    },
                    'grid_height': {
                        'unit': 'px',
                        'size': 410,
                        'sizes': [] // Required for responsive
                    },
                    'gallery_items': [
                        {   
                            'gallery_image_name': 'Image 1',
                            'gallery_image_column_span': 'unset',
                            'gallery_image_row_span': 'span 2',
                        },
                        {   
                            'gallery_image_name': 'Image 2',
                            'gallery_image_column_span': 'unset',
                            'gallery_image_row_span': 'unset',
                        },
                        {   
                            'gallery_image_name': 'Image 3',
                            'gallery_image_column_span': 'unset',
                            'gallery_image_row_span': 'span 2',
                        },
                        {   'gallery_image_name': 'Image 4',
                            'gallery_image_column_span': 'unset',
                            'gallery_image_row_span': 'unset',
                        },
                    ],
                    'image_border_radius': {
                        'top': '24',
                        'right': '24',
                        'bottom': '24',
                        'left': '24',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'lightbox_icon_enable': 'no',
                },
                'preset-5': {
                    'image_styles': 'color_overlay',
                    'overlay_style': 'overlay-from-left',
                    'layouts': 'masonry-layout',
                    'image_columns': {
                        'unit': 'px',
                        'size': 3,
                        'sizes': [] // Required for responsive
                    },
                    'grid_height': {
                        'unit': 'px',
                        'size': 410,
                        'sizes': [] // Required for responsive
                    },
                    'gallery_items': [
                        {   
                            'gallery_image_name': 'Image 1',
                            'gallery_image_column_span': 'unset',
                            'gallery_image_row_span': 'span 2',
                        },
                        {   
                            'gallery_image_name': 'Image 2',
                            'gallery_image_column_span': 'unset',
                            'gallery_image_row_span': 'unset',
                        },
                        {   
                            'gallery_image_name': 'Image 3',
                            'gallery_image_column_span': 'unset',
                            'gallery_image_row_span': 'span 2',
                        },
                        {   'gallery_image_name': 'Image 4',
                            'gallery_image_column_span': 'unset',
                            'gallery_image_row_span': 'unset',
                        },
                    ],
                    'image_border_radius': {
                        'top': '24',
                        'right': '24',
                        'bottom': '24',
                        'left': '24',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'lightbox_icon_enable': 'no',
                },
            };
                
                
            // ✅ helper to generate unique IDs safely
            function getUniqueID() {
                if (typeof elementorCommon !== 'undefined' && elementorCommon.helpers && elementorCommon.helpers.getUniqueID) {
                    return elementorCommon.helpers.getUniqueID();
                }
                // fallback if elementorCommon not available yet
                return Math.random().toString(36).substr(2, 9);
            }

            panel.$el.off('change', '[data-setting="gallery_preset"]');
            panel.$el.on('change', '[data-setting="gallery_preset"]', function() {
                var selectedPreset = $(this).val();
                const allControls = view.model.get('settings').controls || {};

                _.each(allControls, function(control, key) {
                    if (key === 'gallery_preset') {
                        view.model.setSetting(key, selectedPreset);
                        return;
                    }

                    // Handle repeater items separately
                    if (key === 'gallery_items') {
                        if (selectedPreset !== 'default' && ImageGalleryPresets[selectedPreset] && ImageGalleryPresets[selectedPreset]['gallery_items']) {
                            var presetItems = ImageGalleryPresets[selectedPreset]['gallery_items'];
                            var existingItems = view.model.getSetting('gallery_items');
                            
                            if (existingItems && existingItems.models) {
                                // Remove all existing items using Elementor commands
                                var itemsToRemove = existingItems.models.length;
                                for (var i = itemsToRemove - 1; i >= 0; i--) {
                                    $e.run('document/repeater/remove', {
                                        container: elementor.getContainer(view.model.get('id')),
                                        name: 'gallery_items',
                                        index: i
                                    });
                                }
                                
                                // Add new items from preset using Elementor commands
                                presetItems.forEach(function(newItem, index) {
                                    $e.run('document/repeater/insert', {
                                        container: elementor.getContainer(view.model.get('id')),
                                        name: 'gallery_items',
                                        model: newItem,
                                        index: index
                                    });
                                });
                            }
                        } else if (selectedPreset === 'default') {
                            // Use preset-1 items as default
                            
                    
                            var default_preset = [
                                { 'gallery_image_name': 'Image 1'},
                                { 'gallery_image_name': 'Image 2'},
                                { 'gallery_image_name': 'Image 3'},
                            ];
                            var presetItems = ImageGalleryPresets['preset-1']['gallery_items'];
                            var existingItems = view.model.getSetting('gallery_items');
                            
                            if (existingItems && existingItems.models) {
                                // Remove all existing items using Elementor commands
                                var itemsToRemove = existingItems.models.length;
                                for (var i = itemsToRemove - 1; i >= 0; i--) {
                                    $e.run('document/repeater/remove', {
                                        container: elementor.getContainer(view.model.get('id')),
                                        name: 'gallery_items',
                                        index: i
                                    });
                                }
                                
                                // Add new items from preset using Elementor commands
                                default_preset.forEach(function(newItem, index) {
                                    
                                    $e.run('document/repeater/insert', {
                                        container: elementor.getContainer(view.model.get('id')),
                                        name: 'gallery_items',
                                        model: newItem,
                                        index: index
                                    });
                                });
                            }
                        }
                        return;
                    }

                    // Handle other controls
                    if (selectedPreset !== 'default' && ImageGalleryPresets[selectedPreset]) {
                        view.model.setSetting(key, ImageGalleryPresets[selectedPreset][key] ?? control.default);
                    } else if (selectedPreset === 'default') {
                        view.model.setSetting(key, control.default);
                    }
                });
                
                // Render remote server and refresh repeater control
                view.model.renderRemoteServer();
                // const panelView = panel.getCurrentPageView();
                // const gallery_items_repeater = Object.values(panelView.children._views)[2];
                // console.log(gallery_items_repeater);
                // gallery_items_repeater.render();
            });

        });
        elementor.hooks.addAction('panel/open_editor/widget/pea_info_box', function(panel, model, view) {
            
            var infoBoxPresetStyles = {
                'preset-2': {
                    'title_text': 'User-Friendly Design',
                    'info_icon': {
                        'value': 'fas fa-swatchbook',
                        'library': 'fa-solid'
                    },
                    'show_button': 'no',
                    'info_box_bg_color_background': 'classic',
                    'info_box_bg_color_color': '#F89B2E',
                    'info_box_hover_bg_color_background': 'classic',
                    'info_box_hover_bg_color_color': '#F89B2E',
                    'info_box_border_radius': {
                        'top': '24',
                        'right': '24',
                        'bottom': '24',
                        'left': '24',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'info_box_padding': {
                        'top': '24',
                        'right': '24',
                        'bottom': '24',
                        'left': '24',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'image_n_icon_hover_color': '#fff',
                    'image_n_icon_bg_color_background': 'classic',
                    'image_n_icon_bg_color_color': 'transparent',
                    'image_n_icon_hover_bg_color_background': 'classic',
                    'image_n_icon_hover_bg_color_color': 'transparent',
                    'info_icon_size': {
                        'unit': 'px',
                        'size': 29,
                        'sizes': [] 
                    },
                    'image_n_icon_padding': {
                        'top': '0',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'image_n_icon_margin': {
                        'top': '0',
                        'right': '0',
                        'bottom': '32',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'title_color': '#fff',
                    'title_margin': {
                        'top': '0',
                        'right': '0',
                        'bottom': '14',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'description_color': '#fff',
                    'description_padding': {
                        'top': '0',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'description_margin': {
                        'top': '0',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                },
                'preset-3': {
                    'title_text': 'Customizable Template',
                    'info_icon': {
                        'value': 'fas fa-layer-group',
                        'library': 'fa-solid'
                    },
                    'show_button': 'no',
                    'info_box_bg_color_background': 'classic',
                    'info_box_bg_color_color': '#fff',
                    'info_box_hover_bg_color_background': 'classic',
                    'info_box_hover_bg_color_color': '#fff',
                    'info_box_border_radius': {
                        'top': '24',
                        'right': '24',
                        'bottom': '24',
                        'left': '24',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'info_box_padding': {
                        'top': '0',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'image_n_icon_hover_color': '#fff',
                    'image_n_icon_bg_color_background': 'classic',
                    'image_n_icon_bg_color_color': '#4CAF50',
                    'image_n_icon_hover_bg_color_background': 'classic',
                    'image_n_icon_hover_bg_color_color': '',
                    'info_icon_size': {
                        'unit': 'px',
                        'size': 28,
                        'sizes': [] 
                    },
                    'image_n_icon_border_radius': {
                        'top': '24',
                        'right': '24',
                        'bottom': '24',
                        'left': '24',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'image_n_icon_padding': {
                        'top': '18',
                        'right': '18',
                        'bottom': '18',
                        'left': '18',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'image_n_icon_margin': {
                        'top': '0',
                        'right': '0',
                        'bottom': '32',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'title_color': '#15171C',
                    'title_hover_color': '#15171C',
                    'title_margin': {
                        'top': '0',
                        'right': '0',
                        'bottom': '14',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'description_color': '#555E72',
                    'description_hover_color': '#555E72',
                    'description_padding': {
                        'top': '0',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'description_margin': {
                        'top': '0',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                },
                'preset-4': {
                    'title_text': 'Secure Data Protection',
                    'info_icon': {
                        'value': 'fas fa-shield-alt',
                        'library': 'fa-solid'
                    },
                    'show_button': 'yes',
                    'info_box_bg_color_background': 'classic',
                    'info_box_bg_color_color': '#F7F7F7',
                    'info_box_hover_bg_color_background': 'classic',
                    'info_box_hover_bg_color_color': '#F7F7F7',
                    'info_box_border_radius': {
                        'top': '6',
                        'right': '6',
                        'bottom': '6',
                        'left': '6',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'info_box_padding': {
                        'top': '24',
                        'right': '24',
                        'bottom': '24',
                        'left': '24',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'image_n_icon_hover_color': '#fff',
                    'image_n_icon_bg_color_background': 'classic',
                    'image_n_icon_bg_color_color': '#15171C',
                    'image_n_icon_hover_bg_color_background': 'classic',
                    'image_n_icon_hover_bg_color_color': '',
                    'info_icon_size': {
                        'unit': 'px',
                        'size': 29,
                        'sizes': [] 
                    },
                    'image_n_icon_border_radius': {
                        'top': '30',
                        'right': '30',
                        'bottom': '30',
                        'left': '30',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'image_n_icon_padding': {
                        'top': '20',
                        'right': '20',
                        'bottom': '20',
                        'left': '20',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'image_n_icon_margin': {
                        'top': '0',
                        'right': '0',
                        'bottom': '32',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'title_color': '#15171C',
                    'title_hover_color': '#15171C',
                    'title_margin': {
                        'top': '0',
                        'right': '0',
                        'bottom': '14',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'description_color': '#555E72',
                    'description_hover_color': '#555E72',
                    'description_padding': {
                        'top': '0',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'description_margin': {
                        'top': '0',
                        'right': '0',
                        'bottom': '30',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'button_color': '#15171C',
                    'button_hover_color': '#15171C',
                    'button_icon_color': '#15171C',
                    'button_icon_hover_color': '#15171C',
                    'button_margin': {
                        'top': '0',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                },
                'preset-5': {
                    'title_text': 'User-Friendly Design',
                    'info_icon': {
                        'value': 'fas fa-paint-brush',
                        'library': 'fa-solid'
                    },
                    'show_button': 'yes',
                    'info_box_bg_color_background': 'classic',
                    'info_box_bg_color_color': '#fff',
                    'info_box_hover_bg_color_background': 'classic',
                    'info_box_hover_bg_color_color': '#fff',
                    'info_box_border_radius': {
                        'top': '24',
                        'right': '24',
                        'bottom': '24',
                        'left': '24',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'info_box_padding': {
                        'top': '0',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'image_n_icon_hover_color': '#fff',
                    'image_n_icon_bg_color_background': 'gradient',
                    'image_n_icon_bg_color_color': '#C774FF',
                    'image_n_icon_bg_color_color_stop': {
                        'unit': '%',
                        'size': 0,
                        'sizes': [] // Required for responsive
                    },
                    'image_n_icon_bg_color_color_b': '#740CF5',
                    'image_n_icon_bg_color_color_b_stop': {
                        'unit': '%',
                        'size': 100,
                        'sizes': [] // Required for responsive
                    },
                    'image_n_icon_bg_color_gradient_angle': {
                        'unit': 'deg',
                        'size': 270,
                        'sizes': [] // Required for responsive
                    },
                    'image_n_icon_hover_bg_color_background': 'classic',
                    'image_n_icon_hover_bg_color_color': 'transparent',
                    'image_n_icon_box_shadow_box_shadow_type': 'yes',
                    "image_n_icon_box_shadow_box_shadow": {
                        "horizontal": 0,
                        "vertical": 15,
                        "blur": 30,
                        "spread": 0,
                        "color": "#9031CF66"
                    },
                    'image_n_icon_hover_bg_color_gradient_angle': {
                        'unit': 'deg',
                        'size': 270,
                        'sizes': [] // Required for responsive
                    },
                    'info_icon_size': {
                        'unit': 'px',
                        'size': 28,
                        'sizes': [] 
                    },
                    'image_n_icon_border_radius_custom': '70% 30% 30% 70% / 60% 40% 60% 40%',
                    'image_n_icon_border_radius': {
                        'top': '',
                        'right': '',
                        'bottom': '',
                        'left': '',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'image_n_icon_padding': {
                        'top': '18',
                        'right': '18',
                        'bottom': '18',
                        'left': '18',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'image_n_icon_margin': {
                        'top': '0',
                        'right': '0',
                        'bottom': '32',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'title_color': '#15171C',
                    'title_hover_color': '#15171C',
                    'title_margin': {
                        'top': '0',
                        'right': '0',
                        'bottom': '14',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'description_color': '#555E72',
                    'description_hover_color': '#555E72',
                    'description_padding': {
                        'top': '0',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'description_margin': {
                        'top': '0',
                        'right': '0',
                        'bottom': '30',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'button_color': '#BD59FF',
                    'button_hover_color': '#BD59FF',
                    'button_icon_color': '#BD59FF',
                    'button_icon_hover_color': '#BD59FF',
                    'button_margin': {
                        'top': '0',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                },
                'preset-6': {
                    'title_text': 'Responsive Layout',
                    'info_icon': {
                        'value': 'fab fa-squarespace',
                        'library': 'fa-brands'
                    },
                    'show_button': 'yes',
                    'button_text': '',
                    'info_box_bg_color_background': 'classic',
                    'info_box_bg_color_color': '#FFF6F7',
                    'info_box_hover_bg_color_background': 'classic',
                    'info_box_hover_bg_color_color': '#FFF6F7',
                    'info_box_border_radius': {
                        'top': '18',
                        'right': '18',
                        'bottom': '18',
                        'left': '18',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'info_box_padding': {
                        'top': '32',
                        'right': '32',
                        'bottom': '32',
                        'left': '32',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'image_n_icon_color': '#E43242',
                    'image_n_icon_hover_color': '#E43242',
                    'image_n_icon_bg_color_background': 'classic',
                    'image_n_icon_bg_color_color': 'transparent',
                    'image_n_icon_hover_bg_color_background': 'classic',
                    'image_n_icon_hover_bg_color_color': 'transparent',
                    'info_icon_size': {
                        'unit': 'px',
                        'size': 29,
                        'sizes': [] 
                    },
                    'image_n_icon_padding': {
                        'top': '0',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'image_n_icon_margin': {
                        'top': '0',
                        'right': '0',
                        'bottom': '32',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'title_color': '#15171C',
                    'title_hover_color': '#15171C',
                    'title_margin': {
                        'top': '0',
                        'right': '0',
                        'bottom': '14',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'description_color': '#555E72',
                    'description_hover_color': '#555E72',
                    'description_padding': {
                        'top': '0',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'description_margin': {
                        'top': '0',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'button_icon_color': '#E43242',
                    'button_icon_hover_color': '#E43242',
                    'button_bg_color': '#FFF6F7',
                    'button_hover_bg_color': '#FFF6F7',
                    'button_border_radius': {
                        'top': '18',
                        'right': '18',
                        'bottom': '18',
                        'left': '8',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'button_padding': {
                        'top': '19',
                        'right': '19',
                        'bottom': '19',
                        'left': '19',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'button_margin': {
                        'top': '0',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                },
            };

                
            
            panel.$el.off('change', '[data-setting="preset_styles"]');
            panel.$el.on('change', '[data-setting="preset_styles"]', function() {
                var selectedPreset = $(this).val();
                const allControls = view.model.get('settings').controls || {};

                _.each(allControls, function(control, key) {
                    if (key === 'preset_styles') {
                        view.model.setSetting(key, selectedPreset);
                        return;
                    }

                    if (selectedPreset !== 'default' && infoBoxPresetStyles[selectedPreset]) {
                        view.model.setSetting(key, infoBoxPresetStyles[selectedPreset][key] ?? control.default);
                    } else if (selectedPreset === 'default') {
                        view.model.setSetting(key, control.default);
                    }
                });
                
                view.model.renderRemoteServer();
                
            });

        });
        elementor.hooks.addAction('panel/open_editor/widget/pea_advanced_button', function(panel, model, view) {
            var advancedButtonPresetStyles = {
                'preset-2': {
                    'button_text': 'Link Button',
                    'choose_button_icon_or_img': 'icon',
                    'button_image_or_icon_position': 'left',
                    'button_icon': {
                        'value': 'fas fa-cloud-download-alt',
                        'library': 'fa-solid'
                    },
                    'button_color_type': 'classic',
                    'button_color_color': '#399CFF',
                    'button_hover_color_type': 'classic',
                    'button_hover_color_color': '#fff',
                    'button_bg_color_background': 'classic',
                    'button_bg_color_color': '#fff',
                    'button_hover_bg_color_background': 'classic',
                    'button_hover_bg_color_color': '#399CFF',
                    'button_border_type_border': 'dashed',
                    'button_border_type_width': {
                        'top': '2',
                        'right': '2',
                        'bottom': '2',
                        'left': '2',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'button_border_type_color': '#399CFF',
                    'button_hover_border_type_border': 'solid',
                    'button_hover_border_type_width': {
                        'top': '',
                        'right': '',
                        'bottom': '',
                        'left': '',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'button_hover_border_type_color': '#399CFF',
                    'button_border_radius': {
                        'top': '50',
                        'right': '50',
                        'bottom': '50',
                        'left': '50',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'button_icon_n_image_rotate': {
                        'unit': 'deg',
                        'size': 0,
                        'sizes': [] 
                    },
                    'button_icon_n_image_hover_rotate': {
                        'unit': 'deg',
                        'size': 40,
                        'sizes': [] 
                    },
                    'button_icon_color': '#399CFF',
                    'button_icon_hover_color': '#fff',
                },
                'preset-3': {
                    'button_text': 'Search',
                    'choose_button_icon_or_img': 'icon',
                    'button_image_or_icon_position': 'left',
                    'button_icon': {
                        'value': 'fas fa-search',
                        'library': 'fa-solid'
                    },
                    'button_color_type': 'classic',
                    'button_color_color': '#15171C',
                    'button_hover_color_type': 'classic',
                    'button_hover_color_color': '',
                    'button_bg_color_background': 'classic',
                    'button_bg_color_color': '#fff',
                    'button_hover_bg_color_background': 'classic',
                    'button_hover_bg_color_color': '',
                    'button_border_type_border': 'solid',
                    'button_border_type_width': {
                        'top': '2',
                        'right': '2',
                        'bottom': '2',
                        'left': '2',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'button_border_type_color': '#C3C8D2',
                    'button_hover_border_type_border': 'defualt',
                    'button_border_radius': {
                        'top': '50',
                        'right': '50',
                        'bottom': '50',
                        'left': '50',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'button_icon_n_image_rotate': {
                        'unit': 'deg',
                        'size': 0,
                        'sizes': [] 
                    },
                    'button_icon_n_image_hover_rotate': {
                        'unit': 'deg',
                        'size': 90,
                        'sizes': [] 
                    },
                    'button_icon_color': '#15171C',
                    'button_icon_hover_color': '',
                },
                'preset-4': {
                    'button_text': 'Style 4',
                    'choose_button_icon_or_img': 'icon',
                    'button_image_or_icon_position': 'left',
                    'button_icon': {
                        'value': 'fas fa-arrow-right',
                        'library': 'fa-solid'
                    },
                    'button_color_type': 'classic',
                    'button_color_color': '#fff',
                    'button_hover_color_type': 'classic',
                    'button_hover_color_color': '',
                    'button_bg_color_background': 'classic',
                    'button_bg_color_color': '#399CFF',
                    'button_hover_bg_color_background': 'classic',
                    'button_hover_bg_color_color': '',
                    'button_border_type_border': 'none',
                    'button_hover_border_type_border': 'defualt',
                    'button_border_radius': {
                        'top': '8',
                        'right': '8',
                        'bottom': '8',
                        'left': '8',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'button_padding': {
                        'top': '8',
                        'right': '16',
                        'bottom': '8',
                        'left': '8',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'button_icon_size': {
                        'unit': 'px',
                        'size': 14,
                        'sizes': [] 
                    },
                    'button_icon_n_image_rotate': {
                        'unit': 'deg',
                        'size': 0,
                        'sizes': [] 
                    },
                    'button_icon_n_image_hover_rotate': {
                        'unit': 'deg',
                        'size': 0,
                        'sizes': [] 
                    },
                    'button_icon_color': '#399CFF',
                    'button_icon_hover_color': '',
                    'button_icon_n_image_bg_color_background': 'classic',
                    'button_icon_n_image_bg_color_color': '#fff',
                    'button_icon_n_image_hover_bg_color_background': 'classic',
                    'button_icon_n_image_hover_bg_color_color': '',
                    'button_icon_n_image_border_radius': {
                        'top': '8',
                        'right': '8',
                        'bottom': '8',
                        'left': '8',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'button_icon_n_image_padding': {
                        'top': '8',
                        'right': '8',
                        'bottom': '8',
                        'left': '8',
                        'unit': 'px',
                        'isLinked': true
                    },
                },
                'preset-5': {
                    'button_text': 'Style 5',
                    'choose_button_icon_or_img': 'icon',
                    'button_image_or_icon_position': 'right',
                    'button_icon': {
                        'value': 'fas fa-arrow-right',
                        'library': 'fa-solid'
                    },
                    'button_color_type': 'classic',
                    'button_color_color': '#fff',
                    'button_hover_color_type': 'classic',
                    'button_hover_color_color': '',
                    'button_bg_color_background': 'classic',
                    'button_bg_color_color': '#4CAF50',
                    'button_hover_bg_color_background': 'classic',
                    'button_hover_bg_color_color': '',
                    'button_border_type_border': 'none',
                    'button_hover_border_type_border': 'defualt',
                    'button_border_radius': {
                        'top': '50',
                        'right': '50',
                        'bottom': '50',
                        'left': '50',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'button_padding': {
                        'top': '8',
                        'right': '8',
                        'bottom': '8',
                        'left': '16',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'button_icon_size': {
                        'unit': 'px',
                        'size': 14,
                        'sizes': [] 
                    },
                    'button_icon_n_image_rotate': {
                        'unit': 'deg',
                        'size': 0,
                        'sizes': [] 
                    },
                    'button_icon_n_image_hover_rotate': {
                        'unit': 'deg',
                        'size': 0,
                        'sizes': [] 
                    },
                    'button_icon_color': '#4CAF50',
                    'button_icon_hover_color': '',
                    'button_icon_n_image_bg_color_background': 'classic',
                    'button_icon_n_image_bg_color_color': '#fff',
                    'button_icon_n_image_hover_bg_color_background': 'classic',
                    'button_icon_n_image_hover_bg_color_color': '',
                    'button_icon_n_image_border_radius': {
                        'top': '50',
                        'right': '50',
                        'bottom': '50',
                        'left': '50',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'button_icon_n_image_padding': {
                        'top': '8',
                        'right': '8',
                        'bottom': '8',
                        'left': '8',
                        'unit': 'px',
                        'isLinked': true
                    },
                },
                'preset-6': {
                    'button_text': 'Style 6',
                    'choose_button_icon_or_img': 'icon',
                    'button_image_or_icon_position': 'right',
                    'button_icon': {
                        'value': 'fas fa-arrow-right',
                        'library': 'fa-solid'
                    },
                    'button_color_type': 'classic',
                    'button_color_color': '#fff',
                    'button_hover_color_type': 'classic',
                    'button_hover_color_color': '',
                    'button_bg_color_background': 'classic',
                    'button_bg_color_color': '#399CFF',
                    'button_hover_bg_color_background': 'classic',
                    'button_hover_bg_color_color': '',
                    'button_border_type_border': 'none',
                    'button_hover_border_type_border': 'defualt',
                    'button_border_radius': {
                        'top': '8',
                        'right': '8',
                        'bottom': '8',
                        'left': '8',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'button_padding': {
                        'top': '8',
                        'right': '8',
                        'bottom': '8',
                        'left': '24',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'button_icon_size': {
                        'unit': 'px',
                        'size': 14,
                        'sizes': [] 
                    },
                    'button_icon_n_image_rotate': {
                        'unit': 'deg',
                        'size': 0,
                        'sizes': [] 
                    },
                    'button_icon_n_image_hover_rotate': {
                        'unit': 'deg',
                        'size': 0,
                        'sizes': [] 
                    },
                    'button_icon_color': '#fff',
                    'button_icon_hover_color': '',
                    'button_icon_n_image_bg_color_background': 'classic',
                    'button_icon_n_image_bg_color_color': '#399CFF',
                    'button_icon_n_image_hover_bg_color_background': 'classic',
                    'button_icon_n_image_hover_bg_color_color': '',
                    'button_icon_n_image_border_border': 'solid',
                    'button_icon_n_image_border_width': {
                        'top': '3',
                        'right': '3',
                        'bottom': '3',
                        'left': '3',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'button_icon_n_image_border_color': '#fff',
                    'button_icon_n_image_border_radius': {
                        'top': '50',
                        'right': '50',
                        'bottom': '50',
                        'left': '50',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'button_icon_n_image_padding': {
                        'top': '8',
                        'right': '8',
                        'bottom': '8',
                        'left': '8',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'button_icon_n_image_margin': {
                        'top': '0',
                        'right': '-24',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                },
                'preset-7': {
                    'button_text': 'Style 7',
                    'choose_button_icon_or_img': 'none',
                    'button_color_type': 'classic',
                    'button_color_color': '#fff',
                    'button_hover_color_type': 'classic',
                    'button_hover_color_color': '',
                    'button_bg_color_background': 'gradient',
                    'button_bg_color_color': '#FF9F47',
                    'button_bg_color_color_stop': {
                        'unit': '%',
                        'size': 0,
                        'sizes': [] // Required for responsive
                    },
                    'button_bg_color_color_b': '#FF1100',
                    'button_bg_color_color_b_stop': {
                        'unit': '%',
                        'size': 100,
                        'sizes': [] // Required for responsive
                    },
                    'button_bg_color_gradient_angle': {
                        'unit': 'deg',
                        'size': 97.53,
                        'sizes': [] // Required for responsive
                    },
                    'button_hover_bg_color_background': 'classic',
                    'button_hover_bg_color_color': '',
                    'button_border_type_border': 'none',
                    'button_hover_border_type_border': 'defualt',
                    'button_border_radius': {
                        'top': '50',
                        'right': '50',
                        'bottom': '50',
                        'left': '50',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'button_padding': {
                        'top': '14',
                        'right': '24',
                        'bottom': '14',
                        'left': '24',
                        'unit': 'px',
                        'isLinked': true
                    },
                },
                'preset-8': {
                    'button_text': 'Style 8',
                    'choose_button_icon_or_img': 'none',
                    'button_color_type': 'gradient',
                    'button_color_color_start': '#FF9B45',
                    'button_color_color_start_loc': {
                        'unit': '%',
                        'size': 0,
                        'sizes': [] // Required for responsive
                    },
                    'button_color_color_end': '#FF1904',
                    'button_color_color_end_loc': {
                        'unit': '%',
                        'size': 100,
                        'sizes': [] // Required for responsive
                    },
                    'button_color_color_angle': {
                        'unit': 'deg',
                        'size': 90,
                        'sizes': [] // Required for responsive
                    },
                    'button_hover_color_type': 'classic',
                    'button_hover_color_color': '',
                    'button_bg_color_background': 'classic',
                    'button_bg_color_color': '#fff',
                    'button_hover_bg_color_background': 'classic',
                    'button_hover_bg_color_color': '',
                    'button_border_type_border': 'none',
                    'button_hover_border_type_border': 'defualt',
                    'button_border_radius': {
                        'top': '50',
                        'right': '50',
                        'bottom': '50',
                        'left': '50',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'button_padding': {
                        'top': '14',
                        'right': '24',
                        'bottom': '14',
                        'left': '24',
                        'unit': 'px',
                        'isLinked': true
                    },
                },
            };
            
            panel.$el.off('change', '[data-setting="button_presets"]');
            panel.$el.on('change', '[data-setting="button_presets"]', function() {
                var selectedPreset = $(this).val();
                const allControls = view.model.get('settings').controls || {};

                _.each(allControls, function(control, key) {
                    if (key === 'button_presets') {
                        view.model.setSetting(key, selectedPreset);
                        return;
                    }

                    if (selectedPreset !== 'default' && advancedButtonPresetStyles[selectedPreset]) {
                        view.model.setSetting(key, advancedButtonPresetStyles[selectedPreset][key] ?? control.default);
                    } else if (selectedPreset === 'default') {
                        view.model.setSetting(key, control.default);
                    }
                });
                
                view.model.renderRemoteServer();
            });

        });
        elementor.hooks.addAction('panel/open_editor/widget/pea_dual_button', function(panel, model, view) {
            var dualButtonPresetStyles = {
                'preset-2': {
                    'choose_button_one_icon_or_img': 'icon',
                    'button_one_icon': {
                        'value': 'fas fa-home',
                        'library': 'fa-solid'
                    },
                    'choose_button_two_icon_or_img': 'icon',
                    'button_two_icon': {
                        'value': 'far fa-check-square',
                        'library': 'fa-solid'
                    },
                },
                'preset-3': {
                    'choose_button_one_icon_or_img': 'none',
                    'button_one_icon': {
                        'value': 'fas fa-home',
                        'library': 'fa-solid'
                    },
                    'choose_button_two_icon_or_img': 'none',
                    'button_two_icon': {
                        'value': 'far fa-check-square',
                        'library': 'fa-solid'
                    },
                    'button_one_border_radius': {
                        'top': '50',
                        'right': '50',
                        'bottom': '50',
                        'left': '50',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'button_two_border_radius': {
                        'top': '50',
                        'right': '50',
                        'bottom': '50',
                        'left': '50',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'button_two_color': '#15171C',
                    'button_two_hover_color': '#15171C',
                    'button_two_bg_color': '#fff',
                    'button_two_hover_bg_color': '#fff',
                    'button_two_border_type_border': 'solid',
                    'button_two_border_type_width': {
                        'top': '1',
                        'right': '1',
                        'bottom': '1',
                        'left': '1',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'button_two_border_type_color': '#399CFF',
                    'button_two_icon_color': '#15171C',
                },
                'preset-4': {
                    'choose_button_one_icon_or_img': 'icon',
                    'button_one_icon': {
                        'value': 'fas fa-home',
                        'library': 'fa-solid'
                    },
                    'choose_button_two_icon_or_img': 'icon',
                    'show_connector_text': 'no',
                    'button_two_icon': {
                        'value': 'far fa-check-square',
                        'library': 'fa-solid'
                    },
                    'button_one_border_radius': {
                        'top': '50',
                        'right': '50',
                        'bottom': '50',
                        'left': '50',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'button_two_border_radius': {
                        'top': '50',
                        'right': '50',
                        'bottom': '50',
                        'left': '50',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'button_gap': {
                        'unit': 'px',
                        'size': 10,
                        'sizes': [] 
                    },
                    'button_two_color': '#15171C',
                    'button_two_hover_color': '#15171C',
                    'button_two_bg_color': '#fff',
                    'button_two_hover_bg_color': '#fff',
                    'button_two_border_type_border': 'solid',
                    'button_two_border_type_width': {
                        'top': '1',
                        'right': '1',
                        'bottom': '1',
                        'left': '1',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'button_two_border_type_color': '#399CFF',
                    'button_two_icon_color': '#15171C',
                },
                'preset-5': {
                    'choose_button_one_icon_or_img': 'none',
                    'choose_button_two_icon_or_img': 'none',
                    'button_one_border_radius': {
                        'top': '0',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'button_two_border_radius': {
                        'top': '0',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                },
                'preset-6': {
                    'choose_button_one_icon_or_img': 'icon',
                    'button_one_icon': {
                        'value': 'fas fa-home',
                        'library': 'fa-solid'
                    },
                    'choose_button_two_icon_or_img': 'icon',
                    'button_two_icon': {
                        'value': 'far fa-check-square',
                        'library': 'fa-solid'
                    },
                    'button_one_border_radius': {
                        'top': '0',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'button_two_border_radius': {
                        'top': '0',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                },
                'preset-7': {
                    'choose_button_one_icon_or_img': 'none',
                    'choose_button_two_icon_or_img': 'none',
                    'show_connector_text': 'no',
                    'button_one_border_radius': {
                        'top': '0',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'button_two_border_radius': {
                        'top': '0',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'button_width': {
                        'unit': '%',
                        'size': '',
                        'sizes': [] 
                    },
                    'button_gap': {
                        'unit': 'px',
                        'size': 10,
                        'sizes': [] 
                    },
                    'button_direction': 'column',
                    'button_alignment': 'center',
                },
                'preset-8': {
                    'choose_button_one_icon_or_img': 'icon',
                    'button_one_icon': {
                        'value': 'fas fa-home',
                        'library': 'fa-solid'
                    },
                    'choose_button_two_icon_or_img': 'icon',
                    'button_two_icon': {
                        'value': 'far fa-check-square',
                        'library': 'fa-solid'
                    },
                    'show_connector_text': 'no',
                    'button_one_border_radius': {
                        'top': '0',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'button_two_border_radius': {
                        'top': '0',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'button_width': {
                        'unit': '%',
                        'size': '',
                        'sizes': [] 
                    },
                    'button_gap': {
                        'unit': 'px',
                        'size': 10,
                        'sizes': [] 
                    },
                    'button_direction': 'column',
                    'button_alignment': 'center',
                },
            };
            
            panel.$el.off('change', '[data-setting="button_presets"]');
            panel.$el.on('change', '[data-setting="button_presets"]', function() {
                var selectedPreset = $(this).val();
                const allControls = view.model.get('settings').controls || {};

                _.each(allControls, function(control, key) {
                    if (key === 'button_presets') {
                        view.model.setSetting(key, selectedPreset);
                        return;
                    }

                    if (selectedPreset !== 'default' && dualButtonPresetStyles[selectedPreset]) {
                        view.model.setSetting(key, dualButtonPresetStyles[selectedPreset][key] ?? control.default);
                    } else if (selectedPreset === 'default') {
                        view.model.setSetting(key, control.default);
                    }
                });
                
                view.model.renderRemoteServer();
            });

        });
        elementor.hooks.addAction('panel/open_editor/widget/pea_flip_box', function(panel, model, view) {
            var dualButtonPresetStyles = {
                'preset-2': {
                    // Front
                    'animation_effect': 'flip-up',
                    'front_box_bg_color_background': 'classic',
                    'front_box_bg_color_color': '#E95B68',
                    'front_media_type': 'icon',
                    'front_media_icon': {
                        'value': 'fas fa-rocket',
                        'library': 'fa-solid'
                    },
                    'front_media_icon_size': {
                        'unit': 'px',
                        'size': 110,
                        'sizes': [] 
                    },
                    'front_media_color': '#fff',
                    'front_media_bg_color_background': 'classic',
                    'front_media_bg_color_color': 'transparent',
                    'front_title_show': 'yes',
                    'front_title_text': 'UI / UX Design',
                    'front_desc_show': 'yes',
                    'front_desc_text': 'Corrupti non maiores atque. Repellendus nulla ratione omnis possimus. sit numquam minima ut harum eaque.',
                    'front_button_show': 'yes',
                    'front_title_color': '#fff',
                    'front_desc_color': '#FFF6F7',
                    'front_button_color': '#fff',
                    'front_button_icon_color': '#fff',
                    // Back 
                    'back_box_bg_color_background': 'classic',
                    'back_box_bg_color_color': '#B639FF',
                    'back_media_type': 'icon',
                    'back_media_icon': {
                        'value': 'fas fa-rocket',
                        'library': 'fa-solid'
                    },
                    'back_media_icon_size': {
                        'unit': 'px',
                        'size': 110,
                        'sizes': [] 
                    },
                    'back_media_color': '#fff',
                    'back_media_bg_color_background': 'classic',
                    'back_media_bg_color_color': 'transparent',
                    'back_title_show': 'yes',
                    'back_title_text': 'Interface Design',
                    'back_desc_show': 'no',
                    'back_button_show': 'no',
                    'back_title_color': '#fff',
                    'back_desc_color': '#FFF6F7',
                    'back_button_color': '#fff',
                    'back_button_icon_color': '#fff',
                },
                'preset-3': {
                    // Front
                    'animation_effect': 'zoom-in',
                    'front_box_bg_color_background': 'gradient',
                    'front_box_bg_color_color': '#9AFFFF',
                    'front_box_bg_color_color_stop': {
                        'unit': '%',
                        'size': 0,
                        'sizes': [] // Required for responsive
                    },
                    'front_box_bg_color_color_b': '#0987CB',
                    'front_box_bg_color_color_b_stop': {
                        'unit': '%',
                        'size': 100,
                        'sizes': [] // Required for responsive
                    },
                    'front_box_bg_color_gradient_angle': {
                        'unit': 'deg',
                        'size': 111.3,
                        'sizes': [] // Required for responsive
                    },
                    'front_media_type': 'none',
                    'back_media_type': 'none',
                    'front_media_color': '#fff',
                    'front_media_bg_color_background': 'classic',
                    'front_media_bg_color_color': 'transparent',
                    'front_title_show': 'yes',
                    'front_title_text': 'Animation',
                    'front_desc_show': 'no',
                    'front_button_show': 'no',
                    'front_title_color': '#fff',
                    'front_title_hover_color': '#fff',
                    // Back 
                    'back_box_bg_color_background': 'gradient',
                    'back_box_bg_color_color': '#9AFFFF',
                    'back_box_bg_color_color_stop': {
                        'unit': '%',
                        'size': 0,
                        'sizes': [] // Required for responsive
                    },
                    'back_box_bg_color_color_b': '#0987CB',
                    'back_box_bg_color_color_b_stop': {
                        'unit': '%',
                        'size': 100,
                        'sizes': [] // Required for responsive
                    },
                    'back_box_bg_color_gradient_angle': {
                        'unit': 'deg',
                        'size': 111.3,
                        'sizes': [] // Required for responsive
                    },
                    'back_media_type': 'none',
                    'back_media_color': '#fff',
                    'back_media_bg_color_background': 'classic',
                    'back_media_bg_color_color': 'transparent',
                    'back_title_show': 'yes',
                    'back_title_text': 'Zoom In',
                    'back_desc_show': 'no',
                    'back_button_show': 'no',
                    'back_title_color': '#fff',
                    'back_title_hover_color': '#fff',
                },
                'preset-4': {
                    // Front
                    'animation_effect': 'zoom-out',
                    'front_box_bg_color_background': 'gradient',
                    'front_box_bg_color_color': '#9AFFFF',
                    'front_box_bg_color_color_stop': {
                        'unit': '%',
                        'size': 0,
                        'sizes': [] // Required for responsive
                    },
                    'front_box_bg_color_color_b': '#0987CB',
                    'front_box_bg_color_color_b_stop': {
                        'unit': '%',
                        'size': 100,
                        'sizes': [] // Required for responsive
                    },
                    'front_box_bg_color_gradient_angle': {
                        'unit': 'deg',
                        'size': 111.3,
                        'sizes': [] // Required for responsive
                    },
                    'front_media_type': 'none',
                    'back_media_type': 'none',
                    'front_media_color': '#fff',
                    'front_media_bg_color_background': 'classic',
                    'front_media_bg_color_color': 'transparent',
                    'front_title_show': 'yes',
                    'front_title_text': 'Hello',
                    'front_desc_show': 'no',
                    'front_button_show': 'no',
                    'front_title_color': '#fff',
                    'front_title_hover_color': '#fff',
                    // Back 
                    'back_box_bg_color_background': 'gradient',
                    'back_box_bg_color_color': '#9AFFFF',
                    'back_box_bg_color_color_stop': {
                        'unit': '%',
                        'size': 0,
                        'sizes': [] // Required for responsive
                    },
                    'back_box_bg_color_color_b': '#0987CB',
                    'back_box_bg_color_color_b_stop': {
                        'unit': '%',
                        'size': 100,
                        'sizes': [] // Required for responsive
                    },
                    'back_box_bg_color_gradient_angle': {
                        'unit': 'deg',
                        'size': 111.3,
                        'sizes': [] // Required for responsive
                    },
                    'back_media_type': 'none',
                    'back_media_color': '#fff',
                    'back_media_bg_color_background': 'classic',
                    'back_media_bg_color_color': 'transparent',
                    'back_title_show': 'yes',
                    'back_title_text': 'Zoom Out',
                    'back_desc_show': 'no',
                    'back_button_show': 'no',
                    'back_title_color': '#fff',
                    'back_title_hover_color': '#fff',
                },
                'preset-5': {
                    // Front
                    'animation_effect': 'fade',
                    'front_box_bg_color_background': 'gradient',
                    'front_box_bg_color_color': '#E66BFF',
                    'front_box_bg_color_color_stop': {
                        'unit': '%',
                        'size': 0,
                        'sizes': [] // Required for responsive
                    },
                    'front_box_bg_color_color_b': '#7326B3',
                    'front_box_bg_color_color_b_stop': {
                        'unit': '%',
                        'size': 100,
                        'sizes': [] // Required for responsive
                    },
                    'front_box_bg_color_gradient_angle': {
                        'unit': 'deg',
                        'size': 111.3,
                        'sizes': [] // Required for responsive
                    },
                    'front_media_type': 'none',
                    'front_media_bg_color_background': 'classic',
                    'front_media_bg_color_color': 'transparent',
                    'front_title_show': 'yes',
                    'front_title_text': 'Fading',
                    'front_desc_show': 'yes',
                    'front_desc_text': 'Corrupti non maiores atque. Repellendus ratione omnis numquam harum eaque.',
                    'front_button_show': 'noe',
                    'front_title_color': '#fff',
                    'front_desc_color': '#FFF6F7',
                    // Back 
                    'back_media_type': 'none',
                    'back_box_bg_color_background': 'gradient',
                    'back_box_bg_color_color': '#9AFFFF',
                    'back_box_bg_color_color_stop': {
                        'unit': '%',
                        'size': 0,
                        'sizes': [] // Required for responsive
                    },
                    'back_box_bg_color_color_b': '#0987CB',
                    'back_box_bg_color_color_b_stop': {
                        'unit': '%',
                        'size': 100,
                        'sizes': [] // Required for responsive
                    },
                    'back_box_bg_color_gradient_angle': {
                        'unit': 'deg',
                        'size': 111.3,
                        'sizes': [] // Required for responsive
                    },
                    'back_media_bg_color_background': 'classic',
                    'back_media_bg_color_color': 'transparent',
                    'back_title_show': 'no',
                    'back_desc_show': 'no',
                    'back_button_show': 'yes',
                    'back_button_color': '#399CFF',
                    'back_button_hover_color': '#399CFF',
                    'back_button_bg_color': '#fff',
                    'back_button_hover_bg_color': '#fff',
                    'back_button_icon_color': '#399CFF',
                    'back_button_icon_hover_color': '#399CFF',
                    'back_button_padding': {
                        'top': '14',
                        'right': '24',
                        'bottom': '14',
                        'left': '24',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'back_button_border_radius': {
                        'top': '8',
                        'right': '8',
                        'bottom': '8',
                        'left': '8',
                        'unit': 'px',
                        'isLinked': true
                    },
                },
            };
            
            panel.$el.off('change', '[data-setting="preset_styles"]');
            panel.$el.on('change', '[data-setting="preset_styles"]', function() {
                var selectedPreset = $(this).val();
                const allControls = view.model.get('settings').controls || {};

                _.each(allControls, function(control, key) {
                    if (key === 'preset_styles') {
                        view.model.setSetting(key, selectedPreset);
                        return;
                    }

                    if (selectedPreset !== 'default' && dualButtonPresetStyles[selectedPreset]) {
                        view.model.setSetting(key, dualButtonPresetStyles[selectedPreset][key] ?? control.default);
                    } else if (selectedPreset === 'default') {
                        view.model.setSetting(key, control.default);
                    }
                });
                
                view.model.renderRemoteServer();
            });

        });
        elementor.hooks.addAction('panel/open_editor/widget/pea_feature_list', function(panel, model, view) {
            
            var featureListPresetStyles = {
                'preset-2': {
                    'feature_list_box_bg_color_background': 'classic',
                    'feature_list_box_bg_color_color': 'transparent',
                    'feature_list_box_hover_bg_color_background': 'classic',
                    'feature_list_box_hover_bg_color_color': 'transparent',
                    'feature_list_image_n_icon_border_radius': {
                        'top': '4',
                        'right': '4',
                        'bottom': '4',
                        'left': '4',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'feature_list': [
                        {    
                            'feature_list_item_media_type': 'icon',
                            'feature_list_item_icon':  {
                                'value': 'fas fa-server',
                                'library': 'fa-solid'
                            },
                            'feature_list_item_title': 'Fast Loading  Speed',
                            'feature_list_item_desc': 'Corrupti maiores atque repellendus ratione omnis possimus. Eaque laudantium tenetur.',
                            'feature_list_custom_styles': 'yes',
                            'feature_list_icon_bg_color_this_background': 'classic',
                            'feature_list_icon_bg_color_this_color': '#399CFF',
                        },
                        {   
                            'feature_list_item_media_type': 'icon',
                            'feature_list_item_icon':  {
                                'value': 'fas fa-swatchbook',
                                'library': 'fa-solid'
                            },
                            'feature_list_item_title': 'User-Friendly Design',
                            'feature_list_item_desc': 'Corrupti maiores atque repellendus ratione omnis possimus. Eaque laudantium tenetur.',
                            'feature_list_custom_styles': 'yes',
                            'feature_list_icon_bg_color_this_background': 'classic',
                            'feature_list_icon_bg_color_this_color': '#F89B2E',
                        },
                        {   
                            'feature_list_item_media_type': 'icon',
                            'feature_list_item_icon':  {
                                'value': 'fas fa-layer-group',
                                'library': 'fa-solid'
                            },
                            'feature_list_item_title': 'Customizable Template',
                            'feature_list_item_desc': 'Corrupti maiores atque repellendus ratione omnis possimus. Eaque laudantium tenetur.',
                            'feature_list_custom_styles': 'yes',
                            'feature_list_icon_bg_color_this_background': 'classic',
                            'feature_list_icon_bg_color_this_color': '#4CAF50',
                        },
                        {   
                            'feature_list_item_media_type': 'icon',
                            'feature_list_item_icon':  {
                                'value': 'fas fa-expand-arrows-alt',
                                'library': 'fa-solid'
                            },
                            'feature_list_item_title': 'Responsive Layout',
                            'feature_list_item_desc': 'Corrupti maiores atque repellendus ratione omnis possimus. Eaque laudantium tenetur.',
                            'feature_list_custom_styles': 'yes',
                            'feature_list_icon_bg_color_this_background': 'classic',
                            'feature_list_icon_bg_color_this_color': '#E43242',
                        },
                        {   
                            'feature_list_item_media_type': 'icon',
                            'feature_list_item_icon':  {
                                'value': 'fas fa-shield-alt',
                                'library': 'fa-solid'
                            },
                            'feature_list_item_title': 'Secure Data Protection',
                            'feature_list_item_desc': 'Corrupti maiores atque repellendus ratione omnis possimus. Eaque laudantium tenetur.',
                            'feature_list_custom_styles': 'yes',
                            'feature_list_icon_bg_color_this_background': 'classic',
                            'feature_list_icon_bg_color_this_color': '#C36AFF',
                        },
                    ],
                    'feature_list_image_n_icon_hover_color': '',
                    'feature_list_image_n_icon_hover_bg_color_background': 'classic',
                    'feature_list_image_n_icon_hover_bg_color_color': '',
                    'feature_list_title_hover_color': '',
                    'feature_list_desc_hover_color': '',
                },
                'preset-3': {
                    'feature_list_box_bg_color_background': 'classic',
                    'feature_list_box_bg_color_color': 'transparent',
                    'feature_list_box_hover_bg_color_background': 'classic',
                    'feature_list_box_hover_bg_color_color': 'transparent',
                    'feature_list_image_n_icon_border_radius': {
                        'top': '0',
                        'right': '20',
                        'bottom': '0',
                        'left': '20',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'feature_list': [
                        {    
                            'feature_list_item_media_type': 'icon',
                            'feature_list_item_icon':  {
                                'value': 'fas fa-server',
                                'library': 'fa-solid'
                            },
                            'feature_list_item_title': 'Fast Loading  Speed',
                            'feature_list_item_desc': 'Corrupti maiores atque repellendus ratione omnis possimus. Eaque laudantium tenetur.',
                            'feature_list_custom_styles': 'yes',
                            'feature_list_icon_bg_color_this_background': 'classic',
                            'feature_list_icon_bg_color_this_color': '#399CFF',
                        },
                        {   
                            'feature_list_item_media_type': 'icon',
                            'feature_list_item_icon':  {
                                'value': 'fas fa-swatchbook',
                                'library': 'fa-solid'
                            },
                            'feature_list_item_title': 'User-Friendly Design',
                            'feature_list_item_desc': 'Corrupti maiores atque repellendus ratione omnis possimus. Eaque laudantium tenetur.',
                            'feature_list_custom_styles': 'yes',
                            'feature_list_icon_bg_color_this_background': 'classic',
                            'feature_list_icon_bg_color_this_color': '#F89B2E',
                        },
                        {   
                            'feature_list_item_media_type': 'icon',
                            'feature_list_item_icon':  {
                                'value': 'fas fa-layer-group',
                                'library': 'fa-solid'
                            },
                            'feature_list_item_title': 'Customizable Template',
                            'feature_list_item_desc': 'Corrupti maiores atque repellendus ratione omnis possimus. Eaque laudantium tenetur.',
                            'feature_list_custom_styles': 'yes',
                            'feature_list_icon_bg_color_this_background': 'classic',
                            'feature_list_icon_bg_color_this_color': '#4CAF50',
                        },
                        {   
                            'feature_list_item_media_type': 'icon',
                            'feature_list_item_icon':  {
                                'value': 'fas fa-expand-arrows-alt',
                                'library': 'fa-solid'
                            },
                            'feature_list_item_title': 'Responsive Layout',
                            'feature_list_item_desc': 'Corrupti maiores atque repellendus ratione omnis possimus. Eaque laudantium tenetur.',
                            'feature_list_custom_styles': 'yes',
                            'feature_list_icon_bg_color_this_background': 'classic',
                            'feature_list_icon_bg_color_this_color': '#E43242',
                        },
                        {   
                            'feature_list_item_media_type': 'icon',
                            'feature_list_item_icon':  {
                                'value': 'fas fa-shield-alt',
                                'library': 'fa-solid'
                            },
                            'feature_list_item_title': 'Secure Data Protection',
                            'feature_list_item_desc': 'Corrupti maiores atque repellendus ratione omnis possimus. Eaque laudantium tenetur.',
                            'feature_list_custom_styles': 'yes',
                            'feature_list_icon_bg_color_this_background': 'classic',
                            'feature_list_icon_bg_color_this_color': '#C36AFF',
                        },
                    ],
                    'feature_list_image_n_icon_hover_color': '',
                    'feature_list_image_n_icon_hover_bg_color_background': 'classic',
                    'feature_list_image_n_icon_hover_bg_color_color': '',
                    'feature_list_title_hover_color': '',
                    'feature_list_desc_hover_color': '',
                },
                'preset-4': {
                    'feature_list_box_bg_color_background': 'classic',
                    'feature_list_box_bg_color_color': 'transparent',
                    'feature_list_box_hover_bg_color_background': 'classic',
                    'feature_list_box_hover_bg_color_color': 'transparent',
                    'feature_list_image_n_icon_border_border': 'solid',
                    'feature_list_image_n_icon_border_width': {
                        'top': '2',
                        'right': '2',
                        'bottom': '2',
                        'left': '2',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'feature_list_image_n_icon_border_color': '',
                    'feature_list_image_n_icon_border_radius': {
                        'top': '0',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'feature_list': [
                        {    
                            'feature_list_item_media_type': 'icon',
                            'feature_list_item_icon':  {
                                'value': 'fas fa-server',
                                'library': 'fa-solid'
                            },
                            'feature_list_item_title': 'Fast Loading  Speed',
                            'feature_list_item_desc': 'Corrupti maiores atque repellendus ratione omnis possimus. Eaque laudantium tenetur.',
                            'feature_list_custom_styles': 'yes',
                            'feature_list_icon_color_this': '#399CFF',
                            'feature_list_icon_bg_color_this_background': 'classic',
                            'feature_list_icon_bg_color_this_color': '#D7EBFF',
                            'feature_list_icon_border_color_this': '#399CFF',
                        },
                        {   
                            'feature_list_item_media_type': 'icon',
                            'feature_list_item_icon':  {
                                'value': 'fas fa-swatchbook',
                                'library': 'fa-solid'
                            },
                            'feature_list_item_title': 'User-Friendly Design',
                            'feature_list_item_desc': 'Corrupti maiores atque repellendus ratione omnis possimus. Eaque laudantium tenetur.',
                            'feature_list_custom_styles': 'yes',
                            'feature_list_icon_color_this': '#F89B2E',
                            'feature_list_icon_bg_color_this_background': 'classic',
                            'feature_list_icon_bg_color_this_color': '#FEEBD5',
                            'feature_list_icon_border_color_this': '#F89B2E',
                        },
                        {   
                            'feature_list_item_media_type': 'icon',
                            'feature_list_item_icon':  {
                                'value': 'fas fa-layer-group',
                                'library': 'fa-solid'
                            },
                            'feature_list_item_title': 'Customizable Template',
                            'feature_list_item_desc': 'Corrupti maiores atque repellendus ratione omnis possimus. Eaque laudantium tenetur.',
                            'feature_list_custom_styles': 'yes',
                            'feature_list_icon_color_this': '#4CAF50',
                            'feature_list_icon_bg_color_this_background': 'classic',
                            'feature_list_icon_bg_color_this_color': '#DBEFDC',
                            'feature_list_icon_border_color_this': '#4CAF50',
                        },
                        {   
                            'feature_list_item_media_type': 'icon',
                            'feature_list_item_icon':  {
                                'value': 'fas fa-expand-arrows-alt',
                                'library': 'fa-solid'
                            },
                            'feature_list_item_title': 'Responsive Layout',
                            'feature_list_item_desc': 'Corrupti maiores atque repellendus ratione omnis possimus. Eaque laudantium tenetur.',
                            'feature_list_custom_styles': 'yes',
                            'feature_list_icon_color_this': '#E43242',
                            'feature_list_icon_bg_color_this_background': 'classic',
                            'feature_list_icon_bg_color_this_color': '#FFF6F7',
                            'feature_list_icon_border_color_this': '#E43242',
                        },
                        {   
                            'feature_list_item_media_type': 'icon',
                            'feature_list_item_icon':  {
                                'value': 'fas fa-shield-alt',
                                'library': 'fa-solid'
                            },
                            'feature_list_item_title': 'Secure Data Protection',
                            'feature_list_item_desc': 'Corrupti maiores atque repellendus ratione omnis possimus. Eaque laudantium tenetur.',
                            'feature_list_custom_styles': 'yes',
                            'feature_list_icon_color_this': '#C36AFF',
                            'feature_list_icon_bg_color_this_background': 'classic',
                            'feature_list_icon_bg_color_this_color': '#FFEEFB',
                            'feature_list_icon_border_color_this': '#C36AFF',
                        },
                    ],
                    'feature_list_image_n_icon_hover_color': '',
                    'feature_list_image_n_icon_hover_bg_color_background': 'classic',
                    'feature_list_image_n_icon_hover_bg_color_color': '',
                    'feature_list_title_hover_color': '',
                    'feature_list_desc_hover_color': '',
                },
                'preset-5': {
                    'feature_list_box_bg_color_background': 'classic',
                    'feature_list_box_bg_color_color': 'transparent',
                    'feature_list_box_hover_bg_color_background': 'classic',
                    'feature_list_box_hover_bg_color_color': 'transparent',
                    'feature_list_icon_gap': {
                        'unit': 'px',
                        'size': 15,
                        'sizes': [] // Required for responsive
                    },
                    'feature_list_image_n_icon_color': '#399CFF',
                    'feature_list_image_n_icon_bg_color_background': 'classic',
                    'feature_list_image_n_icon_bg_color_color': '#D7EBFF',
                    'feature_list_image_n_icon_border_border': 'solid',
                    'feature_list_image_n_icon_border_width': {
                        'top': '2',
                        'right': '2',
                        'bottom': '2',
                        'left': '2',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'feature_list_image_n_icon_border_color': '#399CFF',
                    'feature_list_image_n_icon_border_radius': {
                        'top': '0',
                        'right': '20',
                        'bottom': '0',
                        'left': '20',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'feature_list_image_n_icon_wrap_rotate': {
                        'unit': 'deg',
                        'size': 45,
                        'sizes': [] // Required for responsive
                    },
                    'feature_list_image_n_icon_rotate': {
                        'unit': 'deg',
                        'size': -45,
                        'sizes': [] // Required for responsive
                    },
                    'feature_list': [
                        {    
                            'feature_list_item_media_type': 'icon',
                            'feature_list_item_icon':  {
                                'value': 'fas fa-server',
                                'library': 'fa-solid'
                            },
                            'feature_list_item_title': 'Fast Loading  Speed',
                            'feature_list_item_desc': 'Corrupti maiores atque repellendus ratione omnis possimus. Eaque laudantium tenetur.',
                            'feature_list_custom_styles': 'no',
                        },
                        {   
                            'feature_list_item_media_type': 'icon',
                            'feature_list_item_icon':  {
                                'value': 'fas fa-swatchbook',
                                'library': 'fa-solid'
                            },
                            'feature_list_item_title': 'User-Friendly Design',
                            'feature_list_item_desc': 'Corrupti maiores atque repellendus ratione omnis possimus. Eaque laudantium tenetur.',
                            'feature_list_custom_styles': 'no',
                        },
                        {   
                            'feature_list_item_media_type': 'icon',
                            'feature_list_item_icon':  {
                                'value': 'fas fa-layer-group',
                                'library': 'fa-solid'
                            },
                            'feature_list_item_title': 'Customizable Template',
                            'feature_list_item_desc': 'Corrupti maiores atque repellendus ratione omnis possimus. Eaque laudantium tenetur.',
                            'feature_list_custom_styles': 'no',
                        },
                        {   
                            'feature_list_item_media_type': 'icon',
                            'feature_list_item_icon':  {
                                'value': 'fas fa-expand-arrows-alt',
                                'library': 'fa-solid'
                            },
                            'feature_list_item_title': 'Responsive Layout',
                            'feature_list_item_desc': 'Corrupti maiores atque repellendus ratione omnis possimus. Eaque laudantium tenetur.',
                            'feature_list_custom_styles': 'no',
                        },
                        {   
                            'feature_list_item_media_type': 'icon',
                            'feature_list_item_icon':  {
                                'value': 'fas fa-shield-alt',
                                'library': 'fa-solid'
                            },
                            'feature_list_item_title': 'Secure Data Protection',
                            'feature_list_item_desc': 'Corrupti maiores atque repellendus ratione omnis possimus. Eaque laudantium tenetur.',
                            'feature_list_custom_styles': 'no',
                        },
                    ],
                    'feature_list_image_n_icon_hover_color': '',
                    'feature_list_image_n_icon_hover_bg_color_background': 'classic',
                    'feature_list_image_n_icon_hover_bg_color_color': '',
                    'feature_list_title_hover_color': '',
                    'feature_list_desc_hover_color': '',
                },
                'preset-6': {
                    'feature_list_box_bg_color_background': 'classic',
                    'feature_list_box_bg_color_color': 'transparent',
                    'feature_list_box_hover_bg_color_background': 'classic',
                    'feature_list_box_hover_bg_color_color': 'transparent',
                    'feature_list_icon_gap': {
                        'unit': 'px',
                        'size': 15,
                        'sizes': [] // Required for responsive
                    },
                    'feature_list_image_n_icon_color': '#fff',
                    'feature_list_image_n_icon_bg_color_background': 'classic',
                    'feature_list_image_n_icon_bg_color_color': '#D7EBFF',
                    'feature_list_image_n_icon_border_border': 'none',
                    'feature_list_image_n_icon_border_radius_custom':'70% 30% 30% 70% / 60% 40% 60% 40%',
                    'feature_list_image_n_icon_border_radius': {
                        'top': '',
                        'right': '',
                        'bottom': '',
                        'left': '',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'feature_list': [
                        {    
                            'feature_list_item_media_type': 'icon',
                            'feature_list_item_icon':  {
                                'value': 'fas fa-server',
                                'library': 'fa-solid'
                            },
                            'feature_list_item_title': 'Fast Loading  Speed',
                            'feature_list_item_desc': 'Corrupti maiores atque repellendus ratione omnis possimus. Eaque laudantium tenetur.',
                            'feature_list_custom_styles': 'yes',
                            'feature_list_icon_bg_color_this_background': 'gradient',
                            'feature_list_icon_bg_color_this_color': '#FFAD4E',
                            'feature_list_icon_bg_color_this_color_stop': {
                                'unit': '%',
                                'size': 0,
                                'sizes': [] // Required for responsive
                            },
                            'feature_list_icon_bg_color_this_color_b': '#F54809',
                            'feature_list_icon_bg_color_this_color_b_stop': {
                                'unit': '%',
                                'size': 100,
                                'sizes': [] // Required for responsive
                            },
                            'feature_list_icon_bg_color_this_gradient_angle': {
                                'unit': 'deg',
                                'size': 270,
                                'sizes': [] // Required for responsive
                            },
                            'feature_list_icon_box_shadow_this_box_shadow_type': 'yes',
                            'feature_list_icon_box_shadow_this_box_shadow': {
                                'horizontal': 0,
                                'vertical': 15,
                                'blur': 30,
                                'spread': 0,
                                'color': '#DC760066',
                            },
                        },
                        {   
                            'feature_list_item_media_type': 'icon',
                            'feature_list_item_icon':  {
                                'value': 'fas fa-swatchbook',
                                'library': 'fa-solid'
                            },
                            'feature_list_item_title': 'User-Friendly Design',
                            'feature_list_item_desc': 'Corrupti maiores atque repellendus ratione omnis possimus. Eaque laudantium tenetur.',
                            'feature_list_custom_styles': 'yes',
                            'feature_list_icon_bg_color_this_background': 'gradient',
                            'feature_list_icon_bg_color_this_color': '#62B1FF',
                            'feature_list_icon_bg_color_this_color_stop': {
                                'unit': '%',
                                'size': 0,
                                'sizes': [] // Required for responsive
                            },
                            'feature_list_icon_bg_color_this_color_b': '#3E6DE2',
                            'feature_list_icon_bg_color_this_color_b_stop': {
                                'unit': '%',
                                'size': 100,
                                'sizes': [] // Required for responsive
                            },
                            'feature_list_icon_bg_color_this_gradient_angle': {
                                'unit': 'deg',
                                'size': 270,
                                'sizes': [] // Required for responsive
                            },
                            'feature_list_icon_box_shadow_this_box_shadow_type': 'yes',
                            'feature_list_icon_box_shadow_this_box_shadow': {
                                'horizontal': 0,
                                'vertical': 15,
                                'blur': 30,
                                'spread': 0,
                                'color': '#1272D266',
                            },
                        },
                        {   
                            'feature_list_item_media_type': 'icon',
                            'feature_list_item_icon':  {
                                'value': 'fas fa-layer-group',
                                'library': 'fa-solid'
                            },
                            'feature_list_item_title': 'Customizable Template',
                            'feature_list_item_desc': 'Corrupti maiores atque repellendus ratione omnis possimus. Eaque laudantium tenetur.',
                            'feature_list_custom_styles': 'yes',
                            'feature_list_icon_bg_color_this_background': 'gradient',
                            'feature_list_icon_bg_color_this_color': '#7ADE7E',
                            'feature_list_icon_bg_color_this_color_stop': {
                                'unit': '%',
                                'size': 0,
                                'sizes': [] // Required for responsive
                            },
                            'feature_list_icon_bg_color_this_color_b': '#18801C',
                            'feature_list_icon_bg_color_this_color_b_stop': {
                                'unit': '%',
                                'size': 100,
                                'sizes': [] // Required for responsive
                            },
                            'feature_list_icon_bg_color_this_gradient_angle': {
                                'unit': 'deg',
                                'size': 270,
                                'sizes': [] // Required for responsive
                            },
                            'feature_list_icon_box_shadow_this_box_shadow_type': 'yes',
                            'feature_list_icon_box_shadow_this_box_shadow': {
                                'horizontal': 0,
                                'vertical': 15,
                                'blur': 30,
                                'spread': 0,
                                'color': '#1A9B2066',
                            },
                        },
                        {   
                            'feature_list_item_media_type': 'icon',
                            'feature_list_item_icon':  {
                                'value': 'fas fa-expand-arrows-alt',
                                'library': 'fa-solid'
                            },
                            'feature_list_item_title': 'Responsive Layout',
                            'feature_list_item_desc': 'Corrupti maiores atque repellendus ratione omnis possimus. Eaque laudantium tenetur.',
                            'feature_list_custom_styles': 'yes',
                            'feature_list_icon_bg_color_this_background': 'gradient',
                            'feature_list_icon_bg_color_this_color': '#96A6CF',
                            'feature_list_icon_bg_color_this_color_stop': {
                                'unit': '%',
                                'size': 0,
                                'sizes': [] // Required for responsive
                            },
                            'feature_list_icon_bg_color_this_color_b': '#232A3B',
                            'feature_list_icon_bg_color_this_color_b_stop': {
                                'unit': '%',
                                'size': 100,
                                'sizes': [] // Required for responsive
                            },
                            'feature_list_icon_bg_color_this_gradient_angle': {
                                'unit': 'deg',
                                'size': 270,
                                'sizes': [] // Required for responsive
                            },
                            'feature_list_icon_box_shadow_this_box_shadow_type': 'yes',
                            'feature_list_icon_box_shadow_this_box_shadow': {
                                'horizontal': 0,
                                'vertical': 15,
                                'blur': 30,
                                'spread': 0,
                                'color': '#15171C66',
                            },
                        },
                        {   
                            'feature_list_item_media_type': 'icon',
                            'feature_list_item_icon':  {
                                'value': 'fas fa-shield-alt',
                                'library': 'fa-solid'
                            },
                            'feature_list_item_title': 'Secure Data Protection',
                            'feature_list_item_desc': 'Corrupti maiores atque repellendus ratione omnis possimus. Eaque laudantium tenetur.',
                            'feature_list_custom_styles': 'yes',
                            'feature_list_icon_bg_color_this_background': 'gradient',
                            'feature_list_icon_bg_color_this_color': '#F67C87',
                            'feature_list_icon_bg_color_this_color_stop': {
                                'unit': '%',
                                'size': 0,
                                'sizes': [] // Required for responsive
                            },
                            'feature_list_icon_bg_color_this_color_b': '#B9087B',
                            'feature_list_icon_bg_color_this_color_b_stop': {
                                'unit': '%',
                                'size': 100,
                                'sizes': [] // Required for responsive
                            },
                            'feature_list_icon_bg_color_this_gradient_angle': {
                                'unit': 'deg',
                                'size': 270,
                                'sizes': [] // Required for responsive
                            },
                            'feature_list_icon_box_shadow_this_box_shadow_type': 'yes',
                            'feature_list_icon_box_shadow_this_box_shadow': {
                                'horizontal': 0,
                                'vertical': 15,
                                'blur': 30,
                                'spread': 0,
                                'color': '#BA122166',
                            },
                        },
                    ],
                    'feature_list_image_n_icon_hover_color': '',
                    'feature_list_image_n_icon_hover_bg_color_background': 'classic',
                    'feature_list_image_n_icon_hover_bg_color_color': '',
                    'feature_list_title_hover_color': '',
                    'feature_list_desc_hover_color': '',
                },
            };

                
            
            panel.$el.off('change', '[data-setting="preset_styles"]');
            panel.$el.on('change', '[data-setting="preset_styles"]', function() {
                var selectedPreset = $(this).val();
                const allControls = view.model.get('settings').controls || {};

                _.each(allControls, function(control, key) {
                    if (key === 'preset_styles') {
                        view.model.setSetting(key, selectedPreset);
                        return;
                    }

                    // Handle repeater items separately
                    if (key === 'feature_list') {
                        if (selectedPreset !== 'default' && featureListPresetStyles[selectedPreset] && featureListPresetStyles[selectedPreset]['feature_list']) {
                            var presetItems = featureListPresetStyles[selectedPreset]['feature_list'];
                            var existingItems = view.model.getSetting('feature_list');
                            
                            if (existingItems && existingItems.models) {
                                // Remove all existing items using Elementor commands
                                var itemsToRemove = existingItems.models.length;
                                for (var i = itemsToRemove - 1; i >= 0; i--) {
                                    $e.run('document/repeater/remove', {
                                        container: elementor.getContainer(view.model.get('id')),
                                        name: 'feature_list',
                                        index: i
                                    });
                                }
                                
                                // Add new items from preset using Elementor commands
                                presetItems.forEach(function(newItem, index) {
                                    $e.run('document/repeater/insert', {
                                        container: elementor.getContainer(view.model.get('id')),
                                        name: 'feature_list',
                                        model: newItem,
                                        index: index
                                    });
                                });
                            }
                        } else if (selectedPreset === 'default') {
                            var presetItems = featureListPresetStyles['preset-5']['feature_list'];
                            var existingItems = view.model.getSetting('feature_list');
                            
                            if (existingItems && existingItems.models) {
                                // Remove all existing items using Elementor commands
                                var itemsToRemove = existingItems.models.length;
                                for (var i = itemsToRemove - 1; i >= 0; i--) {
                                    $e.run('document/repeater/remove', {
                                        container: elementor.getContainer(view.model.get('id')),
                                        name: 'feature_list',
                                        index: i
                                    });
                                }
                                
                                // Add new items from preset using Elementor commands
                                presetItems.forEach(function(newItem, index) {
                                    $e.run('document/repeater/insert', {
                                        container: elementor.getContainer(view.model.get('id')),
                                        name: 'feature_list',
                                        model: newItem,
                                        index: index
                                    });
                                });
                            }
                        }
                        return;
                    }

                    if (selectedPreset !== 'default' && featureListPresetStyles[selectedPreset]) {
                        view.model.setSetting(key, featureListPresetStyles[selectedPreset][key] ?? control.default);
                    } else if (selectedPreset === 'default') {
                        view.model.setSetting(key, control.default);
                    }
                });
                
                view.model.renderRemoteServer();
                const panelView = panel.getCurrentPageView();
                const feature_list_repeater = Object.values(panelView.children._views)[2];
                feature_list_repeater.render();
                // console.log(third);
                // ✅ Refresh only the repeater control in the panel
                // const repeaterControlView = panel.getControlView('feature_list');
                // if (repeaterControlView) repeaterControlView.render();
            });

        });
        elementor.hooks.addAction('panel/open_editor/widget/pea_testimonial', function(panel, model, view) {
            var testimonialPresetStyles = {
                'preset-2': {
                    'show_title': 'no',
                    'testimonial_box_bg_color_background': 'classic',
                    'testimonial_box_bg_color_color': '#f7f7f7',
                    'rating_icon_margin': {
                        'top': '0',
                        'right': '0',
                        'bottom': '16',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                },
                'preset-3': {
                    'show_title': 'no',
                    'show_quote': 'yes',
                    'testimonial_box_bg_color_background': 'classic',
                    'testimonial_box_bg_color_color': '#f7f7f7',
                    'rating_icon_margin': {
                        'top': '0',
                        'right': '0',
                        'bottom': '32',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'testimonial_quote_icon_position': 'yes',
                    'testimonial_quote_icon_top': {
                        'unit': '%',
                        'size': 6,
                        'sizes': [] 
                    },
                    'testimonial_quote_icon_left': {
                        'unit': '%',
                        'size': 88,
                        'sizes': [] 
                    },
                },
                'preset-4': {
                    'show_title': 'no',
                    'show_author_image': 'yes',
                    'show_quote': 'yes',
                    'quote_icon_type': 'icon',
                    'quote_icon':  {
                        'value': 'fas fa-quote-right',
                        'library': 'fa-solid'
                    },
                    'testimonial_box_bg_color_background': 'classic',
                    'testimonial_box_bg_color_color': '#f7f7f7',
                    'testimonial_box_border_radius': {
                        'top': '24',
                        'right': '24',
                        'bottom': '24',
                        'left': '24',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'testimonial_quote_icon_color': '#E1E3E8',
                    'rating_icon_margin': {
                        'top': '36',
                        'right': '0',
                        'bottom': '16',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'testimonial_description_margin': {
                        'top': '0',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'testimonial_author_image_position': 'yes',
                    'testimonial_author_image_top': {
                        'unit': '%',
                        'size': -5,
                        'sizes': [] 
                    },
                    'testimonial_author_image_left': {
                        'unit': '%',
                        'size': -2,
                        'sizes': [] 
                    },
                    'testimonial_quote_icon_position': 'yes',
                    'testimonial_quote_icon_top': {
                        'unit': '%',
                        'size': 11,
                        'sizes': [] 
                    },
                    'testimonial_quote_icon_left': {
                        'unit': '%',
                        'size': 85,
                        'sizes': [] 
                    },
                    'testimonial_author_image_width': {
                        'unit': 'px',
                        'size': 110,
                        'sizes': [] 
                    },
                    'testimonial_author_image_border_radius': {
                        'top': '10',
                        'right': '10',
                        'bottom': '10',
                        'left': '10',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'testimonial_author_margin': {
                        'top': '0',
                        'right': '0',
                        'bottom': '0',
                        'left': '100',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'testimonial_author_designation_margin': {
                        'top': '10',
                        'right': '0',
                        'bottom': '0',
                        'left': '100',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'testimonial_author_typography_typography': 'custom',
                    'testimonial_author_typography_font_family': 'Plus Jakarta Sans',
                    'testimonial_author_typography_font_size': {
                        'unit': 'px',
                        'size': 24,
                        'sizes': [] // Required for responsive
                    },
                    'testimonial_author_typography_font_weight': '600',
                    'testimonial_author_typography_text_transform': 'capitalize',
                    'testimonial_author_typography_font_style': 'normal',
                    'testimonial_author_typography_text_decoration': 'none',
                    'testimonial_author_typography_line_height': {
                        'unit': '%',
                        'size': 130,
                        'sizes': []
                    },
                    
                    'testimonial_author_designation_typography_typography': 'custom',
                    'testimonial_author_designation_typography_font_family': 'Work Sans',
                    'testimonial_author_designation_typography_font_size': {
                        'unit': 'px',
                        'size': 16,
                        'sizes': [] // Required for responsive
                    },
                    'testimonial_author_designation_typography_font_weight': '400',
                    'testimonial_author_designation_typography_text_transform': 'capitalize',
                    'testimonial_author_designation_typography_font_style': 'normal',
                    'testimonial_author_designation_typography_text_decoration': 'none',
                    'testimonial_author_designation_typography_line_height': {
                        'unit': '%',
                        'size': 140,
                        'sizes': []
                    },
                },
                'preset-5': {
                    'show_title': 'no',
                    'show_designation': 'no',
                    'show_quote': 'yes',
                    'testimonial_box_bg_color_background': 'classic',
                    'testimonial_box_bg_color_color': '#404655',
                    'testimonial_box_padding': {
                        'top': '60',
                        'right': '30',
                        'bottom': '30',
                        'left': '30',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'testimonial_description_color': '#fff',
                    'testimonial_author_color': '#fff',
                    'testimonial_quote_icon_color': '#fff',
                    'testimonial_description_margin': {
                        'top': '35',
                        'right': '0',
                        'bottom': '32',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'testimonial_quote_icon_position': 'yes',
                    'testimonial_quote_icon_top': {
                        'unit': '%',
                        'size': 10,
                        'sizes': [] 
                    },
                    'testimonial_quote_icon_left': {
                        'unit': '%',
                        'size': 5,
                        'sizes': [] 
                    },
                    'testimonial_author_image_width': {
                        'unit': 'px',
                        'size': 40,
                        'sizes': [] 
                    },
                    'testimonial_author_typography_typography': 'custom',
                    'testimonial_author_typography_font_family': 'Work Sans',
                    'testimonial_author_typography_font_size': {
                        'unit': 'px',
                        'size': 18,
                        'sizes': [] // Required for responsive
                    },
                    'testimonial_author_typography_font_weight': '500',
                    'testimonial_author_typography_text_transform': 'capitalize',
                    'testimonial_author_typography_font_style': 'normal',
                    'testimonial_author_typography_text_decoration': 'none',
                    'testimonial_author_typography_line_height': {
                        'unit': '%',
                        'size': 140,
                        'sizes': []
                    },
                },
            };

            panel.$el.off('change', '[data-setting="preset_styles"]');
            panel.$el.on('change', '[data-setting="preset_styles"]', function() {
                var selectedPreset = $(this).val();
                const allControls = view.model.get('settings').controls || {};

                _.each(allControls, function(control, key) {
                    if (key === 'preset_styles') {
                        view.model.setSetting(key, selectedPreset);
                        return;
                    }

                    if (selectedPreset !== 'default' && testimonialPresetStyles[selectedPreset]) {
                        view.model.setSetting(key, testimonialPresetStyles[selectedPreset][key] ?? control.default);
                    } else if (selectedPreset === 'default') {
                        view.model.setSetting(key, control.default);
                    }
                });
                
                view.model.renderRemoteServer();
            });
        });
        elementor.hooks.addAction('panel/open_editor/widget/pea_counter', function(panel, model, view) {
            var counterPresetStyles = {
                'preset-2': {
                    'icon_position': 'column',
                    'counter_title_position': 'column',
                    'box_bg_color': '#F7F7F7',
                    'box_content_hori_alignment': 'start',
                    'box_content_verti_alignment': 'start',
                },
                'preset-3': {
                    // Front
                    'counter_end_number': {
                        'unit': '',
                        'size': 32,
                        'sizes': []
                    },
                    'counter_icon_type': 'none',
                    'counter_prefix': 'no',
                    'counter_suffix': 'no',
                    'box_bg_color': '#15171C',
                    'counter_number_margin': {
                        'top': '0',
                        'right': '11',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'counter_title_text': 'Installation',
                    'counter_number_color': '#F89B2E',
                    'counter_title_color': '#C3C8D2',
                    'counter_title_position': 'row',
                },
                'preset-4': {
                    'counter_end_number': {
                        'unit': '',
                        'size': 32,
                        'sizes': []
                    },
                    'icon_position': 'column',
                    'counter_title_position': 'column',
                    'box_bg_color': '#EBF5FF',
                    'icon_color': '#399CFF',
                    'icon_size': {
                        'unit': 'px',
                        'size': 60,
                        'sizes': []
                    },
                    'counter_prefix': 'no',
                    'counter_suffix': 'no',
                    'counter_icon_type': 'icon',
                    'counter_icon':  {
                        'value': 'fas fa-bolt',
                        'library': 'fa-solid'
                    },
                    'counter_title_text': 'Installation',
                },
                'preset-5': {
                    'counter_end_number': {
                        'unit': '',
                        'size': 65,
                        'sizes': []
                    },
                    'icon_position': 'column',
                    'counter_title_position': 'column',
                    'box_bg_color': '#F8EFFF',
                    'icon_color': '#E43242',
                    'icon_size': {
                        'unit': 'px',
                        'size': 60,
                        'sizes': []
                    },
                    'box_width': {
                        'unit': 'px',
                        'size': 300,
                        'sizes': []
                    },
                    'box_height': {
                        'unit': 'px',
                        'size': 300,
                        'sizes': []
                    },
                    'box_border_border': 'solid',
                    'box_border_width': {
                        'top': '5',
                        'right': '5',
                        'bottom': '5',
                        'left': '5',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'box_border_color': '#E43242',
                    'box_border_radius': {
                        'top': '200',
                        'right': '200',
                        'bottom': '200',
                        'left': '200',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'counter_prefix': 'no',
                    'counter_suffix': 'yes',
                    'counter_suffix_text': '%',
                    'counter_icon_type': 'icon',
                    'counter_icon':  {
                        'value': 'fas fa-crown',
                        'library': 'fa-solid'
                    },
                    'counter_title_text': 'Skilled',
                },
                'preset-6': {
                    'counter_end_number': {
                        'unit': '',
                        'size': 6,
                        'sizes': []
                    },
                    'counter_icon_type': 'none',
                    'counter_title': 'no',
                    'icon_position': 'column',
                    'box_bg_color': '#EDF7EE',
                    'icon_color': '#4CAF50',
                    'icon_size': {
                        'unit': 'px',
                        'size': 60,
                        'sizes': []
                    },
                    'box_width': {
                        'unit': 'px',
                        'size': 300,
                        'sizes': []
                    },
                    'box_height': {
                        'unit': 'px',
                        'size': 300,
                        'sizes': []
                    },
                    'box_border_border': 'solid',
                    'box_border_width': {
                        'top': '8',
                        'right': '8',
                        'bottom': '8',
                        'left': '8',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'box_border_color': '#4CAF50',
                    'box_border_radius': {
                        'top': '200',
                        'right': '200',
                        'bottom': '200',
                        'left': '200',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'counter_prefix': 'yes',
                    'counter_prefix_text': '+',
                    'counter_suffix': 'yes',
                    'counter_suffix_text': 'B',
                },
            };
            panel.$el.off('change', '[data-setting="preset_styles"]');
            panel.$el.on('change', '[data-setting="preset_styles"]', function() {
                var selectedPreset = $(this).val();
                const allControls = view.model.get('settings').controls || {};

                _.each(allControls, function(control, key) {
                    if (key === 'preset_styles') {
                        view.model.setSetting(key, selectedPreset);
                        return;
                    }

                    if (selectedPreset !== 'default' && counterPresetStyles[selectedPreset]) {
                        view.model.setSetting(key, counterPresetStyles[selectedPreset][key] ?? control.default);
                    } else if (selectedPreset === 'default') {
                        view.model.setSetting(key, control.default);
                    }
                });
                
                view.model.renderRemoteServer();
            });
        });
        elementor.hooks.addAction('panel/open_editor/widget/pea_social_icons', function(panel, model, view) {
            var socialIconsPresetStyles = {
                'preset-2': {
                    'social_icons': [
                        {   
                            'social_icon_item_icon':  {
                                'value': 'fab fa-facebook-f',
                                'library': 'fa-brands'
                            },
                            'social_icon_item_title': 'Facebook',
                            'social_icon_custom_styles': 'no',
                        },
                        {   
                            'social_icon_item_icon':  {
                                'value': 'fab fa-linkedin-in',
                                'library': 'fa-brands'
                            },
                            'social_icon_item_title': 'Linkedin',
                            'social_icon_custom_styles': 'no',
                        },
                        {   
                            'social_icon_item_icon':  {
                                'value': 'fab fa-youtube',
                                'library': 'fa-brands'
                            },
                            'social_icon_item_title': 'Youtube',
                            'social_icon_custom_styles': 'no',
                        },
                        {   
                            'social_icon_item_icon':  {
                                'value': 'fab fa-telegram-plane',
                                'library': 'fa-brands'
                            },
                            'social_icon_item_title': 'Telegram',
                            'social_icon_custom_styles': 'no',
                        },
                        {   
                            'social_icon_item_icon':  {
                                'value': 'fab fa-spotify',
                                'library': 'fa-brands'
                            },
                            'social_icon_item_title': 'Spotify',
                            'social_icon_custom_styles': 'no',
                        },
                        {   
                            'social_icon_item_icon':  {
                                'value': 'fab fa-whatsapp',
                                'library': 'fa-brands'
                            },
                            'social_icon_item_title': 'Whatsapp',
                            'social_icon_custom_styles': 'no',
                        },
                    ],
                    'social_icon_wrapper_bg_color_background': 'classic',
                    'social_icon_wrapper_bg_color_color': '#15171C',
                    'social_icon_wrapper_border_type_border': 'none',
                    'social_icon_color': '#fff',
                },
                'preset-3': {
                    'social_icon_wrapper_border_type_border': 'none',
                    'social_icon_color': '#fff',
                    'social_icons': [
                        {   
                            'social_icon_item_icon':  {
                                'value': 'fab fa-facebook-f',
                                'library': 'fa-brands'
                            },
                            'social_icon_item_title': 'Facebook',
                            'social_icon_custom_styles': 'yes',
                            'social_icon_icon_bg_color_this': '#1877F2',
                        },
                        {   
                            'social_icon_item_icon':  {
                                'value': 'fab fa-linkedin-in',
                                'library': 'fa-brands'
                            },
                            'social_icon_item_title': 'Linkedin',
                            'social_icon_custom_styles': 'yes',
                            'social_icon_icon_bg_color_this': '#0077B5',
                        },
                        {   
                            'social_icon_item_icon':  {
                                'value': 'fab fa-youtube',
                                'library': 'fa-brands'
                            },
                            'social_icon_item_title': 'Youtube',
                            'social_icon_custom_styles': 'yes',
                            'social_icon_icon_bg_color_this': '#E53935',
                        },
                        {   
                            'social_icon_item_icon':  {
                                'value': 'fab fa-telegram-plane',
                                'library': 'fa-brands'
                            },
                            'social_icon_item_title': 'Telegram',
                            'social_icon_custom_styles': 'yes',
                            'social_icon_icon_bg_color_this': '#039BE5',
                        },
                        {   
                            'social_icon_item_icon':  {
                                'value': 'fab fa-spotify',
                                'library': 'fa-brands'
                            },
                            'social_icon_item_title': 'Spotify',
                            'social_icon_custom_styles': 'yes',
                            'social_icon_icon_bg_color_this': '#1DB954',
                        },
                        {   
                            'social_icon_item_icon':  {
                                'value': 'fab fa-whatsapp',
                                'library': 'fa-brands'
                            },
                            'social_icon_item_title': 'Whatsapp',
                            'social_icon_custom_styles': 'yes',
                            'social_icon_icon_bg_color_this': '#25D366',
                        },
                    ],
                },
                'preset-4': {
                    'social_icon_wrapper_border_type_border': 'none',
                    'social_icons': [
                        {   
                            'social_icon_item_icon':  {
                                'value': 'fab fa-facebook-f',
                                'library': 'fa-brands'
                            },
                            'social_icon_item_title': 'Facebook',
                            'social_icon_custom_styles': 'yes',
                            'social_icon_icon_bg_type_this_background': 'classic',
                            'social_icon_icon_bg_type_this_color': '#1877F2',
                        },
                        {   
                            'social_icon_item_icon':  {
                                'value': 'fab fa-linkedin-in',
                                'library': 'fa-brands'
                            },
                            'social_icon_item_title': 'Linkedin',
                            'social_icon_custom_styles': 'yes',
                            'social_icon_icon_bg_type_this_background': 'classic',
                            'social_icon_icon_bg_type_this_color': '#0077B5',
                        },
                        {   
                            'social_icon_item_icon':  {
                                'value': 'fab fa-youtube',
                                'library': 'fa-brands'
                            },
                            'social_icon_item_title': 'Youtube',
                            'social_icon_custom_styles': 'yes',
                            'social_icon_icon_bg_type_this_background': 'classic',
                            'social_icon_icon_bg_type_this_color': '#E53935',
                        },
                        {   
                            'social_icon_item_icon':  {
                                'value': 'fab fa-telegram-plane',
                                'library': 'fa-brands'
                            },
                            'social_icon_item_title': 'Telegram',
                            'social_icon_custom_styles': 'yes',
                            'social_icon_icon_bg_type_this_background': 'classic',
                            'social_icon_icon_bg_type_this_color': '#039BE5',
                        },
                        {   
                            'social_icon_item_icon':  {
                                'value': 'fab fa-spotify',
                                'library': 'fa-brands'
                            },
                            'social_icon_item_title': 'Spotify',
                            'social_icon_custom_styles': 'yes',
                            'social_icon_icon_bg_type_this_background': 'classic',
                            'social_icon_icon_bg_type_this_color': '#1DB954',
                        },
                        {   
                            'social_icon_item_icon':  {
                                'value': 'fab fa-whatsapp',
                                'library': 'fa-brands'
                            },
                            'social_icon_item_title': 'Whatsapp',
                            'social_icon_custom_styles': 'yes',
                            'social_icon_icon_bg_type_this_background': 'classic',
                            'social_icon_icon_bg_type_this_color': '#25D366',
                        },
                    ],
                    'social_icon_wrapper_border_radius': {
                        'top': '8',
                        'right': '8',
                        'bottom': '8',
                        'left': '8',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'social_icon_color': '#fff',
                    'social_icon_gap': {
                        'unit': 'px',
                        'size': 0,
                        'sizes': [] // Required for responsive
                    },
                    'social_icon_padding': {
                        'top': '16',
                        'right': '5',
                        'bottom': '16',
                        'left': '16',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'social_icon_title_show': 'yes',
                    'social_icon_title_color': '#fff',
                },
                'preset-5': {
                    'social_icons': [
                        {   
                            'social_icon_item_icon':  {
                                'value': 'fab fa-facebook-f',
                                'library': 'fa-brands'
                            },
                            'social_icon_item_title': 'Facebook',
                            'social_icon_custom_styles': 'yes',
                            'social_icon_icon_bg_color_this': '#1877F2',
                        },
                        {   
                            'social_icon_item_icon':  {
                                'value': 'fab fa-linkedin-in',
                                'library': 'fa-brands'
                            },
                            'social_icon_item_title': 'Linkedin',
                            'social_icon_custom_styles': 'yes',
                            'social_icon_icon_bg_color_this': '#0077B5',
                        },
                        {   
                            'social_icon_item_icon':  {
                                'value': 'fab fa-youtube',
                                'library': 'fa-brands'
                            },
                            'social_icon_item_title': 'Youtube',
                            'social_icon_custom_styles': 'yes',
                            'social_icon_icon_bg_color_this': '#E53935',
                        },
                        {   
                            'social_icon_item_icon':  {
                                'value': 'fab fa-telegram-plane',
                                'library': 'fa-brands'
                            },
                            'social_icon_item_title': 'Telegram',
                            'social_icon_custom_styles': 'yes',
                            'social_icon_icon_bg_color_this': '#039BE5',
                        },
                        {   
                            'social_icon_item_icon':  {
                                'value': 'fab fa-spotify',
                                'library': 'fa-brands'
                            },
                            'social_icon_item_title': 'Spotify',
                            'social_icon_custom_styles': 'yes',
                            'social_icon_icon_bg_color_this': '#1DB954',
                        },
                        {   
                            'social_icon_item_icon':  {
                                'value': 'fab fa-whatsapp',
                                'library': 'fa-brands'
                            },
                            'social_icon_item_title': 'Whatsapp',
                            'social_icon_custom_styles': 'yes',
                            'social_icon_icon_bg_color_this': '#25D366',
                        },
                    ],
                    'social_icon_wrapper_border_type_border': 'solid',
                    'social_icon_wrapper_border_type_width': {
                        'top': '1',
                        'right': '1',
                        'bottom': '1',
                        'left': '1',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'social_icon_wrapper_border_type_color': '#E1E3E8',
                    'social_icon_wrapper_border_radius': {
                        'top': '8',
                        'right': '8',
                        'bottom': '8',
                        'left': '8',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'social_icon_color': '#fff',
                    // 'social_icon_gap': {
                    //     'unit': 'px',
                    //     'size': 0,
                    //     'sizes': [] // Required for responsive
                    // },
                    'social_icon_border_radius': {
                        'top': '6',
                        'right': '0',
                        'bottom': '0',
                        'left': '6',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'social_icon_title_show': 'yes',
                    'social_icon_title_color': '#15171C',
                },
                'preset-6': {
                    'social_icons': [
                        {   
                            'social_icon_item_icon':  {
                                'value': 'fab fa-facebook-f',
                                'library': 'fa-brands'
                            },
                            'social_icon_item_title': 'Facebook',
                            'social_icon_custom_styles': 'yes',
                            'social_icon_icon_color_this': '#1877F2',
                        },
                        {   
                            'social_icon_item_icon':  {
                                'value': 'fab fa-linkedin-in',
                                'library': 'fa-brands'
                            },
                            'social_icon_item_title': 'Linkedin',
                            'social_icon_custom_styles': 'yes',
                            'social_icon_icon_color_this': '#0077B5',
                        },
                        {   
                            'social_icon_item_icon':  {
                                'value': 'fab fa-youtube',
                                'library': 'fa-brands'
                            },
                            'social_icon_item_title': 'Youtube',
                            'social_icon_custom_styles': 'yes',
                            'social_icon_icon_color_this': '#E53935',
                        },
                        {   
                            'social_icon_item_icon':  {
                                'value': 'fab fa-telegram-plane',
                                'library': 'fa-brands'
                            },
                            'social_icon_item_title': 'Telegram',
                            'social_icon_custom_styles': 'yes',
                            'social_icon_icon_color_this': '#039BE5',
                        },
                        {   
                            'social_icon_item_icon':  {
                                'value': 'fab fa-spotify',
                                'library': 'fa-brands'
                            },
                            'social_icon_item_title': 'Spotify',
                            'social_icon_custom_styles': 'yes',
                            'social_icon_icon_color_this': '#1DB954',
                        },
                        {   
                            'social_icon_item_icon':  {
                                'value': 'fab fa-whatsapp',
                                'library': 'fa-brands'
                            },
                            'social_icon_item_title': 'Whatsapp',
                            'social_icon_custom_styles': 'yes',
                            'social_icon_icon_color_this': '#25D366',
                        },
                    ],
                    'social_icon_wrapper_gap': {
                        'unit': 'px',
                        'size': 0,
                        'sizes': [] // Required for responsive
                    },
                    'social_icon_wrapper_bg_color_background': 'classic',
                    'social_icon_wrapper_bg_color_color': 'transparent',
                    'social_icon_wrapper_border_type_border': 'none',
                    'social_icon_gap': {
                        'unit': 'px',
                        'size': 0,
                        'sizes': [] // Required for responsive
                    },
                    'social_icon_padding': {
                        'top': '16',
                        'right': '5',
                        'bottom': '16',
                        'left': '16',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'social_icon_title_show': 'yes',
                    'social_icon_title_color': '#15171C',
                },
                'preset-7': {
                    'social_icons': [
                        {   
                            'social_icon_item_icon':  {
                                'value': 'fab fa-facebook-f',
                                'library': 'fa-brands'
                            },
                            'social_icon_item_title': 'Facebook',
                            'social_icon_custom_styles': 'no',
                        },
                        {   
                            'social_icon_item_icon':  {
                                'value': 'fab fa-linkedin-in',
                                'library': 'fa-brands'
                            },
                            'social_icon_item_title': 'Linkedin',
                            'social_icon_custom_styles': 'no',
                        },
                        {   
                            'social_icon_item_icon':  {
                                'value': 'fab fa-youtube',
                                'library': 'fa-brands'
                            },
                            'social_icon_item_title': 'Youtube',
                            'social_icon_custom_styles': 'no',
                        },
                        {   
                            'social_icon_item_icon':  {
                                'value': 'fab fa-telegram-plane',
                                'library': 'fa-brands'
                            },
                            'social_icon_item_title': 'Telegram',
                            'social_icon_custom_styles': 'no',
                        },
                        {   
                            'social_icon_item_icon':  {
                                'value': 'fab fa-spotify',
                                'library': 'fa-brands'
                            },
                            'social_icon_item_title': 'Spotify',
                            'social_icon_custom_styles': 'no',
                        },
                        {   
                            'social_icon_item_icon':  {
                                'value': 'fab fa-whatsapp',
                                'library': 'fa-brands'
                            },
                            'social_icon_item_title': 'Whatsapp',
                            'social_icon_custom_styles': 'no',
                        },
                    ],
                    'social_icon_wrapper_bg_color_background': 'classic',
                    'social_icon_wrapper_bg_color_color': '#15171C',
                    'social_icon_wrapper_padding': {
                        'top': '20',
                        'right': '30',
                        'bottom': '20',
                        'left': '30',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'social_icon_wrapper_border_radius': {
                        'top': '10',
                        'right': '10',
                        'bottom': '10',
                        'left': '10',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'social_icon_wrapper_border_type_border': 'none',
                    'social_icon_color': '#fff',
                    'social_icon_padding': {
                        'top': '0',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                },
            };
            panel.$el.off('change', '[data-setting="social_icon_presets"]');
            panel.$el.on('change', '[data-setting="social_icon_presets"]', function() {
                var selectedPreset = $(this).val();
                const allControls = view.model.get('settings').controls || {};

                _.each(allControls, function(control, key) {
                    if (key === 'social_icon_presets') {
                        view.model.setSetting(key, selectedPreset);
                        return;
                    }

                    // Handle repeater items separately
                    if (key === 'social_icons') {
                        if (selectedPreset !== 'default' && socialIconsPresetStyles[selectedPreset] && socialIconsPresetStyles[selectedPreset]['social_icons']) {
                            var presetItems = socialIconsPresetStyles[selectedPreset]['social_icons'];
                            var existingItems = view.model.getSetting('social_icons');
                            
                            if (existingItems && existingItems.models) {
                                // Remove all existing items using Elementor commands
                                var itemsToRemove = existingItems.models.length;
                                for (var i = itemsToRemove - 1; i >= 0; i--) {
                                    $e.run('document/repeater/remove', {
                                        container: elementor.getContainer(view.model.get('id')),
                                        name: 'social_icons',
                                        index: i
                                    });
                                }
                                
                                // Add new items from preset using Elementor commands
                                presetItems.forEach(function(newItem, index) {
                                    $e.run('document/repeater/insert', {
                                        container: elementor.getContainer(view.model.get('id')),
                                        name: 'social_icons',
                                        model: newItem,
                                        index: index
                                    });
                                });
                            }
                        } else if (selectedPreset === 'default') {
                            var presetItems = socialIconsPresetStyles['preset-6']['social_icons'];
                            var existingItems = view.model.getSetting('social_icons');
                            
                            if (existingItems && existingItems.models) {
                                // Remove all existing items using Elementor commands
                                var itemsToRemove = existingItems.models.length;
                                for (var i = itemsToRemove - 1; i >= 0; i--) {
                                    $e.run('document/repeater/remove', {
                                        container: elementor.getContainer(view.model.get('id')),
                                        name: 'social_icons',
                                        index: i
                                    });
                                }
                                
                                // Add new items from preset using Elementor commands
                                presetItems.forEach(function(newItem, index) {
                                    $e.run('document/repeater/insert', {
                                        container: elementor.getContainer(view.model.get('id')),
                                        name: 'social_icons',
                                        model: newItem,
                                        index: index
                                    });
                                });
                            }
                        }
                        return;
                    }

                    if (selectedPreset !== 'default' && socialIconsPresetStyles[selectedPreset]) {
                        view.model.setSetting(key, socialIconsPresetStyles[selectedPreset][key] ?? control.default);
                    } else if (selectedPreset === 'default') {
                        view.model.setSetting(key, control.default);
                    }
                });
                
                view.model.renderRemoteServer();
                const panelView = panel.getCurrentPageView();
                const social_icons_repeater = Object.values(panelView.children._views)[2];
                social_icons_repeater.render();
            });
        });
        elementor.hooks.addAction('panel/open_editor/widget/pea_cta', function(panel, model, view) {
            var counterPresetStyles = {
                'preset-2': {
                    'cta_background_background': 'classic',
                    'cta_background_image': {
                        'url': peaEditor.pluginUrl + 'assets/images/call-to-action/cta-2-bg.jpg',
                    },
                    'show_button_icon': 'yes',
                    'show_button_two_icon': 'yes',
                    'cta_button_icon_color': '#15171C',
                    'cta_button_icon_size': {
                        'unit': '',
                        'size': 15,
                        'sizes': []
                    },
                    'cta_button_icon_rotate': {
                        'unit': '',
                        'size': -45,
                        'sizes': []
                    },
                    'cta_button_icon_hover_color': '#fff',
                    'cta_button_two_icon_size': {
                        'unit': '',
                        'size': 15,
                        'sizes': []
                    },
                    'cta_button_two_icon_rotate': {
                        'unit': '',
                        'size': -45,
                        'sizes': []
                    },
                    // 'box_bg_color': '#F7F7F7',
                    // 'counter_title_position': 'column',
                    // 'box_content_hori_alignment': 'start',
                    // 'box_content_verti_alignment': 'start',
                },
                'preset-3': {
                    'cta_title_text': 'Marketing Course',
                    'button_text': 'Sign Up Now',
                    'cta_background_background': 'classic',
                    'cta_background_image': {
                        'url': peaEditor.pluginUrl + 'assets/images/call-to-action/cta-3-bg.jpg',
                    },
                    'show_button_icon': 'yes',
                    'show_button_two': 'no',
                    'cta_box_overlay_background_background': 'classic',
                    'cta_box_overlay_background_color': '#113458',
                    'cta_box_overlay_opacity': {
                        'unit': '',
                        'size': 0.7,
                        'sizes': []
                    },
                    'cta_button_icon_color': '#15171C',
                    'cta_button_icon_size': {
                        'unit': '',
                        'size': 15,
                        'sizes': []
                    },
                    'cta_button_icon_rotate': {
                        'unit': '',
                        'size': -45,
                        'sizes': []
                    },
                    'cta_button_icon_hover_color': '#fff',
                    'cta_button_border_radius': {
                        'top': '14',
                        'right': '14',
                        'bottom': '14',
                        'left': '14',
                        'unit': 'px',
                        'isLinked': true
                    },
                    // 'box_bg_color': '#F7F7F7',
                    // 'counter_title_position': 'column',
                    // 'box_content_hori_alignment': 'start',
                    // 'box_content_verti_alignment': 'start',
                },
                'preset-4': {
                    'cta_title_text': 'Marketing Course',
                    'button_text': 'Sign Up Now',
                    'cta_background_background': 'classic',
                    'cta_background_image': {
                        'url': '',
                    },
                    'show_button_icon': 'yes',
                    'show_button_two_icon': 'no',
                    'show_button_two': 'no',
                    'cta_box_overlay_background_background': 'classic',
                    'cta_box_overlay_background_color': '#fff',
                    'cta_box_overlay_opacity': {
                        'unit': '',
                        'size': 0.7,
                        'sizes': []
                    },
                    'cta_button_icon_color': '#fff',
                    'cta_button_icon_size': {
                        'unit': '',
                        'size': 15,
                        'sizes': []
                    },
                    'cta_button_icon_rotate': {
                        'unit': '',
                        'size': -45,
                        'sizes': []
                    },
                    'cta_button_icon_hover_color': '#fff',
                    'cta_button_color': '#fff',
                    'cta_button_bg_color': '#399CFF',
                    'cta_button_hover_bg_color': '#399CFF',
                    'cta_title_color': '#15171C',
                    'cta_desc_color': '#555E72',
                    'cta_button_border_border': 'none',
                    'cta_button_border_radius': {
                        'top': '50',
                        'right': '50',
                        'bottom': '50',
                        'left': '50',
                        'unit': 'px',
                        'isLinked': true
                    },
                    // 'box_bg_color': '#F7F7F7',
                    // 'counter_title_position': 'column',
                    // 'box_content_hori_alignment': 'start',
                    // 'box_content_verti_alignment': 'start',
                },
                'preset-5': {
                    'counter_end_number': {
                        'unit': '',
                        'size': 65,
                        'sizes': []
                    },
                    'icon_position': 'column',
                    'counter_title_position': 'column',
                    'box_bg_color': '#F8EFFF',
                    'icon_color': '#E43242',
                    'icon_size': {
                        'unit': 'px',
                        'size': 60,
                        'sizes': []
                    },
                    'box_width': {
                        'unit': 'px',
                        'size': 300,
                        'sizes': []
                    },
                    'box_height': {
                        'unit': 'px',
                        'size': 300,
                        'sizes': []
                    },
                    'box_border_border': 'solid',
                    'box_border_width': {
                        'top': '5',
                        'right': '5',
                        'bottom': '5',
                        'left': '5',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'box_border_color': '#E43242',
                    'box_border_radius': {
                        'top': '200',
                        'right': '200',
                        'bottom': '200',
                        'left': '200',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'counter_prefix': 'no',
                    'counter_suffix': 'yes',
                    'counter_suffix_text': '%',
                    'counter_icon_type': 'icon',
                    'counter_icon':  {
                        'value': 'fas fa-crown',
                        'library': 'fa-solid'
                    },
                    'counter_title_text': 'Skilled',
                },
                'preset-6': {
                    'counter_end_number': {
                        'unit': '',
                        'size': 6,
                        'sizes': []
                    },
                    'counter_icon_type': 'none',
                    'counter_title': 'no',
                    'icon_position': 'column',
                    'box_bg_color': '#EDF7EE',
                    'icon_color': '#4CAF50',
                    'icon_size': {
                        'unit': 'px',
                        'size': 60,
                        'sizes': []
                    },
                    'box_width': {
                        'unit': 'px',
                        'size': 300,
                        'sizes': []
                    },
                    'box_height': {
                        'unit': 'px',
                        'size': 300,
                        'sizes': []
                    },
                    'box_border_border': 'solid',
                    'box_border_width': {
                        'top': '8',
                        'right': '8',
                        'bottom': '8',
                        'left': '8',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'box_border_color': '#4CAF50',
                    'box_border_radius': {
                        'top': '200',
                        'right': '200',
                        'bottom': '200',
                        'left': '200',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'counter_prefix': 'yes',
                    'counter_prefix_text': '+',
                    'counter_suffix': 'yes',
                    'counter_suffix_text': 'B',
                },
            };
            panel.$el.off('change', '[data-setting="preset_styles"]');
            panel.$el.on('change', '[data-setting="preset_styles"]', function() {
                var selectedPreset = $(this).val();
                const allControls = view.model.get('settings').controls || {};

                _.each(allControls, function(control, key) {
                    if (key === 'preset_styles') {
                        view.model.setSetting(key, selectedPreset);
                        return;
                    }

                    if (selectedPreset !== 'default' && counterPresetStyles[selectedPreset]) {
                        view.model.setSetting(key, counterPresetStyles[selectedPreset][key] ?? control.default);
                    } else if (selectedPreset === 'default') {
                        view.model.setSetting(key, control.default);
                    }
                });
                
                view.model.renderRemoteServer();
            });
        });
        elementor.hooks.addAction('panel/open_editor/widget/pea_pricing_table', function(panel, model, view) {
            var counterPresetStyles = {
                'preset-2': {
                    'display_top_section': 'no',
                    'pricing_title': 'Enterprise',
                    'show_pricing_subtitle': 'yes',
                    'pricing_subtitle': 'Best for Business Owners.',
                    'show_price_text': 'yes', 
                    'price_text': 'What Value Add For Your Business', 
                    'show_feature_text': 'yes', 
                    'feature_text': 'Billed every year Popular amongst entrepeneurs $497 per year', 
                    'show_button_icon': 'none',
                    'price': '499.00',
                    'period': 'yearly',
                    'pricing_container_bg_color_background': 'classic',
                    'pricing_container_bg_color_color': '#6302E6',
                    'price_box_border_border': 'none',
                    'pricing_title_color': '#fff',
                    'pricing_subtitle_color': '#fff',
                    'currency_color': '#fff',
                    'price_color': '#fff',
                    'period_color': '#fff',
                    'price_after_text_color': '#fff',
                    'price_after_text_bg_type_background': 'classic',
                    'price_after_text_bg_type_color': '#FFFFFF1A;',
                    'feature_item_icon_color': '#fff',
                    'feature_item_title_color': '#fff',
                    'feature_after_text_color': '#fff',
                    'feature_item_border_border': 'none',
                    'price_typography_typography': 'custom',
                    'price_typography_font_family': 'Plus Jakarta Sans',
                    'price_typography_font_size': {
                        'unit': 'px',
                        'size': 42,
                        'sizes': [] // Required for responsive
                    },
                    'price_typography_font_weight': '700',
                    'price_typography_text_transform': 'capitalize',
                    'price_typography_font_style': 'normal',
                    'price_typography_text_decoration': 'none',
                    'price_typography_line_height': {
                        'unit': '%',
                        'size': 130,
                        'sizes': []
                    },
                    'period_typography_typography': 'custom',
                    'period_typography_font_family': 'Work Sans',
                    'period_typography_font_size': {
                        'unit': 'px',
                        'size': 18,
                        'sizes': [] // Required for responsive
                    },
                    'period_typography_font_weight': '400',
                    'period_typography_text_transform': 'capitalize',
                    'period_typography_font_style': 'normal',
                    'period_typography_text_decoration': 'none',
                    'period_typography_line_height': {
                        'unit': '%',
                        'size': 140,
                        'sizes': []
                    },
                    'feature_item_box_padding': {
                        'top': '42',
                        'right': '0',
                        'bottom': '32',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'pricing_padding': {
                        'top': '32',
                        'right': '0',
                        'bottom': '10',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'button_color': '#6302E6',
                    'button_bg_color_background': 'classic',
                    'button_bg_color_color': '#fff',
                    'button_border_radius': {
                        'top': '50',
                        'right': '50',
                        'bottom': '50',
                        'left': '50',
                        'unit': 'px',
                        'isLinked': true
                    },
                    
                },
                'preset-3': {
                    'display_top_section': 'no',
                    'pricing_title': '',
                    'show_pricing_subtitle': 'no',
                    'show_price_text': 'yes', 
                    'pricing_icon_type': 'icon',
                    'icon_position': 'yes',
                    'icon_position_left': {
                        'unit': '%',
                        'size': 89,
                        'sizes': [] // Required for responsive
                    },
                    'icon_color': '#fff',
                    'icon_hover_color': '',
                    'price_text': 'Personal Package', 
                    'show_feature_text': 'yes', 
                    'feature_text': 'Billed every year Popular amongst entrepeneurs $497 per year', 
                    'button_text': 'Get Started',
                    'show_button_icon': 'none',
                    'button_position': 'after-price',
                    'price': '49',
                    'period': 'year',
                    'pricing_container_bg_color_background': 'classic',
                    'pricing_container_bg_color_color': '#F89B2E',
                    'pricing_title_color': '#fff',
                    'pricing_subtitle_color': '#fff',
                    'currency_color': '#fff',
                    'price_color': '#fff',
                    'period_color': '#fff',
                    'price_after_text_color': '#fff',
                    'price_after_text_bg_type_background': 'classic',
                    'price_after_text_bg_type_color': '',
                    'feature_item_icon_color': '#fff',
                    'feature_item_title_color': '#fff',
                    'feature_after_text_color': '#fff',
                    'feature_item_border_border': 'none',
                    'price_typography_typography': 'custom',
                    'price_typography_font_family': 'Plus Jakarta Sans',
                    'price_typography_font_size': {
                        'unit': 'px',
                        'size': 42,
                        'sizes': [] // Required for responsive
                    },
                    'price_typography_font_weight': '700',
                    'price_typography_text_transform': 'capitalize',
                    'price_typography_font_style': 'normal',
                    'price_typography_text_decoration': 'none',
                    'price_typography_line_height': {
                        'unit': '%',
                        'size': 130,
                        'sizes': []
                    },
                    'period_typography_typography': 'custom',
                    'period_typography_font_family': 'Work Sans',
                    'period_typography_font_size': {
                        'unit': 'px',
                        'size': 18,
                        'sizes': [] // Required for responsive
                    },
                    'period_typography_font_weight': '400',
                    'period_typography_text_transform': 'capitalize',
                    'period_typography_font_style': 'normal',
                    'period_typography_text_decoration': 'none',
                    'period_typography_line_height': {
                        'unit': '%',
                        'size': 140,
                        'sizes': []
                    },
                    'price_after_text_typography_typography': 'custom',
                    'price_after_text_typography_font_family': 'Plus Jakarta Sans',
                    'price_after_text_typography_font_size': {
                        'unit': 'px',
                        'size': 24,
                        'sizes': [] // Required for responsive
                    },
                    'price_after_text_typography_font_weight': '600',
                    'price_after_text_typography_text_transform': 'capitalize',
                    'price_after_text_typography_font_style': 'normal',
                    'price_after_text_typography_text_decoration': 'none',
                    'price_after_text_typography_line_height': {
                        'unit': '%',
                        'size': 130,
                        'sizes': []
                    },
                    'pricing_padding': {
                        'top': '0',
                        'right': '0',
                        'bottom': '16',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'price_box_padding': {
                        'top': '0',
                        'right': '0',
                        'bottom': '42',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'price_box_border_border': 'solid',
                    'price_box_border_width': {
                        'top': '0',
                        'right': '0',
                        'bottom': '2',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'price_box_border_color': '#F9AF58',
                    'feature_item_box_padding': {
                        'top': '42',
                        'right': '0',
                        'bottom': '42',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'button_width': {
                        'unit': '%',
                        'size': 95,
                        'sizes': []
                    },
                    'button_color': '#15171C',
                    'button_bg_color_background': 'classic',
                    'button_bg_color_color': '#fff',
                    'button_border_radius': {
                        'top': '50',
                        'right': '50',
                        'bottom': '50',
                        'left': '50',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'pricing_container_padding': {
                        'top': '30',
                        'right': '30',
                        'bottom': '42',
                        'left': '30',
                        'unit': 'px',
                        'isLinked': true
                    },
                    
                },
                'preset-4': {
                    'display_top_section': 'no',
                    'pricing_title': 'Pro Plan',
                    'show_pricing_subtitle': 'yes',
                    'pricing_subtitle': 'Unlock the full potential of your website with our Pro plan.',
                    'show_price_text': 'yes', 
                    'price_text': 'Basic features for up to 15 user',
                    'pricing_icon_type': 'icon',
                    'icon_position': 'yes',
                    'icon_position_left': {
                        'unit': '%',
                        'size': 89,
                        'sizes': [] // Required for responsive
                    },
                    'icon_color': '#E95B68',
                    'icon_hover_color': '',
                    'show_feature_text': 'no',
                    'button_text': 'Get Started',
                    'show_button_icon': 'none',
                    'button_position': 'after-price',
                    'price': '49.00',
                    'period': 'year',
                    'pricing_container_bg_color_background': 'classic',
                    'pricing_container_bg_color_color': '#fff',
                    'pricing_container_border_border': 'solid',
                    'pricing_container_border_width': {
                        'top': '2',
                        'right': '2',
                        'bottom': '2',
                        'left': '2',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'price_box_border_border': 'none',
                    'pricing_container_border_color': '#E95B68',
                    'pricing_title_color': '#15171C',
                    'pricing_subtitle_color': '#555E72',
                    'currency_color': '#15171C',
                    'price_color': '#15171C',
                    'period_color': '#555E72',
                    'price_after_text_color': '#555E72',
                    'price_after_text_bg_type_background': 'classic',
                    'price_after_text_bg_type_color': '',
                    'feature_item_icon_color': '#E95B68',
                    'feature_item_title_color': '#555E72',
                    'feature_after_text_color': '#fff',
                    'feature_item_border_border': 'none',
                    'price_typography_typography': 'custom',
                    'price_typography_font_family': 'Plus Jakarta Sans',
                    'price_typography_font_size': {
                        'unit': 'px',
                        'size': 42,
                        'sizes': [] // Required for responsive
                    },
                    'price_typography_font_weight': '700',
                    'price_typography_text_transform': 'capitalize',
                    'price_typography_font_style': 'normal',
                    'price_typography_text_decoration': 'none',
                    'price_typography_line_height': {
                        'unit': '%',
                        'size': 130,
                        'sizes': []
                    },
                    'period_typography_typography': 'custom',
                    'period_typography_font_family': 'Work Sans',
                    'period_typography_font_size': {
                        'unit': 'px',
                        'size': 18,
                        'sizes': [] // Required for responsive
                    },
                    'period_typography_font_weight': '400',
                    'period_typography_text_transform': 'capitalize',
                    'period_typography_font_style': 'normal',
                    'period_typography_text_decoration': 'none',
                    'period_typography_line_height': {
                        'unit': '%',
                        'size': 140,
                        'sizes': []
                    },
                    'price_after_text_typography_typography': 'custom',
                    'price_after_text_typography_font_family': 'Work Sans',
                    'price_after_text_typography_font_size': {
                        'unit': 'px',
                        'size': 16,
                        'sizes': [] // Required for responsive
                    },
                    'price_after_text_typography_font_weight': '400',
                    'price_after_text_typography_text_transform': 'capitalize',
                    'price_after_text_typography_font_style': 'normal',
                    'price_after_text_typography_text_decoration': 'none',
                    'price_after_text_typography_line_height': {
                        'unit': '%',
                        'size': 140,
                        'sizes': []
                    },
                    'pricing_padding': {
                        'top': '32',
                        'right': '0',
                        'bottom': '10',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'price_box_padding': {
                        'top': '0',
                        'right': '0',
                        'bottom': '32',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'price_after_text_padding': {
                        'top': '0',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'feature_item_box_padding': {
                        'top': '0',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'button_width': {
                        'unit': '%',
                        'size': 100,
                        'sizes': []
                    },
                    'button_color': '#fff',
                    'button_bg_color_background': 'classic',
                    'button_bg_color_color': '#E95B68',
                    'button_border_radius': {
                        'top': '50',
                        'right': '50',
                        'bottom': '50',
                        'left': '50',
                        'unit': 'px',
                        'isLinked': true
                    },
                    
                },
                'preset-5': {
                    'display_top_section': 'no',
                    'pricing_title': 'Enterprise',
                    'show_pricing_subtitle': 'yes',
                    'pricing_subtitle': 'Best for Business Owners.',
                    'show_price_text': 'no', 
                    'pricing_icon_type': 'none',
                    'show_feature_text': 'yes',
                    'button_text': 'Select Plan',
                    'show_button_icon': 'none',
                    'button_position': 'after-price',
                    'price': '449.00',
                    'period': 'Yearly',
                    'pricing_container_bg_color_background': 'classic',
                    'pricing_container_bg_color_color': '#fff',
                    'pricing_container_border_border': 'none',
                    'price_box_border_border': 'none',
                    'pricing_container_padding': {
                        'top': '0',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'price_box_bg_color_background': 'classic',
                    'price_box_bg_color_color': '#F7F7F7',
                    'price_box_border_radius': {
                        'top': '16',
                        'right': '16',
                        'bottom': '16',
                        'left': '16',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'price_box_padding': {
                        'top': '24',
                        'right': '24',
                        'bottom': '24',
                        'left': '24',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'pricing_title_color': '#15171C',
                    'pricing_subtitle_color': '#555E72',
                    'currency_color': '#15171C',
                    'price_color': '#15171C',
                    'period_color': '#555E72',
                    'price_after_text_color': '#555E72',
                    'price_after_text_bg_type_background': 'classic',
                    'price_after_text_bg_type_color': '',
                    'feature_item_icon_color': '#399CFF',
                    'feature_item_title_color': '#6A758E',
                    'feature_after_text_color': '#15171C',
                    'feature_item_border_border': 'none',
                    'price_typography_typography': 'custom',
                    'price_typography_font_family': 'Plus Jakarta Sans',
                    'price_typography_font_size': {
                        'unit': 'px',
                        'size': 48,
                        'sizes': [] // Required for responsive
                    },
                    'price_typography_font_weight': '500',
                    'price_typography_text_transform': 'capitalize',
                    'price_typography_font_style': 'normal',
                    'price_typography_text_decoration': 'none',
                    'price_typography_line_height': {
                        'unit': '%',
                        'size': 130,
                        'sizes': []
                    },
                    'period_typography_typography': 'custom',
                    'period_typography_font_family': 'Work Sans',
                    'period_typography_font_size': {
                        'unit': 'px',
                        'size': 18,
                        'sizes': [] // Required for responsive
                    },
                    'period_typography_font_weight': '400',
                    'period_typography_text_transform': 'capitalize',
                    'period_typography_font_style': 'normal',
                    'period_typography_text_decoration': 'none',
                    'period_typography_line_height': {
                        'unit': '%',
                        'size': 140,
                        'sizes': []
                    },
                    'price_after_text_typography_typography': 'custom',
                    'price_after_text_typography_font_family': 'Work Sans',
                    'price_after_text_typography_font_size': {
                        'unit': 'px',
                        'size': 16,
                        'sizes': [] // Required for responsive
                    },
                    'price_after_text_typography_font_weight': '400',
                    'price_after_text_typography_text_transform': 'capitalize',
                    'price_after_text_typography_font_style': 'normal',
                    'price_after_text_typography_text_decoration': 'none',
                    'price_after_text_typography_line_height': {
                        'unit': '%',
                        'size': 140,
                        'sizes': []
                    },
                    'pricing_padding': {
                        'top': '32',
                        'right': '0',
                        'bottom': '10',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'price_after_text_padding': {
                        'top': '0',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'feature_item_border_border': 'solid',
                    'feature_item_border_width': {
                        'top': '0',
                        'right': '0',
                        'bottom': '1',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'feature_item_border_color': '#E1E3E8',
                    'feature_item_box_padding': {
                        'top': '30',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'feature_item_padding': {
                        'top': '10',
                        'right': '0',
                        'bottom': '10',
                        'left': '24',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'feature_after_text_margin': {
                        'top': '22',
                        'right': '0',
                        'bottom': '0',
                        'left': '24',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'button_width': {
                        'unit': '%',
                        'size': 100,
                        'sizes': []
                    },
                    'button_color': '#fff',
                    'button_bg_color_background': 'classic',
                    'button_bg_color_color': '#15171C   ',
                    'button_border_radius': {
                        'top': '10',
                        'right': '10',
                        'bottom': '10',
                        'left': '10',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'button_margin': {
                        'top': '16',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    
                },
                'preset-6': {
                    'display_top_section': 'no',
                    'pricing_title': 'Enterprise',
                    'show_pricing_subtitle': 'yes',
                    'pricing_subtitle': 'Best for Business Owners.',
                    'show_price_text': 'yes', 
                    'price_text': 'What Value Add For Your Business', 
                    'show_feature_text': 'yes', 
                    'feature_text': 'Billed every year Popular amongst entrepeneurs $497 per year', 
                    'show_button_icon': 'none',
                    'price': '499.00',
                    'period': 'yearly',
                    'pricing_container_bg_color_background': 'classic',
                    'pricing_container_bg_color_color': '#399CFF',
                    'price_box_border_border': 'none',
                    'pricing_title_color': '#fff',
                    'pricing_subtitle_color': '#fff',
                    'currency_color': '#fff',
                    'price_color': '#fff',
                    'period_color': '#fff',
                    'price_after_text_color': '#fff',
                    'price_after_text_bg_type_background': 'classic',
                    'price_after_text_bg_type_color': '#61B0FF;',
                    'feature_item_icon_color': '#fff',
                    'feature_item_title_color': '#fff',
                    'feature_after_text_color': '#fff',
                    'feature_item_border_border': 'none',
                    'price_typography_typography': 'custom',
                    'price_typography_font_family': 'Plus Jakarta Sans',
                    'price_typography_font_size': {
                        'unit': 'px',
                        'size': 42,
                        'sizes': [] // Required for responsive
                    },
                    'price_typography_font_weight': '700',
                    'price_typography_text_transform': 'capitalize',
                    'price_typography_font_style': 'normal',
                    'price_typography_text_decoration': 'none',
                    'price_typography_line_height': {
                        'unit': '%',
                        'size': 130,
                        'sizes': []
                    },
                    'period_typography_typography': 'custom',
                    'period_typography_font_family': 'Work Sans',
                    'period_typography_font_size': {
                        'unit': 'px',
                        'size': 18,
                        'sizes': [] // Required for responsive
                    },
                    'period_typography_font_weight': '400',
                    'period_typography_text_transform': 'capitalize',
                    'period_typography_font_style': 'normal',
                    'period_typography_text_decoration': 'none',
                    'period_typography_line_height': {
                        'unit': '%',
                        'size': 140,
                        'sizes': []
                    },
                    'feature_item_box_padding': {
                        'top': '42',
                        'right': '0',
                        'bottom': '32',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'pricing_padding': {
                        'top': '32',
                        'right': '0',
                        'bottom': '10',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'button_color': '#399CFF',
                    'button_bg_color_background': 'classic',
                    'button_bg_color_color': '#fff',
                    'button_border_radius': {
                        'top': '10',
                        'right': '10',
                        'bottom': '10',
                        'left': '10',
                        'unit': 'px',
                        'isLinked': true
                    },
                    
                },
                'preset-7': {
                    'display_top_section': 'yes',
                    'top_section_background_custom_css_toggle': 'yes',
                    'top_section_background_custom_css': 'linear-gradient(141.79deg, #8E92FD 0%, #C9A9FF 50%, #8F93FF 100%)',
                    'pricing_title': 'Basic Plan',
                    'show_pricing_subtitle': 'yes',
                    'pricing_subtitle': 'Everything you need to get start building your website.',
                    'show_price_text': 'no', 
                    'show_feature_text': 'no', 
                    'show_button_icon': 'none',
                    'price': '9.99',
                    'period': 'month',
                    'button_text': 'Get started',
                    'pricing_container_bg_color_background': 'classic',
                    'pricing_container_bg_color_color': '#16161E',
                    'pricing_container_padding': {
                        'top': '32',
                        'right': '32',
                        'bottom': '32',
                        'left': '32',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'price_box_border_border': 'solid',
                    'price_box_border_width': {
                        'top': '0',
                        'right': '0',
                        'bottom': '1',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'price_box_border_color': '#20232B',
                    'price_box_padding': {
                        'top': '0',
                        'right': '0',
                        'bottom': '40',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'pricing_title_color': '#C3C8D2',
                    'pricing_subtitle_color': '#C3C8D2',
                    'currency_color': '#fff',
                    'price_color': '#fff',
                    'period_color': '#C3C8D2',
                    'feature_item_icon_color': '#C3C8D2',
                    'feature_item_title_color': '#C3C8D2',
                    'feature_item_border_border': 'none',
                    'price_typography_typography': 'custom',
                    'price_typography_font_family': 'Plus Jakarta Sans',
                    'price_typography_font_size': {
                        'unit': 'px',
                        'size': 92,
                        'sizes': [] // Required for responsive
                    },
                    'price_typography_font_weight': '400',
                    'price_typography_text_transform': 'capitalize',
                    'price_typography_font_style': 'normal',
                    'price_typography_text_decoration': 'none',
                    'price_typography_line_height': {
                        'unit': '%',
                        'size': 130,
                        'sizes': []
                    },
                    'period_typography_typography': 'custom',
                    'period_typography_font_family': 'Work Sans',
                    'period_typography_font_size': {
                        'unit': 'px',
                        'size': 16,
                        'sizes': [] // Required for responsive
                    },
                    'period_typography_font_weight': '400',
                    'period_typography_text_transform': 'capitalize',
                    'period_typography_font_style': 'normal',
                    'period_typography_text_decoration': 'none',
                    'period_typography_line_height': {
                        'unit': '%',
                        'size': 140,
                        'sizes': []
                    },
                    'feature_item_box_padding': {
                        'top': '42',
                        'right': '0',
                        'bottom': '32',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'pricing_padding': {
                        'top': '32',
                        'right': '0',
                        'bottom': '10',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'button_color': '#fff',
                    'button_bg_color_background': 'gradient',
                    'button_bg_color_color': '#C9A9FF',
                    'button_bg_color_color_stop': {
                        'unit': '%',
                        'size': 0,
                        'sizes': [] // Required for responsive
                    },
                    'button_bg_color_color_b': '#8F93FF',
                    'button_bg_color_color_b_stop': {
                        'unit': '%',
                        'size': 100,
                        'sizes': [] // Required for responsive
                    },
                    'button_bg_color_gradient_angle': {
                        'unit': 'deg',
                        'size': 141,
                        'sizes': [] // Required for responsive
                    },
                    'button_border_radius': {
                        'top': '10',
                        'right': '10',
                        'bottom': '10',
                        'left': '10',
                        'unit': 'px',
                        'isLinked': true
                    },
                    
                },
            };
            panel.$el.off('change', '[data-setting="preset_styles"]');
            panel.$el.on('change', '[data-setting="preset_styles"]', function() {
                var selectedPreset = $(this).val();
                const allControls = view.model.get('settings').controls || {};

                _.each(allControls, function(control, key) {
                    if (key === 'preset_styles') {
                        view.model.setSetting(key, selectedPreset);
                        return;
                    }

                    if (selectedPreset !== 'default' && counterPresetStyles[selectedPreset]) {
                        view.model.setSetting(key, counterPresetStyles[selectedPreset][key] ?? control.default);
                    } else if (selectedPreset === 'default') {
                        view.model.setSetting(key, control.default);
                    }
                });
                
                view.model.renderRemoteServer();
            });
        });
        elementor.hooks.addAction('panel/open_editor/widget/pea_team_member', function(panel, model, view) {
            var testimonialPresetStyles = {
                'preset-2': {
                    'show_description': 'yes',
                    'show_Icon': 'yes',
                    'show_social_profiles': 'yes',
                    'social_icon_direction': 'row',
                    'icon_animation_type': 'icon-animation-right',
                    'social_profiles_display': 'in-image',
                    'social_icon_position_for_image': 'do-bottom-left',
                    'team_member_box_bg_color_background': 'classic',
                    'team_member_box_bg_color_color': '#fff',
                    'team_member_box_hover_bg_color_background': 'classic',
                    'team_member_box_hover_bg_color_color': '',
                    'team_member_box_border_border': 'none',
                    'team_member_box_border_radius': {
                        'top': '16',
                        'right': '16',
                        'bottom': '16',
                        'left': '16',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'team_member_box_padding': {
                        'top': '0',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'team_member_box_margin': {
                        'top': '0',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'team_member_avatar_alignment': 'start',
                    'team_member_avatar_width': {
                        'unit': '%',
                        'size': 100,
                        'sizes': [] 
                    },
                    'team_member_avatar_height': {
                        'unit': 'px',
                        'size': 410,
                        'sizes': [] 
                    },
                    'team_member_avatar_border_radius': {
                        'top': '16',
                        'right': '16',
                        'bottom': '16',
                        'left': '16',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'team_member_avatar_margin': {
                        'top': '0',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'team_member_content_alignment': 'start',
                    'team_member_content_padding': {
                        'top': '0',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    }, 
                    'team_member_content_margin': {
                        'top': '10',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    }, 
                    'team_member_designation_typography_typography': 'custom',
                    'team_member_designation_typography_font_size': {
                        'unit': 'px',
                        'size': 20,
                        'sizes': [] 
                    },
                    'team_member_designation_color': '#F89B2E',
                    'team_member_social_icon_button_margin': {
                        'top': '0',
                        'right': '0',
                        'bottom': '10',
                        'left': '20',
                        'unit': 'px',
                        'isLinked': true
                    }, 
                    'team_member_social_icon_margin': {
                        'top': '10',
                        'right': '10',
                        'bottom': '20',
                        'left': '10',
                        'unit': 'px',
                        'isLinked': true
                    },
                },
                'preset-3': {
                    'avatar_image_overlay': 'no',
                    'show_description': 'no',
                    'content_position_in_image': 'no',
                    'name':'Tyler Pacocha',
                    'show_Icon': 'yes',
                    'show_social_profiles': 'yes',
                    'social_icon_direction': 'column-reverse',
                    'icon_animation_type': 'icon-animation-top',
                    'social_profiles_display': 'in-image',
                    'social_icon_position_for_image': 'do-bottom-center',
                    // 'social_icon_alignment': 'space-between',
                    // 'social_icon_position_for_image': 'do-bottom-left',
                    'team_member_box_bg_color_background': 'classic',
                    'team_member_box_bg_color_color': '',
                    'team_member_box_hover_bg_color_background': 'classic',
                    'team_member_box_hover_bg_color_color': '',
                    'team_member_box_border_border': 'none',
                    'team_member_box_border_radius': {
                        'top': '0',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'team_member_box_padding': {
                        'top': '0',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'team_member_box_margin': {
                        'top': '0',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'team_member_avatar_alignment': 'center',
                    'team_member_avatar_width': {
                        'unit': 'px',
                        'size': 242,
                        'sizes': [] 
                    },
                    'team_member_avatar_height': {
                        'unit': 'px',
                        'size': 410,
                        'sizes': [] 
                    },
                    'team_member_avatar_border_radius': {
                        'top': '200',
                        'right': '200',
                        'bottom': '200',
                        'left': '200',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'team_member_avatar_margin': {
                        'top': '0',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'team_member_content_alignment': 'center',
                    'team_member_content_padding': {
                        'top': '32',
                        'right': '32',
                        'bottom': '0',
                        'left': '32',
                        'unit': 'px',
                        'isLinked': true
                    }, 
                    'team_member_content_margin': {
                        'top': '0',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    }, 
                    'team_member_name_typography_typography': 'custom',
                    'team_member_name_typography_font_size': {
                        'unit': 'px',
                        'size': 24,
                        'sizes': [] 
                    },
                    'team_member_name_typography_line_height': {
                        'unit': '%',
                        'size': 130,
                        'sizes': []
                    },
                    'team_member_name_color': '#15171C',
                    'team_member_designation_typography_typography': 'custom',
                    'team_member_designation_typography_font_family': 'Work Sans',
                    'team_member_designation_typography_font_size': {
                        'unit': 'px',
                        'size': 18,
                        'sizes': [] 
                    },
                    'team_member_designation_typography_font_weight': '400',
                    'team_member_designation_typography_line_height': {
                        'unit': '%',
                        'size': 140,
                        'sizes': []
                    },
                    'team_member_designation_color': '#555E72',
                    'team_member_social_icon_button_size': {
                        'unit': 'px',
                        'size': 20,
                        'sizes': []
                    },
                    'team_member_social_icon_button_rotate': {
                        'unit': 'deg',
                        'size': -45,
                        'sizes': []
                    },
                    'team_member_social_icon_button_hover_rotate': {
                        'unit': 'deg',
                        'size': -90,
                        'sizes': []
                    },
                    'team_member_social_icon_button_color': '#FFFFFF',
                    'team_member_social_icon_button_bg_color': '#15171C',
                    'team_member_social_icon_button_border_border': 'solid',
                    'team_member_social_icon_button_border_width': {
                        'top': '2',
                        'right': '2',
                        'bottom': '2',
                        'left': '2',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'team_member_social_icon_button_border_color': '#FFFFFF',
                    'team_member_social_icon_button_margin': {
                        'top': '0',
                        'right': '0',
                        'bottom': '-30',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    }, 
                    'team_member_social_icon_color': '#FFFFFF',
                    'team_member_social_icon_bg_color': '#15171C66',
                    'team_member_social_icon_border_border': 'solid',
                    'team_member_social_icon_border_width': {
                        'top': '2',
                        'right': '2',
                        'bottom': '2',
                        'left': '2',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'team_member_social_icon_border_color': '#C3C8D266',
                    'team_member_social_icon_blur': {
                        'unit': 'px',
                        'size': 4,
                        'sizes': []
                    },
                    'team_member_social_icon_margin': {
                        'top': '0',
                        'right': '0',
                        'bottom': '10',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                },
            };

            panel.$el.off('change', '[data-setting="preset_styles"]');
            panel.$el.on('change', '[data-setting="preset_styles"]', function() {
                var selectedPreset = $(this).val();
                const allControls = view.model.get('settings').controls || {};

                _.each(allControls, function(control, key) {
                    if (key === 'preset_styles') {
                        view.model.setSetting(key, selectedPreset);
                        return;
                    }
                    if (key === 'social_icons') {
                        return;
                    }

                    if (selectedPreset !== 'default' && testimonialPresetStyles[selectedPreset]) {
                        view.model.setSetting(key, testimonialPresetStyles[selectedPreset][key] ?? control.default);
                    } else if (selectedPreset === 'default') {
                        view.model.setSetting(key, control.default);
                    }
                });
                
                view.model.renderRemoteServer();
                
            });
        });
        elementor.hooks.addAction('panel/open_editor/widget/pea_count_down', function(panel, model, view) {
            var countDownPresetStyles = {
                'preset-2': {
                    'count_down_wrapper_bg_color_background': 'classic',
                    'count_down_wrapper_bg_color_color': '#fff',
                    'digit_all_color': '#15171C',
                    'label_color': '#8891A5',
                    'separator_color': '#15171C',
                },
                'preset-3': {
                    'separator_type': 'line',
                    'count_down_wrapper_bg_color_background': 'classic',
                    'count_down_wrapper_bg_color_color': '#f7f7f7',
                    'enable_single_colors': 'yes', 
                    'digit_day_color': '#e43242',
                    'digit_hour_color': '#4caf50',
                    'digit_minutes_color': '#f89b2e',
                    'digit_second_color': '#399cff',
                    'label_color': '#8891A5',
                    'separator_color': '#e1e3e8',
                    'separator_typography_typography': 'custom',
                    'separator_typography_font_size': {
                        'unit': 'px',
                        'size': 70,
                        'sizes': [] // Required for responsive
                    },
                    'separator_typography_font_weight': '100',
                },
                'preset-4': {
                    'layout_type': 'grid',
                    'showa_separator': 'yes',
                    'separator_type': 'colon',
                    'count_down_wrapper_bg_color_background': 'classic',
                    'count_down_wrapper_bg_color_color': '#5B0AC6',
                    'digit_height': {
                        'unit': 'px',
                        'size': 130,
                        'sizes': [] // Required for responsive
                    },
                    'digit_border_border': 'solid',
                    'digit_border_width': {
                        'top': '1',
                        'right': '1',
                        'bottom': '0',
                        'left': '1',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'digit_border_color': '#5D98FF80',
                    'digit_border_radius': {
                        'top': '10',
                        'right': '10',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'label_height': {
                        'unit': 'px',
                        'size': 50,
                        'sizes': [] // Required for responsive
                    },
                    'enable_single_colors': 'yes', 
                    'label_color': '#fff',
                    'label_bg_color': '#5D98FF',
                    'label_border_radius': {
                        'top': '0',
                        'right': '0',
                        'bottom': '10',
                        'left': '10',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'label_margin': {
                        'top': '0',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'separator_hori_spacing': {
                        'unit': 'px',
                        'size': 60,
                        'sizes': [] // Required for responsive
                    },
                    'separator_verti_spacing': {
                        'unit': 'px',
                        'size': 80,
                        'sizes': [] // Required for responsive
                    },
                    'separator_color': '#fff',
                    'separator_typography_typography': 'custom',
                    'separator_typography_font_size': {
                        'unit': 'px',
                        'size': 62,
                        'sizes': [] // Required for responsive
                    },
                    'separator_typography_font_family': 'Manrope',
                },
            };

            panel.$el.off('change', '[data-setting="preset_styles"]');
            panel.$el.on('change', '[data-setting="preset_styles"]', function() {
                var selectedPreset = $(this).val();
                const allControls = view.model.get('settings').controls || {};

                _.each(allControls, function(control, key) {
                    if (key === 'preset_styles') {
                        view.model.setSetting(key, selectedPreset);
                        return;
                    }

                    if (selectedPreset !== 'default' && countDownPresetStyles[selectedPreset]) {
                        view.model.setSetting(key, countDownPresetStyles[selectedPreset][key] ?? control.default);
                    } else if (selectedPreset === 'default') {
                        view.model.setSetting(key, control.default);
                    }
                });
                
                view.model.renderRemoteServer();
                
            });
        });
        
        elementor.hooks.addAction('panel/open_editor/widget/pea_post_grid', function(panel, model, view) {
            // Show loading state
            function loadAuthors(postType) {
                const include = panel.$el.find('.elementor-control-author_include_ids select');
                const exclude = panel.$el.find('.elementor-control-author_exclude_ids select');
                
                // GET SAVED VALUES BEFORE CLEARING
                const savedInclude = view.model.getSetting('author_include_ids') || [];
                const savedExclude = view.model.getSetting('author_exclude_ids') || [];
                
                include.empty().append('<option disabled>Loading...</option>').attr('aria-disabled', 'true');
                exclude.empty().append('<option disabled>Loading...</option>').attr('aria-disabled', 'true');
                
                jQuery.ajax({
                    url: ajaxurl,
                    type: "POST",
                    data: {
                        action: "get_author_by_post_type",
                        post_type: postType, 
                        pea_editor_nonce_check: peaEditor.pea_editor_nonce,
                    },
                    success: function (response) {
                        if (!response.success) return;

                        let items = response.data;
                        let options = {};

                        Object.keys(items).forEach(function (key) {
                            options[key] = items[key];
                        });

                        include.empty();
                        exclude.empty();

                        Object.entries(options).forEach(([value, label]) => {
                            include.append(new Option(label, value));
                            exclude.append(new Option(label, value));
                        });

                        // RESTORE SAVED VALUES - but only ones that exist in current options
                        const availableIds = Object.keys(options);
                        const validInclude = savedInclude.filter(id => availableIds.includes(String(id)));
                        const validExclude = savedExclude.filter(id => availableIds.includes(String(id)));

                        // Set values AFTER a small delay to ensure Select2 is ready
                        setTimeout(() => {
                            if (validInclude.length > 0) {
                                include.val(validInclude).trigger('change');
                            }
                            if (validExclude.length > 0) {
                                exclude.val(validExclude).trigger('change');
                            }
                        }, 100);

                    },
                    error: function(response) {
                        console.log(response.responseJSON?.message);
                    }
                });
            }
            
            function loadCategories(postType) {
                const include = panel.$el.find('.elementor-control-category_include_ids select');
                const exclude = panel.$el.find('.elementor-control-category_exclude_ids select');
                
                // GET SAVED VALUES BEFORE CLEARING
                const savedInclude = view.model.getSetting('category_include_ids') || [];
                const savedExclude = view.model.getSetting('category_exclude_ids') || [];
                
                include.empty().append('<option disabled>Loading...</option>').attr('aria-disabled', 'true');
                exclude.empty().append('<option disabled>Loading...</option>').attr('aria-disabled', 'true');
                
                jQuery.ajax({
                    url: ajaxurl,
                    type: "POST",
                    data: {
                        action: "get_category_by_post_type",
                        post_type: postType, 
                        pea_editor_nonce_check: peaEditor.pea_editor_nonce,
                    },
                    success: function (response) {
                        if (!response.success) return;

                        let items = response.data;
                        let options = {};

                        Object.keys(items).forEach(function (key) {
                            options[key] = items[key];
                        });

                        include.empty();
                        exclude.empty();

                        Object.entries(options).forEach(([value, label]) => {
                            include.append(new Option(label, value));
                            exclude.append(new Option(label, value));
                        });

                        // RESTORE SAVED VALUES - but only ones that exist in current options
                        const availableIds = Object.keys(options);
                        const validInclude = savedInclude.filter(id => availableIds.includes(String(id)));
                        const validExclude = savedExclude.filter(id => availableIds.includes(String(id)));

                        // Set values AFTER a small delay to ensure Select2 is ready
                        setTimeout(() => {
                            if (validInclude.length > 0) {
                                include.val(validInclude).trigger('change');
                            }
                            if (validExclude.length > 0) {
                                exclude.val(validExclude).trigger('change');
                            }
                        }, 100);

                    },
                    error: function(response) {
                        console.log(response.responseJSON?.message);
                    }
                });
            }
            
            function loadTags(postType) {
                const include = panel.$el.find('.elementor-control-tag_include_ids select');
                const exclude = panel.$el.find('.elementor-control-tag_exclude_ids select');
                
                // GET SAVED VALUES BEFORE CLEARING
                const savedInclude = view.model.getSetting('tag_include_ids') || [];
                const savedExclude = view.model.getSetting('tag_exclude_ids') || [];
                
                include.empty().append('<option disabled>Loading...</option>').attr('aria-disabled', 'true');
                exclude.empty().append('<option disabled>Loading...</option>').attr('aria-disabled', 'true');
                
                jQuery.ajax({
                    url: ajaxurl,
                    type: "POST",
                    data: {
                        action: "get_tag_by_post_type",
                        post_type: postType, 
                        pea_editor_nonce_check: peaEditor.pea_editor_nonce,
                    },
                    success: function (response) {
                        if (!response.success) return;

                        let items = response.data;
                        let options = {};

                        Object.keys(items).forEach(function (key) {
                            options[key] = items[key];
                        });

                        include.empty();
                        exclude.empty();

                        Object.entries(options).forEach(([value, label]) => {
                            include.append(new Option(label, value));
                            exclude.append(new Option(label, value));
                        });

                        // RESTORE SAVED VALUES - but only ones that exist in current options
                        const availableIds = Object.keys(options);
                        const validInclude = savedInclude.filter(id => availableIds.includes(String(id)));
                        const validExclude = savedExclude.filter(id => availableIds.includes(String(id)));

                        // Set values AFTER a small delay to ensure Select2 is ready
                        setTimeout(() => {
                            if (validInclude.length > 0) {
                                include.val(validInclude).trigger('change');
                            }
                            if (validExclude.length > 0) {
                                exclude.val(validExclude).trigger('change');
                            }
                        }, 100);

                    },
                    error: function(response) {
                        console.log(response.responseJSON?.message);
                    }
                });
            }
            
            view.model.get('settings').on('change:post_type', function(settingsModel, value) {
                var postType = value;
                loadAuthors(postType);
                loadCategories(postType);
                loadTags(postType);
                
            });

            // Load on initial widget edit
            let initialPostType = view.model.getSetting('post_type');
            loadAuthors(initialPostType);
            loadCategories(initialPostType);
            loadTags(initialPostType);

            elementor.channels.editor.on('section:activated', function(sectionName, editor) {
                if(sectionName === 'query_section'){
                    // Load on initial widget edit
                    let initialPostType = view.model.getSetting('post_type');
                    loadAuthors(initialPostType);
                    loadCategories(initialPostType);
                    loadTags(initialPostType);
                }
            });

            var PostGridPresetStyles = {
                'preset-2': {
                    'show_category': 'yes',
                    'author_position': 'after-desc',
                    'post_content_border_border': 'solid',
                    'post_content_border_width': {
                        'top': '0',
                        'right': '1',
                        'bottom': '1',
                        'left': '1',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'post_content_border_color': '#E1E3E8',
                    'post_content_border_radius': {
                        'top': '0',
                        'right': '0',
                        'bottom': '16',
                        'left': '16',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'post_content_padding': {
                        'top': '24',
                        'right': '24',
                        'bottom': '24',
                        'left': '24',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'thumbnail_border_radius': {
                        'top': '16',
                        'right': '16',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'title_margin': {
                        'top': '16',
                        'right': '0',
                        'bottom': '16',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'category_margin': {
                        'top': '0',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'author_box_margin': {
                        'top': '24',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    // 'count_down_wrapper_bg_color_background': 'classic',
                    // 'count_down_wrapper_bg_color_color': '#fff',
                    // 'digit_all_color': '#15171C',
                    // 'label_color': '#8891A5',
                    // 'separator_color': '#15171C',
                },
                'preset-3': {
                    'show_author_image': 'no',
                    'show_author_prefix': 'yes',
                    'author_prefix_text': 'By',
                    'show_category': 'no',
                    'author_position': 'after-title',
                    'post_grid_border_border': 'solid',
                    'post_grid_border_width': {
                        'top': '1',
                        'right': '1',
                        'bottom': '1',
                        'left': '1',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'post_grid_border_color': '#E1E3E8',
                    'post_grid_border_radius': {
                        'top': '0',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'post_grid_padding': {
                        'top': '8',
                        'right': '8',
                        'bottom': '8',
                        'left': '8',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'post_content_border_radius': {
                        'top': '0',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'post_content_padding': {
                        'top': '32',
                        'right': '24',
                        'bottom': '32',
                        'left': '24',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'thumbnail_border_radius': {
                        'top': '0',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'title_alignment': 'center',
                    'title_margin': {
                        'top': '0',
                        'right': '0',
                        'bottom': '24',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'description_alignment': 'center',
                    'description_margin': {
                        'top': '0',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'author_alignment': 'center',
                    'author_gap': {
                        'unit': 'px',
                        'size': 8,
                        'sizes': [] // Required for responsive
                    },
                    'author_box_margin': {
                        'top': '0',
                        'right': '0',
                        'bottom': '24',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'author_typography_typography': 'custom',
                    'author_typography_font_weight': '500',
                    'author_color': '#555E72',
                    'author_prefix_color': '#555E72',
                    'date_typography_typography': 'custom',
                    'date_typography_font_weight': '500',
                    'date_color': '#555E72',
                },
                'preset-4': {
                    'show_author': 'yes',
                    'show_author_image': 'yes',
                    'show_author_prefix': 'no',
                    'show_read_more': 'no',
                    'show_category': 'yes',
                    'post_card_style': 'list',
                    'list_image_spacing': {
                        'unit': 'px',
                        'size': 24,
                        'sizes': [] // Required for responsive
                    },
                    'author_position': 'after-desc',
                    'post_grid_border_border': 'none',
                    'post_grid_border_radius': {
                        'top': '0',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'post_grid_padding': {
                        'top': '0',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'post_content_padding': {
                        'top': '29',
                        'right': '24',
                        'bottom': '29',
                        'left': '24',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'thumbnail_width': {
                        'unit': 'px',
                        'size': 410,
                        'sizes': [] // Required for responsive
                    },
                    'thumbnail_height': {
                        'unit': 'px',
                        'size': 300,
                        'sizes': [] // Required for responsive
                    },
                    'thumbnail_border_radius': {
                        'top': '0',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'title_alignment': 'start',
                    'title_margin': {
                        'top': '0',
                        'right': '0',
                        'bottom': '16',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'description_typography_typography': 'custom',
                    'description_typography_font_weight': '400',
                    'description_alignment': 'start',
                    'description_margin': {
                        'top': '0',
                        'right': '0',
                        'bottom': '24',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'category_typography_typography': 'custom',
                    'category_typography_font_weight': '400',
                    'category_bg_color': '#ffffff',
                    'category_border_border': 'solid',
                    'category_border_width': {
                        'top': '1',
                        'right': '1',
                        'bottom': '1',
                        'left': '1',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'category_border_color': '#E1E3E8',
                    'category_border_radius': {
                        'top': '0',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'category_margin': {
                        'top': '0',
                        'right': '0',
                        'bottom': '16',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'author_alignment': 'start',
                    'author_box_margin': {
                        'top': '0',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'author_typography_typography': 'custom',
                    'author_typography_font_weight': '400',
                    'author_color': '#15171C',
                    'author_prefix_color': '#15171C',
                    'date_typography_typography': 'custom',
                    'date_typography_font_weight': '400',
                    'date_color': '#15171C',
                },
                'preset-5': {
                    'show_author': 'no',
                    'show_author_image': 'no',
                    'show_date': 'yes',
                    'author_position': 'after-desc',
                    'show_read_more': 'no',
                    'show_category': 'yes',
                    'show_excerpt': 'no',
                    'post_card_style': 'list',
                    'list_column': {
                        'unit': '',
                        'size': 2,
                        'sizes': [] // Required for responsive
                    },
                    'list_gap': {
                        'unit': 'px',
                        'size': 30,
                        'sizes': [] // Required for responsive
                    },
                    'list_image_spacing': {
                        'unit': 'px',
                        'size': 24,
                        'sizes': [] // Required for responsive
                    },
                    'post_grid_bg_color_background': 'classic',
                    'post_grid_bg_color_color': '#F7F7F7',
                    'post_grid_border_border': 'none',
                    'post_grid_border_radius': {
                        'top': '14',
                        'right': '14',
                        'bottom': '14',
                        'left': '14',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'post_grid_padding': {
                        'top': '0',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'post_content_padding': {
                        'top': '0',
                        'right': '24',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'thumbnail_width': {
                        'unit': 'px',
                        'size': 280,
                        'sizes': [] // Required for responsive
                    },
                    'thumbnail_height': {
                        'unit': 'px',
                        'size': 235,
                        'sizes': [] // Required for responsive
                    },
                    'thumbnail_border_radius': {
                        'top': '0',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'title_alignment': 'start',
                    'title_typography_typography': 'custom',
                    'title_typography_font_family': 'Work Sans',
                    'title_typography_font_size': {
                        'unit': 'px',
                        'size': 20,
                        'sizes': [] 
                    },
                    'title_typography_font_weight': '500',
                    'title_typography_line_height': {
                        'unit': '%',
                        'size': 140,
                        'sizes': []
                    },
                    'title_margin': {
                        'top': '0',
                        'right': '0',
                        'bottom': '32',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'category_typography_typography': 'custom',
                    'category_typography_font_family': 'Work Sans',
                    'category_typography_font_size': {
                        'unit': 'px',
                        'size': 14,
                        'sizes': [] 
                    },
                    'category_typography_font_weight': '400',
                    'category_typography_line_height': {
                        'unit': '%',
                        'size': 120,
                        'sizes': []
                    },
                    'category_color': '#555E72',
                    'category_bg_color': '#ffffff',
                    'category_border_border': 'none',
                    'category_border_radius': {
                        'top': '30',
                        'right': '30',
                        'bottom': '30',
                        'left': '30',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'category_padding': {
                        'top': '6',
                        'right': '12',
                        'bottom': '6',
                        'left': '12',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'category_margin': {
                        'top': '0',
                        'right': '0',
                        'bottom': '32',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'author_alignment': 'start',
                    'author_box_margin': {
                        'top': '0',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'date_typography_typography': 'custom',
                    'date_typography_font_family': 'Work Sans',
                    'date_typography_font_size': {
                        'unit': 'px',
                        'size': 16,
                        'sizes': [] 
                    },
                    'date_typography_font_weight': '500',
                    'date_typography_line_height': {
                        'unit': '%',
                        'size': 140,
                        'sizes': []
                    },
                    'date_color': '#555E72',
                },
                'preset-6': {
                    'show_featured_image': 'no',
                    'show_author': 'no',
                    'show_author_image': 'no',
                    'show_date': 'no',
                    'show_read_more': 'yes',
                    'show_category': 'yes',
                    'show_excerpt': 'yes',
                    'post_card_style': 'grid',
                    'grid_column': {
                        'unit': '',
                        'size': 3,
                        'sizes': [] // Required for responsive
                    },
                    'grid_row_gap': {
                        'unit': 'px',
                        'size': 30,
                        'sizes': [] // Required for responsive
                    },
                    'grid_column_gap': {
                        'unit': 'px',
                        'size': 30,
                        'sizes': [] // Required for responsive
                    },
                    'post_content_bg_color_background': 'gradient',
                    'post_content_bg_color_color': '#FF84ED',
                    'post_content_bg_color_color_stop': {
                        'unit': '%',
                        'size': 0,
                        'sizes': [] // Required for responsive
                    },
                    'post_content_bg_color_color_b': '#431B92',
                    'post_content_bg_color_color_b_stop': {
                        'unit': '%',
                        'size': 100,
                        'sizes': [] // Required for responsive
                    },
                    'post_content_bg_color_gradient_angle': {
                        'unit': 'deg',
                        'size': 132,
                        'sizes': [] // Required for responsive
                    },
                    'post_content_border_radius': {
                        'top': '12',
                        'right': '12',
                        'bottom': '12',
                        'left': '12',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'post_content_padding': {
                        'top': '32',
                        'right': '32',
                        'bottom': '32',
                        'left': '32',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'title_alignment': 'start',
                    'title_color': '#FFFFFF',
                    'title_typography_typography': 'custom',
                    'title_typography_font_family': 'Work Sans',
                    'title_typography_font_size': {
                        'unit': 'px',
                        'size': 20,
                        'sizes': [] 
                    },
                    'title_typography_font_weight': '500',
                    'title_typography_line_height': {
                        'unit': '%',
                        'size': 140,
                        'sizes': []
                    },
                    'title_margin': {
                        'top': '0',
                        'right': '0',
                        'bottom': '24',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'description_color': '#FFFFFF',
                    'description_typography_typography': 'custom',
                    'description_typography_font_family': 'Work Sans',
                    'description_typography_font_size': {
                        'unit': 'px',
                        'size': 16,
                        'sizes': [] 
                    },
                    'description_typography_font_weight': '400',
                    'description_typography_line_height': {
                        'unit': '%',
                        'size': 140,
                        'sizes': []
                    },
                    'description_alignment': 'start',
                    'description_margin': {
                        'top': '0',
                        'right': '0',
                        'bottom': '24',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'category_typography_typography': 'custom',
                    'category_typography_font_family': 'Work Sans',
                    'category_typography_font_size': {
                        'unit': 'px',
                        'size': 14,
                        'sizes': [] 
                    },
                    'category_typography_font_weight': '400',
                    'category_typography_line_height': {
                        'unit': '%',
                        'size': 120,
                        'sizes': []
                    },
                    'category_color': '#FFFFFF',
                    'category_bg_color': '#FFFFFF20',
                    'category_border_border': 'none',
                    'category_border_radius': {
                        'top': '50',
                        'right': '50',
                        'bottom': '50',
                        'left': '50',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'category_padding': {
                        'top': '6',
                        'right': '12',
                        'bottom': '6',
                        'left': '12',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'category_margin': {
                        'top': '0',
                        'right': '0',
                        'bottom': '24',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'read_more_alignment': 'start',
                    'read_more_color': '#fff',
                    'read_more_bg_color': 'transparent',
                    'read_more_icon_color': '#fff',
                    'read_more_border_radius': {
                        'top': '0',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'read_more_padding': {
                        'top': '0',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'read_more_margin': {
                        'top': '0',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                },
            };

            panel.$el.off('change', '[data-setting="preset_styles"]');
            panel.$el.on('change', '[data-setting="preset_styles"]', function() {
                var selectedPreset = $(this).val();
                const allControls = view.model.get('settings').controls || {};

                _.each(allControls, function(control, key) {
                    if (key === 'preset_styles') {
                        view.model.setSetting(key, selectedPreset);
                        return;
                    }

                    if (selectedPreset !== 'default' && PostGridPresetStyles[selectedPreset]) {
                        view.model.setSetting(key, PostGridPresetStyles[selectedPreset][key] ?? control.default);
                    } else if (selectedPreset === 'default') {
                        view.model.setSetting(key, control.default);
                    }
                });
                
                view.model.renderRemoteServer();
                
            });

        });
        elementor.hooks.addAction('panel/open_editor/widget/pea_progress_bar', function(panel, model, view) {
            var ProgressBarPresetStyles = {
                'preset-2': {
                    'progress_bar_height': {
                        'unit': 'px',
                        'size': 20,
                        'sizes': [] // Required for responsive
                    },
                    'progress_bar_border_radius': {
                        'top': '50',
                        'right': '50',
                        'bottom': '50',
                        'left': '50',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'progress_bar_bg_border_radius': {
                        'top': '50',
                        'right': '50',
                        'bottom': '50',
                        'left': '50 ',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'progress_bar_bg_zebra_track_color_enable': 'yes',
                },
                'preset-3': {
                    'progress_number_margin': {
                        'top': '-40',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'progress_number_position': 'with-progressbar',
                    'progress_bar_height': {
                        'unit': 'px',
                        'size': 20,
                        'sizes': [] // Required for responsive
                    },
                    'progress_bar_border_radius': {
                        'top': '50',
                        'right': '50',
                        'bottom': '50',
                        'left': '50',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'progress_bar_bg_border_radius': {
                        'top': '50',
                        'right': '50',
                        'bottom': '50',
                        'left': '50 ',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'progress_bar_zebra_track_color_enable': 'yes',
                    'progress_bar_zebra_track_color': '#F9AF58',
                    'progress_bar_bg_color_background': 'classic',
                    'progress_bar_bg_color_color': 'transparent',
                },
                'preset-4': {
                    'progress_number_position': 'with-progressbar',
                    'layout_type': 'vertical',
                    'alignment': 'center',
                    'progress_percentage': {
                        'unit': '',
                        'size': 90,
                        'sizes': [] // Required for responsive
                    },
                    'progress_bar_width': {
                        'unit': 'px',
                        'size': 50,
                        'sizes': [] // Required for responsive
                    },
                    'progress_bar_height': {
                        'unit': 'px',
                        'size': 400,
                        'sizes': [] // Required for responsive
                    },
                    'progress_bar_zebra_track_color_enable': 'yes',
                    'progress_bar_zebra_track_color': '#8891A5',
                    'progress_bar_bg_color_background': 'classic',
                    'progress_bar_bg_color_color': 'transparent',
                    'progress_bar_border_radius': {
                        'top': '50',
                        'right': '50',
                        'bottom': '50',
                        'left': '50',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'progress_bar_bg_border_radius': {
                        'top': '50',
                        'right': '50',
                        'bottom': '50',
                        'left': '50 ',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'progress_number_margin': {
                        'top': '-20',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'progress_title_margin': {
                        'top': '20',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                },
                'preset-5': {
                    'text_position': 'text-inside',
                    'progress_percentage': {
                        'unit': '',
                        'size': 65,
                        'sizes': [] // Required for responsive
                    },
                    'progress_bar_height': {
                        'unit': 'px',
                        'size': 40,
                        'sizes': [] // Required for responsive
                    },
                    'progress_bar_color_background': 'classic',
                    'progress_bar_color_color': '#70BF73',
                    'progress_bar_border_radius': {
                        'top': '50',
                        'right': '0',
                        'bottom': '0',
                        'left': '50',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'progress_bar_bg_color_background': 'classic',
                    'progress_bar_bg_color_color': '#EEFFEE',
                    'progress_bar_bg_border_radius': {
                        'top': '50',
                        'right': '50',
                        'bottom': '50',
                        'left': '50',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'progress_number_typography_typography': 'custom',
                    'progress_number_typography_font_size': {
                        'unit': 'px',
                        'size': 16,
                        'sizes': [] 
                    },
                    'progress_number_margin': {
                        'top': '0',
                        'right': '20',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'progress_title_typography_typography': 'custom',
                    'progress_title_typography_font_size': {
                        'unit': 'px',
                        'size': 16,
                        'sizes': [] 
                    },
                    'progress_title_color': '#fff',
                    'progress_title_margin': {
                        'top': '0',
                        'right': '0',
                        'bottom': '0',
                        'left': '20',
                        'unit': 'px',
                        'isLinked': true
                    },
                },
                'preset-6': {
                    'text_position': 'text-inside',
                    'progress_percentage': {
                        'unit': '',
                        'size': 65,
                        'sizes': [] // Required for responsive
                    },
                    'progress_bar_height': {
                        'unit': 'px',
                        'size': 40,
                        'sizes': [] // Required for responsive
                    },
                    'progress_wrapper_bg_color_background': 'classic',
                    'progress_wrapper_bg_color_color': 'transparent',
                    'progress_wrapper_border_border': 'solid',
                    'progress_wrapper_border_width': {
                        'top': '2',
                        'right': '2',
                        'bottom': '2',
                        'left': '2',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'progress_wrapper_border_color': '#FFF6F7',
                    'progress_wrapper_border_radius': {
                        'top': '100',
                        'right': '100',
                        'bottom': '100',
                        'left': '100',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'progress_wrapper_padding': {
                        'top': '5',
                        'right': '5',
                        'bottom': '5',
                        'left': '5',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'progress_bar_color_background': 'classic',
                    'progress_bar_color_color': '#E95B68',
                    'progress_bar_border_radius': {
                        'top': '50',
                        'right': '50',
                        'bottom': '50',
                        'left': '50',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'progress_bar_bg_color_background': 'classic',
                    'progress_bar_bg_color_color': '#FFF6F7',
                    'progress_bar_bg_border_radius': {
                        'top': '50',
                        'right': '50',
                        'bottom': '50',
                        'left': '50',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'progress_number_typography_typography': 'custom',
                    'progress_number_typography_font_size': {
                        'unit': 'px',
                        'size': 16,
                        'sizes': [] 
                    },
                    'progress_number_margin': {
                        'top': '0',
                        'right': '20',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'progress_title_typography_typography': 'custom',
                    'progress_title_typography_font_size': {
                        'unit': 'px',
                        'size': 16,
                        'sizes': [] 
                    },
                    'progress_title_color': '#fff',
                    'progress_title_margin': {
                        'top': '0',
                        'right': '0',
                        'bottom': '0',
                        'left': '20',
                        'unit': 'px',
                        'isLinked': true
                    },
                },
                'preset-7': {
                    'progress_percentage': {
                        'unit': '',
                        'size': 90,
                        'sizes': [] // Required for responsive
                    },
                    'progress_bar_color_background': 'gradient',
                    'progress_bar_color_color': '#9239FF',
                    'progress_bar_color_color_stop': {
                        'unit': '%',
                        'size': 0,
                        'sizes': [] // Required for responsive
                    },
                    'progress_bar_color_color_b': '#FF8F56',
                    'progress_bar_color_color_b_stop': {
                        'unit': '%',
                        'size': 100,
                        'sizes': [] // Required for responsive
                    },
                    'progress_bar_color_gradient_angle': {
                        'unit': 'deg',
                        'size': 90,
                        'sizes': [] // Required for responsive
                    },
                    'progress_bar_bg_color_background': 'classic',
                    'progress_bar_bg_color_color': '#F7F7F7',
                },
            };

            panel.$el.off('change', '[data-setting="preset_styles"]');
            panel.$el.on('change', '[data-setting="preset_styles"]', function() {
                var selectedPreset = $(this).val();
                const allControls = view.model.get('settings').controls || {};

                _.each(allControls, function(control, key) {
                    if (key === 'preset_styles') {
                        view.model.setSetting(key, selectedPreset);
                        return;
                    }

                    if (selectedPreset !== 'default' && ProgressBarPresetStyles[selectedPreset]) {
                        view.model.setSetting(key, ProgressBarPresetStyles[selectedPreset][key] ?? control.default);
                    } else if (selectedPreset === 'default') {
                        view.model.setSetting(key, control.default);
                    }
                });
                
                view.model.renderRemoteServer();
                
            });
        });

        elementor.hooks.addAction('panel/open_editor/widget/pea_advanced_accordion', function (panel, model, view) {

            const settingsModel   = view.model.get('settings');
            const itemsCollection = settingsModel.get('accordion_items');

            //--------------------------------------------------------------------
            // Utility: Change element tag
            //--------------------------------------------------------------------
            function changeTag($element, newTag) {
                const $newEl = jQuery('<' + newTag + '/>', {
                    class: $element.attr('class'),
                    html: $element.html(),
                });
                $element.replaceWith($newEl);
                return $newEl;
            }

            function updateNewItemTag() {
                const tag = settingsModel.get('accordion_item_title_tag') || 'h3';

                view.$el.find('.pea-accordion-title').each(function() {
                    const $el = jQuery(this);
                    const currentTag = $el.prop("tagName").toLowerCase();

                    if (currentTag !== tag.toLowerCase()) {
                        changeTag($el, tag);
                    }
                });
            }

            //--------------------------------------------------------------------
            // Recalculate accordion-index for all items
            //--------------------------------------------------------------------
            function recalculateAccordionIndices() {
                const $widget = view.$el;
                
                $widget.find('.pea-advanced-accordion-item').each(function(index) {
                    const $item = jQuery(this);
                    const newIndex = index + 1;
                    
                    // Update the accordion-index attribute
                    $item.attr('accordion-index', newIndex);

                    // Clean up duplicate classes
                    const classes = $item.attr('class').split(/\s+/);
                    const uniqueClasses = [...new Set(classes)];
                    $item.attr('class', uniqueClasses.join(' '));
                });
            }

            //--------------------------------------------------------------------
            // Update Single Title
            //--------------------------------------------------------------------
            function updatePreviewTitle(itemModel) {
                const index   = itemsCollection.indexOf(itemModel);
                const title   = itemModel.get('accordion_title');
                const tag     = settingsModel.get('accordion_item_title_tag') || 'h3';
                const $widget = view.$el;

                const $item = $widget.find('.pea-advanced-accordion-item[accordion-index="' + (index + 1) + '"]');
                let $titleEl = $item.find('.pea-accordion-title');
                if (!$titleEl.length) return;

                const currentTag = $titleEl.prop("tagName");

                if (currentTag && currentTag.toLowerCase() !== tag.toLowerCase()) {
                    $titleEl = changeTag($titleEl, tag);
                }

                $titleEl.text(title);
            }

            //--------------------------------------------------------------------
            // ICON HANDLING (CORE SYSTEM)
            //--------------------------------------------------------------------

            /** Remove all icons inside widget */
            function removeIcons($widget) {
                $widget.find('.pea-accordion-tab-icon, .pea-accordion-expanded-icon').remove();
            }

            /** Build OPEN icon/image */
            function buildOpenIcon() {
                const openType = settingsModel.get('accordion_open_choose_icon_or_img');
                const $icon = jQuery('<div class="pea-accordion-tab-icon"></div>');

                if (openType === 'icon') {
                    const iconSetting = settingsModel.get('accordion_open_item_icon');
                    const iconObj = elementor.helpers.renderIcon(view, iconSetting, {'aria-hidden': true}, 'i', 'object');
                    if (iconObj?.rendered) $icon.html(iconObj.value);

                } else if (openType === 'image') {
                    const img = settingsModel.get('accordion_open_image');
                    const url = img?.url || '';
                    $icon.html('<img src="' + url + '">');
                }

                return $icon;
            }

            /** Build CLOSE icon/image */
            function buildCloseIcon() {
                const closeType = settingsModel.get('accordion_close_choose_icon_or_img');
                const $icon = jQuery('<div class="pea-accordion-expanded-icon"></div>');

                if (closeType === 'icon') {
                    const iconSetting = settingsModel.get('accordion_close_item_icon');
                    const iconObj = elementor.helpers.renderIcon(view, iconSetting, {'aria-hidden': true}, 'i', 'object');
                    if (iconObj?.rendered) $icon.html(iconObj.value);

                } else if (closeType === 'image') {
                    const img = settingsModel.get('accordion_close_image');
                    const url = img?.url || '';
                    $icon.html('<img src="' + url + '">');
                }

                return $icon;
            }

            /** MAIN: Ensure icon markup exists & updates dynamically */
            function ensureIconsExist() {
                const showIcon = settingsModel.get('show_accordion_icon');
                const $widget = view.$el;

                // If icons disabled → remove
                if (showIcon !== 'yes') {
                    removeIcons($widget);
                    return;
                }

                // Loop through all accordion items
                $widget.find('.pea-advanced-accordion-item').each(function () {
                    const $item = jQuery(this);
                    const $wrapper = $item.find('.pea-accordion-item-title-wrapper');

                    // Always remove old icons and regenerate
                    $item.find('.pea-accordion-tab-icon, .pea-accordion-expanded-icon').remove();

                    // Generate icons fresh
                    const $openIcon = buildOpenIcon();
                    const $closeIcon = buildCloseIcon();

                    // Insert in correct position
                    $wrapper.append($openIcon).append($closeIcon);
                });
            }

            //--------------------------------------------------------------------
            // Visibility only toggles (not recreate)
            //--------------------------------------------------------------------
            function updateIconVisibility() {
                const showIcon = settingsModel.get('show_accordion_icon');
                const $widget  = view.$el;

                if (showIcon !== 'yes') {
                    $widget.find('.pea-accordion-tab-icon, .pea-accordion-expanded-icon').hide();
                } else {
                    $widget.find('.pea-accordion-tab-icon, .pea-accordion-expanded-icon').show();
                }
            }

            //--------------------------------------------------------------------
            // REPEATER ITEM PREFIX/SUFFIX ICON HANDLING
            //--------------------------------------------------------------------

            /** Build PREFIX icon/image for a specific item */
            function buildPrefixIcon(itemModel) {
                const prefixType = itemModel.get('accordion_item_title_prefix_choose_icon_or_img');
                const $icon = jQuery('<div class="pea-accordion-title-prefix"></div>');
                
                if (prefixType === 'icon') {
                    const iconSetting = itemModel.get('accordion_item_title_prefix_item_icon');
                    const iconObj = elementor.helpers.renderIcon(view, iconSetting, {'aria-hidden': true}, 'i', 'object');
                    if (iconObj?.rendered) {
                        $icon.html(iconObj.value);
                    }

                } else if (prefixType === 'image') {
                    const img = itemModel.get('accordion_item_title_prefix_image');
                    const url = img?.url;
                    if (url) {
                        $icon.html('<img src="' + url + '">');
                    }
                }
                
                return $icon;
            }

            /** Build SUFFIX icon/image for a specific item */
            function buildSuffixIcon(itemModel) {
                const suffixType = itemModel.get('accordion_item_title_suffix_choose_icon_or_img');
                const $icon = jQuery('<div class="pea-accordion-title-suffix"></div>');
                
                if (suffixType === 'icon') {
                    const iconSetting = itemModel.get('accordion_item_title_suffix_item_icon');
                    const iconObj = elementor.helpers.renderIcon(view, iconSetting, {'aria-hidden': true}, 'i', 'object');
                    if (iconObj?.rendered) {
                        $icon.html(iconObj.value);
                    }

                } else if (suffixType === 'image') {
                    const img = itemModel.get('accordion_item_title_suffix_image');
                    const url = img?.url;
                    if (url) {
                        $icon.html('<img src="' + url + '">');
                    }
                }
                
                return $icon;
            }

            /** Update prefix/suffix icons for a specific item */
            function updateItemPrefixSuffixIcons(itemModel) {
                const index = itemsCollection.indexOf(itemModel);
                const $widget = view.$el;
                const $item = $widget.find('.pea-advanced-accordion-item[accordion-index="' + (index + 1) + '"]');
                
                if (!$item.length) return;
                
                const $titleInner = $item.find('.pea-accordion-title-inner');
                if (!$titleInner.length) return;
                
                // Remove existing prefix/suffix
                $titleInner.find('.pea-accordion-title-prefix, .pea-accordion-title-suffix').remove();
                
                const prefixType = itemModel.get('accordion_item_title_prefix_choose_icon_or_img');
                const suffixType = itemModel.get('accordion_item_title_suffix_choose_icon_or_img');
                
                // Build and insert prefix before title
                if (prefixType && prefixType !== 'none') {
                    const $prefixIcon = buildPrefixIcon(itemModel);
                    const $titleElement = $titleInner.find('.pea-accordion-title');
                    if ($titleElement.length) {
                        $titleElement.before($prefixIcon);
                    }
                }
                
                // Build and insert suffix after title
                if (suffixType && suffixType !== 'none') {
                    const $suffixIcon = buildSuffixIcon(itemModel);
                    $titleInner.append($suffixIcon);
                }
            }

            /** Ensure all items have correct prefix/suffix icons */
            function ensureAllItemPrefixSuffixIcons() {
                itemsCollection.each(function(itemModel) {
                    updateItemPrefixSuffixIcons(itemModel);
                });
            }

            //--------------------------------------------------------------------
            // ATTACH PREFIX/SUFFIX LISTENERS TO EACH ITEM
            //--------------------------------------------------------------------
            function attachPrefixSuffixListeners(itemModel) {
                // PREFIX controls
                itemModel.off('change:accordion_item_title_prefix_choose_icon_or_img');
                itemModel.on('change:accordion_item_title_prefix_choose_icon_or_img', function() {
                    updateItemPrefixSuffixIcons(itemModel);
                });
                
                itemModel.off('change:accordion_item_title_prefix_item_icon');
                itemModel.on('change:accordion_item_title_prefix_item_icon', function() {
                    updateItemPrefixSuffixIcons(itemModel);
                });
                
                itemModel.off('change:accordion_item_title_prefix_image');
                itemModel.on('change:accordion_item_title_prefix_image', function() {
                    updateItemPrefixSuffixIcons(itemModel);
                });
                
                // SUFFIX controls
                itemModel.off('change:accordion_item_title_suffix_choose_icon_or_img');
                itemModel.on('change:accordion_item_title_suffix_choose_icon_or_img', function() {
                    updateItemPrefixSuffixIcons(itemModel);
                });
                
                itemModel.off('change:accordion_item_title_suffix_item_icon');
                itemModel.on('change:accordion_item_title_suffix_item_icon', function() {
                    updateItemPrefixSuffixIcons(itemModel);
                });
                
                itemModel.off('change:accordion_item_title_suffix_image');
                itemModel.on('change:accordion_item_title_suffix_image', function() {
                    updateItemPrefixSuffixIcons(itemModel);
                });
            }

            //--------------------------------------------------------------------
            // Attach item listeners
            //--------------------------------------------------------------------
            function attachItemListeners(itemModel) {
                itemModel.off('change:accordion_title');
                itemModel.on('change:accordion_title', function () {
                    updatePreviewTitle(itemModel);
                });

                itemModel.off('change:accordion_this_item_margin');
                itemModel.on('change:accordion_this_item_margin', function () {
                    editorRefreshItems();
                });

                itemModel.off('change:accordion_this_item_padding');
                itemModel.on('change:accordion_this_item_padding', function () {
                    editorRefreshItems();
                });

                // Attach prefix/suffix listeners
                attachPrefixSuffixListeners(itemModel);
            }

            function editorRefreshItems() {
                const $widget = view.$el;
                $widget.find('.pea-advanced-accordion-item').each(function () {
                    const $item = jQuery(this);
                    const $title = $item.find('.pea-accordion-item-title-wrapper').first();
                    const $content = $item.find('.pea-accordion-content-wrapper').first();

                    if (!$title.length || !$content.length) return;

                    const isActive = $title.hasClass('active');

                    if (isActive) {
                        setTimeout(() => {
                            $content.css('max-height', $content.prop('scrollHeight') + 'px');
                        }, 500);
                    } else {
                        $content.css('max-height', '0px');
                    }
                });
            }

            //--------------------------------------------------------------------
            // Initialize item listeners
            //--------------------------------------------------------------------
            itemsCollection.each(attachItemListeners);
            itemsCollection.on('add', function (itemModel) {
                attachItemListeners(itemModel);
                setTimeout(() => {
                    recalculateAccordionIndices();      // ← Run this FIRST
                    updateNewItemTag();
                    ensureIconsExist();
                    updateItemPrefixSuffixIcons(itemModel);
                    updatePreviewTitle(itemModel); 
                }, 100);
            });

            itemsCollection.on('remove', function () {
                setTimeout(() => {
                    recalculateAccordionIndices();
                }, 100);
            });
            
            panel.$el.on('sortstop', function () {
                setTimeout(() => {
                    view.render();
                }, 100);
            });

            //--------------------------------------------------------------------
            // INIT RUN
            //--------------------------------------------------------------------
            ensureIconsExist();
            ensureAllItemPrefixSuffixIcons();
            updateIconVisibility();

            //--------------------------------------------------------------------
            // WATCHERS (REACTIVE)
            //--------------------------------------------------------------------

            // Show/Hide state
            settingsModel.on('change:show_accordion_icon', function () {
                ensureIconsExist();
                updateIconVisibility();
            });

            // OPEN icon-related controls
            settingsModel.on('change:accordion_open_choose_icon_or_img', ensureIconsExist);
            settingsModel.on('change:accordion_open_item_icon', ensureIconsExist);
            settingsModel.on('change:accordion_open_image', ensureIconsExist);

            // CLOSE icon-related controls
            settingsModel.on('change:accordion_close_choose_icon_or_img', ensureIconsExist);
            settingsModel.on('change:accordion_close_item_icon', ensureIconsExist);
            settingsModel.on('change:accordion_close_image', ensureIconsExist);

            //--------------------------------------------------------------------
            // Title tag update
            //--------------------------------------------------------------------
            settingsModel.on('change:accordion_item_title_tag', function (model, newTag) {
                if (!newTag) return;

                const $widget = view.$el;
                $widget.find('.pea-accordion-title').each(function () {
                    const $old = jQuery(this);
                    const tag  = $old.prop('tagName');
                    if (tag.toLowerCase() !== newTag.toLowerCase()) {
                        changeTag($old, newTag);
                    }
                });
            });

        });

        elementor.hooks.addAction('panel/open_editor/widget/pea_icon_box', function(panel, model, view) {
            
            var iconBoxPresetStyles = {
                'preset-2': {
                    'media_position': 'row',
                    'card_alignment': 'start',
                    'vertical_position': 'start',
                    'title_alignment': 'start',
                    'description_alignment': 'start',
                    'title_text': 'User-Friendly Design',
                    'box_icon': {
                        'value': 'fas fa-swatchbook',
                        'library': 'fa-solid'
                    },
                    'button_alignment': 'start',
                    'show_button': 'yes',
                    'show_button_icon': 'yes',
                    'icon_box_bg_color_background': 'classic',
                    'icon_box_bg_color_color': '#FFFFFF',
                    'icon_box_hover_bg_color_background': 'classic',
                    'icon_box_hover_bg_color_color': '',
                    'icon_box_border_border': 'solid',
                    'icon_box_border_width': {
                        'top': '1',
                        'right': '1',
                        'bottom': '1',
                        'left': '1',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'icon_box_border_color': '#D7EBFF',
                    'icon_box_border_radius': {
                        'top': '0',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'icon_box_padding': {
                        'top': '32',
                        'right': '32',
                        'bottom': '32',
                        'left': '32',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'image_n_icon_color': '#399CFF',
                    'image_n_icon_hover_color': '',
                    'image_n_icon_bg_color_background': 'classic',
                    'image_n_icon_bg_color_color': 'transparent',
                    'image_n_icon_hover_bg_color_background': 'classic',
                    'image_n_icon_hover_bg_color_color': 'transparent',
                    'box_icon_size': {
                        'unit': 'px',
                        'size': 48,
                        'sizes': [] 
                    },
                    'image_n_icon_padding': {
                        'top': '0',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'image_n_icon_margin': {
                        'top': '0',
                        'right': '24',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'title_color': '#15171C',
                    'title_margin': {
                        'top': '0',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'description_color': '#555E72',
                    'description_margin': {
                        'top': '0',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'button_color': '#15171C',
                    'button_hover_color': '#15171C',
                    'button_icon_color': '#15171C',
                    'button_icon_hover_color': '#15171C',
                    'button_margin': {
                        'top': '0',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'button_icon_size': {
                        'unit': 'px',
                        'size': 16,
                        'sizes': [] 
                    },
                },
                'preset-3': {
                    'title_text': 'Customizable Template',
                    'box_icon': {
                        'value': 'fas fa-layer-group',
                        'library': 'fa-solid'
                    },
                    'button_alignment': 'center',
                    'show_button': 'yes',
                    'show_button_icon': 'yes',
                    'icon_box_bg_color_background': 'classic',
                    'icon_box_bg_color_color': '#fff',
                    'icon_box_hover_bg_color_background': 'classic',
                    'icon_box_hover_bg_color_color': '#FFFBF5',
                    'icon_box_border_border': 'solid',
                    'icon_box_border_width': {
                        'top': '1',
                        'right': '1',
                        'bottom': '1',
                        'left': '1',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'icon_box_border_color': '#FFFBF5',
                    'icon_box_border_radius': {
                        'top': '6',
                        'right': '6',
                        'bottom': '6',
                        'left': '6',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'icon_box_padding': {
                        'top': '24',
                        'right': '12',
                        'bottom': '24',
                        'left': '12',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'image_n_icon_color': '#fff',
                    'image_n_icon_bg_color_background': 'classic',
                    'image_n_icon_bg_color_color': '#F89B2E',
                    'image_n_icon_hover_bg_color_background': 'classic',
                    'image_n_icon_hover_bg_color_color': '',
                    'box_icon_size': {
                        'unit': 'px',
                        'size': 24,
                        'sizes': [] 
                    },
                    'image_n_icon_border_radius': {
                        'top': '14',
                        'right': '14',
                        'bottom': '14',
                        'left': '14',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'image_n_icon_padding': {
                        'top': '22',
                        'right': '22',
                        'bottom': '22',
                        'left': '22',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'image_n_icon_margin': {
                        'top': '-64',
                        'right': '12',
                        'bottom': '32',
                        'left': '12',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'title_color': '#15171C',
                    'title_hover_color': '#15171C',
                    'title_margin': {
                        'top': '0',
                        'right': '0',
                        'bottom': '14',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'description_color': '#555E72',
                    'description_hover_color': '#555E72',
                    'description_margin': {
                        'top': '0',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'button_color': '#F89B2E',
                    'button_hover_color': '#F89B2E',
                    'button_icon_color': '#F89B2E',
                    'button_icon_hover_color': '#F89B2E',
                    'button_margin': {
                        'top': '0',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'button_icon_size': {
                        'unit': 'px',
                        'size': 16,
                        'sizes': [] 
                    },
                },
                'preset-4': {
                    'title_alignment': 'start',
                    'description_alignment': 'start',
                    'title_text': 'Responsive Layout',
                    'media_alignment': 'start',
                    'box_icon': {
                        'value': 'fas fa-dice-d20',
                        'library': 'fa-solid'
                    },
                    'button_alignment': 'start',
                    'show_button': 'yes',
                    'show_button_icon': 'yes',
                    'icon_box_bg_color_background': 'classic',
                    'icon_box_bg_color_color': '#fff',
                    'icon_box_hover_bg_color_background': 'classic',
                    'icon_box_hover_bg_color_color': '#fff',
                    'icon_box_border_border': 'solid',
                    'icon_box_border_width': {
                        'top': '1',
                        'right': '1',
                        'bottom': '1',
                        'left': '1',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'icon_box_border_color': '#F67C87',
                    'icon_box_border_radius': {
                        'top': '24',
                        'right': '24',
                        'bottom': '24',
                        'left': '24',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'icon_box_padding': {
                        'top': '32',
                        'right': '32',
                        'bottom': '32',
                        'left': '32',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'image_n_icon_color': '#fff',
                    'image_n_icon_hover_color': '',
                    'image_n_icon_bg_color_background': 'gradient',
                    'image_n_icon_bg_color_color': '#F67C87',
                    'image_n_icon_bg_color_color_stop': {
                        'unit': '%',
                        'size': 0,
                        'sizes': [] // Required for responsive
                    },
                    'image_n_icon_bg_color_color_b': '#B9087B',
                    'image_n_icon_bg_color_color_b_stop': {
                        'unit': '%',
                        'size': 100,
                        'sizes': [] // Required for responsive
                    },
                    'image_n_icon_bg_color_gradient_angle': {
                        'unit': 'deg',
                        'size': 270,
                        'sizes': [] // Required for responsive
                    },
                    'image_n_icon_hover_bg_color_background': 'classic',
                    'image_n_icon_hover_bg_color_color': 'transparent',
                    'image_n_icon_box_shadow_box_shadow_type': 'yes',
                    "image_n_icon_box_shadow_box_shadow": {
                        "horizontal": 0,
                        "vertical": 15,
                        "blur": 30,
                        "spread": 0,
                        "color": "#9031CF66"
                    },
                    'image_n_icon_hover_bg_color_gradient_angle': {
                        'unit': 'deg',
                        'size': 270,
                        'sizes': [] // Required for responsive
                    },
                    'box_icon_size': {
                        'unit': 'px',
                        'size': 28,
                        'sizes': [] 
                    },
                    'image_n_icon_border_radius_custom': '70% 30% 30% 70% / 60% 40% 60% 40%',
                    'image_n_icon_border_radius': {
                        'top': '',
                        'right': '',
                        'bottom': '',
                        'left': '',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'image_n_icon_padding': {
                        'top': '18',
                        'right': '18',
                        'bottom': '18',
                        'left': '18',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'image_n_icon_margin': {
                        'top': '0',
                        'right': '0',
                        'bottom': '32',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'title_color': '#15171C',
                    'title_hover_color': '#15171C',
                    'title_margin': {
                        'top': '0',
                        'right': '0',
                        'bottom': '14',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'description_color': '#555E72',
                    'description_hover_color': '#555E72',
                    'description_padding': {
                        'top': '0',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'description_margin': {
                        'top': '0',
                        'right': '0',
                        'bottom': '30',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'button_color': '#E43242',
                    'button_hover_color': '#E43242',
                    'button_icon_color': '#E43242',
                    'button_icon_hover_color': '#E43242',
                    'button_margin': {
                        'top': '0',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                },
                'preset-5': {
                    'title_alignment': 'start',
                    'description_alignment': 'start',
                    'media_alignment': 'start',
                    'title_text': 'Secure Data Protection',
                    'box_icon': {
                        'value': 'fas fa-shield-alt',
                        'library': 'fa-solid'
                    },
                    'show_button': 'yes',
                    'show_button_icon': 'yes',
                    'button_alignment': 'start',
                    'icon_box_bg_color_background': 'classic',
                    'icon_box_bg_color_color': '#F7F7F7',
                    'icon_box_hover_bg_color_background': 'classic',
                    'icon_box_hover_bg_color_color': '#15171C',
                    'icon_box_border_border': 'solid',
                    'icon_box_border_width': {
                        'top': '2',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'icon_box_border_color': '#15171C',
                    'icon_box_border_radius': {
                        'top': '0',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'icon_box_padding': {
                        'top': '24',
                        'right': '24',
                        'bottom': '24',
                        'left': '24',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'image_n_icon_color': '#fff',
                    'image_n_icon_hover_color': '#15171C',
                    'image_n_icon_bg_color_background': 'classic',
                    'image_n_icon_bg_color_color': '#15171C',
                    'image_n_icon_hover_bg_color_background': 'classic',
                    'image_n_icon_hover_bg_color_color': '#fff',
                    'box_icon_size': {
                        'unit': 'px',
                        'size': 29,
                        'sizes': [] 
                    },
                    'image_n_icon_border_radius': {
                        'top': '30',
                        'right': '30',
                        'bottom': '30',
                        'left': '30',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'image_n_icon_padding': {
                        'top': '20',
                        'right': '20',
                        'bottom': '20',
                        'left': '20',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'image_n_icon_margin': {
                        'top': '0',
                        'right': '0',
                        'bottom': '32',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'title_color': '#15171C',
                    'title_hover_color': '#fff',
                    'title_margin': {
                        'top': '0',
                        'right': '0',
                        'bottom': '14',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'description_color': '#555E72',
                    'description_hover_color': '#fff',
                    'description_padding': {
                        'top': '0',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'description_margin': {
                        'top': '0',
                        'right': '0',
                        'bottom': '30',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                    'button_color': '#15171C',
                    'button_hover_color': '#fff',
                    'button_icon_color': '#15171C',
                    'button_icon_hover_color': '#fff',
                    'button_margin': {
                        'top': '0',
                        'right': '0',
                        'bottom': '0',
                        'left': '0',
                        'unit': 'px',
                        'isLinked': true
                    },
                },
            };
            
            panel.$el.off('change', '[data-setting="preset_styles"]');
            panel.$el.on('change', '[data-setting="preset_styles"]', function() {
                var selectedPreset = $(this).val();
                const allControls = view.model.get('settings').controls || {};

                _.each(allControls, function(control, key) {
                    if (key === 'preset_styles') {
                        view.model.setSetting(key, selectedPreset);
                        return;
                    }

                    if (selectedPreset !== 'default' && iconBoxPresetStyles[selectedPreset]) {
                        view.model.setSetting(key, iconBoxPresetStyles[selectedPreset][key] ?? control.default);
                    } else if (selectedPreset === 'default') {
                        view.model.setSetting(key, control.default);
                    }
                });
                
                view.model.renderRemoteServer();
            });

        });

        elementor.hooks.addAction('panel/open_editor/widget/pea_advanced_tabs', function (panel, model, view) {

            const settingsModel   = view.model.get('settings');
            const itemsCollection = settingsModel.get('tabs_items');

            
            panel.$el.on('sortstop', function () {
                setTimeout(() => {
                    view.render();
                }, 100);
            });

        });



        // view.model.get('settings').on('click:author_include_ids', function(settingsModel, value) {
        //     console.log('yes click author include');
        // });
        // elementor.hooks.addAction('panel/open_editor/widget/pea_feature_list', function(panel, model, view) {
        //     // Watch the settings attribute
        //     view.model.get('settings').on('change:feature_item_icon_position', function(settingsModel, value) {
        //         if(value === 'pea-icon-position-right'){
        //             view.model.setSetting('back_button_border_radius', {
        //                 top: '0',
        //                 right: '0',
        //                 bottom: '0',
        //                 left: '20',
        //                 unit: 'px',
        //                 isLinked: true
        //             });
        //         }
        //     });

        // });
    });

})(jQuery);