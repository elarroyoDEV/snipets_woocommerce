<?php

/**
 * Add a diferent tax for user role.
 * Must create a new taxes on tax editor with the same name but including _RE.
 */

if ( ! defined( IRPF_SURCHARGE ) ) {
	define( 'RE_TAX_CLASS', 'Recargo' );
	define( 'RE_ROLE', 'customer_re' );
}

add_filter( 'woocommerce_product_get_tax_class', 'woo_re_tax', 1, 2 );

/**
 * Change the product tax.
 */
function woo_re_tax( $tax_class, $product ) {

	$user = wp_get_current_user();
		
	if ( in_array( RE_ROLE, (array) $user->roles ) ) {
		$tax_class = $tax_class . '_RE';
	}
	
 	return $tax_class;
}
