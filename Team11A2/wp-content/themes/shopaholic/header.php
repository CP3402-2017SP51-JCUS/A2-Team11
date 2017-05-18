<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package shopaholic
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<?php
	do_action( 'storefront_before_header' ); ?>

	<header id="masthead" class="site-header" role="banner">
		
		<div class="col-full">
			<div class="top-area">
				
					<?php
					do_action( 'shopaholic_header_links' );
					/**
					* shopaholic_social_media_links hook
					*
					* @hooked shopaholic_social_media_links - 15
					* @hooked shopaholic_secondary_navigation - 10
					*/	
					do_action( 'shopaholic_header_top' ); ?>
					<span class="clearfix"></span>
			</div> <!-- second-nav -->

		</div>
		<div class="col-full">
			<?php
			do_action( 'shopaholic_header_logo' );
			?>
			<div class="navigation-area">
				<?php 
				/**
				* shopaholic_header_nav hook
				*
				* @hooked storefront_header_cart - 60
				*/	
				do_action( 'shopaholic_header_nav' ); ?>
			</div>
		</div>
	</header><!-- #masthead -->
	
	<?php if(is_page_template( 'template-homepage.php' )){ ?>
	<div id="banner-area" class="col-full"  <?php if ( get_header_image() != '' ) { echo 'style="background-image: url(' . esc_url( get_header_image() ) . ');"'; } ?>>
		
			<?php
				/**
				* shopaholic_slider hook
				*
				* @hooked shopaholic_featured_slider - 60
				*/	 
				do_action( 'shopaholic_slider' );
			?>
	</div> <!-- banner-area -->
	<?php } 
	/**
	 * @hooked storefront_header_widget_region - 10
	 */
	do_action( 'storefront_before_content' ); ?>

	<?php if( !is_front_page() ){ ?>
	<div class="col-full title-holder" <?php if ( get_header_image() != '' ) { echo 'style="background-image: url(' . esc_url( get_header_image() ) . ');"'; } ?>>
				<?php
				/**
				 * @hooked shopaholic_inner_title - 10
				 */
				do_action( 'shopaholic_title' ); ?>
			<div class="breadcrumbs-area">
				<?php
				/**
				 * @hooked woocommerce_breadcrumb - 10
				 */
				do_action( 'shopaholic_breadcrumb' ); ?>
			</div>
			<span class="clearfix"></span>
		<span class="overlay"></span>
	</div>
	<?php } ?>

	<div id="content" class="site-content" tabindex="-1">
		<div class="col-full">
				<?php
				/**
				 * @hooked shopaholic_shop_messages - 10
				 */
				do_action( 'shopaholic_shop_messages' ); ?>