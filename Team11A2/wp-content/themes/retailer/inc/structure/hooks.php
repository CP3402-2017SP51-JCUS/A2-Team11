<?php
/**
 * retailer hooks
 *
 * @package retailer
 */


/**
 * General
 * @see  storefront_scripts()
 */

add_action( 'after_setup_theme',			'retailer_theme_setup' );
add_action( 'wp_enqueue_scripts',			'retailer_scripts');
add_action(	'wp_print_styles', 				'retailer_google_fonts');

/**
 * Header
 * @see  storefront_skip_links()
 * @see  storefront_secondary_navigation()
 * @see  storefront_site_branding()
 * @see  storefront_primary_navigation()
 */

add_action( 'retailer_header_top', 'retailer_social_media_links',		10 );
add_action( 'retailer_header_top', 'retailer_secondary_navigation',		15 );

add_action( 'retailer_skip_links', 'storefront_skip_links', 		0 );
add_action( 'retailer_header_logo', 'retailer_site_branding',			20 );

add_action( 'retailer_header_nav', 'storefront_primary_navigation',	50 );

add_action( 'retailer_slider', 'retailer_featured_slider',	60 );

add_action( 'retailer_title', 'retailer_inner_title',	10 );

/**
 * Homepage
 * @see  storefront_homepage_content()
 * @see  storefront_product_categories()
 * @see  storefront_recent_products()
 * @see  storefront_featured_products()
 * @see  storefront_popular_products()
 * @see  storefront_on_sale_products()
 */
add_action( 'retailer_homepage', 'storefront_homepage_content',		10 );
add_action( 'retailer_homepage', 'storefront_product_categories',	20 );
add_action( 'retailer_homepage', 'storefront_recent_products',		30 );
add_action( 'retailer_homepage', 'storefront_featured_products',	40 );
add_action( 'retailer_homepage', 'storefront_popular_products',		50 );
add_action( 'retailer_homepage', 'storefront_on_sale_products',		60 );

/**
 * Posts
 * @see  storefront_post_meta()
 * @see  storefront_post_content()
 */
add_action( 'retailer_single_post',		'storefront_post_meta',			10 );
add_action( 'retailer_single_post',		'storefront_post_content',		20 );

add_action( 'retailer_blog_index_thumb',	'retailer_post_thumb',				10 );
add_action( 'retailer_blog_index_header',	'retailer_post_header',				10 );
add_action( 'retailer_blog_index_content',	'retailer_post_content',			10 );

/**
 * Pages
 * @see  storefront_page_content()
 */
add_action( 'retailer_page', 			'storefront_page_content',		10 );

/**
 * Footer
 * @see  storefront_footer_widgets()
 * @see  storefront_credit()
 */
add_action( 'retailer_footer_widgets', 'storefront_footer_widgets',	10 );
add_action( 'retailer_credit_area', 'retailer_credit',			20 );