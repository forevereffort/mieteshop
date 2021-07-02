import $ from 'jquery';
import 'select2';
import 'select2/dist/css/select2.css';

jQuery(function(){

    function categoryProductSearch(){
        const filterTermIds = jQuery('#js-pcat-filter-detail-row').attr('data-filter-term-list');
        const filterAuthorId = jQuery('#js-pcat-author-list').val();
        const filterPublisherId = jQuery('#js-pcat-publisher-list').val();
        const nonce = jQuery('#js-pcat-filter-detail-row').attr('data-nonce')

        jQuery('#js-category-product-filter-load-spinner').removeClass('hide')

        jQuery.ajax({
            type: 'get',
            dataType: 'json',
            url: window.MieteshopData.ajaxurl,
            data: {
                action: 'filter_category_product',
                nonce,
                filterTermIds,
                filterAuthorId,
                filterPublisherId,
            },
            success: function (response) {
                jQuery('#js-pcat-results-row').html(response.result);
                jQuery('#js-pcat-results-count').html(response.count);

                jQuery('#js-category-product-filter-load-spinner').addClass('hide')
            }
        })
    }

    $('#js-pcat-author-list').select2({
        placeholder: " Συγγραφείς",
        allowClear: true
    }).on('change', function(){
        categoryProductSearch();
    });

    $('#js-pcat-publisher-list').select2({
        placeholder: "Εκδότες",
        allowClear: true
    }).on('change', function(){
        categoryProductSearch();
    });

    function updateFilterCountLabel(){
        // check filter params
        let filterTermIds = [];

        // check parent filter active
        jQuery('.js-pcat-filter-detail-parent.active').each(function(index, elem){
            const termId = jQuery(elem).attr('data-term-id');

            filterTermIds.push(termId);
        });

        jQuery('.js-pcat-filter-detail-child.active').each(function(index, elem){
            const $parentElem = jQuery(elem).parent();

            // if the parent category was activated, ignore this child cat in search param
            if( !jQuery('.js-pcat-filter-detail-parent', $parentElem).hasClass('active') ){
                const termId = jQuery(elem).attr('data-term-id');

                filterTermIds.push(termId);
            }
        });

        jQuery('#js-pcat-filter-detail-row').attr('data-filter-term-list', filterTermIds.join(','))
        categoryProductSearch();

        const filterCount = jQuery('#js-pcat-extra-thematic-filter-row .pcat-extra-thematic-filter-col').length;

        if( filterCount === 0 ){
            // if there is nothing in filter, remove filter tags section
            jQuery('#js-pcat-extra-thematic-filter').addClass('hide');
        } else {
            jQuery('#js-pcat-extra-thematic-filter').removeClass('hide');
            jQuery('#js-pcat-extra-thematic-filter-title span').text(filterCount);
        }
    }
    
    jQuery('.js-pcat-filter-detail-parent').on('click', function(){
        const termID = jQuery(this).attr('data-term-id')
        const $parentElem = jQuery(this).parent();

        if( jQuery(this).hasClass('active') ){
            jQuery('.pcat-filter-detail-child', $parentElem).removeClass('disable');
            jQuery(this).removeClass('active')
            jQuery(`#js-pcat-extra-thematic-filter-col-${termID}`).remove();
        } else {
            jQuery('.pcat-filter-detail-child', $parentElem).addClass('disable');
            const labelName = jQuery(this).text()

            jQuery(this).addClass('active')

            const $newElem = jQuery(`
                <div id="js-pcat-extra-thematic-filter-col-${termID}" class="pcat-extra-thematic-filter-col">
                    <div class="pcat-extra-thematic-filter-item">${labelName}<span data-term-id="${termID}"></span></div>
                </div>
            `);

            // add close button event
            jQuery('span', $newElem).on('click', function(){
                const termID = jQuery(this).attr('data-term-id');

                jQuery(`#js-pcat-extra-thematic-filter-col-${termID}`).remove();
                jQuery('.js-pcat-filter-detail-parent[data-term-id=' + termID + ']').removeClass('active');
                jQuery('.pcat-filter-detail-child', jQuery('.js-pcat-filter-detail-parent[data-term-id=' + termID + ']').parent()).removeClass('disable');

                updateFilterCountLabel();
            })

            jQuery('#js-pcat-extra-thematic-filter-row').append($newElem);
        }

        updateFilterCountLabel();
    });

    jQuery('.js-pcat-filter-detail-child').on('click', function(){
        if( !jQuery(this).hasClass('disable') ){
            const termID = jQuery(this).attr('data-term-id')

            if( jQuery(this).hasClass('active') ){
                jQuery(this).removeClass('active')
                jQuery(`#js-pcat-extra-thematic-filter-col-${termID}`).remove();
            } else {
                const labelName = jQuery(this).text()

                jQuery(this).addClass('active')

                const $newElem = jQuery(`
                    <div id="js-pcat-extra-thematic-filter-col-${termID}" class="pcat-extra-thematic-filter-col">
                        <div class="pcat-extra-thematic-filter-item">${labelName}<span data-term-id="${termID}"></span></div>
                    </div>
                `);

                // add close button event
                jQuery('span', $newElem).on('click', function(){
                    const termID = jQuery(this).attr('data-term-id');

                    jQuery(`#js-pcat-extra-thematic-filter-col-${termID}`).remove();
                    jQuery('.js-pcat-filter-detail-child[data-term-id=' + termID + ']').removeClass('active');

                    updateFilterCountLabel();
                })

                jQuery('#js-pcat-extra-thematic-filter-row').append($newElem);
            }

            updateFilterCountLabel();
        }
    })

    // the thematic filter clear all button click
    jQuery('#js-pcat-extra-thematic-filter-link-clear').on('click', function(){
        jQuery('#js-pcat-extra-thematic-filter-row').html('');
        jQuery('.js-pcat-filter-detail-child').removeClass('active disable');
        jQuery('.js-pcat-filter-detail-parent').removeClass('active');
        jQuery('#js-pcat-extra-thematic-filter').addClass('hide');

        updateFilterCountLabel();

        return false;
    });

    // filter detail box hidden/show
    jQuery('#js-pcat-filter-button-inner').on('click', function(){
        if( jQuery(this).hasClass('active') ){
            jQuery(this).removeClass('active')
            jQuery('#js-pcat-filter-detail-row').slideUp();
        } else {
            jQuery(this).addClass('active')
            jQuery('#js-pcat-filter-detail-row').slideDown();
        }
    })
})