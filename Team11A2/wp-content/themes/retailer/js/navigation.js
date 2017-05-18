/**
 * navigation.js
 *
 * Handles toggling the navigation menu for small screens and adds a focus class to parent li's for accessibility.
 */
( function() {
	var container, button, menu;

	container = document.getElementById( 'site-navigation' );
	if ( ! container ) {
		return;
	}

	button = container.getElementsByTagName( 'button' )[0];
	if ( 'undefined' === typeof button ) {
		return;
	}

	menu = container.getElementsByTagName( 'ul' )[0];

	// Hide menu toggle button if menu is empty and return early.
	if ( 'undefined' === typeof menu ) {
		button.style.display = 'none';
		return;
	}

	menu.setAttribute( 'aria-expanded', 'false' );

	if ( -1 === menu.className.indexOf( 'nav-menu' ) ) {
		menu.className += ' nav-menu';
	}

	jQuery('.menu-toggle').on('click',bindevnttrigger);

	jQuery('body').keydown(function (e) {

	   if (e.which == 9){
	      console.log('trigger tab');
	      var container = jQuery(".menu-toggle");
	      if(container.is(e.target)){
	      	console.log('is toggle');
	      	bindevnttrigger();
	      }
	      
	   }
	});



	function bindevnttrigger(){
			
			if(jQuery('.menu-toggle').parent('.main-navigation').hasClass('toggled')){
				console.log('trigger remove');
				jQuery('.menu-toggle').parent('.main-navigation').removeClass('toggled');
				jQuery('.menu-toggle').attr('aria-expanded', 'false');
			}else{
				console.log('trigger add');
				jQuery('.menu-toggle').parent('.main-navigation').addClass('toggled');
				jQuery('.menu-toggle').attr('aria-expanded', 'true');
			}
			
			return false;

	}

	// Add focus class to li
	jQuery( '.main-navigation, .secondary-navigation' ).find( 'a' ).on( 'focus.storefront blur.storefront', function() {
		jQuery( this ).parents().toggleClass( 'focus' );
	});

	// Add focus to cart dropdown
	jQuery( window ).load( function() {
		jQuery( '.site-header-cart' ).find( 'a' ).on( 'focus.storefront blur.storefront', function() {
			jQuery( this ).parents().toggleClass( 'focus' );
		});
	});

} )();
