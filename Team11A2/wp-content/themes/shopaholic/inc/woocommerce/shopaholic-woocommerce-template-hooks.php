<?php
/**
 * Shopaholic WooCommerce hooks
 *
 * @package shopaholic
 */


/**
 * Header
 * @see  storefront_header_cart()
 */
add_action( 'shopaholic_header_nav', 		'storefront_header_cart', 		60 );


add_action( 'shopaholic_breadcrumb',		'woocommerce_breadcrumb', 		10 );
add_action( 'shopaholic_shop_messages', 	'storefront_shop_messages', 	10 );