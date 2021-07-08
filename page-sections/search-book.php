<?php
    global $post;
    $searchKey = get_search_query();
    $product_per_page = 16;
    $current_page = 1;

    // get all products in current search key
    $args = [
        'post_type' => 'product',
        'search_prod_title' => $searchKey,
        'posts_per_page' => -1
    ];

    $the_query = new WP_Query( $args );

    // get total search result count
    $total_product_count = $the_query->found_posts;

    // get author list that included in search result
    $author_list_in_search_result = [];

    // get publisher list that included in search result
    $publisher_list_in_search_result = [];

    // get product category list that included in search result
    $product_category_list_in_search_result = [];

    if ( $the_query->have_posts() ) {
        while ( $the_query->have_posts() ){
            $the_query->the_post();

            // get author & publisher & product category list that include in the search result
            $authors = get_field('book_contributors_syggrafeas', $post->ID);
            $publishers = get_field('book_publishers', $post->ID);
            $prorudct_categories = get_the_terms($post->ID, 'product_cat');

            if( !empty($authors) ){
                foreach($authors as $author){
                    $author_list_in_search_result[$author->ID] = $author->post_title;
                }
            }

            if( !empty($publishers) ){
                foreach($publishers as $publisher){
                    $publisher_list_in_search_result[$publisher->ID] = $publisher->post_title;
                }
            }

            if( !empty($prorudct_categories) ){
                foreach($prorudct_categories as $cat){
                    $product_category_list_in_search_result[$cat->term_id] = $cat->name;
                }
            }
        }

        // sort array by value
        asort($author_list_in_search_result);
        asort($publisher_list_in_search_result);
        asort($product_category_list_in_search_result);
    }
?>
<section class="search-page-filter-options-section">
    <div class="search-page-extra-filter-row">
        <div class="search-page-extra-filter-left">
            <div class="pcat-author-publisher-label pcat-author-publisher-label--black">Για να περιορίσετε τα αποτελέσματα επιλέξτε Θεματική ή Συγγραφέα  ή Εκδότη</div>
            <div class="pcat-author-publisher-row">
                <div class="pcat-author-publisher-col">
                    <div class="pcat-author-publisher-select">
                        <select id="js-search-book__product-category-list" style="width:100%;">
                            <option></option>
                            <?php
                                foreach($product_category_list_in_search_result as $cat_id => $cat_title){
                            ?>
                                    <option value="<?php echo $cat_id; ?>"><?php echo $cat_title; ?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="pcat-author-publisher-col">
                    <div class="pcat-author-publisher-select">
                        <select id="js-search-book__author-list" style="width:100%;">
                            <option></option>
                            <?php
                                foreach($author_list_in_search_result as $author_id => $author_title){
                            ?>
                                    <option value="<?php echo $author_id; ?>"><?php echo $author_title; ?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="pcat-author-publisher-col">
                    <div class="pcat-author-publisher-select">
                        <select id="js-search-book__publisher-list" style="width:100%;">
                            <option></option>
                            <?php
                                foreach($publisher_list_in_search_result as $publisher_id => $publisher_title){
                            ?>
                                    <option value="<?php echo $publisher_id; ?>"><?php echo $publisher_title; ?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="search-page-extra-filter-right">
            <div class="pcat-classification-filter">
                <div class="pcat-classification-filter-label pcat-classification-filter-label--black">ΤΑΞΙΝΟΜΗΣΗ</div>
                <div class="pcat-classification-filter-select">
                    <select>
                        <option value="-1">Χρονολογική</option>
                        <option value="price-low-to-high">Price low to high</option>
                        <option value="price-high-to-low">Price high to low</option>
                        <option value="alphabetical">Alphabetical</option>
                    </select>
                    <div class="pcat-classification-filter-select-icon"><?php include get_template_directory() . '/assets/icons/arrow-down-white-icon.svg'; ?></div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
    $args = [
        'post_type' => 'product',
        'search_prod_title' => $searchKey,
        'posts_per_page' => $product_per_page,
        'offset' => ( $current_page - 1 ) * $product_per_page
    ];

    $the_query = new WP_Query( $args );

    if ( $the_query->have_posts() ) {
?>
        <section class="search-results-section">
            <div class="general-container">
                <div class="content-container">
                    <div class="pcat-results-title">
                        <h2>ΤΙΤΛΟΙ: <span><?php echo $total_product_count; ?></span></h2>
                    </div>
                    <div class="pcat-results-row">
                        <?php
                            while ( $the_query->have_posts() ){
                                $the_query->the_post();
                                global $product;

                                $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
                                $authors = get_field('book_contributors_syggrafeas', $post->ID);
                        ?>
                                <div class="pcat-results-col">
                                    <div class="pcat-result-item">
                                        <div class="pcat-result-item-info">
                                            <div class="pcat-result-item-image">
                                                <a href="<?php echo get_permalink($post->ID); ?>">
                                                    <img
                                                        class="lazyload"
                                                        src="<?php echo placeholderImage($image[1], $image[2]); ?>"
                                                        data-src="<?php echo aq_resize($image[0], $image[1], $image[2], true); ?>"
                                                        alt="<?php echo $post->post_title; ?>">
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
                                            <div class="pcat-result-item-title"><h3><a href="<?php echo get_permalink($post->ID); ?>"><?php echo $post->post_title; ?></a></h3></div>
                                        </div>
                                        <div class="pcat-result-item-footer-row">
                                            <div class="pcat-result-item-footer-col">
                                                <div class="pcat-result-item-footer-product-price">
                                                    <?php echo $product->get_price_html(); ?>
                                                </div>
                                            </div>
                                            <div class="pcat-result-item-footer-col">
                                                <div class="pcat-result-item-footer-product-discount">-30%</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                            wp_reset_query();
                        ?>
                    </div>
                    <?php
                        if( $total_product_count > $product_per_page ){
                    ?>
                            <div class="pcat-results-footer-options">
                                <div class="pcat-results-footer-options-col">
                                    <div class="pcat-results-navigation">
                                        <?php
                                            require_once dirname(dirname(__FILE__)) . '/inc/zebra-pagination.php';

                                            $pagination = new Zebra_Pagination();
                                            $pagination->records($total_product_count);
                                            $pagination->records_per_page($product_per_page);
                                            $pagination->selectable_pages(5);
                                            $pagination->set_page(1);
                                            $pagination->padding(false);
                                            $pagination->css_classes([
                                                'list' => 'pcat-results-navigation-row',
                                                'list_item' => 'js-search-results-navigation-item pcat-results-navigation-item',
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
                                            <select>
                                                <option value="1">1</option>
                                            </select>
                                            <div class="pcat-results-footer-select-elem-icon"><?php include get_template_directory() . '/assets/icons/arrow-down-icon.svg'; ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    ?>
                    <div class="pcat-results-projection-options">
                        <div class="pcat-results-footer-select">
                            <div class="pcat-results-footer-select-label">Προβολή</div>
                            <div class="pcat-results-footer-select-elem">
                                <select>
                                    <option value="16">16</option>
                                    <option value="32">32</option>
                                    <option value="64">64</option>
                                </select>
                                <div class="pcat-results-footer-select-elem-icon"><?php include get_template_directory() . '/assets/icons/arrow-down-icon.svg'; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
<?php
    }
?>