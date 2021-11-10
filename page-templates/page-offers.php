<?php
/**
 * Template Name: Offers
 */
global $post;
?>
<?php get_header(); ?>

<?php

    $product_per_page = 16;

    if( wp_is_mobile() ){
        $product_per_page = 4;
    }

    $product_per_page = isset($_GET['productPerPage']) ? $_GET['productPerPage'] : $product_per_page;
    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
    $productOrder = isset($_GET['productOrder']) ? $_GET['productOrder'] : 'published-date';

    $args = [
        'post_type' => 'product',
        'post_status' => 'publish',        
        'posts_per_page' => $product_per_page,
        'offset' => ( $current_page - 1 ) * $product_per_page,
        'fields' => 'ids',
        'meta_key' => 'book_current_published_date',
        'orderby' => 'meta_value',
        'order' => 'desc',
    ];

    $the_query = new WP_Query( $args );

    $total_product_count = $the_query->found_posts;

    if ( !empty($the_query->posts) ) {
?>
        <section id="js-pcat-results-section" class="pcat-results-section">
            <div class="general-container">
                <div class="content-container">
                    <div class="pcat-results-top-row">
                        <div class="pcat-results-top-left-col">
                            <div class="pcat-results-title">
                                <h2>ΤΙΤΛΟΙ: <?php echo $total_product_count; ?></h2>
                            </div>
                        </div>
                        <div class="pcat-results-top-right-col">
                            <div class="pcat-classification-filter">
                                <div class="pcat-classification-filter-label pcat-classification-filter-label--black">ΤΑΞΙΝΟΜΗΣΗ</div>
                                <div class="pcat-classification-filter-select">
                                    <select id="js-sp-product-display-order">
                                        <option value="published-date" <?php echo $productOrder === 'published-date' ? 'selected' : '' ?>>Published Date</option>
                                        <option value="alphabetical" <?php echo $productOrder === 'alphabetical' ? 'selected' : '' ?>>Alphabetical</option>
                                    </select>
                                    <div class="pcat-classification-filter-select-icon"><?php include get_template_directory() . '/assets/icons/arrow-down-white-icon.svg'; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="js-pcat-results-row" class="pcat-results-row">
                        <?php
                            foreach( $the_query->posts as $postid ) {
                        ?>
                                <div class="pcat-results-col">
                                    <?php get_template_part('product/loop/loop', 'product-card', [ 'postId' => $postid ]); ?>
                                </div>
                        <?php
                            }
                        ?>
                    </div>
                    <?php
                        if( $total_product_count > $product_per_page ){
                            get_template_part('product/page-nav/page-nav', 'navigation', [ 
                                'navWrapperDomId' => "js-pcat-results-navigation",
                                'navDomClass' => "js-pcat-results-navigation-item",
                                'gotoDomId' => "js-pcat-products-page-list",
                                'total' => $total_product_count,
                                'perPage' => $product_per_page,
                                'currentPage' => $current_page,
                            ]);
                        }

                        get_template_part('product/page-nav/page-nav', 'per-page', [ 
                            'selectDomId' => "js-pcat-products-per-page",
                            'perPage' => $product_per_page,
                        ]);
                    ?>
                </div>
            </div>
        </section>
<?php
    }
?>

<div id="js-category-product-filter-load-spinner" class="load-spinner hide"></div>

<?php get_footer(); ?>