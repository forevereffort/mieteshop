jQuery(function(){
    function searchArchiveContributor(){
        const firstLetters = [];
        const nonce = jQuery('#js-archive-contributor-search-result-list').attr('data-nonce');

        jQuery('.js-archive-contributor-search-greek-letter-col.active').each(function(){
            firstLetters.push(jQuery(this).text());
        })

        jQuery('.js-archive-contributor-search-english-letter-col.active').each(function(){
            firstLetters.push(jQuery(this).text());
        })

        jQuery('#js-archive-contributor__load-spinner').removeClass('hide');

        jQuery.ajax({
            type: 'get',
            dataType: 'json',
            url: window.MieteshopData.ajaxurl,
            data: {
                action: 'filter_search_archive_contributor',
                nonce,
                firstLetters,
            },
            success: function (response) {
                jQuery('#js-archive-contributor-search-result-list').html(response.result);
                jQuery('#js-archive-contributor-search-result-count').html(response.count);

                jQuery('#js-archive-contributor__load-spinner').addClass('hide')
            }
        })
    }

    jQuery('.js-archive-contributor-search-greek-letter-col').on('click', function(){
        let changed = false;

        if( jQuery(this).hasClass('active') ){
            if( jQuery('.archive-contributor-search-greek-letter-row .active').length + jQuery('.archive-contributor-search-english-letter-row .active').length > 1 ){
                jQuery(this).removeClass('active');
                changed = true;
            }
        } else {
            changed = true;
            jQuery(this).addClass('active');
        }

        if( changed ){
            searchArchiveContributor();
        }
    })

    jQuery('.js-archive-contributor-search-english-letter-col').on('click', function(){
        let changed = false;

        if( jQuery(this).hasClass('active') ){
            if( jQuery('.archive-contributor-search-greek-letter-row .active').length + jQuery('.archive-contributor-search-english-letter-row .active').length > 1 ){
                jQuery(this).removeClass('active');
                changed = true;
            }
        } else {
            jQuery(this).addClass('active');
            changed = true;
        }

        if( changed ){
            searchArchiveContributor();
        }
    })
})