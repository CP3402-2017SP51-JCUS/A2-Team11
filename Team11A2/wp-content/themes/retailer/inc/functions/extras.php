<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package retailer
 */

/**
 * Check whether the Storefront Customizer settings ar enabled
 * @return boolean
 * @since  1.1.2
 */
function retailer_customizer_enabled() {
	return apply_filters( 'retailer_customizer_enabled', true );
}

/**
 * Query WooCommerce activation
 */
if ( ! function_exists( 'retailer_woocommerce_is_activated' ) ) {
	function retailer_woocommerce_is_activated() {
		return class_exists( 'woocommerce' ) ? true : false;
	}
}

/* social icons*/
function retailer_social_icons()  { 

	$social_networks = array( array( 'name' => __('Facebook','retailer'), 'theme_mode' => 'retailer_facebook','icon' => 'fa-facebook' ),
	array( 'name' => __('Twitter','retailer'), 'theme_mode' => 'retailer_twitter','icon' => 'fa-twitter' ),
	array( 'name' => __('Google+','retailer'), 'theme_mode' => 'retailer_google','icon' => 'fa-google-plus' ),
	array( 'name' => __('Pinterest','retailer'), 'theme_mode' => 'retailer_pinterest','icon' => 'fa-pinterest' ),
	array( 'name' => __('Linkedin','retailer'), 'theme_mode' => 'retailer_linkedin','icon' => 'fa-linkedin' ),
	array( 'name' => __('Youtube','retailer'), 'theme_mode' => 'retailer_youtube','icon' => 'fa-youtube' ),
	array( 'name' => __('Tumblr','retailer'), 'theme_mode' => 'retailer_tumblr','icon' => 'fa-tumblr' ),
	array( 'name' => __('Instagram','retailer'), 'theme_mode' => 'retailer_instagram','icon' => 'fa-instagram' ),
	array( 'name' => __('Flickr','retailer'), 'theme_mode' => 'retailer_flickr','icon' => 'fa-flickr' ),
	array( 'name' => __('Vimeo','retailer'), 'theme_mode' => 'retailer_vimeo','icon' => 'fa-vimeo-square' ),
	array( 'name' => __('RSS','retailer'), 'theme_mode' => 'retailer_rss','icon' => 'fa-rss' )
	);


	for ($row = 0; $row < 11; $row++){
		if (get_theme_mod( $social_networks[$row]["theme_mode"])): ?>
			<a href="<?php echo esc_url( get_theme_mod($social_networks[$row]['theme_mode']) ); ?>" class="social-tw" title="<?php echo esc_url( get_theme_mod( $social_networks[$row]['theme_mode'] ) ); ?>">
			<span class="fa <?php echo $social_networks[$row]['icon']; ?>"></span> 
			</a>
		<?php endif;
	}
										
}

function retailer_check_number( $value ) {
		$value = (int) $value; // Force the value into integer type.
		return ( 0 < $value ) ? $value : null;
}