<?php

// Creating the widget
class cust_search_widget extends WP_Widget {

function __construct() {
parent::__construct(
// Base ID of your widget
'cust_search_widget',

// Widget name will appear in UI
__('Blog Search Widget', 'cust_search_widget_domain'),

// Widget description
array( 'description' => __( 'Shows only the input with placeholder text, searches only blog posts', 'cust_search_widget_domain' ), )
);
}

// Creating widget front-end
// This is where the action happens
public function widget( $args, $instance ) {
$title = apply_filters( 'widget_title', $instance['title'] );
// before and after widget arguments are defined by themes
echo $args['before_widget'];
if ( ! empty( $title ) )
echo $args['before_title'] . $title . $args['after_title'];

// Display the output
echo '<form class="slim-search" action="' . home_url( '/' ) . '" method="get">';
echo '<input type="search" class="search-input" id="s" placeholder="';
echo __('Search for news...', 'cust_search_widget_domain');
echo '" name="s" />';
echo '<input type="hidden" name="post_type" value="post">';
echo '<input type="submit" value="';
echo __('Search', 'cust_search_widget_domain');
echo '" /></form>';
echo $args['after_widget'];
}

// Widget Backend
public function form( $instance ) {
if ( isset( $instance[ 'title' ] ) ) {
$title = $instance[ 'title' ];
}
else {
$title = __( '', 'cust_search_widget_domain' );
}
// Widget admin form
?>
<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>
<?php
}

// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
return $instance;
}
} // Class cust_search_widget ends here

// Register and load the widget
function wpb_load_widget() {
  register_widget( 'cust_search_widget' );
}
add_action( 'widgets_init', 'wpb_load_widget' );




class social_link_widget extends WP_Widget {

function __construct() {
parent::__construct(
'social_link_widget',

__('Social Links', 'social_link_widget_domain'),
array( 'description' => __( 'Enter links to your social profiles and use this in the Secondary Header Area.', 'social_link_widget_domain' ), )
);
}

public function widget( $args, $instance ) {
$facebook = $instance['facebook'];
$twitter = $instance['twitter'];
$gplus = $instance['gplus'];
$flickr = $instance['flickr'];

echo $args['before_widget'];

// Display the output
if (!empty($twitter)) {
  echo '<a href="' . $twitter . '" class="ico ico-tw">Twitter</a>';
}
if (!empty($facebook)) {
  echo '<a href="' . $facebook . '" class="ico ico-fb">Facebook</a>';
}
if (!empty($gplus)) {
  echo '<a href="' . $gplus . '" class="ico ico-gp">Google+</a>';
}
if (!empty($flickr)) {
  echo '<a href="' . $flickr . '" class="ico ico-flickr">Flickr</a>';
}

echo $args['after_widget'];
}

// Widget Backend
public function form( $instance ) {
if ( isset( $instance[ 'facebook' ] ) ) {
$facebook = $instance[ 'facebook' ];
}
else {
$facebook = '';
}
if ( isset( $instance[ 'twitter' ] ) ) {
$twitter = $instance[ 'twitter' ];
}
else {
$twitter = '';
}
if ( isset( $instance[ 'gplus' ] ) ) {
$gplus = $instance[ 'gplus' ];
}
else {
$gplus = '';
}
if ( isset( $instance[ 'flickr' ] ) ) {
$flickr = $instance[ 'flickr' ];
}
else {
$flickr = '';
}
// Widget admin form
?>
<p>
<label for="<?php echo $this->get_field_id( 'facebook' ); ?>">Facebook:</label>
<input class="widefat" id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" type="text" value="<?php echo esc_attr( $facebook ); ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'twitter' ); ?>">Twitter:</label>
<input class="widefat" id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" type="text" value="<?php echo esc_attr( $twitter ); ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'gplus' ); ?>">Google+:</label>
<input class="widefat" id="<?php echo $this->get_field_id( 'gplus' ); ?>" name="<?php echo $this->get_field_name( 'gplus' ); ?>" type="text" value="<?php echo esc_attr( $gplus ); ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'flickr' ); ?>">Flickr:</label>
<input class="widefat" id="<?php echo $this->get_field_id( 'flickr' ); ?>" name="<?php echo $this->get_field_name( 'flickr' ); ?>" type="text" value="<?php echo esc_attr( $flickr ); ?>" />
</p>
<?php
}

// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['facebook'] = ( ! empty( $new_instance['facebook'] ) ) ? strip_tags( $new_instance['facebook'] ) : '';
$instance['twitter'] = ( ! empty( $new_instance['twitter'] ) ) ? strip_tags( $new_instance['twitter'] ) : '';
$instance['gplus'] = ( ! empty( $new_instance['gplus'] ) ) ? strip_tags( $new_instance['gplus'] ) : '';
$instance['flickr'] = ( ! empty( $new_instance['flickr'] ) ) ? strip_tags( $new_instance['flickr'] ) : '';
return $instance;
}
} // Class social_link_widget ends here

function wpb_load_widget2() {
  register_widget( 'social_link_widget' );
}
add_action( 'widgets_init', 'wpb_load_widget2' );



?>
