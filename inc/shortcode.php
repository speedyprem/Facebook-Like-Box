<?php
/**
 * Added shortcode to include facebook like box inside the posts, pages, and custom post types.
 */

class RflbShortcode {
	public function __construct() {
		if ( ! is_admin() ) {
			add_shortcode( 'responsive-facebook-like-box', array( $this, 'rflb_shortcode' ) );
		}
	}

	/**
	 * rflb_shortcode function added facebook like box for all singular pages.
	 */
	public function rflb_shortcode() {
		if ( is_singular() ) {
			$widget_themater_facebook = get_option( 'widget_themater_facebook', true );
		?>
		<div id="fb-root"></div>
		<script>(function (d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) {
                    return;
                }
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>
		<div class="fb-like-box" data-href="<?php echo $widget_themater_facebook[2]['url']; ?>"
			 data-show-faces="<?php echo $widget_themater_facebook[2]['show_faces']; ?>"
			 data-stream="<?php echo $widget_themater_facebook[2]['stream']; ?>"
			 data-colorscheme="<?php echo $widget_themater_facebook[2]['colorscheme']; ?>"
			 data-header="<?php echo $widget_themater_facebook[2]['header']; ?>">
		</div>
	<?php } }

}

$RflbShortcodeObj = new RflbShortcode();
