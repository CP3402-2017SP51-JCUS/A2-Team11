/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	
	wp.customize( 'retailer_header_top_background_color', function( value ) {
		value.bind( function( to ) {
			$( 'header .top-area' ).css( 'background-color', to );
		} );
	} );
	wp.customize( 'retailer_header_top_text_color', function( value ) {
		value.bind( function( to ) {
			$( 'header .top-area,header .social-media .social-tw' ).css( 'color', to );
		} );
	} );
	wp.customize( 'retailer_footer_credits_background_color', function( value ) {
		value.bind( function( to ) {
			$( '.site-footer .credits-area' ).css( 'background-color', to );
		} );
	} );
	wp.customize( 'retailer_footer_credits_text_color', function( value ) {
		value.bind( function( to ) {
			$( '.site-footer .credits-area,.site-footer .credits-area a' ).css( 'color', to );
		} );
	} );
	
} )( jQuery );
