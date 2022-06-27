<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
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
		?>

		<section id="home-featured-bundle">

		</section>

		<section id="home-new-products">
			<?php
				$args = array(
					'post_type' => 'product',
					'posts_per_page' => 4,
					'orderby' => 'date',
				);
				
				$query = new WP_Query( $args );
				if ( $query -> have_posts() ) {
					?>
						<h2>Newest Products</h2>
					<?php
					while ( $query -> have_posts() ) {
						$query -> the_post();
						$product = wc_get_product( get_the_ID() );
						?>
						<article>
							<a href="<?php echo $product->get_permalink() ?>">
								<?php
									the_post_thumbnail( 'medium' );
								?>
								<h3><?php echo $product->get_name() ?></h3>
							</a>
							<p><?php echo $product->get_price_html(); ?></p>
						</article>
						<?php
					}
					wp_reset_postdata();
				}
			?>
		</section>

		<section id="home-featured-categories">
			<?php
				if (function_exists( 'get_field' )) {
					$terms = get_field('fourcate');

					if ($terms) {
						?>
						<ul>
						<?php
						foreach ($terms as $term) {
							$thumb_id = get_woocommerce_term_meta( $term->term_id, 'thumbnail_id', true );
							$term_img = wp_get_attachment_url(  $thumb_id );
							?>
								<li>
									<a href="<?php echo esc_url(get_term_link( $term )) ?>">
											<img src="<?php $term_img ?>">
										<?php echo esc_html( get_term( $term )->name ); ?>
									</a>
								</li>
							<?php
						}
					};
				}
			?>
		</section>

		<section id="home-upcomming-workshops">

		</section>

		<section id="home-faq-cta">

		</section>

		<section id="home-newsletter-signup">

		</section>
		<?php
			endwhile;
		?>
	</main><!-- #main -->

<?php
get_footer();