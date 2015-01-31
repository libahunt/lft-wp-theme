<?php
/**
 * @package ladyfest tln 15
 */

/*EVENT DATES DISPLAY*/
function lft_format_date($yyyymmdd) {
	$d = mktime(0, 0, 0, intval(substr($yyyymmdd, 4, 2)), intval(substr($yyyymmdd, 6, 2)), intval(substr($yyyymmdd, 0, 4)));
	$weekdays = array('P','E','T','K','N','R','L');
	$wd = $weekdays[date('w', $d)];
	$dd = intval(substr($yyyymmdd, 6, 2));
	$months = array('Jaanuar','Veebruar','Märts','Aprill','Mai','Juuni','Juuli','August','September','Oktoober','November','Detsember');
	$mn = $months[date('m', $d)-1];
	return '<span>' . $wd . '</span> <span>' . $dd . '</span> ' . $mn;
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<?php the_post_thumbnail( 'lft-post-header' ); ?>

	</header><!-- .entry-header -->

	<div class="entry-content">
		<h2 class="event-time"><?php echo lft_format_date(get_post_custom_values('event_date')[0]) . ' ' . get_post_custom_values('event_time')[0]?> </h2>
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
