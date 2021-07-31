<section class="home-authors-section">
    <div class="small-container">
        <div class="home-authors-title">
            <h2>ΟΙ ΣΥΓΓΡΑΦΕΙΣ ΤΟΥ ΜΗΝΑ</h2>
        </div>
        <div class="home-authors-row">
            <?php
                $homepage_authors_of_the_month_rel = get_field('homepage_authors_of_the_month_rel');

                foreach( $homepage_authors_of_the_month_rel as $author ){
                    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $author->ID ), 'full' );
            ?>
                    <div class="home-authors-col">
                        <div class="home-authors-image">
                            <a href="<?php echo get_permalink($author->ID); ?>">
                                <img
                                    class="lazyload"
                                    src="<?php echo placeholderImage($image[1], $image[2]); ?>"
                                    data-src="<?php echo aq_resize($image[0], $image[1], $image[2], true); ?>"
                                    alt="<?php echo $author->post_title; ?>">
                            </a>
                        </div>
                        <div class="home-authors-name">
                            <h3><a href="<?php echo get_permalink($author->ID); ?>"><?php echo $author->post_title; ?></a></h3>
                        </div>
                    </div>
            <?php
                }
            ?>
        </div>
    </div>
</section>