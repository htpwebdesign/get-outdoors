<?php
/**
 * The template for displaying company history/about page
 *
 * @package Get_Outdoors
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			if (have_rows('aboutpagerepeater')) : 
				while ( have_rows('aboutpagerepeater') ) : the_row(); 
					$image = get_sub_field('aboutsubimage', false);
					$size = 'medium';
					if ( $image ) {
						echo wp_get_attachment_image($image, $size);
					} ?>
	
					<?php $sub_value = get_sub_field('aboutsubtext'); ?>
					<p> <?php the_sub_field('aboutsubtext'); ?></p>
				<?php endwhile;
	
			endif; ?> 

			<h2><?php the_field('cta_text'); ?></h2>

			<?php 
				$link = get_field('about_page_cta');
				if( $link ): ?>
					<a class="button" href="<?php echo esc_url( $link ); ?>">Contact Us</a>
			<?php endif; ?>
			
		<?php endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
