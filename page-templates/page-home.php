<?php
/**
 * Template Name: Home Page
 */
?>
<?php get_header(); ?>

<?php
    if ( have_posts() ) {
        while ( have_posts() ){
            the_post();
?>
<section class="three-banner">
    <?php
        $top_banner_2 = get_field('top_banner_2');
        $top_banner_3 = get_field('top_banner_3');
    ?>
    <div class="wide-container">
        <div class="three-banner-row">
            <div class="three-banner-left-col">
                <div class="three-banner-1-slider-wrapper" is="mieteshop-three-banner-1-slider">
                    <div class="swiper-container" data-slider>
                        <div class="swiper-wrapper">
                            <?php
                                if( have_rows('top_banner_1_list') ){
                                    while( have_rows('top_banner_1_list') ){
                                        the_row();
                                        $image = get_sub_field('image');
                            ?>
                                        <div class="swiper-slide">
                                            <div class="three-banner-1">
                                                <img
                                                    class="lazyload"
                                                    src="<?php echo placeholderImage(720, 400); ?>"
                                                    data-src="<?php echo aq_resize($image['url'], 720, 400, true); ?>"
                                                    alt="<?php echo $image['alt']; ?>">
                                                <div class="three-banner-1-content">
                                                    <h2><?php echo get_sub_field('title'); ?></h2>
                                                    <p><?php echo get_sub_field('content'); ?></p>
                                                    <div class="three-banner-1-link">
                                                        <?php $top_banner_1_link = get_sub_field('link'); ?>
                                                        <a href="<?php echo $top_banner_1_link['url']; ?>"><?php echo $top_banner_1_link['title']; ?></a>
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
                    <div class="three-banner-1-slider-nav-wrapper">
                        <div data-slider-button="prev" class="three-banner-1-slider-nav three-banner-1-slider-nav--prev"><?php include get_template_directory() . '/assets/icons/slider-prev-icon.svg'; ?></div>
                        <div data-slider-button="next" class="three-banner-1-slider-nav three-banner-1-slider-nav--next"><?php include get_template_directory() . '/assets/icons/slider-next-icon.svg'; ?></div>
                    </div>
                </div>
            </div>
            <div class="three-banner-right-col">
                <?php
                    $top_banner_2_link = get_field('top_banner_2_link');
                    $top_banner_3_link = get_field('top_banner_3_link');
                ?>
                <div class="three-banner-2">
                    <a href="<?php echo $top_banner_2_link; ?>">
                        <img
                            class="lazyload"
                            src="<?php echo placeholderImage(512, 230); ?>"
                            data-src="<?php echo aq_resize($top_banner_2['url'], 512, 230, true); ?>"
                            alt="<?php echo $top_banner_2['alt']; ?>">
                    </a>
                </div>
                <div class="three-banner-3">
                    <div class="three-banner-3-inner">
                        <a href="<?php echo $top_banner_3_link; ?>">
                            <img
                                class="lazyload"
                                src="<?php echo placeholderImage(512, 154); ?>"
                                data-src="<?php echo aq_resize($top_banner_3['url'], 512, 154, true); ?>"
                                alt="<?php echo $top_banner_3['alt']; ?>">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="book-slider book-slider--border-bottom" is="mieteshop-book-slider">
    <div class="book-slider-container">
        <div class="book-slider-title">
            <h2>ΝΕΕΣ ΚΥΚΛΟΦΟΡΙΕΣ</h2>
        </div>
        <div class="book-slider-wrapper">
            <div class="swiper-container" data-slider>
                <div class="swiper-wrapper">
                    <?php
                        $homepage_new_releases_rel = get_field('homepage_new_releases_rel');

                        foreach($homepage_new_releases_rel as $release){
                            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $release->ID ), 'full' );
                            $authors = get_field('book_contributors_syggrafeas', $release->ID);
                    ?>
                            <div class="swiper-slide">
                                <div class="book-slider-item">
                                    <div class="book-slider-image">
                                        <img
                                            class="lazyload"
                                            src="<?php echo placeholderImage($image[1], $image[2]); ?>"
                                            data-src="<?php echo aq_resize($image[0], $image[1], $image[2], true); ?>"
                                            alt="<?php echo $release->post_title; ?>">
                                    </div>
                                    <div class="book-slider-info">
                                        <?php
                                            if( !empty($authors) ){
                                                echo '<div class="book-slider-author-list">';
                                                if( count($authors) > 3 ){
                                                    echo '<div class="book-slider-author-item">Συλλογικό Έργο</div>';
                                                } else {
                                                    foreach( $authors as $author ){
                                                        echo '<div class="book-slider-author-item"><a href="'. get_permalink($author->ID) . '">' . $author->post_title . '</a></div>';
                                                    }
                                                }
                                                echo '</div>';
                                            }
                                        ?>
                                        <div class="book-slider-product-title">
                                            <a href="<?php echo get_permalink($release->ID); ?>"><h3><?php echo $release->post_title; ?></h3></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
            <div class="book-slider-nav-wrapper">
                <div data-slider-button="prev" class="book-slider-nav book-slider-nav--prev"><?php include get_template_directory() . '/assets/icons/slider-prev-icon.svg'; ?></div>
                <div data-slider-button="next" class="book-slider-nav book-slider-nav--next"><?php include get_template_directory() . '/assets/icons/slider-next-icon.svg'; ?></div>
            </div>
        </div>
    </div>
</section>
<section class="book-slider" is="mieteshop-book-slider">
    <div class="book-slider-container">
        <div class="book-slider-title">
            <h2>ΣΠΑΝΙΕΣ ΕΚΔΟΣΕΙΣ</h2>
        </div>
        <div class="book-slider-wrapper">
            <div class="swiper-container" data-slider>
                <div class="swiper-wrapper">
                    <?php
                        $homepage_rare_editions_rel = get_field('homepage_rare_editions_rel');

                        foreach($homepage_rare_editions_rel as $edition){
                            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $edition->ID ), 'full' );
                            $authors = get_field('book_contributors_syggrafeas', $edition->ID);
                    ?>
                            <div class="swiper-slide">
                                <div class="book-slider-item">
                                    <div class="book-slider-image">
                                        <img
                                            class="lazyload"
                                            src="<?php echo placeholderImage($image[1], $image[2]); ?>"
                                            data-src="<?php echo aq_resize($image[0], $image[1], $image[2], true); ?>"
                                            alt="<?php echo $edition->post_title; ?>">
                                    </div>
                                    <div class="book-slider-info">
                                        <?php
                                            if( !empty($authors) ){
                                                echo '<div class="book-slider-author-list">';
                                                if( count($authors) > 3 ){
                                                    echo '<div class="book-slider-author-item">Συλλογικό Έργο</div>';
                                                } else {
                                                    foreach( $authors as $author ){
                                                        echo '<div class="book-slider-author-item"><a href="'. get_permalink($author->ID) . '">' . $author->post_title . '</a></div>';
                                                    }
                                                }
                                                echo '</div>';
                                            }
                                        ?>
                                        <div class="book-slider-product-title">
                                            <a href="<?php echo get_permalink($release->ID); ?>"><h3><?php echo $release->post_title; ?></h3></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
            <div class="book-slider-nav-wrapper">
                <div data-slider-button="prev" class="book-slider-nav book-slider-nav--prev"><?php include get_template_directory() . '/assets/icons/slider-prev-icon.svg'; ?></div>
                <div data-slider-button="next" class="book-slider-nav book-slider-nav--next"><?php include get_template_directory() . '/assets/icons/slider-next-icon.svg'; ?></div>
            </div>
        </div>
    </div>
</section>
<section class="home-offers-section">
    <div class="container">
        <div class="home-offers-title">
            <h2>ΠΡΟΣΦΟΡΕΣ</h2>
        </div>
        <div class="home-offers-row">
            <?php
                $homepage_offers_rel = get_field('homepage_offers_rel');

                foreach($homepage_offers_rel as $offer){
                    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $offer->ID ), 'full' );
                    $authors = get_field('book_contributors_syggrafeas', $offer->ID);
            ?>
                    <div class="home-offers-col">
                        <div class="home-offers-image">
                            <img
                                class="lazyload"
                                src="<?php echo placeholderImage($image[1], $image[2]); ?>"
                                data-src="<?php echo aq_resize($image[0], $image[1], $image[2], true); ?>"
                                alt="<?php echo $offer->post_title; ?>">
                        </div>
                        <div class="home-offers-info">
                            <?php
                                if( !empty($authors) ){
                                    echo '<div class="home-offers-author-list">';
                                    if( count($authors) > 3 ){
                                        echo '<div class="home-offers-author-item">Συλλογικό Έργο</div>';
                                    } else {
                                        foreach( $authors as $author ){
                                            echo '<div class="home-offers-author-item"><a href="'. get_permalink($author->ID) . '">' . $author->post_title . '</a></div>';
                                        }
                                    }
                                    echo '</div>';
                                }
                            ?>
                            <div class="home-offers-product-title">
                                <a href="<?php echo get_permalink($offer->ID); ?>"><h3><?php echo $offer->post_title; ?></h3></a>
                            </div>
                        </div>
                    </div>
            <?php
                }
            ?>
        </div>
        <div class="home-offers-link">
            <a href="#">δείτε όλες τις Προσφορές</a>
        </div>
    </div>
