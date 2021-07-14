<?php
add_action('wp_ajax_filter_single_publisher_product', 'filterSinglePublisherProductFunc');
add_action('wp_ajax_nopriv_filter_single_publisher_product', 'filterSinglePublisherProductFunc');

function filterSinglePublisherProductFunc()
{
    if (!wp_verify_nonce($_REQUEST['nonce'], 'filter_single_publisher_product_nonce')) {
        exit('No naughty business please');
    }

    $result = [];
    
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
        'list_item' => 'js-sp-product-navigation-item pcat-results-navigation-item',
        'prev' => 'js-sp-product-navigation-item pcat-results-navigation-prev',
        'next' => 'js-sp-product-navigation-item pcat-results-navigation-next',
        'anchor' => '',
    ]);
    
    global $post;

    // get all products
    $args = [
        'post_type' => 'product',
        'posts_per_page' => -1
    ];
    
    $the_query = new WP_Query( $args );
    
    // get product that has this single publiser
    $product_list_include_single_publisher = [];

    if ( $the_query->have_posts() ) {
        while ( $the_query->have_posts() ) {
            $the_query->the_post();

            if( !empty($filterPublisherId) ){
                $publishers = get_field('book_publishers', $post->ID);

                if( !empty($publishers) ){
                    foreach( $publishers as $publisher ){
                        if( $publisher->ID === $filterPublisherId ){
                            $product_list_include_single_publisher[] = $post->ID;
                        }
                    }
                }
            }
        }
    }

    $count_product_list_include_single_publisher = count($product_list_include_single_publisher);
    $product_list_include_single_publisher_of_selected_page = array_slice($product_list_include_single_publisher, ($page - 1) * $productPerPage, $productPerPage);

    foreach($product_list_include_single_publisher_of_selected_page as $product_id){
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
    
    $pagination->records($count_product_list_include_single_publisher);
    
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        global $twig;

        $result = json_encode([
            'result' => $twig->render('single-publisher-product-result.twig', ['products' => $products_search_list]),
            'navigation' => $pagination->render(true),
        ]);

        echo $result;
    } else {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }

    die();
}