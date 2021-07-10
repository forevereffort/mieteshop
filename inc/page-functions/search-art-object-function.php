<?php
add_action('wp_ajax_filter_search_art_object', 'filterSearchArtObjectFunc');
add_action('wp_ajax_nopriv_filter_search_art_object', 'filterSearchArtObjectFunc');

function filterSearchArtObjectFunc()
{
    if (!wp_verify_nonce($_REQUEST['nonce'], 'filter_search_art_object_nonce')) {
        exit('No naughty business please');
    }

    $result = [];
    
    $filterTermId = intval($_REQUEST['filterTermId']);
    $searchKey = $_REQUEST['searchKey'];
    $filterAuthorId = intval($_REQUEST['filterAuthorId']);
    $filterPublisherId = intval($_REQUEST['filterPublisherId']);
    $page = intval($_REQUEST['page']);
    $productPerPage = intval($_REQUEST['productPerPage']);

    require_once dirname(dirname(__FILE__)) . '/zebra-pagination.php';

    $pagination = new Zebra_Pagination();
    $pagination->records_per_page($productPerPage);
    $pagination->selectable_pages(5);
    $pagination->set_page($page);
    $pagination->padding(false);
    $pagination->css_classes([
        'list' => 'pcat-results-navigation-row',
        'list_item' => 'js-search-art-object__results-navigation-item pcat-results-navigation-item',
        'prev' => 'js-search-art-object__results-navigation-item pcat-results-navigation-prev',
        'next' => 'js-search-art-object__results-navigation-item pcat-results-navigation-next',
        'anchor' => '',
    ]);

    // default tax query is for the current category page cat id
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
        ]
    ];

    // if there is any of filter term id, change tax query
    if( !empty($filterTermId) ){
        $args['tax_query']['relation'] = 'AND';
        
        $args['tax_query'][] = [
            'taxonomy' => 'product_cat',
            'field' => 'term_id',
            'terms' => $filterTermId
        ];
    }

    $products_search_count = 0;
    $products_search_list = [];
    
    global $post;
    
    if( empty($filterAuthorId) && empty($filterPublisherId) ){
        // if there are no any option of filter author & publisher
        // search will work only for tax query
        $args['posts_per_page'] = $productPerPage;
        $args['offset'] = ( $page - 1 ) * $productPerPage;
        
        $the_query = new WP_Query( $args );

        // get total search result count
        $products_search_count = $the_query->found_posts;

        if ( $the_query->have_posts() ) {
            while ( $the_query->have_posts() ) {
                $the_query->the_post();

                global $product;

                $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
                $authors = get_field('book_contributors_syggrafeas', $post->ID);
                $author_list = [];

                foreach( $authors as $author ){
                    $author_list[] = [
                        'url' => get_permalink($author->ID),
                        'title' => $author->post_title
                    ];
                }

                $products_search_list[] = [
                    'url' => get_permalink($post->ID),
                    'placeholder' => placeholderImage($image[1], $image[2]),
                    'image_url' => aq_resize($image[0], $image[1], $image[2], true),
                    'title' => $post->post_title,
                    'authors' => $author_list,
                    'price' => $product->get_price_html()
                ];
            }
        }
    } else {
        // filter author and publisher
        $the_query = new WP_Query( $args );
        $products_all_list = [];

        if ( $the_query->have_posts() ) {
            while ( $the_query->have_posts() ) {
                $the_query->the_post();

                // check author & publisher with filter value in the searched result by category
                $filter_author_status = empty($filterAuthorId) ? true : false;
                $filter_publisher_status = empty($filterPublisherId) ? true : false;

                if( !empty($filterAuthorId) ){
                    $authors = get_field('book_contributors_syggrafeas', $post->ID);

                    if( !empty($authors) ){
                        foreach( $authors as $author ){
                            if( $author->ID === $filterAuthorId ){
                                $filter_author_status = true;
                            }
                        }
                    }
                }

                if( !empty($filterPublisherId) ){
                    $publishers = get_field('book_publishers', $post->ID);

                    if( !empty($publishers) ){
                        foreach( $publishers as $publisher ){
                            if( $publisher->ID === $filterPublisherId ){
                                $filter_publisher_status = true;
                            }
                        }
                    }
                }

                // check passed with filter author & publisher
                if( $filter_author_status && $filter_publisher_status ){
                    $products_all_list[] = $post->ID;
                }
            }
        }

        // get all search result that is filtered by term, author, publisher
        $products_search_count = count($products_all_list);

        // get page nav info
        $products_id_list_of_selected_page = array_slice($products_all_list, ($page - 1) * $productPerPage, $productPerPage);

        foreach($products_id_list_of_selected_page as $product_id){
            $product = wc_get_product( $product_id );

            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $product_id ), 'full' );
            $authors = get_field('book_contributors_syggrafeas', $product_id);
            $author_list = [];

            foreach( $authors as $author ){
                $author_list[] = [
                    'url' => get_permalink($author->ID),
                    'title' => $author->post_title
                ];
            }

            $products_search_list[] = [
                'url' => get_permalink($product_id),
                'placeholder' => placeholderImage($image[1], $image[2]),
                'image_url' => aq_resize($image[0], $image[1], $image[2], true),
                'title' => get_the_title($product_id),
                'authors' => $author_list,
                'price' => $product->get_price_html()
            ];
        }
    }
    
    $pagination->records($products_search_count);
    
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        global $twig;

        $result = json_encode([
            'count' => $products_search_count,
            'result' => $twig->render('search-art-object-result.twig', ['products' => $products_search_list]),
            'navigation' => $pagination->render(true),
            // 'arg' => $args
        ]);

        echo $result;
    } else {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }

    die();
}