jQuery(function(){
    function searchArchivePublisher(){
        const greekLetters = [];
        const englishLetters = [];
        const publisherTypeList = [];

        jQuery('.js-archive-publisher-search-greek-letter-col.active').each(function(){
            greekLetters.push(jQuery(this).text());
        })

        jQuery('.js-archive-publisher-search-english-letter-col.active').each(function(){
            englishLetters.push(jQuery(this).text());
        })

        jQuery('.js-archive-publisher-search-type-col:checked').each(function(){
            publisherTypeList.push(jQuery(this).val());
        })

        jQuery('#js-archive-publisher__load-spinner').removeClass('hide');
    }

    jQuery('.js-archive-publisher-search-greek-letter-col').on('click', function(){
        if( jQuery(this).hasClass('active') ){
            jQuery(this).removeClass('active');
        } else {
            jQuery(this).addClass('active');
        }

        searchArchivePublisher();
    })

    jQuery('.js-archive-publisher-search-english-letter-col').on('click', function(){
        if( jQuery(this).hasClass('active') ){
            jQuery(this).removeClass('active');
        } else {
            jQuery(this).addClass('active');
        }

        searchArchivePublisher();
    })

    jQuery('.js-archive-publisher-search-type-col').on('click', function(){
        searchArchivePublisher();
    })
})