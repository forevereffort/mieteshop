jQuery(document).ready(function(){
    jQuery('.single-product-tab-header-item').click(function(){
        if( !jQuery(this).hasClass('active') ){
            const sectionID = jQuery(this).attr('data-section-id');

            jQuery('.single-product-tab-content-item').addClass('hide');
            jQuery(`#single-product-tab-content-item--${sectionID}`).removeClass('hide');

            jQuery('.single-product-tab-header-item').removeClass('active');
            jQuery(this).addClass('active');
        }
    })
})