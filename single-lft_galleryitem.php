<?php
/**
 * The template for displaying all single posts.
 *
 * @package ladyfest tln 15
 */

get_header(); 
?>

      
<!--template: single.php-->
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'single-lft_galleryitem' ); ?>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->


<?php get_footer(); 
?>
