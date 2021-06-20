<?php
    global $product;

    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $product->get_id() ), 'full' );
?>
<section class="breadcrumb-section">
    <div class="content-container">
        <div class="breadcrumb-list">
            <div class="breadcrumb-item"><a href="#">Βιβλία</a></div>
            <div class="breadcrumb-item"><a href="#">Ανθρωπιστικές Επιστήμες</a></div>
            <div class="breadcrumb-item"><a href="#">Ιστορία</a></div>
        </div>
    </div>
</section>
<section class="single-product-section">
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
                        <div class="single-product-tag"><a href="#">μιετ</a></div>
                        <div class="single-product-tag"><a href="#">MINIMA</a></div>
                        <div class="single-product-tag active"><a href="#">ΝΕΟΙ ΤΙΤΛΟΙ</a></div>
                    </div>
                    <div class="single-product-author">
                        <a href="#">Hans Jonas</a>
                    </div>
                    <div class="single-product-title">
                        <h1>Η συμμετοχή μας σ’αυτόν τον πόλεμο</h1>
                    </div>
                    <div class="single-product-subtitle">
                        <h2>Έκκληση προς άρρενες Εβραίους (β έκδοση, 2018)</h2>
                    </div>
                    <div class="single-product-role-detail-first">
                        <div class="single-product-role-detail">
                            <div class="single-product-role-detail__role">ΕΠΙΜΕΤΡΟ</div>
                            <div class="single-product-role-detail__detail"><a href="#">Σταύρος Ζουμπουλάκης</a></div>
                        </div>
                    </div>
                    <div class="single-product-role-detail-row">
                        <div class="single-product-role-detail-col">
                            <div class="single-product-role-detail">
                                <div class="single-product-role-detail__role">Μετάφραση</div>
                                <div class="single-product-role-detail__detail"><a href="#">Γιώργος Ανδρουλιδάκης</a></div>
                            </div>
                        </div>
                        <div class="single-product-role-detail-col">
                            <div class="single-product-role-detail">
                                <div class="single-product-role-detail__role">προλογοσ</div>
                                <div class="single-product-role-detail__detail">John Doe</div>
                            </div>
                        </div>
                    </div>
                    <div class="single-product-info-table-1-row">
                        <div class="single-product-form-col"><span>ΜΟΡΦΗ</span></div>
                        <div class="single-product-form-value"><span>Πανόδετο</span></div>
                        <div class="single-product-price-col"><span>ΤΙΜΗ</span></div>
                        <div class="single-product-regular-price"><span>15,50€</span></div>
                        <div class="single-product-sale-price"><span>14,75€</span></div>
                        <div class="single-product-discount"><span>-30%</span></div>
                        <div class="single-product-availability"><span>άμεσα διαθέσιμο</span></div>
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
                            <a href="#">Προσθήκη στο καλάθι</a>
                        </div>
                    </div>
                </div>
                <div class="single-product-tab-header-row">
                    <div class="single-product-tab-header-item active" data-section-id="description">ΠΕΡΙΓΡΑΦΗ</div>
                    <div class="single-product-tab-header-item" data-section-id="detail-information">ΑΝΑΛΥΤΙΚΑ ΣΤΟΙΧΕΙΑ</div>
                </div>
                <div class="single-product-tab-content-row">
                    <div id="single-product-tab-content-item--description" class="single-product-tab-content-item">
                        <div class="single-product-description">
                            <p>«Τούτη είναι η δική μας ώρα, τούτος είναι ο δικός μας πόλεμος.</p>
                            <p>Είναι η ώρα που περιμέναμε, με απόγνωση και ελπίδα στην καρδιά μας, όλα αυτά τα θανατερά χρόνια: η ώρα εκείνη όπου, αφού υπομείναμε αδύναμοι κάθε ταπείνωση και αδικία, κάθε σωματική στέρηση και ηθική μείωση του λαού μας, θα αξιωνόμασταν επιτέλους να αντιμετωπίσουμε τον θανάσιμο εχθρό μας κατά πρόσωπο, με το όπλο στο χέρι· να ζητήσουμε ικανοποίηση· να τακτοποιήσουμε κι εμείς τον λογαριασμό μας,  τον πρώτο απ’ όλους, στο μεγάλο ξεκαθάρισμα· και να συμβάλουμε ενεργά στην ανατροπή του παγκόσμιου εχθρού, που ήταν ευθύς εξαρχής και θα είναι μέχρι τέλους ο δικός μας εχθρός.»</p>
                            <p>Έτσι ανοίγει το συγκλονιστικό κείμενο Η συμμετοχή μας σ’ αυτόν τον πόλεμο. Έκκληση προς άρρενες Εβραίους, το οποίο έγραψε και εκφώνησε για πρώτη φορά στις 6 Οκτωβρίου 1939 ο Χανς Γιόνας, πεπεισμένος ότι οι Εβραίοι όφειλαν να συμμετάσχουν ενεργά στις πολεμικές επιχειρήσεις εναντίον της χιτλερικής Γερμανίας. Όπως επισημαίνει ο Σταύρος Ζουμπουλάκης στο Επίμετρο, «η Έκκληση δεν είναι μόνο ένα κείμενο υψηλής ηθικής αξίας, είναι και ένα κείμενο μεγάλης πολιτικής διαύγειας και διορατικότητας».</p>
                            <p>Tο βιβλίο υπάγεται στο Nόμο περί Eνιαίας Tιμής Bιβλίου, ισχύει μέγιστη έκπτωση 10%.</p>
                        </div>
                    </div>
                    <div id="single-product-tab-content-item--detail-information" class="single-product-tab-content-item hide">
                        <div class="single-product-detail-information-row">
                            <div class="single-product-detail-information-item">
                                <div class="single-product-detail-information-item__label">ISBN</div>
                                <div class="single-product-detail-information-item__value">978-960-250-741-4</div>
                            </div>
                            <div class="single-product-detail-information-item">
                                <div class="single-product-detail-information-item__label">ΔΙΑΣΤΑΣΕΙΣ</div>
                                <div class="single-product-detail-information-item__value">11,5 × 18,5 εκ.</div>
                            </div>
                            <div class="single-product-detail-information-item">
                                <div class="single-product-detail-information-item__label">ISBN SET</div>
                                <div class="single-product-detail-information-item__value">978-960-250-741-5</div>
                            </div>
                            <div class="single-product-detail-information-item">
                                <div class="single-product-detail-information-item__label">ΓΛΩΣΣΑ</div>
                                <div class="single-product-detail-information-item__value">ΕΛΛΗΝΙΚΑ</div>
                            </div>
                            <div class="single-product-detail-information-item">
                                <div class="single-product-detail-information-item__label">ΠΡΩΤΗ ΕΚΔΟΣΗ</div>
                                <div class="single-product-detail-information-item__value">12/2018</div>
                            </div>
                            <div class="single-product-detail-information-item">
                                <div class="single-product-detail-information-item__label">Πρωτοτυποσ τιτλοσ</div>
                                <div class="single-product-detail-information-item__value">Unsere Teilnahme an diesem Kriege.</div>
                            </div>
                            <div class="single-product-detail-information-item">
                                <div class="single-product-detail-information-item__label">ΤΡΕΧΟΥΣΑ ΕΚΔΟΣΗ</div>
                                <div class="single-product-detail-information-item__value">2021</div>
                            </div>
                            <div class="single-product-detail-information-item">
                                <div class="single-product-detail-information-item__label">Γλώσσα Πρωτοτύπου</div>
                                <div class="single-product-detail-information-item__value">Γερμανικά</div>
                            </div>
                            <div class="single-product-detail-information-item">
                                <div class="single-product-detail-information-item__label">ΕΚΔΟΤΗΣ</div>
                                <div class="single-product-detail-information-item__value">ΜΙΕΤ</div>
                            </div>
                            <div class="single-product-detail-information-item">
                                <div class="single-product-detail-information-item__label">ΒΑΡΟΣ</div>
                                <div class="single-product-detail-information-item__value">140 γρ.</div>
                            </div>
                            <div class="single-product-detail-information-item">
                                <div class="single-product-detail-information-item__label">ΣΕΙΡΑ</div>
                                <div class="single-product-detail-information-item__value">ΜΙΝΙΜΑ</div>
                            </div>
                            <div class="single-product-detail-information-item">
                                <div class="single-product-detail-information-item__label">ΚΩΔΙΚΟΣ ΜΙΕΤ</div>
                                <div class="single-product-detail-information-item__value">Μ-Μ2376</div>
                            </div>
                            <div class="single-product-detail-information-item">
                                <div class="single-product-detail-information-item__label">ΑΡΙΘΜΟΣ ΣΕΛΙΔΩΝ</div>
                                <div class="single-product-detail-information-item__value">65 (26 Εικόνες)</div>
                            </div>
                            <div class="single-product-detail-information-item">
                                <div class="single-product-detail-information-item__label">ΚΩΔΙΚΟΣ ΣΤΟ ΕΥΔΟΞΟ</div>
                                <div class="single-product-detail-information-item__value">384098</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="single-product-download-section">
    <div class="content-container">
        <div class="single-product-download-row">
            <div class="single-product-download-col">
                <div class="single-product-download-label">Περιεχομενα<div class="single-product-download-icon"><?php include get_template_directory() . '/assets/icons/download-icon.svg' ?></div></div>
            </div>
            <div class="single-product-download-col">
                <div class="single-product-download-label">δειγμα<div class="single-product-download-icon"><?php include get_template_directory() . '/assets/icons/download-icon.svg' ?></div></div>
            </div>
            <div class="single-product-download-col">
                <div class="single-product-download-label">ευρετηριο<div class="single-product-download-icon"><?php include get_template_directory() . '/assets/icons/download-icon.svg' ?></div></div>
            </div>
            <div class="single-product-download-col">
                <div class="single-product-download-label">press kit<div class="single-product-download-icon"><?php include get_template_directory() . '/assets/icons/download-icon.svg' ?></div></div>
            </div>
        </div>
    </div>
