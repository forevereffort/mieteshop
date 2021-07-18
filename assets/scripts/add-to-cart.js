jQuery(function(){
    jQuery('.js-mieteshop-add-to-cart').on('click', function(e){
        e.preventDefault();
        
        const product_qty = jQuery(this).attr('data-quantity');
        const product_id = jQuery(this).attr('data-product_id');
        const variation_id = jQuery(this).attr('data-variation_id');
        const product_sku = jQuery(this).attr('data-product_sku');

        jQuery.ajax({
            type: 'post',
            url: wc_add_to_cart_params.ajax_url,
            data: {
                action: 'woocommerce_ajax_add_to_cart',
                product_id,
                product_sku,
                quantity: product_qty,
                variation_id,
            },
            beforeSend: function (response) {
                console.log('beforeSend');
            },
            complete: function (response) {
                console.log('complete');
            },
            success: function (response) {
                console.log('success');
            },
        });

        return false;
    })
})