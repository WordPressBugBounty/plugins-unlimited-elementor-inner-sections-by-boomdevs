(function ($) {
    'use strict';

    var resetTimerKey = 'peaProductGridResetTimer';

    function setButtonText($button, key) {
        var text = $button.data(key);

        if (text) {
            $button.text(text);
        }
    }

    function clearResetTimer($button) {
        var timer = $button.data(resetTimerKey);

        if (timer) {
            clearTimeout(timer);
            $button.removeData(resetTimerKey);
        }
    }

    function getProductButton($button) {
        if ($button && $button.length && $button.hasClass('pea-product-grid-cart-button')) {
            return $button;
        }

        return $();
    }

    function updateCartSidebar(res) {
        if (!res || !res.success || !res.data) {
            return;
        }

        $('#pea-cart-sidebar-items').html(res.data.cart_html);
        $('#pea-cart-subtotal').html(res.data.cart_subtotal);
        $('.pea-cart-count').text(res.data.cart_count);
        $(document.body).trigger('wc_fragments_refreshed');
    }

    function refreshCartSidebar() {
        if (typeof window.peaCartData === 'undefined') {
            return;
        }

        $('#pea-cart-sidebar-items').html('<div class="pea-cart-loading"><span class="pea-cart-spinner"></span></div>');

        $.ajax({
            url: window.peaCartData.ajaxUrl,
            method: 'POST',
            data: {
                action: 'pea_get_cart_sidebar',
                nonce: window.peaCartData.nonce
            },
            success: updateCartSidebar
        });
    }

    function openCartSidebar() {
        var $sidebar = $('#pea-cart-sidebar');
        var $overlay = $('#pea-cart-sidebar-overlay');

        $(document.body).trigger('pea_open_cart_sidebar');
        $(document.body).trigger('pea:open-cart-sidebar');

        if (!$sidebar.length) {
            $('.pea-cart-toggle, .pea-cart-sidebar-toggle, [data-pea-cart-sidebar-open]').first().trigger('click');
            return;
        }

        $sidebar.addClass('is-open');
        $overlay.addClass('is-active');
        $('body').css('overflow', 'hidden');
        refreshCartSidebar();
    }

    function ensureQuickView() {
        if ($('#pea-quick-view-modal').length) {
            return;
        }

        $('body').append(
            '<div id="pea-quick-view-overlay" class="pea-quick-view-overlay"></div>' +
            '<div id="pea-quick-view-modal" class="pea-quick-view-modal" role="dialog" aria-modal="true">' +
                '<button id="pea-quick-view-close" class="pea-quick-view-modal__close" type="button" aria-label="Close">×</button>' +
                '<div id="pea-quick-view-inner" class="pea-quick-view-modal__inner"></div>' +
            '</div>'
        );
    }

    function closeQuickView() {
        $('#pea-quick-view-overlay, #pea-quick-view-modal').removeClass('is-active');
        $('body').css('overflow', '');
    }

    function openQuickView(productId) {
        if (!productId || typeof window.PeaProductGrid === 'undefined') {
            return;
        }

        ensureQuickView();
        $('#pea-quick-view-inner').html('<div class="pea-quick-view-loading">' + window.PeaProductGrid.i18n.loading + '</div>');
        $('#pea-quick-view-overlay, #pea-quick-view-modal').addClass('is-active');
        $('body').css('overflow', 'hidden');

        $.ajax({
            url: window.PeaProductGrid.ajaxUrl,
            method: 'POST',
            data: {
                action: 'pea_product_quick_view',
                nonce: window.PeaProductGrid.nonce,
                product_id: productId
            },
            success: function (res) {
                if (res && res.success && res.data && res.data.html) {
                    $('#pea-quick-view-inner').html(res.data.html);
                }
            }
        });
    }

    $(document.body)
        .on('click', '.pea-product-grid-cart-button.ajax_add_to_cart', function () {
            var $button = $(this);

            clearResetTimer($button);
            setButtonText($button, 'pea-processing-text');
        })
        .on('adding_to_cart', function (event, $button) {
            $button = getProductButton($button);

            if (!$button.length) {
                return;
            }

            clearResetTimer($button);
            setButtonText($button, 'pea-processing-text');
        })
        .on('added_to_cart', function (event, fragments, cartHash, $button) {
            $button = getProductButton($button);

            if (!$button.length) {
                return;
            }

            setButtonText($button, 'pea-added-text');
            $button.siblings('.added_to_cart').remove();
            openCartSidebar();

            $button.data(resetTimerKey, setTimeout(function () {
                setButtonText($button, 'pea-default-text');
                $button.removeClass('added');
                $button.removeData(resetTimerKey);
            }, 2200));
        });

    $(document)
        .on('click', '.pea-product-grid-quick-view', function (event) {
            event.preventDefault();
            event.stopPropagation();
            openQuickView($(this).data('product-id'));
        })
        .on('click', '#pea-quick-view-close, #pea-quick-view-overlay', closeQuickView)
        .on('keydown', function (event) {
            if (event.key === 'Escape') {
                closeQuickView();
            }
        });
})(jQuery);
