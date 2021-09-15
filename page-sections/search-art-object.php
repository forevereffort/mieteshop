<?php
    global $post;
    $searchKey = get_search_query();
    $product_per_page = 16;

    if( wp_is_mobile() ){
        $product_per_page = 4;
    }

    $current_page = 1;

    // get all products in current search key
    $args = [
        'post_type' => 'product',
        'search_prod_title' => $searchKey,
        'posts_per_page' => -1,
        'tax_query' => [
            [
                'taxonomy' => 'title_type',
                'field' => 'slug',
                'terms' => 'book',
                'operator' => 'NOT IN',
            ]
        ],
        'fields' => 'ids',
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

    if ( !empty($the_query->posts) ) {
        foreach( $the_query->posts as $postid ) {
            // get author & publisher & product category list that include in the search result
            $authorIDs = get_field('book_contributors_syggrafeas', $postid);
            $publisherIDs = get_field('book_publishers', $postid);
            $prorudct_categories = wp_get_post_terms($postid, 'product_cat', ['fields' => 'id=>name']);

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

            if( !empty($prorudct_categories) ){
                foreach($prorudct_categories as $term_id => $term_name){
                    $product_category_list_in_search_result[$term_id] = $term_name;
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
                        <select id="js-search-art-object__product-category-list" style="width:100%;">
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
                        <select id="js-search-art-object__author-list" style="width:100%;">
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
                        <select id="js-search-art-object__publisher-list" style="width:100%;">
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
                    <select id="js-search-art-object__display-order">
                        <option value="alphabetical">Alphabetical</option>
                        <option value="published-date">Published Date</option>
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
        'offset' => ( $current_page - 1 ) * $product_per_page,
        'tax_query' => [
            [
                'taxonomy' => 'title_type',
                'field' => 'slug',
                'terms' => 'book',
                'operator' => 'NOT IN',
            ]
        ],
        'orderby' => 'title',
        'order' => 'asc',
        'fields' => 'ids'
    ];

    $the_query = new WP_Query( $args );

    if ( !empty($the_query->posts) ) {
?>
        <section id="js-search-art-object__results-section" class="search-results-section" data-nonce="<?php echo wp_create_nonce('filter_search_art_object_nonce'); ?>" data-search-key="<?php echo $searchKey; ?>">
            <div class="general-container">
                <div class="content-container">
                    <div class="pcat-results-title">
                        <h2>ΤΙΤΛΟΙ: <span id="js-search-art-object__results-count"><?php echo $total_product_count; ?></span></h2>
                    </div>
                    <div id="js-search-art-object__results-row" class="pcat-results-row">
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
                        if( $total_product_count > $product_per_page ){
                            get_template_part('product/page-nav/page-nav', 'navigation', [ 
                                'navWrapperDomId' => "js-search-art-object__results-navigation",
                                'navDomClass' => "js-search-art-object__results-navigation-item",
                                'gotoDomId' => "js-search-art-object__page-list",
                                'total' => $total_product_count,
                                'perPage' => $product_per_page
                            ]);
                        }

                        get_template_part('product/page-nav/page-nav', 'per-page', [ 'selectDomId' => "js-search-art-object__per-page" ]);
                    ?>
                </div>
            </div>
        </section>
<?php
    }
?>
<div id="js-search-art-object__load-spinner" class="load-spinner hide"></div>