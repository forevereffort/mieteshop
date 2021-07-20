<?php
    global $post;
?>
<section class="breadcrumb-section">
    <div class="content-container">
        <div class="breadcrumb-list">
            <div class="breadcrumb-item"><a href="#">Εκδηλώσεις</a></div>
            <div class="breadcrumb-item"><a href="#">Εκθέσεις</a></div>
        </div>
    </div>
</section>
<section class="single-post-title-section">
    <div class="general-container">
        <div class="content-container">
            <div class="single-post-title-row">
                <div class="single-post-title-left-col">
                    <h1>Για λουλούδια θα μιλάμε τώρα;</h1>
                </div>
                <div class="single-post-title-right-col">
                    <div class="single-post-title-category-row">
                        <div class="single-post-title-category-item">
                            <a href="#">ΕΚΔΗΛΩΣΕΙΣ</a>
                        </div>
                        <div class="single-post-title-category-item">
                            <a href="#">EΚΘΕΣΕΙΣ</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="single-post-hero-section">
    <div class="general-container">
        <div class="content-container">
            <?php
                /*
                //$content = $post->post_content;
                //$content = apply_filters( 'the_content', $content );
                //echo $content;
                */            
                $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
            ?>
            <div class="single-post-hero-row">
                <?php if ( get_field('event_details') ) { ?>
                <div class="single-post-hero-event">
                    <div class="single-post-hero-event-inner">
                        <?php echo get_field('event_details'); ?>
                    </div>
                </div>
                <?php } ?>
                <div class="single-post-hero-col">
                    <div class="single-post-hero-image">
                        <img
                            class="lazyload"
                            src="<?php echo placeholderImage($image[1], $image[2]); ?>"
                            data-src="<?php echo aq_resize($image[0], $image[1], $image[2], true); ?>"
                            alt="<?php echo $post->post_title; ?>">
                    </div>
                    <div class="single-post-hero-content-row">
                        <div class="single-post-hero-content">
                            <p><?php echo get_field('post_lead'); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php

// Check value exists.
if( have_rows('post_extra_content') ):

    // Loop through rows.
    while ( have_rows('post_extra_content') ) : the_row();

        // Case: post text field
        if( get_row_layout() == 'post_text_section' ):
            $text = get_sub_field('post_text');
            if($text):
                echo '<section class="blog-text"><div class="general-container"><div class="post-content-container">';
                echo '<div class="post-text">';
                echo $text;
                echo '</div>';
                echo '</div></div></section>';
            endif;

        // Case: post blockquote field
        elseif( get_row_layout() == 'post_blockquote_section' ):
            $blockquote = get_sub_field('post_blockquote');
            if($blockquote):
                echo '<section class="blog-text"><div class="general-container"><div class="post-content-container">';
                echo '<div class="post-blockquote">';
                echo $blockquote;
                echo '</div>';
                echo '</div></div></section>';   
            endif;         

        // Case: post video fields
        elseif( get_row_layout() == 'post_video_section' ): 
            $video = get_sub_field('post_video');
            $video_text = get_sub_field('post_video_text');
            if($video_text):
                echo '<section><div class="general-container"><div class="post-content-container">';
                echo '<div class="post-video">';
                echo '<h3>Video</h3>';
                echo '<div class="video_wrapper"><div class="col1">'.$video.'</div><div class="col2">'.$video_text.'</div></div>';
                echo '</div>';
                echo '</div></div></section>';
            endif;

        // Case: post gallery field
        elseif( get_row_layout() == 'post_gallery_section' ): 
            $images = get_sub_field('post_image_gallery');
            //echo count($images) .'<br/>';
            //echo '<pre>'; print_r($images); echo '</pre>';
            if($images):    
            ?>
            <section><div class="general-container"><div class="content-container">
            <div class="single-post-slider-row" is="mieteshop-post-slider">
                <div class="single-post-slider-big-wrapper">
                    <div class="swiper-container" data-big-slider>
                        <div class="swiper-wrapper">
                            <?php
                            foreach( $images as $image ) {
                            ?>
                                <div class="swiper-slide">
                                    <!--a href="<?php //echo esc_url($image['url']); ?>"></a-->
                                    <img class="lazyload" src="<?php echo esc_url($image['url']); ?>" data-src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                                </div>
                            <?php
                            }
                            ?>    
                        </div>
                    </div>
                    <div class="single-post-slider-big-nav-wrapper">
                        <div data-slider-button="prev" class="single-post-slider-big-nav single-post-slider-big-nav--prev"><?php include get_template_directory() . '/assets/icons/slider-prev-icon.svg'; ?></div>
                        <div data-slider-button="next" class="single-post-slider-big-nav single-post-slider-big-nav--next"><?php include get_template_directory() . '/assets/icons/slider-next-icon.svg'; ?></div>
                    </div>
                </div>
                <div class="single-post-slider-small-wrapper">
                    <div class="swiper-container" data-small-slider>
                        <div class="swiper-wrapper">
                            <?php
                            //$thumbs = get_sub_field('post_image_gallery');
                            $i=1;
                            foreach( $images as $image ) {
                            ?>
                            <div class="swiper-slide single-post-slider-small-item item-'<?php echo $i; ?>'">
                                <img class="lazyload" src="<?php echo esc_url($image['sizes']['woocommerce_gallery_thumbnail']); ?>" data-src="<?php echo $image['sizes']['woocommerce_gallery_thumbnail']; ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                            </div>
                            <?php
                            $i++;
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            </div></div></section>
            <?php
            endif;
        endif;

    // End loop.
    endwhile;

// No value.
else :
    // Do something...
endif;                

?>
