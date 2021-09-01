<?php
    $current_series_taxonomy = get_queried_object();
?>
<section class="single-product-meta-section" is="mieteshop-series-meta-section">
    <div class="content-container">
        <div class="single-product-meta-tab-row">
            <div class="single-product-meta-tab-col">
                <div class="single-product-meta-tab-item active">Video</div>
            </div>
        </div>
        <div class="single-product-meta-tab-content-row"  >
            <div id="single-product-meta-tab-content--video" class="single-product-meta-tab-content-col">
                <div class="single-product-video-wrapper" is="mieteshop-series-video-slider">
                    <div class="swiper-container" data-video-slider>
                        <div class="swiper-wrapper">
                            <?php
                                if( have_rows('series_videos', 'series_'.$current_series_taxonomy->term_id) ) { 
                                    while( have_rows('series_videos', 'series_'.$current_series_taxonomy->term_id) ){
                                        the_row();
                                        // get_sub_field('contributor_video_embed_code');
                                        $video_image_url = get_sub_field('contributor_video_cover_image');
                                        ?>
                                        <div class="swiper-slide">
                                            <div class="single-product-video-item-row">
                                                <div class="single-product-video-item-left-col">
                                                    <div class="single-product-video-image-wrapper">
                                                        <!--
                                                        <img
                                                            class="lazyload"
                                                            src="<?php echo placeholderImage(606, 241); ?>"
                                                            data-src="<?php echo aq_resize($video_image_url['url'], 606, 241, true); ?>"
                                                            alt="video image">
                                                        <div class="single-product-video-play-icon"><?php include get_template_directory() . '/assets/icons/video-play-icon.svg' ?></div>
                                                        <div class="single-product-video-resize-icon"><?php include get_template_directory() . '/assets/icons/resize-icon.svg' ?></div>
                                                        -->
                                                        <?php echo '<div class="embed-container">'.get_sub_field('contributor_video_embed_code').'</div>'; ?>
                                                    </div>
                                                </div>
                                                <div class="single-product-video-item-right-col">
                                                    <div class="single-product-video-item-content">
                                                        <h2><?php echo get_sub_field('contributor_video_title'); ?></h2>
                                                        <?php echo apply_filters('the_content', get_sub_field('contributor_video_description')); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }                         
                            ?>
                        </div>
                    </div>
                    <div class="single-product-video-pagination-wrapper" data-video-pagination></div>
                </div>
            </div>
        </div>
    </div>
</section>