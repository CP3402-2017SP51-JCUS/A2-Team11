<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package retailer
 */

if ( ! function_exists( 'storefront_product_categories' ) ) {
	/**
	 * Display Product Categories
	 * Hooked into the `homepage` action in the homepage template
	 * @since  1.0.0
	 * @return void
	 */
	function storefront_product_categories( $args ) {

		if ( retailer_woocommerce_is_activated() ) {

			?>
			<section class="storefront-product-section storefront-product-categories">
				<div class="woocommerce columns-3">
				<?php
					do_action( 'storefront_homepage_before_product_categories' );

					$args = array(
					'number'			=> 3,
					'child_categories' 	=> 0,
					'orderby' 			=> 'name',
					);

					$product_categories = get_terms( 'product_cat', $args );
					$count = count($product_categories);
					if ( $count > 0 ){ ?>

					<ul class='products'>

					<?php foreach ( $product_categories as $product_category ) {

				    // get the thumbnail id user the term_id
				    $thumbnail_id = get_woocommerce_term_meta( $product_category->term_id, 'thumbnail_id', true ); 
				    // get the image URL
				    $image = wp_get_attachment_url( $thumbnail_id ); 


					?>
					<?php if($image): ?>
					<li class="product-category product" style="background-image:url(<?php echo $image; ?>);">
					<?php else: ?>
					<li class="product-category product" style="background-image:url(<?php echo woocommerce_placeholder_img_src(); ?>);">
					<?php endif; ?>
						<a href="<?php echo get_term_link( $product_category ); ?>" class="cat-details">
							<h3><?php echo  $product_category->name; ?></h3>
							<?php echo $product_category->description; ?>
						</a>
						<a href="<?php echo get_term_link( $product_category ); ?>"><span class="overlay"></span></a>
					</li>
					
					<?php
					}
					echo "</ul>";
					}

					do_action( 'storefront_homepage_after_product_categories' );
				?>
				</div>
			</section>
			<?php
		}
	}
}