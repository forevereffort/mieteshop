<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>
<?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		echo " | $site_description";
	}

	// Add a page number if necessary:
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		/* translators: %s: Page number. */
		echo esc_html( ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) ) );
	}

?>
</title>
<link rel="profile" href="https://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url' ) ); ?>">
<?php
	if ( is_singular() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_head();
?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<section class="pre-header">
	<div class="general-container">
		<div class="pre-header-row">
			<div class="pre-header-col">
				<div class="pre-header-item"><span class="pre-header-item-icon pre-header-item-icon--bus"><?php include get_template_directory() . '/assets/icons/bus-icon.svg' ?></span>Δωρεάν μεταφορικά από €40</div>
			</div>
			<div class="pre-header-col">
				<div class="pre-header-item"><span class="pre-header-item-icon pre-header-item-icon--calendar"><?php include get_template_directory() . '/assets/icons/calendar-icon.svg' ?></span>Αποστολή εντός 3 ημερών</div>
			</div>
			<div class="pre-header-col">
				<div class="pre-header-item"><a href="tel:+2103221335"><span class="pre-header-item-icon pre-header-item-icon--phone"><?php include get_template_directory() . '/assets/icons/phone-icon.svg' ?></span>210 3221335</a></div>
			</div>
			<div class="pre-header-col">
				<div class="pre-header-item"><span class="pre-header-item-icon pre-header-item-icon--store"><?php include get_template_directory() . '/assets/icons/store-icon.svg' ?></span>Τα βιβλιοπωλεία μας</div>
			</div>
			<div class="pre-header-col">
				<div class="pre-header-social-row">
					<div class="pre-header-social-col">
						<a href="<?php echo get_field('youtube_url', 'option'); ?>"><div class="pre-header-social-icon pre-header-social-icon--youtube"><?php include get_template_directory() . '/assets/icons/youtube-icon.svg' ?></div></a>
					</div>
					<div class="pre-header-social-col">
						<a href="<?php echo get_field('sound_cloude_url', 'option'); ?>"><div class="pre-header-social-icon pre-header-social-icon--sound-cloude"><?php include get_template_directory() . '/assets/icons/sound-cloude-icon.svg' ?></div></a>
					</div>
					<div class="pre-header-social-col">
						<a href="<?php echo get_field('facebook_url', 'option'); ?>"><div class="pre-header-social-icon pre-header-social-icon--facebook"><?php include get_template_directory() . '/assets/icons/facebook-icon.svg' ?></div></a>
					</div>
					<div class="pre-header-social-col">
						<a href="<?php echo get_field('instagram_url', 'option'); ?>"><div class="pre-header-social-icon pre-header-social-icon--instagram"><?php include get_template_directory() . '/assets/icons/instagram-icon.svg' ?></div></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<header class="site-header">
	<div class="header-top">
		<div class="container">
			<div class="header-top-row">
				<div class="header-top-left">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php include get_template_directory() . '/assets/icons/home-icon.svg' ?></a>
				</div>
				<div class="header-top-logo">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>">ΒΙΒΛΙΟΠΩΛΕΙΟ ΜΙΕΤ</a>
				</div>
				<div class="header-top-right">
					<div class="header-top-right-row">
						<div class="header-top-right-col">
							<div class="header-top-search-wrapper">
								<div id="js-header-top-search-icon" class="header-top-search-icon">
									<?php include get_template_directory() . '/assets/icons/search-icon.svg' ?>
								</div>
								<div id="js-header-top-search-popup" class="header-top-search-popup">
									<div class="header-top-search-form">
										<form action="">
											<input type="text" id="js-header-top-search-form-text" placeholder="λαϊκό" data-nonce="<?php echo wp_create_nonce('header_top_search_nonce'); ?>">
										</form>
									</div>
									<?php
										$image = wp_get_attachment_image_src( get_post_thumbnail_id( 3401 ), 'full' );
									?>
									<div class="header-top-search-result-group-list">
										<div class="header-top-search-result-group">
											<div class="header-top-search-result-group-title">
												<h3>ΒΙΒΛΙΑ</h3>
											</div>
											<div class="header-top-search-result-item">
												<div class="header-top-search-result-item-row">
													<div class="header-top-search-result-item-left-col">
														<div class="header-top-search-result-item-image">
															<img
																class="lazyload"
																src="<?php echo placeholderImage($image[1], $image[2]); ?>"
																data-src="<?php echo aq_resize($image[0], $image[1], $image[2], true); ?>"
																alt="product-image">
														</div>
													</div>
													<div class="header-top-search-result-item-right-col">
														<div class="header-top-search-result-item-info">
															<div class="header-top-search-result-item-info-author">Δημήτριος Ι. Ζέπος</div>
															<div class="header-top-search-result-item-info-title">
																<h4>Λαϊκή Δικαιοσύνη. Εις τας ελευθέρας περιοχάς της υπό κατοχήν Ελλάδος</h4>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="header-top-search-result-item">
												<div class="header-top-search-result-item-row">
													<div class="header-top-search-result-item-left-col">
														<div class="header-top-search-result-item-image">
															<img
																class="lazyload"
																src="<?php echo placeholderImage($image[1], $image[2]); ?>"
																data-src="<?php echo aq_resize($image[0], $image[1], $image[2], true); ?>"
																alt="product-image">
														</div>
													</div>
													<div class="header-top-search-result-item-right-col">
														<div class="header-top-search-result-item-info">
															<div class="header-top-search-result-item-info-author">Ι. Θ. Κακριδής</div>
															<div class="header-top-search-result-item-info-title">
																<h4>Οι αρχαίοι Έλληνες στη νεοελληνική λαϊκή παράδοση</h4>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="header-top-search-result-item">
												<div class="header-top-search-result-item-row">
													<div class="header-top-search-result-item-left-col">
														<div class="header-top-search-result-item-image">
															<img
																class="lazyload"
																src="<?php echo placeholderImage($image[1], $image[2]); ?>"
																data-src="<?php echo aq_resize($image[0], $image[1], $image[2], true); ?>"
																alt="product-image">
														</div>
													</div>
													<div class="header-top-search-result-item-right-col">
														<div class="header-top-search-result-item-info">
															<div class="header-top-search-result-item-info-author">Σοφία Παλαμιώτη</div>
															<div class="header-top-search-result-item-info-title">
																<h4>Λαϊκές βιβλιοθήκες. Οδηγός για την οργάνωσή τους</h4>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="header-top-search-result-item">
												<div class="header-top-search-result-item-row">
													<div class="header-top-search-result-item-left-col">
														<div class="header-top-search-result-item-image">
															<img
																class="lazyload"
																src="<?php echo placeholderImage($image[1], $image[2]); ?>"
																data-src="<?php echo aq_resize($image[0], $image[1], $image[2], true); ?>"
																alt="product-image">
														</div>
													</div>
													<div class="header-top-search-result-item-right-col">
														<div class="header-top-search-result-item-info">
															<div class="header-top-search-result-item-info-author">Παναγιώτης Ζωγράφος</div>
															<div class="header-top-search-result-item-info-title">
																<h4>Στοχασμός Μακρυγιάννη. Χειρ Παναγιώτη Ζωγράφου. Εικονογραφία του Εικοσιένα</h4>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="header-top-search-result-link">
												<a href="#">Όλα  τα σχετικά προϊόντα</a>
											</div>
										</div>
										<div class="header-top-search-result-group">
											<div class="header-top-search-result-group-title">
												<h3>ΜΟΥΣΙΚΗ</h3>
											</div>
											<div class="header-top-search-result-item">
												<div class="header-top-search-result-item-row">
													<div class="header-top-search-result-item-left-col">
														<div class="header-top-search-result-item-image">
															<img
																class="lazyload"
																src="<?php echo placeholderImage($image[1], $image[2]); ?>"
																data-src="<?php echo aq_resize($image[0], $image[1], $image[2], true); ?>"
																alt="product-image">
														</div>
													</div>
													<div class="header-top-search-result-item-right-col">
														<div class="header-top-search-result-item-info">
															<div class="header-top-search-result-item-info-author">Χριστίνα Μαξούρη</div>
															<div class="header-top-search-result-item-info-title">
																<h4>20 + 1 Λαϊκά Μεταπολεμικά Τραγούδια με Μπαρόκ Σύνολο</h4>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="header-top-search-result-group">
											<div class="header-top-search-result-group-title">
												<h3>ΑΝΤΙΚΕΙΜΕΝΑ</h3>
											</div>
											<div class="header-top-search-result-item">
												<div class="header-top-search-result-item-row">
													<div class="header-top-search-result-item-left-col">
														<div class="header-top-search-result-item-image">
															<img
																class="lazyload"
																src="<?php echo placeholderImage($image[1], $image[2]); ?>"
																data-src="<?php echo aq_resize($image[0], $image[1], $image[2], true); ?>"
																alt="product-image">
														</div>
													</div>
													<div class="header-top-search-result-item-right-col">
														<div class="header-top-search-result-item-info">
															<div class="header-top-search-result-item-info-author">Φρέντυ Κάραμποτ</div>
															<div class="header-top-search-result-item-info-title">
																<h4>Γεύση Έρωτα</h4>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="header-top-search-result-item">
												<div class="header-top-search-result-item-row">
													<div class="header-top-search-result-item-left-col">
														<div class="header-top-search-result-item-image">
															<img
																class="lazyload"
																src="<?php echo placeholderImage($image[1], $image[2]); ?>"
																data-src="<?php echo aq_resize($image[0], $image[1], $image[2], true); ?>"
																alt="product-image">
														</div>
													</div>
													<div class="header-top-search-result-item-right-col">
														<div class="header-top-search-result-item-info">
															<div class="header-top-search-result-item-info-author">Γκαρδιάκος</div>
															<div class="header-top-search-result-item-info-title">
																<h4>Ο Δοσίλογος</h4>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="header-top-search-result-item">
												<div class="header-top-search-result-item-row">
													<div class="header-top-search-result-item-left-col">
														<div class="header-top-search-result-item-image">
															<img
																class="lazyload"
																src="<?php echo placeholderImage($image[1], $image[2]); ?>"
																data-src="<?php echo aq_resize($image[0], $image[1], $image[2], true); ?>"
																alt="product-image">
														</div>
													</div>
													<div class="header-top-search-result-item-right-col">
														<div class="header-top-search-result-item-info">
															<div class="header-top-search-result-item-info-author">Ηνωμένοι Καλλιτέχναι</div>
															<div class="header-top-search-result-item-info-title">
																<h4>Πικρό ψωμί</h4>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="header-top-search-result-item">
												<div class="header-top-search-result-item-row">
													<div class="header-top-search-result-item-left-col">
														<div class="header-top-search-result-item-image">
															<img
																class="lazyload"
																src="<?php echo placeholderImage($image[1], $image[2]); ?>"
																data-src="<?php echo aq_resize($image[0], $image[1], $image[2], true); ?>"
																alt="product-image">
														</div>
													</div>
													<div class="header-top-search-result-item-right-col">
														<div class="header-top-search-result-item-info">
															<div class="header-top-search-result-item-info-author">Χρήστος Βλαντίκας</div>
															<div class="header-top-search-result-item-info-title">
																<h4>Νέα μεταμφιεσμένη</h4>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="header-top-search-result-link">
												<a href="#">Όλα  τα Σχετικά προΙόντα</a>
											</div>
										</div>
									</div>
									<div class="header-top-search-button">
										<a href="#">όλα τα αποτελέσματα</a>
									</div>
								</div>
							</div>
						</div>
						<div class="header-top-right-col">
							<div class="header-top-search-wrapper">
								<div id="js-header-top-favorite-icon" class="header-top-search-icon">
									<?php include get_template_directory() . '/assets/icons/favorite-icon.svg' ?>
								</div>
								<div id="js-header-top-favorite-popup" class="header-top-search-popup header-top-search-popup--favorite">
									<div class="header-top-search-result-group-list">
										<div class="header-top-search-result-group header-top-search-result-group--favorite">
											<div class="header-top-search-result-group-title">
												<h3>ΑΓΑΠΗΜΕΝΑ</h3>
											</div>
											<div class="header-top-search-result-item">
												<div class="header-top-search-result-item-row">
													<div class="header-top-search-result-item-left-col">
														<div class="header-top-search-result-item-image">
															<img
																class="lazyload"
																src="<?php echo placeholderImage($image[1], $image[2]); ?>"
																data-src="<?php echo aq_resize($image[0], $image[1], $image[2], true); ?>"
																alt="product-image">
														</div>
													</div>
													<div class="header-top-search-result-item-right-col">
														<div class="header-top-search-result-item-info">
															<div class="header-top-search-result-item-info-author">Δημήτριος Ι. Ζέπος</div>
															<div class="header-top-search-result-item-info-title">
																<h4>Λαϊκή Δικαιοσύνη. Εις τας ελευθέρας περιοχάς της υπό κατοχήν Ελλάδος</h4>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="header-top-search-result-item">
												<div class="header-top-search-result-item-row">
													<div class="header-top-search-result-item-left-col">
														<div class="header-top-search-result-item-image">
															<img
																class="lazyload"
																src="<?php echo placeholderImage($image[1], $image[2]); ?>"
																data-src="<?php echo aq_resize($image[0], $image[1], $image[2], true); ?>"
																alt="product-image">
														</div>
													</div>
													<div class="header-top-search-result-item-right-col">
														<div class="header-top-search-result-item-info">
															<div class="header-top-search-result-item-info-author">Ι. Θ. Κακριδής</div>
															<div class="header-top-search-result-item-info-title">
																<h4>Οι αρχαίοι Έλληνες στη νεοελληνική λαϊκή παράδοση</h4>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="header-top-search-result-item">
												<div class="header-top-search-result-item-row">
													<div class="header-top-search-result-item-left-col">
														<div class="header-top-search-result-item-image">
															<img
																class="lazyload"
																src="<?php echo placeholderImage($image[1], $image[2]); ?>"
																data-src="<?php echo aq_resize($image[0], $image[1], $image[2], true); ?>"
																alt="product-image">
														</div>
													</div>
													<div class="header-top-search-result-item-right-col">
														<div class="header-top-search-result-item-info">
															<div class="header-top-search-result-item-info-author">Σοφία Παλαμιώτη</div>
															<div class="header-top-search-result-item-info-title">
																<h4>Λαϊκές βιβλιοθήκες. Οδηγός για την οργάνωσή τους</h4>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="header-top-search-result-item">
												<div class="header-top-search-result-item-row">
													<div class="header-top-search-result-item-left-col">
														<div class="header-top-search-result-item-image">
															<img
																class="lazyload"
																src="<?php echo placeholderImage($image[1], $image[2]); ?>"
																data-src="<?php echo aq_resize($image[0], $image[1], $image[2], true); ?>"
																alt="product-image">
														</div>
													</div>
													<div class="header-top-search-result-item-right-col">
														<div class="header-top-search-result-item-info">
															<div class="header-top-search-result-item-info-author">Παναγιώτης Ζωγράφος</div>
															<div class="header-top-search-result-item-info-title">
																<h4>Στοχασμός Μακρυγιάννη. Χειρ Παναγιώτη Ζωγράφου. Εικονογραφία του Εικοσιένα</h4>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="header-top-search-button">
										<a href="#">όλα τα αποτελέσματα</a>
									</div>
								</div>
							</div>
						</div>
						<div class="header-top-right-col">
							<div class="header-top-search-wrapper">
								<div id="js-header-top-user-icon" class="header-top-search-icon">
									<?php include get_template_directory() . '/assets/icons/user-icon.svg' ?>
								</div>
								<div id="js-header-top-user-popup" class="header-top-search-popup header-top-search-popup--user">
									<div class="header-top-search-result-menu">
										<div class="header-top-search-result-menu-title">
											<h3>ΛΟΓΑΡΙΑΣΜΟΣ</h3>
										</div>
										<div class="header-top-search-result-menu-list">
											<ul>
												<li><a href="#">Ο λογαριασμός μου</a></li>
												<li><a href="#">Ιστορικό αγορών</a></li>
												<li><a href="#">Ρυθμίσεις</a></li>
												<li><a href="#">Έξοδος / Log out</a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="header-top-right-col">
							<div class="header-top-search-wrapper">
								<div id="js-header-top-busket-icon" class="header-top-search-icon">
									<?php include get_template_directory() . '/assets/icons/busket-icon.svg' ?>
								</div>
								<div id="js-header-top-busket-popup" class="header-top-search-popup header-top-search-popup--busket">
									<div class="header-top-search-result-group-list">
										<div class="header-top-search-result-group header-top-search-result-group--busket">
											<div class="header-top-search-result-group-title">
												<h3>ΚΑΛΑΘΙ ΑΓΟΡΩΝ</h3>
											</div>
											<div class="header-top-search-result-item">
												<div class="header-top-search-result-item-row">
													<div class="header-top-search-result-item-left-col">
														<div class="header-top-search-result-item-image">
															<img
																class="lazyload"
																src="<?php echo placeholderImage($image[1], $image[2]); ?>"
																data-src="<?php echo aq_resize($image[0], $image[1], $image[2], true); ?>"
																alt="product-image">
														</div>
													</div>
													<div class="header-top-search-result-item-right-col">
														<div class="header-top-search-result-item-info-row">
															<div class="header-top-search-result-item-info-left-col">
																<div class="header-top-search-result-item-info-author">Δημήτριος Ι. Ζέπος</div>
																<div class="header-top-search-result-item-info-title">
																	<h4>Λαϊκή Δικαιοσύνη. Εις τας ελευθέρας περιοχάς της υπό κατοχήν Ελλάδος</h4>
																</div>
															</div>
															<div class="header-top-search-result-item-info-right-col">
																<div>
																	<span class="header-top-search-result-item-info-count">1x</span>
																	<span class="header-top-search-result-item-info-price">€14,50</span>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="header-top-search-result-item">
												<div class="header-top-search-result-item-row">
													<div class="header-top-search-result-item-left-col">
														<div class="header-top-search-result-item-image">
															<img
																class="lazyload"
																src="<?php echo placeholderImage($image[1], $image[2]); ?>"
																data-src="<?php echo aq_resize($image[0], $image[1], $image[2], true); ?>"
																alt="product-image">
														</div>
													</div>
													<div class="header-top-search-result-item-right-col">
														<div class="header-top-search-result-item-info-row">
															<div class="header-top-search-result-item-info-left-col">
																<div class="header-top-search-result-item-info-author">Ι. Θ. Κακριδής</div>
																<div class="header-top-search-result-item-info-title">
																	<h4>Οι αρχαίοι Έλληνες στη νεοελληνική λαϊκή παράδοση</h4>
																</div>
															</div>
															<div class="header-top-search-result-item-info-right-col">
																<div>
																	<span class="header-top-search-result-item-info-count">2x</span>
																	<span class="header-top-search-result-item-info-price">€9,50</span>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="header-top-search-result-item">
												<div class="header-top-search-result-item-row">
													<div class="header-top-search-result-item-left-col">
														<div class="header-top-search-result-item-image">
															<img
																class="lazyload"
																src="<?php echo placeholderImage($image[1], $image[2]); ?>"
																data-src="<?php echo aq_resize($image[0], $image[1], $image[2], true); ?>"
																alt="product-image">
														</div>
													</div>
													<div class="header-top-search-result-item-right-col">
														<div class="header-top-search-result-item-info-row">
															<div class="header-top-search-result-item-info-left-col">
																<div class="header-top-search-result-item-info-author">Σοφία Παλαμιώτη</div>
																<div class="header-top-search-result-item-info-title">
																	<h4>Λαϊκές βιβλιοθήκες. Οδηγός για την οργάνωσή τους</h4>
																</div>
															</div>
															<div class="header-top-search-result-item-info-right-col">
																<div>
																	<span class="header-top-search-result-item-info-count">1x</span>
																	<span class="header-top-search-result-item-info-price">€18,50</span>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="header-top-search-result-item">
												<div class="header-top-search-result-item-row">
													<div class="header-top-search-result-item-left-col">
														<div class="header-top-search-result-item-image">
															<img
																class="lazyload"
																src="<?php echo placeholderImage($image[1], $image[2]); ?>"
																data-src="<?php echo aq_resize($image[0], $image[1], $image[2], true); ?>"
																alt="product-image">
														</div>
													</div>
													<div class="header-top-search-result-item-right-col">
														<div class="header-top-search-result-item-info-row">
															<div class="header-top-search-result-item-info-left-col">
																<div class="header-top-search-result-item-info-author">Παναγιώτης Ζωγράφος</div>
																<div class="header-top-search-result-item-info-title">
																	<h4>Στοχασμός Μακρυγιάννη. Χειρ Παναγιώτη Ζωγράφου. Εικονογραφία του Εικοσιένα</h4>
																</div>
															</div>
															<div class="header-top-search-result-item-info-right-col">
																<div>
																	<span class="header-top-search-result-item-info-count">1x</span>
																	<span class="header-top-search-result-item-info-price">€13,50</span>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="header-top-search-result-item">
												<div class="header-top-search-result-item-row">
													<div class="header-top-search-result-item-left-col">
														<div class="header-top-search-result-item-image">
															<img
																class="lazyload"
																src="<?php echo placeholderImage($image[1], $image[2]); ?>"
																data-src="<?php echo aq_resize($image[0], $image[1], $image[2], true); ?>"
																alt="product-image">
														</div>
													</div>
													<div class="header-top-search-result-item-right-col">
														<div class="header-top-search-result-item-info-row">
															<div class="header-top-search-result-item-info-left-col">
																<div class="header-top-search-result-item-info-author">Χριστίνα Μαξούρη</div>
																<div class="header-top-search-result-item-info-title">
																	<h4>20 + 1 Λαϊκά Μεταπολεμικά Τραγούδια με Μπαρόκ Σύνολο</h4>
																</div>
															</div>
															<div class="header-top-search-result-item-info-right-col">
																<div>
																	<span class="header-top-search-result-item-info-count">1x</span>
																	<span class="header-top-search-result-item-info-price">€32,50</span>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="header-top-search-result-item">
												<div class="header-top-search-result-item-row">
													<div class="header-top-search-result-item-left-col">
														<div class="header-top-search-result-item-image">
															<img
																class="lazyload"
																src="<?php echo placeholderImage($image[1], $image[2]); ?>"
																data-src="<?php echo aq_resize($image[0], $image[1], $image[2], true); ?>"
																alt="product-image">
														</div>
													</div>
													<div class="header-top-search-result-item-right-col">
														<div class="header-top-search-result-item-info-row">
															<div class="header-top-search-result-item-info-left-col">
																<div class="header-top-search-result-item-info-author">Φρέντυ Κάραμποτ</div>
																<div class="header-top-search-result-item-info-title">
																	<h4>Γεύση  Έρωτα</h4>
																</div>
															</div>
															<div class="header-top-search-result-item-info-right-col">
																<div>
																	<span class="header-top-search-result-item-info-count">1x</span>
																	<span class="header-top-search-result-item-info-price">€14,50</span>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="header-top-search-result-item">
												<div class="header-top-search-result-item-row">
													<div class="header-top-search-result-item-left-col">
														<div class="header-top-search-result-item-image">
															<img
																class="lazyload"
																src="<?php echo placeholderImage($image[1], $image[2]); ?>"
																data-src="<?php echo aq_resize($image[0], $image[1], $image[2], true); ?>"
																alt="product-image">
														</div>
													</div>
													<div class="header-top-search-result-item-right-col">
														<div class="header-top-search-result-item-info-row">
															<div class="header-top-search-result-item-info-left-col">
																<div class="header-top-search-result-item-info-author">Γκαρδιάκος</div>
																<div class="header-top-search-result-item-info-title">
																	<h4>Ο Δοσίλογος</h4>
																</div>
															</div>
															<div class="header-top-search-result-item-info-right-col">
																<div>
																	<span class="header-top-search-result-item-info-count">1x</span>
																	<span class="header-top-search-result-item-info-price">€11,00</span>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="header-top-search-result-total-price">
										<div class="header-top-search-result-total-price-row">
											<div class="header-top-search-result-total-price-left-col">
												<span>Σύνολο</span>
											</div>
											<div class="header-top-search-result-total-price-right-col">
												<span>€123,50</span>
											</div>
										</div>
									</div>
									<div class="header-top-search-button">
										<a href="#">Δείτε το καλάθι σας</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<nav class="header-nav">
		<div class="container">
			<?php
				$locations = get_nav_menu_locations();
				$header_menu_array = wp_get_menu_array($locations['header_menu']);
			?>
			<div class="header-nav-row">
				<?php
					foreach( $header_menu_array as $menu ){
				?>
						<div class="header-nav-col <?php echo $menu['has_child'] ? 'header-nav-col--has-child' : ''; ?>">
							<a href="<?php echo $menu['url'] ?>" class="<?php echo $menu['has_child'] ? 'js-header-nav-parent-menu' : 'js-header-nav-menu'; ?> <?php echo $menu['class']; ?>" data-menu-id="<?php echo $menu['ID']; ?>">
								<?php echo $menu['title']; ?>
								<?php
									if( $menu['has_child'] ){
										echo '<span class="header-nav-arrow">';
										include get_template_directory() . '/assets/icons/arrow-down-icon.svg';
										echo '</span>';
									}
								?>
							</a>
						</div>
				<?php
					}
				?>
				<?php
					foreach( $header_menu_array as $menu ){
						if( $menu['has_child'] && get_field('sub_menu_row', $menu['ID']) ){
				?>
							<div id="header-sub-menu-<?php echo $menu['ID']; ?>" class="header-sub-menu">
								<div class="header-sub-menu-inner">
									<div class="header-sub-menu-row">
										<?php
											foreach( $menu['children'] as $sub_menu_wrapper ){
												if( get_field('sub_menu_col', $sub_menu_wrapper['ID']) ){
										?>
													<div class="header-sub-menu-col">
														<?php
															foreach( $sub_menu_wrapper['children'] as $sub_menu ){
														?>
																<div class="header-sub-menu-item">
																	<a href="<?php echo $sub_menu['url'] ?>" class="<?php echo $sub_menu['class']; ?>"><?php echo $sub_menu['title']; ?></a>
																	<?php
																		if( $sub_menu['has_child'] ){
																	?>
																			<div class="header-sub-sub-menu">
																				<?php
																					foreach( $sub_menu['children'] as $sub_sub_menu ){
																				?>
																						<div class="header-sub-sub-menu-col">
																							<a href="<?php echo $sub_sub_menu['url']; ?>" class="<?php echo $sub_sub_menu['class']; ?>"><?php echo $sub_sub_menu['title']; ?></a>
																						</div>
																				<?php
																					}
																				?>
																			</div>
																	<?php
																		}
																	?>
																</div>
														<?php
															}
														?>
													</div>
										<?php
												}
											}
										?>
									</div>
									<div class="header-sub-menu-footer">
										<?php
											$link_1 = get_field('link_1', $menu['ID']);
											$link_2 = get_field('link_2', $menu['ID']);
											$link_3 = get_field('link_3', $menu['ID']);
										?>
										<div class="header-sub-menu-footer-left">
											<div class="header-sub-menu-footer-left-col">
												<a href="<?php echo $link_1['url']; ?>"><?php echo $link_1['title']; ?></a>
											</div>
											<div class="header-sub-menu-footer-left-col">
												<a href="<?php echo $link_2['url']; ?>"><?php echo $link_2['title']; ?></a>
											</div>
										</div>
										<div class="header-sub-menu-footer-right">
											<a href="<?php echo $link_3['url']; ?>"><?php echo $link_3['title']; ?></a>
										</div>
									</div>
								</div>
							</div>
				<?php
						}
					}
				?>
			</div>
		</div>
	</nav>
</header>