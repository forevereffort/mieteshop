<?php
/**
 * Template Name: About Page
 */
global $post;
?>
<?php get_header(); ?>
<section class="single-publisher-title">
    <div class="content-container">
        <h1>Σχετικά με το βιβλιοπωλείο του ΜΙΕΤ</h1>
    </div>
</section>
<section class="about-hero-section">
    <?php
        $about_image_url = get_template_directory_uri() . '/assets/images/about.png';
    ?>
    <div class="about-hero-image">
        <img
            class="lazyload"
            src="<?php echo placeholderImage(1100, 500); ?>"
            data-src="<?php echo $about_image_url; ?>"
            alt="video image">
    </div>
    <div class="about-hero-des-1">
        <div class="about-hero-des-1-content">
            <p>Το 1966, επί Διοικήσεως Γεωργίου Μαύρου, η Εθνική Τράπεζα της Ελλάδος (ΕΤΕ), στο πλαίσιο του εορτασμού των 125 χρόνων από την ίδρυσή της, αποφάσισε να δημιουργήσει ένα μορφωτικό-πολιτιστικό ίδρυμα με σκοπό να συμβάλει στην ανάπτυξη των γραμμάτων, των επιστημών και των καλών τεχνών. Το Μορφωτικό Ίδρυμα Εθνικής Τραπέζης συστάθηκε πράγματι με το Διάταγμα 311 της 1ης Απριλίου 1966.</p>
        </div>
    </div>
    <div class="about-hero-des-2">
        <div class="about-hero-des-2-content">
            <p>Οι Πανεπιστημιακές Εκδόσεις Κρήτης- Ίδρυμα Τεχνολογίας Έρευνας (ΠΕΚ-ΙΤΕ) αποδίδουν ιδιαίτερη σημασία στην προστασία της ιδιωτικότητας και των δεδομένων προσωπικού χαρακτήρα των επισκεπτών/χρηστών. Επισημαίνεται ότι ως δεδομένα προσωπικού χαρακτήρα νοούνται από την οικεία νομοθεσία  (Γενικός Κανονισμός Προστασίας Δεδομένων 2016/679/ΕΕ) μόνο εκείνες οι πληροφορίες που αφορούν ένα προσδιορισμένο ή – επί τη βάσει κάποιων χαρακτηριστικών – προσδιορίσιμο φυσικό πρόσωπο (υποκείμενο των δεδομένων). Πληροφορίες που αφορούν νομικά πρόσωπα και ομάδες προσώπων ή πληροφορίες στατιστικού χαρακτήρα, από τις οποίες δεν είναι δυνατή η αναγωγή σε προσδιορισμένο ή προσδιορίσιμο φυσικό πρόσωπο, δεν εμπίπτουν σε αυτήν την κατηγορία και εξαιρούνται από το πεδίο εφαρμογής της σχετικής νομοθεσίας.</p>
        </div>
    </div>
