import { fromEvent } from 'rxjs';
import { debounceTime, distinctUntilChanged, map, filter } from 'rxjs/operators';

jQuery(function(){
    // header top search input keyup event
    const headerTopSearchInputElem = document.getElementById('js-header-top-search-form-text');
    fromEvent(headerTopSearchInputElem, 'keyup').pipe(
        map(event => event.target.value),
        map(value => value.trim()),
        filter(value => value.length > 3), 
        debounceTime(1000),
        distinctUntilChanged()
    ).subscribe(() => {
        const searchKey = headerTopSearchInputElem.value;

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

            }
        })
    });
})