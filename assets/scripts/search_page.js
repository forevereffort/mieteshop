import $ from 'jquery';
import 'select2';
import 'select2/dist/css/select2.css';

jQuery(function(){
    $('#js-search-product-category-list').select2({
        placeholder: "Θεματικές",
        allowClear: true
    });

    $('#js-search-contributor-list').select2({
        placeholder: "Συγγραφείς",
        allowClear: true
    });

    $('#js-search-publisher-list').select2({
        placeholder: "Εκδότες",
        allowClear: true
    });

    jQuery('.js-search-page-filter-item').on('click', function(){
        const searchType = jQuery(this).attr('data-search-type');

        const { protocol, host, pathname } = window.location;
        const fullUrlWithoutParams = `${protocol}//${host}${pathname}`;
        const url = new URL(window.location.href);
        const s = url.searchParams.get("s");

        window.location = `${fullUrlWithoutParams}?s=${s}&search_type=${searchType}`;
    })
});