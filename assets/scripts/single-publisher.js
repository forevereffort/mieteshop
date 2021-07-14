jQuery(function(){
    // get products with publisher and page
    function singlePublisherProductSearch(page){
        const filterPublisherId = jQuery('#js-single-publisher-product-row').attr('data-publisher-id');
        const nonce = jQuery('#js-single-publisher-product-row').attr('data-nonce');
        const productPerPage = jQuery('#js-single-publisher-product-row').attr('data-product-per-page');

        jQuery('#js-single-publisher-product-filter-load-spinner').removeClass('hide');

        jQuery.ajax({
            type: 'get',
            dataType: 'json',
            url: window.MieteshopData.ajaxurl,
            data: {
                action: 'filter_single_publisher_product',
                nonce,
                filterPublisherId,
                page,
                productPerPage
            },
            success: function (response) {
                jQuery('#js-single-publisher-product-row').html(response.result);
                jQuery('#js-single-publisher-product-navigation').html(response.navigation);

                // add page navigation click event into new added nav html
                addPageNavigationClickOfSPProductFunc();

                jQuery('#js-single-publisher-product-filter-load-spinner').addClass('hide')
            }
        })
    }
    
    // page navigation click
    function addPageNavigationClickOfSPProductFunc(){
        jQuery('.js-sp-product-navigation-item a').on('click', function(){

            // check this is current page
            if( !jQuery(this).parent().hasClass('active') ){
                const page = jQuery(this).attr('data-page');

                singlePublisherProductSearch(page)
            }

            return false;
        })
    }

    addPageNavigationClickOfSPProductFunc();
})