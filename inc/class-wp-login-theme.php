<?php

defined( 'ABSPATH' ) or die();

//
// // changing the logo link from wordpress.org to your site
// function WLT_LOGIN_URL() {  return home_url(); }
//
// // changing the alt text on the logo to show your site name
// function WLT_LOGIN_TITLE() { return get_option( 'blogname' ); }
//
// // calling it only on the login page
//
// add_filter( 'login_headerurl', 'WLT_LOGIN_URL' );
// add_filter( 'login_headertitle', 'WLT_LOGIN_TITLE' );
//
// //Setting menu
// function wporg_options_page() {
//  	// add top level menu page
// 	 add_menu_page(
// 	 	'wlt_login',
// 	 	'WP Login Theme',
// 	 	'manage_options',
// 	 	'wlt_login',
// 	 	'wlt_login_page'
//  	);
// }

//CSS for plugin admin settings
function WLT_LOGIN_CSS_ADMIN() {
	wp_enqueue_style( 'wlt_login_cssadmin', plugin_dir_url( __FILE__ ) . 'css/wlt-login-admin.css', false );
}
add_action( 'admin_init', 'WLT_LOGIN_CSS_ADMIN' );

// UPLOAD ENGINE
function WLT_LOGIN_LOAD_WP_MEDIA_FILES() {
  	wp_enqueue_media();
}
add_action( 'admin_enqueue_scripts', 'WLT_LOGIN_LOAD_WP_MEDIA_FILES' );

// Initializing  plugin function
function WLT_LOGIN_ADMIN_MENU() {
   add_options_page("WP Login Theme", "WP Login Theme", "manage_options", "wp-login-theme", "WLT_LOGIN_ADMIN_SETTINGS");
}
add_action("admin_menu", "WLT_LOGIN_ADMIN_MENU");

