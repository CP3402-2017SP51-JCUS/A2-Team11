<?php
/**
 * The template for displaying pages
 *
 * @since 1.0.0
 */
?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php
		$class = ( is_search() ) ? '' : ' page-header';

		if ( is_front_page() ) :
			the_title( '<h2 class="entry-title' . esc_attr( $class ) . '">', '</h2>' );
		else :
			the_title( '<h1 class="entry-title' . esc_attr( $class ) . '">', '</h1>' );
		endif;
		?>

	    <div class="entry-content description clearfix">
		    <?php
				if ( is_search() )
					the_excerpt();
				else
				    the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'tienda-basic') );
			?>
	    </div><!-- .entry-content -->

	    <?php get_template_part( 'content', 'footer' ); ?>
	</article><!-- #post-<?php the_ID(); ?> -->