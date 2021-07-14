<?php get_header(); ?>

<?php
    $current_series_taxonomy = get_queried_object();

    $series_image = get_field('series_image', 'series_'.$current_series_taxonomy->term_id);
    // echo '<pre>';
    // print_r($series_image);
    // echo '</pre>';
?>

<section class="breadcrumb-section">
    <div class="content-container">
        <div class="breadcrumb-list">
            <div class="breadcrumb-item"><a href="#">Βιβλία</a></div>
            <div class="breadcrumb-item"><a href="#">Σειρές ΜΙΕΤ</a></div>
        </div>
    </div>
</section>
<section class="product-series-content-section">
    <div class="product-series-content-inner">
        <div class="product-series-content-image">
            <img
                class="lazyload"
                src="<?php echo placeholderImage($series_image['width'], $series_image['height']); ?>"
                data-src="<?php echo $series_image['url']; ?>"
                alt="<?php echo $current_series_taxonomy->name; ?>">
        </div>
        <div class="product-series-content-row">
            <div class="product-series-content-col">
                <h1><?php echo $current_series_taxonomy->name; ?></h1>
                <?php echo apply_filters('the_content', $current_series_taxonomy->description); ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>