// PLugin Admin Settings function
function WLT_LOGIN_ADMIN_SETTINGS() {
	// Plugin heading */
 	echo "<h3> WP Login Theme Settings</h3><hr/>";

	// Checking submit button clicked or not
  	if(isset($_REQUEST['wplt_url_title_submit'])){
		$wplt_logo_url = $_REQUEST['wplt_logo_url'];
		$wplt_logo_title = $_REQUEST['wplt_logo_title'];
		$wplt_logo_ad_image_path = $_REQUEST['ad_image_path'];
		$wplt_login_theme = $_REQUEST['wplt_login_theme'];

		// Stores data in options table in database
		update_option('wplt_logo_url', $wplt_logo_url);
		update_option('wplt_logo_title', $wplt_logo_title);
		update_option('wplt_login_theme', $wplt_login_theme);
		if(isset($wplt_logo_ad_image_path)){
			update_option('wplt_logo_ad_image_path', $wplt_logo_ad_image_path);
		}
	} ?>
	<div class="wplt_url_titles">
		<form name="wplt_url_title" method="post">
			<table class="form-table">
			    <tbody>
			        <tr>
			            <th scope="row"><label for="blogname">Login Logo</label></th>
			            <td>
							<?php $check_im_path = get_option('wplt_logo_ad_image_path');
							if($check_im_path) { ?>
								<img src="<?php echo get_option('wplt_logo_ad_image_path');?>" id="imgsrc" class="wplt_image_show logoimage" style="max-width: 70px; display: table;">
							<?php } else { ?>
								<img src="<?php echo plugins_url( 'css/default.jpg', __FILE__ );?>" id="imgsrc" class="wplt_image_show imgdefualt" style="max-width: 70px; display: table;">
							<?php }
							if($check_im_path) { ?>
								<a href="javascriot:void(0);" class="remove button button-primary" style="float: left; margin-top: 15px; margin-right: 10px;" >Remove</a>
							<?php } ?>
							<input type="hidden" name="hid_up_image" id="hid_up_image" value="<?php echo get_option('wplt_logo_ad_image_path');?>">
							<input id="upload_image" type="hidden" size="36" name="ad_image_path"  class="regular-text" value="<?php echo get_option('wplt_logo_ad_image_path');?>" />
							<input id="upload_image_button" class="button button-primary" type="button" value="Upload Image"style="float: left; margin: 15px 0 0 0;" />
						</td>
			        </tr>
			        <tr>
			            <th scope="row"><label for="blogdescription">Login Logo URL</label></th>
			            <td>
			                <input type="url" name="wplt_logo_url" value="<?php echo get_option('wplt_logo_url');?>" required class="regular-text">
			                <p class="description" id="tagline-description">Add your custom link on login page logo.</p>
			            </td>
			        </tr>
			        <tr>
			            <th scope="row"><label for="siteurl">Login Logo Title on Hover</label></th>
			            <td>
							<input  type="text" name="wplt_logo_title" value="<?php echo get_option('wplt_logo_title');?>" required class="regular-text code">
							<p class="description" id="tagline-description">Add your custom title on login page logo.</p>
						</td>
			        </tr>
			        <tr>
			            <th scope="row"><label for="default_role">Select Login Theme</label></th>
			            <td>
							<?php $wplt_login_theme_val = get_option('wplt_login_theme');?>
			                <select name="wplt_login_theme">
			                    <option <?php if ( $wplt_login_theme_val == 'default' ) {?> selected="selected" <?php } ?> value="default">Default</option>
			                    <option <?php if ( $wplt_login_theme_val == 'wlt-login-1' ) {?> selected="selected" <?php } ?> value="wlt-login-1">Theme 1</option>
			                    <option <?php if ( $wplt_login_theme_val == 'wlt-login-2' ) {?> selected="selected" <?php } ?> value="wlt-login-2">Theme 2</option>
			                    <option <?php if ( $wplt_login_theme_val == 'wlt-login-3' ) {?> selected="selected" <?php } ?> value="wlt-login-3">Theme 3</option>
			                    <option <?php if ( $wplt_login_theme_val == 'wlt-login-4' ) {?> selected="selected" <?php } ?> value="wlt-login-4">Theme 4</option>
			                    <option <?php if ( $wplt_login_theme_val == 'wlt-login-5' ) {?> selected="selected" <?php } ?> value="wlt-login-5">Theme 5</option>
			                    <option <?php if ( $wplt_login_theme_val == 'wlt-login-6' ) {?> selected="selected" <?php } ?> value="wlt-login-6">Theme 6</option>
			                </select>
			            </td>
			        </tr>
					<tr>
						<td colspan=2><input type="submit" name="wplt_url_title_submit" class="wplt_url_title_submit_cls button button-primary" value="Save Changes"></td>
					</tr>
			    </tbody>
			</table>
		</form>
	</div>
	<script>
		// Raising Media upload form
		jQuery(document).ready(function($){
			var custom_uploader;
			$('.remove').click(function(){
				$('.logoimage').hide();
				$('#hid_up_image').val('');
				$('#upload_image').val('');
			})
			$('#upload_image_button').click(function(e) {
				e.preventDefault();

				//If the uploader object has already been created, reopen the dialog
				if (custom_uploader) {
					custom_uploader.open();
					return;
				}
				//Extend the wp.media object
				custom_uploader = wp.media.frames.file_frame = wp.media({
					title: 'Choose Image',
					button: {
						text: 'Choose Image'
					},
					multiple: true
				});
				//When a file is selected, grab the URL and set it as the text field's value
				custom_uploader.on('select', function() {
					//console.log(custom_uploader.state().get('selection').toJSON());
					attachment = custom_uploader.state().get('selection').first().toJSON();
					$('#upload_image').val(attachment.url);
					$('#imgsrc').attr('src', attachment.url);
				});
				//Open the uploader dialog
				custom_uploader.open();
			});
		});
	</script>
<?php }
// Plugin function end here

// Update the Login logo
function WLT_LOGIN_LOGO_UPDATE() {
	$wplt_image_path =  get_option('wplt_logo_ad_image_path');
	if ($wplt_image_path) {
		list($width, $height, $type, $attr) = getimagesize($wplt_image_path);

		echo '<style type="text/css">.login h1 a { background-image:url('.$wplt_image_path.') !important;  height:'.$height.'px; width:auto; background-size: '.$width.'px '.$height.'px;}</style>';
	}
}

// Update the login Page CSS
function WLT_LOGIN_CSS() {
	$wplt_login_theme_name =  get_option('wplt_login_theme');
	if ($wplt_login_theme_name) {
		wp_enqueue_style( 'wlt_login_css', plugin_dir_url( __FILE__ ) . 'css/'.$wplt_login_theme_name.'.css', false );
	}
}
add_action( 'login_enqueue_scripts', 'WLT_LOGIN_CSS', 10 );

// Update the login logo link
function WLT_LOGIN_URL($url) {
	return get_option('wplt_logo_url');
}

// Update the logo hover title
function WLT_LOGIN_TITLE() {
	return get_option('wplt_logo_title');
}

// Calling default  head url and head title filter
add_filter( 'login_headerurl', 'WLT_LOGIN_URL' );
add_filter('login_headertitle', 'WLT_LOGIN_TITLE');
add_action('login_head', 'WLT_LOGIN_LOGO_UPDATE');
