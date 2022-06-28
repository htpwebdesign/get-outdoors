<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Get_Outdoors
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			// while ( have_posts() ) :
			// 	the_post();

			// 	/*
			// 	 * Include the Post-Type-specific template for the content.
			// 	 * If you want to override this in a child theme, then include a file
			// 	 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
			// 	 */
			// 	get_template_part( 'template-parts/content', get_post_type() );

			// endwhile;

			$args = array(
				'post_type'     => 'go-event',
				'post_per_page' => -1,
			);

			$query = new WP_Query( $args );
			if( $query -> have_posts() ) {
				?>
				<?php
				while( $query->have_posts()) {
					$query->the_post();
					?>
					<section class="event">
						<!-- Display the Image -->
						<div class="work-img">
						<?php the_post_thumbnail('event-archive-img'); 
						?>
						</div>

						<div class="event-details">
						<!-- Display Date -->
							<p><?php the_field('date'); ?></p>
							<h2><?php the_title(); ?></h2>
							<p><?php the_field('event_description'); ?></p>
							<p><?php the_field('address'); ?></p>
						</div>
					</section>
					<?php
				}
				
				wp_reset_postdata();

			};


			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