</section>
<section class="middle-banner">
    <?php
        $middle_banner_1 = get_field('middle_banner_1');
        $middle_banner_1_link = get_field('middle_banner_1_link');
        $middle_banner_2 = get_field('middle_banner_2');
        $middle_banner_2_link = get_field('middle_banner_2_link');
    ?>
    <div class="wide-container">
        <div class="middle-banner-row">
			<div class="middle-banner-col">	
				<?php
                    if( !empty( $middle_banner_1 ) ){
                ?>
                        <a href="<?php echo esc_url($middle_banner_1_link); ?>">
                            <div class="middle-banner-image">
                                <img
                                    class="lazyload"
                                    src="<?php echo placeholderImage(620, 230); ?>"
                                    data-src="<?php echo aq_resize($middle_banner_1['url'], 620, 230, true); ?>"
                                    alt="<?php echo $middle_banner_1['alt']; ?>">
                            </div>
                        </a>
				<?php
                    }
                ?>
			</div>
			<div class="middle-banner-col">	
				<?php 
				    if( !empty( $middle_banner_2 ) ){
                ?>
                        <a href="<?php echo esc_url($middle_banner_2_link); ?>">
                            <div class="middle-banner-image">
                                <img
                                    class="lazyload"
                                    src="<?php echo placeholderImage(620, 230); ?>"
                                    data-src="<?php echo aq_resize($middle_banner_2['url'], 620, 230, true); ?>"
                                    alt="<?php echo $middle_banner_2['alt']; ?>">
                            </div>
                        </a>
				<?php
                    }
                ?>
			</div>	
        </div>
	</div>
