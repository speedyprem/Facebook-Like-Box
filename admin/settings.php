<?php
/**
 * FM Facebook Like Box settings page.
 * @author Prem Tiwari
 */
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
                <img src="<?php echo plugins_url('../img/plugin-logo.png', __FILE__)?>">
            </a>

            <a class="w3-bar-item w3-button tablink active w3-red" onclick="openCity(event, 'rflb-flb')">Facebook Like Box</a>
            <a class="w3-bar-item w3-button tablink" onclick="openCity(event, 'Settings')">Settings</a>
            <a href="https://wordpress.org/support/plugin/responsive-facebook-like-box/" target="_blank" class="w3-bar-item w3-button">Ask For Help</a>
        </div>

        <div class="rflb-context-box">
            <div id="rflb-flb" class="w3-container city">
                <h2>Facebook Like Box</h2>
                <p>London is the capital city of England.</p>
                <p>It is the most populous city in the United Kingdom, with a metropolitan area of over 13 million inhabitants  Kingdom, with a metropolitan area of over 13 million inhabitants  Kingdom, with a metropolitan area of over 13 million inhabitants Kingdom, with a metropolitan area of over 13 million inhabitants Kingdom, with a metropolitan area of over 13 million inhabitants.</p>
            </div>

            <div id="Settings" class="w3-container city" style="display:none">
                <h2>Settings</h2>
                  <form action="">
                    <label for="country">Delete table at uninstall </label>
                    <select id="country" class="w3-select w3-border" name="country">
                      <option value="australia">Enable</option>
                      <option value="canada">Disable</option>
                    </select> <input type="submit" class="w3-btn w3-blue" value="Submit">
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

        <p>&nbsp;</p>
        <!-- <p><input type="submit" name="Submit" class="button-primary" value="<?php _e("Save Changes", fm_notification_bar); ?>"></p> -->
    </form>                    
    </div>
    <?php
}

function fm_notification_bar_register_settings() {
    register_setting('fm_settings_group', 'fmnb_settings');
}

add_action('admin_init', 'fm_notification_bar_register_settings');
