import { fromEvent } from 'rxjs';
import { debounceTime } from 'rxjs/operators';

window.beforeHeaderTopSearch = '';

jQuery(function(){
    // header top search input keyup event
    const headerTopSearchInputElem = document.getElementById('js-header-top-search-form-text');
    fromEvent(headerTopSearchInputElem, 'keyup').pipe(debounceTime(1000)).subscribe(() => {
        const searchKey = headerTopSearchInputElem.value;

        if( searchKey !== '' && window.beforeHeaderTopSearch !== searchKey ){
            jQuery('#js-header-top-search-form').addClass('searching');
            const nonce = jQuery(headerTopSearchInputElem).attr('data-nonce');

            jQuery.ajax({
                type: 'get',
                dataType: 'json',
                url: window.MieteshopData.ajaxurl,
                data: {
                    action: 'header_top_search',
                    nonce,
                    searchKey
                },
                success: function (response) {
                    jQuery('#js-header-top-search-result-group-wrapper').html(response.result);
                    jQuery('#js-header-top-search-form').removeClass('searching');

                    window.beforeHeaderTopSearch = searchKey;
                }
            })
        }
    });
})