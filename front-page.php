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

			// print_r($bundled_item);

			// $test = wc_pb_get_bundled_product_map(209);
			// print_r($test);

			// $product = wc_get_product(209);
			// print_r($product);

		?>

		<section id="home-featured-bundle">
			<?php
				if (function_exists( 'get_field' )) {
					$featuredbundle = get_field( 'featuredbundle' );
					// print_r($featuredbundle);
					if ($featuredbundle) {
						?>
							<h3><?php echo esc_html($featuredbundle->post_title) ?></h3>
							<p><?php echo esc_html($featuredbundle->post_content) ?></p>
						<?php
						// $test = $featuredbundle->get_bundled_item( $featuredbundle->ID );
						// print_r($test);
					}
				}
			?>
		</section>

		<section id="home-new-products">
			<?php
				$args = array(
					'post_type' => 'product',
					'posts_per_page' => 4,
					'orderby' => 'date',
					'tax_query' => array(
						array(
							'taxonomy' => 'product_cat',
							'field' => 'term_id',
							'terms' => array( 49 ),
							'operator' => 'NOT IN',
						),
					),
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
										<p><?php echo esc_html( get_term( $term )->name ); ?></p>
									</a>
								</li>
							<?php
						}
					};
				}
			?>
		</section>

		<section id="home-upcomming-workshops">
			<h2>Upcoming Workshops</h2>
		</section>

		<section id="home-faq-cta">
			<h2>Have Questions?</h2>
			<p>Check out our Frequently Asked Questions!</p>
			<a id="home-faq-button" href="<?php echo get_permalink( 14 ) ?>#faq">FAQs</a>
		</section>

		<section id="home-newsletter-signup">
			<h3>Newsletter</h3>
			<p>Sign up for our newsletter to keep up to date and recieve news about our latest products an upcoming workshops you can attend!</p>
		</section>
		<?php
			endwhile;
		?>
	</main><!-- #main -->

<?php
get_footer();