<?php
    global $product;

    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $product->get_id() ), 'full' );
    $publishers = get_field('book_publishers', $product->ID);
    $series = get_the_terms( $product->ID, 'series' );
    $epiloges = get_the_terms( $product->ID, 'epiloges' );
    
?>
<section class="breadcrumb-section">
    <div class="content-container">
        <div class="breadcrumb-list">
            <div class="breadcrumb-item"><a href="#">Βιβλία</a></div>
            <div class="breadcrumb-item"><a href="#">Ανθρωπιστικές Επιστήμες</a></div>
            <div class="breadcrumb-item"><a href="#">Ιστορία</a></div>
        </div>
    </div>
</section>
<section class="single-product-section">
    <div class="general-container">
        <div class="content-container">
            <div class="single-product-row">
                <div class="single-product-left-col">
                    <div class="single-product-image">
                        <img
                            class="lazyload"
                            src="<?php echo placeholderImage($image[1], $image[2]); ?>"
                            data-src="<?php echo aq_resize($image[0], $image[1], $image[2], true); ?>"
                            alt="<?php echo $product->get_name(); ?>">
                    </div>
                </div>
                <div class="single-product-right-col">
                    <div class="single-product-info">
                        <div class="single-product-tag-row">
                            <?php 
                                if($series) {
                                    foreach ( $series as $series_term ) {
                                        echo '<div class="single-product-tag"><a href="#">'.$series_term->name .'</a></div>';
                                    }        
                                }
                                if($publishers) {
                                    foreach($publishers as $publisher) {
                                        echo '<div class="single-product-tag"><a href="'.$publisher->guid.'">'.$publisher->post_title.'</a></div>';
                                    }	     
                                }
                                if($epiloges) { 
                                    foreach($epiloges as $epilogi) {
                                        if ($epilogi->slug == 'nees-kyklofories') {    
                                            echo '<div class="single-product-tag active"><a href="'.$epilogi->guid.'">'.$epilogi->name.'</a></div>';
                                        }    
                                    }
                                }
                            ?>
                        </div>
                        <div class="single-product-author">
                            <?php $authors = get_field('book_contributors_syggrafeas', $product->get_id()); 
                            if($authors) {
                                if(count($authors)>3) {
                                    $displayauthors .= 'Συλλογικό Έργο<br/>';	
                                } else {					
                                    foreach($authors as $author) {
                                        $displayauthors .= '<a href="'.$author->guid.'">'.$author->post_title.'</a><br/>';
                                    }	
                                }	
                            } else {
                                $displayauthors = get_field('book_biblionet_writer_name');
                            }              
                            
                            echo $displayauthors; ?>
                        </div>
                        <div class="single-product-title">
                            <h1><?php echo get_the_title(); ?></h1>
                        </div>
                        <div class="single-product-subtitle">
                            <h2><?php echo get_field('book_subtitle'); ?></h2>
                        </div>
                        <div class="single-product-role-detail-wrapper">
                        <?php 
                        $contributorFields = acf_get_fields(3523);
                        //var_dump($contributorFields);
                        foreach($contributorFields as $contributorField) {
                            //REMEMBER TO REMOVE Συγγραφέας FROM CONTRIBUTOR SECTION
                                $contributors = get_field($contributorField['name']);
                                if($contributors){
                                    //echo  $contributorField['name'] .'<br/>';

                                    echo '<div class="single-product-role-detail">';
                                    echo '<div class="single-product-role-detail__role">'.$contributorField['label'].'</div>';
                            
                                    foreach($contributors as $contributor) {
                                        echo '<div class="single-product-role-detail__detail"><a href="'.$contributor->guid.'">'.$contributor->post_title.'</a></div>';
                                    }
                                    echo '</div>';  
                                }
                                                        
                        }
                        ?>
                        </div>
                        <div class="single-product-comments">
                            <?php echo get_field('book_comments'); ?>
                        </div>   
                        <div class="single-product-info-table-1-row">
                            <div class="single-product-form-col"><span>ΜΟΡΦΗ</span></div>
                            <div class="single-product-form-value"><span><?php echo get_field('book_cover_type'); ?></span></div>
                            <div class="single-product-price-col"><span>ΤΙΜΗ</span></div>
                            <?php 
                            $regular_price = get_post_meta( get_the_ID(), '_regular_price', true);
                            $sale_price = get_post_meta( get_the_ID(), '_sale_price', true);
                            if($sale_price) { ?>
                                <div class="single-product-regular-price"><span><?php echo wc_price($regular_price); ?></span></div>
                                <div class="single-product-sale-price"><span><?php echo wc_price($sale_price); ?></span></div>
                            <?php } else { ?>
                                <div class="single-product-sale-price"><span><?php echo wc_price($regular_price); ?></span></div>
                            <?php } ?>
                            
                            <?php
                            if($sale_price) {
                                $saving_percentage = round( 100 - ( $sale_price / $regular_price * 100 ), 1 ) . '%';
                                echo '<div class="single-product-discount"><span>'.$saving_percentage.'</span></div>'; 
                            }
                            ?>
                            <div class="single-product-availability"><span><?php 
                            $availability = $product->get_availability();
                            echo $availability['availability']; 
                            ?></span></div>
                        </div>
                        <div class="single-product-info-table-2-row">
                            <div class="single-product-share-col">
                                <div class="single-product-share-icon"><?php include get_template_directory() . '/assets/icons/share-icon.svg' ?></div>
                            </div>
                            <div class="single-product-favorite-col">
                                <div class="single-product-favorite-button">
                                    <div class="single-product-favorite-button__icon"><?php include get_template_directory() . '/assets/icons/favorite-white-icon.svg' ?></div>
                                    <div class="single-product-favorite-button__label">Προσθήκη στα αγαπημένα</div>
                                </div>
                            </div>
                            <div class="single-product-add-tocart-col">
                                <a href="#">Προσθήκη στο καλάθι</a>
                            </div>
                        </div>
                    </div>
                    <div class="single-product-tab-header-row">
                        <div class="single-product-tab-header-item active" data-section-id="description">ΠΕΡΙΓΡΑΦΗ</div>
                        <div class="single-product-tab-header-item" data-section-id="detail-information">ΑΝΑΛΥΤΙΚΑ ΣΤΟΙΧΕΙΑ</div>
                    </div>
                    <div class="single-product-tab-content-row">
                        <div id="single-product-tab-content-item--description" class="single-product-tab-content-item">
                            <div class="single-product-description"><p><?php echo get_the_content(); ?></p></div>
                        </div>
                        <div id="single-product-tab-content-item--detail-information" class="single-product-tab-content-item hide">
                            <div class="single-product-detail-information-row">
                                <?php if (get_field('book_setisbn')) { ?>
                                <div class="single-product-detail-information-item">
                                    <div class="single-product-detail-information-item__label">ISBN</div>
                                    <div class="single-product-detail-information-item__value"><?php echo get_field('book_isbn'); ?></div>
                                </div>
                                <?php } ?>
                                <div class="single-product-detail-information-item">
                                    <div class="single-product-detail-information-item__label">ΔΙΑΣΤΑΣΕΙΣ</div>
                                    <div class="single-product-detail-information-item__value"><?php echo $product->get_width() .' x ' .$product->get_height(); ?> εκ.</div>
                                </div>
                                <?php if (get_field('book_setisbn')) { ?>
                                <div class="single-product-detail-information-item">
                                    <div class="single-product-detail-information-item__label">ISBN SET</div>
                                    <div class="single-product-detail-information-item__value"><?php echo get_field('book_setisbn'); ?></div>
                                </div>
                                <?php } ?>
                                <?php if (get_field('book_language')) { ?>
                                <div class="single-product-detail-information-item">
                                    <div class="single-product-detail-information-item__label">ΓΛΩΣΣΑ</div>
                                    <div class="single-product-detail-information-item__value">
                                        <?php $booklanguage = get_field('book_language'); echo $booklanguage['label']; ?>
                                    </div>
                                </div>
                                <?php } ?>
                                <?php if (get_field('book_first_publish_date')) { ?>
                                <div class="single-product-detail-information-item">
                                    <div class="single-product-detail-information-item__label">ΠΡΩΤΗ ΕΚΔΟΣΗ</div>
                                    <div class="single-product-detail-information-item__value"><?php echo get_field('book_first_publish_date'); ?></div>
                                </div>
                                <?php } ?>
                                <?php if (get_field('book_original_title')) { ?>
                                <div class="single-product-detail-information-item">
                                    <div class="single-product-detail-information-item__label">ΠΡΩΤΟΤΥΠΟΣ ΤΙΤΛΟΣ</div>
                                    <div class="single-product-detail-information-item__value"><?php echo get_field('book_original_title'); ?></div>
                                </div>
                                <?php } ?>
                                <?php if (get_field('book_current_publish_date')) { ?>
                                <div class="single-product-detail-information-item">
                                    <div class="single-product-detail-information-item__label">ΤΡΕΧΟΥΣΑ ΕΚΔΟΣΗ</div>
                                    <div class="single-product-detail-information-item__value"><?php echo get_field('book_current_publish_date'); ?></div>
                                </div>
                                <?php } ?>
                                <?php if (get_field('book_original_language')) { ?>
                                <div class="single-product-detail-information-item">
                                    <div class="single-product-detail-information-item__label">ΓΛΩΣΣΑ ΠΡΩΤΟΤΥΠΟΥ</div>
                                    <div class="single-product-detail-information-item__value">
                                        <?php $booklanguageOrig = get_field('book_original_language'); echo $booklanguageOrig['label']; ?>
                                    </div>
                                </div>
                                <?php } ?>
                                <?php 
                                    if($publishers) {
                                ?>
                                    <div class="single-product-detail-information-item">
                                        <div class="single-product-detail-information-item__label">ΕΚΔΟΤΗΣ</div>
                                        <div class="single-product-detail-information-item__value">
                                        <?php 
                                            foreach($publishers as $publisher) {
                                                echo '<a href="'.$publisher->guid.'">'.$publisher->post_title.'</a><br/>';
                                            }	                                    
                                        ?></div>
                                    </div>
                                <?php
                                    }   
                                ?>
                                <?php if ($product->get_weight()) { ?>
                                <div class="single-product-detail-information-item">
                                    <div class="single-product-detail-information-item__label">ΒΑΡΟΣ</div>
                                    <div class="single-product-detail-information-item__value"><?php echo $product->get_weight(); ?> γρ.</div>
                                </div>
                                <?php } ?>
                                <?php 
                                    if($series) {
                                ?>                
                                    <div class="single-product-detail-information-item">
                                        <div class="single-product-detail-information-item__label">ΣΕΙΡΑ</div>
                                        <div class="single-product-detail-information-item__value">
                                        <?php 
                                            foreach ( $series as $series_term ) {
                                                echo $series_term->name .'<br/>';
                                            }            
                                        ?>                    
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php if (get_field('book_miet_code')) { ?>
                                <div class="single-product-detail-information-item">
                                    <div class="single-product-detail-information-item__label">ΚΩΔΙΚΟΣ ΜΙΕΤ</div>
                                    <div class="single-product-detail-information-item__value"><?php echo get_field('book_miet_code'); ?></div>
                                </div>
                                <?php } ?>
                                <?php if (get_field('book_page_number')) { ?>
                                <div class="single-product-detail-information-item">
                                    <div class="single-product-detail-information-item__label">ΑΡΙΘΜΟΣ ΣΕΛΙΔΩΝ</div>
                                    <div class="single-product-detail-information-item__value"><?php echo get_field('book_page_number'); ?></div>
                                </div>
                                <?php } ?>
                                <?php if (get_field('book_eudoxus_code')) { ?>
                                <div class="single-product-detail-information-item">
                                    <div class="single-product-detail-information-item__label">ΚΩΔΙΚΟΣ ΣΤΟ ΕΥΔΟΞΟ</div>
                                    <div class="single-product-detail-information-item__value"><?php echo get_field('book_eudoxus_code'); ?></div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
    $book_contents_file = get_field('book_contents_file', $product->get_id());
    $book_sample_file = get_field('book_sample_file', $product->get_id());
    $book_index_file = get_field('book_index_file', $product->get_id());
    $book_press_kit_file = get_field('book_press_kit_file', $product->get_id());

    $section_class = 'single-product-download-row--center';

    if( !empty($book_contents_file) && !empty($book_sample_file) && !empty($book_index_file) && !empty($book_press_kit_file) ){
        $section_class = '';
    }

    if( !empty($book_contents_file) || !empty($book_sample_file) || !empty($book_index_file) || !empty($book_press_kit_file) ){
?>
        <section class="single-product-download-section">
            <div class="content-container">
                <div class="single-product-download-row <?php echo $section_class; ?>">
                    <?php
                        if( !empty($book_contents_file) ){
                    ?>
                            <div class="single-product-download-col">
                                <a href="<?php echo $book_contents_file['url']; ?>"><div class="single-product-download-label">Περιεχομενα<div class="single-product-download-icon"><?php include get_template_directory() . '/assets/icons/download-icon.svg' ?></div></div></a>
                            </div>
                    <?php
                        }

                        if( !empty($book_sample_file) ){
                    ?>
                            <div class="single-product-download-col">
                                <a href="<?php echo $book_sample_file['url']; ?>"><div class="single-product-download-label">δειγμα<div class="single-product-download-icon"><?php include get_template_directory() . '/assets/icons/download-icon.svg' ?></div></div></a>
                            </div>
                    <?php
                        }

                        if( !empty($book_index_file) ){
                    ?>
                            <div class="single-product-download-col">
                                <a href="<?php echo $book_index_file['url']; ?>"><div class="single-product-download-label">ευρετηριο<div class="single-product-download-icon"><?php include get_template_directory() . '/assets/icons/download-icon.svg' ?></div></div></a>
                            </div>
                    <?php
                        }

                        if( !empty($book_press_kit_file) ){
                    ?>
                            <div class="single-product-download-col">
                                <a href="<?php echo $book_press_kit_file['url']; ?>"><div class="single-product-download-label">press kit<div class="single-product-download-icon"><?php include get_template_directory() . '/assets/icons/download-icon.svg' ?></div></div></a>
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

<?php if( have_rows('book_reviews') || have_rows('book_audio_repeater') || have_rows('book_videos') || get_field('book_related_articles')  ) { ?>
<section class="single-product-meta-section">
    <div class="content-container">
        <div class="single-product-meta-tab-row">
            <div class="single-product-meta-tab-col">
                <div class="single-product-meta-tab-item active" data-section-id="review">Βιβλιοκρισίες</div>
            </div>
            <div class="single-product-meta-tab-col">
                <div class="single-product-meta-tab-item" data-section-id="audio">Audio</div>
            </div>
            <div class="single-product-meta-tab-col">
                <div class="single-product-meta-tab-item" data-section-id="video">Video</div>
            </div>
            <div class="single-product-meta-tab-col">
                <div class="single-product-meta-tab-item" data-section-id="article">Σχετικά  Άρθρα</div>
            </div>
        </div>
        <div class="single-product-meta-tab-content-row">
            <div id="single-product-meta-tab-content--review" class="single-product-meta-tab-content-col">
                <div class="single-product-review-wrapper" is="mieteshop-product-review-slider">
                    <div class="swiper-container" data-slider>
                        <div class="swiper-wrapper">
                            <?php
                                if( have_rows('book_reviews') ) { 
                                while( have_rows('book_reviews') ) : the_row();    
                                ?>
                                    <div class="swiper-slide">
                                        <div class="single-product-review">
                                            <div class="single-product-review__content">
                                                <p><?php echo get_sub_field('book_reviews_text'); ?></p>
                                            </div>
                                            <div class="single-product-review__autor"><a href="<?php echo get_sub_field('book_reviews_source_link'); ?>"><?php echo get_sub_field('book_reviews_source_text'); ?></a></div>
                                        </div>
                                    </div>
                                <?php
                                endwhile;
                                }
                            ?>
                        </div>
                    </div>
                    <div class="single-product-review-pagination-wrapper" data-pagination></div>
                </div>
            </div>
            <div id="single-product-meta-tab-content--audio" class="single-product-meta-tab-content-col hide">
                <div class="single-product-audio-wrapper" is="mieteshop-product-audio-slider">
                <div class="swiper-container" data-slider>
                    <div class="swiper-wrapper">
                        <?php
                            if( have_rows('book_audio_repeater') ) { 
                            while( have_rows('book_audio_repeater') ) : the_row();    
                            ?>
                                <div class="swiper-slide">
                                    <div class="single-product-audio-row">
                                        <div class="single-product-audio__content">
                                            <p><?php echo get_sub_field('book_audio_embed_code'); ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            endwhile;
                            }
                            ?>
                    </div>
                </div>
                <div class="single-product-audio-pagination-wrapper" data-pagination></div>
                </div>
            </div>
            <div id="single-product-meta-tab-content--video" class="single-product-meta-tab-content-col hide">
                <div class="single-product-video-wrapper" is="mieteshop-product-video-slider">
                    <div class="swiper-container" data-slider>
                        <div class="swiper-wrapper">
                            <?php
                            if( have_rows('book_videos') ) { 
                                //var_dump(get_field('book_videos'));
                                while( have_rows('book_videos') ) : the_row();  
                            ?>
                                    <div class="swiper-slide">
                                        <div class="single-product-video-item-row">
                                            <div class="single-product-video-item-left-col">
                                                <?php echo get_sub_field('book_video_embed_code'); ?>    
                                                <?php //$video_image_url = get_template_directory_uri() . '/assets/images/video.png'; 
                                                    $video_image_url = get_sub_field('book_video_cover_image');
                                                ?>
                                                <div class="single-product-video-image-wrapper">
                                                    <!--img class="lazyload" src="<?php echo $video_image_url; ?>" data-src="<?php echo $video_image_url; ?>" alt="video image"-->
                                                    <!--div class="single-product-video-play-icon"><?php include get_template_directory() . '/assets/icons/video-play-icon.svg' ?></div>
                                                    <div class="single-product-video-resize-icon"><?php include get_template_directory() . '/assets/icons/resize-icon.svg' ?></div-->
                                                </div>
                                            </div>
                                            <div class="single-product-video-item-right-col">
                                                <div class="single-product-video-item-content">
                                                    <h2><?php echo get_sub_field('book_video_title'); ?></h2>
                                                    <p><?php echo get_sub_field('book_video_description'); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                endwhile;
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
                                $related_articles = get_field('book_related_articles');
                                foreach($related_articles as $article) {
                                    //echo '<a href="'.$publisher->guid.'">'.$publisher->post_title.'</a><br/>';
                                    //var_dump($article);
                            ?>
                                    <div class="single-product-blog-item swiper-slide">
                                        <div class="single-product-blog-item-inner">
                                            <?php $blog_image_url = wp_get_attachment_url( get_post_thumbnail_id($article->ID) ); //get_template_directory_uri() . '/assets/images/blog.png'; ?>
                                            <div class="single-product-blog-image">
                                                <a href="<?php echo $article->guid; ?>"><img
                                                    class="lazyload"
                                                    src="<?php echo placeholderImage(399, 261); ?>"
                                                    data-src="<?php echo $blog_image_url; ?>"
                                                    alt="video image"></a>
                                            </div>
                                            <div class="single-product-blog-content">
                                                <h2><?php echo '<a href="'.$article->guid.'">' .$article->post_title .'</a>'; ?></h2>
                                                <p><?php echo $article->post_excerpt; ?></p>
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
<?php } ?>
<?php
    // Related products are found from category and tag
    $tags_array = array(0);
    $cats_array = array(0);
    // Get tags
    $terms = wp_get_post_terms($product->id, 'product_tag');
    foreach ( $terms as $term ) $tags_array[] = $term->term_id;
    // Get categories
    $terms = wp_get_post_terms($product->id, 'product_cat');
    foreach ( $terms as $key => $term ){
        $check_for_children = get_categories(array('parent' => $term->term_id, 'taxonomy' => 'product_cat'));
        if(empty($check_for_children)){
            $cats_array[] = $term->term_id;
        }
    }
    // Don't bother if none are set
    if ( sizeof($cats_array)==1 && sizeof($tags_array)==1 ) return array();
    // Meta query
    $meta_query = array();
    //$meta_query[] = $woocommerce->query->visibility_meta_query();
    //$meta_query[] = $woocommerce->query->stock_status_meta_query();
    //$meta_query   = array_filter( $meta_query );
    // Get the posts
    $args = array(
            'orderby'        => 'rand',
            'posts_per_page' => 16,
            'post_type'      => 'product',
            'fields'         => 'ids',
            'meta_query'     => $meta_query,
            'tax_query'      => array(
                'relation'      => 'OR',
                array(
                    'taxonomy'     => 'product_cat',
                    'field'        => 'id',
                    'terms'        => $cats_array
                ),
                array(
                    'taxonomy'     => 'product_tag',
                    'field'        => 'id',
                    'terms'        => $tags_array
                )
            )
        );
    //$related_posts = array_diff( $related_posts, array( $product->id ), $product->get_upsells() );

    //$args = [
    //    'post_type' => 'product',
    //    'posts_per_page' => 16,
    //];
    $related_posts = new WP_Query( $args );
    
    if ( $related_posts->have_posts() ) {
?>
<div class="single-product-realted-section">
    <div class="content-container">
        <div class="single-product-realted-title">
            <h2>ΣΧΕΤΙΚΟΙ ΤΙΤΛΟΙ</h2> <!-- RELATED PRODUCTS -->
        </div>
        <div class="pcat-results-row">
            <?php
                while ( $related_posts->have_posts() ){
                    $related_posts->the_post();
                    global $product;

                    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $product->get_id() ), 'full' );
                        $authors = get_field('book_contributors_syggrafeas', $product->get_id());
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
                                <div class="pcat-result-item-title"><h3><a href="<?php echo get_permalink($product->get_id()); ?>"><?php echo $product->get_name(); ?></a></h3></div>
                            </div>
                            <div class="pcat-result-item-footer-row">
                                <div class="pcat-result-item-footer-col">
                                    <div class="pcat-result-item-footer-product-price">
                                        <?php echo $product->get_price_html(); ?>
                                    </div>
                                </div>
                                <div class="pcat-result-item-footer-col">
                                    <?php echo display_percentage_discount( $product->get_id() ); ?>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                }
                
                wp_reset_query();
            ?>
        </div>
    </div>
</div>
<?php
    }
?>

<?php 
    // Get recently viewed product cookies data
    $viewed_products = ! empty( $_COOKIE['woocommerce_recently_viewed'] ) ? (array) explode( '|', $_COOKIE['woocommerce_recently_viewed'] ) : array();
    $viewed_products = array_filter( array_map( 'absint', $viewed_products ) );
    // If no data, quit
    /*
    if ( empty( $viewed_products ) )
        return __( 'You have not viewed any product yet!', 'rc_wc_rvp' );
    */    
    // Create the object
    ob_start();
    // Get products per page
    if( !isset( $per_page ) ? $number = 4 : $number = $per_page )
    // Create query arguments array
    $query_args = array(
                    'posts_per_page' => $number,
                    'no_found_rows'  => 1,
                    'post_status'    => 'publish',
                    'post_type'      => 'product',
                    'post__in'       => $viewed_products,
                    'orderby'        => 'rand'
                    );
    // Add meta_query to query args
    $query_args['meta_query'] = array();
    // Check products stock status
    //$query_args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
    // Create a new query
    $loop = new WP_Query($query_args);

    // ----
    if (!empty($loop)) {

?>
<div class="single-product-recently-section">
    <div class="content-container">
        <div class="single-product-recently-title">
            <h2>ΕΙΔΑΤΕ ΠΡΟΣΦΑΤΑ</h2> <!-- RECENTLY VIEWED PRODUCTS -->
        </div>
        <div class="pcat-results-row">
            <?php

                /* 
                $args = [
                    'post_type' => 'product',
                    'posts_per_page' => 4,
                ];
            
                $loop = new WP_Query( $args );
                */    
                while ( $loop->have_posts() ){
                    $loop->the_post();
                    
                    global $product;

                    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $product->get_id() ), 'full' );
                    $authors = get_field('book_contributors_syggrafeas', $product->get_id());
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
                                <div class="pcat-result-item-title"><h3><a href="<?php echo get_permalink($product->get_id()); ?>"><?php echo $product->get_name(); ?></a></h3></div>
                            </div>
                            <div class="pcat-result-item-footer-row">
                                <div class="pcat-result-item-footer-col">
                                    <div class="pcat-result-item-footer-product-price">
                                        <?php echo $product->get_price_html(); ?>
                                    </div>
                                </div>
                                <div class="pcat-result-item-footer-col">
                                    <?php echo display_percentage_discount( $product->get_id() ); ?>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                }
                wp_reset_query();
            ?>
        </div>
    </div>
</div>

<?php } ?>