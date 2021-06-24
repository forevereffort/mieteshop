<?php get_header(); ?>

<?php
    global $post;

    if ( have_posts() ) {
        while ( have_posts() ){
            the_post();
?>
<section class="single-publisher-title">
    <div class="content-container">
        <h1>Εκδόσεις ΜΙΕΤ</h1>
    </div>
</section>
<section class="single-publisher-image-lead-section">
    <div class="content-container">
        <div class="single-publisher-image-lead-row">
            <div class="single-publisher-image-lead-left">
                <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>
                <div class="single-publisher-image-lead-image">
                    <img
                        class="lazyload"
                        src="<?php echo placeholderImage($image[1], $image[2]); ?>"
                        data-src="<?php echo aq_resize($image[0], $image[1], $image[2], true); ?>"
                        alt="<?php echo $post->post_title; ?>">
                </div>
            </div>
            <div class="single-publisher-image-lead-right">
                <div class="single-publisher-image-lead-content">
                    <p>Το βιβλίο αυτό επιχειρεί να σκιαγραφήσει τις σημαντικότερες συμβολές στον διάλογο του πολιτικού ουμανισμού και του ατομικιστικού φιλελευθερισμού, των δύο ρευμάτων που διαμόρφωσαν τη νεότερη πολιτική σκέψη, τις στοχαστικές και συστηματικές αναζητήσεις γύρω από τη συνύπαρξη των ανθρώπων σε οργανωμένα σύνολα οι οποίες διατυπώθηκαν κατά τη μετά τον Μεσαίωνα εποχή.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="single-publisher-text-caption-section">
    <div class="content-container">
        <div class="single-publisher-text-caption-row">
            <div class="single-publisher-text-caption-left">Λεζάντα φωτογραφίας με credit</div>
            <div class="single-publisher-text-caption-right">
                <div class="single-publisher-text-caption-content">
                    <p>Το βιβλίο αυτό επιχειρεί να σκιαγραφήσει τις σημαντικότερες συμβολές στον διάλογο του πολιτικού ουμανισμού και του ατομικιστικού φιλελευθερισμού, των δύο ρευμάτων που διαμόρφωσαν τη νεότερη πολιτική σκέψη, τις στοχαστικές και συστηματικές αναζητήσεις γύρω από τη συνύπαρξη των ανθρώπων σε οργανωμένα σύνολα οι οποίες διατυπώθηκαν κατά τη μετά τον Μεσαίωνα εποχή. Στόχος της ανάλυσης είναι η αποκατάσταση της ιστορικότητας καθεμιάς από τις συμβολές αυτές, ώστε να γίνουν κατανοητές οι προθέσεις και οι επιδιώξεις, πολιτικές και ηθικές, των στοχαστών που σχολιάζονται, ως προς τη διατύπωση των πολιτικών τους επιχειρημάτων.</p>
                    <p>Μόνον έτσι μπορεί να γίνει αντιληπτός ο χαρακτήρας της συμβολικής έκφρασης που υιοθετούν οι στοχαστές, για να επικοινωνήσουν με τον πολιτισμικό τους περίγυρο, και να αποκρυπτογραφηθεί το μήνυμά τους με τα δικά τους και όχι τα δικά μας συμφραζόμενα, που συχνά μας παρασύρουν σε παρανοήσεις. Ως κλειδί της ιστορικής αποκατάστασης του νοήματος της πολιτικής σκέψης επιλέχθηκε η βιογραφική μέθοδος, η οποία επιτρέπει την ένταξη των συγγραφέων και των έργων στο ιστορικό τους πλαίσιο, αποκαλύπτοντας έτσι τις πολιτικές συγκυρίες που διαμόρφωσαν τις προθέσεις της επιχειρηματολογίας τους. Με αυτή τη μέθοδο παρουσιάζονται η πνευματική φυσιογνωμία και οι πολιτικές ιδέες των Μακιαβέλλι, Χομπς, Λοκ, Μοντεσκιέ, Ρουσσώ, Μπερκ, Μπένθαμ, Μιλλ και Τοκβίλλ. Η παρουσίαση των ιδεών τους πλαισιώνεται από εκτενείς βιβλιογραφικές συναγωγές πηγών και βοηθημάτων, που καθιστούν το βιβλίο εργαλείο για περαιτέρω έρευνα και εμβάθυνση.</p>
                </div>
                <div class="single-publisher-text-caption-download">
                    <a href="#">Κατεβάστε τον κατάλογο (7Mb)</a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="single-product-meta-section">
    <div class="content-container">
        <div class="single-product-meta-tab-row">
            <div class="single-product-meta-tab-col">
                <div class="single-product-meta-tab-item active" data-section-id="video">Video</div>
            </div>
            <div class="single-product-meta-tab-col">
                <div class="single-product-meta-tab-item" data-section-id="article">Σχετικά  Άρθρα</div>
            </div>
        </div>
        <div class="single-product-meta-tab-content-row">
            <div id="single-product-meta-tab-content--video" class="single-product-meta-tab-content-col">
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
<div class="single-product-recently-section">
    <div class="content-container">
        <div class="single-product-recently-title">
            <h2>ΒΙΒΛΙΑ</h2>
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
<section class="single-product-series-section">
    <div class="small-container">
        <div class="single-product-series-title">
            <h2>ΣΕΙΡΕΣ</h2>
        </div>
        <div class="single-product-series-row">
            <div class="single-product-series-col">
                <div class="single-product-series-item">
                    <div class="single-product-series-item-image">
                        <img
                            class="lazyload"
                            src="<?php echo placeholderImage(300, 160, '#cccccc'); ?>"
                            data-src="<?php echo aq_resize('', 300, 160, true); ?>"
                            alt="dump">
                    </div>
                    <div class="single-product-series-item-title">
                        <h3>Minima</h3>
                    </div>
                    <div class="single-product-series-item-info">
                        <p><strong>16</strong> τίτλοι</p>
                    </div>
                </div>
            </div>
            <div class="single-product-series-col">
                <div class="single-product-series-item">
                    <div class="single-product-series-item-image">
                        <img
                            class="lazyload"
                            src="<?php echo placeholderImage(300, 160, '#cccccc'); ?>"
                            data-src="<?php echo aq_resize('', 300, 160, true); ?>"
                            alt="dump">
                    </div>
                    <div class="single-product-series-item-title">
                        <h3>Demo</h3>
                    </div>
                    <div class="single-product-series-item-info">
                        <p><strong>3</strong> τίτλοι</p>
                    </div>
                </div>
            </div>
            <div class="single-product-series-col">
                <div class="single-product-series-item">
                    <div class="single-product-series-item-image">
                        <img
                            class="lazyload"
                            src="<?php echo placeholderImage(300, 160, '#cccccc'); ?>"
                            data-src="<?php echo aq_resize('', 300, 160, true); ?>"
                            alt="dump">
                    </div>
                    <div class="single-product-series-item-title">
                        <h3>Αρχειοθήκη</h3>
                    </div>
                    <div class="single-product-series-item-info">
                        <p><strong>3</strong> τίτλοι</p>
                    </div>
                </div>
            </div>
            <div class="single-product-series-col">
                <div class="single-product-series-item">
                    <div class="single-product-series-item-image">
                        <img
                            class="lazyload"
                            src="<?php echo placeholderImage(300, 160, '#cccccc'); ?>"
                            data-src="<?php echo aq_resize('', 300, 160, true); ?>"
                            alt="dump">
                    </div>
                    <div class="single-product-series-item-title">
                        <h3>ΑΦΕΛΙΑ</h3>
                    </div>
                    <div class="single-product-series-item-info">
                        <p><strong>3</strong> τίτλοι</p>
                    </div>
                </div>
            </div>
            <div class="single-product-series-col">
                <div class="single-product-series-item">
                    <div class="single-product-series-item-image">
                        <img
                            class="lazyload"
                            src="<?php echo placeholderImage(300, 160, '#cccccc'); ?>"
                            data-src="<?php echo aq_resize('', 300, 160, true); ?>"
                            alt="dump">
                    </div>
                    <div class="single-product-series-item-title">
                        <h3>Βυζαντινή & Νεοελληνική βιβλιοθήκη</h3>
                    </div>
                    <div class="single-product-series-item-info">
                        <p><strong>3</strong> τίτλοι</p>
                    </div>
                </div>
            </div>
            <div class="single-product-series-col">
                <div class="single-product-series-item">
                    <div class="single-product-series-item-image">
                        <img
                            class="lazyload"
                            src="<?php echo placeholderImage(300, 160, '#cccccc'); ?>"
                            data-src="<?php echo aq_resize('', 300, 160, true); ?>"
                            alt="dump">
                    </div>
                    <div class="single-product-series-item-title">
                        <h3>Νεοελληνική Προσωπογραφία</h3>
                    </div>
                    <div class="single-product-series-item-info">
                        <p><strong>3</strong> τίτλοι</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="home-authors-section">
    <div class="small-container">
        <div class="home-authors-title">
            <h2>ΣΥΓΓΡΑΦΕΙΣ</h2>
        </div>
        <div class="home-authors-row">
            <?php
                $args = [
                    'post_type' => 'contributor',
                    'posts_per_page' => 3,
                ];
            
                $loop = new WP_Query( $args );

                while ( $loop->have_posts() ){
                    $loop->the_post();
                    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
            ?>
                    <div class="home-authors-col">
                        <div class="home-authors-image">
                            <img
                                class="lazyload"
                                src="<?php echo placeholderImage($image[1], $image[2]); ?>"
                                data-src="<?php echo aq_resize($image[0], $image[1], $image[2], true); ?>"
                                alt="<?php echo $post->post_title; ?>">
                        </div>
                        <div class="home-authors-name">
                            <h3><?php echo $post->post_title; ?></h3>
                        </div>
                    </div>
            <?php
                }

                wp_reset_query();
            ?>
        </div>
    </div>
</section>
<section class="pcat-results-section">
    <div class="content-container">
        <div class="pcat-results-top-title">
            <h2>ΒΙΒΛΙΑ</h2>
        </div>
        <div class="pcat-results-top-row">
            <div class="pcat-results-top-left-col">
                <div class="pcat-results-title">
                    <h2>ΤΙΤΛΟΙ: 32</h2>
                </div>
            </div>
            <div class="pcat-results-top-right-col">
                <div class="pcat-classification-filter">
                    <div class="pcat-classification-filter-label pcat-classification-filter-label--black">ΤΑΞΙΝΟΜΗΣΗ</div>
                    <div class="pcat-classification-filter-select">
                        <select>
                            <option value="1">Χρονολογική</option>
                        </select>
                        <div class="pcat-classification-filter-select-icon"><?php include get_template_directory() . '/assets/icons/arrow-down-white-icon.svg'; ?></div>
                    </div>
                </div>
            </div>
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
        <div class="pcat-results-footer-options">
            <div class="pcat-results-footer-options-col">
                <div class="pcat-results-navigation">
                    <div class="pcat-results-navigation-row">
                        <div class="pcat-results-navigation-item active"><a href="#">1</a></div>
                        <div class="pcat-results-navigation-item"><a href="#">2</a></div>
                        <div class="pcat-results-navigation-next"><?php include get_template_directory() . '/assets/icons/arrow-right-icon.svg' ?></div>
                    </div>
                </div>
            </div>
            <div class="pcat-results-footer-options-col">
                <div class="pcat-results-footer-select">
                    <div class="pcat-results-footer-select-label">Mετάβαση στη σελίδα</div>
                    <div class="pcat-results-footer-select-elem">
                        <select>
                            <option value="1">1</option>
                        </select>
                        <div class="pcat-results-footer-select-elem-icon"><?php include get_template_directory() . '/assets/icons/arrow-down-icon.svg'; ?></div>
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