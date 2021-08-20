import Swiper, { Pagination, A11y, Autoplay } from 'swiper/swiper.esm'
import 'swiper/swiper-bundle.css'

Swiper.use([Pagination, A11y, Autoplay])

class MieteshopPublisherMetaSection extends window.HTMLDivElement {
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
  
        jQuery('.single-publisher-meta-tab-content-col').addClass('hide');
        jQuery(`#single-publisher-meta-tab-content--${sectionID}`).removeClass('hide');
  
        jQuery('.single-publisher-meta-tab-item').removeClass('active');
        jQuery(this).addClass('active');
      }
    })
  }
}

window.customElements.define('mieteshop-publisher-meta-section', MieteshopPublisherMetaSection, { extends: 'section' })


jQuery(function(){

    // get products with publisher and page
    function singlePublisherProductSearch(page){
        const filterPublisherId = jQuery('#js-single-publisher-product-row').attr('data-publisher-id');
        const nonce = jQuery('#js-single-publisher-product-row').attr('data-nonce');
        const productPerPage = jQuery('#js-single-publisher-product-row').attr('data-product-per-page');

        jQuery('#js-single-publisher-product-filter-load-spinner').removeClass('hide');

        jQuery.ajax({
            type: 'get',
            dataType: 'json',
            url: window.MieteshopData.ajaxurl,
            data: {
                action: 'filter_single_publisher_product',
                nonce,
                filterPublisherId,
                page,
                productPerPage
            },
            success: function (response) {
                jQuery('#js-single-publisher-product-row').html(response.result);
                jQuery('#js-single-publisher-product-navigation').html(response.navigation);

                // add page navigation click event into new added nav html
                addPageNavigationClickOfSPProductFunc();

                jQuery('#js-single-publisher-product-filter-load-spinner').addClass('hide')
            }
        })
    }
    
    // page navigation click
    function addPageNavigationClickOfSPProductFunc(){
        jQuery('.js-sp-product-navigation-item a').on('click', function(){

            // check this is current page
            if( !jQuery(this).parent().hasClass('active') ){
                const page = jQuery(this).attr('data-page');

                singlePublisherProductSearch(page)
            }

            return false;
        })
    }

    addPageNavigationClickOfSPProductFunc();

    jQuery('#js-sp-page-list').on('change', function(){
        const pageNumber = jQuery(this).val();

        singlePublisherProductSearch(pageNumber);
    });
})

