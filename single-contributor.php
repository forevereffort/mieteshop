<?php get_header(); ?>

<?php
    global $post;

    if ( have_posts() ) {
        while ( have_posts() ){
            the_post();
?>
<section class="single-publisher-title">
    <div class="content-container">
        <h1><?php echo $post->post_title; ?></h1>
    </div>
</section>
<section class="single-contributor-image-lead-section">
    <div class="general-container">
        <div class="content-container">
            <div class="single-contributor-image-lead-row">
                <div class="single-contributor-image-lead-left">
                    <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>
                    <div class="single-contributor-image-lead-image">
                        <img
                            class="lazyload"
                            src="<?php echo placeholderImage($image[1], $image[2]); ?>"
                            data-src="<?php echo aq_resize($image[0], $image[1], $image[2], true); ?>"
                            alt="<?php echo $post->post_title; ?>">
                    </div>
                </div>
                <div class="single-contributor-image-lead-right">
                    <div class="single-contributor-image-lead-content">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>            
        </div>
    </div>
</section>
<section class="single-publisher-text-caption-section">
    <div class="content-container">
        <div class="single-publisher-text-caption-row">
            <div class="single-publisher-text-caption-left"></div>
            <div class="single-publisher-text-caption-right">
                <div class="single-publisher-text-caption-content">
                    <?php echo apply_filters('the_content', get_field('contributor_bio_detail')); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
    if( have_rows('contributor_videos') || get_field('contributor_related_articles') ) {
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
                                    if( have_rows('contributor_videos') ) { 
                                        while( have_rows('contributor_videos') ){
                                            the_row();

                                            // get_sub_field('contributor_video_embed_code');
                                            $video_image_url = get_sub_field('contributor_video_cover_image');
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
                            <div class="single-product-video-pagination-wrapper" data-pagination></div>
                        </div>
                    </div>
                    <div id="single-product-meta-tab-content--article" class="single-product-meta-tab-content-col hide">
                        <div class="single-product-blog-wrapper" is="mieteshop-product-blog-slider">
                            <div class="swiper-container" data-slider>
                                <div class="swiper-wrapper">
                                    <?php
                                        $related_articles = get_field('contributor_related_articles');
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
<section class="single-product-recently-section single-product-recently-section--border-bottom">
    <div class="content-container">
        <div class="single-product-recently-title">
            <h2>ΒΙΒΛΙΑ ΤΟΥ ΣΥΓΓΡΑΦΕΑ</h2>
        </div>
        <div class="pcat-results-row">
            <?php
                $args = [
                    'post_type' => 'product',
                    'posts_per_page' => 4,
                    'meta_query' => [
                        [
                            'key'     => 'book_contributors_syggrafeas',
                            'value'   => $post->ID,
                            'compare' => 'LIKE'
                        ],
                    ]                    
                ];

                $loop = new WP_Query( $args );

                while ( $loop->have_posts() ){
                    $loop->the_post();
                    global $product;

                    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $product->get_id() ), 'full' );
                    $authors = get_field('book_contributors_syggrafeas', $product->get_id());
            ?>
                    <div class="pcat-results-col">
                        <div class="pcat-result-item">
                            <div class="pcat-result-item-info">
                                <div class="pcat-result-item-image">
                                    <a href="<?php echo get_permalink($product->ID); ?>">
                                    <img
                                        class="lazyload"
                                        src="<?php echo placeholderImage($image[1], $image[2]); ?>"
                                        data-src="<?php echo aq_resize($image[0], $image[1], $image[2], true); ?>"
                                        alt="<?php echo $product->get_name(); ?>">
                                    </a>    
                                </div>
                                <div class="pcat-result-item-meta-row">
                                    <div class="pcat-result-item-meta-col">
                                        <div class="pcat-result-item-favorite">
                                            <a href="#"><span><?php include get_template_directory() . '/assets/icons/favorite-small-icon.svg' ?></span></a>
                                        </div>
                                    </div>
                                    <div class="pcat-result-item-meta-col">
                                        <div class="pcat-result-item-busket">
                                            <a href="#"><span><?php include get_template_directory() . '/assets/icons/busket-small-icon.svg' ?></span></a>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                    if( !empty($authors) ){
                                        echo '<div class="pcat-result-item-author-list">';
                                        if( count($authors) > 3 ){
                                            echo '<div class="pcat-result-item-author-item">Συλλογικό Έργο</div>';
                                        } else {
                                            foreach( $authors as $author ){
                                                echo '<div class="pcat-result-item-author-item"><a href="'. get_permalink($author->ID) . '">' . $author->post_title . '</a></div>';
                                            }
                                        }
                                        echo '</div>';
                                    }
                                ?>
                                <div class="pcat-result-item-title"><h3><a href="<?php echo get_permalink($product->ID); ?>"><?php echo $product->get_name(); ?></a></h3></div>
                            </div>
                            <div class="pcat-result-item-footer-row">
                                <div class="pcat-result-item-footer-col">
                                    <div class="pcat-result-item-footer-product-price">
                                        <?php echo $product->get_price_html(); ?>
                                    </div>
                                </div>
                                <!--div class="pcat-result-item-footer-col">
                                    <div class="pcat-result-item-footer-product-discount">-30%</div>
                                </div-->
                            </div>
                        </div>
                    </div>
            <?php
                }

                wp_reset_query();
            ?>
        </div>
    </div>
</section>
<section class="single-product-recently-section">
    <?php
        if ( get_field('contributor_related_books') ) {
    ?> 
            <div class="content-container">
                <div class="single-product-recently-title">
                    <h2>ΣΧΕΤΙΚΟΙ ΤΙΤΛΟΙ</h2>
                </div>
                <div class="pcat-results-row">
                    <?php
                        $relatedbooks = get_field('contributor_related_books');
                    
                        foreach($relatedbooks as $relatedbook){
                            $relatedbook_product = wc_get_product( $relatedbook->ID );    
                            $rb_image = wp_get_attachment_image_src( get_post_thumbnail_id( $relatedbook->ID ), 'full' );
                            $rb_authors = get_field('book_contributors_syggrafeas', $relatedbook->ID);
                    ?>
                            <div class="pcat-results-col">
                                <div class="pcat-result-item">
                                    <div class="pcat-result-item-info">
                                        <div class="pcat-result-item-image">
                                            <img
                                                class="lazyload"
                                                src="<?php echo placeholderImage($rb_image[1], $rb_image[2]); ?>"
                                                data-src="<?php echo aq_resize($rb_image[0], $rb_image[1], $rb_image[2], true); ?>"
                                                alt="<?php echo $relatedbook->name; ?>">
                                        </div>
                                        <div class="pcat-result-item-meta-row">
                                            <div class="pcat-result-item-meta-col">
                                                <div class="pcat-result-item-favorite">
                                                    <a href="#"><span><?php include get_template_directory() . '/assets/icons/favorite-small-icon.svg' ?></span></a>
                                                </div>
                                            </div>
                                            <div class="pcat-result-item-meta-col">
                                                <div class="pcat-result-item-busket">
                                                    <a href="#"><span><?php include get_template_directory() . '/assets/icons/busket-small-icon.svg' ?></span></a>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                            if( !empty($rb_authors) ){
                                                echo '<div class="pcat-result-item-author-list">';
                                                if( count($rb_authors) > 3 ){
                                                    echo '<div class="pcat-result-item-author-item">Συλλογικό Έργο</div>';
                                                } else {
                                                    foreach( $rb_authors as $rb_author ){
                                                        echo '<div class="pcat-result-item-author-item"><a href="'. get_permalink($rb_author->ID) . '">' . $rb_author->post_title . '</a></div>';
                                                    }
                                                }
                                                echo '</div>';
                                            }
                                        ?>
                                        <div class="pcat-result-item-title"><h3><a href="<?php echo get_permalink($relatedbook->ID); ?>"><?php echo $relatedbook->post_title; ?></h3></a></div>
                                    </div>
                                    <div class="pcat-result-item-footer-row">
                                        <div class="pcat-result-item-footer-col">
                                            <div class="pcat-result-item-footer-product-price">
                                                <?php echo $relatedbook_product->get_price_html(); ?>
                                            </div>
                                        </div>
                                        <!--div class="pcat-result-item-footer-col">
                                            <div class="pcat-result-item-footer-product-discount">-30%</div>
                                        </div-->
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                        wp_reset_query();
                    ?>
                </div>
            </div>
    <?php
        }
    ?>
</section>
<?php
        }
    }
?>

<?php get_footer(); ?>