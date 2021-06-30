import $ from 'jquery';
import 'select2';
import 'select2/dist/css/select2.css';

jQuery(function(){

    $('#js-pcat-author-list').select2({
        placeholder: " Συγγραφείς",
        allowClear: true
    });
    $('#js-pcat-publisher-list').select2({
        placeholder: "Εκδότες",
        allowClear: true
    });

    function updateFilterCountLabel(){
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