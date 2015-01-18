<?php
/**
 * @package ladyfest tln 15
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		
		<?php echo the_post_thumbnail(); ?>

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<?php 
			//lft_posted_on(); 
			the_date('d.m.Y', '<span class="news-date">', '<span>');
			?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'lft' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php lft_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
