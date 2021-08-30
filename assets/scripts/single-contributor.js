import Swiper, { Pagination, A11y, Autoplay } from 'swiper/swiper.esm'
import 'swiper/swiper-bundle.css'

Swiper.use([Pagination, A11y, Autoplay])

class MieteshopContributorMetaSection extends window.HTMLDivElement {
  constructor (...args) {
    const self = super(...args)
    self.init()
    return self
  }

  init () {
    this.$ = jQuery(this)
    this.resolveElements()
  }

  resolveElements () {
    this.$tab = jQuery('[data-tab]', this)
    this.$videoSlider = jQuery('[data-video-slider]', this)
    this.$videoPagination = jQuery('[data-video-pagination]', this)
    this.$blogSlider = jQuery('[data-blog-slider]', this)
  }

  connectedCallback () {
    this.initVideoSlider()
    this.initBlogSlider()
    this.initTab()
  }

  initVideoSlider () {
    const config = {
      slidesPerView: 1,
      speed: 5000,
      // autoplay: {
      //   delay: 8000,
      // },
      loop: true,
      pagination: {
        el: this.$videoPagination.get(0),
        clickable: true,
      },
      observer: true,
      observeParents: true,
      breakpoints : {
        320 : {
          spaceBetween: 50,
        },
        768 : {
          spaceBetween: 120,
        }
      }
    }
    
    this.videoSlider = new Swiper(this.$videoSlider.get(0), config)
  }

  initBlogSlider () {
    const config = {
      speed: 5000,
      // autoplay: {
      //   delay: 8000,
      // },
      loop: true,
      observer: true,
      observeParents: true,
      breakpoints : {
        320 : {
          slidesPerView: 1,
          spaceBetween: 50,
          slidesPerView: 1,
        },
        768 : {
          slidesPerView: 'auto',
          spaceBetween: 120,
        }
      }
    }
    
    this.blogSlider = new Swiper(this.$blogSlider.get(0), config)
  }

  initTab () {
    const that = this;
    
    this.$tab.on('click', function(){
      if( !jQuery(this).hasClass('active') ){
        const sectionID = jQuery(this).attr('data-section-id');

        if( sectionID === 'video' ){
          that.videoSlider.update();
        } else if( sectionID === 'article' ){
          that.blogSlider.update();
        }
  
        jQuery('.single-contributor-meta-tab-content-col').addClass('hide');
        jQuery(`#single-contributor-meta-tab-content--${sectionID}`).removeClass('hide');
  
        jQuery('.single-contributor-meta-tab-item').removeClass('active');
        jQuery(this).addClass('active');
      }
    })
  }
}

window.customElements.define('mieteshop-contributor-meta-section', MieteshopContributorMetaSection, { extends: 'section' })

jQuery(function(){

  // get products with publisher and page
  function singleContributorProductSearch(page){
      const filterContributorId = jQuery('#js-single-contributor-product-row').attr('data-contributor-id');
      const nonce = jQuery('#js-single-contributor-product-row').attr('data-nonce');
      const productPerPage = jQuery('#js-single-contributor-product-row').attr('data-product-per-page');

      jQuery('#js-single-contributor-product-filter-load-spinner').removeClass('hide');

      jQuery.ajax({
          type: 'get',
          dataType: 'json',
          url: window.MieteshopData.ajaxurl,
          data: {
              action: 'filter_single_contributor_product',
              nonce,
              filterContributorId,
              page,
              productPerPage
          },
          success: function (response) {
              jQuery('#js-single-contributor-product-row').html(response.result);
              jQuery('#js-single-contributor-product-navigation').html(response.navigation);

              // add page navigation click event into new added nav html
              addPageNavigationClickOfSCProductFunc();

              jQuery('#js-single-contributor-product-filter-load-spinner').addClass('hide')
          }
      })
  }
  
  // page navigation click
  function addPageNavigationClickOfSCProductFunc(){
      jQuery('.js-sc-product-navigation-item a').on('click', function(){

          // check this is current page
          if( !jQuery(this).parent().hasClass('active') ){
              const page = jQuery(this).attr('data-page');

              singleContributorProductSearch(page)
          }

          return false;
      })
  }

  addPageNavigationClickOfSCProductFunc();

  jQuery('#js-sc-page-list').on('change', function(){
      const pageNumber = jQuery(this).val();

      singleContributorProductSearch(pageNumber);
  });
})