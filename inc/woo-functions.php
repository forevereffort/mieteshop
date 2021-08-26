<?php
function mieteshop_add_woocommerce_support(){
    add_theme_support( 'woocommerce' );
}

add_action( 'after_setup_theme', 'mieteshop_add_woocommerce_support' );

// Disable the woocommerce default stylesheet
add_filter( 'woocommerce_enqueue_styles', '__return_false' );

/**
 * Disable WooCommerce block styles (front-end).
 */
add_action( 'wp_enqueue_scripts', function(){
    wp_dequeue_style( 'wc-block-style' );
});

// add custom taxonomies into product
add_action('init', function (){
    $labels = [
        'name'                       => _x('Τύπος', 'Τύπο General Name', 'flynt'),
        'singular_name'              => _x('Τύπο', 'Τύπο Singular Name', 'flynt'),
        'menu_name'                  => __('Τύπο', 'flynt'),
        'all_items'                  => __('All Τύπος', 'flynt'),
        'parent_item'                => __('Parent Τύπο', 'flynt'),
        'parent_item_colon'          => __('Parent Τύπο:', 'flynt'),
        'new_item_name'              => __('New Τύπο Name', 'flynt'),
        'add_new_item'               => __('Add New Τύπο', 'flynt'),
        'edit_item'                  => __('Edit Τύπο', 'flynt'),
        'update_item'                => __('Update Τύπο', 'flynt'),
        'view_item'                  => __('View Τύπο', 'flynt'),
        'separate_items_with_commas' => __('Separate Τύπος with commas', 'flynt'),
        'add_or_remove_items'        => __('Add or remove Τύπος', 'flynt'),
        'choose_from_most_used'      => __('Choose from the most used', 'flynt'),
        'popular_items'              => __('Popular Τύπος', 'flynt'),
        'search_items'               => __('Search Τύπος', 'flynt'),
        'not_found'                  => __('Not Found', 'flynt'),
        'no_terms'                   => __('No Τύπος', 'flynt'),
        'items_list'                 => __('Τύπος list', 'flynt'),
        'items_list_navigation'      => __('Τύπος list navigation', 'flynt'),
    ];
    $args = [
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => false,
        'show_ui'                    => true,
        'show_admin_column'          => false,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
    ];

    register_taxonomy('title_type', ['product'], $args);

    $labels = [
        'name'                       => _x('Σειρές', 'Σειρά General Name', 'flynt'),
        'singular_name'              => _x('Σειρά', 'Σειρά Singular Name', 'flynt'),
        'menu_name'                  => __('Σειρά', 'flynt'),
        'all_items'                  => __('All Σειρές', 'flynt'),
        'parent_item'                => __('Parent Σειρά', 'flynt'),
        'parent_item_colon'          => __('Parent Σειρά:', 'flynt'),
        'new_item_name'              => __('New Σειρά Name', 'flynt'),
        'add_new_item'               => __('Add New Σειρά', 'flynt'),
        'edit_item'                  => __('Edit Σειρά', 'flynt'),
        'update_item'                => __('Update Σειρά', 'flynt'),
        'view_item'                  => __('View Σειρά', 'flynt'),
        'separate_items_with_commas' => __('Separate Σειρές with commas', 'flynt'),
        'add_or_remove_items'        => __('Add or remove Σειρές', 'flynt'),
        'choose_from_most_used'      => __('Choose from the most used', 'flynt'),
        'popular_items'              => __('Popular Σειρές', 'flynt'),
        'search_items'               => __('Search Σειρές', 'flynt'),
        'not_found'                  => __('Not Found', 'flynt'),
        'no_terms'                   => __('No Σειρές', 'flynt'),
        'items_list'                 => __('Σειρές list', 'flynt'),
        'items_list_navigation'      => __('Σειρές list navigation', 'flynt'),
    ];
    $args = [
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => false,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
    ];

    register_taxonomy('series', ['product'], $args);

    $labels = [
        'name'                       => _x('Επιλογές', 'Επιλογή General Name', 'flynt'),
        'singular_name'              => _x('Επιλογή', 'Επιλογή Singular Name', 'flynt'),
        'menu_name'                  => __('Επιλογή', 'flynt'),
        'all_items'                  => __('All Επιλογές', 'flynt'),
        'parent_item'                => __('Parent Επιλογή', 'flynt'),
        'parent_item_colon'          => __('Parent Επιλογή:', 'flynt'),
        'new_item_name'              => __('New Επιλογή Name', 'flynt'),
        'add_new_item'               => __('Add New Επιλογή', 'flynt'),
        'edit_item'                  => __('Edit Επιλογή', 'flynt'),
        'update_item'                => __('Update Επιλογή', 'flynt'),
        'view_item'                  => __('View Επιλογή', 'flynt'),
        'separate_items_with_commas' => __('Separate Επιλογές with commas', 'flynt'),
        'add_or_remove_items'        => __('Add or remove Επιλογές', 'flynt'),
        'choose_from_most_used'      => __('Choose from the most used', 'flynt'),
        'popular_items'              => __('Popular Επιλογές', 'flynt'),
        'search_items'               => __('Search Επιλογές', 'flynt'),
        'not_found'                  => __('Not Found', 'flynt'),
        'no_terms'                   => __('No Επιλογές', 'flynt'),
        'items_list'                 => __('Επιλογές list', 'flynt'),
        'items_list_navigation'      => __('Επιλογές list navigation', 'flynt'),
    ];
    $args = [
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => false,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
    ];

    register_taxonomy('epiloges', ['product'], $args);
});


