<?php
    if( have_rows('company_videos') || get_field('company_related_articles') ) {
?>
        <section class="single-product-meta-section">
            <div class="content-container">
                <div class="single-product-meta-tab-row">
                    <div class="single-product-meta-tab-col">
                        <div class="single-product-meta-tab-item active" data-section-id="video">Video</div>
                    </div>
                    <div class="single-product-meta-tab-col">
                        <div class="single-product-meta-tab-item" data-section-id="article">Σχετικά  Άρθρα</div>
                    </div>
                </div>
                <div class="single-product-meta-tab-content-row">
                    <div id="single-product-meta-tab-content--video" class="single-product-meta-tab-content-col">
                        <div class="single-product-video-wrapper" is="mieteshop-product-video-slider">
                            <div class="swiper-container" data-slider>
                                <div class="swiper-wrapper">
                                    <?php
                                        if( have_rows('company_videos') ) { 
                                            while( have_rows('company_videos') ){
                                                the_row();

                                                // get_sub_field('company_video_embed_code');
                                                $video_image_url = get_sub_field('company_video_cover_image');
                                    ?>
                                                <div class="swiper-slide">
                                                    <div class="single-product-video-item-row">
                                                        <div class="single-product-video-item-left-col">
                                                            <div class="single-product-video-image-wrapper">
                                                                <img
                                                                    class="lazyload"
                                                                    src="<?php echo placeholderImage(606, 241); ?>"
                                                                    data-src="<?php echo aq_resize($video_image_url['url'], 606, 241, true); ?>"
                                                                    alt="video image">
                                                                <div class="single-product-video-play-icon"><?php include get_template_directory() . '/assets/icons/video-play-icon.svg' ?></div>
                                                                <div class="single-product-video-resize-icon"><?php include get_template_directory() . '/assets/icons/resize-icon.svg' ?></div>
                                                            </div>
                                                        </div>
                                                        <div class="single-product-video-item-right-col">
                                                            <div class="single-product-video-item-content">
                                                                <h2><?php echo get_sub_field('company_video_title'); ?></h2>
                                                                <?php echo apply_filters('the_content', get_sub_field('company_video_description')); ?>
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
                            <div class="single-product-video-pagination-wrapper" data-pagination></div>
                        </div>
                    </div>
                    <div id="single-product-meta-tab-content--article" class="single-product-meta-tab-content-col hide">
                        <div class="single-product-blog-wrapper" is="mieteshop-product-blog-slider">
                            <div class="swiper-container" data-slider>
                                <div class="swiper-wrapper">
                                    <?php
                                        $related_articles = get_field('company_related_articles');
                                        foreach($related_articles as $article) {
                                            $blog_image_url = wp_get_attachment_url( get_post_thumbnail_id($article->ID) );
                                    ?>
                                            <div class="single-product-blog-item swiper-slide">
                                                <div class="single-product-blog-item-inner">
                                                    <div class="single-product-blog-image">
                                                        <a href="<?php echo get_permalink($article->ID); ?>">
                                                            <img
                                                                class="lazyload"
                                                                src="<?php echo placeholderImage(399, 261); ?>"
                                                                data-src="<?php echo aq_resize($blog_image_url, 399, 261, true); ?>"
                                                                alt="video image">
                                                        </a>
                                                    </div>
                                                    <div class="single-product-blog-content">
                                                        <h2><a href="<?php echo get_permalink($article->ID); ?>"><?php echo $article->post_title; ?></a></h2>
                                                        <?php echo apply_filters('the_content', $article->post_excerpt); ?>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
<?php
    }
?>