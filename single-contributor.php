<?php get_header(); ?>

<?php

    if ( have_posts() ) {
        while ( have_posts() ){
            the_post();

            get_template_part( 'page-sections/contributor/single', 'contributor-info' );
            get_template_part( 'page-sections/contributor/single', 'contributor-meta' );
            get_template_part( 'page-sections/contributor/single', 'contributor-books' );
            get_template_part( 'page-sections/contributor/single', 'contributor-related-books' );
        }
    }
?>

<?php get_footer(); ?>