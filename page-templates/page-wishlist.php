<?php
/**
 * Template Name: Wishlist Page
 */
?>
<?php get_header(); ?>

<?php
    if ( have_posts() ) {
        while ( have_posts() ){
            the_post();
?>
<section class="cart-page-title">
    <div class="content-container">
        <h1>Wishlist</h1>
    </div>
</section>
<section class="cart-section">
    <div class="content-container">
        <?php the_content(); ?>
    </div>
</section>
<?php
        }
    }
?>

<?php get_footer(); ?>