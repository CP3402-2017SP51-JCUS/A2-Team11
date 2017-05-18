<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <main>
 * and the left sidebar conditional
 *
 * @since 1.0.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<!--[if IE]><script src="<?php echo BAVOTASAN_THEME_URL; ?>/library/js/html5.js"></script><![endif]-->
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<div id="page" class="clearfix">
		<header id="header">
			<div class="container">
				<div id="site-meta" class="pull-left">
					<?php $tag = ( is_front_page() && is_home() ) ? 'h1' : 'div'; ?>
					<<?php echo $tag; ?> id="site-title"><a href="<?php echo esc_url( home_url() ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
						<?php bloginfo( 'name' ); ?>
					</a></<?php echo $tag; ?>>
					<div id="site-description"><?php bloginfo( 'description' ); ?></div>
				</div>

				<div id="nav-container" class="pull-right">
					<div id="top-header">
						<div class="top-menus">
							<?php wp_nav_menu( array( 'theme_location' => 'top', 'container' => '', 'menu_class' => 'hidden-xs top-menu pull-left', 'fallback_cb' => '' ) ); ?>

							<div class="hidden-xs">
								<?php get_search_form(); ?>
							</div>

							<?php
							if ( is_woocommerce_activated() ) {
								global $woocommerce;
								?>
								<a href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" class="cart-button-mobile visible-xs-inline-block"><?php _e( 'Cart', 'tienda-basic' ); ?> <i class="fa fa-shopping-cart"></i></a>
								<ul class="hidden-xs site-header-cart pull-right">
									<?php storefront_cart_link(); ?>
									<li><?php the_widget( 'WC_Widget_Cart', 'title=' ); ?></li>
								</ul>
								<?php
							}
							?>
						</div>
					</div>

					<div id="site-navigation">
						<h3 class="sr-only"><?php _e( 'Main menu', 'tienda-basic' ); ?></h3>
						<a class="sr-only" href="#primary" title="<?php esc_attr_e( 'Skip to content', 'tienda-basic' ); ?>"><?php _e( 'Skip to content', 'tienda-basic' ); ?></a>

						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						        <span class="sr-only">Open mobile menu</span>
						        <span class="icon-bar"></span>
						        <span class="icon-bar"></span>
						        <span class="icon-bar"></span>
						    </button>
						</div>

						<nav class="collapse navbar-collapse">
							<?php
							$menu_class = ( is_rtl() ) ? ' navbar-right' : ' navbar-left';

							wp_nav_menu( array( 'theme_location' => 'primary', 'container' => '', 'menu_class' => 'nav navbar-nav' . $menu_class, 'fallback_cb' => 'bavotasan_default_menu' ) );
							?>
						</nav>
					</div>
				</div>
			</div>
		</header>

		<main>
