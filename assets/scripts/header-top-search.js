import { fromEvent } from 'rxjs';
import { debounceTime } from 'rxjs/operators';

jQuery(function(){
    // header top search input keyup event
    const headerTopSearchInputElem = document.getElementById('js-header-top-search-form-text');
    fromEvent(headerTopSearchInputElem, 'keyup').pipe(debounceTime(1000)).subscribe(() => {
        const searchKey = headerTopSearchInputElem.value;

        if( searchKey !== '' ){
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
                    jQuery('#js-header-top-search-result-group-list').html(response.result);
                    console.log(response)
                }
            })
        }
    });
})