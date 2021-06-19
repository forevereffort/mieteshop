jQuery(document).ready(function(){
    jQuery('.js-pcat-filter-detail-child').click(function(){
        if( jQuery(this).hasClass('active') ){
            jQuery(this).removeClass('active')
        } else {
            jQuery(this).addClass('active')
        }
    })
})