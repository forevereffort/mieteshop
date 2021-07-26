<?php
/**
 * Template Name: Blog Page
 */
global $post;
?>
<?php get_header(); ?>

<?php 
$greek_month_list = ['ΙΑΝ', 'ΦΕΒ', 'ΜΆΡ', 'ΑΠΡ', 'ΜΆΙ', 'ΙΟΎΝ', 'ΙΟΎΛ', 'ΑΎΓ', 'ΣΕΠ', 'ΟΚΤ', 'ΝΟΈ', 'ΔΕΚ'];

$args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC',
    'posts_per_page' => 1,
);
$posts = new WP_Query( $args );
if ( $posts->have_posts() ) :
    //echo '<pre>'; var_dump($posts->posts); echo '</pre>';
    $firstpost = $posts->posts[0];
    //echo '<pre>'; var_dump($firstpost); echo '</pre>';
    
?>

<section class="breadcrumb-section">
    <div class="content-container">
        <div class="breadcrumb-list">
            <div class="breadcrumb-item"><a href="#">Εκδηλώσεις</a></div>
            <div class="breadcrumb-item"><a href="#">Εκθέσεις</a></div>
        </div>
    </div>
</section>

<div class="blog-index">
    <div class="general-container">
    <section class="blog-hero-section">
        <div class="general-container">
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
                        $blog_hero_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $firstpost->ID ), 'full' ); //get_template_directory_uri() . '/assets/images/blog-hero.png';
                    ?>

                    <div class="blog-hero-image">
                        <a href="<?php echo get_permalink($firstpost->ID); ?>">
                        <img
                            class="lazyload"
                            src="<?php echo placeholderImage($blog_hero_image_url[1], $blog_hero_image_url[2]); ?>"
                            data-src="<?php echo aq_resize($blog_hero_image_url[0], $blog_hero_image_url[1], $blog_hero_image_url[2], true); ?>"
                            alt="<?php echo $firstpost->post_title; ?>">
                        </a>    
                    </div>
                    <div class="blog-hero-content">
                        <div class="blog-hero-content-inner">
                            <div class="blog-hero-content-meta-row">
                                <div class="blog-hero-content-category-list">
                                    <div class="blog-hero-content-category-col">
                                    <?php
                                        $terms = wp_get_post_terms( $firstpost->ID, 'category' );
                                        foreach ( $terms as $term ) {
                                            echo '<a href="'.esc_url( get_term_link( $term->slug, 'category' ) ).'">'.$term->name .'</a> ';
                                        }
                                    ?>
                                    </div>
                                </div>
                                <div class="blog-hero-content-date"><?php 
                                echo get_the_date('j', $firstpost->ID); ?> <?php echo $greek_month_list[get_the_date('n', $firstpost->ID) - 1]; ?> <?php echo get_the_date('Y', $firstpost->ID);
                                //echo get_the_date('d M Y', $firstpost->post_date); ?>
                                </div>
                            </div>
                            <div class="blog-hero-content-info">
                                <h2><a href="<?php echo get_permalink($firstpost->ID); ?>"><?php echo $firstpost->post_title; ?></a></h2>
                            </div>
                            <div class="blog-hero-content-des">
                                <?php echo get_field('post_lead', $firstpost->ID) ?>                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="blog-result-section">
        <div class="general-container">
            <div class="small-container">
                <div class="blog-result-row">
                    <?php
                        $args = [
                            'post_type' => 'post',
                            'post_status' => 'publish',
                            'posts_per_page' => -1,
                        ];
                    
                        $loop = new WP_Query( $args );

                        $total_post_count = $loop->found_posts;
                    
                        while ( $loop->have_posts() ){
                            $loop->the_post();

                            if ($loop->current_post != 0) { //exclude first post
                            
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
                                        <?php if(get_field('event_from_date', $post->ID)) { ?>
                                        <div class="blog-item-bottom-left-col">
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
                                        </div>
                                        <?php } ?>
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
                        }    
                        wp_reset_query();
                    ?>
                </div>
                <div class="pcat-results-footer-options">
                    <div class="pcat-results-footer-options-col">
                        <div id="js-pcat-results-navigation" class="pcat-results-navigation">
                            <?php
                                require_once dirname(dirname(__FILE__)) . '/inc/zebra-pagination.php';

                                $pagination = new Zebra_Pagination();
                                $pagination->records($total_post_count);
                                $pagination->records_per_page(4);
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
                        <!--div class="pcat-results-navigation">
                            <div class="pcat-results-navigation-row">
                                <div class="pcat-results-navigation-item active"><a href="#">1</a></div>
                                <div class="pcat-results-navigation-item"><a href="#">2</a></div>
                                <div class="pcat-results-navigation-item"><a href="#">3</a></div>
                                <div class="pcat-results-navigation-item"><a href="#">4</a></div>
                                <div class="pcat-results-navigation-item"><span>...</span></div>
                                <div class="pcat-results-navigation-item"><a href="#">33</a></div>
                                <div class="pcat-results-navigation-next"><?php include get_template_directory() . '/assets/icons/arrow-right-icon.svg' ?></div>
                            </div>
                        </div-->
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
        </div>
    </section>

<?php
    endif;
?>
    </div>
</div>

<?php get_footer(); ?>