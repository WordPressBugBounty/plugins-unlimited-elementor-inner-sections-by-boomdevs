(function ($) {
    const lottieButtonInstances = new Map();
    const JSON_FILE_RE = /\.json($|[?#])/i;

    const getLottieRuntime = function () {
        const frontendUtils = window.elementorFrontend?.utils || {};
        const candidates = [
            window.lottie,
            window.bodymovin,
            frontendUtils.lottie,
            frontendUtils.animations?.lottie,
            frontendUtils.animation?.lottie
        ];

        return candidates.find(function (runtime) {
            return runtime?.loadAnimation;
        }) || null;
    };

    const destroyButtonLottie = function (element) {
        const instance = lottieButtonInstances.get(element);

        if (!instance) {
            return;
        }

        instance.destroy?.();
        lottieButtonInstances.delete(element);
    };

    const initButtonLottie = function (scope) {
        const root = scope instanceof Element ? scope : document;

        root.querySelectorAll('.pea-advanced-search-button-lottie').forEach(function (element) {
            destroyButtonLottie(element);

            const path = element.dataset.lottieSrc || '';
            const container = element.querySelector('.pea-advanced-search-button-lottie-player');
            const runtime = getLottieRuntime();

            if (!container || !path || !JSON_FILE_RE.test(path) || !runtime) {
                return;
            }

            const animation = runtime.loadAnimation({
                container: container,
                renderer: 'svg',
                loop: true,
                autoplay: true,
                path: path,
                rendererSettings: {
                    preserveAspectRatio: 'xMidYMid meet',
                    progressiveLoad: true
                }
            });

            animation.addEventListener?.('DOMLoaded', function () {
                const svg = container.querySelector('svg');

                if (svg) {
                    svg.style.width = '100%';
                    svg.style.height = '100%';
                }

                animation.resize?.();
            });

            lottieButtonInstances.set(element, animation);
        });
    };

    jQuery(window).on('elementor/frontend/init', function () {
        const AdvancedSearch = function ($scope, $) {
            if ('undefined' === typeof $scope) {
                return;
            }

            /* ---------------------------
             * Output Helpers
             * --------------------------- */
            const escapeHtml = function (value) {
                return $('<div>').text(value || '').html();
            };

            const escapeRegExp = function (value) {
                return (value || '').replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
            };

            const highlightKeyword = function (value, keyword) {
                if (!value || !keyword) {
                    return escapeHtml(value);
                }

                const regex = new RegExp('(' + escapeRegExp(keyword) + ')', 'ig');

                return escapeHtml(value).replace(regex, '<mark>$1</mark>');
            };

            const formatPostType = function (value) {
                if (!value) {
                    return '';
                }

                return escapeHtml(
                    value
                        .replace(/[_-]+/g, ' ')
                        .replace(/\b\w/g, function (character) {
                            return character.toUpperCase();
                        })
                );
            };

            const monthsLong = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
            const monthsShort = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

            const getMetaSeparatorMarkup = function () {
                const separatorMap = {
                    dot: '<span class="pea-advanced-search-meta-divider" aria-hidden="true"></span>',
                    pipe: '<span class="pea-advanced-search-meta-separator" aria-hidden="true">|</span>',
                    slash: '<span class="pea-advanced-search-meta-separator" aria-hidden="true">/</span>',
                    dash: '<span class="pea-advanced-search-meta-separator" aria-hidden="true">-</span>',
                    text: '<span class="pea-advanced-search-meta-separator" aria-hidden="true">' + escapeHtml(metaSeparatorText) + '</span>',
                    gap: '',
                    none: ''
                };

                return separatorMap[metaSeparator] ?? separatorMap.dot;
            };

            const getResultPaneClass = function () {
                return $response.hasClass('has-result-scroll') ? 'pea-advanced-search-results-pane has-result-scroll' : 'pea-advanced-search-results-pane';
            };

            const formatDateValue = function (value) {
                if (!value) {
                    return '';
                }

                const date = new Date(value);

                if (isNaN(date.getTime())) {
                    return escapeHtml(value);
                }

                const day = date.getDate();
                const monthIndex = date.getMonth();
                const year = date.getFullYear();

                switch (dateFormat) {
                    case 'fullmonthyear':
                    case 'F_j_Y':
                        return escapeHtml(monthsLong[monthIndex] + ' ' + day + ', ' + year);
                    case 'shortmonthyear':
                    case 'M_j_Y':
                        return escapeHtml(monthsShort[monthIndex] + ' ' + day + ', ' + year);
                    case 'daymonthyear':
                    case 'd_M_Y':
                        return escapeHtml(String(day).padStart(2, '0') + ' ' + monthsShort[monthIndex] + ' ' + year);
                    case 'iso':
                    case 'Y_m_d':
                        return escapeHtml(
                            year +
                            '-' +
                            String(monthIndex + 1).padStart(2, '0') +
                            '-' +
                            String(day).padStart(2, '0')
                        );
                    case 'locale':
                    default:
                        return escapeHtml(date.toLocaleDateString());
                }
            };

            const $wrapper = $scope.find('.pea-advanced-search-wrapper');
            const $form = $wrapper.find('.pea-advanced-search-form');
            const $input = $wrapper.find('.pea-advanced-search-input');
            const $clear = $wrapper.find('.pea-advanced-search-clear');
            const $button = $wrapper.find('.pea-advanced-search-button');
            const $response = $wrapper.find('.pea-advanced-search-response');
            const resultsCount = parseInt($wrapper.data('results-count'), 10) || 5;
            const noResultsText = $wrapper.data('no-results-text') || '';
            const errorText = $wrapper.data('error-text') || '';
            const searchUrl = $wrapper.data('search-url') || '';
            const searchRestUrl = $wrapper.data('search-rest-url') || window.PeaAdvancedSearch?.rest_url || '';
            const viewAllText = $wrapper.data('view-all-text') || '';
            const showViewAll = $wrapper.data('show-view-all') === 'yes';
            const showDropdown = $wrapper.data('show-dropdown') !== 'no';
            const metaSeparator = String($wrapper.data('meta-separator') || 'dot').toLowerCase().trim();
            const metaSeparatorText = $wrapper.data('meta-separator-text') || 'Text';
            const metaSeparatorGap = $wrapper.data('meta-separator-gap') || '8px';
            const dateFormat = $wrapper.data('date-format') || 'locale';
            const isFocusExpand = $wrapper.hasClass('appearance-focus-expand');
            const isPresetOne = $wrapper.hasClass('preset-preset-1');
            let debounceTimer = null;
            let abortController = null;
            let collapseTimer = null;
            let selectedIndex = -1;

            if (!$wrapper.length || !$form.length || !$input.length) {
                return;
            }

            initButtonLottie($scope[0]);

            if (!showDropdown || !$response.length) {
                $wrapper.toggleClass('has-value', $.trim($input.val()).length > 0);
                return;
            }

            /* ---------------------------
             * Focus Expand
             * --------------------------- */
            const syncExpandWidth = function () {
                const buttonWidth = $button.outerWidth() || 0;

                if (isPresetOne) {
                    $wrapper.css('--pea-advanced-search-preset-button-width', buttonWidth + 'px');
                }

                if (isFocusExpand) {
                    $wrapper.css(
                        '--pea-advanced-search-expand-width',
                        isPresetOne ? '100%' : 'calc(100% - ' + buttonWidth + 'px - 12px)'
                    );
                }
            };

            const syncClearButton = function () {
                $wrapper.toggleClass('has-value', $.trim($input.val()).length > 0);
            };

            const abortRequest = function () {
                if (abortController) {
                    abortController.abort();
                    abortController = null;
                }
            };

            const activateSearch = function () {
                clearTimeout(collapseTimer);
                $wrapper.removeClass('is-collapsing').addClass('is-active');

                if (isFocusExpand && !$input.is(':focus')) {
                    $input.trigger('focus');
                }
            };

            const closeSearch = function () {
                const hasValue = $.trim($input.val()).length > 0;

                abortRequest();
                clearTimeout(debounceTimer);
                hideResults();
                $button.prop('disabled', false);

                if (isFocusExpand && hasValue) {
                    return;
                }

                if (isFocusExpand && $wrapper.hasClass('is-active')) {
                    clearTimeout(collapseTimer);
                    $wrapper.addClass('is-collapsing');

                    collapseTimer = setTimeout(function () {
                        $wrapper.removeClass('is-active is-collapsing');
                    }, 400);

                    return;
                }

                $wrapper.removeClass('is-active is-collapsing');
            };

            const getItems = function () {
                return $response.find('.pea-search-result-item');
            };

            const updateSelection = function () {
                const $items = getItems();

                $items.removeClass('selected');

                if (selectedIndex < 0 || selectedIndex >= $items.length) {
                    return;
                }

                const $selectedItem = $items.eq(selectedIndex);

                $selectedItem.addClass('selected');

                if ($selectedItem.length && $selectedItem[0].scrollIntoView) {
                    $selectedItem[0].scrollIntoView({ block: 'nearest' });
                }
            };

            /* ---------------------------
             * Dropdown State
             * --------------------------- */
            const hideResults = function () {
                selectedIndex = -1;
                $response.removeClass('is-open is-ready loading').empty();
            };

            const showResults = function (html) {
                $response
                    .removeClass('loading is-ready')
                    .addClass('is-open')
                    .html(html);

                window.requestAnimationFrame(function () {
                    $response.addClass('is-ready');
                });
            };

            const showState = function (content, className) {
                selectedIndex = -1;
                showResults(
                    '<div class="pea-advanced-search-results-shell">' +
                        '<div class="' + getResultPaneClass() + '">' +
                            '<' + className + '>' + content + '</' + className + '>' +
                        '</div>' +
                    '</div>'
                );
            };

            /* ---------------------------
             * Result Markup
             * --------------------------- */
            const renderResults = function (items, keyword) {
                let html = '';
                const resultPaneClass = getResultPaneClass();

                if (items && items.length) {
                    html += '<div class="pea-advanced-search-results-shell">';
                    html += '<div class="' + resultPaneClass + '">';
                    html += '<ul class="pea-advanced-search-results">';

                    $.each(items, function (index, item) {
                        const metaParts = [];

                        if (item.post_type) {
                            metaParts.push('<span class="pea-advanced-search-meta-item pea-advanced-search-meta-type">' + formatPostType(item.post_type) + '</span>');
                        }

                        if (item.date) {
                            metaParts.push('<span class="pea-advanced-search-meta-item pea-advanced-search-meta-date">' + formatDateValue(item.date) + '</span>');
                        }

                        html += '<li class="pea-advanced-search-result-item pea-search-result-item" data-index="' + index + '">';
                        html += '<a class="pea-advanced-search-result-link" href="' + escapeHtml(item.url) + '">';
                        html += '<span class="pea-advanced-search-result-content">';

                        if (item.title) {
                            html += '<span class="pea-advanced-search-result-title">' + highlightKeyword(item.title, keyword) + '</span>';
                        }

                        if (item.excerpt) {
                            html += '<span class="pea-advanced-search-result-excerpt">' + escapeHtml(item.excerpt) + '</span>';
                        }

                        if (metaParts.length) {
                            const isSpacingOnlyMeta = 'none' === metaSeparator || 'gap' === metaSeparator;
                            const metaClassName = isSpacingOnlyMeta ? 'pea-advanced-search-result-meta no-meta-divider' : 'pea-advanced-search-result-meta';
                            const metaStyle = 'gap' === metaSeparator ? ' style="gap: ' + escapeHtml(metaSeparatorGap) + ';"' : '';
                            html += '<span class="' + metaClassName + '"' + metaStyle + '>' + metaParts.join(getMetaSeparatorMarkup()) + '</span>';
                        }

                        html += '</span>';
                        html += '</a>';
                        html += '</li>';
                    });

                    html += '</ul>';
                    html += '</div>';

                    if (showViewAll && viewAllText && searchUrl) {
                        html += '<div class="pea-advanced-search-footer">';
                        html += '<a class="pea-advanced-search-view-all" href="' + escapeHtml(searchUrl + '?s=' + encodeURIComponent(keyword)) + '">';
                        html += escapeHtml(viewAllText);
                        html += '</a>';
                        html += '</div>';
                    }
                    html += '</div>';
                } else if (noResultsText) {
                    showState(escapeHtml(noResultsText), 'p class="pea-advanced-search-message"');
                    return;
                }

                selectedIndex = -1;
                showResults(html);
            };

            /* ---------------------------
             * Loading State
             * --------------------------- */
            const showLoading = function () {
                activateSearch();
                $button.prop('disabled', true);
                $response
                    .removeClass('is-ready')
                    .addClass('is-open loading')
                    .html(
                        '<div class="pea-advanced-search-results-shell">' +
                            '<div class="' + getResultPaneClass() + '">' +
                                '<div class="pea-advanced-search-loading"><svg class="pea-search-spinner" viewBox="0 0 50 50" aria-hidden="true"><circle cx="25" cy="25" r="20"></circle></svg></div>' +
                            '</div>' +
                        '</div>'
                    );
            };

            const fetchResults = function (searchTerm) {
                if (searchTerm.length < 1) {
                    closeSearch();
                    return;
                }

                if (!searchRestUrl) {
                    showState(escapeHtml(errorText || noResultsText), 'p class="pea-advanced-search-message"');
                    return;
                }

                if (abortController) {
                    abortController.abort();
                }

                abortController = new AbortController();

                fetch(searchRestUrl + '?search=' + encodeURIComponent(searchTerm) + '&per_page=' + encodeURIComponent(resultsCount), {
                    method: 'GET',
                    signal: abortController.signal
                })
                    .then(function (response) {
                        return response.json();
                    })
                    .then(function (response) {
                        renderResults(response.items || [], searchTerm);
                    })
                    .catch(function (error) {
                        if (error.name === 'AbortError') {
                            return;
                        }

                        showState(escapeHtml(errorText || noResultsText), 'p class="pea-advanced-search-message"');
                    })
                    .finally(function () {
                        $button.prop('disabled', false);
                        $response.removeClass('loading');
                    });
            };

            /* ---------------------------
             * Live Search
             * --------------------------- */
            const debounceSearch = function () {
                const searchTerm = $.trim($input.val());

                syncClearButton();
                clearTimeout(debounceTimer);

                if (searchTerm.length < 1) {
                    closeSearch();
                    return;
                }

                abortRequest();
                showLoading();

                debounceTimer = setTimeout(function () {
                    fetchResults(searchTerm);
                }, 800);
            };

            $input.on('input', debounceSearch);

            $input.on('focus', function () {
                const searchTerm = $.trim($input.val());

                if (searchTerm.length < 1 || $response.hasClass('is-open')) {
                    return;
                }

                clearTimeout(debounceTimer);
                abortRequest();
                showLoading();
                fetchResults(searchTerm);
            });

            $clear.on('click', function () {
                abortRequest();
                clearTimeout(debounceTimer);
                selectedIndex = -1;
                $button.prop('disabled', false);
                $input.val('').trigger('focus');
                hideResults();
                syncClearButton();
            });

            $form.on('submit', function (e) {
                if ($.trim($input.val()).length < 1) {
                    e.preventDefault();
                    $input.trigger('focus');
                }
            });

            $input.on('keydown', function (e) {
                const $items = getItems();

                if (e.key === 'ArrowDown') {
                    if (!$items.length) {
                        return;
                    }

                    e.preventDefault();
                    selectedIndex = selectedIndex < $items.length - 1 ? selectedIndex + 1 : 0;
                    updateSelection();
                }

                if (e.key === 'ArrowUp') {
                    if (!$items.length) {
                        return;
                    }

                    e.preventDefault();
                    selectedIndex = selectedIndex > 0 ? selectedIndex - 1 : $items.length - 1;
                    updateSelection();
                }

                if (e.key === 'Enter' && selectedIndex > -1 && $items.length) {
                    e.preventDefault();
                    const href = $items.eq(selectedIndex).find('a').attr('href');

                    if (href) {
                        window.location.href = href;
                    }
                }
            });

            $response.on('mouseenter', '.pea-search-result-item', function () {
                selectedIndex = $(this).index();
                updateSelection();
            });

            if (isFocusExpand) {
                $button.on('click', function (e) {
                    if (!$wrapper.hasClass('is-active')) {
                        e.preventDefault();
                        activateSearch();
                        $input.trigger('focus');
                    }
                });

                $wrapper.on('focusin', function () {
                    activateSearch();
                });
            }

            syncExpandWidth();
            syncClearButton();

            $(window).on('resize', syncExpandWidth);

            if ('undefined' !== typeof elementorFrontend && elementorFrontend.isEditMode() && isFocusExpand && isPresetOne && 'undefined' !== typeof MutationObserver) {
                let previousWrapperClassName = $scope[0].className;
                const editorObserver = new MutationObserver(function () {
                    const currentWrapperClassName = $scope[0].className;

                    if (currentWrapperClassName === previousWrapperClassName) {
                        return;
                    }

                    previousWrapperClassName = currentWrapperClassName;
                    clearTimeout(collapseTimer);
                    $wrapper.removeClass('is-active is-collapsing');
                    syncExpandWidth();
                    syncClearButton();
                });

                editorObserver.observe($scope[0], {
                    attributes: true,
                    attributeFilter: ['class']
                });
            }

            document.addEventListener('click', function (e) {
                if (!$wrapper[0].contains(e.target)) {
                    closeSearch();
                }
            });

            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') {
                    closeSearch();
                }
            });
        };

        elementorFrontend.hooks.addAction('frontend/element_ready/pea_advanced_search.default', AdvancedSearch);
    });

    $(window).on('load', function () {
        initButtonLottie(document);
    });
})(jQuery);
