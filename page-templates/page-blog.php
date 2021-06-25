<?php
/**
 * Template Name: Blog Page
 */
global $post;
?>
<?php get_header(); ?>

<section class="breadcrumb-section">
    <div class="content-container">
        <div class="breadcrumb-list">
            <div class="breadcrumb-item"><a href="#">Εκδηλώσεις</a></div>
            <div class="breadcrumb-item"><a href="#">Εκθέσεις</a></div>
        </div>
    </div>
</section>
<section class="blog-hero-section">
    <div class="content-container">
        <div class="blog-hero-inner">
            <div class="blog-hero-inner">
                <div class="blog-hero-filter-select-row">
                    <div class="blog-hero-filter-select">
                        <select>
                            <option value="1">Χρονολογική</option>
                        </select>
                        <div class="blog-hero-filter-select-icon"><?php include get_template_directory() . '/assets/icons/arrow-down-white-icon.svg'; ?></div>
                    </div>
                </div>
            </div>
            <?php
                $blog_hero_image_url = get_template_directory_uri() . '/assets/images/blog-hero.png';
            ?>
            <div class="blog-hero-image">
                <img
                    class="lazyload"
                    src="<?php echo placeholderImage(1024, 585); ?>"
                    data-src="<?php echo $blog_hero_image_url; ?>"
                    alt="video image">
            </div>
            <div class="blog-hero-content">
                <div class="blog-hero-content-inner">
                    <div class="blog-hero-content-meta-row">
                        <div class="blog-hero-content-category-list">
                            <div class="blog-hero-content-category-col"><a href="#">Θεατρική Παράσταση</a></div>
                        </div>
                        <div class="blog-hero-content-date">14 NOE 2021</div>
                    </div>
                    <div class="blog-hero-content-info">
                        <h2>Το ποτάμι που ήθελε να γυρίσει πίσω. Ένα μουσικό παραμύθι για παιδιά 5-9 ετών.</h2>
                    </div>
                    <div class="blog-hero-content-des">
                        <p>Πριν από λίγες ημέρες, το Φεστιβάλ Αθηνών και Επιδαύρου παρουσίασε το Open Plan, μία σειρά πρωτότυπων ερευνητικών δράσεων μέσα στη χειμερινή σαιζόν. Εκτός από τα workshops που έχουν ήδη προγραμματιστεί για επαγγελματίες και κοινό, δεν θα μπορούσε να μην περιλαμβάνει και δράσεις για τους μικρούς λάτρεις του θεάτρου.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="blog-result-section">
    <div class="small-container">
        <div class="blog-result-row">
            <?php
                $greek_month_list = ['ΙΑΝ', 'ΦΕΒ', 'ΜΆΡ', 'ΑΠΡ', 'ΜΆΙ', 'ΙΟΎΝ', 'ΙΟΎΛ', 'ΑΎΓ', 'ΣΕΠ', 'ΟΚΤ', 'ΝΟΈ', 'ΔΕΚ'];

                $args = [
                    'post_type' => 'post',
                    'posts_per_page' => -1,
                ];
            
                $loop = new WP_Query( $args );
            
                while ( $loop->have_posts() ){
                    $loop->the_post();
                    
                    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
            ?>
                    <div class="blog-result-col">
                        <div class="home-blog-item">
                            <div class="home-blog-item-image">
                                <a href="<?php echo get_permalink($post->ID); ?>">
                                    <img
                                        class="lazyload"
                                        src="<?php echo placeholderImage($image[1], $image[2]); ?>"
                                        data-src="<?php echo aq_resize($image[0], $image[1], $image[2], true); ?>"
                                        alt="<?php echo $post->post_title; ?>">
                                </a>
                            </div>
                            <div class="home-blog-item-meta-row">
                                <div class="home-blog-item-category-list">
                                    <?php
                                        $category_list = get_the_category($post->ID);

                                        foreach( $category_list as $category ){
                                    ?>
                                            <div class="home-blog-item-category-col"><a href="<?php echo get_term_link($category->term_id); ?>"><?php echo $category->name; ?></a></div>
                                    <?php
                                        }
                                    ?>
                                </div>
                                <div class="home-blog-item-date"><?php echo get_the_date('j', $post->ID); ?> <?php echo $greek_month_list[get_the_date('n', $post->ID) - 1]; ?> <?php echo get_the_date('Y', $post->ID); ?></div>
                            </div>
                            <div class="home-blog-item-title">
                                <h3><a href="<?php echo get_permalink($post->ID); ?>"><?php echo $post->post_title; ?></a></h3>
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
                                        <?php echo $post->post_excerpt; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                }

                wp_reset_query();
            ?>
        </div>
        <div class="pcat-results-footer-options">
            <div class="pcat-results-footer-options-col">
                <div class="pcat-results-navigation">
                    <div class="pcat-results-navigation-row">
                        <div class="pcat-results-navigation-item active"><a href="#">1</a></div>
                        <div class="pcat-results-navigation-item"><a href="#">2</a></div>
                        <div class="pcat-results-navigation-item"><a href="#">3</a></div>
                        <div class="pcat-results-navigation-item"><a href="#">4</a></div>
                        <div class="pcat-results-navigation-item"><span>...</span></div>
                        <div class="pcat-results-navigation-item"><a href="#">33</a></div>
                        <div class="pcat-results-navigation-next"><?php include get_template_directory() . '/assets/icons/arrow-right-icon.svg' ?></div>
                    </div>
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
        <div class="pcat-results-projection-options">
            <div class="pcat-results-footer-select">
                <div class="pcat-results-footer-select-label">Προβολή</div>
                <div class="pcat-results-footer-select-elem">
                    <select>
                        <option value="1">1</option>
                    </select>
                    <div class="pcat-results-footer-select-elem-icon"><?php include get_template_directory() . '/assets/icons/arrow-down-icon.svg'; ?></div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>