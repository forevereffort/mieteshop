<?php
    global $post;
    $searchKey = get_search_query();
    $posts_per_page = 8;

    $current_page = 1;

    $args = [
        'post_type' => 'post',
        'search_prod_title' => $searchKey,
        'posts_per_page' => $posts_per_page,
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'desc'
    ];

    $the_query = new WP_Query( $args );

    // get total search result count
    $total_post_count = $the_query->found_posts;

    if ( $the_query->have_posts() ) {
?>
        <section id="js-search-news__results-section" class="blog-result-section" data-nonce="<?php echo wp_create_nonce('filter_search_news_nonce'); ?>" data-search-key="<?php echo $searchKey; ?>">
            <div class="general-container">
                <div class="content-container">
                    <div class="pcat-results-title">
                        <h2>ΤΙΤΛΟΙ: <span id="js-search-book__results-count"><?php echo $total_post_count; ?></span></h2>
                    </div>
                </div>
                <div class="small-container">
                    <div id="js-search-news__results-row" class="blog-result-row">
                        <?php
                            while ( $the_query->have_posts() ){
                                $the_query->the_post();
                                get_template_part('post/loop/loop', 'post-card', [ 'postId' => $post->ID ]);
                            }
                        ?>
                    </div>
                </div>
                <div class="small-container">
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
                    ?>
                </div>
            </div>
        </section>
<?php
    }
?>
<div id="js-search-book__load-spinner" class="load-spinner hide"></div>