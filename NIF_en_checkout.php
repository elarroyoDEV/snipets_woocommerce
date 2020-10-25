<?php
/**
 * Añadir casilla NIF en el checkout
 *
 * @param array $fields the fields on the checkout.
 * @return $fields
 */
function woo_custom_field_checkout( $fields ) {
  $fields['billing']['billing_nifcif'] = array(
    'type'        => 'text',
    'class'       => array( 'my-field-class form-row-wide' ),
    'required'    => false,
    'label'       => __( 'NIF / CIF', 'text-domain' ),
    'default'     => get_user_meta( get_current_user_id(), 'billing_nifcif', true ),
    'placeholder' => __( 'Ej: 12345678X', 'text-domain' ),
    'priority'    => 35,
  );
  return $fields;
}

add_filter( 'woocommerce_checkout_fields', 'woo_custom_field_checkout' );