</section>
<section class="about-store-section">
    <div class="content-container">
        <div class="about-store-title">
            <h2>ΒΙΒΛΙΟΠΩΛΕΙΑ</h2>
        </div>
        <div class="about-store-list">
            <div class="about-store-item">
                <div class="about-store-item-row">
                    <div class="about-store-item-col-1">
                        <div class="about-store-item-store-location">
                            <div class="about-store-item-store-name">Βιβλιοπωλείο ΜΙΕΤ, <br/><strong>Αθήνα</strong></div>
                            <div class="about-store-item-store-address">Αμερικής 13 <br/>Αθήνα - Τ.Κ. 106 72</div>
                            <div class="about-store-item-store-phone-label">Τηλέφωνα επικοινωνίας</div>
                            <div class="about-store-item-store-phone-list"><a href="tel:2103256785">210 3256785</a>, <a href="tel:2103258695">210 3258695</a></div>
                            <div class="about-store-item-store-email-label">Email</div>
                            <div class="about-store-item-store-email-list"><a href="mailto:2103256785">info@mietbookshopathens.gr</a></div>
                        </div>
                    </div>
                    <div class="about-store-item-col-2">
                        <div class="about-store-item-store-hour">
                            <div class="about-store-item-store-hour-title">Ωράριο Λειτουργίας</div>
                            <div class="about-store-item-store-hour-label">Δευτέρα</div>
                            <div class="about-store-item-store-hour-value">9:30AM–3:30PM</div>
                            <div class="about-store-item-store-hour-label">Τρίτη</div>
                            <div class="about-store-item-store-hour-value">9:30AM–8PM</div>
                            <div class="about-store-item-store-hour-label">Τετάρτη</div>
                            <div class="about-store-item-store-hour-value">9:30AM–3:30PM</div>
                            <div class="about-store-item-store-hour-label">Πέμπτη</div>
                            <div class="about-store-item-store-hour-value">9:30AM–8PM</div>
                            <div class="about-store-item-store-hour-label">Παρασκευή</div>
                            <div class="about-store-item-store-hour-value">9:30AM–8PM</div>
                            <div class="about-store-item-store-hour-label">Σάββατο</div>
                            <div class="about-store-item-store-hour-value">10AM–5PM</div>
                            <div class="about-store-item-store-hour-label">Κυριακή</div>
                            <div class="about-store-item-store-hour-value">Κλειστά</div>
                        </div>
                    </div>
                    <div class="about-store-item-col-3">
                        <div class="about-store-item-map">
                            <div class="about-store-item-map-wrapper">
                                <img
                                    class="lazyload"
                                    src="<?php echo placeholderImage(490, 340, '#ffffff'); ?>"
                                    alt="map image">
                            </div>
                            <div class="about-store-item-map-link">
                                <a href="#">Βρείτε μας στο Google Maps</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="about-store-list">
            <div class="about-store-item">
                <div class="about-store-item-row">
                    <div class="about-store-item-col-1">
                        <div class="about-store-item-store-location">
                            <div class="about-store-item-store-name">Βιβλιοπωλείο ΜΙΕΤ, <br/><strong>Θεσσαλονίκη</strong></div>
                            <div class="about-store-item-store-address">Τσιμισκή 17 <br/>Θεσσαλονίκη <br/>Τ.Κ. 546 24</div>
                            <div class="about-store-item-store-phone-label">Τηλέφωνα επικοινωνίας</div>
                            <div class="about-store-item-store-phone-list"><a href="tel:2103256785">210 3256785</a>, <a href="tel:2103258695">210 3258695</a></div>
                            <div class="about-store-item-store-email-label">Email</div>
                            <div class="about-store-item-store-email-list"><a href="mailto:2103256785">info@mietbookshopathens.gr</a></div>
                        </div>
                    </div>
                    <div class="about-store-item-col-2">
                        <div class="about-store-item-store-hour">
                            <div class="about-store-item-store-hour-title">Ωράριο Λειτουργίας</div>
                            <div class="about-store-item-store-hour-label">Δευτέρα</div>
                            <div class="about-store-item-store-hour-value">9:30AM–3:30PM</div>
                            <div class="about-store-item-store-hour-label">Τρίτη</div>
                            <div class="about-store-item-store-hour-value">9:30AM–8PM</div>
                            <div class="about-store-item-store-hour-label">Τετάρτη</div>
                            <div class="about-store-item-store-hour-value">9:30AM–3:30PM</div>
                            <div class="about-store-item-store-hour-label">Πέμπτη</div>
                            <div class="about-store-item-store-hour-value">9:30AM–8PM</div>
                            <div class="about-store-item-store-hour-label">Παρασκευή</div>
                            <div class="about-store-item-store-hour-value">9:30AM–8PM</div>
                            <div class="about-store-item-store-hour-label">Σάββατο</div>
                            <div class="about-store-item-store-hour-value">10AM–5PM</div>
                            <div class="about-store-item-store-hour-label">Κυριακή</div>
                            <div class="about-store-item-store-hour-value">Κλειστά</div>
                        </div>
                    </div>
                    <div class="about-store-item-col-3">
                        <div class="about-store-item-map">
                            <div class="about-store-item-map-wrapper">
                                <img
                                    class="lazyload"
                                    src="<?php echo placeholderImage(490, 340, '#ffffff'); ?>"
                                    alt="map image">
                            </div>
                            <div class="about-store-item-map-link">
                                <a href="#">Βρείτε μας στο Google Maps</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="about-footer-des-section">
    <div class="general-container">
        <div class="content-container">
            <div class="about-footer-des-row">
                <div class="about-footer-des-content">
                    <p>Οι Πανεπιστημιακές Εκδόσεις Κρήτης- Ίδρυμα Τεχνολογίας Έρευνας (ΠΕΚ-ΙΤΕ) αποδίδουν ιδιαίτερη σημασία στην προστασία της ιδιωτικότητας και των δεδομένων προσωπικού χαρακτήρα των επισκεπτών/χρηστών. Επισημαίνεται ότι ως δεδομένα προσωπικού χαρακτήρα νοούνται από την οικεία νομοθεσία  (Γενικός Κανονισμός Προστασίας Δεδομένων 2016/679/ΕΕ) μόνο εκείνες οι πληροφορίες που αφορούν ένα προσδιορισμένο ή – επί τη βάσει κάποιων χαρακτηριστικών – προσδιορίσιμο φυσικό πρόσωπο (υποκείμενο των δεδομένων). Πληροφορίες που αφορούν νομικά πρόσωπα και ομάδες προσώπων ή πληροφορίες στατιστικού χαρακτήρα, από τις οποίες δεν είναι δυνατή η αναγωγή σε προσδιορισμένο ή προσδιορίσιμο φυσικό πρόσωπο, δεν εμπίπτουν σε αυτήν την κατηγορία και εξαιρούνται από το πεδίο εφαρμογής της σχετικής νομοθεσίας.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>