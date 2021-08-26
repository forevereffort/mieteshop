<?php get_header(); ?>

<?php
    global $post, $product;

    if ( have_posts() ) {
        while ( have_posts() ){
            the_post();
?>
<section class="single-publisher-title">
    <div class="content-container">
        <h1><?php echo $post->post_title; ?></h1>
    </div>
</section>
<section class="single-publisher-image-lead-section">
    <div class="general-container">
        <div class="content-container">
            <div class="single-publisher-image-lead-row">
                <div class="single-publisher-image-lead-left">
                    <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>
                    <div class="single-publisher-image-lead-image">
                        <img
                            class="lazyload"
                            src="<?php echo placeholderImage($image[1], $image[2]); ?>"
                            data-src="<?php echo aq_resize($image[0], $image[1], $image[2], true); ?>"
                            alt="<?php echo $post->post_title; ?>">
                    </div>
                </div>
                <div class="single-publisher-image-lead-right">
                    <div class="single-publisher-image-lead-content">
                        <?php echo apply_filters('the_content', get_field('company_description_lead')); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="single-publisher-text-caption-section">
    <div class="content-container">
        <div class="single-publisher-text-caption-row">
            <div class="single-publisher-text-caption-left"><span style="display: none;">Λεζάντα φωτογραφίας με credit</span></div>
            <div class="single-publisher-text-caption-right">
                <div class="single-publisher-text-caption-content">
                    <?php the_content(); ?>
                </div>
                <div class="single-publisher-text-caption-download" style="display: none;">
                    <a href="#">Κατεβάστε τον κατάλογο (7Mb)</a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_template_part( 'publisher/sections/single', 'publisher-meta' ); ?>

<?php
    $productPerPage = 16;
    $page = 1;
    // get book that this single publiser was included
    $current_single_publisher_id = $post->ID;

    // get all products that has this single publiser
    $args = [
        'post_type' => 'product',
        'posts_per_page' => $productPerPage,
        'offset' => ($page - 1) * $productPerPage,
        'meta_query' => [
			[
				'key'     => 'book_publishers',
				'value'   => '"' . $current_single_publisher_id . '"',
				'compare' => 'LIKE'
            ],
        ]
    ];

    $the_query = new WP_Query( $args );

    if ( $the_query->have_posts() ) {
        $count_product_list_include_single_publisher = $the_query->found_posts;
?>
        <section class="pcat-results-section">
            <div class="general-container">
                <div class="content-container">
                    <div class="pcat-results-top-title">
                        <h2>ΒΙΒΛΙΑ</h2>
                    </div>
                    <div class="pcat-results-top-row">
                        <div class="pcat-results-top-left-col">
                            <div class="pcat-results-title">
                                <h2>ΤΙΤΛΟΙ: <?php echo $count_product_list_include_single_publisher; ?></h2>
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
                    <div id="js-single-publisher-product-row" class="pcat-results-row" data-nonce="<?php echo wp_create_nonce('filter_single_publisher_product_nonce'); ?>" data-product-per-page="<?php echo $productPerPage; ?>" data-publisher-id="<?php echo $current_single_publisher_id; ?>">
                        <?php
                            while ( $the_query->have_posts() ) {
                                $the_query->the_post();

                                $image = wp_get_attachment_image_src( get_post_thumbnail_id( $product->get_id() ), 'full' );
                                $authorIDs = get_field('book_contributors_syggrafeas', $product->get_id());
                        ?>
                                <div class="pcat-results-col">
                                    <div class="pcat-result-item">
                                        <div class="pcat-result-item-info">
                                            <div class="pcat-result-item-image">
                                                <a href="<?php echo get_permalink($product->get_id()); ?>">
                                                    <img
                                                        class="lazyload"
                                                        src="<?php echo placeholderImage($image[1], $image[2]); ?>"
                                                        data-src="<?php echo aq_resize($image[0], $image[1], $image[2], true); ?>"
                                                        alt="<?php echo $product->get_name(); ?>">
                                                </a>
                                            </div>
                                            <div class="pcat-result-item-meta-row">
                                                <div class="pcat-result-item-meta-col">
                                                    <div class="pcat-result-item-favorite">
                                                        <a href="#"><span><?php include get_template_directory() . '/assets/icons/favorite-small-icon.svg' ?></span></a>
                                                    </div>
                                                </div>
                                                <div class="pcat-result-item-meta-col">
                                                    <div class="pcat-result-item-busket">
                                                    <a class="js-mieteshop-add-to-cart" href="#" data-quantity="1" data-product_id="<?php echo $product->get_id(); ?>" data-variation_id="0" data-product_sku="<?php echo $product->get_sku(); ?>"><span><?php include get_template_directory() . '/assets/icons/busket-small-icon.svg' ?></span></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                                if( !empty($authorIDs) ){
                                                    echo '<div class="pcat-result-item-author-list">';
                                                    if( count($authorIDs) > 3 ){
                                                        echo '<div class="pcat-result-item-author-item">Συλλογικό Έργο</div>';
                                                    } else {
                                                        foreach( $authorIDs as $authorID ){
                                                            echo '<div class="pcat-result-item-author-item"><a href="'. get_permalink($authorID) . '">' . get_the_title($authorID) . '</a></div>';
                                                        }
                                                    }
                                                    echo '</div>';
                                                }
                                            ?>
                                            <div class="pcat-result-item-title"><h3><a href="<?php echo get_permalink($product->get_id()); ?>"><?php echo $product->get_name(); ?></a></h3></div>
                                        </div>
                                        <div class="pcat-result-item-footer-row">
                                            <div class="pcat-result-item-footer-col">
                                                <div class="pcat-result-item-footer-product-price">
                                                    <?php echo $product->get_price_html(); ?>
                                                </div>
                                            </div>
                                            <!--div class="pcat-result-item-footer-col">
                                                <div class="pcat-result-item-footer-product-discount">-30%</div>
                                            </div-->
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        ?>
                    </div>
                    <?php
                        if( $count_product_list_include_single_publisher > $productPerPage ){
                    ?>
                            <div class="pcat-results-footer-options">
                                <div class="pcat-results-footer-options-col">
                                    <div id="js-single-publisher-product-navigation" class="pcat-results-navigation">
                                        <?php
                                            require_once dirname(__FILE__) . '/inc/zebra-pagination.php';

                                            $pagination = new Zebra_Pagination();
                                            $pagination->records($count_product_list_include_single_publisher);
                                            $pagination->records_per_page($productPerPage);
                                            $pagination->selectable_pages(5);
                                            $pagination->set_page(1);
                                            $pagination->padding(false);
                                            $pagination->css_classes([
                                                'list' => 'pcat-results-navigation-row',
                                                'list_item' => 'js-sp-product-navigation-item pcat-results-navigation-item',
                                                'prev' => 'js-sp-product-navigation-item pcat-results-navigation-prev',
                                                'next' => 'js-sp-product-navigation-item pcat-results-navigation-next',
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
                                            <?php
                                                $pageCount = round($count_product_list_include_single_publisher / $productPerPage + 0.45);
                                            ?>
                                            <select id="js-sp-page-list">
                                                <?php
                                                    for($p = 1; $p <= $pageCount; $p++){
                                                ?>
                                                        <option value="<?php echo $p; ?>"><?php echo $p; ?></option>
                                                <?php
                                                    }
                                                ?>
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
<?php
    if($post->ID == 733 ) {
        //only show series for publisher MIET
?>
        <section class="single-product-series-section">
            <div class="small-container">
                <div class="single-product-series-title">
                    <h2>ΣΕΙΡΕΣ</h2>
                </div>
                <div class="single-product-series-row">
                    <?php
                        $series = get_terms([
                            'taxonomy' => 'series',
                            'hide_empty' => false,       
                        ]);

                        foreach($series as $series_term) {
                            $series_image = get_field('series_image', 'series_'.$series_term->term_id);
                    ?>
                            <div class="single-product-series-col">
                                <div class="single-product-series-item">
                                    <div class="single-product-series-item-image">
                                        <a href="<?php echo esc_url( get_term_link( $series_term->term_id ) ); ?>">
                                            <img
                                                class="lazyload"
                                                src="<?php echo placeholderImage(300, 160); ?>"
                                                data-src="<?php echo aq_resize($series_image['url'], 300, 160, true); ?>"
                                                alt="<?php echo $series_term->name; ?>">
                                        </a>
                                    </div>
                                    <div class="single-product-series-item-title">
                                        <h3><a href="<?php echo esc_url( get_term_link( $series_term->term_id ) ); ?>"><?php echo $series_term->name; ?></a></h3>
                                    </div>
                                    <div class="single-product-series-item-info">
                                        <p><strong><?php echo $series_term->count; ?></strong> τίτλοι</p>
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
?>

<?php get_template_part( 'publisher/sections/single', 'publisher-authors' ); ?>

<?php
        }
    }
?>

<div id="js-single-publisher-product-filter-load-spinner" class="load-spinner hide"></div>

<?php get_footer(); ?>