<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package shopaholic
 */
?>

		<!--</div> .col-full -->
	</div><!-- #content -->

	<?php do_action( 'storefront_before_footer' ); ?>

	<footer id="colophon" class="site-footer col-full" role="contentinfo">
		<?php if ( class_exists( 'WooCommerce' ) ) { 
		if( !is_cart() && !is_checkout() ): ?>

			<?php
			/**
			 * @hooked storefront_footer_widgets - 10
			 * 
			 */
			do_action( 'shopaholic_footer_widgets' ); ?>

		<?php endif; } ?>
		<div class="credits-area">
			<?php
			/**
			 * @hooked shopaholic_credit - 20
			 * 
			 */
			do_action( 'shopaholic_credit_area' ); ?>

		</div>
	</footer><!-- #colophon -->

	<?php do_action( 'storefront_after_footer' ); ?>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>