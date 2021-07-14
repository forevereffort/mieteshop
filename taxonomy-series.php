<?php get_header(); ?>

<?php
    $current_series_taxonomy = get_queried_object();

    $series_image = get_field('series_image', 'series_'.$current_series_taxonomy->term_id);
?>

<section class="breadcrumb-section">
    <div class="content-container">
        <div class="breadcrumb-list">
            <div class="breadcrumb-item"><a href="#">Βιβλία</a></div>
            <div class="breadcrumb-item"><a href="#">Σειρές ΜΙΕΤ</a></div>
        </div>
    </div>
</section>
<section class="product-series-content-section">
    <div class="product-series-content-inner">
        <div class="product-series-content-image">
            <img
                class="lazyload"
                src="<?php echo placeholderImage($series_image['width'], $series_image['height']); ?>"
                data-src="<?php echo $series_image['url']; ?>"
                alt="<?php echo $current_series_taxonomy->name; ?>">
        </div>
        <div class="product-series-content-row">
            <div class="product-series-content-col">
                <h1><?php echo $current_series_taxonomy->name; ?></h1>
                <?php echo apply_filters('the_content', $current_series_taxonomy->description); ?>
            </div>
        </div>
    </div>
</section>
<?php
    global $post;

    $productPerPage = 16;
    $page = 1;

    // get all products that has selected series taxonomy
    $args = [
        'post_type' => 'product',
        'posts_per_page' => $productPerPage,
        'offset' => ( $page - 1 ) * $productPerPage,
        'tax_query' => [
            [
                'taxonomy' => 'series',
                'field' => 'term_id',
                'terms' => $current_series_taxonomy->term_id
            ],
        ],
    ];

    $the_query = new WP_Query( $args );

    if ( $the_query->have_posts() ) {
        $products_search_count = $the_query->found_posts;
?>
        <section class="pcat-results-section">
            <div class="general-container">
                <div class="content-container">
                    <div class="pcat-results-top-title">
                        <h2>Ta βιβλια τησ σειρας</h2>
                    </div>
                    <div class="pcat-results-top-row">
                        <div class="pcat-results-top-left-col">
                            <div class="pcat-results-title">
                                <h2>ΤΙΤΛΟΙ: <?php echo $products_search_count; ?></h2>
                            </div>
                        </div>
                        <div class="pcat-results-top-right-col">
                            <div class="pcat-classification-filter">
                                <div class="pcat-classification-filter-label pcat-classification-filter-label--black">ΤΑΞΙΝΟΜΗΣΗ</div>
                                <div class="pcat-classification-filter-select">
                                    <select>
                                        <option value="1">Χρονολογική</option>
                                    </select>
                                    <div class="pcat-classification-filter-select-icon"><?php include get_template_directory() . '/assets/icons/arrow-down-white-icon.svg'; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="js-taxonomy-series-product-row" class="pcat-results-row" data-nonce="<?php echo wp_create_nonce('filter_taxonomy_series_product_nonce'); ?>" data-product-per-page="<?php echo $productPerPage; ?>" data-series-term-id="<?php echo $current_series_taxonomy->term_id; ?>">
                        <?php
                            while ( $the_query->have_posts() ) {
                                $the_query->the_post();

                                $product = wc_get_product( $post->ID );
                                $image = wp_get_attachment_image_src( get_post_thumbnail_id( $product->get_id() ), 'full' );
                                $authors = get_field('book_contributors_syggrafeas', $product->get_id());
                        ?>
                                <div class="pcat-results-col">
                                    <div class="pcat-result-item">
                                        <div class="pcat-result-item-info">
                                            <div class="pcat-result-item-image">
                                                <img
                                                    class="lazyload"
                                                    src="<?php echo placeholderImage($image[1], $image[2]); ?>"
                                                    data-src="<?php echo aq_resize($image[0], $image[1], $image[2], true); ?>"
                                                    alt="<?php echo $product->get_name(); ?>">
                                            </div>
                                            <div class="pcat-result-item-meta-row">
                                                <div class="pcat-result-item-meta-col">
                                                    <div class="pcat-result-item-favorite">
                                                        <a href="#"><span><?php include get_template_directory() . '/assets/icons/favorite-small-icon.svg' ?></span></a>
                                                    </div>
                                                </div>
                                                <div class="pcat-result-item-meta-col">
                                                    <div class="pcat-result-item-busket">
                                                        <a href="#"><span><?php include get_template_directory() . '/assets/icons/busket-small-icon.svg' ?></span></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                                if( !empty($authors) ){
                                                    echo '<div class="pcat-result-item-author-list">';
                                                    if( count($authors) > 3 ){
                                                        echo '<div class="pcat-result-item-author-item">Συλλογικό Έργο</div>';
                                                    } else {
                                                        foreach( $authors as $author ){
                                                            echo '<div class="pcat-result-item-author-item"><a href="'. get_permalink($author->ID) . '">' . $author->post_title . '</a></div>';
                                                        }
                                                    }
                                                    echo '</div>';
                                                }
                                            ?>
                                            <div class="pcat-result-item-title"><h3><?php echo $product->get_name(); ?></h3></div>
                                        </div>
                                        <div class="pcat-result-item-footer-row">
                                            <div class="pcat-result-item-footer-col">
                                                <div class="pcat-result-item-footer-product-price">
                                                    <?php echo $product->get_price_html(); ?>
                                                </div>
                                            </div>
                                            <div class="pcat-result-item-footer-col">
                                                <div class="pcat-result-item-footer-product-discount">-30%</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        ?>
                    </div>
                    <?php
                        if( $products_search_count > $productPerPage ){
                    ?>
                            <div class="pcat-results-footer-options">
                                <div class="pcat-results-footer-options-col">
                                    <div id="js-taxonomy-series-product-navigation" class="pcat-results-navigation">
                                        <?php
                                            require_once dirname(__FILE__) . '/inc/zebra-pagination.php';

                                            $pagination = new Zebra_Pagination();
                                            $pagination->records($products_search_count);
                                            $pagination->records_per_page($productPerPage);
                                            $pagination->selectable_pages(5);
                                            $pagination->set_page(1);
                                            $pagination->padding(false);
                                            $pagination->css_classes([
                                                'list' => 'pcat-results-navigation-row',
                                                'list_item' => 'js-ts-product-navigation-item pcat-results-navigation-item',
                                                'prev' => 'js-ts-product-navigation-item pcat-results-navigation-prev',
                                                'next' => 'js-ts-product-navigation-item pcat-results-navigation-next',
                                                'anchor' => '',
                                            ]);
                                            $pagination->render();
                                        ?>
                                    </div>
                                </div>
                                <div class="pcat-results-footer-options-col">
                                    <div class="pcat-results-footer-select">
                                        <div class="pcat-results-footer-select-label">Mετάβαση στη σελίδα</div>
                                        <div class="pcat-results-footer-select-elem">
                                            <select>
                                                <option value="1">1</option>
                                            </select>
                                            <div class="pcat-results-footer-select-elem-icon"><?php include get_template_directory() . '/assets/icons/arrow-down-icon.svg'; ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </section>
<?php
    }

    wp_reset_query();
?>

<div id="js-ts-product-filter-load-spinner" class="load-spinner hide"></div>

<?php get_footer(); ?>