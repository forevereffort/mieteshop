<?php get_header(); ?>

<?php
    global $post;

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
            <div class="single-publisher-text-caption-left">Λεζάντα φωτογραφίας με credit</div>
            <div class="single-publisher-text-caption-right">
                <div class="single-publisher-text-caption-content">
                    <?php the_content(); ?>
                </div>
                <div class="single-publisher-text-caption-download">
                    <a href="#">Κατεβάστε τον κατάλογο (7Mb)</a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
    // get book that this single publiser was included
    $current_single_publisher_id = $post->ID;

    // get all products
    $args = [
        'post_type' => 'product',
        'posts_per_page' => -1
    ];

    $the_query = new WP_Query( $args );

    // get product that has this single publiser
    $product_list_include_single_publisher = [];

    if ( $the_query->have_posts() ) {
        while ( $the_query->have_posts() ) {
            $the_query->the_post();

            // get publisher list of product
            $publishers = get_field('book_publishers', $post->ID);

            if( !empty($publishers) ){
                foreach( $publishers as $publisher ){
                    // compare publisher
                    if( $publisher->ID === $current_single_publisher_id ){
                        $product_list_include_single_publisher[] = $post->ID;
                    }
                }
            }
        }
    }

    $count_product_list_include_single_publisher = count($product_list_include_single_publisher);

    wp_reset_query();
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
            <?php
                if( $count_product_list_include_single_publisher > 0){
                    $productPerPage = 1;
                    $page = 1;

                    $product_list_include_single_publisher_of_selected_page = array_slice($product_list_include_single_publisher, ($page - 1) * $productPerPage, $productPerPage);
            ?>
                    <div class="pcat-results-row">
                        <?php
                            foreach($product_list_include_single_publisher_of_selected_page as $product_id){
                                $product = wc_get_product( $product_id );
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
                        if( $count_product_list_include_single_publisher > $productPerPage ){
                    ?>
                            <div class="pcat-results-footer-options">
                                <div class="pcat-results-footer-options-col">
                                    <div class="pcat-results-navigation">
                                        <?php
                                            require_once dirname(dirname(__FILE__)) . '/inc/zebra-pagination.php';

                                            $pagination = new Zebra_Pagination();
                                            $pagination->records($count_product_list_include_single_publisher);
                                            $pagination->records_per_page($productPerPage);
                                            $pagination->selectable_pages(5);
                                            $pagination->set_page(1);
                                            $pagination->padding(false);
                                            $pagination->css_classes([
                                                'list' => 'pcat-results-navigation-row',
                                                'list_item' => 'js-pcat-results-navigation-item pcat-results-navigation-item',
                                                'prev' => 'js-pcat-results-navigation-item pcat-results-navigation-prev',
                                                'next' => 'js-pcat-results-navigation-item pcat-results-navigation-next',
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
            <?php
                }
            ?>
        </div>
    </div>
</section>
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
                                <a href="<?php esc_url( get_term_link( $series_term->term_id ) ); ?>">
                                    <img
                                        class="lazyload"
                                        src="<?php echo placeholderImage(300, 160); ?>"
                                        data-src="<?php echo aq_resize($series_image['url'], 300, 160, true); ?>"
                                        alt="<?php echo $series_term->name; ?>">
                                </a>
                            </div>
                            <div class="single-product-series-item-title">
                                <h3><a href="<?php esc_url( get_term_link( $series_term->term_id ) ); ?>"><?php echo $series_term->name; ?></a></h3>
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
<section class="home-authors-section">
    <div class="small-container">
        <div class="home-authors-title">
            <h2>ΣΥΓΓΡΑΦΕΙΣ</h2>
        </div>
        <div class="home-authors-row">
            <?php
                $args = [
                    'post_type' => 'contributor',
                    'posts_per_page' => 3,
                ];
            
                $loop = new WP_Query( $args );

                while ( $loop->have_posts() ){
                    $loop->the_post();
                    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
            ?>
                    <div class="home-authors-col">
                        <div class="home-authors-image">
                            <img
                                class="lazyload"
                                src="<?php echo placeholderImage($image[1], $image[2]); ?>"
                                data-src="<?php echo aq_resize($image[0], $image[1], $image[2], true); ?>"
                                alt="<?php echo $post->post_title; ?>">
                        </div>
                        <div class="home-authors-name">
                            <h3><?php echo $post->post_title; ?></h3>
                        </div>
                    </div>
            <?php
                }

                wp_reset_query();
            ?>
        </div>
    </div>
</section>
<?php
    if( have_rows('company_videos') || get_field('company_related_articles') ) {
?>
        <section class="single-product-meta-section">
            <div class="content-container">
                <div class="single-product-meta-tab-row">
                    <div class="single-product-meta-tab-col">
                        <div class="single-product-meta-tab-item active" data-section-id="video">Video</div>
                    </div>
                    <div class="single-product-meta-tab-col">
                        <div class="single-product-meta-tab-item" data-section-id="article">Σχετικά  Άρθρα</div>
                    </div>
                </div>
                <div class="single-product-meta-tab-content-row">
                    <div id="single-product-meta-tab-content--video" class="single-product-meta-tab-content-col">
                        <div class="single-product-video-wrapper" is="mieteshop-product-video-slider">
                            <div class="swiper-container" data-slider>
                                <div class="swiper-wrapper">
                                    <?php
                                        if( have_rows('company_videos') ) { 
                                            while( have_rows('company_videos') ){
                                                the_row();

                                                // get_sub_field('company_video_embed_code');
                                                $video_image_url = get_sub_field('company_video_cover_image');
                                    ?>
                                                <div class="swiper-slide">
                                                    <div class="single-product-video-item-row">
                                                        <div class="single-product-video-item-left-col">
                                                            <div class="single-product-video-image-wrapper">
                                                                <img
                                                                    class="lazyload"
                                                                    src="<?php echo placeholderImage(606, 241); ?>"
                                                                    data-src="<?php echo aq_resize($video_image_url['url'], 606, 241, true); ?>"
                                                                    alt="video image">
                                                                <div class="single-product-video-play-icon"><?php include get_template_directory() . '/assets/icons/video-play-icon.svg' ?></div>
                                                                <div class="single-product-video-resize-icon"><?php include get_template_directory() . '/assets/icons/resize-icon.svg' ?></div>
                                                            </div>
                                                        </div>
                                                        <div class="single-product-video-item-right-col">
                                                            <div class="single-product-video-item-content">
                                                                <h2><?php echo get_sub_field('company_video_title'); ?></h2>
                                                                <?php echo apply_filters('the_content', get_sub_field('company_video_description')); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                    <?php
                                            }
                                        }                         
                                    ?>
                                </div>
                            </div>
                            <div class="single-product-video-pagination-wrapper" data-pagination></div>
                        </div>
                    </div>
                    <div id="single-product-meta-tab-content--article" class="single-product-meta-tab-content-col hide">
                        <div class="single-product-blog-wrapper" is="mieteshop-product-blog-slider">
                            <div class="swiper-container" data-slider>
                                <div class="swiper-wrapper">
                                    <?php
                                        $related_articles = get_field('company_related_articles');
                                        foreach($related_articles as $article) {
                                            $blog_image_url = wp_get_attachment_url( get_post_thumbnail_id($article->ID) );
                                    ?>
                                            <div class="single-product-blog-item swiper-slide">
                                                <div class="single-product-blog-item-inner">
                                                    <div class="single-product-blog-image">
                                                        <a href="<?php echo get_permalink($article->ID); ?>">
                                                            <img
                                                                class="lazyload"
                                                                src="<?php echo placeholderImage(399, 261); ?>"
                                                                data-src="<?php echo aq_resize($blog_image_url, 399, 261, true); ?>"
                                                                alt="video image">
                                                        </a>
                                                    </div>
                                                    <div class="single-product-blog-content">
                                                        <h2><a href="<?php echo get_permalink($article->ID); ?>"><?php echo $article->post_title; ?></a></h2>
                                                        <?php echo apply_filters('the_content', $article->post_excerpt); ?>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
<?php
    }
?>
<?php
        }
    }
?>

<?php get_footer(); ?>