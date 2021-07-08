import $ from 'jquery';
import 'select2';
import 'select2/dist/css/select2.css';

jQuery(function(){
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
                console.log(page);
                // categoryProductSearch(page)
            }

            return false;
        })
    }

    addSearchBookPageNavigationClickFunc();
});