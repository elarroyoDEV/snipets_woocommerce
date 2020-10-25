<?php
/**
 * The file include all functions with hooks and actions for add a custom NIF/CIF field.
 * It puts a field on checkout, save to order, shows on admin order and on email.
 *
 * @link       https://elarroyo.dev
 * @since      1.0.0
 *
 * @package    ElArroyoSnippets
 * @subpackage ElArroyoSnippets/WooCommerce
 */

add_filter( 'woocommerce_checkout_fields', 'woo_custom_field_checkout' );
add_action( 'woocommerce_checkout_update_order_meta', 'woo_custom_field_checkout_update_order' );
add_action( 'woocommerce_admin_order_data_after_billing_address', 'woo_custom_field_checkout_edit_order', 10, 1 );
add_filter( 'woocommerce_email_order_meta_keys', 'woo_custom_field_checkout_email' );

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

/**
 * Incluye NIF/CIF en los detalles del pedido
 *
 * @param int $order_id el número de pedido.
 * @return void
 */
function woo_custom_field_checkout_update_order( $order_id ) {
	if ( ! empty( filter_input( INPUT_POST, 'billing_nifcif', FILTER_SANITIZE_SPECIAL_CHARS ) ) ) {
		update_post_meta( $order_id, 'NIF/CIF', sanitize_text_field( filter_input( INPUT_POST, 'billing_nifcif', FILTER_SANITIZE_SPECIAL_CHARS ) ) );
	}
}

/**
 * Muestra el valor del campo NIF/CIF en la página del pedido
 *
 * @param WC_Order $order el objeto del pedido.
 * @return void
 */
public function woo_custom_field_checkout_edit_order( $order ) {
	$nif_cif = get_post_meta( $order->id, 'NIF/CIF', true );
	echo '<p><strong>' . esc_html__( 'NIF/CIF', 'cl-enuc-theme-plugin' ) . ':</strong> ' . wp_kses( $nif_cif ) . '</p>';
}

/**
 * Incluye el campo NIF/CIF en el correo electrónico de aviso al cliente
 *
 * @param array $keys el array con los campos.
 * @return $keys
 */
public function woo_custom_field_checkout_email( $keys ) {
	$keys[] = 'NIF/CIF';
	return $keys;
}


