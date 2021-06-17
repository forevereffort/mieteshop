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
        $top_banner_1 = get_field('top_banner_1');
        $top_banner_2 = get_field('top_banner_2');
        $top_banner_3 = get_field('top_banner_3');
    ?>
    <div class="wide-container">
        <div class="three-banner-row">
            <div class="three-banner-left-col">
                <div class="three-banner-1">
                    <img
                        class="lazyload"
                        src="<?php echo placeholderImage(720, 400); ?>"
                        data-src="<?php echo aq_resize($top_banner_1['url'], 720, 400, true); ?>"
                        alt="<?php echo $top_banner_1['alt']; ?>">
                    <div class="three-banner-1-content">
                        <h2><?php echo get_field('top_banner_1_title'); ?></h2>
                        <p><?php echo get_field('top_banner_1_content'); ?></p>
                        <div class="three-banner-1-link">
                            <?php $top_banner_1_link = get_field('top_banner_1_link'); ?>
                            <a href="<?php echo $top_banner_1_link['url']; ?>"><?php echo $top_banner_1_link['title']; ?></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="three-banner-right-col">
                <div class="three-banner-2">
                    <img
                        class="lazyload"
                        src="<?php echo placeholderImage(512, 230); ?>"
                        data-src="<?php echo aq_resize($top_banner_2['url'], 512, 230, true); ?>"
                        alt="<?php echo $top_banner_2['alt']; ?>">
                    <div class="three-banner-2-content">
                        <div class="three-banner-2-content-row">
                            <div class="three-banner-2-content-top">
                                <p><?php echo get_field('top_banner_2_label'); ?></p>
                            </div>
                            <div class="three-banner-2-content-bottom">
                                <h2><?php echo get_field('top_banner_2_title'); ?></h2>
                                <div class="three-banner-2-link">
                                    <?php $top_banner_2_link = get_field('top_banner_2_link'); ?>
                                    <a href="<?php echo $top_banner_2_link['url']; ?>"><?php echo $top_banner_2_link['title']; ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="three-banner-3">
                    <img
                        class="lazyload"
                        src="<?php echo placeholderImage(512, 154); ?>"
                        data-src="<?php echo aq_resize($top_banner_3['url'], 512, 154, true); ?>"
                        alt="<?php echo $top_banner_3['alt']; ?>">
                    <div class="three-banner-3-content">
                        <h2><?php echo get_field('top_banner_3_title'); ?></h2>
                        <p><?php echo get_field('top_banner_3_content'); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="book-slider" is="mieteshop-book-slider">
    <div class="wide-container book-slider--border-bottom">
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
    </div>
</section>
<section class="book-slider" is="mieteshop-book-slider">
    <div class="wide-container">
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
    </div>
</section>
<section class="middle-banner">
    <?php
        $middle_banner_1 = get_field('middle_banner_1');
        $middle_banner_1_label = get_field('middle_banner_1_label');
        $middle_banner_1_link = get_field('middle_banner_1_link');
        $middle_banner_1_content = get_field('middle_banner_1_content');
        $middle_banner_2 = get_field('middle_banner_2');
        $middle_banner_2_title = get_field('middle_banner_2_title');
        $middle_banner_2_content = get_field('middle_banner_2_content');
    ?>

    <div class="wide-container">
         <div class="middle-banner-row">
				<div class="col">	
				<?php 
				if( !empty( $middle_banner_1 ) ): ?>
					<a href="<?php echo esc_url($middle_banner_1_link); ?>"><img src="<?php echo esc_url($middle_banner_1['url']); ?>" alt="<?php echo esc_attr($middle_banner_1['alt']); ?>" /></a>
				<?php endif; ?>
				</div>
				<div class="col">	
				<?php 
				if( !empty( $middle_banner_2 ) ): ?>
					<a href="<?php echo esc_url($middle_banner_1_link); ?>"><img src="<?php echo esc_url($middle_banner_2['url']); ?>" alt="<?php echo esc_attr($middle_banner_2['alt']); ?>" /></a>
				<?php endif; ?>
				</div>	
        </div>       				
	</div>	


</section>
<section class="book-slider" is="mieteshop-book-slider">
    <div class="wide-container book-slider--border-bottom">
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
    </div>
</section>
<section class="book-slider" is="mieteshop-book-slider">
    <div class="wide-container">
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
    </div>
</section>
<section class="home-blog">
    <div class="small-container">
        <div class="home-blog-title">
            <h2>ΝΕΑ & ΕΚΔΗΛΩΣΕΙΣ</h2>
        </div>
        <?php
            $homepage_blog_posts_rel = get_field('homepage_blog_posts_rel');

            foreach( $homepage_blog_posts_rel as $blog ){
                $image = wp_get_attachment_image_src( get_post_thumbnail_id( $blog->ID ), 'full' );
        ?>
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
                                    <div class="home-blog-item-category-col"><?php echo $category->name; ?></div>
                            <?php
                                }
                            ?>
                        </div>
                        <div class="home-blog-item-date">
                            <?php echo get_the_date('j', $blog->ID); ?>
                            <?php echo get_the_date('n', $blog->ID); ?>
                            <?php echo get_the_date('Y', $blog->ID); ?>
                        </div>
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
        <?php
            }
        ?>
    </div>
</section>
<?php
        }
    }
?>

<?php get_footer(); ?>