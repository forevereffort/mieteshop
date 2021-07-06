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
});