<?php
/**
 * Add a IRPF surcharge to your cart / checkout
 */

if ( ! defined( IRPF_SURCHARGE ) ) {
  define( 'IRPF_SURCHARGE', -15 );
	define( 'IRPF_ROLE', 'customer_autonomo' );
}

add_action( 'woocommerce_cart_calculate_fees','woo_irpf_surcharge' );

/**
 * Add a IRPF surcharge to your cart / checkout based on user role
 */
function woo_irpf_surcharge() {

	$user = wp_get_current_user();
		
	if ( in_array( IRPF_ROLE, (array) $user->roles ) ) {
		WC()->cart->add_fee( 'Surcharge', IRPF_SURCHARGE, true, '' );
	}
 
}
