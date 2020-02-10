<?php
// disable the admin bar
// show_admin_bar(false);

// Register 2 dynamic menus, one for the header, one for the footer
function register_my_menus()
{
  register_nav_menus(
    array(
      'main-menu' => __('Main Menu'),
      'footer-menu' => __('Footer Menu'),
      'social-menu' => __('Social Menu')
    )
  );
}
add_action('init', 'register_my_menus');

// Widget-Ready Sidebar

if (function_exists('register_sidebar'))
  register_sidebar(array(
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2 class="sidebar-title">',
    'after_title' => '</h2>',
  ));

// Custom Taxonomy "Utilities", for creating categories whose purpose is only for structural placement. This keeps content-categories separate from layout-catgeories

function create_my_taxonomies()
{
  register_taxonomy('utilities', 'post', array('hierarchical' => true, 'label' => 'Utilities'));
}
add_action('init', 'create_my_taxonomies', 0);

// Featured Images/Post Thumbnails
add_theme_support('post-thumbnails');
set_post_thumbnail_size(120, 120, true);
add_image_size('feat-bar-thumbnail', 160, 166, true); // feat bar size
add_image_size('feat-beer-thumbnail', 130, 130, true); // feat beer size

// Kill unwanted "head" stuff... include and exclude as necessary
remove_action('wp_head', 'rsd_link'); // kill the RSD link
remove_action('wp_head', 'wlwmanifest_link'); // kill the WLW link
remove_action('wp_head', 'index_rel_link'); // kill the index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // kill the prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // kill the start link
remove_action('wp_head', 'feed_links', 2); // kill post and comment feeds
remove_action('wp_head', 'feed_links_extra', 3); // kill category, author, and other extra feeds
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // kill adjacent post links
remove_action('wp_head', 'wp_generator'); // kill the wordpress version number

// Truncate functions
function truncate_it($length, $string)
{
  if (strlen(strip_tags($string)) < $length) {
    return strip_tags($string);
  }
  return substr(strip_tags($string), 0, $length) . '...';
}
function truncate_it_nostrip($LIMIT, $TEXT)
{
  $TAGS = 1;
  // TRIM TEXT
  $TEXT = trim(html_entity_decode($TEXT, ENT_QUOTES, 'UTF-8'));
  if (strlen($TEXT) < $LIMIT)
    return $TEXT;

  if ($TAGS == 0) {
    return substr($TEXT, 0, $LIMIT) . " ...";
  } else if (strlen(strip_tags($TEXT)) < $LIMIT) {
    return $TEXT;
  } else {
    $COUNTER = 0;
    for ($i = 0; $i <= strlen($TEXT); $i++) {

      if ($TEXT{
      $i} == "<") {
        $STOP = 1;
      }

      if ($STOP != 1) {
        $COUNTER++;
      }

      if ($TEXT{
      $i} == ">") $STOP = 0;
      $RETURN .= $TEXT{
      $i};

      if ($COUNTER >= $LIMIT) break;
    }
    return trim($RETURN) . "...";
  }
}

// Use WP to detect if device is iOS (iPhone/iPad). Adds ".ios" class to body for style control.
function detect_iphone($iphone)
{
  global $is_iphone;
  if ($is_iphone) $iphone[] = 'ios';
  return $iphone;
}

add_filter('body_class', 'detect_iphone');
add_filter('postmeta_form_limit', 'customfield_limit_increase');

function alpha_meta_box_add()
{
  // Add the 'Alphabetical beer list' meta box
  add_meta_box('alpha-beer-list', 'Beer List Properties', 'alpha_beer_list', 'ptf_bars', 'side', 'low');
}

function alpha_meta_box_add_to_events()
{
  // Add the 'Alphabetical beer list' meta box
  add_meta_box('alpha-beer-list', 'Beer List Properties', 'alpha_beer_list', 'ptf_events', 'side', 'low');
}

/**
 * Prints the box content.
 *
 * @param WP_Post $post The object for the current post/page.
 */
function alpha_beer_list($post)
{
  // Add a nonce field so we can check for it later.
  wp_nonce_field('ptf_beers_alpha_save_meta_box_data', 'ptf_beers_alpha_meta_box_nonce');
  /*
   * Use get_post_meta() to retrieve an existing value
   * from the database and use the value for the form.
   */
  $value = get_post_meta($post->ID, '_beers_alpha_order', true);

  echo '<label for="ptf_beers_alpha_order">';
  _e('Beers in Alphabetical Order', 'ptf_textdomain');
  echo '</label> ';

  if (esc_attr($value) == 'in_alpha') {
    echo '<input type="checkbox" style="margin-top: 2px; margin-left: 4px;" id="ptf_beers_alpha_order" name="ptf_beers_alpha_order" value="in_alpha" checked />';
  } else {
    echo '<input type="checkbox" style="margin-top: 2px; margin-left: 4px;" id="ptf_beers_alpha_order" name="ptf_beers_alpha_order" value="in_alpha" />';
  }
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function ptf_alpha_save_meta_box_data($post_id)
{

  /*
   * We need to verify this came from our screen and with proper authorization,
   * because the save_post action can be triggered at other times.
   */

  // Check if our nonce is set.
  if (!isset($_POST['ptf_beers_alpha_meta_box_nonce'])) {
    return;
  }

  // Verify that the nonce is valid.
  if (!wp_verify_nonce($_POST['ptf_beers_alpha_meta_box_nonce'], 'ptf_beers_alpha_save_meta_box_data')) {
    return;
  }

  // If this is an autosave, our form has not been submitted, so we don't want to do anything.
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return;
  }

  // Check the user's permissions.
  if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {

    if (!current_user_can('edit_page', $post_id)) {
      return;
    }
  } else {

    if (!current_user_can('edit_post', $post_id)) {
      return;
    }
  }

  if ( ! isset( $_POST['ptf_beers_alpha_order'] ) ) {
    return;
  }

  if ($_POST['ptf_beers_alpha_order'] == 'in_alpha') {
    update_post_meta($post_id, '_beers_alpha_order', 'in_alpha');
  } else {
    update_post_meta($post_id, '_beers_alpha_order', 'not_in_alpha');
  }
}

add_action('add_meta_boxes_ptf_bars', 'alpha_meta_box_add');
add_action('add_meta_boxes_ptf_events', 'alpha_meta_box_add_to_events');
add_action('save_post', 'ptf_alpha_save_meta_box_data');


//** Sort Beers by Alpha.
add_filter('acf/fields/relationship/query', 'sort_query_acf', 10, 3);
function sort_query_acf( $args ) {

    $args['orderby'] = 'title';
    $args['order'] = 'ASC';
	
    return $args;
    
}

// Update CSS within in Admin
add_action('admin_enqueue_scripts', 'admin_style');
function admin_style() {
  wp_enqueue_style('admin-styles', get_template_directory_uri().'/admin-acf.css');
}