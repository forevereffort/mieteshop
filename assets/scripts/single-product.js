import Swiper, { Pagination, A11y, Autoplay } from 'swiper/swiper.esm'
import 'swiper/swiper-bundle.css'

Swiper.use([Pagination, A11y, Autoplay])

class MieteshopProductReviewSlider extends window.HTMLDivElement {
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
    this.$slider = jQuery('[data-slider]', this)
    this.$pagination = jQuery('[data-pagination]', this)
  }

  connectedCallback () {
    this.initSlider()
  }

  initSlider () {
    const config = {
      slidesPerView: 1,
      speed: 1000,
      autoplay: {
        delay: 3000,
      },
      loop: true,
      pagination: {
        el: this.$pagination.get(0)
      }
    }
    
    this.slider = new Swiper(this.$slider.get(0), config)
  }
}

window.customElements.define('mieteshop-product-review-slider', MieteshopProductReviewSlider, { extends: 'div' })
  
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

  jQuery('.single-product-meta-tab-item').click(function(){
    jQuery('.single-product-meta-tab-item').removeClass('active');
    jQuery(this).addClass('active');
  })
})