</section>
<section class="home-book-week-section">
    <div class="small-container">
        <div class="home-book-week-title">
            <h2>ΤΟ ΒΙΒΛΙΟ ΤΗΣ ΕΒΔΟΜΑΔΑΣ</h2>
        </div>
        <?php
            $weekbook = get_field('book_of_the_week');
            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $weekbook->ID ), 'full' );
            $authors = get_field('book_contributors_syggrafeas', $weekbook->ID);
            $weekbook_product = wc_get_product( $weekbook->ID );
        ?>
        <div class="home-book-week-row">
            <div class="home-book-week-left">
                <img
                    class="lazyload"
                    src="<?php echo placeholderImage($image[1], $image[2]); ?>"
                    data-src="<?php echo aq_resize($image[0], $image[1], $image[2], true); ?>"
                    alt="<?php echo $weekbook->post_title; ?>">
            </div>
            <div class="home-book-week-right">
                <?php
                    if( !empty($authors) ){
                        echo '<div class="home-book-week-author-list">';
                        if( count($authors) > 3 ){
                            echo '<div class="home-book-week-author-item">Συλλογικό Έργο</div>';
                        } else {
                            foreach( $authors as $author ){
                                echo '<div class="home-book-week-author-item"><a href="'. get_permalink($author->ID) . '">' . $author->post_title . '</a></div>';
                            }
                        }
                        echo '</div>';
                    }
                ?>
                <div class="home-book-week-product-title">
                    <h3><?php echo $weekbook->post_title; ?></h3>
                </div>
                <div class="home-book-week-product-content">
                    <p><?php echo mb_substr(strip_tags($weekbook->post_content), 0, 600, 'UTF-8'); ?> »</p>
                </div>
                <div class="home-book-week-product-meta-row">
                    <div class="home-book-week-product-meta-col">
                        <div class="home-book-week-product-price">
                            <?php echo $weekbook_product->get_price_html(); ?>
                        </div>
                    </div>
                    <div class="home-book-week-product-meta-col">
                        <div class="home-book-week-product-discount">-30%</div>
                    </div>
                    <div class="home-book-week-product-meta-col">
                        <div class="home-book-week-product-favorite">
                            <a href="#"><span><?php include get_template_directory() . '/assets/icons/favorite-small-icon.svg' ?></span></a>
                        </div>
                    </div>
                    <div class="home-book-week-product-meta-col">
                        <div class="home-book-week-product-busket">
                            <a href="#"><span><?php include get_template_directory() . '/assets/icons/busket-small-icon.svg' ?></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="book-slider book-slider--border-bottom" is="mieteshop-book-slider">
    <div class="book-slider-container">
        <div class="book-slider-title">
            <h2>ΕΚΔΟΤΙΚΕΣ ΠΡΟΤΑΣΕΙΣ</h2>
            <p>ΕΚΔΟΣΕΙΣ ΑΚΑΔΗΜΙΑΣ ΑΘΗΝΩΝ</p>
        </div>
        <div class="book-slider-wrapper">
            <div class="swiper-container" data-slider>
                <div class="swiper-wrapper">
                    <?php
                        $homepage_publisher_suggestions_rel = get_field('homepage_publisher_suggestions_rel');

                        foreach($homepage_publisher_suggestions_rel as $publisher){
                            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $publisher->ID ), 'full' );
                            $authors = get_field('book_contributors_syggrafeas', $publisher->ID);
                    ?>
                            <div class="swiper-slide">
                                <div class="book-slider-item">
                                    <div class="book-slider-image">
                                        <img
                                            class="lazyload"
                                            src="<?php echo placeholderImage($image[1], $image[2]); ?>"
                                            data-src="<?php echo aq_resize($image[0], $image[1], $image[2], true); ?>"
                                            alt="<?php echo $publisher->post_title; ?>">
                                    </div>
                                    <div class="book-slider-info">
                                        <?php
                                            if( !empty($authors) ){
                                                echo '<div class="book-slider-author-list">';
                                                if( count($authors) > 3 ){
                                                    echo '<div class="book-slider-author-item">Συλλογικό Έργο</div>';
                                                } else {
                                                    foreach( $authors as $author ){
                                                        echo '<div class="book-slider-author-item"><a href="'. get_permalink($author->ID) . '">' . $author->post_title . '</a></div>';
                                                    }
                                                }
                                                echo '</div>';
                                            }
                                        ?>
                                        <div class="book-slider-product-title">
                                            <a href="<?php echo get_permalink($release->ID); ?>"><h3><?php echo $release->post_title; ?></h3></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
            <div class="book-slider-nav-wrapper">
                <div data-slider-button="prev" class="book-slider-nav book-slider-nav--prev"><?php include get_template_directory() . '/assets/icons/slider-prev-icon.svg'; ?></div>
                <div data-slider-button="next" class="book-slider-nav book-slider-nav--next"><?php include get_template_directory() . '/assets/icons/slider-next-icon.svg'; ?></div>
            </div>
        </div>
    </div>
