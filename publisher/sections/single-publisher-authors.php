<?php
    $company_selected_contributors = get_field('company_selected_contributors', $post->ID);

    if( !empty($company_selected_contributors) ){
?>
        <section class="home-authors-section">
            <div class="small-container">
                <div class="home-authors-title">
                    <h2>ΣΥΓΓΡΑΦΕΙΣ</h2>
                </div>
                <div class="home-authors-row">
                    <?php
                        foreach ( $company_selected_contributors as $contributor ){
                            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $contributor->ID ), 'full' );
                    ?>
                            <div class="home-authors-col">
                                <div class="home-authors-image">
                                    <a href="<?php echo get_permalink($contributor->ID); ?>">
                                    <img
                                        class="lazyload"
                                        src="<?php echo placeholderImage($image[1], $image[2]); ?>"
                                        data-src="<?php echo aq_resize($image[0], $image[1], $image[2], true); ?>"
                                        alt="<?php echo $contributor->post_title; ?>">
                                    </a>    
                                </div>
                                <div class="home-authors-name">
                                    <h3><a href="<?php echo get_permalink($contributor->ID); ?>"><?php echo $contributor->post_title; ?></a></h3>
                                </div>
                            </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </section>
<?php
    }
?>