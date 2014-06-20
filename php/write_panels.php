<?php
/*
Plugin Name: Custom Write Panels
Description: Allows custom fields to be added to the WordPress Add / Edit Page. Now supports Custom Post Types.
Version: 2.0
Author: Matt Felten
Author URI: http://www.arkitect.org
/* ----------------------------------------------*/

// Content Options: text, textarea, wysiwyg

$key = "ndoch";
$meta_boxes = array(
	"ndoch_location" => array(
		"name" => "ndoch_location",
		"title" => "Event City",
		"description" => "Contact admin if your location isn't here",
		"type" => "event",
		"content" => "dropdown",
		"options" => $location_city
	),
	"ndoch_state" => array(
		"name" => "ndoch_state",
		"title" => "Event State",
		"type" => "event",
		"content" => "dropdown",
		"options" => $location_state
	),
	"ndoch_country" => array(
		"name" => "ndoch_country",
		"title" => "Event Country",
		"type" => "event",
		"content" => "dropdown",
		"options" => $location_country
	),
);

function writePanel_create() {
	global $meta_boxes, $key;

	$thisPage = false;
	foreach($meta_boxes as $meta_box) :
		if( $meta_box['type'] == writePanel_postType() ) :
			$thisPage = true;
		endif;
	endforeach;
	if( $thisPage == false ) :
		return;
	endif;

	if( function_exists( 'add_meta_box' ) ) :
		add_meta_box( 'new-meta-boxes', 'Custom Options', 'writePanel_display', writePanel_postType(), 'normal', 'high' );
	endif;
}

function writePanel_display() {
	global $meta_boxes, $key;

?>
<div class="form-wrap">
<?php
	wp_nonce_field( plugin_basename( __FILE__ ), str_replace(" ", "_", $key ) . '_wpnonce', false, true );

	$data = get_post_meta( writePanel_postID() , str_replace(" ", "_", $key ), true);
	foreach($meta_boxes as $meta_box) :
		if( $meta_box['type'] == writePanel_postType() ) :
			if ( $meta_box[ 'content' ] == "text" ) :
?><div class="form-field form-required">
	<label for="<?php echo $meta_box[ 'name' ]; ?>"><?php echo $meta_box[ 'title' ]; ?></label>
	<input type="text" name="<?php echo $meta_box[ 'name' ]; ?>" value="<?php echo htmlspecialchars( $data[ $meta_box[ 'name' ] ] ); ?>" />
<?				if( $meta_box['description'] ) :
?>	<p><?php echo $meta_box[ 'description' ]; ?></p>
<?				endif;
?></div>

<? 			endif;

			if ( $meta_box[ 'content' ] == "textarea" ) :
?><div class="form-field form-required">
	<label for="<?php echo $meta_box[ 'name' ]; ?>"><?php echo $meta_box[ 'title' ]; ?></label>
	<textarea name="<?php echo $meta_box[ 'name' ]; ?>" ><?php echo htmlspecialchars( $data[ $meta_box[ 'name' ] ] ); ?></textarea>
<?				if( $meta_box['description'] ) :
?>	<p><?php echo $meta_box[ 'description' ]; ?></p>
<?				endif;
?></div>
<? 			endif;

			if ( $meta_box[ 'content' ] == "wysiwyg" ) :
?><div class="form-field form-required">
	<label for="<?php echo $meta_box[ 'name' ]; ?>"><?php echo $meta_box[ 'title' ]; ?></label>
	<div>
		<textarea id="<?php echo $meta_box[ 'name' ]; ?>"name="<?php echo $meta_box[ 'name' ]; ?>" ><?php echo htmlspecialchars( $data[ $meta_box[ 'name' ] ] ); ?></textarea>
	</div>
<?				if( $meta_box['description'] ) :
?>	<p><?php echo $meta_box[ 'description' ]; ?></p>
<?				endif;
?></div>
<? 			endif;

			if( $meta_box['content'] == 'dropdown' && !empty( $meta_box['options'] ) ) :
?><div class="form-field form-required">
	<label for="<?php echo $meta_box[ 'name' ]; ?>"><?php echo $meta_box[ 'title' ]; ?></label>
	<div>
		<select name="<?=$meta_box['name']?>">
<?				foreach( $meta_box['options'] as $k => $v ) :
					if( isset( $data[ $meta_box['name'] ] ) &&  $data[ $meta_box['name'] ] == $v ) :
?>			<option value="<?=$v?>" selected="selected"><?=$v?></option>
<?					else :
?>			<option value="<?=$v?>"><?=$v?></option>
<?					endif;
				endforeach;
?>		</select>
	</div>
<?				if( $meta_box['description'] ) :
?>	<p><?php echo $meta_box[ 'description' ]; ?></p>
<?				endif;
?></div>

<?			endif;
		endif;
	endforeach;
?></div>
<?php
}

