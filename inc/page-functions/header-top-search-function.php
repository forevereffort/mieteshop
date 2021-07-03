<?php
add_action('wp_ajax_header_top_search', 'headerTopSearchFuc');
add_action('wp_ajax_nopriv_header_top_search', 'headerTopSearchFuc');

function headerTopSearchFuc()
{
    if (!wp_verify_nonce($_REQUEST['nonce'], 'header_top_search_nonce')) {
        exit('No naughty business please');
    }
    
    $searchKey = $_REQUEST['searchKey'];
    
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        $result = json_encode([
            'searchKey' => $searchKey
        ]);

        echo $result;
    } else {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }

    die();
}