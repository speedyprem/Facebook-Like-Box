<?php
/**
 * FM Facebook Like Box settings page.
 * @author Prem Tiwari
 */
require_once 'functions.php';

add_action('admin_menu', 'fm_notification_bar_settings');

function fm_notification_bar_settings() {
    add_options_page('WordPress Facebook Like Box Setting', 'Facebook Like Box', 'manage_options', 'fm-notification-bar', 'fm_notification_bar_init');
}

function fm_notification_bar_init() {
    global $fmnb_options;
    global $wp_version;
    $page_url = $_REQUEST['page'];
    ?>

    <div>               
        <br>
        <div class="w3-sidebar w3-bar-block w3-light-grey w3-card">
            <a class="plugin-logo" href="https://www.freewebmentor.com/2013/10/facebook-like-box-wordpress.html" target="_blank">
                <img src="<?php echo plugins_url('../img/plugin-logo.png', __FILE__) ?>">
            </a>

            <a class="w3-bar-item w3-button tablink active w3-red" onclick="openCity(event, 'rflb-flb')">Facebook Like Box</a>
            <a class="w3-bar-item w3-button tablink" onclick="openCity(event, 'Settings')">Settings</a>
            <a href="https://wordpress.org/support/plugin/responsive-facebook-like-box/" target="_blank" class="w3-bar-item w3-button">Ask For Help</a>
        </div>
        <?php echo '<div style="width:71.5%;margin-left:208px;" class="updated notice notice-success is-dismissible"><p>Setting updated.</p></div>'; ?>
        <div class="rflb-context-box">
            <div id="rflb-flb" class="w3-container city">
                <h2>Facebook Like Box</h2>
                <p>London is the capital city of England.</p>
                <p>It is the most populous city in the United Kingdom, with a metropolitan area of over 13 million inhabitants  Kingdom, with a metropolitan area of over 13 million inhabitants  Kingdom, with a metropolitan area of over 13 million inhabitants Kingdom, with a metropolitan area of over 13 million inhabitants Kingdom, with a metropolitan area of over 13 million inhabitants.</p>
            </div>
            <div id="Settings" class="w3-container city" style="display:none">
                <h2>Settings</h2>
                <form action="" method="POST" class="w3-container">
                    <label for="db_settings">Want to delete table at uninstall?</label>
                    <select id="db_settings" class="w3-select w3-border" name="db_settings">
                        <option value="yes"<?php if (get_rflb_settings('db_settings') == "yes"): ?> selected="selected"<?php endif; ?>>Yes</option>
                        <option value="no"<?php if (get_rflb_settings('db_settings') == "no"): ?> selected="selected"<?php endif; ?>>No</option>
                    </select>
                    <input type="submit" name="save_settings" class="w3-btn w3-blue" value="Submit">
                </form>
            </div>
        </div>
        <script>
            function openCity(evt, cityName) {
                var i, x, tablinks;
                x = document.getElementsByClassName("city");
                for (i = 0; i < x.length; i++) {
                    x[i].style.display = "none";
                }
                tablinks = document.getElementsByClassName("tablink");
                for (i = 0; i < x.length; i++) {
                    tablinks[i].className = tablinks[i].className.replace(" w3-red", "");
                }
                document.getElementById(cityName).style.display = "block";
                evt.currentTarget.className += " w3-red";
            }
        </script>

    </form>                    
    </div>
    <?php
// Update plugin settings
    if (isset($_REQUEST['save_settings'])) {
        // set the variables
        if ($_POST['db_settings']) {
            $db_settings = $_POST['db_settings'];
        }
        //update in option table
        global $wpdb;
        $data = array('meta_key' => 'db_settings', 'meta_value' => $db_settings);
        $where = array('meta_key' => 'db_settings');
        $wpdb->update('fwm_facebook_like_box', $data, $where);
        //need to print message here

        wp_redirect(wp_get_referer());
    }
}

function fm_notification_bar_register_settings() {
    register_setting('fm_settings_group', 'fmnb_settings');
}

add_action('admin_init', 'fm_notification_bar_register_settings');
