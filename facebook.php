<?php
/*
Plugin Name: Responsive Facebook Like Box
Plugin URI: https://www.freewebmentor.com/2013/10/facebook-like-box-wordpress.html
Description: This plugin helps you create a simple widgets for facebook like box in WordPress.
Version: 2.2.6
Author: Prem Tiwari
Author URI: https://www.freewebmentor.com
License: GPL2
*/
$themater_facebook_defaults = array(
    'title' => 'Facebook',
    'url' => 'https://www.facebook.com/freewebmentor',
    'colorscheme' => 'light',
    'show_faces' => 'true',
    'stream' => 'false',
    'header' => 'false',
    'border' => '#ffffff'
);

$theme->options['widgets_options']['facebook'] =  isset( $theme->options['widgets_options']['facebook'] )
    ? array_merge($themater_facebook_defaults, $theme->options['widgets_options']['facebook'])
    : $themater_facebook_defaults;


add_action( 'widgets_init', function () {
    return register_widget("ThematerFacebook");
} );

class ThematerFacebook extends WP_Widget
{
    function __construct()
    {
        parent::__construct(
            'themater_facebook',
            '&raquo; Facebook Like Box',
            array( 'description' => ('Facebook Like Box social widget enables 
            facebook page owners to attract & gain likes from their website.')
            )
        );
    }

    function widget( $args, $instance )
    {
        global $wpdb, $theme;
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
        $url = $instance['url'];
        $colorscheme = $instance['colorscheme'];
        $show_faces = $instance['show_faces'] == 'true' ? 'true' : 'false';
        $stream = $instance['stream'] == 'true' ? 'true' : 'false';
        $header = $instance['header'] == 'true' ? 'true' : 'false';
        $border = $instance['border'];
        ?>

        <?php  if ( $title ) {  ?> <h3 class="widgettitle"><?php echo $title; ?></h3> <?php }  ?>
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) {return;}
                js = d.createElement(s); js.id = id;
                js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>
        <div class="fb-like-box" data-href="<?php echo $url; ?>" data-width="" data-height="" data-colorscheme="<?php echo $colorscheme; ?>" data-show-faces="<?php echo $show_faces; ?>" data-stream="<?php echo $stream; ?>" data-header="<?php echo $header; ?>" data-border-color="<?php echo $border; ?>"></div>

        <?php
    }
    /**
     * Update the $old_instance values with $new_instance in widgets
     */
    function update( $new_instance, $old_instance )
    {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['url'] = strip_tags($new_instance['url']);
        $instance['width'] = strip_tags($new_instance['width']);
        $instance['height'] = strip_tags($new_instance['height']);
        $instance['colorscheme'] = strip_tags($new_instance['colorscheme']);
        $instance['show_faces'] = strip_tags($new_instance['show_faces']);
        $instance['stream'] = strip_tags($new_instance['stream']);
        $instance['header'] = strip_tags($new_instance['header']);
        $instance['border'] = strip_tags($new_instance['border']);
        return $instance;
    }

    function form($instance)
    {
        global $theme;
        $instance = wp_parse_args((array) $instance, $theme->options['widgets_options']['facebook']);
        ?>
        <div class="tt-widget">
            <table width="100%">
                <tr>
                    <td class="tt-widget-label" width="30%"><label for="<?php echo $this->get_field_id('title'); ?>">Title:</label></td>
                    <td class="tt-widget-content" width="70%"><input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" /></td>
                </tr>
                <tr>
                    <td class="tt-widget-label"><label for="<?php echo $this->get_field_id('url'); ?>">Facebook Page URL:</label></td>
                    <td class="tt-widget-content"><input class="widefat" id="<?php echo $this->get_field_id('url'); ?>" name="<?php echo $this->get_field_name('url'); ?>" type="text" value="<?php echo esc_attr($instance['url']); ?>" /></td>
                </tr>
                <tr> 
                    <td class="tt-widget-label">Color Scheme:</td>
                    <td class="tt-widget-content">
                        <select name="<?php echo $this->get_field_name('colorscheme'); ?>">
                            <option value="light" <?php selected('alignleft', $instance['colorscheme']); ?> >Light</option>
                            <option value="dark"  <?php selected('alignright', $instance['colorscheme']); ?>>Dark</option>
                        </select>
                        &nbsp; &nbsp; Border Color: <input type="text" style="width: 50px;" name="<?php echo $this->get_field_name('border'); ?>" value="<?php echo esc_attr($instance['border']); ?>" /> <em>e.g: #ffffff</em>
                    </td>
                </tr>
                <tr>
                    <td class="tt-widget-label">Misc Options:</td>
                    <td class="tt-widget-content">
                        <input type="checkbox" name="<?php echo $this->get_field_name('show_faces'); ?>"  <?php checked('true', $instance['show_faces']); ?> value="true" />  <?php _e('Show Faces', 'themater'); ?>
                        <br /><input type="checkbox" name="<?php echo $this->get_field_name('stream'); ?>"  <?php checked('true', $instance['stream']); ?> value="true" />  <?php _e('Show Stream', 'themater'); ?>
                        <br /><input type="checkbox" name="<?php echo $this->get_field_name('header'); ?>"  <?php checked('true', $instance['header']); ?> value="true" />  <?php _e('Show Header', 'themater'); ?>
                    </td>
                </tr>
            </table>
        </div>
        <?php
    }
}
