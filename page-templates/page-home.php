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
?>
<section class="three-banner">
    <?php
        $top_banner_1 = get_field('top_banner_1');
        $top_banner_2 = get_field('top_banner_2');
        $top_banner_3 = get_field('top_banner_3');
    ?>
    <div class="wide-container">
        <div class="three-banner-row">
            <div class="three-banner-left-col">
                <div class="three-banner-1">
                    <img
                        class="lazyload"
                        src="<?php echo placeholderImage(720, 400); ?>"
                        data-src="<?php echo aq_resize($top_banner_1['url'], 720, 400, true); ?>"
                        alt="<?php echo $top_banner_1['alt']; ?>">
                    <div class="three-banner-1-content">
                        <h2><?php echo get_field('top_banner_1_title'); ?></h2>
                        <p><?php echo get_field('top_banner_1_content'); ?></p>
                        <div class="three-banner-1-link">
                            <?php $top_banner_1_link = get_field('top_banner_1_link'); ?>
                            <a href="<?php echo $top_banner_1_link['url']; ?>"><?php echo $top_banner_1_link['title']; ?></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="three-banner-right-col">
                <div class="three-banner-2">
                    <img
                        class="lazyload"
                        src="<?php echo placeholderImage(512, 230); ?>"
                        data-src="<?php echo aq_resize($top_banner_2['url'], 512, 230, true); ?>"
                        alt="<?php echo $top_banner_2['alt']; ?>">
                    <div class="three-banner-2-content">
                        <div class="three-banner-2-content-row">
                            <div class="three-banner-2-content-top">
                                <p><?php echo get_field('top_banner_2_label'); ?></p>
                            </div>
                            <div class="three-banner-2-content-bottom">
                                <h2><?php echo get_field('top_banner_2_title'); ?></h2>
                                <div class="three-banner-2-link">
                                    <?php $top_banner_2_link = get_field('top_banner_2_link'); ?>
                                    <a href="<?php echo $top_banner_2_link['url']; ?>"><?php echo $top_banner_2_link['title']; ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="three-banner-3">
                    <img
                        class="lazyload"
                        src="<?php echo placeholderImage(512, 154); ?>"
                        data-src="<?php echo aq_resize($top_banner_3['url'], 512, 154, true); ?>"
                        alt="<?php echo $top_banner_3['alt']; ?>">
                    <div class="three-banner-3-content">
                        <h2><?php echo get_field('top_banner_3_title'); ?></h2>
                        <p><?php echo get_field('top_banner_3_content'); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
        }
    }
?>

<?php get_footer(); ?>