<?php 
/*
Plugin Name: MyScrollBar 
Plugin URI: http://www.textilestudy.ml/textilestudy
Description: This plugin gives you a awesome scrollbar in your wordpress website.
Author: Md Ali Hossain
Author URI: https://developitwp.wordpress.com/contact/
Version: 1.0
*/



/* Adding Latest jQuery from Wordpress */
function enable_jquray_in_msp_my_scrollbar() {
	wp_enqueue_script('jquery');
}
add_action('init', 'enable_jquray_in_msp_my_scrollbar');



/*Some Set-up*/
define('MY_SCROLLBAR_WP', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );

wp_enqueue_script('msp-my-scrollbar-main', MY_SCROLLBAR_WP.'js/jquery.nicescroll.min.js', array('jquery'));

wp_enqueue_style('msp-my-scrollbar-css', MY_SCROLLBAR_WP.'css/custom-scrollbar.css');

if ( is_admin() ) :  // Load if admin loged in


/*Register files*/
function my_scrolllbar_fields_packet(){
	
	add_settings_section('header_section', 'My Scrollbar Options', 'msp_my_plugin_callback', 'scrollbar_options');
	
	add_settings_field('scrollbar_speed', '<label for="speed">Scrollbar Speed</label>', 'msp_scrollbar_speed_callback', 'scrollbar_options', 'header_section');
	register_setting('header_section', 'mspmyscrollbarcommon');
	
	
	add_settings_field('scrollbar_color', '<label for="color">Scrollbar color</label>', 'msp_scrollbar_color_callback', 'scrollbar_options', 'header_section');
	register_setting('header_section', 'mspmyscrollbarcommon');
	
	add_settings_field('scrollbar_width', '<label for="width">Scrollbar width</label>', 'msp_scrollbar_width_callback', 'scrollbar_options', 'header_section');
	register_setting('header_section', 'mspmyscrollbarcommon');
	
	add_settings_field('scrollbar_radius', '<label for="radius">Scrollbar radius</label>', 'msp_scrollbar_radius_callback', 'scrollbar_options', 'header_section');
	register_setting('header_section', 'mspmyscrollbarcommon');
	
	add_settings_field('scrollbar_border', '<label for="border">Scrollbar border</label>', 'msp_scrollbar_border_callback', 'scrollbar_options', 'header_section');
	register_setting('header_section', 'mspmyscrollbarcommon');
	
	
	add_settings_field('scrollbar_autohide', '<label for="autohide">Scrollbar autohide</label>', 'msp_scrollbar_autohide_callback', 'scrollbar_options', 'header_section');
	register_setting('header_section', 'mspmyscrollbarcommon');

}
add_action('admin_init', 'my_scrolllbar_fields_packet');

function msp_my_plugin_callback(){
	return;
}
/*create input fields*/
function msp_scrollbar_speed_callback(){
	
	$mspmyscrolloption = (array)get_option('mspmyscrollbarcommon');
	$mspmyscrollbaroptions = $mspmyscrolloption['scrollbar_speed'];
	
	echo'<input id="speed" name="mspmyscrollbarcommon[scrollbar_speed]" type="text" value="'.$mspmyscrollbaroptions.'" />
	<p class="description">Select scrollbar speed here. Default value is 60. If you increase value, the scrolling speed will be slower. If you decrease value, scrolling speed will be faster.</p>';
	
}


function msp_scrollbar_autohide_callback(){
	
	$mspmyscrollautohideoption = (array)get_option('mspmyscrollbarcommon');
	$mspmyscrollbarautohideoptions = $mspmyscrollautohideoption['scrollbar_autohide'];
	
	echo'<input id="autohide" name="mspmyscrollbarcommon[scrollbar_autohide]" type="checkbox" value="true" '.checked('true', $mspmyscrollbarautohideoptions, false).' />Checkbox for autohide or uncheck for not hide.';
	
}

function msp_scrollbar_border_callback(){
	
	$mspmyscrollborderoption = (array)get_option('mspmyscrollbarcommon');
	$mspmyscrollbarborderoptions = $mspmyscrollborderoption['scrollbar_border'];
	
	echo'<input id="border" name="mspmyscrollbarcommon[scrollbar_border]" type="text" value="'.$mspmyscrollbarborderoptions.'" />
	<p class="description">Select scrollbar border style here. Border style should be three part. Make sure you have used correct format. Example: 2px solid #666 or 1px solid red. For more information about border style, <a href="http://www.w3schools.com/css/css_border.asp" target="_blank">Click here</a></p>';
	
}

