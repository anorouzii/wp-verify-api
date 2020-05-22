<?php

/***** Email Address ******/

function wva_generate_code_api(WP_REST_Request $request) {
    $email = $request['email'];
    $code = wva_generate_code($email);

    $response = new WP_REST_Response('Verification code sent to your email address');
    $response->set_status(200);
    return $response;
}
add_action('rest_api_init', function () {
    register_rest_route('wva/v1', '/email', array(
        'methods' => 'POST',
        'callback' => 'wva_generate_code_api',
    ));
});


/***** Verification code ******/

function wva_verify_code_api(WP_REST_Request $request) {
    $verify = $request['verify'];
    $email = $request['email'];
    $verify_status = verify_code($verify,$email);

    $response = new WP_REST_Response($verify_status);
    $response->set_status(200);
    return $response;
}
add_action('rest_api_init', function () {
    register_rest_route('wva/v1', '/verify', array(
        'methods' => 'POST',
        'callback' => 'wva_verify_code_api',
    ));
});
