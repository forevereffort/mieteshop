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
    $productOrder = $_REQUEST['productOrder'];
    $filterAuthorId = intval($_REQUEST['filterAuthorId']);
    $filterPublisherId = intval($_REQUEST['filterPublisherId']);
    $mainProductCatId = intval($_REQUEST['mainProductCatId']);
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
        'list_item' => 'js-pcat-results-navigation-item pcat-results-navigation-item',
        'prev' => 'js-pcat-results-navigation-item pcat-results-navigation-prev',
        'next' => 'js-pcat-results-navigation-item pcat-results-navigation-next',
        'anchor' => '',
    ]);

    // default tax query is for the current category page cat id
    $args = [
        'post_type' => 'product',
        'tax_query' => [
            [
                'taxonomy' => 'product_cat',
                'field' => 'term_id',
                'terms' => $mainProductCatId
            ],
        ],
        'posts_per_page' => $productPerPage,
        'offset' => ( $page - 1 ) * $productPerPage,
    ];

    // if there is any of filter term id, change tax query
    if( !empty($filterTermIds) ){
        $args['tax_query'] = [
            [
                'taxonomy' => 'product_cat',
                'field' => 'term_id',
                'terms' => explode(',', $filterTermIds)
            ],
        ];
    }

    if( !empty($filterAuthorId) ){
        $args['meta_query'] = [
			[
				'key'     => 'book_contributors_syggrafeas',
				'value'   => '"' . $filterAuthorId . '"',
				'compare' => 'LIKE'
            ],
        ];
    }

    if( !empty($filterPublisherId) ){
        $args['meta_query'] = [
			[
				'key'     => 'book_publishers',
				'value'   => '"' . $filterPublisherId . '"',
				'compare' => 'LIKE'
            ],
        ];
    }

    if( $productOrder === 'published-date' ){
        $args['orderby'] = 'title';
        $args['order'] = 'asc';
    } else if( $productOrder === 'alphabetical' ){
        $args['orderby'] = 'title';
        $args['order'] = 'desc';
    }

    $products_search_count = 0;
    $products_search_list = [];
    
    global $post;
    
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
                'id' => $post->ID,
                'url' => get_permalink($post->ID),
                'placeholder' => placeholderImage($image[1], $image[2]),
                'image_url' => aq_resize($image[0], $image[1], $image[2], true),
                'title' => $post->post_title,
                'authors' => $author_list,
                'price' => $product->get_price_html(),
                'sku' => $product->get_sku(),
            ];
        }
    }
    
    $pagination->records($products_search_count);
    
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        global $twig;

        $result = json_encode([
            'count' => $products_search_count,
            'result' => $twig->render('category-product-search-result.twig', ['products' => $products_search_list]),
            'navigation' => $pagination->render(true),
            'pageCounts' => $pagination->get_pages(),
            'productOrder' => $productOrder,
            // 'arg' => $args
        ]);

        echo $result;
    } else {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }

    die();
}