jQuery(function(){
    // get blogs
    function blogResultSearch(page){
        const catId = jQuery('#js-blog-result-row').attr('data-cat-id');
        const nonce = jQuery('#js-blog-result-row').attr('data-nonce');
        const postsPerPage = jQuery('#js-blog-result-row').attr('data-posts-per-page');

        jQuery('#js-blog-filter-load-spinner').removeClass('hide');

        jQuery.ajax({
            type: 'get',
            dataType: 'json',
            url: window.MieteshopData.ajaxurl,
            data: {
                action: 'filter_blog_result',
                nonce,
                catId,
                page,
                postsPerPage
            },
            success: function (response) {
                jQuery('#js-blog-first').html(response.hero);
                jQuery('#js-blog-result-row').html(response.result);
                jQuery('#js-blog-results-navigation').html(response.navigation);

                // add page navigation click event into new added nav html
                addPageNavigationClickOfBlogResultFunc();

                jQuery('#js-blog-filter-load-spinner').addClass('hide')
            }
        })
    }
    
    // page navigation click
    function addPageNavigationClickOfBlogResultFunc(){
        jQuery('.js-blog-result-navigation-item a').on('click', function(){

            // check this is current page
            if( !jQuery(this).parent().hasClass('active') ){
                const page = jQuery(this).attr('data-page');

                blogResultSearch(page)
            }

            return false;
        })
    }

    addPageNavigationClickOfBlogResultFunc();

    jQuery('#js-blog-page-list').on('change', function(){
        const page = jQuery(this).val();

        blogResultSearch(page);
    });
})