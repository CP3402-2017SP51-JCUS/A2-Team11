<?php
/**
 * shopaholic hooks
 *
 * @package shopaholic
 */

/**
 * Header
 * @see  storefront_skip_links()
 * @see  storefront_secondary_navigation()
 * @see  storefront_site_branding()
 * @see  storefront_primary_navigation()
 */

add_action( 'shopaholic_header_top', 		'shopaholic_secondary_navigation',	10 );
add_action( 'shopaholic_header_top',		'shopaholic_social_media_links',		15 );

add_action( 'shopaholic_header_links', 		'storefront_skip_links', 		0 );
add_action( 'shopaholic_header_logo', 		'shopaholic_site_branding',			20 );

add_action( 'shopaholic_header_nav', 		'storefront_primary_navigation',50 );

add_action( 'shopaholic_slider', 			'shopaholic_featured_slider',			60 );

add_action( 'shopaholic_title', 			'shopaholic_inner_title',				10 );


/**
 * Posts
 * @see  storefront_post_meta()
 * @see  storefront_post_content()
 */
add_action( 'shopaholic_single_post',		'storefront_post_content',		20 );

add_action( 'shopaholic_blog_index_thumb',	'shopaholic_post_thumb',				10 );
add_action( 'shopaholic_blog_index_header',	'shopaholic_post_header',				10 );
add_action( 'shopaholic_blog_index_content',	'shopaholic_post_content',			10 );

add_action( 'shopaholic_blog_post_content',	'shopaholic_post_meta',			10 );

/**
 * Pages
 * @see  storefront_page_content()
 */
add_action( 'shopaholic_page', 			'storefront_page_content',		10 );

/**
 * Footer
 * @see  storefront_footer_widgets()
 * @see  storefront_credit()
 */
add_action( 'shopaholic_footer_widgets', 'storefront_footer_widgets',	10 );
add_action( 'shopaholic_credit_area', 'shopaholic_credit',			20 );