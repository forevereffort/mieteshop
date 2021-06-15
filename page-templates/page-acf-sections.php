<?php
/**
 * Template Name: ACF Sections Page
 */
?>
<?php get_header(); ?>

<?php
    if ( have_posts() ) {
        while ( have_posts() ){
            the_post();

            if( have_rows('page_sections') ){
                while ( have_rows('page_sections') ) {
                    the_row();

                    if( get_row_layout() == 'content_image_slider_section' ){
                        include get_template_directory() . '/components/content-image-slider-section.php';
                    }
                }
            }
        }
    }
?>

<?php get_footer(); ?>