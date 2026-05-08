(function ($) {

    var ueisHooksRegistered = false;

    /**
     * Register hooks once Elementor's hook bus is available.
     * Idempotent: safe to call multiple times.
     */
    function registerUeisHooks() {
        if (ueisHooksRegistered) {
            return;
        }

        if (!window.elementor || !elementor.hooks || typeof elementor.hooks.addFilter !== 'function') {
            return;
        }

        // Keep prototype extension for column (legacy section/column structure).
        elementor.hooks.addFilter('element/view', function (groups_prototype, element) {
            if (element.get('elType') === 'column') {
                return groups_prototype.extend({
                    getContextMenuGroups: function () {
                        return groups_prototype.prototype.getContextMenuGroups.apply(this, arguments);
                    }
                });
            }
            return groups_prototype;
        });

        elementor.hooks.addFilter('elements/column/contextMenuGroups', addItemToColumnContextMenu);
        elementor.hooks.addFilter('elements/container/contextMenuGroups', addItemToContainerContextMenu);

        ueisHooksRegistered = true;
    }

    // Hook timing strategy: try every common entry point so at least one fires.
    $(document).ready(function () {
        registerUeisHooks();
    });

    $(window).on('elementor:init', function () {
        registerUeisHooks();
    });

    $(window).on('elementor/init', function () {
        registerUeisHooks();
    });

    var pollAttempts = 0;
    var pollTimer = setInterval(function () {
        pollAttempts++;
        if (ueisHooksRegistered || pollAttempts > 40) {
            clearInterval(pollTimer);
            return;
        }
        if (window.elementor && elementor.hooks) {
            registerUeisHooks();
        }
    }, 250);

    /**
     * Insert an action into the first matching group, or create a new group
     * after the "general" group if none of the candidate groups exist.
     */
    function insertActionIntoGroups(groups, candidateGroupNames, action, fallbackGroupName) {
        for (var i = 0; i < candidateGroupNames.length; i++) {
            var name = candidateGroupNames[i];
            var idx = -1;
            for (var j = 0; j < groups.length; j++) {
                if (groups[j].name === name) {
                    idx = j;
                    break;
                }
            }
            if (idx !== -1) {
                groups[idx].actions.push(action);
                return groups;
            }
        }

        var generalIdx = -1;
        for (var k = 0; k < groups.length; k++) {
            if (groups[k].name === 'general') {
                generalIdx = k;
                break;
            }
        }
        var insertAt = generalIdx === -1 ? groups.length : generalIdx + 1;
        groups.splice(insertAt, 0, {
            name: fallbackGroupName,
            actions: [action]
        });

        return groups;
    }

    /**
     * Insert an action right after a known action inside candidate groups.
     * Falls back to appending into a candidate group (or fallback group creation).
     */
    function insertActionAfterKnownAction(groups, candidateGroupNames, action, fallbackGroupName, anchorActionNames, anchorTitleText) {
        for (var i = 0; i < candidateGroupNames.length; i++) {
            var groupName = candidateGroupNames[i];
            var group = null;
            for (var g = 0; g < groups.length; g++) {
                if (groups[g].name === groupName) {
                    group = groups[g];
                    break;
                }
            }
            if (!group || !group.actions || !group.actions.length) {
                continue;
            }

            var anchorIdx = -1;
            for (var a = 0; a < group.actions.length; a++) {
                var actionName = String(group.actions[a].name || '');
                var actionTitle = String(group.actions[a].title || '').toLowerCase();
                var isNameMatch = anchorActionNames.indexOf(actionName) !== -1;
                var isTitleMatch = anchorTitleText && actionTitle.indexOf(anchorTitleText.toLowerCase()) !== -1;

                if (isNameMatch || isTitleMatch) {
                    anchorIdx = a;
                    break;
                }
            }

            if (anchorIdx !== -1) {
                group.actions.splice(anchorIdx + 1, 0, action);
                return groups;
            }
        }

        return insertActionIntoGroups(groups, candidateGroupNames, action, fallbackGroupName);
    }

    /**
     * Adds "Add Nested Section" item to a column's context menu.
     */
    function addItemToColumnContextMenu(groups, element) {
        var action = {
            name: 'euis-add-nested-section',
            title: 'Add Nested Section',
            icon: 'eicon-clone',
            callback: function () {
                insertNestedSection(element);
            },
            isEnabled: function () { return true; }
        };

        // Intentionally avoid "addNew" so this doesn't appear in the (+) quick-add menu.
        // We only want it in the element handle context menu (left side).
        return insertActionIntoGroups(groups, ['general'], action, 'euis-nested-section-group');
    }

    /**
     * Adds "Add Nested Container" item to a container's context menu.
     */
    function addItemToContainerContextMenu(groups, element) {
        var action = {
            name: 'euis-add-nested-container',
            title: 'Add Nested Container',
            icon: 'eicon-section',
            callback: function () {
                insertNestedContainer(element);
            },
            isEnabled: function () { return true; }
        };

        return insertActionAfterKnownAction(
            groups,
            ['newContainerGroup', 'general'],
            action,
            'euis-nested-container-group',
            ['addNewContainer', 'add-new-container', 'addContainer', 'add_container'],
            'add new container'
        );
    }

    /**
     * Inserts a new inner section inside the parent column (legacy API).
     */
    function insertNestedSection(element) {
        var element_view = element.getContainer().view;
        if (element_view.getElementType() !== 'column') {
            return;
        }
        element_view.addElement({
            elType: 'section',
            isInner: true,
            settings: {},
            elements: [{
                id: elementor.helpers.getUniqueID(),
                elType: 'column',
                isInner: true,
                settings: { _column_size: 100 },
                elements: []
            }]
        });
    }

    /**
     * Inserts a new container as a direct child of the parent container.
     */
    function insertNestedContainer(element) {
        if (!window.$e || typeof $e.run !== 'function') {
            return;
        }
        var parentContainer = element.getContainer();
        if (!parentContainer || !parentContainer.model || parentContainer.model.get('elType') !== 'container') {
            return;
        }
        $e.run('document/elements/create', {
            container: parentContainer,
            model: {
                elType: 'container',
                settings: { content_width: 'full' }
            }
        });
    }

})(jQuery);
