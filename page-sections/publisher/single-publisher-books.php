<?php
    global $post;

    $productPerPage = 16;

    if( wp_is_mobile() ){
        $productPerPage = 4;
    }

    $page = 1;
    // get book that this single publiser was included
    $current_single_publisher_id = $post->ID;

    // get all products that has this single publiser
    $args = [
        'post_type' => 'product',
        'posts_per_page' => $productPerPage,
        'offset' => ($page - 1) * $productPerPage,
        'meta_query' => [
			[
				'key'     => 'book_publishers',
				'value'   => '"' . $current_single_publisher_id . '"',
				'compare' => 'LIKE'
            ],
        ],
        'orderby' => 'title',
        'order' => 'asc',
        'fields' => 'ids'
    ];

    $the_query = new WP_Query( $args );

    if ( !empty($the_query->posts) ) {
        $count_product_list_include_single_publisher = $the_query->found_posts;
?>
        <section id="js-single-publisher-book-list-section" class="pcat-results-section">
            <div class="general-container">
                <div class="content-container">
                    <div class="pcat-results-top-title">
                        <h2>ΒΙΒΛΙΑ</h2>
                    </div>
                    <div class="pcat-results-top-row">
                        <div class="pcat-results-top-left-col">
                            <div class="pcat-results-title">
                                <h2>ΤΙΤΛΟΙ: <?php echo $count_product_list_include_single_publisher; ?></h2>
                            </div>
                        </div>
                        <div class="pcat-results-top-right-col">
                            <div class="pcat-classification-filter">
                                <div class="pcat-classification-filter-label pcat-classification-filter-label--black">ΤΑΞΙΝΟΜΗΣΗ</div>
                                <div class="pcat-classification-filter-select">
                                    <select id="js-sp-product-display-order">
                                        <option value="published-date">Published Date</option>
                                        <option value="alphabetical">Alphabetical</option>
                                    </select>
                                    <div class="pcat-classification-filter-select-icon"><?php include get_template_directory() . '/assets/icons/arrow-down-white-icon.svg'; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="js-single-publisher-product-row" class="pcat-results-row" data-nonce="<?php echo wp_create_nonce('filter_single_publisher_product_nonce'); ?>" data-product-per-page="<?php echo $productPerPage; ?>" data-publisher-id="<?php echo $current_single_publisher_id; ?>">
                        <?php
                            foreach( $the_query->posts as $postid ) {
                        ?>
                                <div class="pcat-results-col">
                                    <?php get_template_part('product/loop/loop', 'product-card', [ 'postId' => $postid ]); ?>
                                </div>
                        <?php
                            }
                        ?>
                    </div>
                    <?php
                        if( $count_product_list_include_single_publisher > $productPerPage ){
                    ?>
                            <div class="pcat-results-footer-options">
                                <div class="pcat-results-footer-options-col">
                                    <div id="js-single-publisher-product-navigation" class="pcat-results-navigation">
                                        <?php
                                            require_once dirname(dirname(dirname(__FILE__))) . '/inc/zebra-pagination.php';

                                            $pagination = new Zebra_Pagination();
                                            $pagination->records($count_product_list_include_single_publisher);
                                            $pagination->records_per_page($productPerPage);
                                            $pagination->selectable_pages(5);
                                            $pagination->set_page(1);
                                            $pagination->padding(false);
                                            $pagination->css_classes([
                                                'list' => 'pcat-results-navigation-row',
                                                'list_item' => 'js-sp-product-navigation-item pcat-results-navigation-item',
                                                'prev' => 'js-sp-product-navigation-item pcat-results-navigation-prev',
                                                'next' => 'js-sp-product-navigation-item pcat-results-navigation-next',
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
                                                $pageCount = round($count_product_list_include_single_publisher / $productPerPage + 0.45);
                                            ?>
                                            <select id="js-sp-page-list">
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
            </div>
        </section>
<?php
    }
?>