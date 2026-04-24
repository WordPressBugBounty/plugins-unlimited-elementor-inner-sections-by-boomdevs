jQuery(window).on('elementor:init', function () {

    var ControlSortable = elementor.modules.controls.BaseData.extend({

        onReady: function () {
            this._sortedValues = [];
            this._$select      = this.$el.find('select.sortable-multiselect');
            this._options      = this._extractOptions(this._$select);
            this._build();
        },

        // ─────────────────────────────────────────────────────────────────
        // BUILD  – runs once, sets up the whole custom UI
        // ─────────────────────────────────────────────────────────────────
        _build: function () {
            var self     = this;
            var $select  = this._$select;
            var options  = this._options;
            var initVals = this.getControlValue() || [];

            /* ── DOM skeleton ── */
            var $wrap   = jQuery('<div class="sms-wrap"></div>');
            var $field  = jQuery('<div class="sms-field" tabindex="0"></div>');
            var $tags   = jQuery('<div class="sms-tags"></div>');
            var $arrow  = jQuery('<span class="sms-arrow"><svg viewBox="0 0 10 6" xmlns="http://www.w3.org/2000/svg"><path d="M0 0l5 6 5-6z"/></svg></span>');
            var $drop   = jQuery('<div class="sms-drop"></div>');
            var $search = jQuery('<input class="sms-search" type="text" placeholder="Search options…" autocomplete="off"/>');
            var $list   = jQuery('<ul class="sms-list"></ul>');

            $field.append($tags, $arrow);
            $drop.append($search, $list).hide();
            $wrap.append($field, $drop);
            $select.after($wrap).hide();

            /* Store refs */
            self._$wrap   = $wrap;
            self._$tags   = $tags;
            self._$drop   = $drop;
            self._$search = $search;
            self._$list   = $list;
            self._$field  = $field;
            self._placeholder = self.model.get('placeholder') || 'Select items…';

            /* ── Sortable on tags ──
               distance:4  → must move 4 px before drag begins, kills micro-glitch on click
               helper:clone so original stays in place during drag                          */
            $tags.sortable({
                items:                '.sms-tag',
                tolerance:            'pointer',
                cursor:               'grabbing',
                placeholder:          'sms-tag sms-ph-sort',
                forcePlaceholderSize: true,
                distance:             4,
                helper:               'clone',
                appendTo:             $wrap,
                start: function (e, ui) {
                    /* Match placeholder size exactly to dragged item */
                    ui.placeholder.css({
                        width:   ui.item.outerWidth(true),
                        height:  ui.item.outerHeight(true),
                        display: 'inline-flex'
                    });
                    ui.helper.css({ opacity: 0.75 });
                    $drop.hide();
                    $field.removeClass('sms-open');
                },
                stop: function () {
                    /* Read order straight from DOM – no re-render */
                    self._sortedValues = [];
                    $tags.find('.sms-tag').each(function () {
                        self._sortedValues.push(jQuery(this).data('value').toString());
                    });
                    self._commit();
                }
            });

            /* ── Open / close ── */
            $field.on('click', function (e) {
                if (jQuery(e.target).closest('.sms-tag-x').length) return;
                if (jQuery(e.target).closest('.sms-tag').length && !jQuery(e.target).closest('.sms-tag-x').length) return;
                self._toggleDrop();
            });

            $field.on('keydown', function (e) {
                if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); self._openDrop(); }
                if (e.key === 'Escape') self._closeDrop();
            });

            $search.on('keydown', function (e) {
                if (e.key === 'Escape') self._closeDrop();
            });

            /* ── Search ── */
            $search.on('input', function () {
                self._renderList(jQuery(this).val().trim());
            });

            /* ── Click outside ── */
            jQuery(document).on('mousedown.sms' + self.cid, function (e) {
                if (!$wrap.is(e.target) && $wrap.has(e.target).length === 0) {
                    self._closeDrop();
                }
            });

            /* ── Seed with saved values ── */
            if (initVals && initVals.length) {
                jQuery.each(initVals, function (i, val) {
                    val = val.toString();
                    if (options[val] !== undefined && self._sortedValues.indexOf(val) === -1) {
                        self._sortedValues.push(val);
                        self._appendTag(val, options[val]);
                    }
                });
                $select.val(self._sortedValues); /* silent – no widget refresh on init */
            }

            self._refreshPlaceholder();
        },

        // ─────────────────────────────────────────────────────────────────
        // DROPDOWN  helpers
        // ─────────────────────────────────────────────────────────────────
        _toggleDrop: function () {
            this._$drop.is(':visible') ? this._closeDrop() : this._openDrop();
        },

        _openDrop: function () {
            this._renderList('');
            this._$search.val('');
            this._$drop.show();
            this._$field.addClass('sms-open');
            this._$search.focus();
        },

        _closeDrop: function () {
            this._$drop.hide();
            this._$field.removeClass('sms-open');
        },

        // ─────────────────────────────────────────────────────────────────
        // LIST
        // ─────────────────────────────────────────────────────────────────
        _renderList: function (filter) {
            var self    = this;
            var $list   = this._$list;
            var options = this._options;
            var hasAny  = false;

            $list.empty();

            jQuery.each(options, function (val, label) {
                val = val.toString();
                if (self._sortedValues.indexOf(val) !== -1) return; // skip selected
                if (filter && label.toLowerCase().indexOf(filter.toLowerCase()) === -1) return;

                var $li = jQuery('<li class="sms-item" data-value="' + val + '"></li>').text(label);

                $li.on('mousedown', function (e) {
                    e.preventDefault();
                    self._select(val, label);
                    self._renderList(self._$search.val().trim());
                });

                $list.append($li);
                hasAny = true;
            });

            if (!hasAny) {
                $list.append('<li class="sms-item sms-empty">No options found</li>');
            }
        },

        // ─────────────────────────────────────────────────────────────────
        // SELECT / DESELECT
        // ─────────────────────────────────────────────────────────────────
        _select: function (val, label) {
            val = val.toString();
            if (this._sortedValues.indexOf(val) !== -1) return;
            this._sortedValues.push(val);
            this._appendTag(val, label);
            this._refreshPlaceholder();
            this._commit();
        },

        _deselect: function (val) {
            val = val.toString();
            this._sortedValues = this._sortedValues.filter(function (v) { return v !== val; });
            this._$tags.find('.sms-tag[data-value="' + CSS.escape(val) + '"]').remove();
            this._refreshPlaceholder();
            if (this._$drop.is(':visible')) {
                this._renderList(this._$search.val().trim());
            }
            this._commit();
        },

        // ─────────────────────────────────────────────────────────────────
        // TAG DOM
        // ─────────────────────────────────────────────────────────────────
        _appendTag: function (val, label) {
            var self = this;
            var $tag = jQuery('<span class="sms-tag" data-value="' + val + '"></span>');
            var $lbl = jQuery('<span class="sms-tag-label"></span>').text(label);
            var $x   = jQuery('<button type="button" class="sms-tag-x" title="Remove">&#x2715;</button>');

            $x.on('mousedown', function (e) {
                e.stopPropagation();
                e.preventDefault();
            }).on('click', function (e) {
                e.stopPropagation();
                self._deselect(val);
            });

            $tag.append($lbl, $x);
            this._$tags.append($tag);
        },

        _refreshPlaceholder: function () {
            var $ph = this._$tags.find('.sms-ph');
            if (this._sortedValues.length === 0) {
                if (!$ph.length) {
                    this._$tags.append('<span class="sms-ph">' + this._placeholder + '</span>');
                }
            } else {
                $ph.remove();
            }
        },

        // ─────────────────────────────────────────────────────────────────
        // COMMIT  – update model + trigger widget refresh
        // ─────────────────────────────────────────────────────────────────
        _commit: function () {
            var vals = this._sortedValues.slice(); // clone

            /* Sync the hidden <select> element */
            this._$select.val(vals);

            /*  setValue() updates the Elementor control model which:
                1. marks the panel as "dirty" (unsaved changes indicator)
                2. fires the model's change event
                3. triggers widget re-render in the preview iframe           */
            this.setValue(vals);
        },

        // ─────────────────────────────────────────────────────────────────
        // UTILS
        // ─────────────────────────────────────────────────────────────────
        _extractOptions: function ($select) {
            var opts = {};
            $select.find('option').each(function () {
                var $o = jQuery(this);
                if ($o.val() !== '') {
                    opts[$o.val()] = $o.text().trim();
                }
            });
            return opts;
        },

        // ─────────────────────────────────────────────────────────────────
        // CLEANUP
        // ─────────────────────────────────────────────────────────────────
        onBeforeDestroy: function () {
            jQuery(document).off('mousedown.sms' + this.cid);
            if (this._$tags && this._$tags.hasClass('ui-sortable')) {
                this._$tags.sortable('destroy');
            }
            if (this._$wrap) {
                this._$wrap.remove();
            }
        }
    });

    elementor.addControlView('sortable_multiselect', ControlSortable);
});