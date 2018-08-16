<?php

/*
 * Contains the set of functions for different purposes
 */

//get settings
function get_rflb_settings($meta_key) {
    global $wpdb;
    $table_name = $wpdb->prefix . "facebook_like_box";
    $sql = "SELECT meta_value FROM $table_name WHERE meta_key = 'db_settings'";
    $fivesdrafts = $wpdb->get_results($sql, ARRAY_A);
    return $fivesdrafts[0]['meta_value'];
}