function msp_scrollbar_radius_callback(){
	
	$mspmyscrollradiusoption = (array)get_option('mspmyscrollbarcommon');
	$mspmyscrollbarradiusoptions = $mspmyscrollradiusoption['scrollbar_radius'];
	
	echo'<input id="radius" name="mspmyscrollbarcommon[scrollbar_radius]" type="text" value="'.$mspmyscrollbarradiusoptions.'" />
	<p class="description">Select scrollbar border radius here. Please use px. Example: 5px</p>';
	
}

function msp_scrollbar_width_callback(){
	
	$mspmyscrollwidthoption = (array)get_option('mspmyscrollbarcommon');
	$mspmyscrollbarwidthoptions = $mspmyscrollwidthoption['scrollbar_width'];
	
	echo'<input id="width" name="mspmyscrollbarcommon[scrollbar_width]" type="text" value="'.$mspmyscrollbarwidthoptions.'" />
	<p class="description">Select scrollbar width here. Please use px. Example: 15px</p>';
	
}

function msp_scrollbar_color_callback(){
	
	$mspmyscrollcoloroption = (array)get_option('mspmyscrollbarcommon');
	$mspmyscrollbarcoloroptions = $mspmyscrollcoloroption['scrollbar_color'];
	
	echo'<input class="my-scrollbar-color-pickr" name="mspmyscrollbarcommon[scrollbar_color]" type="text" value="'.$mspmyscrollbarcoloroptions.'" />
	<p class="description">Select scrollbar color here. You can also add html HEX color code.</p>';
	
}



function msp_my_scrollbar_option_framework(){
	
	add_menu_page('My Scrollbar Options Framework', 'MyScrollbar Option', 'manage_options', 'scrollbar_options', 'msp_my_scrollbar_callback');

}
add_action('admin_menu', 'msp_my_scrollbar_option_framework');


function msp_my_scrollbar_callback(){?>

	<div class="wrap">

		<h2>Plugin Options</h2>
		
		<?php settings_errors(); ?>
		<form action="options.php" method="POST">
		
		<?php do_settings_sections('scrollbar_options'); ?>
		<?php settings_fields('header_section'); ?>
		
		<?php submit_button(); ?>
		
		</form>
	</div>
	
<?php	
}

endif;  // EndIf is_admin()


function msp_my_scrollbar_active() {?>

<?php
	$mspmyscrolloption = (array)get_option('mspmyscrollbarcommon');
	$mspmyscrollbaroptions = $mspmyscrolloption['scrollbar_speed'];
	
	
	$mspmyscrollcoloroption = (array)get_option('mspmyscrollbarcommon');
	$mspmyscrollbarcoloroptions = $mspmyscrollcoloroption['scrollbar_color'];
	
	
	$mspmyscrollwidthoption = (array)get_option('mspmyscrollbarcommon');
	$mspmyscrollbarwidthoptions = $mspmyscrollwidthoption['scrollbar_width'];
	
	
	$mspmyscrollradiusoption = (array)get_option('mspmyscrollbarcommon');
	$mspmyscrollbarradiusoptions = $mspmyscrollradiusoption['scrollbar_radius'];
	
	
	$mspmyscrollborderoption = (array)get_option('mspmyscrollbarcommon');
	$mspmyscrollbarborderoptions = $mspmyscrollborderoption['scrollbar_border'];

	
	$mspmyscrollautohideoption = (array)get_option('mspmyscrollbarcommon');
	$mspmyscrollbarautohideoptions = $mspmyscrollautohideoption['scrollbar_autohide'];
?>	

	
	
<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery("html").niceScroll({
			cursorcolor: "<?php echo $mspmyscrollcoloroption['scrollbar_color']; ?>",
			cursorwidth: "<?php echo $mspmyscrollwidthoption['scrollbar_width']; ?>",
			cursorborderradius: "<?php echo $mspmyscrollradiusoption['scrollbar_radius']; ?>",
			cursorborder: "<?php echo $mspmyscrollborderoption['scrollbar_border']; ?>",
			scrollspeed: "<?php echo $mspmyscrolloption['scrollbar_speed']; ?>",
			
			<?php if($mspmyscrollbarautohideoptions) : ?>
			autohidemode:<?php echo $mspmyscrollautohideoption['scrollbar_autohide']; ?>,
			<?php else : ?>
			autohidemode:false,
			<?php endif; ?>
			
			touchbehavior: false,
			bouncescroll: true,
			horizrailenabled: false
		});           
	});	
</script>
	
<?php
}
add_action('wp_head', 'msp_my_scrollbar_active');




add_action( 'admin_enqueue_scripts', 'mspmy_scrollbar_color_pickr' );
function mspmy_scrollbar_color_pickr( $hook_suffix ) {
    // first check that $hook_suffix is appropriate for your admin page
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'my-script-handle', plugins_url('js/color-pickr.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
}











?>