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

?>

	<main id="content-area" class="container-fluid">

		<nav id="anchors-menu">
			<ul>
				<li><?php if ( !have_posts() ) : echo('<span>Uudised</span>'); else: echo('<a href="#uudised">Uudised</a>'); endif; ?></li>
				<li><?php if ( !$all_events->have_posts() ) : echo('<span>Kava 2015</span>'); else: echo('<a href="#kava">Kava 2015</a>'); endif; ?></li>
				<li><?php if ( !$workshops->have_posts() ) : echo('<span>Töötoad</span>'); else: echo('<a href="#töötoad">Töötoad</a>'); endif; ?></li>
				<li><?php if ( !$movies->have_posts() ) : echo('<span>Kino</span>'); else: echo('<a href="#kino">Kino</a>'); endif; ?></li>
				<li><a href="#meist">Meist</a></li>
				<li><?php if ( $galleryitems->have_posts() ) : echo('<a href="#galerii">Galerii</a>'); endif; ?></li>
				<li><?php if ( $archiveitems->have_posts() ) : echo('<a href="#arhiiv">Arhiiv</a>'); endif; ?></li>
			</ul>
		</nav>

		
		

		<?php if ( have_posts() ) : ?>
			
		<div id="uudised" class="row">
			<div class="col-md-12">
				<h2>Uudised</h2>
				<ul>
					<?php while ( have_posts() ) : the_post(); ?>
					<li>
						<a href="<?php echo get_permalink(); ?>" data-toggle="modal">
							<h3><?php echo the_title();?></h3>
						</a>
						<div class="lead"><?php echo the_content(); ?></div>
					</li>
					<?php endwhile; ?>
				</ul>
			</div>
		</div>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>




		
		<?php if ( $all_events->have_posts() ) : ?>

		<div id="kava" class="row">
			<div class="col-md-12">
				<h2>Kava</h2>
		
				<?php while ( $all_events->have_posts() ) : $all_events->the_post(); ?>
				<a href="<?php echo get_permalink(); ?>" data-toggle="modal" class="event-<?php echo get_post_custom_values('event_date')[0]; ?>">
					<span class="time"><?php echo get_post_custom_values('event_time')[0]; ?></span>
					<h3><?php the_title(); ?></h3>
				</a>
				<?php endwhile;?>

			</div>
		</div>

		<?php endif; /*end all_events section*/?>


		<?php if ( $workshops->have_posts() ) :?>

		<div id="töötoad" class="row">
			<h2>Töötoad</h2>

			<?php while ( $workshops->have_posts() ) : $workshops->the_post(); ?>
				<a class="col-md-6" href="<?php echo get_permalink(); ?>" data-toggle="modal">
					<h3><?php the_title(); ?></h3>
				</a>
			<?php endwhile;?>
			
		</div>

		<?php endif; /*end workshops section*/?>




		<?php if ( $movies->have_posts() ) : ?>

		<div id="kino" class="row">
			<div class="col-md-12">
				<h2>Kino</h2>

				<?php $args = array( 'post_type' => 'lft_movie' );
				$loop = new WP_Query( $args );
				while ( $movies->have_posts() ) : $movies->the_post(); ?>
					<a href="<?php echo get_permalink(); ?>" data-toggle="modal" class="event-<?php echo get_post_custom_values('event_date')[0]; ?>">
						<span class="time"><?php echo get_post_custom_values('event_time')[0]; ?></span>
						<h3><?php the_title(); ?></h3>
					</a>
				<?php endwhile;?>

			</div>
		</div>
		
		<?php endif; /*end movies section*/?>





		<div id="meist" class="row">
			<div class="col-md-12">
				<?php $aboutpage = get_post(40); ?>
				<h2><?php echo apply_filters( 'the_title', $aboutpage->post_title );?></h2>
				<div class="text-block"><?php echo apply_filters( 'the_content', $aboutpage->post_content ) ?></div>
			</div>
		</div>






		<?php if ( $galleryitems->have_posts() ) :?>

		<div id="galerii" class="row">
			<h2 class="col-md-12">Galerii</h2>

			<?php while ( $galleryitems->have_posts() ) : $galleryitems->the_post(); ?>
				<div class="col-md-6">
					<a href="<?php echo get_permalink(); ?>" data-toggle="modal">
						<?php the_post_thumbnail( 'lft-gallery-thumb' ); ?>
						<div class="overlay"><h3><span><?php the_title(); ?></span></h3></div>
					</a>
				</div>
			<?php endwhile;?>
			
		</div>

		<?php endif; /*end galleryitems section*/?>




		<?php if ( $archiveitems->have_posts() ) : ?>

		<div id="arhiiv" class="row">
			<div class="col-md-12">
				<h2>Arhiiv</h2>
		
				<?php while ( $archiveitems->have_posts() ) : $archiveitems->the_post(); ?>
				<a href="<?php echo get_permalink(); ?>" data-toggle="modal">
					<span class="time"><?php echo get_post_custom_values('event_year')[0]; ?></span>
					<h3><?php the_title(); ?></h3>
				</a>
				<?php endwhile;?>

			</div>
		</div>

		<?php endif; /*end all_events section*/?>



	</main>
	


<?php get_footer(); ?>

