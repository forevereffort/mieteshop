jQuery(document).ready(function(){

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
    
    jQuery('.js-pcat-filter-detail-child').click(function(){
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
            jQuery('span', $newElem).click(function(){
                const termID = jQuery(this).attr('data-term-id');

                jQuery(`#js-pcat-extra-thematic-filter-col-${termID}`).remove();
                jQuery('.js-pcat-filter-detail-child[data-term-id=' + termID + ']').remove();

                updateFilterCountLabel();
            })

            jQuery('#js-pcat-extra-thematic-filter-row').append($newElem);
        }

        updateFilterCountLabel();
    })

    // the thematic filter clear all button click
    jQuery('#js-pcat-extra-thematic-filter-link-clear').click(function(){
        jQuery('#js-pcat-extra-thematic-filter-row').html('');
        jQuery('.js-pcat-filter-detail-child').removeClass('active');
        jQuery('#js-pcat-extra-thematic-filter').addClass('hide');
        return false;
    });

    // filter detail box hidden/show
    jQuery('#js-pcat-filter-button-inner').click(function(){
        if( jQuery(this).hasClass('active') ){
            jQuery(this).removeClass('active')
            jQuery('#js-pcat-filter-detail-row').slideUp();
        } else {
            jQuery(this).addClass('active')
            jQuery('#js-pcat-filter-detail-row').slideDown();
        }
    })
})