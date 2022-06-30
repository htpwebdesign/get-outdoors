<?php
/**
 * The template for displaying the contact page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
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

			echo do_shortcode('[contact-form-7 id="35" title="Contact Form"]');

			get_template_part( 'template-parts/location' );

			if (function_exists('have_rows')) {
				if ( have_rows('faq_repeater')) {
					while( have_rows('faq_repeater')) {
						the_row();
						$faq_question = get_sub_field('faq_question');
						$faq_answer = get_sub_field('faq_answer');
						?>
							<h3><?php echo $faq_question ?></h3>
							<p><?php echo $faq_answer ?></p>
						<?php
					};
				};
			};

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();