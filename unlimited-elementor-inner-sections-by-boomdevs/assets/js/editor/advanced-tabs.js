!(function () {
    "use strict";
    var React = window.React;
    
    jQuery(function ($) {
        let isElementTypeRegistered = false;
        
        const registerAdvancedTabsElement = () => {
            if (isElementTypeRegistered) {
                return true;
            }
            
            const nestedElementsComponent = 
                ($e?.components?.get?.("nested-elements/nested-repeater") || 
                 $e?.components?.get?.("nested-elements"))?.exports || null;
            
            if (!nestedElementsComponent) {
                return false;
            }
            
            const NestedViewBase = nestedElementsComponent.NestedViewBase || nestedElementsComponent.NestedView;
            const NestedModelBase = nestedElementsComponent.NestedRepeaterModel || nestedElementsComponent.NestedModelBase;
            
            class AdvancedTabsView extends NestedViewBase {
                /**
                 * Called when view is initialized
                 */
                initialize() {
                    super.initialize();
                    
                    // Listen to collection changes (add/remove)
                    this.listenTo(this.collection, 'remove', this.onCollectionChange);
                    
                    // Listen to settings changes
                    this.listenTo(this.model.get('settings'), 'change:tabs_items', this.onTabsItemsChange);
                    
                }
                
                filter(element, index) {
                    if (typeof element?.set === "function") {
                        element.set("dataIndex", index + 1);
                    } else if (element?.attributes) {
                        element.attributes.dataIndex = index + 1;
                    }
                    return true;
                }
                
                /**
                 * Called when a child view is added
                 */
                onAddChild(childView) {
                    this.updateTabTitles();
                }
                
                /**
                 * Called when a child view is removed
                 */
                onRemoveChild(childView) {
                    this.updateTabTitles();
                }
                
                /**
                 * Called when collection changes (add/remove)
                 */
                onCollectionChange() {
                    this.updateTabTitles();
                }
                
                /**
                 * Called when tabs_items setting changes
                 */
                onTabsItemsChange() {
                    this.updateTabTitles();
                }
                
                /**
                 * Called when view is rendered
                 */
                onRender() {
                    super.onRender();
                    this.updateTabTitles();
                }
                
                /**
                 * Updates tab titles in the panel based on current items
                 */
                updateTabTitles() {
                    setTimeout(() => {
                        const $tabsPanel = this.$el.find('.pea-tabs-panel').first();
                        if (!$tabsPanel.length) return;
                        
                        // Clear existing tabs
                        $tabsPanel.empty();
                        
                        const settings = this.model.get('settings').toJSON();
                        const tabsItems = settings.tabs_items || [];
                        const elementUid = this.model.id;
                        const orientation = settings.tabs_orientation || 'horizontal';
                        const defaultActive = parseInt(settings.default_active_tab) || 0;
                        const showIcon = settings.show_icon_or_image === 'yes';
                        const showTitle = settings.show_title === 'yes';
                        const showDescription = settings.show_description === 'yes';
                        const titleTag = settings.tab_title_tag || 'span';
                        const descTag = settings.tab_desc_tag || 'p';
                        
                        // If no tabs, don't render anything
                        if (tabsItems.length === 0) return;
                        
                        // Rebuild tab titles
                        tabsItems.forEach((tab, index) => {
                            const tabCount = index + 1;
                            const tabTitleId = 'pea-tabs-tab-' + elementUid + '-' + tabCount;
                            const tabContentId = 'pea-tabs-body-' + elementUid;
                            const isActive = (tabCount === defaultActive) ? 'pea-tabs-active' : '';
                            const ariaSelected = (tabCount === defaultActive) ? 'true' : 'false';
                            const tabindex = (tabCount === defaultActive) ? '0' : '-1';
                            const tabId = tab.element_css_id || tabTitleId;
                            
                            const $tabItem = $('<li/>', {
                                'class': 'pea-tab ' + isActive + ' ' + orientation,
                                'role': 'tab',
                                'id': tabId,
                                'aria-selected': ariaSelected,
                                'aria-controls': tabContentId,
                                'tabindex': tabindex,
                                'data-tab': tabCount,
                                'aria-label': tab.tab_title || 'Tab ' + (tabCount + 1)
                            });
                            
                            // Add description if enabled
                            if (showDescription && tab.tab_desc && (settings.icon_position === 'column-reverse' || settings.icon_position === 'row-reverse')) {
                                const $tabDesc = $('<' + descTag + '/>', {
                                    'class': 'pea-tab-description',
                                    'text': tab.tab_desc || ''
                                });
                                $tabItem.append($tabDesc);
                            }
                            
                            // Add title if enabled
                            if (showTitle) {
                                const $tabTitle = $('<' + titleTag + '/>', {
                                    'class': 'pea-tab-title',
                                    'text': tab.tab_title || 'Tab ' + (tabCount + 1)
                                });
                                $tabItem.append($tabTitle);
                            }
                            
                            // Add description if enabled
                            if (showDescription && tab.tab_desc && (settings.icon_position === 'column' || settings.icon_position === 'row')) {
                                const $tabDesc = $('<' + descTag + '/>', {
                                    'class': 'pea-tab-description',
                                    'text': tab.tab_desc || ''
                                });
                                $tabItem.append($tabDesc);
                            }
                            
                            // Add icon or image if enabled
                            if (showIcon && tab.tab_choose_icon_or_img !== 'none') {
                                const $iconBox = $('<div/>', { 'class': 'pea-tab-icon-image-box' });
                                
                                if (tab.tab_choose_icon_or_img === 'icon' && tab.tab_icon) {
                                    // Render icon
                                    const iconHTML = elementor.helpers.renderIcon(this, tab.tab_icon, { 'aria-hidden': true }, 'i', 'object');
                                    if (iconHTML && iconHTML.rendered) {
                                        const $iconDiv = $('<div/>', { 'class': 'pea-tab-icon' });
                                        $iconDiv.html(iconHTML.value);
                                        $iconBox.append($iconDiv);
                                    }
                                } else if (tab.tab_choose_icon_or_img === 'image' && tab.tab_image && tab.tab_image.url) {
                                    // Render image
                                    const $imageDiv = $('<div/>', { 'class': 'pea-tab-icon-image' });
                                    const $img = $('<img/>', {
                                        'src': tab.tab_image.url,
                                        'alt': tab.tab_title || ''
                                    });
                                    $imageDiv.append($img);
                                    $iconBox.append($imageDiv);
                                }
                                
                                $tabItem.append($iconBox);
                            }
                            
                            $tabsPanel.append($tabItem);
                        });
                        
                        // Update content wrappers visibility
                        this.updateContentVisibility();
                        
                        // Re-bind click events
                        this.bindTabEvents();
                    }, 100);
                }
                
                /**
                 * Updates content visibility to match current tabs
                 */
                updateContentVisibility() {
                    const settings = this.model.get('settings').toJSON();
                    const defaultActive = parseInt(settings.default_active_tab) || 0;
                    
                    this.$el.find('.pea-tabs-body-container').each(function(index) {
                        $(this).css('display', index === defaultActive ? 'block' : 'none');
                    });
                }
                
                /**
                 * Bind click events to tab titles
                 */
                bindTabEvents() {
                    const $tabs = this.$el.find('.pea-tab');
                    $tabs.off('click.advancedTabs').on('click.advancedTabs', function() {
                        const $this = $(this);
                        const tabIndex = $this.data('tab');
                        const $wrapper = $this.closest('.pea-tabs-wrap');
                        
                        // Update active states
                        $wrapper.find('.pea-tab').removeClass('pea-tabs-active').attr('aria-selected', 'false').attr('tabindex', '-1');
                        $this.addClass('pea-tabs-active').attr('aria-selected', 'true').attr('tabindex', '0');
                        
                        // Show corresponding content
                        $wrapper.find('.pea-tabs-body-container').hide();
                        $wrapper.find('.pea-inner-tab-' + tabIndex).show();
                    });
                }
            }
            
            function createEmptyView() {
                return React.createElement(
                    "div",
                    { className: "elementor-first-add" },
                    React.createElement("div", {
                        className: "elementor-icon eicon-plus",
                        onClick: () => $e.route("panel/elements/categories"),
                    })
                );
            }
            
            class AdvancedTabsElementType extends elementor.modules.elements.types.Base {
                getType() {
                    return "pea_advanced_tabs";
                }
                
                getView() {
                    return AdvancedTabsView;
                }
                
                getEmptyView() {
                    return createEmptyView;
                }
                
                getModel() {
                    return NestedModelBase;
                }
                
                getInitialConfig() {
                    return {
                        ...super.getInitialConfig(),
                        defaults: {
                            repeater_title_setting: "tab_title"
                        }
                    };
                }
            }
            
            elementor.elementsManager.registerElementType(new AdvancedTabsElementType());
            isElementTypeRegistered = true;
            
            return true;
        };
        
        elementorCommon.elements.$window.on("elementor/init-components", async () => {
            try {
                await elementor.modules.nestedElements;
            } catch (error) {}
            registerAdvancedTabsElement();
        });
        
        registerAdvancedTabsElement();
        
        const $window = elementorCommon?.elements?.$window;
        if ($window) {
            $window
                .off("elementor/nested-element-type-loaded.pea")
                .one("elementor/nested-element-type-loaded.pea", registerAdvancedTabsElement);
        }
        
        const registrationInterval = setInterval(() => {
            if (registerAdvancedTabsElement()) {
                clearInterval(registrationInterval);
            }
        }, 50);
    });
})();
