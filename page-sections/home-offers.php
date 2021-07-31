<section class="home-offers-section">
    <div class="container">
        <div class="home-offers-title">
            <h2>ΠΡΟΣΦΟΡΕΣ</h2>
        </div>
        <div class="home-offers-row">
            <?php
                $homepage_offers_rel = get_field('homepage_offers_rel');

                foreach($homepage_offers_rel as $offer){
                    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $offer->ID ), 'full' );
                    $authors = get_field('book_contributors_syggrafeas', $offer->ID);
            ?>
                    <div class="home-offers-col">
                        <div class="home-offers-image">
                            <a href="<?php echo get_permalink($offer->ID); ?>">
                                <img
                                    class="lazyload"
                                    src="<?php echo placeholderImage($image[1], $image[2]); ?>"
                                    data-src="<?php echo aq_resize($image[0], $image[1], $image[2], true); ?>"
                                    alt="<?php echo $offer->post_title; ?>">
                            </a>
                        </div>
                        <div class="home-offers-info">
                            <?php
                                if( !empty($authors) ){
                                    echo '<div class="home-offers-author-list">';
                                    if( count($authors) > 3 ){
                                        echo '<div class="home-offers-author-item">Συλλογικό Έργο</div>';
                                    } else {
                                        foreach( $authors as $author ){
                                            echo '<div class="home-offers-author-item"><a href="'. get_permalink($author->ID) . '">' . $author->post_title . '</a></div>';
                                        }
                                    }
                                    echo '</div>';
                                }
                            ?>
                            <div class="home-offers-product-title">
                                <a href="<?php echo get_permalink($offer->ID); ?>"><h3><?php echo $offer->post_title; ?></h3></a>
                            </div>
                        </div>
                    </div>
            <?php
                }
            ?>
        </div>
        <div class="home-offers-mobile-slider" is="mieteshop-home-offers-mobile-slider">
            <div class="swiper-container" data-slider>
                <div class="swiper-wrapper">
                    <?php
                        $homepage_offers_rel = get_field('homepage_offers_rel');

                        foreach($homepage_offers_rel as $offer){
                            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $offer->ID ), 'full' );
                            $authors = get_field('book_contributors_syggrafeas', $offer->ID);
                    ?>
                            <div class="swiper-slide">
                                <div class="home-offers-col">
                                    <div class="home-offers-image">
                                        <a href="<?php echo get_permalink($offer->ID); ?>">
                                            <img
                                                class="lazyload"
                                                src="<?php echo placeholderImage($image[1], $image[2]); ?>"
                                                data-src="<?php echo aq_resize($image[0], $image[1], $image[2], true); ?>"
                                                alt="<?php echo $offer->post_title; ?>">
                                        </a>
                                    </div>
                                    <div class="home-offers-info">
                                        <?php
                                            if( !empty($authors) ){
                                                echo '<div class="home-offers-author-list">';
                                                if( count($authors) > 3 ){
                                                    echo '<div class="home-offers-author-item">Συλλογικό Έργο</div>';
                                                } else {
                                                    foreach( $authors as $author ){
                                                        echo '<div class="home-offers-author-item"><a href="'. get_permalink($author->ID) . '">' . $author->post_title . '</a></div>';
                                                    }
                                                }
                                                echo '</div>';
                                            }
                                        ?>
                                        <div class="home-offers-product-title">
                                            <a href="<?php echo get_permalink($offer->ID); ?>"><h3><?php echo $offer->post_title; ?></h3></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
            <div class="home-offers-mobile-slider-nav-wrapper">
                <div data-slider-button="prev" class="home-offers-mobile-slider-nav home-offers-mobile-slider-nav--prev"><?php include get_template_directory() . '/assets/icons/slider-prev-white-icon.svg'; ?></div>
                <div data-slider-button="next" class="home-offers-mobile-slider-nav home-offers-mobile-slider-nav--next"><?php include get_template_directory() . '/assets/icons/slider-next-white-icon.svg'; ?></div>
            </div>
        </div>
        <div class="home-offers-link">
            <a href="#">δείτε όλες τις Προσφορές</a>
        </div>
    </div>
</section>