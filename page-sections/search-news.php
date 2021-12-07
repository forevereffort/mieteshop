<?php
    global $post;
    $searchKey = get_search_query();
    $posts_per_page = 16;

    if( wp_is_mobile() ){
        $posts_per_page = 4;
    }

    $current_page = 1;

    $args = [
        'post_type' => 'post',
        'search_prod_title' => $searchKey,
        'posts_per_page' => $posts_per_page,
        'offset' => ( $current_page - 1 ) * $posts_per_page,
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'desc'
    ];

    $the_query = new WP_Query( $args );

    // get total search result count
    $total_post_count = $the_query->found_posts;

    if ( $the_query->have_posts() ) {
?>
        <section id="js-search-book__results-section" class="search-results-section" data-nonce="<?php echo wp_create_nonce('filter_search_book_nonce'); ?>" data-search-key="<?php echo $searchKey; ?>">
            <div class="general-container">
                <div class="content-container">
                    <div class="pcat-results-title">
                        <h2>ΤΙΤΛΟΙ: <span id="js-search-book__results-count"><?php echo $total_post_count; ?></span></h2>
                    </div>
                    <div id="js-search-book__results-row" class="pcat-results-row">
                        <?php
                            while ( $the_query->have_posts() ){
                                $the_query->the_post();
                        ?>
                                <div class="pcat-results-col">
                                    <?php get_template_part('product/loop/loop', 'product-card', [ 'postId' => $postid ]); ?>
                                </div>
                        <?php
                            }
                        ?>
                    </div>
                    <?php
                        if( $total_post_count > $posts_per_page ){
                            get_template_part('product/page-nav/page-nav', 'navigation', [ 
                                'navWrapperDomId' => "js-search-book__results-navigation",
                                'navDomClass' => "js-search-book__results-navigation-item",
                                'gotoDomId' => "js-search-book__page-list",
                                'total' => $total_post_count,
                                'perPage' => $posts_per_page
                            ]);
                        }

                        get_template_part('product/page-nav/page-nav', 'per-page', [ 'selectDomId' => "js-search-book__per-page" ]);
                    ?>
                </div>
            </div>
        </section>
<?php
    }
?>
<div id="js-search-book__load-spinner" class="load-spinner hide"></div>