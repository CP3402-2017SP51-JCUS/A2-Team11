<?php
/**
 * Shopaholic Customizer Class
 *
 * @author   WooThemes
 * @package  storefront
 * @since    2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Shopaholic_Customizer' ) ) :

	/**
	 * The Shopaholic Customizer class
	 */
	class Shopaholic_Customizer {

		/**
		 * Setup class.
		 *
		 * @since 1.0
		 */
		public function __construct() {
			add_action( 'customize_preview_init',          array( $this, 'customize_preview_js' ) );
			add_action( 'customize_register',              array( $this, 'edit_default_controls' ) );
			add_filter( 'storefront_setting_default_values', array( $this, 'get_shopaholic_defaults' ) );
			add_action( 'wp_enqueue_scripts',              array( $this, 'add_customizer_css' ) );
      add_action( 'customize_register',	array( $this, 'edit_default_customizer_settings' ),			99 );
		add_action( 'init',					array( $this, 'default_theme_mod_values' )					);
		}

    /**
  	 * Returns an array of the desired default Storefront options
  	 * @return array
  	 */
  	public function get_shopaholic_defaults() {
  		return apply_filters( 'shopaholic_default_settings', $args = array(
        'storefront_header_background_color'  => '#ffffff',
        'storefront_header_link_color'        => '#595959',
        'storefront_header_text_color'        => '#318553',
        'storefront_footer_background_color'  => '#444444',
        'storefront_footer_link_color'        => '#318553',
        'storefront_footer_heading_color'     => '#ffffff',
        'storefront_footer_text_color'        => '#ffffff',
        'storefront_text_color'               => '#60646c',
        'storefront_heading_color'            => '#484c51',
        'storefront_button_background_color'  => '#318553',
        'storefront_button_text_color'        => '#ffffff',
        'storefront_button_alt_background_color' => '#318553',
        'storefront_button_alt_text_color'       => '#ffffff',
				'storefront_accent_color'                => '#318553',
        'background_color'                       => '#efefef',
  		) );
  	}

    /**
	 * Set default Customizer settings based on Storechild design.
	 * @uses get_shopaholic_defaults()
	 * @return void
	 */
	public function edit_default_customizer_settings( $wp_customize ) {
		foreach ( Shopaholic_Customizer::get_shopaholic_defaults() as $mod => $val ) {
			$setting = $wp_customize->get_setting( $mod );

			if ( is_object( $setting ) ) {
				$setting->default = $val;
			}
		}
	}

	/**
	 * Returns a default theme_mod value if there is none set.
	 * @uses get_shopaholic_defaults()
	 * @return void
	 */
	public function default_theme_mod_values() {
		foreach ( Shopaholic_Customizer::get_shopaholic_defaults() as $mod => $val ) {
			add_filter( 'theme_mod_' . $mod, function( $setting ) use ( $val ) {
				return $setting ? $setting : $val;
			});
		}
	}

		/**
		 * Add postMessage support for site title and description for the Theme Customizer along with several other settings.
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 * @since  1.0.0
		 */
		public function edit_default_controls( $wp_customize ) {

      $wp_customize->add_section( 'shopaholic_slider_section' , array(
	      'title'       => __( 'Slider Options', 'shopaholic' ),
	      'priority'    => 33,
	      'description' => __( '', 'shopaholic' ),
	    ) );
	    
	    $wp_customize->add_setting( 'shopaholic_slider_area', array(
	      'default' => 'recent',
	      'sanitize_callback' => 'sanitize_text_field',
	    ));
	    
	    $wp_customize->add_control( 'effect_select_box', array(
	      'settings' => 'shopaholic_slider_area',
	      'label' => __( 'What products to show:', 'shopaholic' ),
	      'section' => 'shopaholic_slider_section',
	      'type' => 'select',
	      'choices' => array(
	        'featured' => 'Featured Products',
	        'total_sales' => 'Best Selling Products',
	        'recent' => 'Recent Products',
	        'top_rated' => 'Top Rated Products',
	        'sale' => 'On Sale Products',
	      ),
	      'priority' => 12,
	    ));

	    $wp_customize->add_setting( 'shopaholic_slider_num_show', array (
	    	'default' => 5,
      		'sanitize_callback' => 'shopaholic_check_number',
	    ) );
	    
	    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'shopaholic_slider_num_show', array(
	      'label'    => __( 'Products show at most', 'shopaholic' ),
	      'section'  => 'shopaholic_slider_section',
	      'settings' => 'shopaholic_slider_num_show',
	      'priority'    => 10,
	    ) ) );


		/**
		 * Social Media Icons
		 */
	    $wp_customize->add_section( 'shopaholic_social_section' , array(
	      'title'       => __( 'Social Media Icons', 'shopaholic' ),
	      'priority'    => 42,
	      'description' => __( 'Optional media icons in the header', 'shopaholic' ),
	    ) );
	    
	    $wp_customize->add_setting( 'shopaholic_facebook', array (
      		'sanitize_callback' => 'esc_url_raw',
	    ) );
	    
	    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'shopaholic_facebook', array(
	      'label'    => __( 'Enter your Facebook url', 'shopaholic' ),
	      'section'  => 'shopaholic_social_section',
	      'settings' => 'shopaholic_facebook',
	      'priority'    => 101,
	    ) ) );
	  
	    $wp_customize->add_setting( 'shopaholic_twitter', array (
	      'sanitize_callback' => 'esc_url_raw',
	    ) );
	    
	    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'shopaholic_twitter', array(
	      'label'    => __( 'Enter your Twitter url', 'shopaholic' ),
	      'section'  => 'shopaholic_social_section',
	      'settings' => 'shopaholic_twitter',
	      'priority'    => 102,
	    ) ) );
	    
	    $wp_customize->add_setting( 'shopaholic_google', array (
	      'sanitize_callback' => 'esc_url_raw',
	    ) );
	    
	    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'shopaholic_google', array(
	      'label'    => __( 'Enter your Google+ url', 'shopaholic' ),
	      'section'  => 'shopaholic_social_section',
	      'settings' => 'shopaholic_google',
	      'priority'    => 103,
	    ) ) );
	    
	    $wp_customize->add_setting( 'shopaholic_pinterest', array (
	      'sanitize_callback' => 'esc_url_raw',
	    ) );
	    
	    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'shopaholic_pinterest', array(
	      'label'    => __( 'Enter your Pinterest url', 'shopaholic' ),
	      'section'  => 'shopaholic_social_section',
	      'settings' => 'shopaholic_pinterest',
	      'priority'    => 104,
	    ) ) );
	    
	    $wp_customize->add_setting( 'shopaholic_linkedin', array (
	      'sanitize_callback' => 'esc_url_raw',
	    ) );
	    
	    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'shopaholic_linkedin', array(
	      'label'    => __( 'Enter your Linkedin url', 'shopaholic' ),
	      'section'  => 'shopaholic_social_section',
	      'settings' => 'shopaholic_linkedin',
	      'priority'    => 105,
	    ) ) );
	    
	    $wp_customize->add_setting( 'shopaholic_youtube', array (
	      'sanitize_callback' => 'esc_url_raw',
	    ) );
	    
	    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'shopaholic_youtube', array(
	      'label'    => __( 'Enter your Youtube url', 'shopaholic' ),
	      'section'  => 'shopaholic_social_section',
	      'settings' => 'shopaholic_youtube',
	      'priority'    => 106,
	    ) ) );
	    
	    $wp_customize->add_setting( 'shopaholic_tumblr', array (
	      'sanitize_callback' => 'esc_url_raw',
	    ) );
	    
	    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'shopaholic_tumblr', array(
	      'label'    => __( 'Enter your Tumblr url', 'shopaholic' ),
	      'section'  => 'shopaholic_social_section',
	      'settings' => 'shopaholic_tumblr',
	      'priority'    => 107,
	    ) ) );
	    
	    $wp_customize->add_setting( 'shopaholic_instagram', array (
	      'sanitize_callback' => 'esc_url_raw',
	    ) );
	    
	    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'shopaholic_instagram', array(
	      'label'    => __( 'Enter your Instagram url', 'shopaholic' ),
	      'section'  => 'shopaholic_social_section',
	      'settings' => 'shopaholic_instagram',
	      'priority'    => 108,
	    ) ) );
	    
	    $wp_customize->add_setting( 'shopaholic_flickr', array (
	      'sanitize_callback' => 'esc_url_raw',
	    ) );
	    
	    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'shopaholic_flickr', array(
	      'label'    => __( 'Enter your Flickr url', 'shopaholic' ),
	      'section'  => 'shopaholic_social_section',
	      'settings' => 'shopaholic_flickr',
	      'priority'    => 109,
	    ) ) );
	    
	    $wp_customize->add_setting( 'shopaholic_vimeo', array (
	      'sanitize_callback' => 'esc_url_raw',
	    ) );
	    
	    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'shopaholic_vimeo', array(
	      'label'    => __( 'Enter your Vimeo url', 'shopaholic' ),
	      'section'  => 'shopaholic_social_section',
	      'settings' => 'shopaholic_vimeo',
	      'priority'    => 110,
	    ) ) );
	    
	    $wp_customize->add_setting( 'shopaholic_rss', array (
	      'sanitize_callback' => 'esc_url_raw',
	    ) );
	    
	    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'shopaholic_rss', array(
	      'label'    => __( 'Enter your RSS url', 'shopaholic' ),
	      'section'  => 'shopaholic_social_section',
	      'settings' => 'shopaholic_rss',
	      'priority'    => 112,
	    ) ) );


		}



		/**
		 * Add CSS in <head> for styles handled by the theme customizer
		 * If the Customizer is active pull in the raw css. Otherwise pull in the prepared theme_mods.
		 *
		 * @since 1.0.0
		 * @return void
		 */
		public function add_customizer_css() {
    $shopaholic_accent_color 					= get_theme_mod( 'storefront_accent_color' );
		$shopaholic_header_background_color 		= get_theme_mod( 'storefront_header_background_color' );
		$shopaholic_header_link_color 				= get_theme_mod( 'storefront_header_link_color' );
		$shopaholic_header_text_color 				= get_theme_mod( 'storefront_header_text_color' );

		$shopaholic_footer_background_color 		= get_theme_mod( 'storefront_footer_background_color' );
		$shopaholic_footer_link_color 				= get_theme_mod( 'storefront_footer_link_color' );
		$shopaholic_footer_heading_color 			= get_theme_mod( 'storefront_footer_heading_color' );
		$shopaholic_footer_text_color 				= get_theme_mod( 'storefront_footer_text_color' );

		$shopaholic_text_color 					= get_theme_mod( 'storefront_text_color' );
		$shopaholic_heading_color 					= get_theme_mod( 'storefront_heading_color' );
		$shopaholic_button_background_color 		= get_theme_mod( 'storefront_button_background_color' );
		$shopaholic_button_text_color 				= get_theme_mod( 'storefront_button_text_color' );
		$shopaholic_button_alt_background_color 	= get_theme_mod( 'storefront_button_alt_background_color' );
		$shopaholic_button_alt_text_color 			= get_theme_mod( 'storefront_button_alt_text_color' );

		$shopaholic_brighten_factor 				= 25;
		$shopaholic_darken_factor 					= -25;

		$style 							= '
    header.site-header .col-full{
			background-color: ' . $shopaholic_header_background_color . ';
		}
		#banner-area .product-slider .banner-product-details .price,
		.storefront-product-section .section-title,
		ul.products li.product .price,
		.title-holder .inner-title h1,
		.cart-collaterals h2,
		header .second-nav ul li a:hover,
		header .second-nav ul li a:focus,
		header .social-media .social-tw:hover,
		header .social-media .social-tw:focus,
		.site-main .columns-3 ul.products li.product:hover .cat-details h3{
			color: ' . $shopaholic_accent_color . ';
		}
		#banner-area .flex-control-paging li a.flex-active,
		ul.products li.product .onsale,
		.woocommerce-info, 
		.woocommerce-noreviews, 
		p.no-comments,
		article .post-content-area .more-link,
		.woocommerce-error, 
		.woocommerce-info, 
		.woocommerce-message, 
		.woocommerce-noreviews, 
		p.no-comments{
			background-color: ' . $shopaholic_accent_color . '!important;
		}

		.main-navigation ul li a,
		.site-title a,
    .site-branding h1 a,
		ul.menu li a,
		.site-branding p.site-title a,
		header .second-nav ul li a,
		header .social-media .social-tw .fa {
			color: ' . $shopaholic_header_link_color . ';
		}
    

		.main-navigation ul li a:hover,
		.site-title a:hover {
			color: ' . storefront_adjust_color_brightness( $shopaholic_header_link_color, $shopaholic_darken_factor ) . ';
		}

		p.site-description,
		ul.menu li.current-menu-item > a {
			color: ' . $shopaholic_header_text_color . ';
		}

		h1, h2, h3, h4, h5, h6 {
			color: ' . $shopaholic_heading_color . ';
		}

		.hentry .entry-header {
			border-color: ' . $shopaholic_heading_color . ';
		}

		.widget h1 {
			border-bottom-color: ' . $shopaholic_heading_color . ';
		}

		body,
		.secondary-navigation a,
		.widget-area .widget a,
		.onsale,
		#comments .comment-list .reply a,
		.pagination .page-numbers li .page-numbers:not(.current), .woocommerce-pagination .page-numbers li .page-numbers:not(.current) {
			color: ' . $shopaholic_text_color . ';
		}

		a  {
			color: ' . $shopaholic_accent_color . ';
		}

		a:focus,
		.button:focus,
		.button.alt:focus,
		.button.added_to_cart:focus,
		.button.wc-forward:focus,
		button:focus,
		input[type="button"]:focus,
		input[type="reset"]:focus,
		input[type="submit"]:focus {
			outline-color: ' . $shopaholic_accent_color . ';
		}

		button, input[type="button"], input[type="reset"], input[type="submit"], .button, .added_to_cart, .widget-area .widget a.button, .site-header-cart .widget_shopping_cart a.button {
			background-color: ' . $shopaholic_button_background_color . ';
			border-color: ' . $shopaholic_button_background_color . ';
			color: ' . $shopaholic_button_text_color . ';
		}

		button:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover, .button:hover, .added_to_cart:hover, .widget-area .widget a.button:hover, .site-header-cart .widget_shopping_cart a.button:hover {
			background-color: ' . storefront_adjust_color_brightness( $shopaholic_button_background_color, $shopaholic_darken_factor ) . ';
			border-color: ' . storefront_adjust_color_brightness( $shopaholic_button_background_color, $shopaholic_darken_factor ) . ';
			color: ' . $shopaholic_button_text_color . ';
		}

		button.alt, input[type="button"].alt, input[type="reset"].alt, input[type="submit"].alt, .button.alt, .added_to_cart.alt, .widget-area .widget a.button.alt, .added_to_cart, .pagination .page-numbers li .page-numbers.current, .woocommerce-pagination .page-numbers li .page-numbers.current {
			background-color: ' . $shopaholic_button_alt_background_color . ';
			border-color: ' . $shopaholic_button_alt_background_color . ';
			color: ' . $shopaholic_button_alt_text_color . ';
		}

		button.alt:hover, input[type="button"].alt:hover, input[type="reset"].alt:hover, input[type="submit"].alt:hover, .button.alt:hover, .added_to_cart.alt:hover, .widget-area .widget a.button.alt:hover, .added_to_cart:hover {
			background-color: ' . storefront_adjust_color_brightness( $shopaholic_button_alt_background_color, $shopaholic_darken_factor ) . ';
			border-color: ' . storefront_adjust_color_brightness( $shopaholic_button_alt_background_color, $shopaholic_darken_factor ) . ';
			color: ' . $shopaholic_button_alt_text_color . ';
		}

		.site-footer.col-full {
			background-color: ' . $shopaholic_footer_background_color . ';
			color: ' . $shopaholic_footer_text_color . ';
		}

		.site-footer a:not(.button) {
			color: ' . $shopaholic_footer_link_color . ';
		}

		.site-footer h1, .site-footer h2, .site-footer h3, .site-footer h4, .site-footer h5, .site-footer h6 {
			color: ' . $shopaholic_footer_heading_color . ';
		}

		a.cart-contents:hover,
		.site-header-cart .widget_shopping_cart a:hover {
			color: ' . $shopaholic_accent_color . '!important;
		}

		@media screen and ( min-width: 768px ) {
			.main-navigation ul.menu > li > ul {
				border-top-color: ' . $shopaholic_header_background_color . '}
			}

			.secondary-navigation ul.menu a:hover {
				color: ' . storefront_adjust_color_brightness( $shopaholic_header_text_color, $shopaholic_brighten_factor ) . ';
			}

			.main-navigation ul.menu ul {
				background-color: ' . $shopaholic_header_background_color . ';
			}

			.secondary-navigation ul.menu a {
				color: ' . $shopaholic_header_text_color . ';
			}
		}';

		$shopaholic_woocommerce_style 							= '
		a.cart-contents,
		.site-header-cart .widget_shopping_cart a {
			color: ' . $shopaholic_header_link_color . ';
		}

		a.cart-contents:hover,
		.site-header-cart .widget_shopping_cart a:hover {
			color: ' . $shopaholic_accent_color . ';
		}

		.site-header-cart .widget_shopping_cart {
			background-color: ' . $shopaholic_header_background_color . ';
		}

		.woocommerce-tabs ul.tabs li.active a,
		ul.products li.product .price,
		.onsale {
			color: ' . $shopaholic_text_color . ';
		}

		.onsale {
			border-color: ' . $shopaholic_text_color . ';
		}

		.star-rating span:before,
		.product_list_widget a:hover,
		.quantity .plus, .quantity .minus,
		p.stars a:hover:after,
		p.stars a:after,
		.star-rating span:before {
			color: ' . $shopaholic_accent_color . '!important;
		}

		.widget_price_filter .ui-slider .ui-slider-range,
		.widget_price_filter .ui-slider .ui-slider-handle {
			background-color: ' . $shopaholic_accent_color . ';
		}

		#order_review_heading, #order_review {
			border-color: ' . $shopaholic_accent_color . ';
		}

		@media screen and ( min-width: 768px ) {
			.site-header-cart .widget_shopping_cart,
			.site-header .product_list_widget li .quantity {
				color: ' . $shopaholic_header_text_color . ';
			}
		}

		';

		wp_add_inline_style( 'storefront-child-style', $style );
    wp_add_inline_style( 'storefront-woocommerce-style', $shopaholic_woocommerce_style );
		}

		/**
		 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
		 *
		 * @since  1.0.0
		 */
		public function customize_preview_js() {
			wp_enqueue_script( 'shopaholic-customizer', get_stylesheet_directory_uri() . '/assets/js/customizer/customizer.min.js', array( 'customize-preview' ), '1.16', true );
		}

	}

endif;

return new Shopaholic_Customizer();