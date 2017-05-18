<?php
/**
 * Retailer Customizer Class
 *
 * @author   WooThemes
 * @package  storefront
 * @since    2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

error_reporting(0);

if ( ! class_exists( 'Retailer_Customizer' ) ) :

	/**
	 * The Retailer Customizer class
	 */
	class Retailer_Customizer {

		/**
		 * Setup class.
		 *
		 * @since 1.0
		 */
		public function __construct() {
			add_action( 'customize_preview_init',          array( $this, 'customize_preview_js' ), 10 );
			add_action( 'customize_register',              array( $this, 'customize_register' ), 10 );
			add_filter( 'storefront_setting_default_values', array( $this, 'get_retailer_defaults' ) );
			add_action( 'wp_enqueue_scripts',              array( $this, 'add_customizer_css' ), 1000 );
      	add_action( 'customize_register',	array( $this, 'edit_default_customizer_settings' ),			99 );
		add_action( 'init',					array( $this, 'default_theme_mod_values' )					);
		}

    /**
  	 * Returns an array of the desired default Storefront options
  	 * @return array
  	 */
     public function get_retailer_defaults() {
   		return apply_filters( 'retailer_default_settings', $args = array(
         'retailer_header_top_background_color'    => '#221E1D',
         'retailer_header_top_text_color'          => '#ffffff',
         'storefront_header_background_color'  => '#ffffff',
         'storefront_header_link_color'        => '#221e1d',
         'storefront_header_text_color'        => '#d24032',
         'storefront_footer_background_color'  => '#4d5256',
         'storefront_footer_link_color'        => '#ffffff',
         'storefront_footer_heading_color'     => '#ffffff',
         'storefront_footer_text_color'        => '#ffffff',
         'retailer_footer_credits_background_color'=> '#E1E5EE',
         'retailer_footer_credits_text_color'=> '#221E1D',
         'storefront_text_color'               => '#221E1D',
         'storefront_heading_color'            => '#484c51',
         'storefront_button_background_color'  => '#d24032',
         'storefront_button_text_color'        => '#ffffff',
         'storefront_button_alt_background_color' => '#8a65c5',
         'storefront_button_alt_text_color'       => '#ffffff',
 				 'storefront_accent_color'                => '#d24032',
         'retailer_alt_accent_color'              => '#8A65C5',
 
   		) );
   	}

    /**
	 * Set default Customizer settings based on Storechild design.
	 * @uses get_retailer_defaults()
	 * @return void
	 */
	public function edit_default_customizer_settings( $wp_customize ) {
		foreach ( Retailer_Customizer::get_retailer_defaults() as $mod => $val ) {
			$setting = $wp_customize->get_setting( $mod );

			if ( is_object( $setting ) ) {
				$setting->default = $val;
			}
		}
	}

	/**
	 * Returns a default theme_mod value if there is none set.
	 * @uses get_retailer_defaults()
	 * @return void
	 */
	public function default_theme_mod_values() {
		foreach ( Retailer_Customizer::get_retailer_defaults() as $mod => $val ) {
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
		public function customize_register( $wp_customize ) {

      /**
		 * Header Top Background
		 */
		$wp_customize->add_setting( 'retailer_header_top_background_color', array(
			'default'           => apply_filters( 'retailer_default_header_top_background_color', '#221E1D' ),
			'sanitize_callback' => 'storefront_sanitize_hex_color',
			'transport'			=> 'postMessage',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'retailer_header_top_background_color', array(
			'label'	   => __( 'Top Background color', 'retailer' ),
			'section'  => 'header_image',
			'settings' => 'retailer_header_top_background_color',
			'priority' => 10,
		) ) );

		/**
		 * Header Top text color
		 */
		$wp_customize->add_setting( 'retailer_header_top_text_color', array(
			'default'           => apply_filters( 'retailer_default_header_top_text_color', '#ffffff' ),
			'sanitize_callback' => 'storefront_sanitize_hex_color',
			'transport'			=> 'postMessage',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'retailer_header_top_text_color', array(
			'label'	   => __( 'Top Text color', 'retailer' ),
			'section'  => 'header_image',
			'settings' => 'retailer_header_top_text_color',
			'priority' => 12,
		) ) );

		$wp_customize->add_section( 'retailer_slider_section' , array(
	      'title'       => __( 'Slider Options', 'retailer' ),
	      'priority'    => 33,
	      'description' => __( '', 'retailer' ),
	    ) );
	    
	    $wp_customize->add_setting( 'retailer_slider_area', array(
	      'default' => 'recent',
	      'sanitize_callback' => 'sanitize_text_field',
	    ));
	    
	    $wp_customize->add_control( 'effect_select_box', array(
	      'settings' => 'retailer_slider_area',
	      'label' => __( 'What products to show:', 'retailer' ),
	      'section' => 'retailer_slider_section',
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

	    $wp_customize->add_setting( 'retailer_auto_scroll_setting', array(
	      'default' => 'false',
	      'sanitize_callback' => 'sanitize_text_field',
	    ));
	    
	    $wp_customize->add_control( 'retailer_auto_scroll_setting', array(
	      'settings' => 'retailer_auto_scroll_setting',
	      'label' => __( 'Enable/Disable slide auto-scroll:', 'retailer' ),
	      'section' => 'retailer_slider_section',
	      'type' => 'select',
	      'choices' => array(
	        'false' => 'False',
	        'true' => 'True',
	      ),
	      'priority' => 12,
	    ));

	    $wp_customize->add_setting( 'retailer_slider_num_show', array (
	    	'default' => 5,
      		'sanitize_callback' => 'retailer_check_number',
	    ) );
	    
	    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'retailer_slider_num_show', array(
	      'label'    => __( 'Products show at most', 'retailer' ),
	      'section'  => 'retailer_slider_section',
	      'settings' => 'retailer_slider_num_show',
	      'priority'    => 10,
	    ) ) );

	    /**
		 * Typography Background
		 */
		$wp_customize->add_setting( 'retailer_alt_accent_color', array(
			'default'           => apply_filters( 'retailer_default_alt_accent_color', '#8A65C5' ),
			'sanitize_callback' => 'storefront_sanitize_hex_color',
			'transport'			=> 'postMessage',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'retailer_alt_accent_color', array(
			'label'	   => __( 'Link / accent color (alternative)', 'retailer' ),
			'section'  => 'storefront_typography',
			'settings' => 'retailer_alt_accent_color',
			'priority' => 25,
		) ) );


		/**
		 * Footer Background
		 */
		$wp_customize->add_setting( 'retailer_footer_credits_background_color', array(
			'default'           => apply_filters( 'retailer_default_footer_credits_background_color', '#E1E5EE' ),
			'sanitize_callback' => 'storefront_sanitize_hex_color',
			'transport'			=> 'postMessage',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'retailer_footer_credits_background_color', array(
			'label'	   => __( 'Credits Background color', 'retailer' ),
			'section'  => 'storefront_footer',
			'settings' => 'retailer_footer_credits_background_color',
			'priority' => 50,
		) ) );
		$wp_customize->add_setting( 'retailer_footer_credits_text_color', array(
			'default'           => apply_filters( 'retailer_default_footer_credits_text_color', '#221E1D' ),
			'sanitize_callback' => 'storefront_sanitize_hex_color',
			'transport'			=> 'postMessage',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'retailer_footer_credits_text_color', array(
			'label'	   => __( 'Credits Text color', 'retailer' ),
			'section'  => 'storefront_footer',
			'settings' => 'retailer_footer_credits_text_color',
			'priority' => 50,
		) ) );

		/**
		 * Social Media Icons
		 */
	    $wp_customize->add_section( 'retailer_social_section' , array(
	      'title'       => __( 'Social Media Icons', 'retailer' ),
	      'priority'    => 42,
	      'description' => __( 'Optional media icons in the header', 'retailer' ),
	    ) );
	    
	    $wp_customize->add_setting( 'retailer_facebook', array (
      		'sanitize_callback' => 'esc_url_raw',
	    ) );
	    
	    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'retailer_facebook', array(
	      'label'    => __( 'Enter your Facebook url', 'retailer' ),
	      'section'  => 'retailer_social_section',
	      'settings' => 'retailer_facebook',
	      'priority'    => 101,
	    ) ) );
	  
	    $wp_customize->add_setting( 'retailer_twitter', array (
	      'sanitize_callback' => 'esc_url_raw',
	    ) );
	    
	    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'retailer_twitter', array(
	      'label'    => __( 'Enter your Twitter url', 'retailer' ),
	      'section'  => 'retailer_social_section',
	      'settings' => 'retailer_twitter',
	      'priority'    => 102,
	    ) ) );
	    
	    $wp_customize->add_setting( 'retailer_google', array (
	      'sanitize_callback' => 'esc_url_raw',
	    ) );
	    
	    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'retailer_google', array(
	      'label'    => __( 'Enter your Google+ url', 'retailer' ),
	      'section'  => 'retailer_social_section',
	      'settings' => 'retailer_google',
	      'priority'    => 103,
	    ) ) );
	    
	    $wp_customize->add_setting( 'retailer_pinterest', array (
	      'sanitize_callback' => 'esc_url_raw',
	    ) );
	    
	    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'retailer_pinterest', array(
	      'label'    => __( 'Enter your Pinterest url', 'retailer' ),
	      'section'  => 'retailer_social_section',
	      'settings' => 'retailer_pinterest',
	      'priority'    => 104,
	    ) ) );
	    
	    $wp_customize->add_setting( 'retailer_linkedin', array (
	      'sanitize_callback' => 'esc_url_raw',
	    ) );
	    
	    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'retailer_linkedin', array(
	      'label'    => __( 'Enter your Linkedin url', 'retailer' ),
	      'section'  => 'retailer_social_section',
	      'settings' => 'retailer_linkedin',
	      'priority'    => 105,
	    ) ) );
	    
	    $wp_customize->add_setting( 'retailer_youtube', array (
	      'sanitize_callback' => 'esc_url_raw',
	    ) );
	    
	    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'retailer_youtube', array(
	      'label'    => __( 'Enter your Youtube url', 'retailer' ),
	      'section'  => 'retailer_social_section',
	      'settings' => 'retailer_youtube',
	      'priority'    => 106,
	    ) ) );
	    
	    $wp_customize->add_setting( 'retailer_tumblr', array (
	      'sanitize_callback' => 'esc_url_raw',
	    ) );
	    
	    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'retailer_tumblr', array(
	      'label'    => __( 'Enter your Tumblr url', 'retailer' ),
	      'section'  => 'retailer_social_section',
	      'settings' => 'retailer_tumblr',
	      'priority'    => 107,
	    ) ) );
	    
	    $wp_customize->add_setting( 'retailer_instagram', array (
	      'sanitize_callback' => 'esc_url_raw',
	    ) );
	    
	    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'retailer_instagram', array(
	      'label'    => __( 'Enter your Instagram url', 'retailer' ),
	      'section'  => 'retailer_social_section',
	      'settings' => 'retailer_instagram',
	      'priority'    => 108,
	    ) ) );
	    
	    $wp_customize->add_setting( 'retailer_flickr', array (
	      'sanitize_callback' => 'esc_url_raw',
	    ) );
	    
	    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'retailer_flickr', array(
	      'label'    => __( 'Enter your Flickr url', 'retailer' ),
	      'section'  => 'retailer_social_section',
	      'settings' => 'retailer_flickr',
	      'priority'    => 109,
	    ) ) );
	    
	    $wp_customize->add_setting( 'retailer_vimeo', array (
	      'sanitize_callback' => 'esc_url_raw',
	    ) );
	    
	    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'retailer_vimeo', array(
	      'label'    => __( 'Enter your Vimeo url', 'retailer' ),
	      'section'  => 'retailer_social_section',
	      'settings' => 'retailer_vimeo',
	      'priority'    => 110,
	    ) ) );
	    
	    $wp_customize->add_setting( 'retailer_rss', array (
	      'sanitize_callback' => 'esc_url_raw',
	    ) );
	    
	    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'retailer_rss', array(
	      'label'    => __( 'Enter your RSS url', 'retailer' ),
	      'section'  => 'retailer_social_section',
	      'settings' => 'retailer_rss',
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
    $accent_color 					= get_theme_mod( 'storefront_accent_color' );
		$header_top_background_color 	= get_theme_mod( 'retailer_header_top_background_color' );
		$header_top_text_color 			= get_theme_mod( 'retailer_header_top_text_color' );
		$header_background_color 		= get_theme_mod( 'storefront_header_background_color' );
		$header_link_color 				= get_theme_mod( 'storefront_header_link_color' );
		$header_text_color 				= get_theme_mod( 'storefront_header_text_color' );

		$footer_background_color 		= get_theme_mod( 'storefront_footer_background_color' );
		$footer_link_color 				= get_theme_mod( 'storefront_footer_link_color' );
		$footer_heading_color 			= get_theme_mod( 'storefront_footer_heading_color' );
		$footer_text_color 				= get_theme_mod( 'storefront_footer_text_color' );
		$credits_background_color 		= get_theme_mod( 'retailer_footer_credits_background_color' );
    $credits_text_color           = get_theme_mod( 'retailer_footer_credits_text_color' );

		$text_color 					= get_theme_mod( 'storefront_text_color' );
		$heading_color 					= get_theme_mod( 'storefront_heading_color' );
		$button_background_color 		= get_theme_mod( 'storefront_button_background_color' );
		$button_text_color 				= get_theme_mod( 'storefront_button_text_color' );
		$button_alt_background_color 	= get_theme_mod( 'storefront_button_alt_background_color' );
		$button_alt_text_color 			= get_theme_mod( 'storefront_button_alt_text_color' );
    $alt_accent_color           = get_theme_mod( 'retailer_alt_accent_color' );

		$brighten_factor 				= 25;
		$darken_factor 					= -25;

		$style 							= '
    header .top-area{
			background-color: ' . $header_top_background_color . ';
			color: ' . $header_top_text_color . ';
		}
		header .social-media .social-tw,
		header .second-nav ul li a{
			color: ' . $header_top_text_color . ';
		}
		#banner-area .product-slider .banner-product-details .price,
		.storefront-product-section .section-title,
		ul.products li.product .price,
		.cart-collaterals h2,
		.main-navigation ul.menu > li.current_page_item > a, 
		.main-navigation ul.nav-menu > li.current_page_item > a,
		.main-navigation ul li a:hover,
		.main-navigation ul li a:focus,
		header .second-nav ul li a:hover,
		header .second-nav ul li a:focus,
		header .social-media .social-tw:hover,
		header .social-media .social-tw:focus,
		.site-main .columns-3 ul.products li.product:hover .cat-details h3{
			color: ' . $accent_color . '!important;
		}
		#banner-area .flex-control-paging li a.flex-active,
		.woocommerce-info, 
		.woocommerce-noreviews, 
		p.no-comments,
		.woocommerce-error, 
		.woocommerce-info, 
		.woocommerce-message, 
		.woocommerce-noreviews, 
		p.no-comments{
			background-color: ' . $accent_color . '!important;
		}
		article .post-content-area .more-link{
			background-color: ' . $button_alt_background_color . '!important;
		}
		.site-footer .credits-area{
			background-color: ' . $credits_background_color . ';
		}

		ul.products li.product .onsale{
			color: ' . $alt_accent_color . ';
		}

		.main-navigation ul li a,
		.site-title a,
		ul.menu li a,
		.site-branding p.site-title a {
			color: ' . $header_link_color . ';
		}

		.main-navigation ul li a:hover,
		.site-title a:hover {
			color: ' . storefront_adjust_color_brightness( $header_link_color, $darken_factor ) . ';
		}

		.site-header,
		.main-navigation ul ul,
		.secondary-navigation ul ul,
		.main-navigation ul.menu > li.menu-item-has-children:after,
		.secondary-navigation ul.menu ul,
		.main-navigation ul.menu ul,
		.main-navigation ul.nav-menu ul {
			background-color: ' . $header_background_color . ';
		}

		p.site-description,
		ul.menu li.current-menu-item > a {
			color: ' . $header_text_color . ';
		}

		h1, h2, h3, h4, h5, h6 {
			color: ' . $heading_color . ';
		}

		.hentry .entry-header {
			border-color: ' . $heading_color . ';
		}

		.widget h1 {
			border-bottom-color: ' . $heading_color . ';
		}

		body,
		.secondary-navigation a,
		.widget-area .widget a,
		.onsale,
		#comments .comment-list .reply a,
		.pagination .page-numbers li .page-numbers:not(.current), .woocommerce-pagination .page-numbers li .page-numbers:not(.current) {
			color: ' . $text_color . ';
		}

		a  {
			color: ' . $accent_color . ';
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
			outline-color: ' . $accent_color . ';
		}

		#banner-area .product-slider .banner-product-image .onsale {
		    border-color: ' . $accent_color . ';
		    color: ' . $accent_color . ';
		}
		#banner-area .product-slider .banner-product-details h3{
			color: ' . $accent_color . ';
		}

		button, input[type="button"], input[type="reset"], input[type="submit"], .button, .added_to_cart, .widget-area .widget a.button, .site-header-cart .widget_shopping_cart a.button {
			background-color: ' . $button_background_color . ';
			border-color: ' . $button_background_color . ';
			color: ' . $button_text_color . ';
		}

		button:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover, .button:hover, .added_to_cart:hover, .widget-area .widget a.button:hover, .site-header-cart .widget_shopping_cart a.button:hover {
			background-color: ' . storefront_adjust_color_brightness( $button_background_color, $darken_factor ) . ';
			border-color: ' . storefront_adjust_color_brightness( $button_background_color, $darken_factor ) . ';
			color: ' . $button_text_color . ';
		}

		button.alt, input[type="button"].alt, input[type="reset"].alt, input[type="submit"].alt, .button.alt, .added_to_cart.alt, .widget-area .widget a.button.alt, .added_to_cart, .pagination .page-numbers li .page-numbers.current, .woocommerce-pagination .page-numbers li .page-numbers.current {
			background-color: ' . $button_alt_background_color . ';
			border-color: ' . $button_alt_background_color . ';
			color: ' . $button_alt_text_color . ';
		}

		button.alt:hover, input[type="button"].alt:hover, input[type="reset"].alt:hover, input[type="submit"].alt:hover, .button.alt:hover, .added_to_cart.alt:hover, .widget-area .widget a.button.alt:hover, .added_to_cart:hover {
			background-color: ' . storefront_adjust_color_brightness( $button_alt_background_color, $darken_factor ) . ';
			border-color: ' . storefront_adjust_color_brightness( $button_alt_background_color, $darken_factor ) . ';
			color: ' . $button_alt_text_color . ';
		}

		.site-footer {
			background-color: ' . $footer_background_color . ';
			color: ' . $footer_text_color . ';
		}

		.site-footer a:not(.button) {
			color: ' . $footer_link_color . ';
		}

		.site-footer h1, .site-footer h2, .site-footer h3, .site-footer h4, .site-footer h5, .site-footer h6 {
			color: ' . $footer_heading_color . ';
		}
		.site-footer .credits-area,.site-footer .credits-area a{
			color: ' . $credits_text_color . ';
		}

		@media screen and ( min-width: 768px ) {
			.main-navigation ul.menu > li > ul {
				border-top-color: ' . $header_background_color . '}
			}

			.secondary-navigation ul.menu a:hover {
				color: ' . storefront_adjust_color_brightness( $header_text_color, $brighten_factor ) . ';
			}

			.main-navigation ul.menu ul {
				background-color: ' . $header_background_color . ';
			}

			.secondary-navigation ul.menu a {
				color: ' . $header_text_color . ';
			}
		}';

		$woocommerce_style 							= '
		a.cart-contents,
		.site-header-cart .widget_shopping_cart a {
			color: ' . $header_link_color . ';
		}

		 a.cart-contents:hover, .site-header-cart .widget_shopping_cart a:hover, .site-header-cart:hover > li > a{
			color: ' . storefront_adjust_color_brightness( $header_link_color, $darken_factor ) . ';
		}

		.site-header-cart .widget_shopping_cart {
			background-color: ' . $header_background_color . ';
		}

		.woocommerce-tabs ul.tabs li.active a,
		ul.products li.product .price,
		.onsale {
			color: ' . $text_color . ';
		}

		.onsale {
			border-color: ' . $text_color . ';
		}

		.star-rating span:before,
		.widget-area .widget a:hover,
		.product_list_widget a:hover,
		.quantity .plus, .quantity .minus,
		p.stars a:hover:after,
		p.stars a:after,
		.star-rating span:before {
			color: ' . $accent_color . ';
		}

		.widget_price_filter .ui-slider .ui-slider-range,
		.widget_price_filter .ui-slider .ui-slider-handle {
			background-color: ' . $accent_color . ';
		}

		#order_review_heading, #order_review {
			border-color: ' . $accent_color . ';
		}

		@media screen and ( min-width: 768px ) {
			.site-header-cart .widget_shopping_cart,
			.site-header .product_list_widget li .quantity {
				color: ' . $header_text_color . ';
			}
		}

		';

		wp_add_inline_style( 'storefront-child-style', $style );
    wp_add_inline_style( 'storefront-woocommerce-style', $woocommerce_style  );
		}

		/**
		 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
		 *
		 * @since  1.0.0
		 */
		public function customize_preview_js() {
			wp_enqueue_script( 'retailer-customizer', get_stylesheet_directory_uri() . '/inc/customizer/js/customizer.min.js', array( 'customize-preview' ), '1.16', true );
		}

	}

endif;

return new Retailer_Customizer();