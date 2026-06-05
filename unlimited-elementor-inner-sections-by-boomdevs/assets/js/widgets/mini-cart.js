(function ($) {
  "use strict";

  var documentClickBound = false;

  $(window).on("elementor/frontend/init", function () {
    elementorFrontend.hooks.addAction(
      "frontend/element_ready/pea_mini_cart.default",
      MiniCart
    );

    // WooCommerce AJAX Live Updates Handler (Global listener for WooCommerce events)
    $(document.body).on('added_to_cart removed_from_cart wc_fragments_refreshed wc_fragments_loaded', function (event, fragments) {
      if (!fragments) return;

      // Update badge count
      if (fragments['span.pea_mini_cart_badge']) {
        $('.pea_mini_cart_badge').replaceWith(fragments['span.pea_mini_cart_badge']);
      }

      // Update subtotal amount in trigger button
      if (fragments['span.pea_mini_cart_subtotal_amount']) {
        $('.pea_mini_cart_subtotal_amount').replaceWith(fragments['span.pea_mini_cart_subtotal_amount']);
      }

      // Update mini cart content, preserving active state and custom delete button HTML
      if (fragments['div.pea_mini_cart_content_wrapper']) {
        $('.pea_mini_cart_inner_wrapper').each(function () {
          var $inner = $(this);
          var $content = $inner.find('.pea_mini_cart_content_wrapper');
          if ($content.length) {
            var wasActive = $content.hasClass('active');
            var $newContent = $(fragments['div.pea_mini_cart_content_wrapper']).clone();
            
            if (wasActive) {
              $newContent.addClass('active');
            }
            
            $content.replaceWith($newContent);
            
            // Restore custom remove button HTML
            var removeHtml = $inner.data('remove-html');
            if (removeHtml) {
              $newContent.find('.pea_mini_cart_item_remove').html(removeHtml);
            }
          }
        });
      }
    });
  });

  function MiniCart($scope) {
    var $wrapper = $scope.find(".pea_mini_cart_inner_wrapper");
    var $button = $wrapper.find(".pea_mini_cart_button_wrapper");

    if (!$wrapper.length || !$button.length) {
      return;
    }

    // Toggle Button Click Handler
    $button.off("click.peaMiniCart").on("click.peaMiniCart", function (e) {
      e.stopPropagation();
      $wrapper.find(".pea_mini_cart_content_wrapper").toggleClass("active");
    });

    // AJAX remove item click handler
    $wrapper.off("click.peaRemoveItem").on("click.peaRemoveItem", ".pea_mini_cart_item_remove", function (e) {
      e.preventDefault();
      var $removeBtn = $(this);
      var cartItemKey = $removeBtn.attr("data-cart_item_key") || $removeBtn.data("cart_item_key");
      
      if (!cartItemKey) {
        return;
      }

      // Ensure localized settings exist
      var ajaxUrl = typeof wc_add_to_cart_params !== 'undefined' 
        ? wc_add_to_cart_params.wc_ajax_url.toString().replace('%%endpoint%%', 'pea_remove_cart_item') 
        : (typeof PeaMiniCart !== 'undefined' ? PeaMiniCart.ajaxUrl : '/?wc-ajax=pea_remove_cart_item');
      var nonce = typeof PeaMiniCart !== 'undefined' ? PeaMiniCart.nonce : '';

      if (!ajaxUrl) {
        // Fallback redirect if parameters aren't localized
        window.location.href = $removeBtn.attr('href');
        return;
      }

      // Add visual feedback (fade out item)
      $removeBtn.closest('.pea_mini_cart_item').css('opacity', '0.5');

      $.ajax({
        url: ajaxUrl,
        type: "POST",
        data: {
          action: "pea_remove_cart_item",
          nonce: nonce,
          cart_item_key: cartItemKey
        },
        success: function (response) {
          if (response && response.fragments) {
            $(document.body).trigger('removed_from_cart', [response.fragments, response.cart_hash, $removeBtn]);
          } else {
            // Fallback redirect
            window.location.href = $removeBtn.attr('href');
          }
        },
        error: function () {
          // Fallback redirect
          window.location.href = $removeBtn.attr('href');
        }
      });
    });

    // Document click handler (close dropdown when clicking outside)
    if (!documentClickBound) {
      $(document).on("click.peaMiniCart", function (e) {
        if (!$(e.target).closest(".pea_mini_cart_inner_wrapper").length) {
          $(".pea_mini_cart_content_wrapper").removeClass("active");
        }
      });

      documentClickBound = true;
    }
  }

  // Intercept standard Add to Cart forms (e.g. single product page form.cart)
  $(document).on('submit', 'form.cart', function (e) {
    var $form = $(this);
    
    // Don't intercept if it's an external product or grouped product
    if ($form.parents('.product-type-external').length || $form.parents('.product-type-grouped').length) {
      return;
    }
    
    e.preventDefault();
    
    var $button = $form.find('.single_add_to_cart_button');
    $button.addClass('loading');
    
    // Serialize form data
    var formData = $form.serializeArray();
    
    // Find product_id and variation_id
    var productId = null;
    var variationId = null;
    
    formData.forEach(function (item) {
      if (item.name === 'add-to-cart') {
        productId = item.value;
      } else if (item.name === 'variation_id') {
        variationId = item.value;
      }
    });
    
    // If no add-to-cart in form data, check button value
    if (!productId) {
      productId = $button.val();
    }
    
    if (!productId) {
      $button.removeClass('loading');
      return;
    }
    
    // For variable products, use variation_id as product_id if set
    var targetProductId = (variationId && variationId !== '0' && variationId !== '') ? variationId : productId;
    
    // Ensure product_id is in formData
    var hasProductId = false;
    formData.forEach(function (item) {
      if (item.name === 'product_id') {
        item.value = targetProductId;
        hasProductId = true;
      }
    });
    if (!hasProductId) {
      formData.push({ name: 'product_id', value: targetProductId });
    }
    
    var ajaxUrl = typeof wc_add_to_cart_params !== 'undefined' 
      ? wc_add_to_cart_params.wc_ajax_url.toString().replace('%%endpoint%%', 'add_to_cart') 
      : '/?wc-ajax=add_to_cart';
      
    $.ajax({
      type: 'POST',
      url: ajaxUrl,
      data: $.param(formData),
      success: function (response) {
        if (!response) {
          return;
        }
        
        if (response.error && response.product_url) {
          // Redirect if there's a validation error or checkout redirect
          window.location.href = response.product_url;
          return;
        }
        
        // If redirect option is enabled in WooCommerce, redirect to cart page
        if (typeof wc_add_to_cart_params !== 'undefined' && wc_add_to_cart_params.cart_redirect_after_add === 'yes') {
          window.location.href = wc_add_to_cart_params.cart_url;
          return;
        }
        
        // Otherwise trigger events to update the mini cart
        $(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, $button]);
      },
      error: function () {
        // Fallback: standard submission on AJAX error
        $form.unbind('submit').submit();
      },
      complete: function () {
        $button.removeClass('loading');
      }
    });
  });

})(jQuery);