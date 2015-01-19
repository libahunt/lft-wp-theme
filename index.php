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
	'order' => 'ASC' 
);
$galleryitems = new WP_Query( $args );

$args = array( 
	'post_type' => 'lft_archiveitem',
	'nopaging' => 'true', 
	'orderby' => 'meta_value',  
	'meta_key' => 'event_year', 
	'order' => 'ASC' 
);
$archiveitems = new WP_Query( $args );

$args = array( 
	'post_type' => 'lft_sponsor',
	'nopaging' => 'true', 
	'order' => 'DESC' 
);
$sponsors = new WP_Query( $args );

/*EVENT DATES DISPLAY*/
function lft_format_date($yyyyxmmxdd) {
  //$dayofweek = date('w', strtotime($date));
  //$result    = date('Y-m-d', strtotime(($day - $dayofweek).' day', strtotime($date)));
  return getdate(strtotime($yyyyxmmxdd))['wday'];
  //return substr(yyyymmdd, 6, 2) . substr(yyyymmdd, 4, 2) . substr(yyyymmdd, 0, 4)  . 
}

?>

<a id="anchors-menu-toggle" href="#anchors-menu">Menüü</a>
<nav id="anchors-menu">
	<ul>
		<li><?php if ( $sponsors->have_posts() ) : echo('<a href="#toetajad">Toetajad</a>'); endif; ?></li>
		<li><?php if ( !have_posts() ) : echo('<span>Uudised</span>'); else: echo('<a href="#uudised">Uudised</a>'); endif; ?></li>
		<li><?php if ( !$all_events->have_posts() ) : echo('<span>Kava 2015</span>'); else: echo('<a href="#kava">Kava 2015</a>'); endif; ?></li>
		<li><?php if ( !$workshops->have_posts() ) : echo('<span>Töötoad</span>'); else: echo('<a href="#tootoad">Töötoad</a>'); endif; ?></li>
		<li><?php if ( !$movies->have_posts() ) : echo('<span>Kino</span>'); else: echo('<a href="#kino">Kino</a>'); endif; ?></li>
		<li><a href="#meist">Meist</a></li>
		<li><?php if ( $galleryitems->have_posts() ) : echo('<a href="#galerii">Galerii</a>'); endif; ?></li>
		<li><?php if ( $archiveitems->have_posts() ) : echo('<a href="#arhiiv">Arhiiv</a>'); endif; ?></li>
	</ul>
</nav>



	<main id="content-area" class="container-fluid">

		
		<?php /*sponsors section*/ if ( $galleryitems->have_posts() ) :?>

		<section id="toetajad" class="row">
			<h2 class="col-sm-12">Toetajad</h2>
			<ul>
			<?php while ( $sponsors->have_posts() ) : $sponsors->the_post(); ?>
				
				<?php if (has_post_thumbnail()): ?>

				<li class="col-sm-4 lft-sponsors-col sponsor-logo">
					<div class="box"><?php the_post_thumbnail( 'lft-gallery-thumb' ); ?><div class="overlay"><span class="name"><span><?php the_title(); ?></span></span></div></div>
				</li>

				<?php else: ?>

				<li class="col-sm-4 lft-sponsors-col sponsor-name">
					<div class="box"><div class="overlay"><span class="name"><span><?php the_title(); ?></span></span></div></div>
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




		
		<?php /*all_events section*/ if ( $all_events->have_posts() ) : ?>
		<?php $event_date_save = ""; ?>
		<section id="kava" class="row">
			<div class="col-sm-12">
				<h2>Kava</h2>
		
				<?php while ( $all_events->have_posts() ) : $all_events->the_post(); ?>

					<?php if ($event_date_save != get_post_custom_values('event_date')[0]) {
						echo '<h3>';
						lft_format_date(get_post_custom_values('event_date')[0]); 
						echo '</h3>';
						$event_date_save = get_post_custom_values('event_date')[0];
					} ?>

				<a href="<?php echo get_permalink(); ?>" data-open="lft-modal" class="event-item event-<?php echo get_post_custom_values('event_time')[0]; ?>">
					<span class="time"><?php echo get_post_custom_values('event_time')[0]; ?></span>
					<h4><?php the_title(); ?></h4>
				</a>

				<?php endwhile;?>

			</div>
		</section>

		<?php endif; /*end all_events section*/?>





		<?php /*workshops section*/if ( $workshops->have_posts() ) :?>

		<section id="tootoad" class="row">
			<h2>Töötoad</h2>

			<?php while ( $workshops->have_posts() ) : $workshops->the_post(); ?>
				<a class="workshop-item col-sm-4" href="<?php echo get_permalink(); ?>" data-open="lft-modal">
					<h3><?php the_title(); ?></h3>
				</a>
			<?php endwhile;?>
			
		</section>

		<?php endif; /*end workshops section*/?>




		<?php /*movies section*/ if ( $movies->have_posts() ) : ?>
		
		<?php $event_date_save = ""; ?>
		<section id="kino" class="row">
			<div class="col-sm-12">
				<h2>Kino</h2>

				<?php while ( $movies->have_posts() ) : $movies->the_post(); ?>

					<?php if ($event_date_save != get_post_custom_values('event_date')[0]) {
						echo '<h3>';
						echo get_post_custom_values('event_date')[0]; 
						echo '</h3>';
						$event_date_save = get_post_custom_values('event_date')[0];
					} ?>

					<a href="<?php echo get_permalink(); ?>" data-open="lft-modal" class="event-item event-<?php echo get_post_custom_values('event_date')[0]; ?>">
						<span class="time"><?php echo get_post_custom_values('event_time')[0]; ?></span>
						<h4><?php the_title(); ?></h4>
					</a>

				<?php endwhile;?>

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

