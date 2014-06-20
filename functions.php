<?php
include('php/custom_widgets.php');
include('php/locations.php');
include('php/write_panels.php');
include('php/acf-fields.php');

function cust_add_scripts() {
  wp_enqueue_style('mapbox-styles', 'http' . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . '://api.tiles.mapbox.com/mapbox.js/v1.6.2/mapbox.css', false, null);
  wp_enqueue_style('fonts', 'http' . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . '://fonts.googleapis.com/css?family=Montserrat:400,700', false, '1.0');
  wp_enqueue_style('custom', get_stylesheet_uri(), false, '1.201');

  wp_register_script('mapbox', 'http' . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . '://api.tiles.mapbox.com/mapbox.js/v1.6.2/mapbox.js', false, null, false);
  wp_enqueue_script('mapbox');
  wp_deregister_script('jquery');
  wp_register_script('jquery', 'http' . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . '://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js', false, null, true);
  wp_enqueue_script('jquery');
  wp_register_script('modernizr', get_template_directory_uri().'/javascripts/libs/modernizr.js', false, null, false);
  wp_enqueue_script('modernizr');
  wp_register_script('respond', get_template_directory_uri().'/javascripts/libs/respond.min.js', false, null, false);
  wp_enqueue_script('respond');

  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }

  wp_register_script('timeago', get_template_directory_uri().'/javascripts/libs/timeago.js', array('jquery'), null, true);
  wp_enqueue_script('timeago');
  wp_register_script('md5', get_template_directory_uri().'/javascripts/libs/md5.js', array('jquery'), null, true);
  wp_enqueue_script('md5');
  wp_register_script('fitvids', get_template_directory_uri().'/javascripts/libs/jquery.fitvids.js', array('jquery'), null, true);
  wp_enqueue_script('fitvids');
  wp_register_script('tooltip', get_template_directory_uri().'/javascripts/libs/tiptip.js', array('jquery'), null, true);
  wp_enqueue_script('tooltip');
  wp_register_script('form-validator', get_template_directory_uri().'/javascripts/libs/jquery.validate.min.js', array('jquery'), null, true);
  wp_enqueue_script('form-validator');
  wp_register_script('all', get_template_directory_uri().'/javascripts/all.js', array('jquery'), '1.201', true);
  wp_enqueue_script('all');
}
add_action( 'wp_enqueue_scripts', 'cust_add_scripts' );


  /*
   * Switch default core markup for search form, comment form, and comments
   * to output valid HTML5.
   */
  add_theme_support( 'html5', array(
    'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
  ) );

// custom header image/logo support:
$args = array(
  'flex-width'    => true,
  'width'         => 204,
  'flex-height'   => true,
  'height'        => 37,
  'default-image' => get_template_directory_uri() . '/images/logo.png',
  'header-text'   => false,
  'uploads'       => true
);
add_theme_support('custom-header', $args);

// thumbnail sizes.
if( function_exists( 'add_theme_support' ) ) :
  add_theme_support( 'post-thumbnails', array( 'post', 'page', 'event', 'challenge', 'project' ) );
  set_post_thumbnail_size( 218, 140, true );
  add_image_size( 'excerpt-thumb', 648, 260, true );
  add_image_size( 'banner', 1400, 350, true );
  add_image_size( 'large-avatar', 304, 200, true );
  add_image_size( 'logo', 160, 160, false );
endif;

// set up nav menus
add_action( 'init', 'add_menus' );
function add_menus() {
  if( function_exists( 'register_nav_menus' ) ) :
    register_nav_menus( array(
      'main-menu' => 'Main Menu',
      'second-menu' => 'Secondary Menu',
      'footer-menu' => 'Footer Menu'
    ) );
  endif;
}

