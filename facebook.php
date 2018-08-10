<?php
/*
Plugin Name: Responsive Facebook Like Box 
Plugin URI: https://www.freewebmentor.com/2013/10/facebook-like-box-wordpress.html
Description: This plugin helps you create a simple widgets for facebook like box in WordPress.
Version: 2.2.4
Author: Prem Tiwari
Author URI: https://www.freewebmentor.com
License: GPL2
*/
error_reporting(1);
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

/* Constant Declaration */
define('fm_notification_bar', 'FM Notification Bar');
define('fm_notification_bar_version', '1.0.0');
define("PAGE_URL", "fm-notification-bar");

if (is_admin()) {
    include_once('admin/settings.php');
    include_once('includes/widgets.php');
}

$fmnb_options = get_option('fmnb_settings');

add_action('admin_head', 'fm_extra_fee_style');
add_action('wp_head', 'fm_notification_bar_style');

function fm_extra_fee_style() {
    if(PAGE_URL==$_REQUEST['page']){
        wp_enqueue_style('fm_admin_style',plugins_url("css/admin.css",__FILE__));    
    }
}

function fm_notification_bar_style() {
    wp_enqueue_style('fm_font_awesome','');
    wp_enqueue_style('fm_notification_bar_style',plugins_url("css/style.css",__FILE__));
}

// Add notification bar to the front-end
function fm_notification_bar() {
  global $fmnb_options;
  $fm_enabled = $fmnb_options['fm_enabled'];
  $fm_notification_message = $fmnb_options['fm_notification_message'];
  $fm_button_label = $fmnb_options['fm_button_label'];
  $fm_hyperlink = $fmnb_options['fm_hyperlink'];
  $fm_background_color = $fmnb_options['fm_background_color'];
  if($fm_enabled==1){
?>
<label for="notify-2">
   <input id="notify-2" type="checkbox">
   <i class="fa fa-long-arrow-down"></i>
   <div id="notification-bar" style="background: <?php echo $fm_background_color;?>">
      <div class="container">
         <i class="fa fa-times-circle"></i>
         <p></i><?php echo $fm_notification_message;?>
         </p>
         <a href="<?php echo $fm_hyperlink;?>" target="_blank"> <button ><?php echo $fm_button_label;?></button></a>
      </div>
   </div>
</label>
<?php } }

add_action( 'wp_head', 'fm_notification_bar' );