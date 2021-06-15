<?php
// Disable Gutenberg
add_filter( 'use_block_editor_for_post', '__return_false' );

/**
 * Removes Gutenberg default styles on front-end
 */
add_action('wp_print_styles', function () {
  wp_dequeue_style('wp-block-library');
  wp_dequeue_style('wp-block-library-theme');
});

add_action( 'wp_footer', function () {
  wp_dequeue_script( 'wp-embed' );
});

// add custom theme css & js
add_filter('script_loader_tag', function ($tag, $handle){
  foreach (['async', 'defer'] as $attr) {
    if (!wp_scripts()->get_data($handle, $attr)) {
      continue;
    }
    // Prevent adding attribute when already added in #12009.
    if (!preg_match(":\s$attr(=|>|\s):", $tag)) {
        $tag = preg_replace(':(?=></script>):', " $attr", $tag, 1);
    }
    // Only allow async or defer, not both.
    break;
  }
  return $tag;
}, 10, 2);

add_action('wp_enqueue_scripts', function () {
  wp_enqueue_script(
    'mieteshop-assets',
    get_template_directory_uri() . '/dist/assets/main.js',
    ['jquery'],
    filemtime(get_template_directory() . '/dist/assets/main.js'),
    true
  );
  wp_script_add_data('mieteshop-assets', 'defer', true);

  $data = [
    'ajaxurl' => admin_url('admin-ajax.php'),
    'templateDirectoryUri' => get_template_directory_uri(),
  ];
  wp_localize_script('mieteshop-assets', 'MieteshopData', $data);

  wp_enqueue_style(
    'mieteshop-assets',
    get_template_directory_uri() . '/dist/assets/main.css',
    [],
    filemtime(get_template_directory() . '/dist/assets/main.css')
  );
});

include_once 'woo-functions.php';

include_once 'aq-resizer.php';

include_once 'custom-post-types/publisher.php';
include_once 'custom-post-types/contributor.php';