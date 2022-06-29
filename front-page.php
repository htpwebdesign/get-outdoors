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
			<?php
				if (function_exists( 'get_field' )) {
					$featuredbundle = get_field( 'featuredbundle' );
					if ($featuredbundle) {
						$bundleproduct = wc_get_product($featuredbundle->ID);
						?>
							<article id="home-featured-bundle">
								<img src="<?php echo wp_get_attachment_url( $bundleproduct->get_image_id() ); ?>" />
								<h3><?php echo $bundleproduct->get_name() ?></h3>
								<p><?php echo $bundleproduct->get_description() ?></p>
								<p><?php echo $bundleproduct->get_price_html(); ?></p>
								<a href="<?php echo $bundleproduct->get_permalink() ?>">More Info</a>
						<?php
						$results = WC_PB_DB::query_bundled_items( array(
							'return'    => 'id=>product_id',
							'bundle_id' => array( $featuredbundle->ID )
						) );
						foreach ($results as $result) {
							echo get_the_post_thumbnail($result, "medium");
							echo get_the_title($result);
						?>
							</article>
						<?php
						};
					};
				};
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
			<?php
				$args = array(
						'post_type' 		=> 'tribe_events',
						'posts_per_page' 	=> 2,
						'orderby'			=> 'date',
					);
					$events_query = new WP_Query( $args );
					if ( $events_query -> have_posts() ) {
						while ( $events_query -> have_posts() ) {
							$events_query -> the_post();
							?>
							<article>
								<?php the_post_thumbnail( 'thumbnail' ); ?>
								<h3><?php the_title(); ?></h3>
								<?php the_content(); ?>
							</article>
							<?php
						}
						wp_reset_postdata();
					}
			?>
			<a href="events/">See Event Details</a>
		</section>

		<section id="home-faq-cta">
			<h2>Have Questions?</h2>
			<p>Check out our Frequently Asked Questions!</p>
			<a id="home-faq-button" href="<?php echo get_permalink( 14 ) ?>#faq">FAQs</a>
		</section>

		<section id="home-newsletter-signup">
			<h2>Newsletter</h2>
			<p>Sign up for our newsletter to keep up to date and recieve news about our latest products an upcoming workshops you can attend!</p>
			<?php echo do_shortcode('[jetpack_subscription_form title="Subscribe" subscribe_placeholder="Enter your e-mail here..." subscribe_text="Recieve updates from Get Outdoors!" subscribe_button="Submit" success_message="You are now subscribed!"]'); ?>
		</section>
		<?php
			endwhile;
		?>
	</main><!-- #main -->

<?php
get_footer();