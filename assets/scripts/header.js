jQuery(document).ready(function(){
  // Open sub menu and keep open. Close when hovering over a different menu item
  jQuery('.js-header-nav-parent-menu').hover(
    function () {
      var menuID = jQuery(this).attr('data-menu-id');

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
        jQuery('.header-sub-menu.active').removeClass('active')
      }, 200)
    }
  )

  // Close sub menu when not hovering header menu element
  jQuery('.header-nav').hover(function () {}, function () {
    setTimeout(function () {
      jQuery('.header-sub-menu.active').removeClass('active')
    }, 200)
  })
})