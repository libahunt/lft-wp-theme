<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package ladyfest tln 15
 */

get_header(); ?>

<?php 
/*Special content types*/
$args = array( 
	'post_type' => array(
		'lft_event', 
		'lft_movie', 
		'lft_workshop'
		),
	'nopaging' => 'true', 
	'orderby' => 'meta_value',  
	'meta_key' => 'event_date', 
	'order' => 'ASC' 
);
$all_events = new WP_Query( $args );

$args = array( 
	'post_type' => 'lft_workshop',
	'nopaging' => 'true', 
	'orderby' => 'meta_value',  
	'meta_key' => 'event_date', 
	'order' => 'ASC' 
);
$workshops = new WP_Query( $args );

$args = array( 
	'post_type' => 'lft_movie',
	'nopaging' => 'true', 
	'orderby' => 'meta_value',  
	'meta_key' => 'event_date', 
	'order' => 'ASC' 
);
$movies = new WP_Query( $args );

$args = array( 
	'post_type' => 'lft_galleryitem',
	'nopaging' => 'true', 
	'order' => 'DESC' 
);
$galleryitems = new WP_Query( $args );

$args = array( 
	'post_type' => 'lft_archiveitem',
	'nopaging' => 'true', 
	'orderby' => 'meta_value',  
	'meta_key' => 'event_year', 
	'order' => 'DESC' 
);
$archiveitems = new WP_Query( $args );

$args = array( 
	'post_type' => 'lft_sponsor',
	'nopaging' => 'true', 
	'order' => 'ASC' 
);
$sponsors = new WP_Query( $args );



/*EVENT DATES DISPLAY*/
function lft_format_date($yyyymmdd) {
	$d = mktime(0, 0, 0, intval(substr($yyyymmdd, 4, 2)), intval(substr($yyyymmdd, 6, 2)), intval(substr($yyyymmdd, 0, 4)));
	$weekdays = array('P','E','T','K','N','R','L');
	$wd = $weekdays[date('w', $d)];
	$dd = intval(substr($yyyymmdd, 6, 2));
	$months = array('Jaanuar','Veebruar','Märts','Aprill','Mai','Juuni','Juuli','August','September','Oktoober','November','Detsember');
	$mn = $months[date('m', $d)-1];
	return '<span>' . $wd . '</span> <span>' . $dd . '</span> ' . $mn ;
}

?>

<a id="anchors-menu-toggle" href="#anchors-menu">Menüü</a>
<nav id="anchors-menu">
	<ul>
		<li><?php if ( !$all_events->have_posts() ) : echo('<span>Kava 2016</span>'); else: echo('<a href="#kava">Kava 2016</a>'); endif; ?></li>
		<li><?php if ( $sponsors->have_posts() ) : echo('<a href="#toetajad">Toetajad</a>'); endif; ?></li>
		<li><?php if ( !have_posts() ) : echo('<span>Uudised</span>'); else: echo('<a href="#uudised">Uudised</a>'); endif; ?></li>
		<li><?php if ( !$workshops->have_posts() ) : echo('<span>Töötoad</span>'); else: echo('<a href="#tootoad">Töötoad</a>'); endif; ?></li>
		<li><?php if ( !$movies->have_posts() ) : echo('<span>Kino</span>'); else: echo('<a href="#kino">Kino</a>'); endif; ?></li>
		<li><a href="#meist">Meist</a></li>
		<li><?php if ( $galleryitems->have_posts() ) : echo('<a href="#galerii">Galerii</a>'); endif; ?></li>
		<li><?php if ( $archiveitems->have_posts() ) : echo('<a href="#arhiiv">Arhiiv</a>'); endif; ?></li>

		<?php 
			$args = array(
				'sort_column' => 'menu_order',
				'post_status' => 'publish'
			); 
		  $pages = get_pages($args); 
		  foreach ( $pages as $page ) {
		  	$option = '<li><a href="' . get_page_link( $page->ID ) . '"  data-open="lft-modal">';
			$option .= $page->post_title;
			$option .= '</a></li>';
			echo $option;
		  }
		?>
		
	</ul>