</section>
<section class="book-slider" is="mieteshop-book-slider">
    <div class="book-slider-container">
        <div class="book-slider-title">
            <h2>ΘΕΜΑΤΙΚΕΣ ΠΡΟΤΑΣΕΙΣ</h2>
            <p>ΤΕΧΝΕΣ & ΘΕΑΤΡΟ</p>
        </div>
        <div class="book-slider-wrapper">
            <div class="swiper-container" data-slider>
                <div class="swiper-wrapper">
                    <?php
                        $homepage_thematic_suggestions_rel = get_field('homepage_thematic_suggestions_rel');

                        foreach($homepage_thematic_suggestions_rel as $thematic){
                            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $thematic->ID ), 'full' );
                            $authors = get_field('book_contributors_syggrafeas', $thematic->ID);
                    ?>
                            <div class="swiper-slide">
                                <div class="book-slider-item">
                                    <div class="book-slider-image">
                                        <img
                                            class="lazyload"
                                            src="<?php echo placeholderImage($image[1], $image[2]); ?>"
                                            data-src="<?php echo aq_resize($image[0], $image[1], $image[2], true); ?>"
                                            alt="<?php echo $thematic->post_title; ?>">
                                    </div>
                                    <div class="book-slider-info">
                                        <?php
                                            if( !empty($authors) ){
                                                echo '<div class="book-slider-author-list">';
                                                if( count($authors) > 3 ){
                                                    echo '<div class="book-slider-author-item">Συλλογικό Έργο</div>';
                                                } else {
                                                    foreach( $authors as $author ){
                                                        echo '<div class="book-slider-author-item"><a href="'. get_permalink($author->ID) . '">' . $author->post_title . '</a></div>';
                                                    }
                                                }
                                                echo '</div>';
                                            }
                                        ?>
                                        <div class="book-slider-product-title">
                                            <a href="<?php echo get_permalink($release->ID); ?>"><h3><?php echo $release->post_title; ?></h3></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
            <div class="book-slider-nav-wrapper">
                <div data-slider-button="prev" class="book-slider-nav book-slider-nav--prev"><?php include get_template_directory() . '/assets/icons/slider-prev-icon.svg'; ?></div>
                <div data-slider-button="next" class="book-slider-nav book-slider-nav--next"><?php include get_template_directory() . '/assets/icons/slider-next-icon.svg'; ?></div>
            </div>
        </div>
    </div>
