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

      // after appearing auto complete box, set focus the inputfield
      // as the popup has fade in effect for .2s, we need the time delay
      setTimeout(function(){
        document.getElementById('js-header-top-search-form-text').focus();
      }, 300);
    }
  })

  // header top favorite icon click
  jQuery('#js-header-top-favorite-icon').click(function(){
    if( jQuery('#js-header-top-favorite-popup').hasClass('active') ){
      jQuery('#js-header-top-favorite-popup').removeClass('active');
    } else {
      jQuery('#js-header-top-favorite-popup').addClass('active');
    }
  })

  // header top busket icon click
  jQuery('#js-header-top-busket-icon').click(function(){
    if( jQuery('#js-header-top-busket-popup').hasClass('active') ){
      jQuery('#js-header-top-busket-popup').removeClass('active');
    } else {
      jQuery('#js-header-top-busket-popup').addClass('active');
    }
  })

  // header top user icon click
  jQuery('#js-header-top-user-icon').click(function(){
    if( jQuery('#js-header-top-user-popup').hasClass('active') ){
      jQuery('#js-header-top-user-popup').removeClass('active');
    } else {
      jQuery('#js-header-top-user-popup').addClass('active');
    }
  })

  // close header popup when the outside of popup is clicked
  jQuery(document).on("click", function (event) {
    if( jQuery('#js-header-top-search-popup').hasClass('active') ){
      if (jQuery(event.target).closest("#js-header-top-search-popup,#js-header-top-search-icon").length === 0) {
        jQuery('#js-header-top-search-popup').removeClass('active');
      }
    }

    if( jQuery('#js-header-top-favorite-popup').hasClass('active') ){
      if (jQuery(event.target).closest("#js-header-top-favorite-popup,#js-header-top-favorite-icon").length === 0) {
        jQuery('#js-header-top-favorite-popup').removeClass('active');
      }
    }

    if( jQuery('#js-header-top-busket-popup').hasClass('active') ){
      if (jQuery(event.target).closest("#js-header-top-busket-popup,#js-header-top-busket-icon").length === 0) {
        jQuery('#js-header-top-busket-popup').removeClass('active');
      }
    }

    if( jQuery('#js-header-top-user-popup').hasClass('active') ){
      if (jQuery(event.target).closest("#js-header-top-user-popup,#js-header-top-user-icon").length === 0) {
        jQuery('#js-header-top-user-popup').removeClass('active');
      }
    }
  });

  jQuery('#js-header-top-mobile-menu-btn').on('click', function(){
    if( jQuery(this).hasClass('is-open') ){
      jQuery(this).removeClass('is-open')
    } else {
      jQuery(this).addClass('is-open')
    }
  })
})