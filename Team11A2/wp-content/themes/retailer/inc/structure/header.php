<?php
/**
 * Template functions used for the site header.
 *
 * @package retailer
 */

if ( ! function_exists( 'retailer_social_media_links' ) ) {
	/**
	 * Display Social Media
	 * @since  1.0.0
	 * @return void
	 */
	function retailer_social_media_links() {
		?>
		<div class="social-media">
			<?php retailer_social_icons(); ?>
		</div>
		<?php
	}
}


if ( ! function_exists( 'retailer_secondary_navigation' ) && ! function_exists( 'storefront_header_widget_region' )) {
	/**
	 * Display Secondary Navigation
	 * @since  1.0.0
	 * @return void
	 */
	function retailer_secondary_navigation() {
		?>
		<nav class="second-nav" role="navigation" aria-label="<?php _e( 'Secondary Navigation', 'retailer' ); ?>">
			<?php
				wp_nav_menu(
					array(
						'theme_location'	=> 'secondary',
						'fallback_cb'		=> '',
					)
				);
			?>
		</nav><!-- #site-navigation -->
		<?php
	}
}

if ( ! function_exists( 'retailer_site_branding' ) ) {
	/**
	 * Display Site Branding
	 * @since  1.0.0
	 * @return void
	 */
	function retailer_site_branding() {
		if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
			the_custom_logo();
		} elseif ( function_exists( 'jetpack_has_site_logo' ) && jetpack_has_site_logo() ) {
			jetpack_the_site_logo();
		} else { ?>
			<div class="site-branding">
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php if ( '' != get_bloginfo( 'description' ) ) { ?>
					<p class="site-description"><?php echo bloginfo( 'description' ); ?></p>
				<?php } ?>
			</div>
		<?php }
	}
}

function retailer_featured_slider() {
	/**
	 * Display Slider
	 * @since  1.0.0
	 * @return void
	 */ 
?>

		<?php if ( class_exists( 'WooCommerce' ) ) { ?>
		
	   
	        <?php

			$meta_key = get_theme_mod('retailer_slider_area');
			if(get_theme_mod('retailer_slider_num_show')):
				$num_prod = get_theme_mod('retailer_slider_num_show');
			else:
				$num_prod = "5";
			endif;

			if($meta_key == "top_rated"):
				add_filter( 'posts_clauses', array( WC()->query, 'order_by_rating_post_clauses' ) );
				$args = array( 'posts_per_page' => $num_prod, 'no_found_rows' => 1, 'post_status' => 'publish', 'post_type' => 'product' );
				$args['meta_query'] = WC()->query->get_meta_query();
			elseif($meta_key == "featured"):
				$args = array( 'post_type' => 'product', 'posts_per_page' => $num_prod ,'meta_key' => '_featured', 'meta_value' => 'yes' );
			elseif($meta_key == "sale"):
				$args = array( 'post_type' => 'product', 'posts_per_page' => $num_prod,
				    'meta_query' => array(
				        'relation' => 'OR',
				        array( 
				        'key'           => '_sale_price',
				        'value'         => 0,
				        'compare'       => '>',
				        'type'          => 'numeric'
				        ),
				        array( // Variable products type
				        'key'           => '_min_variation_sale_price',
				        'value'         => 0,
				        'compare'       => '>',
				        'type'          => 'numeric'
				        )
				    ) 
				);	
			elseif($meta_key == "total_sales"):
				$args = array(
					'post_type' => 'product',
					'meta_key' => 'total_sales',
					'orderby' => 'meta_value_num',
					'posts_per_page' => $num_prod
				);
			elseif($meta_key == "recent"):
				$args = array( 'post_type' => 'product', 'stock' => 1, 'posts_per_page' => $num_prod, 'orderby' =>'date','order' => 'DESC' );
			else:
					$args = array( 'post_type' => 'product', 'stock' => 1, 'posts_per_page' => $num_prod, 'orderby' =>'date','order' => 'DESC' );
			endif;

			if(get_theme_mod('retailer_auto_scroll_setting')):
				$auto_scroll = get_theme_mod('retailer_auto_scroll_setting');
			else:
				$auto_scroll = 'false';
			endif;
			?>
			<div id="slider" class="flexslider" data-slide="<?php echo esc_html( $auto_scroll ); ?>">
			<ul class="slides"> 
			<?php
			$loop = new WP_Query( $args );
			while ( $loop->have_posts() ) : $loop->the_post(); global $product;	 ?>

				<li class="product-slider"> 
					<div class="banner-product-image">
						<?php global $post; woocommerce_show_product_sale_flash( $post, $product ); ?>
						<?php 
							$thumb_id = get_post_thumbnail_id();
							$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'retailer-banner-1000', true);
							$thumb_url = $thumb_url_array[0];
						?>
						
						<?php if (has_post_thumbnail( $loop->post->ID )) echo '<div style="background-image: url('. $thumb_url .'); position: absolute; top: 0px; width: 100%; height: 100%; background-position: center center; background-repeat: no-repeat; right: 0px; background-size: cover;"></div>'; else echo '<img src="'.woocommerce_placeholder_img_src().'" alt="Placeholder" width="1000px" height="1000px" />'; ?>
					</div>
					<div class="banner-product-details"> 
						<h3><?php the_title(); ?></h3>
						<p class="price"><?php echo $product->get_price_html(); ?></p>
						<p><?php echo retailer_get_excerpt(300); ?></p>
						<a href="<?php echo get_permalink( $loop->post->ID ) ?>" class="button" title="<?php echo esc_attr($loop->post->post_title ? $loop->post->post_title : $loop->post->ID); ?>"><?php _e('View Product','retailer'); ?></a>
					</div>
					<div class="clearfix"></div>
				</li>
			<?php endwhile; ?>
			<?php wp_reset_query(); ?>
			</ul>
			</div>
			<div id="carousel" class="flexslider">
			<ul class="slides"> 
			<?php
			$loop = new WP_Query( $args );
			while ( $loop->have_posts() ) : $loop->the_post(); global $product;	 ?>

				<li class="product-slider"> 
						<?php if (has_post_thumbnail( $loop->post->ID )) echo get_the_post_thumbnail($loop->post->ID, 'retailer-thumb-400'); else echo '<img src="'.woocommerce_placeholder_img_src().'" alt="Placeholder" width="400px" height="400px" />'; ?>
						<span class="overlay"></span>
				</li>
			<?php endwhile; ?>
			<?php wp_reset_query(); ?>
			</ul>
			</div>
			<?php 
				if($meta_key == "top_rated"):
				remove_filter( 'posts_clauses', array( WC()->query, 'order_by_rating_post_clauses' ) ); 
				endif;
			?>
			
	
		
<?php 	} 

	}

function retailer_inner_title(){
?>
	<div class="inner-title">
			<h1>
				<?php
					if(is_post_type_archive('product')):
						woocommerce_page_title();
					elseif(is_category()):
						single_cat_title();
					elseif (is_tag()):
						single_tag_title();
					elseif(is_author()):
						global $post;
						$author_id = $post->post_author;
						the_author_meta('display_name', $author_id);
					elseif (is_day() || is_month() || is_year()):
						the_time('F Y');
					elseif(is_archive()):
						single_cat_title();
					elseif(is_home()):
						$blog_page_id = get_option('page_for_posts');
						echo get_page($blog_page_id)->post_title;
					else:
						the_title();				
					endif;
				?>
			</h1>
	</div>
<?php
}