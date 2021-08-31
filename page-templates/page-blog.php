<?php
/**
 * Template Name: Blog Page
 */
global $post;
?>
<?php get_header(); ?>

<?php 
    $greek_month_list = ['ΙΑΝ', 'ΦΕΒ', 'ΜΆΡ', 'ΑΠΡ', 'ΜΆΙ', 'ΙΟΎΝ', 'ΙΟΎΛ', 'ΑΎΓ', 'ΣΕΠ', 'ΟΚΤ', 'ΝΟΈ', 'ΔΕΚ'];
?>
<section class="blog-cat-filter-section">
    <div class="general-container">
        <div class="content-container">
            <div class="blog-cat-filter-select-row">
                <div class="blog-cat-filter-select">
                    <select id="js-blog-cat-filter-select">
                        <option value="0">All</option>
                        <?php
                            $terms = get_terms('category', [
                                'order' => 'name',
                                'orderby' => 'ASC',
                                'hide_empty' => false,
                            ]);

                            foreach( $terms as $term ){
                        ?>
                                <option value="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></option>
                        <?php
                            }
                        ?>
                    </select>
                    <div class="blog-cat-filter-select-icon"><?php include get_template_directory() . '/assets/icons/arrow-down-white-icon.svg'; ?></div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="blog-result-section">
    <div class="general-container">
        <?php
            $posts_per_page = 9;

            $args = [
                'post_type' => 'post',
                'post_status' => 'publish',
                'posts_per_page' => $posts_per_page,
                'order' => 'DESC',
                'orderby' => 'date'
            ];

            $the_query = new WP_Query( $args );
            $total_post_count = $the_query->found_posts;

            $first_blog = [];
            $blog_list = [];

            if ( $the_query->have_posts() ) {
                $index = 0;
                while ( $the_query->have_posts() ){
                    $the_query->the_post();

                    if( $index === 0 ){
                        $first_blog = [
                            'id' => $post->ID,
                            'title' => $post->post_title
                        ];
                    } else {
                        $blog_list[] = [
                            'id' => $post->ID,
                            'title' => $post->post_title
                        ];
                    }

                    $index++;
                }
        ?>
                <div class="content-container">
                    <div id="js-blog-first" class="blog-first">
                        <?php $blog_first_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $first_blog['id'] ), 'full' ); ?>
                        <div class="blog-first-image">
                            <a href="<?php echo get_permalink($first_blog['id']); ?>">
                                <img
                                    class="lazyload"
                                    src="<?php echo placeholderImage($blog_first_image_url[1], $blog_first_image_url[2]); ?>"
                                    data-src="<?php echo aq_resize($blog_first_image_url[0], $blog_first_image_url[1], $blog_first_image_url[2], true); ?>"
                                    alt="<?php echo $first_blog['title']; ?>">
                            </a>    
                        </div>
                        <div class="blog-first-content">
                            <div class="blog-first-content-inner">
                                <div class="blog-first-content-meta-row">
                                    <div class="blog-first-content-category-list">
                                        <div class="blog-first-content-category-col">
                                        <?php
                                            $terms = wp_get_post_terms( $first_blog['id'], 'category' );
                                            foreach ( $terms as $term ) {
                                        ?>
                                                <a href="<?php echo get_term_link($term->term_id); ?>"><?php echo $term->name; ?></a> 
                                        <?php
                                            }
                                        ?>
                                        </div>
                                    </div>
                                    <div class="blog-first-content-date"><?php echo get_the_date('j', $first_blog['id']); ?> <?php echo $greek_month_list[get_the_date('n', $first_blog['id']) - 1]; ?> <?php echo get_the_date('Y', $first_blog['id']); ?></div>
                                </div>
                                <div class="blog-first-content-info">
                                    <h2><a href="<?php echo get_permalink($first_blog['id']); ?>"><?php echo $first_blog['title']; ?></a></h2>
                                </div>
                                <div class="blog-first-content-des">
                                    <?php echo get_field('post_lead', $first_blog['id']) ?>                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="small-container">
                    <div id="js-blog-result-row" class="blog-result-row" data-nonce="<?php echo wp_create_nonce('filter_blog_result_nonce'); ?>">
                        <?php
                            foreach( $blog_list as $blog ){
                                $image = wp_get_attachment_image_src( get_post_thumbnail_id( $blog['id'] ), 'full' );
                        ?>
                                <div class="blog-result-col">
                                    <div class="home-blog-item">
                                        <div class="home-blog-item-image">
                                            <a href="<?php echo get_permalink($blog['id']); ?>">
                                                <img
                                                    class="lazyload"
                                                    src="<?php echo placeholderImage($image[1], $image[2]); ?>"
                                                    data-src="<?php echo aq_resize($image[0], $image[1], $image[2], true); ?>"
                                                    alt="<?php echo $blog['title']; ?>">
                                            </a>
                                        </div>
                                        <div class="home-blog-item-meta-row">
                                            <div class="home-blog-item-category-list">
                                                <?php
                                                    $category_list = get_the_category($blog['id']);
                                                    foreach( $category_list as $category ){
                                                ?>
                                                        <div class="home-blog-item-category-col"><a href="<?php echo get_term_link($category->term_id); ?>"><?php echo $category->name; ?></a></div>
                                                <?php
                                                    }
                                                ?>
                                            </div>
                                            <div class="home-blog-item-date"><?php echo get_the_date('j', $blog['id']); ?> <?php echo $greek_month_list[get_the_date('n', $blog['id']) - 1]; ?> <?php echo get_the_date('Y', $blog['id']); ?></div>
                                        </div>
                                        <div class="home-blog-item-title">
                                            <h3><a href="<?php echo get_permalink($blog['id']); ?>"><?php echo $blog['title']; ?></a></h3>
                                        </div>
                                        <div class="blog-item-bottom-row">
                                            
                                            <div class="blog-item-bottom-left-col">
                                                <?php if(get_field('event_from_date', $blog['id'])) { ?>
                                                <div class="home-blog-item-duration-row">
                                                    <div class="home-blog-item-duration-col">
                                                        <div class="home-blog-item-duration-label">ΑΠΟ</div>
                                                        <div class="home-blog-item-duration-date"><?php echo get_field('event_from_date', $blog['id']); ?></div>
                                                    </div>
                                                    <div class="home-blog-item-duration-col">
                                                        <div class="home-blog-item-duration-label">ΕΩΣ</div>
                                                        <div class="home-blog-item-duration-date"><?php echo get_field('event_to_date', $blog['id']); ?></div>
                                                    </div>
                                                </div>
                                                <?php } ?>
                                            </div>
                                            
                                            <div class="blog-item-bottom-right-col">
                                                <div class="home-blog-item-excerpt">
                                                    <?php echo get_field('post_lead', $blog['id']); ?>
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
        <div>
            <?php
                $page_count = round($total_post_count / $posts_per_page + 0.45);
            ?>
            <div id="js-blog-list-page-navigation" class="pcat-results-footer-options <?php echo $page_count < 2 ? 'hide' : ''; ?>">
                <div class="pcat-results-footer-options-col">
                    <div id="js-blog-results-navigation" class="pcat-results-navigation">
                        <?php
                            require_once dirname(dirname(__FILE__)) . '/inc/zebra-pagination.php';

                            $pagination = new Zebra_Pagination();
                            $pagination->records($total_post_count);
                            $pagination->records_per_page($posts_per_page);
                            $pagination->selectable_pages(5);
                            $pagination->set_page(1);
                            $pagination->padding(false);
                            $pagination->css_classes([
                                'list' => 'pcat-results-navigation-row',
                                'list_item' => 'js-blog-result-navigation-item pcat-results-navigation-item',
                                'prev' => 'js-blog-result-navigation-item pcat-results-navigation-prev',
                                'next' => 'js-blog-result-navigation-item pcat-results-navigation-next',
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
                            <select id="js-blog-page-list">
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
            <div class="pcat-results-projection-options">
                <div class="pcat-results-footer-select">
                    <div class="pcat-results-footer-select-label">Προβολή</div>
                    <div class="pcat-results-footer-select-elem">
                        <select id="js-blog-per-page">
                            <option value="9">9</option>
                            <option value="15">15</option>
                            <option value="21">21</option>
                        </select>
                        <div class="pcat-results-footer-select-elem-icon"><?php include get_template_directory() . '/assets/icons/arrow-down-icon.svg'; ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div id="js-blog-filter-load-spinner" class="load-spinner hide"></div>

<?php get_footer(); ?>