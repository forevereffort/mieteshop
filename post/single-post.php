<?php
    global $post;
?>
<section class="breadcrumb-section">
    <div class="content-container">
        <div class="breadcrumb-list">
            <div class="breadcrumb-item"><a href="#">Εκδηλώσεις</a></div>
            <div class="breadcrumb-item"><a href="#">Εκθέσεις</a></div>
        </div>
    </div>
</section>
<section class="single-post-title-section">
    <div class="content-container">
        <div class="single-post-title-row">
            <div class="single-post-title-left-col">
                <h1>Για λουλούδια θα μιλάμε τώρα;</h1>
            </div>
            <div class="single-post-title-right-col">
                <div class="single-post-title-category-row">
                    <div class="single-post-title-category-item">
                        <a href="#">ΕΚΔΗΛΩΣΕΙΣ</a>
                    </div>
                    <div class="single-post-title-category-item">
                        <a href="#">EΚΘΕΣΕΙΣ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="single-post-hero-section">
    <div class="content-container">
        <?php
            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
        ?>
        <div class="single-post-hero-row">
            <div class="single-post-hero-event">
                <div class="single-post-hero-event-inner">
                    <?php echo get_field('event_details'); ?>
                </div>
            </div>
            <div class="single-post-hero-col">
                <div class="single-post-hero-image">
                    <img
                        class="lazyload"
                        src="<?php echo placeholderImage($image[1], $image[2]); ?>"
                        data-src="<?php echo aq_resize($image[0], $image[1], $image[2], true); ?>"
                        alt="<?php echo $post->post_title; ?>">
                </div>
                <div class="single-post-hero-content-row">
                    <div class="single-post-hero-content">
                        <p>Στην έκθεση παρουσιάζονται έργα που δημιουργήθηκαν με αφορμή  τα λουλούδια, από καλλιτέχνες που ανήκουν σε διαφορετικές γενιές, προέρχονται από διαφορετικούς τόπους και χρησιμοποιούν διαφορετικά εικαστικά μέσα.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="single-post-description-1-section">
    <div class="content-container">
        <div class="single-post-description-1-content">
            <p><strong>Συμμετέχουν οι καλλιτέχνες:</strong> Caroline Luigi, Βασίλης Ζωγράφος, Ελένη Θεοφυλάκτου, Κωνσταντίνος Λαδιανός, Τέτα Μακρή, Γιώργος Μπουδαλής, Μαρία Μπουρίκα, Μαρία Ξυνοπούλου, Φένια Παγώνη, Νίκος Παπαδόπουλος, Γιούλα και Όλγα Παπαδοπούλου, Νίκος Ποδιάς, Νίκος Τριανταφύλλου.</p>
            <p><strong>Επιμέλεια έκθεσης:</strong> Γιώργος Μπουδαλής</p>
            <p>Η έκθεση, την πρώτη μέρα λειτουργίας της, θα είναι ανοιχτή για το κοινό από τις 18:00 έως τις 21:00.</p>
            <p>Στην προσπάθεια περιορισμού της διάδοσης της CΟVID-19, δεν θα πραγματοποιηθούν ομιλίες. Στον χώρο έχουν ληφθεί όλα τα απαραίτητα μέτρα προστασίας για εργαζόμενους και επισκέπτες. Η χρήση μάσκας κατά την επίσκεψή σας είναι υποχρεωτική, σύμφωνα με τις οδηγίες του Υπουργείου Υγείας.</p>
        </div>
    </div>
</section>
<section class="single-product-meta-section">
    <div class="content-container">
        <div class="single-product-meta-tab-row">
            <div class="single-product-meta-tab-col">
                <div class="single-product-meta-tab-item">Video</div>
            </div>
        </div>
        <div class="single-product-meta-tab-content-row">
            <div class="single-product-meta-tab-content-col">
                <div class="single-product-video-wrapper">
                    <div class="single-product-video-item-row">
                        <div class="single-product-video-item-left-col">
                            <?php $video_image_url = get_template_directory_uri() . '/assets/images/video-1.png'; ?>
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
                                <h2>Παρουσίαση της έκθεσης</h2>
                                <p>Δοκιμαστικό video μέσα σε ένα blog post, το οποίο μπορεί και να έχει κάποια περιγραφή μέχρι 3-4 σειρές που να είναι σχετική με το video.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="single-post-description-1-section">
    <div class="content-container">
        <div class="single-post-description-1-content">
            <h2>Για την έκθεση</h2>
            <p>«Ο πρωτόγονος άνθρωπος, δίνοντας λουλούδια στην αγαπημένη του, έκανε μια συμβολική κίνηση και πέρασε στη σφαίρα της τέχνης. Οι άνθρωποι έχουν λατρέψει τον κρίνο, έχουν διαλογιστεί με τον λωτό, έχουν πολεμήσει με το ρόδο και το χρυσάνθεμο. Η υπερβολική και αναίτια σπατάλη λουλουδιών στις δυτικές κοινωνίες προσφέρει το πιο μελαγχολικό θέαμα στο τέλος της γιορτής·  μαραμένα και πεταμένα δίπλα στα σκουπίδια. Τα αγριολούλουδα γίνονται όλο και πιο σπάνια, μας εγκαταλείπουν γι’ αυτή μας τη σκληρότητα, περιμένοντας να γίνει πιο ανθρώπινος ο άνθρωπος».  Αυτά λέει, σε ελεύθερη μεταφορά, ο Οκάκουρα Κακούζο σχετικά με τα άνθη, στο Βιβλίο τού τσαγιού που κυκλοφόρησε στην Ευρώπη στις αρχές του εικοστού αιώνα.</p>
        </div>
    </div>