add_action('wp_ajax_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');
add_action('wp_ajax_nopriv_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');
        
function woocommerce_ajax_add_to_cart() {
    $product_id = apply_filters('woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
    $quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);
    $variation_id = absint($_POST['variation_id']);
    $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
    $product_status = get_post_status($product_id);

    if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity, $variation_id) && 'publish' === $product_status) {
        do_action('woocommerce_ajax_added_to_cart', $product_id);

        if ('yes' === get_option('woocommerce_cart_redirect_after_add')) {
            wc_add_to_cart_message(array($product_id => $quantity), true);
        }

        WC_AJAX :: get_refreshed_fragments();
    } else {
        $data = [
            'error' => true,
            'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id)
        ];

        echo wp_send_json($data);
    }

    wp_die();
}

// woo add to cart ajax result customize
// we have to use this ajax add to cart
add_filter( 'woocommerce_add_to_cart_fragments', 'mieteshop_header_top_cart_fragments', 10, 1 );
function mieteshop_header_top_cart_fragments( $fragments ) {
    $cart_list = [];
    foreach(WC()->cart->get_cart() as $cart_item){
        $authorIDs = get_field('book_contributors_syggrafeas', $cart_item['data']->get_id());
        $author_list = [];

        if( !empty($authorIDs) ){
            if( count($authorIDs) > 3 ){
                $author_list = 'Συλλογικό Έργο';
            } else {
                foreach( $authorIDs as $authorID ){
                    $author_list[] = [
                        'link' => get_permalink($authorID),
                        'title' => get_the_title($authorID)
                    ];
                }
            }
        }

        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $cart_item['data']->get_id() ), 'full' );

        $cart_list[] = [
            'title' => $cart_item['data']->get_title(),
            'quantity' => $cart_item['quantity'],
            'price' =>  $cart_item['data']->get_price_html(),
            'placeholder' => placeholderImage($image[1], $image[2]),
            'image' => aq_resize($image[0], $image[1], $image[2], true),
            'authors' => $author_list,
        ];
    }

    global $twig;

    if( WC()->cart->get_cart_contents_count() == 0 ){
        $fragments['div#js-header-top-cart-list'] = '<div id="js-header-top-cart-list">Empty</div>';
        $fragments['span#js-header-top-cart-number'] = '<span id="js-header-top-cart-number" class="header-top-cart-number"></span>';
    } else {
        $fragments['div#js-header-top-cart-list'] = $twig->render('header-top-cart-list.twig', ['cart_list' => $cart_list, 'cart_total' => WC()->cart->get_cart_total(), 'cat_page_url' => wc_get_cart_url()]);
        $fragments['span#js-header-top-cart-number'] = '<span id="js-header-top-cart-number" class="header-top-cart-number"><span>' . WC()->cart->get_cart_contents_count() . '</span></span>';
    }

    return $fragments;
}