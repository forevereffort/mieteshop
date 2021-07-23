<?php
/**
 * Template Name: Cart Page
 */
?>
<?php get_header(); ?>

<?php
    if ( have_posts() ) {
        while ( have_posts() ){
            the_post();
?>
<section class="breadcrumb-section breadcrumb-section-white">
    <div class="content-container">
        <div class="breadcrumb-list">
            <div class="breadcrumb-item"><a href="#">Βιβλία</a></div>
            <div class="breadcrumb-item"><a href="#">Ανθρωπιστικές Επιστήμες</a></div>
            <div class="breadcrumb-item"><a href="#">Ιστορία</a></div>
        </div>
    </div>
</section>
<section class="cart-page-title">
    <div class="content-container">
        <h1>Καλάθι</h1>
    </div>
</section>
<?php the_content(); ?>
<?php
        }
    }
?>

<?php get_footer(); ?>