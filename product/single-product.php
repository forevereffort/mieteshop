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
                        <div class="single-product-form-col">ΜΟΡΦΗ</div>
                        <div class="single-product-form-value">Πανόδετο</div>
                        <div class="single-product-price-col">ΤΙΜΗ</div>
                        <div class="single-product-regular-price">15,50€</div>
                        <div class="single-product-sale-price">14,75€</div>
                        <div class="single-product-discount"><span>-30%</span></div>
                        <div class="single-product-availability">άμεσα διαθέσιμο</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>