</section>
<section class="single-post-slider-section">
    <div class="content-container">
        <div class="single-post-slider-title">
            <h2>«Η υπερβολική και αναίτια σπατάλη λουλουδιών στις δυτικές κοινωνίες προσφέρει το πιο μελαγχολικό θέαμα στο τέλος της γιορτής»</h2>
        </div>
        <div class="single-post-slider-row" is="mieteshop-post-slider">
            <div class="single-post-slider-big-wrapper">
                <div class="swiper-container" data-big-slider>
                    <div class="swiper-wrapper">
                        <?php
                            $slider_image_url = get_template_directory_uri() . '/assets/images/slider-1.png';
                            for( $i = 0; $i < 20; $i++ ){
                        ?>
                                <div class="swiper-slide">
                                    <img
                                        class="lazyload"
                                        src="<?php echo placeholderImage(1024, 585); ?>"
                                        data-src="<?php echo $slider_image_url; ?>"
                                        alt="video image">
                                </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
                <div class="single-post-slider-big-nav-wrapper">
                    <div data-slider-button="prev" class="single-post-slider-big-nav single-post-slider-big-nav--prev"><?php include get_template_directory() . '/assets/icons/slider-prev-icon.svg'; ?></div>
                    <div data-slider-button="next" class="single-post-slider-big-nav single-post-slider-big-nav--next"><?php include get_template_directory() . '/assets/icons/slider-next-icon.svg'; ?></div>
                </div>
            </div>
            <div class="single-post-slider-small-wrapper">
                <div class="swiper-container" data-small-slider>
                    <div class="swiper-wrapper">
                        <?php
                            $slider_image_sub_url = get_template_directory_uri() . '/assets/images/slider-1-sub.png';
                            for( $i = 0; $i < 20; $i++ ){
                        ?>
                                <div class="swiper-slide single-post-slider-small-item">
                                    <img
                                        class="lazyload"
                                        src="<?php echo placeholderImage(93, 91); ?>"
                                        data-src="<?php echo $slider_image_sub_url; ?>"
                                        alt="video image">
                                </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="single-post-description-2-section">
    <div class="content-container">
        <div class="single-post-description-1-content">
            <p>Στη βιολογία τα λουλούδια είναι τα αναπαραγωγικά μέρη των εξελικτικά ανώτερων φυτών· αυτά που θα δώσουν τους καρπούς και τους σπόρους, εξασφαλίζοντας τη συνέχεια του είδους.</p>
            <p>Τα λουλούδια –και ευρύτερα το φυτικό βασίλειο– υπήρξαν πάντοτε θέμα προσφιλές στους καλλιτέχνες.  Από τον διάκοσμο στο διάδημα της “βασίλισσας” Puabi και τα κρίνα στις τοιχογραφίες της Σαντορίνης, μέχρι τους μεσαιωνικούς περίκλειστους κήπους, τις ταπετσαρίες των τοίχων, τα χαλιά, τα υφάσματα των ρούχων, τα έργα του Boticelli, των Εμπρεσιονιστών, των Προραφαηλιτών, του Van Gogh, του Henri Matisse, της Georgia O’ Keeffe, του Jeff Koons, τα άνθη είναι παρόντα.</p>
            <p>Συμβολίζοντας τη γιορτή, τη συγγνώμη, τον αποχωρισμό, το εφήμερο, τον έρωτα, το πένθος, τη μνήμη και την ομορφιά –για την οποία αισθανόμαστε μια εγγενή συγκίνηση– τα λουλούδια καλύπτουν όλη την κλίμακα των συναισθημάτων. Δεν σταμάτησαν ποτέ να ελκύουν τους καλλιτέχνες, που τα αποδίδουν τόσο με σύγχρονα όσο και με διαχρονικά εικαστικά εργαλεία: σχέδιο, ζωγραφική, φωτογραφία, ψηφιακά μέσα κλπ.</p>
            <p>Το θέμα παραμένει το ίδιο –όπως και ένα σωρό άλλα–, προσεγγίζεται όμως από τον καλλιτέχνη και εισπράττεται από τον φιλότεχνο με διαφορετικό τρόπο σε κάθε εποχή.</p>
            <p>Δεν αλλάζουν τα λουλούδια, μάλλον το βλέμμα μας αλλάζει.</p>
        </div>
    </div>
</section>