//change active nav class
add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1);
add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1);
function my_css_attributes_filter($var) {
  if(is_array($var)){
    $intersect= array_intersect($var, array('current-menu-item'));
    $curr = array('current-menu-item');
    $new   = array('active');
    $updated = array();
    $updated = str_replace($curr, $new, $intersect);
  }
  else{
    $updated= '';
  }
return $updated;
}

// register one or more sidebar areas
if (function_exists('register_sidebar')) {
  register_sidebar( array(
    'name' => 'Blog Sidebar',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>'
  ));
  register_sidebar( array(
    'name' => 'Secondary Header Area',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>'
  ));
}

//change auto excerpt cut-off text
function new_excerpt_more($more) {
  global $post;
  return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

// modified from http://pastebin.com/aUZuQrZy snippet for different excerpt lengths
// this uses the post content regardless of custom excerpt
/* eg:
  if($post->post_excerpt) {
    the_excerpt();
  } else {
    custom_excerpt(16);
  }
*/
function custom_excerpt($excerpt_length = 15, $id = false, $echo = true) {
  $text = '';

  global $post;
  $text = get_the_excerpt('');

  $text = strip_shortcodes( $text );
  $text = apply_filters('the_content', $text);
  $text = str_replace(']]>', ']]&gt;', $text);

  $text = strip_tags($text);

    $excerpt_more = '...';
    $words = preg_split("/[\n\r\t ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
    if ( count($words) > $excerpt_length ) {
      array_pop($words);
      $text = implode(' ', $words);
      $text = $text . $excerpt_more;
    } else {
      $text = implode(' ', $words);
    }
  if($echo)
  echo apply_filters('the_content', $text);
  else
  return $text;
}
function get_custom_excerpt($excerpt_length = 55, $id = false, $echo = false) {
 return custom_excerpt($excerpt_length, $id, $echo);
}

//custom profile fields
function my_new_contactmethods( $contactmethods ) {
  $contactmethods['twitter'] = 'Twitter';
  return $contactmethods;
}
add_filter('user_contactmethods','my_new_contactmethods', 10, 1);

add_action( 'show_user_profile', 'extra_user_profile_fields' );
add_action( 'edit_user_profile', 'extra_user_profile_fields' );
function extra_user_profile_fields( $user ) { ?>
<h3><?php _e("Extra profile information", "blank"); ?></h3>

<table class="form-table">
  <tr>
    <th><label for="location"><?php _e("Event Location"); ?></label></th>
    <td>
      <?php
        //get dropdown saved value
        $selected = get_the_author_meta( 'location', $user->ID );
        global $locations;
      ?>
      <select name="location" id="location">
        <?php
          foreach ($locations as $key => $value) {
            echo '<option value="' . $key . '"';
            if ($selected == $key) {
              echo ' selected="selected"';
            }
            echo '>' . $value . '</option>';
          }
        ?>
      </select>
    </td>
  </tr>
</table>
<? }

add_action( 'personal_options_update', 'save_extra_user_profile_fields' );
add_action( 'edit_user_profile_update', 'save_extra_user_profile_fields' );
function save_extra_user_profile_fields( $user_id ) {

  if ( !current_user_can( 'edit_user', $user_id ) ) :
    return false;
  endif;

  update_usermeta( $user_id, 'location', $_POST['location'] );
}


//custom post types
function create_post_type() {
  register_post_type( 'event',
    array(
      'labels' => array(
        'name' => __( 'Events' ),
        'singular_name' => __( 'Event' )
      ),
      'capability_type' => 'event',
      'capabilities' => array(
        'edit_post' => 'edit_event',
        'edit_posts' => 'edit_events',
        'edit_others_posts' => 'edit_others_events',
        'edit_published_posts' => 'edit_published_events',
        'publish_posts' => 'publish_events',
        'read_post' => 'read_event',
        'read_private_posts' => 'read_private_events',
        'delete_post' => 'delete_event',
        'delete_posts' => 'delete_events',
        'delete_others_posts' => 'delete_others_events',
        'delete_published_posts' => 'delete_published_events'
      ),
      'map_meta_cap' => true,
      'public' => true,
      'show_ui' => true,
      'rewrite' => array( 'slug' => 'events' ),
      'query_var' => false,
      'has_archive' => true,
      'supports' => array('title', 'editor', 'excerpt', 'thumbnail')
    )
  );
  register_post_type( 'data',
    array(
      'labels' => array(
        'name' => __( 'Datasets' ),
        'singular_name' => __( 'Dataset' )
      ),
      'capability_type' => 'data',
      'capabilities' => array(
        'edit_posts' => 'edit_datas',
        'edit_others_posts' => 'edit_others_datas',
        'edit_published_posts' => 'edit_published_datas',
        'publish_posts' => 'publish_datas',
        'read_post' => 'read_data',
        'read_private_posts' => 'read_private_datas',
        'delete_post' => 'delete_data',
        'delete_posts' => 'delete_datas',
        'delete_others_posts' => 'delete_others_datas',
        'delete_published_posts' => 'delete_published_datas'
      ),
      'map_meta_cap' => true,
      'public' => true,
      'show_ui' => true,
      'rewrite' => true,
      'query_var' => false,
      'has_archive' => true,
      'supports' => array('title', 'excerpt')
    )
  );
  register_post_type( 'challenge',
    array(
      'labels' => array(
        'name' => __( 'Challenges' ),
        'singular_name' => __( 'Challenge' )
      ),
      'capability_type' => 'challenge',
      'capabilities' => array(
        'edit_posts' => 'edit_challenges',
        'edit_others_posts' => 'edit_others_challenges',
        'edit_published_posts' => 'edit_published_challenges',
        'publish_posts' => 'publish_challenges',
        'read_post' => 'read_challenge',
        'read_private_posts' => 'read_private_challenges',
        'delete_post' => 'delete_challenge',
        'delete_posts' => 'delete_challenges',
        'delete_others_posts' => 'delete_others_challenges',
        'delete_published_posts' => 'delete_published_challenges'
      ),
      'map_meta_cap' => true,
      'public' => true,
      'show_ui' => true,
      'rewrite' => array( 'slug' => 'challenges' ),
      'query_var' => false,
      'has_archive' => true,
      'supports' => array('title', 'editor', 'excerpt', 'thumbnail')
    )
  );
  register_post_type( 'project',
    array(
      'labels' => array(
        'name' => __( 'Projects' ),
        'singular_name' => __( 'Project' )
      ),
      'capability_type' => 'project',
      'capabilities' => array(
        'edit_post' => 'edit_project',
        'edit_posts' => 'edit_projects',
        'edit_others_posts' => 'edit_others_projects',
        'edit_published_posts' => 'edit_published_projects',
        'publish_posts' => 'publish_projects',
        'read_post' => 'read_project',
        'read_private_posts' => 'read_private_projects',
        'delete_post' => 'delete_project',
        'delete_posts' => 'delete_projects',
        'delete_others_posts' => 'delete_others_projects',
        'delete_published_posts' => 'delete_published_projects'
      ),
      'map_meta_cap' => true,
      'public' => true,
      'show_ui' => true,
      'rewrite' => array( 'slug' => 'projects' ),
      'query_var' => false,
      'has_archive' => true,
      'supports' => array('title', 'editor', 'excerpt', 'thumbnail')
    )
  );
}
add_action( 'init', 'create_post_type' );

//custom taxonomies
function eventtax_init() {
  register_taxonomy(
    'event-type',
    'event',
    array(
      'label' => __( 'Event Type' ),
      'rewrite' => array( 'slug' => 'event-type' ),
      'hierarchical' => true,
      'capabilities' => array(
        'assign_terms' => 'edit_events'
      )
    )
  );
  register_taxonomy_for_object_type( 'event-type', 'event' );
}
add_action( 'init', 'eventtax_init' );

function datatax_init() {
  register_taxonomy(
    'data-tag',
    'data',
    array(
      'label' => __( 'Data Tag' ),
      'rewrite' => array( 'slug' => 'data-tag' )
    )
  );
  register_taxonomy_for_object_type( 'data-tag', 'data' );
  register_taxonomy(
    'data-category',
    'data',
    array(
      'label' => __( 'Data Category' ),
      'rewrite' => array( 'slug' => 'data-category' ),
      'hierarchical' => true
    )
  );
  register_taxonomy_for_object_type( 'data-category', 'data' );
}
add_action( 'init', 'datatax_init' );

function challengetax_init() {
  register_taxonomy(
    'challenge-tag',
    'challenge',
    array(
      'label' => __( 'Challenge Tag' ),
      'rewrite' => array( 'slug' => 'challenge-tag' )
    )
  );
  register_taxonomy_for_object_type( 'challenge-tag', 'challenge' );
  register_taxonomy(
    'challenge-category',
    'challenge',
    array(
      'label' => __( 'Challenge Category' ),
      'rewrite' => array( 'slug' => 'challenge-category' ),
      'hierarchical' => true
    )
  );
  register_taxonomy_for_object_type( 'challenge-category', 'challenge' );
}
add_action( 'init', 'challengetax_init' );

function projecttax_init() {
  register_taxonomy(
    'project-category',
    'project',
    array(
      'label' => __( 'Project Category' ),
      'rewrite' => array( 'slug' => 'project-category' ),
      'hierarchical' => true
    )
  );
  register_taxonomy_for_object_type( 'project-category', 'project' );
}
add_action( 'init', 'projecttax_init' );

function project_query_vars($aVars) {
  $aVars[] = "project-event";
  return $aVars;
}
add_filter('query_vars', 'project_query_vars');


//custom roles
add_action( 'admin_init', 'add_organizer_role' );
function add_organizer_role() {
  $marketing = add_role( 'organizer', 'Organizer', array(
    'read' => true
  ));
}

//custom capabilities
function add_theme_caps() {
    // gets the administrator role
    $admins = get_role( 'administrator' );

    $admins->add_cap( 'edit_event' );
    $admins->add_cap( 'edit_events' );
    $admins->add_cap( 'edit_others_events' );
    $admins->add_cap( 'edit_published_events' );
    $admins->add_cap( 'publish_events' );
    $admins->add_cap( 'read_event' );
    $admins->add_cap( 'read_private_events' );
    $admins->add_cap( 'delete_event' );
    $admins->add_cap( 'delete_events' );
    $admins->add_cap( 'delete_others_events' );
    $admins->add_cap( 'delete_published_events' );

    $admins->add_cap( 'edit_datas' );
    $admins->add_cap( 'edit_others_datas' );
    $admins->add_cap( 'edit_published_datas' );
    $admins->add_cap( 'publish_datas' );
    $admins->add_cap( 'read_data' );
    $admins->add_cap( 'read_private_datas' );
    $admins->add_cap( 'delete_data' );
    $admins->add_cap( 'delete_datas' );
    $admins->add_cap( 'delete_others_datas' );
    $admins->add_cap( 'delete_published_datas' );

    $admins->add_cap( 'edit_challenges' );
    $admins->add_cap( 'edit_others_challenges' );
    $admins->add_cap( 'edit_published_challenges' );
    $admins->add_cap( 'publish_challenges' );
    $admins->add_cap( 'read_challenge' );
    $admins->add_cap( 'read_private_challenges' );
    $admins->add_cap( 'delete_challenge' );
    $admins->add_cap( 'delete_challenges' );
    $admins->add_cap( 'delete_others_challenges' );
    $admins->add_cap( 'delete_published_challenges' );

    $admins->add_cap( 'edit_project' );
    $admins->add_cap( 'edit_projects' );
    $admins->add_cap( 'edit_others_projects' );
    $admins->add_cap( 'edit_published_projects' );
    $admins->add_cap( 'publish_projects' );
    $admins->add_cap( 'read_project' );
    $admins->add_cap( 'read_private_projects' );
    $admins->add_cap( 'delete_project' );
    $admins->add_cap( 'delete_projects' );
    $admins->add_cap( 'delete_others_projects' );
    $admins->add_cap( 'delete_published_projects' );
}
add_action( 'admin_init', 'add_theme_caps');


// custom filters
function postsper_filter($query) {
  if ( !is_admin() && $query->is_main_query() ) {
    if ( is_post_type_archive('event') || is_tax('event-type') ) {
      // show all posts on these, no paging
      $query->set('posts_per_page', '-1');
    }
    if ( is_post_type_archive('project') || is_tax('project-type') ) {
      global $wp_query;
      if (isset($wp_query->query_vars['project-event'])) {
        $query->set('posts_per_page', '-1');
      } else {
        $query->set('posts_per_page', '24');
      }
    }
    if ( is_post_type_archive('challenge') || is_tax('challenge-type') ) {
      $query->set('posts_per_page', '24');
    }
    if ( is_post_type_archive('data') || is_tax('data-category') || is_tax('data-tag') ) {
      $query->set('posts_per_page', '25');
    }
  }
}
add_action('pre_get_posts','postsper_filter');


// custom functions
function getIdViaSlug($slug) {
  // get the post id from slug, assuming there is a home page, to get fields by post id.
  $id = null;
  $the_slug = $slug;
  $args=array(
    'name' => $the_slug,
    'post_type' => 'page',
    'post_status' => 'publish',
    'posts_per_page' => 1
  );
  $found_posts = get_posts( $args );
  if( $found_posts ) {
    $id = $found_posts[0]->ID;
  }
  return $id;
}

// check if is subpage: http://codex.wordpress.org/Conditional_Tags#Testing_for_sub-Pages
function is_subpage() {
  global $post;
  if ( is_page() && $post->post_parent ) { // test to see if the page has a parent
    return $post->post_parent;             // return the ID of the parent post
  } else {                                 // there is no parent so ...
    return false;                          // ... the answer to the question is false
  }
}

function getUserList() {
  global $wpdb;
  return $wpdb->get_results("SELECT ID from $wpdb->users");
}

function getOrganizers($postID){
  global $wpdb;
  //get groupID for this post, expecting only 1
  $groups = $wpdb->get_results("SELECT group_id FROM wp_uam_accessgroup_to_object WHERE object_id = '" . $postID . "'");
  $group = $groups[0]->group_id;

  $result = $wpdb->get_results("SELECT object_id FROM wp_uam_accessgroup_to_object WHERE object_type = 'user' AND group_id = '" . $group . "'");

  //var_dump($result);
  return $result;
}

function MultiEdit(){
  update_user_option( get_current_user_id(), 'edit_event_per_page', 2000, true);
}
add_action('admin_head', 'MultiEdit');

class myUsers {
  static function init() {
    // Change the user's display name after insertion
    add_action( 'user_register', array( __CLASS__, 'change_display_name' ) );      
  }
       
  static function change_display_name( $user_id ) {
    $info = get_userdata( $user_id );

    $args = array(
      'ID' => $user_id,
      'display_name' => $info->first_name . ' ' . $info->last_name
    );

    wp_update_user( $args ) ;
  }
}
 
myUsers::init();

function fix_empty_search ($query){
    global $wp_query;
    if (isset($_GET['s']) && empty($_GET['s'])){
        $wp_query->is_search=true;
    }
    return $query;
}
add_action('pre_get_posts','fix_empty_search');

function my_force_ssl() {
    return true;
}
add_filter('force_ssl', 'my_force_ssl', 10, 3);

function make_clickable_links ($s) {
  return preg_replace('@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@', '<a href="$1" target="_blank">$1</a>', $s);
}