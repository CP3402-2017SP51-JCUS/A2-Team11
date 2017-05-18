<?php
/**
 * Shopaholic functions
 *
 * @package shopaholic
 */

 /**
  * Query WooCommerce activation
  */
 function shopaholic_is_woocommerce_activated() {
 	return class_exists( 'woocommerce' ) ? true : false;
 }

	/* social icons*/
	function shopaholic_social_icons()  { 

		$social_networks = array( 
			array( 'name' => __( 'Facebook','shopaholic' ), 'theme_mode' => 'shopaholic_facebook','icon' => 'fa-facebook' ),
			array( 'name' => __( 'Twitter','shopaholic' ), 'theme_mode' => 'shopaholic_twitter','icon' => 'fa-twitter' ),
			array( 'name' => __( 'Google+','shopaholic' ), 'theme_mode' => 'shopaholic_google','icon' => 'fa-google-plus' ),
			array( 'name' => __( 'Pinterest','shopaholic' ), 'theme_mode' => 'shopaholic_pinterest','icon' => 'fa-pinterest' ),
			array( 'name' => __( 'Linkedin','shopaholic' ), 'theme_mode' => 'shopaholic_linkedin','icon' => 'fa-linkedin' ),
			array( 'name' => __( 'Youtube','shopaholic' ), 'theme_mode' => 'shopaholic_youtube','icon' => 'fa-youtube' ),
			array( 'name' => __( 'Tumblr','shopaholic' ), 'theme_mode' => 'shopaholic_tumblr','icon' => 'fa-tumblr' ),
			array( 'name' => __( 'Instagram','shopaholic' ), 'theme_mode' => 'shopaholic_instagram','icon' => 'fa-instagram' ),
			array( 'name' => __( 'Flickr','shopaholic' ), 'theme_mode' => 'shopaholic_flickr','icon' => 'fa-flickr' ),
			array( 'name' => __( 'Vimeo','shopaholic' ), 'theme_mode' => 'shopaholic_vimeo','icon' => 'fa-vimeo-square' ),
			array( 'name' => __( 'RSS','shopaholic' ), 'theme_mode' => 'shopaholic_rss','icon' => 'fa-rss' )
		);


		for ( $row = 0; $row < 11; $row++ ){
			if ( get_theme_mod( $social_networks[$row]["theme_mode"] ) ): ?>
				<a href="<?php echo esc_url( get_theme_mod($social_networks[$row]['theme_mode']) ); ?>" class="social-tw" title="<?php echo esc_url( get_theme_mod( $social_networks[$row]['theme_mode'] ) ); ?>" target="_blank">
				<span class="fa <?php echo $social_networks[$row]['icon']; ?>"></span> 
				</a>
			<?php endif;
		}
                      
	}

	function shopaholic_check_number( $value ) {
	    $value = ( int ) $value; // Force the value into integer type.
	    return ( 0 < $value ) ? $value : null;
	}