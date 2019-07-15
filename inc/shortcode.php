<?php
/**
 * Added shortcode to include facebook like box inside the posts, pages, and custom post types.
 */
function button_shortcode() {
	echo '<a href="http://twitter.com/thepremtiwari" class="twitter-button">Follow me on Twitter!</a>';
}

add_shortcode( "button", "button_shortcode" );
