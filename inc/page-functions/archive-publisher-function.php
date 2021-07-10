<?php
add_action('wp_ajax_filter_search_archive_publisher', 'filterSearchArchivePublisherFunc');
add_action('wp_ajax_nopriv_filter_search_archive_publisher', 'filterSearchArchivePublisherFunc');

function filterSearchArchivePublisherFunc()
{
    if (!wp_verify_nonce($_REQUEST['nonce'], 'filter_search_archive_publisher_nonce')) {
        exit('No naughty business please');
    }

    $result = [];
    
    $greekLetters = $_REQUEST['greekLetters'];
    $englishLetters = $_REQUEST['englishLetters'];
    $publisherTypeList = $_REQUEST['publisherTypeList'];
    
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        global $twig;

        $result = json_encode([
            'greekLetters' => $greekLetters,
            'englishLetters' => $englishLetters,
            'publisherTypeList' => $publisherTypeList,
        ]);

        echo $result;
    } else {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }

    die();
}