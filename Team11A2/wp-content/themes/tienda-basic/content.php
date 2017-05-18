<?php
/**
 * The default template for displaying content
 *
 * Used for both single and front-page/index/archive/search.
 *
 * @since 1.0.0
 */
?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php
		if( has_post_thumbnail() )
			the_post_thumbnail( 'featured-img', array( 'class' => 'image-full aligncenter' ) );
		?>

		<div class="row">
			<div class="col-md-3 entry-meta">
				<p><i class="fa fa-bookmark"></i> <?php _e( 'Posted in ', 'tienda-basic' ); the_category( ', ' ); ?></p>

				<?php if ( comments_open() ) { ?>
				<p><i class="fa fa-comments"></i> <?php comments_popup_link( __( '0 Comments', 'tienda-basic' ), __( '1 Comment', 'tienda-basic' ), __( '% Comments', 'tienda-basic' ), '', '' ); ?></p>
				<?php } ?>
			</div>
			<div class="col-md-9">
				<?php
				if ( is_single() ) :
					the_title( '<h1 class="entry-title">', '</h1>' );
				else :
					the_title( sprintf( '<h2 class="entry-title taggedlink"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
				endif;
				?>

				<div class="entry-meta">
					<?php
					printf( __( 'by %s on %s', 'tienda-basic' ),
						'<span class="vcard author"><span class="fn"><a href="' . get_author_posts_url( get_the_author_meta( 'ID' ) ) . '" title="' . esc_attr( sprintf( __( 'Posts by %s', 'tienda-basic' ), get_the_author() ) ) . '" rel="author">' . get_the_author() . '</a></span></span>', '<a href="' . get_permalink() . '" class="time"><time class="date published updated" datetime="' . esc_attr( get_the_date( 'Y-m-d' ) ) . '">' . get_the_date() . '</time></a>'
						);
					?>
				</div>

			    <div class="entry-content description clearfix">
				    <?php
					if ( is_singular() && ! is_front_page() )
					    the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'tienda-basic') );
					else
						the_excerpt();
					?>
			    </div><!-- .entry-content -->

			    <?php
			    if ( is_singular() )
			    	get_template_part( 'content', 'footer' ); ?>
			</div>
		</div>

	</article> <!-- #post-<?php the_ID(); ?> -->