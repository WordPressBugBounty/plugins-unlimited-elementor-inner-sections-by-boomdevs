(function ($) {
    jQuery(window).on('elementor/frontend/init', function () {
        var CountDown = function ($scope, $) {
            if ('undefined' == typeof $scope) { return; }
            
            // Load More Button Click
            $scope.find('.pea_load_more').click(function(e){
                e.preventDefault();
                
                const loadMore = $(this);
                const loadMoreWrapper = loadMore.closest('.pea_load_more_wrapper');
                const container = $scope.find('.pea-post-grid-container');
                const currentPage = parseInt(loadMore.data('current_page'));
                const totalPages = parseInt(loadMore.data('total_pages'));
                const nextPage = currentPage + 1;
                
                if (nextPage > totalPages) {
                    return;
                }

                loadPosts(container, loadMore, nextPage, 'append', function(response) {
                    loadMore.data('current_page', nextPage);
                    loadMoreWrapper.appendTo(container);

                    if (nextPage >= totalPages) {
                        loadMoreWrapper.hide();
                    }
                });
            });

            // Pagination Number Click
            $scope.on('click', '.pea_pagination_number:not(.active)', function(e){
                e.preventDefault();
                
                const paginationNumber = $(this);
                const paginationWrapper = paginationNumber.closest('.pea_pagination_wrapper');
                const page = parseInt(paginationNumber.data('page'));
                const container = $scope.find('.pea-post-grid-container');
                const $pagination = paginationNumber.closest('.pea_pagination');
                
                loadPosts(container, paginationNumber, page, 'replace', function(response) {
                    paginationWrapper.appendTo(container);
                    
                    // Update pagination state with new page numbers
                    updatePaginationState($pagination, response.current_page, response.max_pages);
                    
                    // // Scroll to top
                    // $('html, body').animate({
                    //     scrollTop: container.offset().top - 100
                    // }, 500);
                });
            });

            // Prev/Next Button Click
            $scope.on('click', '.pea_pagination_prev:not(.disabled), .pea_pagination_next:not(.disabled)', function(e){
                e.preventDefault();
                
                const button = $(this);
                const paginationWrapper = button.closest('.pea_pagination_wrapper');
                const page = parseInt(button.data('page'));
                const container = $scope.find('.pea-post-grid-container');
                const $pagination = button.closest('.pea_pagination');
                
                loadPosts(container, button, page, 'replace', function(response) {
                    paginationWrapper.appendTo(container);
                    
                    // Update pagination state with new page numbers
                    updatePaginationState($pagination, response.current_page, response.max_pages);
                    
                    // // Scroll to top
                    // $('html, body').animate({
                    //     scrollTop: container.offset().top - 100
                    // }, 500);
                });
            });
        
            /**
             * Update pagination button states and regenerate page numbers
             */
            function updatePaginationState($pagination, currentPage, totalPages) {
                // console.log('Updating pagination:', currentPage, '/', totalPages);
                
                // Update data attributes
                $pagination.data('current_page', currentPage);
                $pagination.data('total_pages', totalPages);
                
                // Find or create the numbers container
                let $numbersContainer = $pagination.find('.pea_pagination_numbers');
                if ($numbersContainer.length === 0) {
                    // If container doesn't exist, create it
                    $numbersContainer = $('<div class="pea_pagination_numbers"></div>');
                    $pagination.find('.pea_pagination_prev').after($numbersContainer);
                }
                
                // Clear existing page numbers
                $numbersContainer.empty();
                
                // Generate page numbers with ellipsis logic
                const range = 2; // Show 2 pages before and after current
                const startPage = Math.max(1, currentPage - range);
                const endPage = Math.min(totalPages, currentPage + range);
                
                // Show first page if not in range
                if (startPage > 1) {
                    $numbersContainer.append(
                        $('<button class="pea_pagination_number" data-page="1">1</button>')
                    );
                    
                    if (startPage > 2) {
                        $numbersContainer.append('<span class="pea_pagination_dots">...</span>');
                    }
                }
                
                // Show page numbers in range
                for (let i = startPage; i <= endPage; i++) {
                    if (i === currentPage) {
                        $numbersContainer.append(
                            $('<button class="pea_pagination_number active" aria-current="page">' + i + '</button>')
                        );
                    } else {
                        $numbersContainer.append(
                            $('<button class="pea_pagination_number" data-page="' + i + '">' + i + '</button>')
                        );
                    }
                }
                
                // Show last page if not in range
                if (endPage < totalPages) {
                    if (endPage < totalPages - 1) {
                        $numbersContainer.append('<span class="pea_pagination_dots">...</span>');
                    }
                    
                    $numbersContainer.append(
                        $('<button class="pea_pagination_number" data-page="' + totalPages + '">' + totalPages + '</button>')
                    );
                }
                
                // Update prev button
                const $prevBtn = $pagination.find('.pea_pagination_prev');
                if (currentPage > 1) {
                    $prevBtn.removeClass('disabled').attr('data-page', currentPage - 1);
                } else {
                    $prevBtn.addClass('disabled').removeAttr('data-page');
                }
                
                // Update next button
                const $nextBtn = $pagination.find('.pea_pagination_next');
                if (currentPage < totalPages) {
                    $nextBtn.removeClass('disabled').attr('data-page', currentPage + 1);
                } else {
                    $nextBtn.addClass('disabled').removeAttr('data-page');
                }
            }
        
            /**
             * Load posts via AJAX
             */
            function loadPosts($container, $trigger, page, mode, callback) {
                let querySettings, displaySettings, elementSettings;
                
                if (mode === 'append') {
                    const $wrapper = $trigger.closest('.pea_load_more');
                    querySettings = $wrapper.data('query');
                    displaySettings = $wrapper.data('display');
                    elementSettings = {};
                } else {
                    const $pagination = $scope.find('.pea_pagination');
                    querySettings = $pagination.data('query');
                    displaySettings = $pagination.data('display');
                    
                    // Get element settings (for icons, texts, etc.)
                    elementSettings = {
                        type: $pagination.data('type') || 'icon',
                        prev_text: $pagination.data('prev-text') || 'Prev',
                        next_text: $pagination.data('next-text') || 'Next',
                        prev_icon: $pagination.data('prev-icon') || {},
                        next_icon: $pagination.data('next-icon') || {}
                    };
                }
                
                // Show loading state
                $trigger.addClass('loading').prop('disabled', true);
                $trigger.find('.load_more_button_icon').hide();
                $trigger.find('.pea_load_more_outter_wrap').show();
                
                $.ajax({
                    url: PeaAjax.ajax_url,
                    type: 'POST',
                    data: {
                        action: 'pea_load_posts',
                        nonce: PeaAjax.nonce,
                        query_settings: JSON.stringify(querySettings),
                        display_settings: JSON.stringify(displaySettings),
                        element_settings: JSON.stringify(elementSettings),
                        paged: page
                    },
                    success: function(response) {
                        // console.log(response);
                        if (response.success) {
                            if (mode === 'append') {
                                $container.append(response.data.html);
                            } else {
                                $container.html(response.data.html);
                            }
                            
                            if (typeof callback === 'function') {
                                callback(response.data);
                            }
                        } else {
                            console.error('Failed to load posts:', response);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', error);
                    },
                    complete: function() {
                        $trigger.removeClass('loading').prop('disabled', false);
                        $trigger.find('.load_more_button_icon').show();
                        $trigger.find('.pea_load_more_outter_wrap').hide();
                    }
                });
            }
        }
        
        elementorFrontend.hooks.addAction('frontend/element_ready/pea_post_grid.default', CountDown);
    });
})(jQuery);
