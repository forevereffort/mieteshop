jQuery(function(){
    jQuery('.js-mieteshop-add-to-cart').on('click', function(e){
        e.preventDefault();
        
        const product_qty = jQuery(this).attr('data-quantity');
        const product_id = jQuery(this).attr('data-product_id');
        const variation_id = jQuery(this).attr('data-variation_id');
        const product_sku = jQuery(this).attr('data-product_sku');

        jQuery.ajax({
            type: 'post',
            dataType: 'json',
            url: wc_add_to_cart_params.ajax_url,
            data: {
                action: 'woocommerce_ajax_add_to_cart',
                product_id,
                product_sku,
                quantity: product_qty,
                variation_id,
            },
            beforeSend: function (response) {
                jQuery('body').append('<div id="js-ajax-add-to-cart-load-spinner" class="load-spinner"></div>');
            },
            complete: function (response) {
                jQuery('#js-ajax-add-to-cart-load-spinner').remove();
            },
            success: function (response) {
                jQuery('#js-header-top-cart-list').html(response.result);
            },
        });

        return false;
    })
})