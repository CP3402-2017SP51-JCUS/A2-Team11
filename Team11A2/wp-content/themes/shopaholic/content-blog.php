<?php
/**
 * @package shopaholic
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope="" itemtype="http://schema.org/BlogPosting">

	<?php
		/**
		* shopaholic_blog_index_thumb hook
		*
		* @hooked shopaholic_post_thumb - 10
		*/	
		do_action( 'shopaholic_blog_index_thumb' );
	?>
	<div class="post-content-area">
	<?php
		/**
		* shopaholic_blog_index_header hook
		*
		* @hooked shopaholic_post_header - 10
		*/	
		do_action( 'shopaholic_blog_index_header' );
		/**
		* shopaholic_blog_index_content hook
		*
		* @hooked shopaholic_post_content - 10
		*/	
		do_action( 'shopaholic_blog_index_content' );
	?>
	</div>
	<div class="clearfix"></div>
</article><!-- #post-## -->