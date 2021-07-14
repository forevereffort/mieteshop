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