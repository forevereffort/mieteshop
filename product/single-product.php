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
                    <div class="single-product-tab-header-item active">ΠΕΡΙΓΡΑΦΗ</div>
                    <div class="single-product-tab-header-item">ΑΝΑΛΥΤΙΚΑ ΣΤΟΙΧΕΙΑ</div>
                </div>
                <div class="single-product-tab-content-row">
                    <div class="single-product-tab-content-item">
                        <p>«Τούτη είναι η δική μας ώρα, τούτος είναι ο δικός μας πόλεμος.</p>
                        <p>Είναι η ώρα που περιμέναμε, με απόγνωση και ελπίδα στην καρδιά μας, όλα αυτά τα θανατερά χρόνια: η ώρα εκείνη όπου, αφού υπομείναμε αδύναμοι κάθε ταπείνωση και αδικία, κάθε σωματική στέρηση και ηθική μείωση του λαού μας, θα αξιωνόμασταν επιτέλους να αντιμετωπίσουμε τον θανάσιμο εχθρό μας κατά πρόσωπο, με το όπλο στο χέρι· να ζητήσουμε ικανοποίηση· να τακτοποιήσουμε κι εμείς τον λογαριασμό μας,  τον πρώτο απ’ όλους, στο μεγάλο ξεκαθάρισμα· και να συμβάλουμε ενεργά στην ανατροπή του παγκόσμιου εχθρού, που ήταν ευθύς εξαρχής και θα είναι μέχρι τέλους ο δικός μας εχθρός.»</p>
                        <p>Έτσι ανοίγει το συγκλονιστικό κείμενο Η συμμετοχή μας σ’ αυτόν τον πόλεμο. Έκκληση προς άρρενες Εβραίους, το οποίο έγραψε και εκφώνησε για πρώτη φορά στις 6 Οκτωβρίου 1939 ο Χανς Γιόνας, πεπεισμένος ότι οι Εβραίοι όφειλαν να συμμετάσχουν ενεργά στις πολεμικές επιχειρήσεις εναντίον της χιτλερικής Γερμανίας. Όπως επισημαίνει ο Σταύρος Ζουμπουλάκης στο Επίμετρο, «η Έκκληση δεν είναι μόνο ένα κείμενο υψηλής ηθικής αξίας, είναι και ένα κείμενο μεγάλης πολιτικής διαύγειας και διορατικότητας».</p>
                        <p>Tο βιβλίο υπάγεται στο Nόμο περί Eνιαίας Tιμής Bιβλίου, ισχύει μέγιστη έκπτωση 10%.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>