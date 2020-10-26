<?php
/**
 * Unset some payment gateways by user.
 * Standard are bacs, cheque, cod and paypal (also there is redsys, stripe, ...)
 */

if ( ! defined( PARTNER_ROLE ) ) {
	define( 'PARTNER_ROLE', 'distribuidor' );
}

add_filter( 'woocommerce_available_payment_gateways', 'woo_disable_payments' );

/**
 * Disable gateways if user is not distribuidor.
 *
 * @param array $available_gateways The gateways set to ON in admin.
 *
 * @return array $available_gateways
 */
function woo_disable_payments( $available_gateways ) {
	$user = wp_get_current_user();
		
	if ( ! in_array( PARTNER_ROLE, (array) $user->roles ) ) {
		if ( isset( $available_gateways['cod'] ) ) {
			unset( $available_gateways['cod'] );
		} 
		if ( isset( $available_gateways['bacs'] ) ) {
			unset( $available_gateways['bacs'] );
		} 
	}
	return $available_gateways;
	
}
