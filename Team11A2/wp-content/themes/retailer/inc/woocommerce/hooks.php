<?php
/**
 * Retailer WooCommerce hooks
 *
 * @package retailer
 */


/**
 * Header
 * @see  storefront_header_cart()
 */
add_action( 'retailer_header_nav', 'storefront_header_cart', 		60 );


add_action( 'retailer_breadcrumb', 				'woocommerce_breadcrumb', 					10 );
add_action( 'retailer_shop_messages', 			'storefront_shop_messages', 				10 );