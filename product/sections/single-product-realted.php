<?php
    global $product;
    
    $args = [
       'post_type' => 'product',
       'posts_per_page' => 16,
       'orderby' => 'rand',
    ];

    $related_posts = new WP_Query( $args );
    
    if ( $related_posts->have_posts() ) {
?>
        <section class="single-product-realted-section">
            <div class="content-container">
                <div class="single-product-realted-title">
                    <h2>ΣΧΕΤΙΚΟΙ ΤΙΤΛΟΙ</h2>
                </div>
                <div class="pcat-results-row product-list-desktop-slider">
                    <?php
                        while ( $related_posts->have_posts() ){
                            $related_posts->the_post();

                            global $product;

                            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $product->get_id() ), 'full' );
                            $authorIDs = get_field('book_contributors_syggrafeas', $product->get_id());
                    ?>
                            <div class="pcat-results-col">
                                <div class="pcat-result-item">
                                    <div class="pcat-result-item-info">
                                        <div class="pcat-result-item-image">
                                            <a href="<?php echo get_permalink($product->get_id()); ?>">
                                                <img
                                                    class="lazyload"
                                                    src="<?php echo placeholderImage($image[1], $image[2]); ?>"
                                                    data-src="<?php echo aq_resize($image[0], $image[1], $image[2], true); ?>"
                                                    alt="<?php echo $product->get_name(); ?>">
                                            </a>
                                        </div>
                                        <div><?php echo do_shortcode('[yith_wcwl_add_to_wishlist product_id="' . $product->get_id() . '"]'); ?></div>
                                        <div class="pcat-result-item-meta-row">
                                            <div class="pcat-result-item-meta-col">
                                                <div class="pcat-result-item-favorite">
                                                    <a href="#"><span><?php include get_template_directory() . '/assets/icons/favorite-small-icon.svg' ?></span></a>
                                                </div>
                                            </div>
                                            <div class="pcat-result-item-meta-col">
                                                <div class="pcat-result-item-busket">
                                                <a class="js-mieteshop-add-to-cart" href="#" data-quantity="1" data-product_id="<?php echo $product->get_id(); ?>" data-variation_id="0" data-product_sku="<?php echo $product->get_sku(); ?>"><span><?php include get_template_directory() . '/assets/icons/busket-small-icon.svg' ?></span></a>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                            if( !empty($authorIDs) ){
                                                echo '<div class="pcat-result-item-author-list">';
                                                if( count($authorIDs) > 3 ){
                                                    echo '<div class="pcat-result-item-author-item">Συλλογικό Έργο</div>';
                                                } else {
                                                    foreach( $authorIDs as $authorID ){
                                                        echo '<div class="pcat-result-item-author-item"><a href="'. get_permalink($authorID) . '">' . get_the_title($authorID) . '</a></div>';
                                                    }
                                                }
                                                echo '</div>';
                                            }
                                        ?>
                                        <div class="pcat-result-item-title"><h3><a href="<?php echo get_permalink($product->get_id()); ?>"><?php echo $product->get_name(); ?></a></h3></div>
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
                    ?>
                </div>
                <div class="product-list-mobile-slider"  is="mieteshop-product-list-mobile-slider">
                    <div class="swiper-container" data-slider>
                        <div class="swiper-wrapper">
                            <?php
                                while ( $related_posts->have_posts() ){
                                    $related_posts->the_post();

                                    global $product;

                                    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $product->get_id() ), 'full' );
                                    $authorIDs = get_field('book_contributors_syggrafeas', $product->get_id());
                            ?>
                                    <div class="swiper-slide">
                                        <div class="pcat-results-col">
                                            <div class="pcat-result-item">
                                                <div class="pcat-result-item-info">
                                                    <div class="pcat-result-item-image">
                                                        <a href="<?php echo get_permalink($product->get_id()); ?>">
                                                            <img
                                                                class="lazyload"
                                                                src="<?php echo placeholderImage($image[1], $image[2]); ?>"
                                                                data-src="<?php echo aq_resize($image[0], $image[1], $image[2], true); ?>"
                                                                alt="<?php echo $product->get_name(); ?>">
                                                        </a>
                                                    </div>
                                                    <div><?php echo do_shortcode('[yith_wcwl_add_to_wishlist product_id="' . $product->get_id() . '"]'); ?></div>
                                                    <div class="pcat-result-item-meta-row">
                                                        <div class="pcat-result-item-meta-col">
                                                            <div class="pcat-result-item-favorite">
                                                                <a href="#"><span><?php include get_template_directory() . '/assets/icons/favorite-small-icon.svg' ?></span></a>
                                                            </div>
                                                        </div>
                                                        <div class="pcat-result-item-meta-col">
                                                            <div class="pcat-result-item-busket">
                                                            <a class="js-mieteshop-add-to-cart" href="#" data-quantity="1" data-product_id="<?php echo $product->get_id(); ?>" data-variation_id="0" data-product_sku="<?php echo $product->get_sku(); ?>"><span><?php include get_template_directory() . '/assets/icons/busket-small-icon.svg' ?></span></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                        if( !empty($authorIDs) ){
                                                            echo '<div class="pcat-result-item-author-list">';
                                                            if( count($authorIDs) > 3 ){
                                                                echo '<div class="pcat-result-item-author-item">Συλλογικό Έργο</div>';
                                                            } else {
                                                                foreach( $authorIDs as $authorID ){
                                                                    echo '<div class="pcat-result-item-author-item"><a href="'. get_permalink($authorID) . '">' . get_the_title($authorID) . '</a></div>';
                                                                }
                                                            }
                                                            echo '</div>';
                                                        }
                                                    ?>
                                                    <div class="pcat-result-item-title"><h3><a href="<?php echo get_permalink($product->get_id()); ?>"><?php echo $product->get_name(); ?></a></h3></div>
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
                                    </div>
                            <?php
                                }
                                
                                wp_reset_query();
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