</section>
<section class="home-authors-section">
    <div class="small-container">
        <div class="home-authors-title">
            <h2>ΟΙ ΣΥΓΓΡΑΦΕΙΣ ΤΟΥ ΜΗΝΑ</h2>
        </div>
        <div class="home-authors-row">
            <?php
                $homepage_authors_of_the_month_rel = get_field('homepage_authors_of_the_month_rel');

                foreach( $homepage_authors_of_the_month_rel as $author ){
                    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $author->ID ), 'full' );
            ?>
                    <div class="home-authors-col">
                        <div class="home-authors-image">
                            <img
                                class="lazyload"
                                src="<?php echo placeholderImage($image[1], $image[2]); ?>"
                                data-src="<?php echo aq_resize($image[0], $image[1], $image[2], true); ?>"
                                alt="<?php echo $author->post_title; ?>">
                        </div>
                        <div class="home-authors-name">
                            <h3><?php echo $author->post_title; ?></h3>
                        </div>
                    </div>
            <?php
                }
            ?>
        </div>
    </div>
</section>
<section class="home-blog">
    <div class="small-container">
        <div class="home-blog-title">
            <h2>ΝΕΑ & ΕΚΔΗΛΩΣΕΙΣ</h2>
        </div>
        <div class="home-blog-slider-wrapper"  is="mieteshop-home-blog-slider">
            <div class="swiper-container" data-slider>
                <div class="swiper-wrapper">
                    <?php
                        $homepage_blog_posts_rel = get_field('homepage_blog_posts_rel');

                        $greek_month_list = ['ΙΑΝ', 'ΦΕΒ', 'ΜΆΡ', 'ΑΠΡ', 'ΜΆΙ', 'ΙΟΎΝ', 'ΙΟΎΛ', 'ΑΎΓ', 'ΣΕΠ', 'ΟΚΤ', 'ΝΟΈ', 'ΔΕΚ'];

                        foreach( $homepage_blog_posts_rel as $blog ){
                            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $blog->ID ), 'full' );
                    ?>
                            <div class="swiper-slide">
                                <div class="home-blog-item">
                                    <div class="home-blog-item-image">
                                        <img
                                            class="lazyload"
                                            src="<?php echo placeholderImage($image[1], $image[2]); ?>"
                                            data-src="<?php echo aq_resize($image[0], $image[1], $image[2], true); ?>"
                                            alt="<?php echo $blog->post_title; ?>">
                                    </div>
                                    <div class="home-blog-item-meta-row">
                                        <div class="home-blog-item-category-list">
                                            <?php
                                                $category_list = get_the_category($blog->ID);

                                                foreach( $category_list as $category ){
                                            ?>
                                                    <div class="home-blog-item-category-col"><a href="#"><?php echo $category->name; ?></a></div>
                                            <?php
                                                }
                                            ?>
                                        </div>
                                        <div class="home-blog-item-date"><?php echo get_the_date('j', $blog->ID); ?> <?php echo $greek_month_list[get_the_date('n', $blog->ID) - 1]; ?> <?php echo get_the_date('Y', $blog->ID); ?></div>
                                    </div>
                                    <div class="home-blog-item-title">
                                        <h3><?php echo $blog->post_title; ?></h3>
                                    </div>
                                    <div class="home-blog-item-bottom-row">
                                        <div class="home-blog-item-bottom-left-col">
                                            <div class="home-blog-item-duration-row">
                                                <div class="home-blog-item-duration-col">
                                                    <div class="home-blog-item-duration-label">ΑΠΟ</div>
                                                    <div class="home-blog-item-duration-date">2 ΦΕΒ 2021</div>
                                                </div>
                                                <div class="home-blog-item-duration-col">
                                                    <div class="home-blog-item-duration-label">ΕΩΣ</div>
                                                    <div class="home-blog-item-duration-date">15 ΜΑΡ 2021</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="home-blog-item-bottom-right-col">
                                            <div class="home-blog-item-excerpt">
                                                <?php echo $blog->post_excerpt; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
            <div class="home-blog-slider-nav-wrapper">
                <div data-slider-button="prev" class="home-blog-slider-nav home-blog-slider-nav--prev"><?php include get_template_directory() . '/assets/icons/slider-prev-icon.svg'; ?></div>
                <div data-slider-button="next" class="home-blog-slider-nav home-blog-slider-nav--next"><?php include get_template_directory() . '/assets/icons/slider-next-icon.svg'; ?></div>
            </div>
        </div>
    </div>
</section>
<?php
        }
    }
?>

<?php get_footer(); ?>