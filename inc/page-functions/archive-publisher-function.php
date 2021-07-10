<?php
// add wp_query arg to search only in title with first letter
function title_filter_with_first_letter( $where, $wp_query ){
    global $wpdb;

    if ( $search_term = $wp_query->get( 'search_title_with_first_letter' ) ) {
        if( !empty($search_term) ){
            $where .= ' AND ';
            
            if( is_array($search_term) ){

                $s = '';

                foreach($search_term as $item){
                    if( !empty($s) ){
                        $s .= ' OR ';
                    }

                    $s .= $wpdb->posts . '.post_title LIKE \'' . esc_sql( like_escape( $item ) ) . '%\'';
                }

                $where .= '(' . $s . ')';
            } else {
                $where .= $wpdb->posts . '.post_title LIKE \'' . esc_sql( like_escape( $search_term ) ) . '%\'';
            }
        }
    }
    
    return $where;
}

add_filter( 'posts_where', 'title_filter_with_first_letter', 10, 2 );

add_action('wp_ajax_filter_search_archive_publisher', 'filterSearchArchivePublisherFunc');
add_action('wp_ajax_nopriv_filter_search_archive_publisher', 'filterSearchArchivePublisherFunc');

function filterSearchArchivePublisherFunc()
{
    if (!wp_verify_nonce($_REQUEST['nonce'], 'filter_search_archive_publisher_nonce')) {
        exit('No naughty business please');
    }

    $result = [];
    
    $firstLetters = $_REQUEST['firstLetters'];
    $publisherTypeList = $_REQUEST['publisherTypeList'];
    $html = '';

    $args = [
        'post_type' => 'publisher',
        'posts_per_page' => -1,
        'search_title_with_first_letter' => $firstLetters,
        'orderby' => 'title',
        'order' => 'ASC'
    ];

    if( !empty($publisherTypeList) ){
        $args['tax_query'] = [
            [
                'taxonomy' => 'publisher_type',
                'field' => 'term_id',
                'terms' => $publisherTypeList
            ]
        ];
    }

    global $post;

    $loop = new WP_Query( $args );

    while ( $loop->have_posts() ){
        $loop->the_post();

        $html .= '<div class="archive-publisher-search-result-col"><a href="' . get_permalink($post->ID) .'">' . $post->post_title .'</a></div>';
    }

    wp_reset_query();
    
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        $result = json_encode([
            'result' => $html,
        ]);

        echo $result;
    } else {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }

    die();
}