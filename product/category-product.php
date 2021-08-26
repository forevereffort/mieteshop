<?php
    global $wp_query, $post;

    // get term of current product category page
    $product_cat = $wp_query->get_queried_object();

    // get parent list of term
    $product_cat_parent_list = array_reverse(get_ancestors($product_cat->term_id, 'product_cat'));

    // get level of term
    $product_cat_level = count($product_cat_parent_list) + 1;

    $child_cat_list = get_terms([
        'taxonomy' => 'product_cat', 
        'hide_empty' => false, 
        // 'child_of' => $product_cat->term_id,
        'parent' => $product_cat->term_id,
    ]);

    $product_per_page = 16;

    if( wp_is_mobile() ){
        $product_per_page = 4;
    }

    $current_page = 1;
?>
<section class="breadcrumb-section">
    <div class="content-container">
        <div class="breadcrumb-list">
            <div class="breadcrumb-item"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Βιβλία</a></div>
            <?php
                foreach( $product_cat_parent_list as $parent ){
                    $parent_object = get_term($parent);
            ?>
                    <div class="breadcrumb-item"><a href="<?php echo get_term_link($parent_object->term_id); ?>"><?php echo $parent_object->name; ?></a></div>
            <?php
                }
            ?>
            <div class="breadcrumb-item"><a href="<?php echo get_term_link($product_cat->term_id); ?>"><?php echo $product_cat->name; ?></a></div>
        </div>
    </div>
