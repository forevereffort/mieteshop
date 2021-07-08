import $ from 'jquery';
import 'select2';
import 'select2/dist/css/select2.css';

jQuery(function(){

    function goSearchBookResultTop(){
        $('html, body').animate({
            scrollTop: jQuery('#js-search-book__results-section').offset().top
        }, 1000)
    }

    // get products with term, author, publisher and page
    function searchBook(page){
        const filterTermId = jQuery('#js-search-book__product-category-list').val();
        const filterAuthorId = jQuery('#js-search-book__author-list').val();
        const filterPublisherId = jQuery('#js-search-book__publisher-list').val();
        const productPerPage = jQuery('#js-search-book__per-page').val();
        const nonce = jQuery('#js-search-book__results-section').attr('data-nonce');

        jQuery('#js-search-book__load-spinner').removeClass('hide');

        jQuery.ajax({
            type: 'get',
            dataType: 'json',
            url: window.MieteshopData.ajaxurl,
            data: {
                action: 'filter_search_book',
                nonce,
                filterTermId,
                filterAuthorId,
                filterPublisherId,
                page,
                productPerPage
            },
            success: function (response) {
                jQuery('#js-search-book__results-row').html(response.result);
                jQuery('#js-search-book__results-count').html(response.count);
                jQuery('#js-search-book__results-navigation').html(response.navigation);

                // add page navigation click event into new added nav html
                addSearchBookPageNavigationClickFunc();

                jQuery('#js-search-book__load-spinner').addClass('hide')

                // smoth go to the top of result section
                goSearchBookResultTop();
            }
        })
    }

    $('#js-search-book__product-category-list').select2({
        placeholder: "Θεματικές",
        allowClear: true
    });

    $('#js-search-book__author-list').select2({
        placeholder: "Συγγραφείς",
        allowClear: true
    });

    $('#js-search-book__publisher-list').select2({
        placeholder: "Εκδότες",
        allowClear: true
    });

    // page navigation click
    function addSearchBookPageNavigationClickFunc(){
        jQuery('.js-search-book__results-navigation-item a').on('click', function(){

            // check this is current page
            if( !jQuery(this).parent().hasClass('active') ){
                const page = jQuery(this).attr('data-page');
                
                searchBook(page)
            }

            return false;
        })
    }

    addSearchBookPageNavigationClickFunc();
});