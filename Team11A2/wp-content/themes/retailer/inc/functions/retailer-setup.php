<?php
/**
 * retailer setup functions
 *
 * @package retailer
 */


function retailer_theme_setup() {
	add_image_size( 'retailer-thumb-400', 400, 400, true );
	add_image_size( 'retailer-banner-1000', 1000, 1000, true );
}

function retailer_google_fonts() {
	wp_enqueue_style('retailer-googleFonts', '//fonts.googleapis.com/css?family=Roboto:400,300,400italic,500,700,900');
}

//dequeue JavaScripts
function retailer_dequeue_unnecessary_scripts() {
    wp_dequeue_script( 'storefront-navigation' );

}
add_action( 'wp_print_scripts', 'retailer_dequeue_unnecessary_scripts' );

/**
 * Enqueue scripts and styles.
 * @since  1.0.0
 */
function retailer_scripts() {

  wp_enqueue_style( 'retailer-flexslider-css', get_stylesheet_directory_uri() . '/css/flexslider.min.css', array(), '' );

  wp_enqueue_style( 'storefront-style', get_template_directory_uri() . '/style.css' ); //parent style

  wp_enqueue_style( 'storefront-child-style', get_stylesheet_uri(), '' );

  wp_enqueue_script( 'retailer-nav', get_stylesheet_directory_uri() . '/js/navigation.min.js', array( 'jquery' ), '', true );

  wp_enqueue_script( 'retailer-main-js', get_stylesheet_directory_uri() . '/js/main.js', array(), '', true );

	if ( class_exists( 'WooCommerce' ) ) {

    wp_enqueue_script( 'retailer-flexslider-js', get_stylesheet_directory_uri() . '/js/jquery.flexslider-min.js', array(), '', true );

  	wp_enqueue_script( 'retailer-slider-js', get_stylesheet_directory_uri() . '/js/slider-setup.js', array(), '', true );
  
  }
}

function retailer_get_excerpt($count){
  global $post;
  $permalink = get_permalink($post->ID);
  $excerpt = get_the_excerpt();
  $excerpt = strip_tags($excerpt);
  $excerpt = substr($excerpt, 0, $count);
  $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
  $excerpt = $excerpt.'...';
  return $excerpt;
}