<?php
/**
 * @package retailer
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope="" itemtype="http://schema.org/BlogPosting">

	<?php
		/**
		* retailer_blog_index_thumb hook
		*
		* @hooked retailer_post_thumb - 10
		*/	
		do_action( 'retailer_blog_index_thumb' );
	?>
	<div class="post-content-area">
	<?php
		/**
		* retailer_blog_index_header hook
		*
		* @hooked retailer_post_header - 10
		*/	
		do_action( 'retailer_blog_index_header' );
		/**
		* retailer_blog_index_content hook
		*
		* @hooked retailer_post_content - 10
		*/	
		do_action( 'retailer_blog_index_content' );
	?>
	</div>
	<div class="clearfix"></div>
</article><!-- #post-## -->