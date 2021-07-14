jQuery(function(){
    // get products with series term and page
    function taxonomySeriesProductSearch(page){
        const seriesTermId = jQuery('#js-taxonomy-series-product-row').attr('data-series-term-id');
        const nonce = jQuery('#js-taxonomy-series-product-row').attr('data-nonce');
        const productPerPage = jQuery('#js-taxonomy-series-product-row').attr('data-product-per-page');

        jQuery('#js-ts-product-filter-load-spinner').removeClass('hide');

        jQuery.ajax({
            type: 'get',
            dataType: 'json',
            url: window.MieteshopData.ajaxurl,
            data: {
                action: 'filter_taxonomy_series_product',
                nonce,
                seriesTermId,
                page,
                productPerPage
            },
            success: function (response) {
                jQuery('#js-taxonomy-series-product-row').html(response.result);
                jQuery('#js-taxonomy-series-product-navigation').html(response.navigation);

                // add page navigation click event into new added nav html
                addPageNavigationClickOfTaxonomySeriesFunc();

                jQuery('#js-ts-product-filter-load-spinner').addClass('hide')
            }
        })
    }
    
    // page navigation click
    function addPageNavigationClickOfTaxonomySeriesFunc(){
        jQuery('.js-ts-product-navigation-item a').on('click', function(){

            // check this is current page
            if( !jQuery(this).parent().hasClass('active') ){
                const page = jQuery(this).attr('data-page');

                taxonomySeriesProductSearch(page)
            }

            return false;
        })
    }

    addPageNavigationClickOfTaxonomySeriesFunc();
})