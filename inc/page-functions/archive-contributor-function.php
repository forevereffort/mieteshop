<?php
add_action('wp_ajax_filter_search_archive_contributor', 'filterSearchArchiveContributorFunc');
add_action('wp_ajax_nopriv_filter_search_archive_contributor', 'filterSearchArchiveContributorFunc');

function filterSearchArchiveContributorFunc()
{
    if (!wp_verify_nonce($_REQUEST['nonce'], 'filter_search_archive_contributor_nonce')) {
        exit('No naughty business please');
    }

    $result = [];
    
    $firstLetters = $_REQUEST['firstLetters'];
    $html = '';

    $args = [
        'post_type' => 'contributor',
        'posts_per_page' => -1,
        'search_title_with_first_letter' => $firstLetters,
        'orderby' => 'title',
        'order' => 'ASC',
        'tax_query' => [
            [
                'taxonomy' => 'contributor_type',
                'field'    => 'slug',
                'terms'    => 'syggrafeas',
            ]
        ]
    ];

    global $post;

    $loop = new WP_Query( $args );

    while ( $loop->have_posts() ){
        $loop->the_post();

        $html .= '<div class="archive-contributor-search-result-col"><a href="' . get_permalink($post->ID) .'">' . $post->post_title .'</a></div>';
    }

    wp_reset_query();
    
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        $result = json_encode([
            'result' => $html,
            'count' => $loop->found_posts
        ]);

        echo $result;
    } else {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }

    die();
}