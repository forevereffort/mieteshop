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
	<div class="pre-header-row">
		<div class="pre-header-col">
			<div class="pre-header-item"><span class="pre-header-item-icon pre-header-item-icon--bus"><?php include get_template_directory() . '/assets/icons/bus-icon.svg' ?></span>Δωρεάν μεταφορικά από €40</div>
		</div>
		<div class="pre-header-col">
			<div class="pre-header-item"><span class="pre-header-item-icon pre-header-item-icon--calendar"><?php include get_template_directory() . '/assets/icons/calendar-icon.svg' ?></span>Αποστολή εντός 3 ημερών</div>
		</div>
		<div class="pre-header-col">
			<div class="pre-header-item"><span class="pre-header-item-icon pre-header-item-icon--phone"><?php include get_template_directory() . '/assets/icons/phone-icon.svg' ?></span>210 3221335</div>
		</div>
		<div class="pre-header-col">
			<div class="pre-header-item"><span class="pre-header-item-icon pre-header-item-icon--store"><?php include get_template_directory() . '/assets/icons/store-icon.svg' ?></span>Τα βιβλιοπωλεία μας</div>
		</div>
		<div class="pre-header-col">
			<div class="pre-header-social-row">
				<div class="pre-header-social-col">
					<a href="#"><div class="pre-header-social-icon pre-header-social-icon--youtube"><?php include get_template_directory() . '/assets/icons/youtube-icon.svg' ?></div></a>
				</div>
				<div class="pre-header-social-col">
					<a href="#"><div class="pre-header-social-icon pre-header-social-icon--sound-cloude"><?php include get_template_directory() . '/assets/icons/sound-cloude-icon.svg' ?></div></a>
				</div>
				<div class="pre-header-social-col">
					<a href="#"><div class="pre-header-social-icon pre-header-social-icon--facebook"><?php include get_template_directory() . '/assets/icons/facebook-icon.svg' ?></div></a>
				</div>
				<div class="pre-header-social-col">
					<a href="#"><div class="pre-header-social-icon pre-header-social-icon--instagram"><?php include get_template_directory() . '/assets/icons/instagram-icon.svg' ?></div></a>
				</div>
			</div>
		</div>
	</div>
</section>
<header>
	<div class="header-top">
		<div class="container">
			<a href="#">ΒΙΒΛΙΟΠΩΛΕΙΟ ΜΙΕΤ</a>
		</div>
	</div>
	<div class="container">
		<?php
			wp_nav_menu([
				'theme_location' => 'header_menu',
				'container_class' => 'header-menu-wrapper',
				'container' => 'nav',
				'menu_id' => 'header-menu',
				'menu_class' => '',
			]);
		?>
	</div>
</header>