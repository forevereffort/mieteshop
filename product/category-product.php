<section class="pcat-breadcrumb-section">
    <div class="content-container">
        <div class="pcat-breadcrumb-list">
            <div class="pcat-breadcrumb-item"><a href="#">Βιβλία</a></div>
            <div class="pcat-breadcrumb-item"><a href="#">Ανθρωπιστικές Επιστήμες</a></div>
        </div>
    </div>
</section>
<section class="pcat-list-section">
    <div class="content-container">
        <div class="pcat-list-title">
            <h1>Ανθρωπιστικές Επιστήμες</h1>
        </div>
        <div class="pcat-list-row">
            <div class="pcat-list-col">
                <div class="pcat-list-label">Μετάβαση σε:</div>
            </div>
            <div class="pcat-list-col">
                <a href="#">Φιλολογία</a>
            </div>
            <div class="pcat-list-col">
                <a href="#">Ιστορία</a>
            </div>
            <div class="pcat-list-col">
                <a href="#">Αρχαιολογία</a>
            </div>
            <div class="pcat-list-col">
                <a href="#">Θρησκεία</a>
            </div>
            <div class="pcat-list-col">
                <a href="#">Φιλοσοφία</a>
            </div>
            <div class="pcat-list-col">
                <a href="#">Βιογραφίες</a>
            </div>
        </div>
    </div>
</section>
<section class="pcat-filter-section">
    <div class="content-container">
        <div class="pcat-filter-row">
            <div class="pcat-filter-label">
                <div class="pcat-filter-label-icon"><?php include get_template_directory() . '/assets/icons/filter-icon.svg'; ?></div>
                <div class="pcat-filter-label-text">ΦΙΛΤΡΑ</div>
            </div>
            <div class="pcat-filter-button">
                <div class="pcat-filter-button-label">Επιλέξτε θεματικά φίλτρα</div>
                <div class="pcat-filter-button-icon"><?php include get_template_directory() . '/assets/icons/arrow-down-icon.svg'; ?></div>
            </div>
        </div>
    </div>
</section>
<div class="pcat-extra-filter-section">
    <div class="content-container">
        <div class="pcat-extra-filter-row">
            <div class="pcat-extra-filter-left-col">
                <div class="pcat-author-publisher-label">Επιλέξτε Συγγραφέα ή Εκδότη</div>
                <div class="pcat-author-publisher-row">
                    <div class="pcat-author-publisher-col">
                        <div class="pcat-author-publisher-select">
                            <select>
                                <option value="1">Conor Fahy</option>
                            </select>
                            <div class="pcat-author-publisher-select-icon"><?php include get_template_directory() . '/assets/icons/arrow-down-gray-icon.svg'; ?></div>
                        </div>
                    </div>
                    <div class="pcat-author-publisher-col">
                        <div class="pcat-author-publisher-select">
                            <select>
                                <option value="1">Εκδότες</option>
                            </select>
                            <div class="pcat-author-publisher-select-icon"><?php include get_template_directory() . '/assets/icons/arrow-down-gray-icon.svg'; ?></div>
                        </div>
                    </div>
                </div>
                <div class="pcat-author-publisher-des">Για να περιορίσετε τα αποτελέσματα επιλέξτε συγγραφείς ή εκδότες</div>
            </div>
            <div class="pcat-extra-filter-right-col">
                <div class="pcat-classification-filter">
                    <div class="pcat-classification-filter-label">ΤΑΞΙΝΟΜΗΣΗ</div>
                    <div class="pcat-classification-filter-select">
                        <select>
                            <option value="1">Χρονολογική</option>
                        </select>
                        <div class="pcat-classification-filter-select-icon"><?php include get_template_directory() . '/assets/icons/arrow-down-white-icon.svg'; ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="pcat-results-section">
    <div class="content-container">
        <div class="pcat-results-title">
            <h2>ΤΙΤΛΟΙ: 2478</h2>
        </div>
        <div class="pcat-results-row">
            <?php
                $args = [
                    'post_type' => 'product',
                    'posts_per_page' => 16,
                ];
            
                $loop = new WP_Query( $args );
            
                while ( $loop->have_posts() ){
                    $loop->the_post();
                    global $product;

                    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $product->get_id() ), 'full' );
                    $authors = get_field('book_contributors_syggrafeas', $product->get_id());
            ?>
                    <div class="pcat-results-col">
                        <div class="pcat-result-item">
                            <div class="pcat-result-item-info">
                                <div class="pcat-result-item-image">
                                    <img
                                        class="lazyload"
                                        src="<?php echo placeholderImage($image[1], $image[2]); ?>"
                                        data-src="<?php echo aq_resize($image[0], $image[1], $image[2], true); ?>"
                                        alt="<?php echo $product->get_name(); ?>">
                                </div>
                                <?php
                                    if( !empty($authors) ){
                                        echo '<div class="pcat-result-item-author-list">';
                                        if( count($authors) > 3 ){
                                            echo '<div class="pcat-result-item-author-item">Συλλογικό Έργο</div>';
                                        } else {
                                            foreach( $authors as $author ){
                                                echo '<div class="pcat-result-item-author-item"><a href="'. get_permalink($author->ID) . '">' . $author->post_title . '</a></div>';
                                            }
                                        }
                                        echo '</div>';
                                    }
                                ?>
                                <div class="pcat-result-item-title"><h3><?php echo $product->get_name(); ?></h3></div>
                            </div>
                        </div>
                    </div>
            <?php
                }
                wp_reset_query();
            ?>
        </div>
    </div>
</section>