<section class="book-slider" is="mieteshop-book-slider">
    <div class="book-slider-container">
        <div class="book-slider-title">
            <h2>ΘΕΜΑΤΙΚΕΣ ΠΡΟΤΑΣΕΙΣ</h2>
            <p>ΤΕΧΝΕΣ & ΘΕΑΤΡΟ</p>
        </div>
        <div class="book-slider-wrapper">
            <div class="swiper-container" data-slider>
                <div class="swiper-wrapper">
                    <?php
                        $homepage_thematic_suggestions_rel = get_field('homepage_thematic_suggestions_rel');

                        foreach($homepage_thematic_suggestions_rel as $thematic){
                            if( $thematic->post_status != 'publish' ) continue;

                            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $thematic->ID ), 'full' );
                            $authorIDs = get_field('book_contributors_syggrafeas', $thematic->ID);
                    ?>
                            <div class="swiper-slide">
                                <div class="book-slider-item">
                                    <div class="book-slider-image">
                                        <a href="<?php echo get_permalink($thematic->ID); ?>">
                                            <img
                                                class="lazyload"
                                                src="<?php echo placeholderImage($image[1], $image[2]); ?>"
                                                data-src="<?php echo aq_resize($image[0], $image[1], $image[2], true); ?>"
                                                alt="<?php echo $thematic->post_title; ?>">
                                        </a>
                                    </div>
                                    <div class="book-slider-info">
                                        <?php
                                            if( !empty($authorIDs) ){
                                                echo '<div class="book-slider-author-list">';
                                                if( count($authorIDs) > 3 ){
                                                    echo '<div class="book-slider-author-item">Συλλογικό Έργο</div>';
                                                } else {
                                                    foreach( $authorIDs as $authorID ){
                                                        echo '<div class="book-slider-author-item"><a href="'. get_permalink($authorID) . '">' . get_the_title($authorID) . '</a></div>';
                                                    }
                                                }
                                                echo '</div>';
                                            }
                                        ?>
                                        <div class="book-slider-product-title">
                                            <a href="<?php echo get_permalink($thematic->ID); ?>"><h3><?php echo $thematic->post_title; ?></h3></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
            <div class="book-slider-nav-wrapper">
                <div data-slider-button="prev" class="book-slider-nav book-slider-nav--prev"><?php include get_template_directory() . '/assets/icons/slider-prev-icon.svg'; ?></div>
                <div data-slider-button="next" class="book-slider-nav book-slider-nav--next"><?php include get_template_directory() . '/assets/icons/slider-next-icon.svg'; ?></div>
            </div>
        </div>
    </div>
</section>