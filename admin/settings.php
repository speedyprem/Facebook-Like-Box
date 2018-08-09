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
    ?>
    <div>   
        <h2 class="smsb_pluginheader"><?php _e("Responsive Facebook Like Box - Settings", fm_notification_bar); ?></h2>      
        <?php _e("<p>You are using Wordpress: " . $wp_version . " and Fee Version of Facebook Like Box: " . fm_notification_bar_version . "</p>", fm_notification_bar); ?>

       <div class="w3-sidebar w3-bar-block w3-light-grey w3-card" style="width:200px">
  <button class="w3-bar-item w3-button tablink active w3-red" onclick="openCity(event, 'London')">London</button>
  <button class="w3-bar-item w3-button tablink" onclick="openCity(event, 'Paris')">Paris</button>
  <button class="w3-bar-item w3-button tablink" onclick="openCity(event, 'Tokyo')">Tokyo</button>
</div>

<div style="float: left;">
  <div id="London" class="w3-container city">
    <h2>London</h2>
    <p>London is the capital city of England.</p>
    <p>It is the most populous city in the United Kingdom, with a metropolitan area of over 13 million inhabitants.</p>
  </div>

  <div id="Paris" class="w3-container city" style="display:none">
    <h2>Paris</h2>
    <p>Paris is the capital of France.</p> 
    <p>The Paris area is one of the largest population centers in Europe, with more than 12 million inhabitants.</p>
  </div>

  <div id="Tokyo" class="w3-container city" style="display:none">
    <h2>Tokyo</h2>
    <p>Tokyo is the capital of Japan.</p>
    <p>It is the center of the Greater Tokyo Area, and the most populous metropolitan area in the world.</p>
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
