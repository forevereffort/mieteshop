<?php
    global $post;

    $productPerPage = 16;

    if( wp_is_mobile() ){
        $productPerPage = 4;
    }

    $page = 1;
?>
<section id="js-single-contributor-books" class="single-product-recently-section single-product-recently-section--border-bottom">
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
                    ],
                    'orderby' => 'title',
                    'order' => 'asc',
                    'fields' => 'ids'
                ];

                $loop = new WP_Query( $args );

                $count_product_list_include_single_contributor = $loop->found_posts;

                foreach ( $loop->posts as $postid ){
            ?>
                    <div class="pcat-results-col">
                        <?php get_template_part('product/loop/loop', 'product-card', [ 'postId' => $postid ]); ?>
                    </div>
            <?php
                }
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