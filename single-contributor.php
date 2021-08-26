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

<?php get_template_part( 'contributor/sections/single', 'contributor-meta' ); ?>

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
                    $authorIDs = get_field('book_contributors_syggrafeas', $product->get_id());
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
                            $rb_authorIDs = get_field('book_contributors_syggrafeas', $relatedbook->ID);
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
                                                <a class="js-mieteshop-add-to-cart" href="#" data-quantity="1" data-product_id="<?php echo $relatedbook_product->get_id(); ?>" data-variation_id="0" data-product_sku="<?php echo $relatedbook_product->get_sku(); ?>"><span><?php include get_template_directory() . '/assets/icons/busket-small-icon.svg' ?></span></a>
                                            </div>
                                            </div>
                                        </div>
                                        <?php
                                            if( !empty($rb_authorIDs) ){
                                                echo '<div class="pcat-result-item-author-list">';
                                                if( count($rb_authorIDs) > 3 ){
                                                    echo '<div class="pcat-result-item-author-item">Συλλογικό Έργο</div>';
                                                } else {
                                                    foreach( $rb_authorIDs as $rb_authorID ){
                                                        echo '<div class="pcat-result-item-author-item"><a href="'. get_permalink($rb_authorID) . '">' . get_the_title($rb_authorID) . '</a></div>';
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