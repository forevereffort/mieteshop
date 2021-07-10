jQuery(function(){
    function searchArchivePublisher(){
        const firstLetters = [];
        const publisherTypeList = [];
        const nonce = jQuery('#js-archive-publisher-search-result-list').attr('data-nonce');

        jQuery('.js-archive-publisher-search-greek-letter-col.active').each(function(){
            firstLetters.push(jQuery(this).text());
        })

        jQuery('.js-archive-publisher-search-english-letter-col.active').each(function(){
            firstLetters.push(jQuery(this).text());
        })

        jQuery('.js-archive-publisher-search-type-col:checked').each(function(){
            publisherTypeList.push(jQuery(this).val());
        })

        jQuery('#js-archive-publisher__load-spinner').removeClass('hide');

        jQuery.ajax({
            type: 'get',
            dataType: 'json',
            url: window.MieteshopData.ajaxurl,
            data: {
                action: 'filter_search_archive_publisher',
                nonce,
                firstLetters,
                publisherTypeList
            },
            success: function (response) {
                jQuery('#js-archive-publisher-search-result-list').html(response.result);

                jQuery('#js-archive-publisher__load-spinner').addClass('hide')
            }
        })
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