</section>
<section class="pcat-list-section">
    <div class="content-container">
        <div id="js-pcat-list-title" class="pcat-list-title" data-main-product-cat-id="<?php echo $product_cat->term_id; ?>" data-nonce="<?php echo wp_create_nonce('filter_category_product_nonce'); ?>">
            <h1><?php echo $product_cat->name; ?></h1>
        </div>
        <?php
            if( !empty($child_cat_list) ){
        ?>
                <div class="pcat-list-row">
                    <div class="pcat-list-label">Μετάβαση σε:</div>
                    <div class="pcat-list-col-row">
                        <?php
                            foreach($child_cat_list as $child_cat){
                        ?>
                                <div class="pcat-list-col">
                                    <a href="<?php echo get_term_link($child_cat->term_id); ?>"><?php echo $child_cat->name; ?></a>
                                </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
        <?php
            }
        ?>
    </div>
</section>
<?php
    if( $product_cat_level < 3 && !empty($child_cat_list) ){
?>
        <section class="pcat-filter-section">
            <div class="content-container">
                <div class="pcat-filter-row">
                    <div class="pcat-filter-label">
                        <div class="pcat-filter-label-icon"><?php include get_template_directory() . '/assets/icons/filter-icon.svg'; ?></div>
                        <div class="pcat-filter-label-text">ΦΙΛΤΡΑ</div>
                    </div>
                    <div class="pcat-filter-button">
                        <div id="js-pcat-filter-button-inner" class="pcat-filter-button-inner">
                            <div class="pcat-filter-button-label">Επιλέξτε θεματικά φίλτρα</div>
                            <div class="pcat-filter-button-icon">
                                <div class="pcat-filter-button-icon-inner"><?php include get_template_directory() . '/assets/icons/arrow-down-icon.svg'; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="js-pcat-filter-detail-row" class="pcat-filter-detail-row" data-filter-term-list="" style="display: none;">
                    <?php
                        if( $product_cat_level === 1 ){
                            foreach ($child_cat_list as $child_cat) {
                    ?>
                                <div class="pcat-filter-detail-col">
                                    <?php
                                        $child_child_cat_list = get_terms([
                                            'taxonomy' => 'product_cat', 
                                            'hide_empty' => false, 
                                            // 'child_of' => $child_cat->term_id,
                                            'parent' => $child_cat->term_id,
                                        ]);
                                    ?>
                                    <div class="js-pcat-filter-detail-parent pcat-filter-detail-root" data-term-id="<?php echo $child_cat->term_id; ?>"><?php echo $child_cat->name; ?>
                                        <?php
                                            if( !empty($child_child_cat_list) ){
                                        ?>
                                                <div class="js-pcat-filter-detail-root-icon pcat-filter-detail-root-icon"><div class="pcat-filter-detail-root-icon-wrapper"><?php include get_template_directory() . '/assets/icons/arrow-down-icon.svg'; ?></div></div>
                                        <?php
                                            }
                                        ?>
                                    </div>
                                    <?php
                                        if( !empty($child_child_cat_list) ){
                                    ?>
                                            <div class="pcat-filter-detail-child-wrapper">
                                                <?php
                                                    foreach ($child_child_cat_list as $child_child_cat) {
                                                ?>
                                                        <div class="js-pcat-filter-detail-child pcat-filter-detail-child" data-term-id="<?php echo $child_child_cat->term_id; ?>"><?php echo $child_child_cat->name; ?></div>
                                                <?php
                                                    }
                                                ?>
                                            </div>
                                    <?php
                                        }
                                    ?>
                                </div>
                    <?php
                            }
                        } else if( $product_cat_level === 2 ) {
                    ?>
                            <div class="pcat-filter-detail-col">
                                <?php

                                    foreach ($child_cat_list as $child_cat) {
                                ?>
                                        <div class="js-pcat-filter-detail-child pcat-filter-detail-child" data-term-id="<?php echo $child_cat->term_id; ?>"><?php echo $child_cat->name; ?></div>
                                <?php
                                    }
                                ?>
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
<div class="pcat-extra-filter-section">
    <div class="content-container">
        <div id="js-pcat-extra-thematic-filter" class="pcat-extra-thematic-filter hide">
            <div id="js-pcat-extra-thematic-filter-title" class="pcat-extra-thematic-filter-title">ΘΕΜΑΤΙΚΑ ΦΙΛΤΡΑ (<span>5</span>)</div>
            <div id="js-pcat-extra-thematic-filter-row" class="pcat-extra-thematic-filter-row">
            </div>
            <div class="pcat-extra-thematic-filter-link">
                <a id="js-pcat-extra-thematic-filter-link-clear" href="#">καθαρισμός φίλτρων</a>
            </div>
        </div>
        <div class="pcat-extra-filter-top-row">Επιλέξτε</div>
        <div class="pcat-extra-filter-row">
            <div class="pcat-extra-filter-left-col">
                <div class="pcat-author-publisher-choice-wrapper">
                    <div class="pcat-author-publisher-choice-row">
                        <div class="pcat-author-publisher-choice-col">
                            <div class="pcat-author-publisher-choice-item">
                                <label>Συγγραφέα<input type="radio" name="radio-pcat-author-publisher-choice-item" class="js-pcat-author-publisher-choice-item" value="author" checked><span></span></label>
                            </div>
                        </div>
                        <div class="pcat-author-publisher-choice-col">
                            <div class="pcat-author-publisher-choice-item">
                                <label>Εκδότη<input type="radio" name="radio-pcat-author-publisher-choice-item" class="js-pcat-author-publisher-choice-item" value="publisher"><span></span></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pcat-author-publisher-select-wrapper">
                    <?php
                        // get all products in current category
                        $args = [
                            'post_type' => 'product',
                            'tax_query' => [
                                [
                                    'taxonomy' => 'product_cat',
                                    'field' => 'term_id',
                                    'terms' => $product_cat->term_id,
                                ],
                            ],
                            'posts_per_page' => -1,
                            'fields' => 'ids',
                        ];
                    
                        $loop = new WP_Query( $args );

                        // get total search result count
                        $total_product_count = $loop->found_posts;

                        // get author list that included in search result
                        $author_list_in_search_result = [];

                        // get publisher list that included in search result
                        $publisher_list_in_search_result = [];
                    
                        if ( !empty($loop->posts) ) {
                            foreach( $loop->posts as $postid ) {
                                // get author & publisher list that include in the search result
                                $authorIDs = get_field('book_contributors_syggrafeas', $postid);
                                $publisherIDs = get_field('book_publishers', $postid);

                                if( !empty($authorIDs) ){
                                    foreach($authorIDs as $authorID){
                                        $author_list_in_search_result[$authorID] = get_the_title($authorID);
                                    }
                                }

                                if( !empty($publisherIDs) ){
                                    foreach($publisherIDs as $publisherID){
                                        $publisher_list_in_search_result[$publisherID] = get_the_title($publisherID);
                                    }
                                }
                            }

                            // sort array by value
                            asort($author_list_in_search_result);
                            asort($publisher_list_in_search_result);
                        }
                    ?>
                    <div id="js-pcat-author-list-wrapper" class="pcat-author-publisher-select">
                        <select id="js-pcat-author-list" style="width:100%;">
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
                    <div id="js-pcat-publisher-list-wrapper" class="pcat-author-publisher-select hide">
                        <select id="js-pcat-publisher-list" style="width:100%;">
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
            <div class="pcat-extra-filter-right-col">
                <div class="pcat-classification-filter">
                    <div class="pcat-classification-filter-label">ΤΑΞΙΝΟΜΗΣΗ</div>
                    <div class="pcat-classification-filter-select">
                        <select id="js-pcat-product-display-order">
                            <option value="published-date">Published Date</option>
                            <option value="alphabetical">Alphabetical</option>
                        </select>
                        <div class="pcat-classification-filter-select-icon"><?php include get_template_directory() . '/assets/icons/arrow-down-white-icon.svg'; ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    // get products of selected category by page
    $args = [
        'post_type' => 'product',
        'tax_query' => [
            [
                'taxonomy' => 'product_cat',
                'field' => 'term_id',
                'terms' => $product_cat->term_id,
            ],
        ],
        'posts_per_page' => $product_per_page,
        'offset' => ( $current_page - 1 ) * $product_per_page,
        'orderby' => 'title',
        'order' => 'asc',
    ];

    $the_query = new WP_Query( $args );

    if ( $the_query->have_posts() ) {
?>
        <section id="js-pcat-results-section" class="pcat-results-section">
            <div class="general-container">
                <div class="content-container">
                    <div class="pcat-results-title">
                        <h2>ΤΙΤΛΟΙ: <span id="js-pcat-results-count"><?php echo $total_product_count; ?></span></h2>
                    </div>
                    <div id="js-pcat-results-row" class="pcat-results-row">
                        <?php
                            while ( $the_query->have_posts() ){
                                $the_query->the_post();
                                global $product;

                                $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
                                $authorIDs = get_field('book_contributors_syggrafeas', $post->ID);
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
                                            <div><?php echo do_shortcode('[yith_wcwl_add_to_wishlist]'); ?></div>
                                            <div class="pcat-result-item-meta-row">
                                                <div class="pcat-result-item-meta-col">
                                                    <div class="pcat-result-item-favorite">
                                                        <a href="#"><span><?php include get_template_directory() . '/assets/icons/favorite-small-icon.svg' ?></span></a>
                                                    </div>
                                                </div>
                                                <div class="pcat-result-item-meta-col">
                                                    <?php
                                                        
                                                        if( !$product->is_purchasable() ||  !$product->is_in_stock() ){
                                                            ?>
                                                            <span><?php include get_template_directory() . '/assets/icons/busket-small-icon.svg' ?></span>
                                                            <?php
                                                            //if( !$product->is_purchasable() ){
                                                            //    echo '<span style="color:red">Μη διαθέσιμο</span>';
                                                            //} elseif ( !$product->is_in_stock() ) {
                                                            //    echo '<span style="color:red">Εξαντλημένο</span>';
                                                            //}
                                                        } else {                                                            
                                                    ?>
                                                            <div class="pcat-result-item-busket">
                                                                <a class="js-mieteshop-add-to-cart" href="#" data-quantity="1" data-product_id="<?php echo $product->get_id(); ?>" data-variation_id="0" data-product_sku="<?php echo $product->get_sku(); ?>"><span><?php include get_template_directory() . '/assets/icons/busket-small-icon.svg' ?></span></a>
                                                            </div>
                                                    <?php
                                                        }
                                                    ?>
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
                                            <div class="pcat-result-item-title"><h3><a href="<?php echo get_permalink($post->ID); ?>"><?php echo $post->post_title; ?></a></h3></div>
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
                        if( $total_product_count > $product_per_page ){
                    ?>
                            <div class="pcat-results-footer-options">
                                <div class="pcat-results-footer-options-col">
                                    <div id="js-pcat-results-navigation" class="pcat-results-navigation">
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
                                                'list_item' => 'js-pcat-results-navigation-item pcat-results-navigation-item',
                                                'prev' => 'js-pcat-results-navigation-item pcat-results-navigation-prev',
                                                'next' => 'js-pcat-results-navigation-item pcat-results-navigation-next',
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
                                            <select id="js-pcat-products-page-list">
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
                    <div class="pcat-results-projection-options">
                        <div class="pcat-results-footer-select">
                            <div class="pcat-results-footer-select-label">Προβολή</div>
                            <div class="pcat-results-footer-select-elem">
                                <select id="js-pcat-products-per-page">
                                    <?php
                                        if( wp_is_mobile() ){
                                    ?>
                                            <option value="4">4</option>
                                    <?php
                                        }
                                    ?>
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
<div id="js-category-product-filter-load-spinner" class="load-spinner hide"></div>