import { fromEvent } from 'rxjs';
import { debounceTime } from 'rxjs/operators';

jQuery(function(){
    // header top search input keyup event
    const headerTopSearchInputElem = document.getElementById('js-header-top-search-form-text');
    fromEvent(headerTopSearchInputElem, 'keyup').pipe(debounceTime(1000)).subscribe(() => {
        const searchKey = headerTopSearchInputElem.value;

        console.log(searchKey)
    });
})