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
      observer: true,
      observeParents: true,
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

class MieteshopProductVideoSlider extends window.HTMLDivElement {
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
      observer: true,
      observeParents: true,
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

window.customElements.define('mieteshop-product-video-slider', MieteshopProductVideoSlider, { extends: 'div' })

class MieteshopProductBlogSlider extends window.HTMLDivElement {
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
  }

  connectedCallback () {
    this.initSlider()
  }

  initSlider () {
    const config = {
      slidesPerView: 'auto',
      spaceBetween: 120,
      observer: true,
      observeParents: true,
      speed: 1000,
      autoplay: {
        delay: 3000,
      },
      loop: true
    }
    
    this.slider = new Swiper(this.$slider.get(0), config)
  }
}

window.customElements.define('mieteshop-product-blog-slider', MieteshopProductBlogSlider, { extends: 'div' })

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
    if( !jQuery(this).hasClass('active') ){
      const sectionID = jQuery(this).attr('data-section-id');

      jQuery('.single-product-meta-tab-content-col').addClass('hide');
      jQuery(`#single-product-meta-tab-content--${sectionID}`).removeClass('hide');

      jQuery('.single-product-meta-tab-item').removeClass('active');
      jQuery(this).addClass('active');
    }
  })
})