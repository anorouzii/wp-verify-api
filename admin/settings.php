<?php
function wp_verify_api_settings() {
    add_option( 'wp_verify_api_email_text', 'Your Verification code is :');
    add_option( 'wp_verify_api_code_expire_time', '10');
    add_option( 'wp_verify_api_code_digits', '');

    register_setting( 'wp_verify_api_options_group', 'wp_verify_api_email_text', 'wp_verify_api_callback' );
    register_setting( 'wp_verify_api_options_group', 'wp_verify_api_code_expire_time', 'wp_verify_api_callback' );
    register_setting( 'wp_verify_api_options_group', 'wp_verify_api_code_digits', 'wp_verify_api_callback' );
}
add_action( 'admin_init', 'wp_verify_api_settings' );


function wp_verify_api_register_options_page() {
    add_options_page('WP Verify API', 'WP Verify API', 'manage_options', 'wp_verify_api', 'wp_verify_api_options_page');
}
add_action('admin_menu', 'wp_verify_api_register_options_page');

function wp_verify_api_options_page() { ?>
    <div>
        <?php screen_icon(); ?>
        <h2>WP Verify API</h2>
        <form method="post" action="options.php">
            <?php settings_fields( 'wp_verify_api_options_group' ); ?>
            <p>Generate and check verification code by WP API</p>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><label for="wp_verify_api_email_text">Email Text</label></th>
                    <td><input placeholder="Default : Your Verification code is : " class="regular-text" type="text" id="wp_verify_api_email_text" name="wp_verify_api_email_text" value="<?php echo get_option('wp_verify_api_email_text'); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="wp_verify_api_code_expire_time">Code Expire Time</label></th>
                    <td><input min="1" class="regular-text" placeholder="Exp : 2 for two minutes " type="number" id="wp_verify_api_code_expire_time" name="wp_verify_api_code_expire_time" value="<?php echo get_option('wp_verify_api_code_expire_time'); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="wp_verify_api_code_digits">Code digits</label></th>
                    <td><input min="3" max="9" class="regular-text" placeholder="Between 3 - 9" type="number" id="wp_verify_api_code_digits" name="wp_verify_api_code_digits" value="<?php echo get_option('wp_verify_api_code_digits'); ?>" /></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
} ?>