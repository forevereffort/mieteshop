<?php
    global $product;
    
    $args = [
        'post_type' => 'product',
        'posts_per_page' => 4,
    ];

    $loop = new WP_Query( $args );

    if ( $loop->have_posts() ) {
?>
        <section class="single-product-recently-section">
            <div class="content-container">
                <div class="single-product-recently-title">
                    <h2>ΕΙΔΑΤΕ ΠΡΟΣΦΑΤΑ</h2>
                </div>
                <div class="pcat-results-row">
                    <?php  
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
                                            <a href="<?php echo get_permalink($product->get_id()); ?>">
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
                                                <a class="js-mieteshop-add-to-cart" href="#" data-quantity="1" data-product_id="<?php echo $product->get_id(); ?>" data-variation_id="0" data-product_sku="<?php echo $product->get_sku(); ?>"><span><?php include get_template_directory() . '/assets/icons/busket-small-icon.svg' ?></span></a>
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
                        wp_reset_query();
                    ?>
                </div>
            </div>
        </section>
<?php
    }
?>