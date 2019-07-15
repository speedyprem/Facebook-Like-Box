<?php
/*
Plugin Name: Responsive Like Box
Plugin URI: https://www.freewebmentor.com/2013/10/facebook-like-box-wordpress.html
Description: This plugin helps you create a simple widgets for facebook like box in WordPress.
Version: 3.0.0
Author: Prem Tiwari
Author URI: https://www.freewebmentor.com
License: GPL2
*/


//include shortcode feature file
include_once( plugin_dir_path( __FILE__ ) . 'inc/shortcode.php' );

class ResponsiveFacebookLikeBox extends WP_Widget {
	function __construct() {
		parent::__construct(
			'themater_facebook',
			'&raquo; Facebook Like Box',
			array(
				'description' => ( 'Facebook Like Box social widget. Enables Facebook Page owners to attract and gain Likes from their own website.' )
			) );
	}

	function widget( $args, $instance ) {
		$title       = apply_filters( 'widget_title', $instance['title'] );
		$url         = $instance['url'];
		$colorscheme = $instance['colorscheme'];
		$show_faces  = $instance['show_faces'] == 'true' ? 'true' : 'false';
		$stream      = $instance['stream'] == 'true' ? 'true' : 'false';
		$header      = $instance['header'] == 'true' ? 'true' : 'false';
		$border      = $instance['border'];
		?>

		<?php if ( $title ) { ?> <h3 class="widgettitle"><?php echo $title; ?></h3> <?php } ?>
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
		<div class="fb-like-box" data-href="<?php echo $url; ?>"
			 data-colorscheme="<?php echo $colorscheme; ?>"
			 data-show-faces="<?php echo $show_faces; ?>"
			 data-stream="<?php echo $stream; ?>"
			 data-header="<?php echo $header; ?>"
			 data-border-color="<?php echo $border; ?>">
		</div>

		<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance                = $old_instance;
		$instance['title']       = strip_tags( $new_instance['title'] );
		$instance['url']         = strip_tags( $new_instance['url'] );
		$instance['colorscheme'] = strip_tags( $new_instance['colorscheme'] );
		$instance['show_faces']  = strip_tags( $new_instance['show_faces'] );
		$instance['stream']      = strip_tags( $new_instance['stream'] );
		$instance['header']      = strip_tags( $new_instance['header'] );
		$instance['border']      = strip_tags( $new_instance['border'] );

		return $instance;
	}

	function form( $instance ) {
		global $theme;
		$instance = wp_parse_args( (array) $instance, $theme->options['widgets_options']['facebook'] );
		?>

		<div class="widget">
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title: </label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>"
					   name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" placeholder="e.g: Follow us"
					   value="<?php echo esc_attr( $instance['title'] ); ?>"/>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'url' ); ?>">Page URL:</label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'url' ); ?>"
					   name="<?php echo $this->get_field_name( 'url' ); ?>" type="text"
					   placeholder="e.g: https://www.facebook.com/freewebmentor/"
					   value="<?php echo esc_attr( $instance['url'] ); ?>"/>
			</p>
			<p>
				<b>Advance Options:</b>
			</p>
			<p>
				<select name="<?php echo $this->get_field_name( 'colorscheme' ); ?>" style="width: 80px;">
					<option value="light" <?php selected( 'alignleft', $instance['colorscheme'] ); ?> >Light</option>
					<option value="dark" <?php selected( 'alignright', $instance['colorscheme'] ); ?>>Dark</option>
				</select>
				<label for="<?php echo $this->get_field_id( 'colorscheme' ); ?>">Color Scheme</label>
			</p>
			<p>
				<input type="text" style="width: 80px;" name="<?php echo $this->get_field_name( 'border' ); ?>"
					   placeholder="e.g: #ffffff" value="<?php echo esc_attr( $instance['border'] ); ?>"/>
				<label for="<?php echo $this->get_field_id( 'colorscheme' ); ?>">Border Color</label>
			</p>
			<p>
				<input type="checkbox"
					   name="<?php echo $this->get_field_name( 'show_faces' ); ?>" <?php checked( 'true', $instance['show_faces'] ); ?>
					   value="true"/> <?php _e( 'Show Faces', 'themater' ); ?>
				<br/><input type="checkbox"
							name="<?php echo $this->get_field_name( 'stream' ); ?>" <?php checked( 'true', $instance['stream'] ); ?>
							value="true"/> <?php _e( 'Show Stream', 'themater' ); ?>
				<br/><input type="checkbox"
							name="<?php echo $this->get_field_name( 'header' ); ?>" <?php checked( 'true', $instance['header'] ); ?>
							value="true"/> <?php _e( 'Show Header', 'themater' ); ?>
			</p>
		</div>
		<?php
	}
}

add_action( 'widgets_init', function () {
	return register_widget( "ResponsiveFacebookLikeBox" );
} );