function writePanel_tinyMCE() {
	global $meta_boxes;
	$wysiwyg_editors = array();

	foreach($meta_boxes as $meta_box) {
		if ( $meta_box[ "content" ] == "wysiwyg" ) {
			$wysiwyg_editors[] = $meta_box['name'];
		}
	}

	if ( count( $wysiwyg_editors ) > 0 ) {
		foreach ($wysiwyg_editors as $editorId) {
			$wysiwygIds[] = "#".$editorId;
		}
		$editorIds = implode(",", $wysiwygIds);
		?>
		<script type="text/javascript">
			/* <![CDATA[ */
				// JQ JS to add the class 'mceEditor' to the excerpt textarea pre WP 2.5
				jQuery(document).ready( function () {
					jQuery("<?=$editorIds?>").addClass("mceEditor");
					if ( typeof( tinyMCE ) == "object" && typeof( tinyMCE.execCommand ) == "function" ) {
						jQuery("<?=$editorIds?>").wrap( "<div id='editorcontainer'></div>" );
						<? foreach ($wysiwyg_editors as $editorId) { ?>
						tinyMCE.execCommand("mceAddControl", false, "<?=$editorId?>");
						<? } ?>
					}
				});
			/* ]]> */
		</script>
		<?php
	}
}

function writePanel_save( $post_id ) {
	global $meta_boxes, $key;

	foreach( $meta_boxes as $meta_box ) {
		$data[ $meta_box[ 'name' ] ] = $_POST[ $meta_box[ 'name' ] ];
		if ($meta_box[ 'content' ] == "wysiwyg") {
			$data[ $meta_box[ 'name' ] ] = wpautop( $_POST[ $meta_box[ 'name' ] ] );
		}
	}

	if ( !wp_verify_nonce( $_POST[ str_replace(" ", "_", $key ) . '_wpnonce' ], plugin_basename(__FILE__) ) )
		return $post_id;

	if ( !current_user_can( 'edit_post', writePanel_postID() ))
		return $post_id;

	update_post_meta( $post_id, str_replace(" ", "_", $key ), $data );
}

function writePanel_postID() {
	if ( isset($_GET['post']) )
		$post_id = (int) $_GET['post'];
	elseif ( isset($_POST['post_ID']) )
		$post_id = (int) $_POST['post_ID'];
	else
		$post_id = 0;
	return $post_id;
}

function writePanel_post( $id = false ) {
	if( $id ) :
		$post = get_post( $id ) ;
	else :
		$post = get_post( writePanel_postID() );
	endif;
	return $post;
}

function writePanel_postType() {
	global $post;
	$post_id = writePanel_postID();
	if( $_REQUEST['post_type'] ) :
		return $_REQUEST['post_type'];
	endif;

	if( $post ) :
		return $post->post_type;
	else :
		if( $post_id ) :
			$post = writePanel_post( $post_id );
			if( $post ) :
				return $post->post_type;
			endif;
		endif;
	endif;
	return null;
}

if ( is_admin() ) {
	add_action( 'admin_menu', 'writePanel_create' );
	add_action( 'admin_head', 'writePanel_tinyMCE');
	add_action( 'save_post', 'writePanel_save' );
}
?>
