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
});