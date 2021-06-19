jQuery(document).ready(function(){
  // Open sub menu and keep open. Close when hovering over a different menu item
  jQuery('.js-header-nav-parent-menu').hover(
    function () {
      var menuID = jQuery(this).attr('data-menu-id');
      // jQuery(this).addClass('active');

      setTimeout(function () {
        jQuery('.header-sub-menu.active').removeClass('active')
        jQuery(`#header-sub-menu-${menuID}`).addClass('active');
      }, 200)
    }
  )

  jQuery('.header-sub-menu').hover(
    function () {
      var $this = jQuery(this);

      setTimeout(function () {
        jQuery('.header-sub-menu.active').removeClass('active')
        jQuery($this).addClass('active');
      }, 200)
    }
  )

  jQuery('.js-header-nav-menu').hover(
    function () {

      setTimeout(function () {
        // jQuery('.js-header-nav-parent-menu.active').removeClass('active')
        jQuery('.header-sub-menu.active').removeClass('active')
      }, 200)
    }
  )

  // Close sub menu when not hovering header menu element
  jQuery('.header-nav').hover(function () {}, function () {
    setTimeout(function () {
      // jQuery('.js-header-nav-parent-menu.active').removeClass('active')
      jQuery('.header-sub-menu.active').removeClass('active')
    }, 200)
  })

  // header top search icon click
  jQuery('#js-header-top-search-icon').click(function(){
    if( jQuery('#js-header-top-search-popup').hasClass('active') ){
      jQuery('#js-header-top-search-popup').removeClass('active');
    } else {
      jQuery('#js-header-top-search-popup').addClass('active');
    }
  })

  // close header popup when the outside of popup is clicked
  jQuery(document).on("click", function (event) {
    if( jQuery('#js-header-top-search-popup').hasClass('active') ){
      if (jQuery(event.target).closest("#js-header-top-search-popup,#js-header-top-search-icon").length === 0) {
        jQuery('#js-header-top-search-popup').removeClass('active');
      }
    }
  });
})