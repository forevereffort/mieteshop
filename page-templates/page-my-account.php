<?php
/**
 * Template Name: My Account Page
 */
?>
<?php get_header(); ?>

<?php
    if ( have_posts() ) {
        while ( have_posts() ){
            the_post();
?>
<section class="my-account-section">
    <div class="content-container">
        <?php the_content(); ?>
    </div>
</section>
<?php
        }
    }
?>

<?php get_footer(); ?>