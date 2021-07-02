<?php
add_action('wp_ajax_filter_category_product', 'filterCategoryProduct');
add_action('wp_ajax_nopriv_filter_category_product', 'filterCategoryProduct');

function filterCategoryProduct()
{
    if (!wp_verify_nonce($_REQUEST['nonce'], 'filter_category_product_nonce')) {
        exit('No naughty business please');
    }

    $result = [];
    
    $filterTermIds = $_REQUEST['filterTermIds'];
    $filterAuthorId = intval($_REQUEST['filterAuthorId']);
    $filterPublisherId = intval($_REQUEST['filterPublisherId']);

    $product_per_page = 16;
    $current_page = 1;

    $args = [
        'post_type' => 'product',
        'tax_query' => [
            [
                'taxonomy' => 'product_cat',
                'field' => 'term_id',
                'terms' => $filterTermIds
            ],
        ],
        'posts_per_page' => -1
    ];

    $the_query = new WP_Query( $args );

    $products_search_count = $the_query->found_posts;

    $args['posts_per_page'] = $product_per_page;
    $args['offset'] = ( $current_page - 1 ) * $product_per_page;

    $products_search_list = [];
    
    $the_query = new WP_Query( $args );

    if ( $the_query->have_posts() ) {
        while ( $the_query->have_posts() ) {
            $the_query->the_post();

            global $product;

            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $product->get_id() ), 'full' );
            $authors = get_field('book_contributors_syggrafeas', $product->get_id());
            $author_list = [];

            foreach( $authors as $author ){
                $author_list[] = [
                    'url' => get_permalink($author->ID),
                    'title' => $author->post_title
                ];
            }

            $products_search_list[] = [
                'url' => get_permalink($product->get_id()),
                'placeholder' => placeholderImage($image[1], $image[2]),
                'image_url' => aq_resize($image[0], $image[1], $image[2], true),
                'title' => $product->get_name(),
                'authors' => $author_list,
                'price' => $product->get_price_html()
            ];
        }
    }
    
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        // $result = json_encode($result);
        global $twig;

        $result = json_encode([
            'count' => $products_search_count,
            'result' => $twig->render('category-product-search-result.twig', ['products' => $products_search_list])
        ]);
        echo $result;
    } else {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }

    die();
}