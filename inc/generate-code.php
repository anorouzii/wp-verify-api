<?php
$expire_time = get_option('wp_verify_api_code_expire_time');
$code_digits = get_option('wp_verify_api_code_digits');

// Create random code and save it into the database
function wva_generate_code ($for) {
    global $expire_time, $code_digits;
    $otp_code = '';
    if ($code_digits) {
        switch ($code_digits) {
            case 3:
                $otp_code = rand(100,999);
                break;
            case 4:
                $otp_code = rand(1000,9999);
                break;
            case 5:
                $otp_code = rand(10000,99999);
                break;
            case 6:
                $otp_code = rand(100000,999999);
                break;
            case 7:
                $otp_code = rand(1000000,9999999);
                break;
            case 8:
                $otp_code = rand(10000000,99999999);
                break;
            case 9:
                $otp_code = rand(100000000,999999999);
                break;
            default:
                $otp_code = rand(10000,99999);
        }
    } else {
        $otp_code = rand(10000,99999);
    }

    global $wpdb;
    $table_name = $wpdb->prefix . 'wp_verify_api';
    $wpdb->insert(
        $table_name,
        array(
            'time' => current_time( 'mysql' ),
            'email' => $for,
            'OTPcode' => $otp_code,
            'expire' => current_time('timestamp') + $expire_time * 60 // $expire_time will be added to the current timestamp
        )
    );
    wva_send_email($for,$otp_code);
    return $otp_code;
}