</nav>



	<main id="content-area" class="container-fluid">


		<?php /*all_events section*/ if ( $all_events->have_posts() ) : ?>
		<?php $event_date_save = ""; $i = 0; ?>
		<section id="kava" class="row">
			<div class="col-sm-12">
				<h2>Kava</h2>

				<?php while ( $all_events->have_posts() ) : $all_events->the_post(); ?>

					<?php if ($event_date_save != get_post_custom_values('event_date')[0]) {
						if ($i != 0) {echo '</div>';}
						echo '<h3>';
						echo lft_format_date(get_post_custom_values('event_date')[0]); 
						echo '</h3><div class="day">';
						$event_date_save = get_post_custom_values('event_date')[0];
						$i++;
					} ?>
				<a href="<?php echo get_permalink(); ?>" data-open="lft-modal" class="event-item" data-time="<?php echo substr(get_post_custom_values('event_time')[0], 0, 2) . substr(get_post_custom_values('event_time')[0], 3, 2) ; ?>">
					<span class="time"><?php echo get_post_custom_values('event_time')[0]; ?></span>
					<h4><?php the_title(); ?></h4>
				</a>

				<?php endwhile;?>

				<?php if ( $all_events->have_posts() ):?></div><?php endif;?>
			</div>
		</section>

		<?php endif; /*end all_events section*/?>



		
		<?php /*toetajad section*/ if ( $sponsors->have_posts() ) :?>

		<section id="toetajad" class="row">
			<h2 class="col-sm-12">Toetajad</h2>
			<ul>
			<?php while ( $sponsors->have_posts() ) : $sponsors->the_post(); ?>

				<?php if (has_post_thumbnail()): ?>

				<li class="col-sm-4 lft-toetaja-col toetaja-logo">
					<?php if (get_post_custom_values('webpage')[0]!= null): ?><a href="<?php echo get_post_custom_values('webpage')[0]; ?>" target="_blank"><?php endif; ?>
						<div class="box"><?php the_post_thumbnail( 'lft-gallery-thumb' ); ?><div class="overlay"><span class="name"><span><?php the_title(); ?></span></span></div></div>
					<?php if (get_post_custom_values('webpage')[0]!= ""): ?></a><?php endif; ?>
				</li>

				<?php else: ?>

				<li class="col-sm-4 lft-toetaja-col toetaja-name">
					<?php if (get_post_custom_values('webpage')[0]!= null): ?><a href="<?php echo get_post_custom_values('webpage')[0]; ?>" target="_blank"><?php endif; ?>
						<div class="box"><div class="overlay"><span class="name"><span><?php the_title(); ?></span></span></div></div>
					<?php if (get_post_custom_values('webpage')[0]!= ""): ?></a><?php endif; ?>
				</li>

				<?php endif; ?>

			<?php endwhile;?>
			</ul>
		</section>

		<?php endif; /*end sponsors section*/?>


		
		

		<?php /*news section*/ if ( have_posts() ) : ?>
			
		<section id="uudised" class="row">
			<div class="col-sm-12">
				<h2>Uudised</h2>
				<ul>
					<?php while ( have_posts() ) : the_post(); ?>
					<li>
						<a href="<?php echo get_permalink(); ?>" data-open="lft-modal">
							<h3><?php echo the_title();?></h3>
						</a>
						<div class="lft-lead"><?php echo the_content(); ?></div>
					</li>
					<?php endwhile; ?>
				</ul>
			</div>
		</section>

		<?php endif; /*end news section*/ ?>




		<?php /*workshops section*/if ( $workshops->have_posts() ) :?>

		<section id="tootoad" class="row">
			<h2>Töötoad</h2>

			<?php while ( $workshops->have_posts() ) : $workshops->the_post(); ?>
				<div class="col-sm-4 lft-workshops-col">
					<a href="<?php echo get_permalink(); ?>" data-open="lft-modal" class="workshop-item">
						<div class="box"><?php the_post_thumbnail( 'lft-gallery-thumb' ); ?><div class="overlay"><span class="name"><span><?php the_title(); ?></span></span></div></div>
					</a>
				</div>
			<?php endwhile;?>
			
		</section>

		<?php endif; /*end workshops section*/?>




		<?php /*movies section*/ if ( $movies->have_posts() ) : ?>
		
		<?php $event_date_save = ""; $i = 0; ?>
		<section id="kino" class="row">
			<div class="col-sm-12">
				<h2>Kino</h2>

				<?php while ( $movies->have_posts() ) : $movies->the_post(); ?>

					<?php if ($event_date_save != get_post_custom_values('event_date')[0]) {
						if ($i != 0) {echo '</div>';}
						echo '<h3>';
						echo lft_format_date(get_post_custom_values('event_date')[0]); 
						echo '</h3><div class="day">';
						$event_date_save = get_post_custom_values('event_date')[0];
						$i++;
					} ?>

					<a href="<?php echo get_permalink(); ?>" data-open="lft-modal" class="event-item" data-time="<?php echo substr(get_post_custom_values('event_time')[0], 0, 2) . substr(get_post_custom_values('event_time')[0], 3, 2) ; ?>">
						<span class="time"><?php echo get_post_custom_values('event_time')[0]; ?></span>
						<h4><?php the_title(); ?></h4>
					</a>

				<?php endwhile;?>

				<?php if ( $movies->have_posts() ):?></div><?php endif;?>
			</div>
		</section>
		
		<?php endif; /*end movies section*/?>





		<section id="meist" class="row">
			<div class="col-sm-12">
				<?php $aboutpage = get_post(40); ?>
				<h2><?php echo apply_filters( 'the_title', $aboutpage->post_title );?></h2>
				<div class="text-block"><?php echo apply_filters( 'the_content', $aboutpage->post_content ) ?></div>
			</div>
		</section>






		<?php /*galleryitems section*/ if ( $galleryitems->have_posts() ) :?>

		<section id="galerii" class="row">
			<h2 class="col-sm-12">Galerii</h2>

			<?php while ( $galleryitems->have_posts() ) : $galleryitems->the_post(); ?>
				<div class="col-sm-4 lft-galleryitem-col">
					<a href="<?php echo get_permalink(); ?>" data-open="lft-modal" class="gallery-item">
						<?php the_post_thumbnail( 'lft-gallery-thumb' ); ?>
						<div class="overlay"><h3><span><?php the_title(); ?></span></h3></div>
					</a>
				</div>
			<?php endwhile;?>
			
		</section>

		<?php endif; /*end galleryitems section*/?>




		<?php /*archiveitems section*/ if ( $archiveitems->have_posts() ) : ?>
		
		<?php $event_year_save = ""; ?>
		<section id="arhiiv" class="row">
			<div class="col-sm-12">
				<h2>Arhiiv</h2>
		
				<?php while ( $archiveitems->have_posts() ) : $archiveitems->the_post(); ?>

				<div class="lft-archiveitem-col col-sm-3">
					<a href="<?php echo get_permalink(); ?>" data-open="lft-modal" class="gallery-item">
						<?php the_post_thumbnail( 'lft-gallery-thumb' ); ?>
						<div class="overlay"><h3><span><?php echo get_post_custom_values('event_year')[0]; ?></span></h3></div>
					</a>
				</div>

				<?php endwhile;?>

			</div>
		</section>

		<?php endif; /*end archiveitems section*/?>



	</main>
	


<?php get_footer(); ?>

