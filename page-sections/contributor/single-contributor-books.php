<?php
    global $post;

    $productPerPage = 16;

    if( wp_is_mobile() ){
        $productPerPage = 4;
    }

    $page = 1;
?>
<section class="single-product-recently-section single-product-recently-section--border-bottom">
    <div class="content-container">
        <div class="single-product-recently-title">
            <h2>ΒΙΒΛΙΑ ΤΟΥ ΣΥΓΓΡΑΦΕΑ</h2>
        </div>
        <div id="js-single-contributor-product-row" class="pcat-results-row" data-nonce="<?php echo wp_create_nonce('filter_single_contributor_product_nonce'); ?>" data-product-per-page="<?php echo $productPerPage; ?>" data-contributor-id="<?php echo $post->ID; ?>">
            <?php
                $args = [
                    'post_type' => 'product',
                    'posts_per_page' => $productPerPage,
                    'offset' => ($page - 1) * $productPerPage,
                    'meta_query' => [
                        [
                            'key'     => 'book_contributors_syggrafeas',
                            'value'   => '"' . $post->ID . '"',
                            'compare' => 'LIKE'
                        ],
                    ]                    
                ];

                $loop = new WP_Query( $args );

                $count_product_list_include_single_contributor = $loop->found_posts;

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
        <?php
            if( $count_product_list_include_single_contributor > $productPerPage ){
        ?>
                <div class="pcat-results-footer-options">
                    <div class="pcat-results-footer-options-col">
                        <div id="js-single-contributor-product-navigation" class="pcat-results-navigation">
                            <?php
                                require_once dirname(dirname(dirname(__FILE__))) . '/inc/zebra-pagination.php';

                                $pagination = new Zebra_Pagination();
                                $pagination->records($count_product_list_include_single_contributor);
                                $pagination->records_per_page($productPerPage);
                                $pagination->selectable_pages(5);
                                $pagination->set_page(1);
                                $pagination->padding(false);
                                $pagination->css_classes([
                                    'list' => 'pcat-results-navigation-row',
                                    'list_item' => 'js-sc-product-navigation-item pcat-results-navigation-item',
                                    'prev' => 'js-sc-product-navigation-item pcat-results-navigation-prev',
                                    'next' => 'js-sc-product-navigation-item pcat-results-navigation-next',
                                    'anchor' => '',
                                ]);
                                $pagination->render();
                            ?>
                        </div>
                    </div>
                    <div class="pcat-results-footer-options-col">
                        <div class="pcat-results-footer-select">
                            <div class="pcat-results-footer-select-label">Mετάβαση στη σελίδα</div>
                            <div class="pcat-results-footer-select-elem">
                                <?php
                                    $pageCount = round($count_product_list_include_single_contributor / $productPerPage + 0.45);
                                ?>
                                <select id="js-sc-page-list">
                                    <?php
                                        for($p = 1; $p <= $pageCount; $p++){
                                    ?>
                                            <option value="<?php echo $p; ?>"><?php echo $p; ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                                <div class="pcat-results-footer-select-elem-icon"><?php include get_template_directory() . '/assets/icons/arrow-down-icon.svg'; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
        <?php
            }
        ?>
    </div>
</section>