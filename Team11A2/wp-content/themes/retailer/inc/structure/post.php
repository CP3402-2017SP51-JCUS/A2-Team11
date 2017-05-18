<?php
/**
 * Template functions used for blog page.
 *
 * @package retailer
 */

function retailer_post_thumb() {
?>
	<div class="blog-thumb">
		<?php
		if ( has_post_thumbnail() ) {
			the_post_thumbnail( 'retailer-thumb-400', array( 'itemprop' => 'image' ) );
		}
		?>
	</div>
<?php
}

function retailer_post_header() {
?>
	<header class="entry-header">
		<?php
			
			the_title( sprintf( '<h1 class="entry-title" itemprop="name headline"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' );
			
		?>
		<div class="post-meta">
			<?php storefront_posted_on(); ?>
			<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>

			<?php
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( __( ', ', 'retailer' ) );

			if ( $categories_list && storefront_categorized_blog() ) : ?>
				<span class="cat-links">
					<?php
					echo '<span class="screen-reader-text">' . esc_attr( __( 'Categories: ', 'retailer' ) ) . '</span>';
					echo wp_kses_post( $categories_list );
					?>
				</span>
			<?php endif; // End if categories ?>
			<?php
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', __( ', ', 'retailer' ) );

			if ( $tags_list ) : ?>
				<span class="tags-links">
					<?php
					echo '<span class="screen-reader-text">' . esc_attr( __( 'Tags: ', 'retailer' ) ) . '</span>';
					echo wp_kses_post( $tags_list );
					?>
				</span>
			<?php endif; // End if $tags_list ?>

			<?php endif; // End if 'post' == get_post_type() ?>
		</div>
	
	</header><!-- .entry-header -->
<?php
}

function retailer_post_content() {
	?>
	
	<?php
	
	the_content(
		sprintf(
			__( 'Continue reading %s', 'retailer' ),
			'<span class="screen-reader-text">' . get_the_title() . '</span>'
		)
	);

	wp_link_pages( array(
		'before' => '<div class="page-links">' . __( 'Pages:', 'retailer' ),
		'after'  => '</div>',
	) );
	?>

	<?php
}