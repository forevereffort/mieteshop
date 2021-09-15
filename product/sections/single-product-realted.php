<?php
    global $product;
    
    $args = [
       'post_type' => 'product',
       'posts_per_page' => 16,
       'orderby' => 'rand',
       'fields' => 'ids'
    ];

    $related_posts = new WP_Query( $args );
    
    if ( !empty($related_posts->posts) ) {
?>
        <section class="single-product-realted-section">
            <div class="content-container">
                <div class="single-product-realted-title">
                    <h2>ΣΧΕΤΙΚΟΙ ΤΙΤΛΟΙ</h2>
                </div>
                <div class="pcat-results-row product-list-desktop-slider">
                    <?php
                        foreach( $related_posts->posts as $postid ) {
                    ?>
                            <div class="pcat-results-col">
                                <?php get_template_part('product/loop/loop', 'product-card', [ 'postId' => $postid ]); ?>
                            </div>
                    <?php
                        }
                    ?>
                </div>
                <div class="product-list-mobile-slider"  is="mieteshop-product-list-mobile-slider">
                    <div class="swiper-container" data-slider>
                        <div class="swiper-wrapper">
                            <?php
                                foreach( $related_posts->posts as $postid ) {
                            ?>
                                    <div class="swiper-slide">
                                        <div class="pcat-results-col">
                                            <?php get_template_part('product/loop/loop', 'product-card', [ 'postId' => $postid ]); ?>
                                        </div>
                                    </div>
                            <?php
                                }
                            ?>
                        </div>
                        <div class="product-list-mobile-slider-nav-wrapper">
                            <div data-slider-button="prev" class="product-list-mobile-slider-nav product-list-mobile-slider-nav--prev"><?php include get_template_directory() . '/assets/icons/slider-prev-icon.svg'; ?></div>
                            <div data-slider-button="next" class="product-list-mobile-slider-nav product-list-mobile-slider-nav--next"><?php include get_template_directory() . '/assets/icons/slider-next-icon.svg'; ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
<?php
    }
?>