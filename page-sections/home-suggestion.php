<section class="book-slider book-slider--border-bottom" is="mieteshop-book-slider">
    <div class="book-slider-container">
        <div class="book-slider-title">
            <h2>ΕΚΔΟΤΙΚΕΣ ΠΡΟΤΑΣΕΙΣ</h2>
            <p>ΕΚΔΟΣΕΙΣ ΑΚΑΔΗΜΙΑΣ ΑΘΗΝΩΝ</p>
        </div>
        <div class="book-slider-wrapper">
            <div class="swiper-container" data-slider>
                <div class="swiper-wrapper">
                    <?php
                        $homepage_publisher_suggestions_rel = get_field('homepage_publisher_suggestions_rel');

                        foreach($homepage_publisher_suggestions_rel as $publisher){
                            if( $publisher->post_status != 'publish' ) continue;

                            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $publisher->ID ), 'full' );
                            $authorIDs = get_field('book_contributors_syggrafeas', $publisher->ID);
                    ?>
                            <div class="swiper-slide">
                                <div class="book-slider-item">
                                    <div class="book-slider-image">
                                        <a href="<?php echo get_permalink($publisher->ID); ?>">
                                            <img
                                                class="lazyload"
                                                src="<?php echo placeholderImage($image[1], $image[2]); ?>"
                                                data-src="<?php echo aq_resize($image[0], $image[1], $image[2], true); ?>"
                                                alt="<?php echo $publisher->post_title; ?>">
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
                                            <a href="<?php echo get_permalink($publisher->ID); ?>"><h3><?php echo $publisher->post_title; ?></h3></a>
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