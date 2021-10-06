<?php
    global $product;

    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $product->get_id() ), 'full' );
    $publisherIDs = get_field('book_publishers', $product->ID);
    $series = get_the_terms( $product->ID, 'series' );
    $epiloges = get_the_terms( $product->ID, 'epiloges' );
    $publishersTaxonomy = get_the_terms( $product->ID, 'ekdotes' );

?>
<section class="single-product-section">
    <div class="general-container">
        <div class="content-container">
            <div class="single-product-row">
                <div class="single-product-left-col">
                    <div class="single-product-image">
                        <img
                            class="lazyload"
                            src="<?php echo placeholderImage($image[1], $image[2]); ?>"
                            data-src="<?php echo aq_resize($image[0], $image[1], $image[2], true); ?>"
                            alt="<?php echo $product->get_name(); ?>">
                    </div>
                </div>
                <div class="single-product-right-col">
                    <div class="single-product-info">
                        <div class="single-product-tag-row">
                            <?php 
                                if( $series ){
                                    foreach ( $series as $series_term ){
                            ?>
                                        <div class="single-product-tag"><a href="<?php echo get_term_link($series_term->term_id); ?>"><?php echo $series_term->name; ?></a></div>
                            <?php
                                    }        
                                }
                            
                            if( $publishersTaxonomy ) {
                                foreach ( $publishersTaxonomy as $publisher_term ){
                            ?>
                                <div class="single-product-tag"><a href="<?php echo get_term_link($publisher_term->term_id); ?>"><?php echo $publisher_term->name; ?></a></div>
                            <?php
                                }
                            }

                            
                                //if( $publisherIDs ){
                                //    foreach($publisherIDs as $publisherID){
                            ?>
                                    <!--<div class="single-product-tag"><a href="<?php //echo get_permalink($publisherID); ?>"><?php //echo get_the_title($publisherID); ?></a></div>-->
                            <?php
                                //    }	     
                                //}

                                if( $epiloges ){ 
                                    foreach($epiloges as $epilogi) {
                                        if($epilogi->slug == 'nees-kyklofories'){    
                            ?>
                                            <div class="single-product-tag active"><a href="<?php echo get_term_link($epilogi->term_id); ?>"><?php echo $epilogi->name; ?></a></div>
                            <?php
                                        }    
                                    }
                                }
                            ?>
                        </div>
                        <div class="single-product-author">
                            <?php
                                $authorIDs = get_field('book_contributors_syggrafeas', $product->get_id());

                                if( $authorIDs ){
                                    if( count($authorIDs) > 3){
                                        echo 'Συλλογικό Έργο';	
                                    } else {					
                                        foreach($authorIDs as $authorID) {
                            ?>
                                            <a href="<?php echo get_permalink($authorID); ?>"><?php echo get_the_title($authorID); ?></a>
                            <?php
                                        }	
                                    }	
                                } else {
                                    echo get_field('book_biblionet_writer_name');
                                }
                            ?>
                        </div>
                        <div class="single-product-title">
                            <h1><?php echo get_the_title(); ?></h1>
                        </div>
                        <div class="single-product-subtitle">
                            <h2><?php echo get_field('book_subtitle'); ?></h2>
                        </div>
                        <div class="single-product-role-detail-wrapper">
                            <?php 
                                $contributorFields = acf_get_fields(3523);
                                foreach($contributorFields as $contributorField) {
                                    $contributors = get_field($contributorField['name']);
                                    if($contributors){
                            ?>
                                        <div class="single-product-role-detail">
                                            <div class="single-product-role-detail__role"><?php echo $contributorField['label']; ?></div>
                                            <?php
                                                foreach($contributors as $contributor) {
                                            ?>
                                                    <div class="single-product-role-detail__detail"><a href="<?php echo get_permalink($contributor->ID); ?>"><?php echo $contributor->post_title; ?></a></div>
                                            <?php
                                                }
                                            ?>
                                        </div>
                            <?php
                                    }                    
                                }
                            ?>
                        </div>
                        <div class="single-product-comments">
                            <?php echo get_field('book_comments'); ?>
                        </div>   
                        <div class="single-product-info-table-1-row">
                            <div class="single-product-form-col"><span>ΜΟΡΦΗ</span></div>
                            <div class="single-product-form-value"><span><?php echo get_field('book_cover_type'); ?></span></div>
                            <div class="single-product-price-col"><span>ΤΙΜΗ</span></div>
                            <?php 
                                $regular_price = (float) get_post_meta( get_the_ID(), '_regular_price', true);
                                $sale_price = (float) get_post_meta( get_the_ID(), '_sale_price', true);
                                $price_symbol = get_woocommerce_currency_symbol(get_option('woocommerce_currency'));

                                if($sale_price) {
                            ?>
                                    <div class="single-product-regular-price"><span><?php echo number_format($regular_price, 2, ',', ''); ?><?php echo  $price_symbol; ?></span></div>
                                    <div class="single-product-sale-price"><span><?php echo number_format($sale_price, 2, ',', ''); ?><?php echo  $price_symbol; ?></span></div>
                            <?php
                                } else {
                            ?>
                                    <div class="single-product-sale-price"><span><?php echo number_format($regular_price, 2, ',', ''); ?><?php echo  $price_symbol; ?></span></div>
                            <?php
                                }
                            ?>
                            
                            <?php
                                if($sale_price) {
                                    $saving_percentage = round( 100 - ( $sale_price / $regular_price * 100 ), 1 ) . '%';
                            ?>
                                    <div class="single-product-discount"><span><?php echo $saving_percentage; ?></span></div>
                            <?php
                                }
                            ?>
                            <div class="single-product-availability">
                                <span>
                                    <?php 
                                        $availability = $product->get_availability();
                                        echo $availability['availability']; 
                                    ?>
                                </span>
                            </div>
                        </div>
                        <div class="single-product-info-table-2-row">
                            <div class="single-product-share-col">
                                <div class="single-product-share-icon"><?php include get_template_directory() . '/assets/icons/share-icon.svg' ?></div>
                            </div>
                            <div class="single-product-favorite-col">
                                <div class="single-product-favorite-button">
                                    <div class="single-product-favorite-button__icon"><?php include get_template_directory() . '/assets/icons/favorite-white-icon.svg' ?></div>
                                    <div class="single-product-favorite-button__label">Προσθήκη στα αγαπημένα</div>
                                </div>
                            </div>
                            <div class="single-product-add-tocart-col">
                                <!--a href="#">Προσθήκη στο καλάθι</a-->
                                <a class="js-mieteshop-add-to-cart" href="#" data-quantity="1" data-product_id="<?php echo $product->get_id(); ?>" data-variation_id="0" data-product_sku="<?php echo $product->get_sku(); ?>">Προσθήκη στο καλάθι</a>
                            </div>
                        </div>
                    </div>
                    <div class="single-product-tab-header-row">
                        <div class="single-product-tab-header-item active" data-section-id="description">ΠΕΡΙΓΡΑΦΗ</div>
                        <div class="single-product-tab-header-item" data-section-id="detail-information">ΑΝΑΛΥΤΙΚΑ ΣΤΟΙΧΕΙΑ</div>
                    </div>
                    <div class="single-product-tab-content-row">
                        <div id="single-product-tab-content-item--description" class="single-product-tab-content-item">
                            <div class="single-product-description"><?php the_content(); ?></div>
                        </div>
                        <div id="single-product-tab-content-item--detail-information" class="single-product-tab-content-item hide">
                            <div class="single-product-detail-information-row">
                                <?php
                                    if( get_field('book_isbn') ){
                                ?>
                                        <div class="single-product-detail-information-item">
                                            <div class="single-product-detail-information-item__label">ISBN</div>
                                            <div class="single-product-detail-information-item__value"><?php echo get_field('book_isbn'); ?></div>
                                        </div>
                                <?php
                                    }
                                ?>
                                <div class="single-product-detail-information-item">
                                    <div class="single-product-detail-information-item__label">ΔΙΑΣΤΑΣΕΙΣ</div>
                                    <div class="single-product-detail-information-item__value"><?php echo $product->get_width() .' x ' .$product->get_height(); ?> εκ.</div>
                                </div>
                                <?php
                                    if( get_field('book_setisbn') ){
                                ?>
                                        <div class="single-product-detail-information-item">
                                            <div class="single-product-detail-information-item__label">ISBN SET</div>
                                            <div class="single-product-detail-information-item__value"><?php echo get_field('book_setisbn'); ?></div>
                                        </div>
                                <?php
                                    }
                                ?>
                                <?php
                                    if( get_field('book_language') ){
                                ?>
                                        <div class="single-product-detail-information-item">
                                            <div class="single-product-detail-information-item__label">ΓΛΩΣΣΑ</div>
                                            <div class="single-product-detail-information-item__value">
                                                <?php
                                                    $booklanguage = get_field('book_language');
                                                    echo $booklanguage['label'];
                                                ?>
                                            </div>
                                        </div>
                                <?php
                                    }
                                ?>
                                <?php
                                    if( get_field('book_first_published_date') ){
                                ?>
                                        <div class="single-product-detail-information-item">
                                            <div class="single-product-detail-information-item__label">ΠΡΩΤΗ ΕΚΔΟΣΗ</div>
                                            <div class="single-product-detail-information-item__value"><?php echo get_field('book_first_published_date'); ?></div>
                                        </div>
                                <?php
                                    }
                                ?>
                                <?php
                                    if( get_field('book_original_title') ){
                                ?>
                                        <div class="single-product-detail-information-item">
                                            <div class="single-product-detail-information-item__label">ΠΡΩΤΟΤΥΠΟΣ ΤΙΤΛΟΣ</div>
                                            <div class="single-product-detail-information-item__value"><?php echo get_field('book_original_title'); ?></div>
                                        </div>
                                <?php
                                    }
                                ?>
                                <?php
                                    if( get_field('book_current_published_date') ){
                                ?>
                                        <div class="single-product-detail-information-item">
                                            <div class="single-product-detail-information-item__label">ΤΡΕΧΟΥΣΑ ΕΚΔΟΣΗ</div>
                                            <div class="single-product-detail-information-item__value"><?php echo get_field('book_current_published_date'); ?>
                                            <?php 
                                                if(get_field('book_current_published_date_details')) {
                                                    echo ', ' .get_field('book_current_published_date_details'); 
                                                }    
                                            ?></div>
                                        </div>
                                <?php
                                    }
                                ?>
                                <?php
                                    if( get_field('book_original_language') ){
                                ?>
                                        <div class="single-product-detail-information-item">
                                            <div class="single-product-detail-information-item__label">ΓΛΩΣΣΑ ΠΡΩΤΟΤΥΠΟΥ</div>
                                            <div class="single-product-detail-information-item__value">
                                                <?php $booklanguageOrig = get_field('book_original_language'); echo $booklanguageOrig['label']; ?>
                                            </div>
                                        </div>
                                <?php
                                    }
                                ?>
                                <?php 
                                    if( $publisherIDs ){
                                ?>
                                        <div class="single-product-detail-information-item">
                                            <div class="single-product-detail-information-item__label">ΕΚΔΟΤΗΣ</div>
                                            <div class="single-product-detail-information-item__value">
                                                <?php 
                                                if( $publishersTaxonomy ) {
                                                    foreach ( $publishersTaxonomy as $publisher_term ){
                                                ?>
                                                    <a href="<?php echo get_term_link($publisher_term->term_id); ?>"><?php echo $publisher_term->name; ?></a><br/>
                                                <?php
                                                    }
                                                }

                                                    //foreach($publisherIDs as $publisherID) {
                                                ?>
                                                    <!--<a href="<?php //echo get_permalink($publisherID); ?>"><?php //echo get_the_title($publisherID); ?></a>-->
                                                <?php
                                                    //}	                                    
                                                ?>
                                            </div>
                                        </div>
                                <?php
                                    }   
                                ?>
                                <?php
                                    if( $product->get_weight() ){
                                ?>
                                        <div class="single-product-detail-information-item">
                                            <div class="single-product-detail-information-item__label">ΒΑΡΟΣ</div>
                                            <div class="single-product-detail-information-item__value"><?php echo $product->get_weight(); ?> γρ.</div>
                                        </div>
                                <?php
                                    }
                                ?>
                                <?php 
                                    if( $series ){
                                ?>                
                                        <div class="single-product-detail-information-item">
                                            <div class="single-product-detail-information-item__label">ΣΕΙΡΑ</div>
                                            <div class="single-product-detail-information-item__value">
                                                <?php 
                                                    foreach ( $series as $series_term ) {
                                                ?>
                                                        <div><?php echo $series_term->name; ?></div>
                                                <?php
                                                    }            
                                                ?>                    
                                            </div>
                                        </div>
                                <?php
                                    }
                                ?>
                                <?php
                                    if( get_field('book_miet_code') ){
                                ?>
                                        <div class="single-product-detail-information-item">
                                            <div class="single-product-detail-information-item__label">ΚΩΔΙΚΟΣ ΜΙΕΤ</div>
                                            <div class="single-product-detail-information-item__value"><?php echo get_field('book_miet_code'); ?></div>
                                        </div>
                                <?php
                                    }
                                ?>
                                <?php
                                    if( get_field('book_page_number') ){
                                ?>
                                        <div class="single-product-detail-information-item">
                                            <div class="single-product-detail-information-item__label">ΑΡΙΘΜΟΣ ΣΕΛΙΔΩΝ</div>
                                            <div class="single-product-detail-information-item__value"><?php echo get_field('book_page_number'); ?></div>
                                        </div>
                                <?php
                                    }
                                ?>
                                <?php
                                    if( get_field('book_eudoxus_code') ){
                                ?>
                                        <div class="single-product-detail-information-item">
                                            <div class="single-product-detail-information-item__label">ΚΩΔΙΚΟΣ ΣΤΟ ΕΥΔΟΞΟ</div>
                                            <div class="single-product-detail-information-item__value"><?php echo get_field('book_eudoxus_code'); ?></div>
                                        </div>
                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>