<?php
/**
 * Registers all block assets so that they can be enqueued through Gutenberg in
 * the corresponding context.
 *
 */
function rflb_block_responsive_facebook_like_box() {
	wp_enqueue_script(
		'rflb-block-backend-script',
		plugins_url( 'block.js', __FILE__ ),
		array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor' ),
		filemtime( plugin_dir_path( __FILE__ ) . 'block.js' )
	);
}

add_action( 'enqueue_block_editor_assets', 'rflb_block_responsive_facebook_like_box' );
