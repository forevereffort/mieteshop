<?php
    global $post;

    get_header();
?>
<section class="archive-publisher-title">
    <div class="content-container">
        <h1>Κατάλογος εκδοτών</h1>
    </div>
</section>
<section class="archive-publisher-month-section">
    <div class="content-container">
        <div class="archive-publisher-month-title">
            <h2>ΟΙ ΦΟΡΕΙΣ ΤΟΥ ΜΗΝΑ</h2>
        </div>
        <div class="archive-publisher-month-row">
            <?php
                $args = [
                    'post_type' => 'publisher',
                    'posts_per_page' => 6,
                ];
            
                $loop = new WP_Query( $args );

                while ( $loop->have_posts() ){
                    $loop->the_post();

                    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
            ?>
                    <div class="archive-publisher-month-col">
                        <div class="archive-publisher-month-item">
                            <div class="archive-publisher-month-image">
                                <img
                                    class="lazyload"
                                    src="<?php echo placeholderImage($image[1], $image[2]); ?>"
                                    data-src="<?php echo aq_resize($image[0], $image[1], $image[2], true); ?>"
                                    alt="<?php echo $post->post_title; ?>">
                            </div>
                            <div class="archive-publisher-month-title">
                                <h3><?php echo $post->post_title; ?></h3>
                            </div>
                        </div>
                    </div>
            <?php
                }
            ?>
        </div>
    </div>
</section>
<?php get_footer(); ?>