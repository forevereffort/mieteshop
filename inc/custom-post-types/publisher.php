<?php
add_action('init', function (){

    $labels = [
        'name'                  => _x('Εκδότες', 'Auction General Name', 'flynt'),
        'singular_name'         => _x('Εκδότης', 'Εκδότης Singular Name', 'flynt'),
        'menu_name'             => __('Εκδότες', 'flynt'),
        'name_admin_bar'        => __('Εκδότης', 'flynt'),
        'archives'              => __('Item Archives', 'flynt'),
        'attributes'            => __('Item Attributes', 'flynt'),
        'parent_item_colon'     => __('Parent Item:', 'flynt'),
        'all_items'             => __('All Εκδότες', 'flynt'),
        'add_new_item'          => __('Add New Εκδότης', 'flynt'),
        'add_new'               => __('Add New', 'flynt'),
        'new_item'              => __('New Εκδότης', 'flynt'),
        'edit_item'             => __('Edit Εκδότης', 'flynt'),
        'update_item'           => __('Update Εκδότης', 'flynt'),
        'view_item'             => __('View Εκδότης', 'flynt'),
        'view_items'            => __('View Εκδότες', 'flynt'),
        'search_items'          => __('Search Εκδότης', 'flynt'),
        'not_found'             => __('Not found', 'flynt'),
        'not_found_in_trash'    => __('Not found in Trash', 'flynt'),
        'featured_image'        => __('Featured Image', 'flynt'),
        'set_featured_image'    => __('Set featured image', 'flynt'),
        'remove_featured_image' => __('Remove featured image', 'flynt'),
        'use_featured_image'    => __('Use as featured image', 'flynt'),
        'insert_into_item'      => __('Insert into εκδότης', 'flynt'),
        'uploaded_to_this_item' => __('Uploaded to this εκδότης', 'flynt'),
        'items_list'            => __('Εκδότες list', 'flynt'),
        'items_list_navigation' => __('Εκδότες list navigation', 'flynt'),
        'filter_items_list'     => __('Filter Εκδότες list', 'flynt'),
    ];

    $args = [
        'label'                 => __('Εκδότης', 'flynt'),
        'description'           => __('Εκδότης Description', 'flynt'),
        'labels'                => $labels,
        'supports'              => ['title', 'thumbnail'],
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
        'menu_icon'             => 'dashicons-building',
    ];

    register_post_type('publisher', $args);

    // add custom taxonomy to publisher
    $labels = [
        'name'                       => _x('Ιδιότητες Εκδότη', 'Ιδιότητα Εκδότη General Name', 'flynt'),
        'singular_name'              => _x('Ιδιότητα Εκδότη', 'Ιδιότητα Εκδότη Singular Name', 'flynt'),
        'menu_name'                  => __('Ιδιότητα Εκδότη', 'flynt'),
        'all_items'                  => __('All Ιδιότητες Εκδότη', 'flynt'),
        'parent_item'                => __('Parent Ιδιότητα Εκδότη', 'flynt'),
        'parent_item_colon'          => __('Parent Ιδιότητα Εκδότη:', 'flynt'),
        'new_item_name'              => __('New Ιδιότητα Εκδότη Name', 'flynt'),
        'add_new_item'               => __('Add New Ιδιότητα Εκδότη', 'flynt'),
        'edit_item'                  => __('Edit Ιδιότητα Εκδότη', 'flynt'),
        'update_item'                => __('Update Ιδιότητα Εκδότη', 'flynt'),
        'view_item'                  => __('View Ιδιότητα Εκδότη', 'flynt'),
        'separate_items_with_commas' => __('Separate Ιδιότητες Εκδότη with commas', 'flynt'),
        'add_or_remove_items'        => __('Add or remove Ιδιότητες Εκδότη', 'flynt'),
        'choose_from_most_used'      => __('Choose from the most used', 'flynt'),
        'popular_items'              => __('Popular Ιδιότητες Εκδότη', 'flynt'),
        'search_items'               => __('Search Ιδιότητες Εκδότη', 'flynt'),
        'not_found'                  => __('Not Found', 'flynt'),
        'no_terms'                   => __('No Ιδιότητες Εκδότη', 'flynt'),
        'items_list'                 => __('Ιδιότητες Εκδότη list', 'flynt'),
        'items_list_navigation'      => __('Ιδιότητες Εκδότη list navigation', 'flynt'),
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

    register_taxonomy('publisher_type', ['publisher'], $args);
});

add_filter('manage_publisher_posts_columns', function($columns){
    return [
        'cb' => $columns['cb'],
        'image' => 'Image',
        'title' => $columns['title'],
        'taxonomy-publisher_type' => $columns['taxonomy-publisher_type'],
        'company_biblionet_id' => 'Company Biblionet ID',
        'date' => $columns['date'],
    ];
});

add_action('manage_publisher_posts_custom_column', function($column, $post_id){
    if ($column == 'image') {
        echo get_the_post_thumbnail($post_id, 'thumbnail');
    } else if ($column == 'company_biblionet_id') {
        echo get_field('company_biblionet_id', $post_id);
    }
}, 10, 2);
