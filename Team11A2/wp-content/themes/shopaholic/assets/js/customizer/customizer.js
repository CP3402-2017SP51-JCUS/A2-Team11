/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	
	wp.customize( 'storefront_header_background_color', function( value ) {
		value.bind( function( to ) {
			$( 'header.site-header .col-full' ).css( 'background-color', to );
		} );
	} );
	wp.customize( 'storefront_header_link_color', function( value ) {
		value.bind( function( to ) {
			$( 'header .second-nav ul li a' ).css( 'color', to );
			$( 'header .social-media .social-tw .fa' ).css( 'color', to );
		} );
	} );
	
} )( jQuery );
