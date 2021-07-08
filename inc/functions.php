<?php
// Disable Gutenberg
// add_filter( 'use_block_editor_for_post_type', '__return_false' );

add_filter( 'jetpack_sharing_counts', '__return_false', 99 );
add_filter( 'jetpack_implode_frontend_css', '__return_false', 99 );

add_filter('use_block_editor_for_post_type', 'prefix_disable_gutenberg', 10, 2);
function prefix_disable_gutenberg($current_status, $post_type){
  // Use your post type key instead of 'product'
  if ($post_type === 'post') return $current_status;
  
  return false;
}

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

function populate_children($menu_array, $menu_item){
  $children = [];
  $cpi = get_queried_object_id();

  if (!empty($menu_array)){
    foreach ($menu_array as $k=>$m) {
      if ($m->menu_item_parent == $menu_item->ID) {
        $children[$m->ID] = [
          'ID' => $m->ID,
          'title' => $m->title,
          'url' => $m->url,
          'class' => $cpi == $m->object_id ? 'active' : '',
          'children' => populate_children($menu_array, $m)
        ];

        $children[$m->ID]['has_child'] = !empty($children[$m->ID]['children']);

        unset($menu_array[$k]);
      }
    }
  };

  return $children;
}

function wp_get_menu_array($current_menu) {
  $menu_array = wp_get_nav_menu_items($current_menu);

  $cpi = get_queried_object_id();

  foreach ($menu_array as $m) {
    if (empty($m->menu_item_parent)) {
      $menu[$m->ID] = [
        'ID' => $m->ID,
        'title' => $m->title,
        'url' => $m->url,
        'class' => $cpi == $m->object_id ? 'active' : '',
        'children' => populate_children($menu_array, $m)
      ];

      $menu[$m->ID]['has_child'] = !empty($menu[$m->ID]['children']);
    }
  }

  return $menu;
}

// add options page
if( function_exists('acf_add_options_page') ) {
  
  acf_add_options_page(array(
    'page_title' 	=> 'Global Options',
    'menu_title'	=> 'Global Options',
    'menu_slug' 	=> 'global-options'
  ));	
}

include_once 'woo-functions.php';

include_once 'aq-resizer.php';

include_once 'custom-post-types/publisher.php';
include_once 'custom-post-types/contributor.php';

include_once 'page-functions/category-product-function.php';
include_once 'page-functions/header-top-search-function.php';
include_once 'page-functions/search-book-function.php';
include_once 'page-functions/search-art-object-function.php';

require_once dirname(dirname(__FILE__)) . '/vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader(dirname(dirname(__FILE__)) . '/twig-templates');
global $twig;
$twig = new \Twig\Environment($loader);

/* custom track product cookie for woocommerce_recently_viewed */
function custom_track_product_view() {
  if ( ! is_singular( 'product' ) ) {
      return;
  }

  global $post;

  if ( empty( $_COOKIE['woocommerce_recently_viewed'] ) )
      $viewed_products = array();
  else
      $viewed_products = (array) explode( '|', $_COOKIE['woocommerce_recently_viewed'] );

  if ( ! in_array( $post->ID, $viewed_products ) ) {
      $viewed_products[] = $post->ID;
  }

  if ( sizeof( $viewed_products ) > 15 ) {
      array_shift( $viewed_products );
  }

  // Store for session only
  wc_setcookie( 'woocommerce_recently_viewed', implode( '|', $viewed_products ) );
}
add_action( 'template_redirect', 'custom_track_product_view', 20 );

/* change availability text */
add_filter( 'woocommerce_get_availability', 'pro_custom_get_availability', 1, 2);
function pro_custom_get_availability( $availability, $_product ) {
    // Change In Stock Text
    if ( $_product->is_in_stock() ) {
        $availability['availability'] = __('Άμεσα διαθέσιμο', 'woocommerce');
    }
    // Change Out of Stock Text
    if ( ! $_product->is_in_stock() ) {
        $availability['availability'] = __('Προσωρινά μη διαθέσιμο', 'woocommerce');
    }
    return $availability;
}

function display_percentage_discount($postid) {
  $regular_price = get_post_meta( $postid, '_regular_price', true);
  $sale_price = get_post_meta( $postid, '_sale_price', true);
  if($sale_price) {
    $saving_percentage = round( 100 - ( $sale_price  / $regular_price * 100 ), 1 ) . '%';
    $percentage_discount = '<div class="pcat-result-item-footer-product-discount">'.$saving_percentage.'</div>'; 
  }  else {
    $percentage_discount = '';
  } 
  return $percentage_discount;
}

function show_books($args) {

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
                      <a href="<?php echo get_permalink($product->get_id()); ?>">
                      <img
                          class="lazyload"
                          src="<?php echo placeholderImage($image[1], $image[2]); ?>"
                          data-src="<?php echo aq_resize($image[0], $image[1], $image[2], true); ?>"
                          alt="<?php echo $product->get_name(); ?>">
                       </a>   
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
                  <div class="pcat-result-item-title"><h3<a href="<?php echo get_permalink($product->get_id()); ?>"><?php echo $product->get_name(); ?></h3></a></div>
              </div>
              <div class="pcat-result-item-footer-row">
                  <div class="pcat-result-item-footer-col">
                      <div class="pcat-result-item-footer-product-price">
                          <?php echo $product->get_price_html(); ?>
                      </div>
                  </div>
                  <div class="pcat-result-item-footer-col">
                      <?php echo display_percentage_discount( $product->get_id() ); ?>
                  </div>
              </div>
          </div>
      </div>
<?php
  }
  wp_reset_query();  

}