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

			get_template_part( 'template-parts/page-header');

			if (have_rows('aboutpagerepeater')) : 
				while ( have_rows('aboutpagerepeater') ) : the_row(); 
					$image = get_sub_field('aboutsubimage', false);
					$size = 'large'; ?>

					<article>
						<?php if ( $image ) {
							echo wp_get_attachment_image($image, $size);
						} ?>

						<p> <?php the_sub_field('aboutsubtext'); ?></p>

					</article>

				<?php endwhile;
	
			endif; ?> 

			<h2><?php the_field('cta_text'); ?></h2>

			<?php 
				$link = get_field('about_page_cta');
				if( $link ): 
					$link_url = $link['url'];
					$link_title = $link['title'];
					$link_target = $link['target'] ? $link['target'] : '_self';
					?>
					<a class="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
				<?php endif; ?>
			
		<?php endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
