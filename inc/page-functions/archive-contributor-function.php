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
        //'fields' => 'ids',
        'meta_key' => 'book_contributors_syggrafeas',
        'meta_value' => array(''),
        'meta_compare' => 'NOT IN'
    ];

    global $post;

    $loop = new WP_Query( $args );

    $contrCount=0;
    while ( $loop->have_posts() ){
    //foreach( $loop->posts as $contributor_id ) {    
        $loop->the_post();

        $ContributorBooks = get_field('book_contributors_syggrafeas', $post->ID);

        // check that the contributor is connected with published books
        foreach($ContributorBooks as $ContributorBook) {
            $atLeastOnePublished = false;
            if($ContributorBook->post_status == 'publish') {
                $atLeastOnePublished = true;
                break; //we found at a published book no need to search the rest
            }
        }   
        
        if($atLeastOnePublished == true) { //display only contributors who have at least one published book
            $html .= '<div class="archive-contributor-search-result-col"><a href="' . get_permalink($post->ID) .'">' . $post->post_title .'</a></div>';
            $contrCount++;
        }

        
    }

    wp_reset_query();
    
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        $result = json_encode([
            'result' => $html,
            'count' => $contrCount
        ]);

        echo $result;
    } else {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }

    die();
}