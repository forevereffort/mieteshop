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

            get_template_part( 'page-sections/three', 'banner' );
            get_template_part( 'page-sections/home', 'new-release' );
            get_template_part( 'page-sections/home', 'rare-edition' );
            get_template_part( 'page-sections/home', 'offers' );
            get_template_part( 'page-sections/middle', 'banner' );
            get_template_part( 'page-sections/home', 'book-week' );
            get_template_part( 'page-sections/home', 'suggestion' );
            get_template_part( 'page-sections/home', 'thematic' );
            get_template_part( 'page-sections/home', 'authors' );
            get_template_part( 'page-sections/home', 'blog' );
        }
    }
?>

<?php get_footer(); ?>