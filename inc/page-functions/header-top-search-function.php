<?php
// add wp_query arg to search only in title
function title_filter( $where, $wp_query ){
    global $wpdb;
    if ( $search_term = $wp_query->get( 'search_prod_title' ) ) {
        $where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'%' . esc_sql( like_escape( $search_term ) ) . '%\'';
    }
    return $where;
}

add_filter( 'posts_where', 'title_filter', 10, 2 );

add_action('wp_ajax_header_top_search', 'headerTopSearchFuc');
add_action('wp_ajax_nopriv_header_top_search', 'headerTopSearchFuc');

function headerTopSearchFuc()
{
    if (!wp_verify_nonce($_REQUEST['nonce'], 'header_top_search_nonce')) {
        exit('No naughty business please');
    }
    
    $searchKey = $_REQUEST['searchKey'];

    $child_cat_search_list = get_terms([
        'taxonomy' => 'product_cat', 
        'hide_empty' => false, 
        'name__like' => $searchKey
    ]);

    $child_cat_list = [];
    $child_cat_list_count = count($child_cat_search_list);

    foreach( $child_cat_search_list as $key => $cat ){
        if( $key > 3 ){
            break;
        }

        $product_cat_parent_list = array_reverse(get_ancestors($cat->term_id, 'product_cat'));

        $term_list = [];
        foreach( $product_cat_parent_list as $parent ){
            $parent_object = get_term($parent);

            $term_list[] = [
                'title' => $parent_object->name,
                'url' => get_term_link($parent_object->term_id)
            ];
        }

        $term_list[] = [
            'title' => $cat->name,
            'url' => get_term_link($cat->term_id)
        ];

        $child_cat_list[] = $term_list;
    }

    global $post;

    $the_query = new WP_Query([
        'post_type' => 'publisher',
        'posts_per_page' => 4,
        // 's' => $searchKey
        'search_prod_title' => $searchKey
    ]);

    $publisher_list = [];
    $publisher_list_count = $the_query->found_posts;
 
    if ( $the_query->have_posts() ) {
        while ( $the_query->have_posts() ) {
            $the_query->the_post();

            $publisher_list[] = [
                'title' => $post->post_title,
                'url' => get_permalink($post->ID),
            ];
        }
    }

    wp_reset_postdata();

    $the_query = new WP_Query([
        'post_type' => 'contributor',
        'posts_per_page' => 4,
        // 's' => $searchKey
        'search_prod_title' => $searchKey
    ]);

    $contributor_list = [];
    $contributor_list_count = $the_query->found_posts;
 
    if ( $the_query->have_posts() ) {
        while ( $the_query->have_posts() ) {
            $the_query->the_post();

            $contributor_list[] = [
                'title' => $post->post_title,
                'url' => get_permalink($post->ID),
            ];
        }
    }

    wp_reset_postdata();

    $the_query = new WP_Query([
        'post_type' => 'product',
        'posts_per_page' => 4,
        // 's' => $searchKey,
        'search_prod_title' => $searchKey,
        'tax_query' => [
            [
                'taxonomy' => 'title_type',
                'field' => 'slug',
                'terms' => 'book',
            ]
        ]
    ]);

    $product_book_list = [];
    $product_book_list_count = $the_query->found_posts;
 
    if ( $the_query->have_posts() ) {
        while ( $the_query->have_posts() ) {
            $the_query->the_post();

            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );

            $authors = get_field('book_contributors_syggrafeas', $post->ID);

            $author_list = [];

            foreach( $authors as $author ){
                $author_list[] = [
                    'url' => get_permalink($author->ID),
                    'title' => $author->post_title
                ];
            }

            $product_book_list[] = [
                'title' => $post->post_title,
                'url' => get_permalink($post->ID),
                'placeholder' => placeholderImage($image[1], $image[2]),
                'imageurl' => aq_resize($image[0], $image[1], $image[2], true),
                'authors' => $author_list,
            ];
        }
    }

    wp_reset_postdata();

    $the_query = new WP_Query([
        'post_type' => 'product',
        'posts_per_page' => 4,
        // 's' => $searchKey,
        'search_prod_title' => $searchKey,
        'tax_query' => [
            [
                'taxonomy' => 'title_type',
                'field' => 'slug',
                'terms' => 'book',
                'operator' => 'NOT IN',
            ]
        ]
    ]);

    $product_art_object_list = [];
    $product_art_object_list_count = $the_query->found_posts;
 
    if ( $the_query->have_posts() ) {
        while ( $the_query->have_posts() ) {
            $the_query->the_post();

            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );

            $authors = get_field('book_contributors_syggrafeas', $post->ID);

            $author_list = [];

            foreach( $authors as $author ){
                $author_list[] = [
                    'url' => get_permalink($author->ID),
                    'title' => $author->post_title
                ];
            }

            $product_art_object_list[] = [
                'title' => $post->post_title,
                'url' => get_permalink($post->ID),
                'placeholder' => placeholderImage($image[1], $image[2]),
                'imageurl' => aq_resize($image[0], $image[1], $image[2], true),
                'authors' => $author_list,
            ];
        }
    }

    wp_reset_postdata();
    
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        global $twig;

        $result = json_encode([
            'result' => $twig->render(
                'header-top-search-result.twig',
                [
                    'child_cat_list' => $child_cat_list,
                    'child_cat_list_count' => $child_cat_list_count,
                    'publisher_list' => $publisher_list,
                    'publisher_list_count' => $publisher_list_count,
                    'contributor_list' => $contributor_list,
                    'contributor_list_count' => $contributor_list_count,
                    'product_book_list' => $product_book_list,
                    'product_book_list_count' => $product_book_list_count,
                    'product_art_object_list' => $product_art_object_list,
                    'product_art_object_list_count' => $product_art_object_list_count,
                    'search_key' => $searchKey,
                    'site_url' => get_site_url()
                ]
            ),
        ]);

        echo $result;
    } else {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }

    die();
}