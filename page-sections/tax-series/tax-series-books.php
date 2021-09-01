<?php
    global $post;

    $current_series_taxonomy = get_queried_object();

    $productPerPage = 16;

    if( wp_is_mobile() ){
        $productPerPage = 4;
    }
    
    $page = 1;

    // get all products that has selected series taxonomy
    $args = [
        'post_type' => 'product',
        'posts_per_page' => $productPerPage,
        'offset' => ( $page - 1 ) * $productPerPage,
        'tax_query' => [
            [
                'taxonomy' => 'series',
                'field' => 'term_id',
                'terms' => $current_series_taxonomy->term_id
            ],
        ],
        'orderby' => 'title',
        'order' => 'asc',
    ];

    $the_query = new WP_Query( $args );

    if ( $the_query->have_posts() ) {
        $products_search_count = $the_query->found_posts;
?>
        <section id="js-tax-series-books" class="pcat-results-section pcat-results-section--border-top">
            <div class="general-container">
                <div class="content-container">
                    <div class="pcat-results-top-title">
                        <h2>TA ΒΙΒΛΙΑ ΤΗΣ ΣΕΙΡΑΣ</h2>
                    </div>
                    <div class="pcat-results-top-row">
                        <div class="pcat-results-top-left-col">
                            <div class="pcat-results-title">
                                <h2>ΤΙΤΛΟΙ: <?php echo $products_search_count; ?></h2>
                            </div>
                        </div>
                        <div class="pcat-results-top-right-col">
                            <div class="pcat-classification-filter">
                                <div class="pcat-classification-filter-label pcat-classification-filter-label--black">ΤΑΞΙΝΟΜΗΣΗ</div>
                                <div class="pcat-classification-filter-select">
                                    <select id="js-ts-product-display-order">
                                        <option value="published-date">Published Date</option>
                                        <option value="alphabetical">Alphabetical</option>
                                    </select>
                                    <div class="pcat-classification-filter-select-icon"><?php include get_template_directory() . '/assets/icons/arrow-down-white-icon.svg'; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="js-taxonomy-series-product-row" class="pcat-results-row" data-nonce="<?php echo wp_create_nonce('filter_taxonomy_series_product_nonce'); ?>" data-product-per-page="<?php echo $productPerPage; ?>" data-series-term-id="<?php echo $current_series_taxonomy->term_id; ?>">
                        <?php
                            while ( $the_query->have_posts() ) {
                                $the_query->the_post();

                                $product = wc_get_product( $post->ID );
                                $image = wp_get_attachment_image_src( get_post_thumbnail_id( $product->get_id() ), 'full' );
                                $authorIDs = get_field('book_contributors_syggrafeas', $product->get_id());
                        ?>
                                <div class="pcat-results-col">
                                    <div class="pcat-result-item">
                                        <div class="pcat-result-item-info">
                                            <div class="pcat-result-item-image">
                                                <img
                                                    class="lazyload"
                                                    src="<?php echo placeholderImage($image[1], $image[2]); ?>"
                                                    data-src="<?php echo aq_resize($image[0], $image[1], $image[2], true); ?>"
                                                    alt="<?php echo $product->get_name(); ?>">
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
                                            <div class="pcat-result-item-title"><h3><?php echo $product->get_name(); ?></h3></div>
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
                    <?php
                        if( $products_search_count > $productPerPage ){
                    ?>
                            <div class="pcat-results-footer-options">
                                <div class="pcat-results-footer-options-col">
                                    <div id="js-taxonomy-series-product-navigation" class="pcat-results-navigation">
                                        <?php
                                            require_once dirname(dirname(dirname(__FILE__))) . '/inc/zebra-pagination.php';

                                            $pagination = new Zebra_Pagination();
                                            $pagination->records($products_search_count);
                                            $pagination->records_per_page($productPerPage);
                                            $pagination->selectable_pages(5);
                                            $pagination->set_page(1);
                                            $pagination->padding(false);
                                            $pagination->css_classes([
                                                'list' => 'pcat-results-navigation-row',
                                                'list_item' => 'js-ts-product-navigation-item pcat-results-navigation-item',
                                                'prev' => 'js-ts-product-navigation-item pcat-results-navigation-prev',
                                                'next' => 'js-ts-product-navigation-item pcat-results-navigation-next',
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
                                            <select id="js-ts-products-page-list">
                                                <?php
                                                    $pageCounts = $pagination->get_pages();

                                                    for($i = 1; $i <= $pageCounts; $i++){
                                                ?>
                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
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
            </div>
        </section>
<?php
    }

    wp_reset_query();
?>