</section>
<section class="single-product-meta-section">
    <div class="content-container">
        <div class="single-product-meta-tab-row">
            <div class="single-product-meta-tab-col">
                <div class="single-product-meta-tab-item active" data-section-id="review">Βιβλιοκρισίες</div>
            </div>
            <div class="single-product-meta-tab-col">
                <div class="single-product-meta-tab-item" data-section-id="audio">Audio</div>
            </div>
            <div class="single-product-meta-tab-col">
                <div class="single-product-meta-tab-item" data-section-id="video">Video</div>
            </div>
            <div class="single-product-meta-tab-col">
                <div class="single-product-meta-tab-item" data-section-id="article">Σχετικά  Άρθρα</div>
            </div>
        </div>
        <div class="single-product-meta-tab-content-row">
            <div id="single-product-meta-tab-content--review" class="single-product-meta-tab-content-col">
                <div class="single-product-review-wrapper" is="mieteshop-product-review-slider">
                    <div class="swiper-container" data-slider>
                        <div class="swiper-wrapper">
                            <?php
                                for( $i = 0; $i < 5; $i++ ){
                            ?>
                                    <div class="swiper-slide">
                                        <div class="single-product-review">
                                            <div class="single-product-review__content">
                                                <p>Ο Γιόνας καλεί τους ομοεθνείς του σε πόλεμο διαρκείας με τη ναζιστική μηχανή, στο πλευρό των δυτικών συμμάχων, και μάλιστα υπό το κέλυφος μιας ξεχωριστής εβραϊκής «λεγεώνας»</p>
                                            </div>
                                            <div class="single-product-review__autor">"Τα Νέα", 14/9/2019 |  Ο πόλεμος του Χανς Γιόνας</div>
                                        </div>
                                    </div>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                    <div class="single-product-review-pagination-wrapper" data-pagination></div>
                </div>
            </div>
            <div id="single-product-meta-tab-content--audio" class="single-product-meta-tab-content-col hide">
                <div class="single-product-audio-wrapper">
                    <?php $audio_image_url = get_template_directory_uri() . '/assets/images/audio.png'; ?>
                    <img
                        class="lazyload"
                        src="<?php echo placeholderImage(814, 290); ?>"
                        data-src="<?php echo $audio_image_url; ?>"
                        alt="audio image">
                </div>
            </div>
            <div id="single-product-meta-tab-content--video" class="single-product-meta-tab-content-col hide">
                <div class="single-product-video-wrapper" is="mieteshop-product-video-slider">
                    <div class="swiper-container" data-slider>
                        <div class="swiper-wrapper">
                            <?php
                                for( $i = 0; $i < 5; $i++ ){
                            ?>
                                    <div class="swiper-slide">
                                        <div class="single-product-video-item-row">
                                            <div class="single-product-video-item-left-col">
                                                <?php $video_image_url = get_template_directory_uri() . '/assets/images/video.png'; ?>
                                                <div class="single-product-video-image-wrapper">
                                                    <img
                                                        class="lazyload"
                                                        src="<?php echo placeholderImage(606, 241); ?>"
                                                        data-src="<?php echo $video_image_url; ?>"
                                                        alt="video image">
                                                    <div class="single-product-video-play-icon"><?php include get_template_directory() . '/assets/icons/video-play-icon.svg' ?></div>
                                                    <div class="single-product-video-resize-icon"><?php include get_template_directory() . '/assets/icons/resize-icon.svg' ?></div>
                                                </div>
                                            </div>
                                            <div class="single-product-video-item-right-col">
                                                <div class="single-product-video-item-content">
                                                    <h2>Παρουσίαση της σειράς «ΜΙΝΙΜΑ»</h2>
                                                    <p>Στο βιβλιοπωλείο του ΜΙΕΤ ( Tσιμισκή 11, Θεσσαλονίκη), πραγματοποιήθηκε η παρουσίαση της σειράς "minima" των εκδόσεων του Μορφωτικού Ιδρύματος Εθνικής Τραπέζης, την Πέμπτη 19 Οκτωβρίου 2017.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                    <div class="single-product-video-pagination-wrapper" data-pagination></div>
                </div>
            </div>
            <div id="single-product-meta-tab-content--article" class="single-product-meta-tab-content-col hide">
                <div class="single-product-blog-wrapper" is="mieteshop-product-blog-slider">
                    <div class="swiper-container" data-slider>
                        <div class="swiper-wrapper">
                            <?php
                                for( $i = 0; $i < 5; $i++ ){
                            ?>
                                    <div class="single-product-blog-item swiper-slide">
                                        <div class="single-product-blog-item-inner">
                                            <?php $blog_image_url = get_template_directory_uri() . '/assets/images/blog.png'; ?>
                                            <div class="single-product-blog-image">
                                                <img
                                                    class="lazyload"
                                                    src="<?php echo placeholderImage(399, 261); ?>"
                                                    data-src="<?php echo $blog_image_url; ?>"
                                                    alt="video image">
                                            </div>
                                            <div class="single-product-blog-content">
                                                <h2>Ακαδημία Αθηνών Α</h2>
                                                <p>Δοκιμαστικό κείμενο</p>
                                            </div>
                                        </div>
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
</section>
<div class="single-product-realted-section">
    <div class="wide-container">
        <div class="content-container">
            <div class="single-product-realted-title">
                <h2>ΣΧΕΤΙΚΟΙ ΤΙΤΛΟΙ</h2>
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
                                    <div class="pcat-result-item-meta-row">
                                        <div class="pcat-result-item-meta-col">
                                            <div class="pcat-result-item-favorite">
                                                <a href="#"><span><?php include get_template_directory() . '/assets/icons/favorite-small-icon.svg' ?></span></a>
                                            </div>
                                        </div>
                                        <div class="pcat-result-item-meta-col">
                                            <div class="pcat-result-item-busket">
                                                <a href="#"><span><?php include get_template_directory() . '/assets/icons/busket-small-icon.svg' ?></span></a>
                                            </div>
                                        </div>
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
                                <div class="pcat-result-item-footer-row">
                                    <div class="pcat-result-item-footer-col">
                                        <div class="pcat-result-item-footer-product-price">
                                            <?php echo $product->get_price_html(); ?>
                                        </div>
                                    </div>
                                    <div class="pcat-result-item-footer-col">
                                        <div class="pcat-result-item-footer-product-discount">-30%</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                    wp_reset_query();
                ?>
            </div>
        </div>
    </div>
</div>
<div class="single-product-recently-section">
    <div class="content-container">
        <div class="single-product-recently-title">
            <h2>ΕΙΔΑΤΕ ΠΡΟΣΦΑΤΑ</h2>
        </div>
        <div class="pcat-results-row">
            <?php
                $args = [
                    'post_type' => 'product',
                    'posts_per_page' => 4,
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
                                <div class="pcat-result-item-meta-row">
                                    <div class="pcat-result-item-meta-col">
                                        <div class="pcat-result-item-favorite">
                                            <a href="#"><span><?php include get_template_directory() . '/assets/icons/favorite-small-icon.svg' ?></span></a>
                                        </div>
                                    </div>
                                    <div class="pcat-result-item-meta-col">
                                        <div class="pcat-result-item-busket">
                                            <a href="#"><span><?php include get_template_directory() . '/assets/icons/busket-small-icon.svg' ?></span></a>
                                        </div>
                                    </div>
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
                            <div class="pcat-result-item-footer-row">
                                <div class="pcat-result-item-footer-col">
                                    <div class="pcat-result-item-footer-product-price">
                                        <?php echo $product->get_price_html(); ?>
                                    </div>
                                </div>
                                <div class="pcat-result-item-footer-col">
                                    <div class="pcat-result-item-footer-product-discount">-30%</div>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                }
                wp_reset_query();
            ?>
        </div>
    </div>
</div>