<?php
/**
 * This file is for function to a new default gateway.
 */

add_action( 'template_redirect', 'woo_define_default_payment_gateway' );

/**
 * This function checks if is checkout and sets the chosen payment method by role.
 *
 * @return void
 */
function woo_define_default_payment_gateway(){
    $user             = wp_get_current_user();
    $role_for_gateway = 'customer'; //change to your role.
    if( is_checkout() && ! is_wc_endpoint_url() && in_array( $role_for_gateway, (array) $user->roles ) ) {
        // HERE define the default payment gateway ID
        $default_payment_id = 'stripe';
        WC()->session->set( 'chosen_payment_method', $default_payment_id );
    }
}
