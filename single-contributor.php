<?php get_header(); ?>

<?php
    global $post;

    if ( have_posts() ) {
        while ( have_posts() ){
            the_post();
?>
<section class="single-publisher-title">
    <div class="content-container">
        <h1>Καβάφης Κ. Π.</h1>
    </div>
</section>
<section class="single-contributor-image-lead-section">
    <div class="general-container">
        <div class="content-container">
            <div class="single-contributor-image-lead-row">
                <div class="single-contributor-image-lead-left">
                    <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>
                    <div class="single-contributor-image-lead-image">
                        <img
                            class="lazyload"
                            src="<?php echo placeholderImage($image[1], $image[2]); ?>"
                            data-src="<?php echo aq_resize($image[0], $image[1], $image[2], true); ?>"
                            alt="<?php echo $post->post_title; ?>">
                    </div>
                </div>
                <div class="single-contributor-image-lead-right">
                    <div class="single-contributor-image-lead-content">
                        <p>Ο Κωνσταντίνος Καβάφης (Αλεξάνδρεια, 29 Απριλίου 1863 (π.ημ.) / 29 Απριλίου 1863 Αλεξάνδρεια, 29 Απριλίου 1933) ήταν Έλληνας ποιητής ο οποίος θεωρείται ως ένας από τους σημαντικότερους ποιητές της σύγχρονης εποχής. Γεννήθηκε και έζησε στην Αλεξάνδρεια, γι' αυτό και αναφέρεται συχνά ως «ο Αλεξανδρινός».  Δημοσίευσε ποιήματα, ενώ δεκάδες παρέμειναν ως προσχέδια. Τα σημαντικότερα έργα του τα δημιούργησε μετά τα 40 έτη.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="single-publisher-text-caption-section">
    <div class="content-container">
        <div class="single-publisher-text-caption-row">
            <div class="single-publisher-text-caption-left"></div>
            <div class="single-publisher-text-caption-right">
                <div class="single-publisher-text-caption-content">
                    <p>Το βιβλίο αυτό επιχειρεί να σκιαγραφήσει τις σημαντικότερες συμβολές στον διάλογο του πολιτικού ουμανισμού και του ατομικιστικού φιλελευθερισμού, των δύο ρευμάτων που διαμόρφωσαν τη νεότερη πολιτική σκέψη, τις στοχαστικές και συστηματικές αναζητήσεις γύρω από τη συνύπαρξη των ανθρώπων σε οργανωμένα σύνολα οι οποίες διατυπώθηκαν κατά τη μετά τον Μεσαίωνα εποχή. Στόχος της ανάλυσης είναι η αποκατάσταση της ιστορικότητας καθεμιάς από τις συμβολές αυτές, ώστε να γίνουν κατανοητές οι προθέσεις και οι επιδιώξεις, πολιτικές και ηθικές, των στοχαστών που σχολιάζονται, ως προς τη διατύπωση των πολιτικών τους επιχειρημάτων. </p>
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
<div class="single-product-recently-section single-product-recently-section--border-bottom">
    <div class="content-container">
        <div class="single-product-recently-title">
            <h2>ΒΙΒΛΙΑ ΤΟΥ ΣΥΓΓΡΑΦΕΑ</h2>
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
<div class="single-product-recently-section">
    <div class="content-container">
        <div class="single-product-recently-title">
            <h2>ΣΧΕΤΙΚΟΙ ΤΙΤΛΟΙ</h2>
        </div>
        <div class="pcat-results-row">
            <?php
                $args = [
                    'post_type' => 'product',
                    'posts_per_page' => 4,
                    'offset' => 10
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
<?php
        }
    }
?>

<?php get_footer(); ?>