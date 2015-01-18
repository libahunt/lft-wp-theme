<?php
/**
 * @package ladyfest tln 15
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<?php the_post_thumbnail( 'lft-post-header' ); ?>

	</header><!-- .entry-header -->

	<div class="entry-content">
		<p class="p-date"><?php the_date('d.m.Y', '<span class="news-date">', '<span>'); ?></p>
		<?php the_content(); ?>
		<?php
			/*wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'lft' ),
				'after'  => '</div>',
			) );*/
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php //lft_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
