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
    $filterAuthorId = intval($_REQUEST['filterAuthorId']);
    $filterPublisherId = intval($_REQUEST['filterPublisherId']);
    

    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        // $result = json_encode($result);
        $result = json_encode([$filterTermIds, $filterAuthorId, $filterPublisherId]);
        echo $result;
    } else {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }

    die();
}