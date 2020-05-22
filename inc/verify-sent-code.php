<?php
function verify_code($code,$email) {
    global $wpdb;
    $timestamp = current_time('timestamp');
    $table_name = $wpdb->prefix . 'wp_verify_api';
    $count = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $table_name WHERE OTPcode = '$code' AND email ='$email' AND expire >= '$timestamp'"));
    if($count == 1){ return true; }else{ return false; }
}