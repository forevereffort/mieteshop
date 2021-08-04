import Swiper, { Pagination, A11y, Autoplay } from 'swiper/swiper.esm'
import 'swiper/swiper-bundle.css'

Swiper.use([Pagination, A11y, Autoplay])

class MieteshopProductMetaSection extends window.HTMLDivElement {
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
    this.$reviewSlider = jQuery('[data-review-slider]', this)
    this.$reviewPagination = jQuery('[data-review-pagination]', this)
    this.$audioSlider = jQuery('[data-audio-slider]', this)
    this.$audioPagination = jQuery('[data-audio-pagination]', this)
    this.$videoSlider = jQuery('[data-video-slider]', this)
    this.$videoPagination = jQuery('[data-video-pagination]', this)
    this.$blogSlider = jQuery('[data-blog-slider]', this)
  }

  connectedCallback () {
    this.initReviewSlider()
    this.initAudioSlider()
    this.initVideoSlider()
    this.initBlogSlider()
    this.initTab()
  }

  initReviewSlider () {
    const config = {
      slidesPerView: 1,
      speed: 5000,
      // autoplay: {
      //   delay: 8000,
      // },
      loop: true,
      pagination: {
        el: this.$reviewPagination.get(0)
      },
      observer: true,
      observeParents: true,
    }
    
    this.reviewSlider = new Swiper(this.$reviewSlider.get(0), config)
  }

  initAudioSlider () {
    const config = {
      slidesPerView: 1,
      speed: 5000,
      // autoplay: {
      //   delay: 8000,
      // },
      loop: true,
      pagination: {
        el: this.$audioPagination.get(0)
      },
      observer: true,
      observeParents: true,
    }
    
    this.audioSlider = new Swiper(this.$audioSlider.get(0), config)
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
        el: this.$videoPagination.get(0)
      },
      observer: true,
      observeParents: true,
    }
    
    this.videoSlider = new Swiper(this.$videoSlider.get(0), config)
  }

  initBlogSlider () {
    const config = {
      slidesPerView: 'auto',
      spaceBetween: 120,
      speed: 5000,
      // autoplay: {
      //   delay: 8000,
      // },
      loop: true,
      observer: true,
      observeParents: true,
    }
    
    this.blogSlider = new Swiper(this.$blogSlider.get(0), config)
  }

  initTab () {
    const that = this;

    this.$tab.on('click', function(){
      if( !jQuery(this).hasClass('active') ){
        const sectionID = jQuery(this).attr('data-section-id');

        if( sectionID === 'review' ){
          that.reviewSlider.update();
        } else if( sectionID === 'audio' ){
          that.audioSlider.update();
        } else if( sectionID === 'video' ){
          that.videoSlider.update();
        } else if( sectionID === 'article' ){
          that.blogSlider.update();
        }
  
        jQuery('.single-product-meta-tab-content-col').addClass('hide');
        jQuery(`#single-product-meta-tab-content--${sectionID}`).removeClass('hide');
  
        jQuery('.single-product-meta-tab-item').removeClass('active');
        jQuery(this).addClass('active');
      }
    })
  }
}

window.customElements.define('mieteshop-product-meta-section', MieteshopProductMetaSection, { extends: 'section' })

jQuery(function(){
  jQuery('.single-product-tab-header-item').on('click', function(){
    if( !jQuery(this).hasClass('active') ){
      const sectionID = jQuery(this).attr('data-section-id');

      jQuery('.single-product-tab-content-item').addClass('hide');
      jQuery(`#single-product-tab-content-item--${sectionID}`).removeClass('hide');

      jQuery('.single-product-tab-header-item').removeClass('active');
      jQuery(this).addClass('active');
    }
  })
})