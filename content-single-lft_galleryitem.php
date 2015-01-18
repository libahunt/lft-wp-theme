<?php
/**
 * @package ladyfest tln 15
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<?php echo the_post_thumbnail(); ?>

	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			/*wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'lft' ),
				'after'  => '</div>',
			) );*/
		?>
	</div><!-- .entry-content -->

</article><!-- #post-## -->
