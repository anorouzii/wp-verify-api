<?php
$email_text = get_option('wp_verify_api_email_text');
$expire_time = get_option('wp_verify_api_code_expire_time');

function wva_send_email($to,$code) {
    global $email_text,$expire_time;
    $subject = "Your verification code";
    $site_name = get_site_url();
    $find = array( 'http://', 'https://' );
    $replace = '';
    $domain = str_replace( $find, $replace, $site_name );
	$domain_upc = ucfirst($domain);
	$min_text = ($expire_time == 1) ? "minute" : "minutes";
    $message = '
    <table style="padding: 40px 0 30px;background-color: #fafafa;width: 100%;text-align: center;font-family: Roboto,RobotoDraft,Helvetica,Arial,sans-serif;">
    <tbody style="padding: 60px 15px 120px;border: 1px solid #ededed;border-top:6px solid #3f45ba;background: #fff;max-width: 800px;border-radius: 5px;display: block;margin: 0 auto;">
    <tr style="width: 100%;display: block;">
        <th style="width: 100%;display: block;font-weight: 400;font-size: 21px;">'.$email_text.'</th>
    </tr>
    <tr style="width: 100%;display: block;">
        <td style="width: 100%;display: block;"><p style="font-weight: 900;letter-spacing: 17px;font-size: 42px;">
            '.$code.'</p></td>
    </tr>
    <tr style="width: 100%;display: block;">
        <td style="width: 100%;display: block;opacity: .8">This code is valid only for '.$expire_time.' '.$min_text.'</td>
    </tr>
    </tbody>
    </table>
    ';
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From:'.$domain_upc.' <noreply@'.$domain.'>' . "\r\n";
    wp_mail($to,$subject,$message,$headers);
}