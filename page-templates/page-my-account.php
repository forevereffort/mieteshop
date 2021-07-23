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
        <div class="my-account-icon">
            <span><?php include get_template_directory() . '/assets/icons/my-account-icon.svg'; ?></span>
        </div>
        <div class="my-account-inner">
            <?php the_content(); ?>
        </div>
    </div>
</section>
<?php
        }
    }
?>

<?php get_footer(); ?>