<?php
	get_header();

	global $wp_query, $post;

	// get term of current category page
    $cat = $wp_query->get_queried_object();

	$greek_month_list = ['ΙΑΝ', 'ΦΕΒ', 'ΜΆΡ', 'ΑΠΡ', 'ΜΆΙ', 'ΙΟΎΝ', 'ΙΟΎΛ', 'ΑΎΓ', 'ΣΕΠ', 'ΟΚΤ', 'ΝΟΈ', 'ΔΕΚ'];
?>
<section class="pcat-list-section">
    <div class="content-container">
        <div class="pcat-list-title">
            <h1><?php echo $cat->name; ?></h1>
        </div>
    </div>
</section>
<section class="blog-result-section">
    <div class="general-container">
        <?php
            $posts_per_page = 8;

            $args = [
                'post_type' => 'post',
                'post_status' => 'publish',
                'posts_per_page' => $posts_per_page,
				'cat' => $cat->term_id,
                'order' => 'DESC',
                'orderby' => 'date'
            ];

            $the_query = new WP_Query( $args );
            $total_post_count = $the_query->found_posts;

            if ( $the_query->have_posts() ) {
		?>
				<div class="small-container">
                    <div id="js-blog-cat-result-row" class="blog-result-row" data-nonce="<?php echo wp_create_nonce('blog_cat_result_nonce'); ?>" data-cat-id="<?php echo $cat->term_id; ?>" style="margin-top: 0;">
						<?php
							while ( $the_query->have_posts() ){
								$the_query->the_post();

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
                                        <div class="blog-item-bottom-row">
                                            
                                            <div class="blog-item-bottom-left-col">
                                                <?php if(get_field('event_from_date', $post->ID)) { ?>
                                                <div class="home-blog-item-duration-row">
                                                    <div class="home-blog-item-duration-col">
                                                        <div class="home-blog-item-duration-label">ΑΠΟ</div>
                                                        <div class="home-blog-item-duration-date"><?php echo get_field('event_from_date', $post->ID); ?></div>
                                                    </div>
                                                    <div class="home-blog-item-duration-col">
                                                        <div class="home-blog-item-duration-label">ΕΩΣ</div>
                                                        <div class="home-blog-item-duration-date"><?php echo get_field('event_to_date', $post->ID); ?></div>
                                                    </div>
                                                </div>
                                                <?php } ?>
                                            </div>
                                            <div class="blog-item-bottom-right-col">
                                                <div class="home-blog-item-excerpt">
                                                    <?php echo get_field('post_lead', $post->ID); ?>
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
        <?php
            }

            wp_reset_query();
        ?>
        <div class="small-container">
            <?php
                $page_count = round($total_post_count / $posts_per_page + 0.45);
            ?>
            <div id="js-blog-cat-list-page-navigation" class="pcat-results-footer-options <?php echo $page_count < 2 ? 'hide' : ''; ?>">
                <div class="pcat-results-footer-options-col">
                    <div id="js-blog-cat-results-navigation" class="pcat-results-navigation">
                        <?php
                            require_once dirname(__FILE__) . '/inc/zebra-pagination.php';

                            $pagination = new Zebra_Pagination();
                            $pagination->records($total_post_count);
                            $pagination->records_per_page($posts_per_page);
                            $pagination->selectable_pages(5);
                            $pagination->set_page(1);
                            $pagination->padding(false);
                            $pagination->css_classes([
                                'list' => 'pcat-results-navigation-row',
                                'list_item' => 'js-blog-cat-result-navigation-item pcat-results-navigation-item',
                                'prev' => 'js-blog-cat-result-navigation-item pcat-results-navigation-prev',
                                'next' => 'js-blog-cat-result-navigation-item pcat-results-navigation-next',
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
                            <select id="js-blog-cat-page-list">
                                <?php
                                    for($p = 1; $p <= $page_count; $p++){
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
        </div>
    </div>
</section>

<div id="js-blog-cat-filter-load-spinner" class="load-spinner hide"></div>


<?php get_footer(); ?>