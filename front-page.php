<?php
/**
 * The template the front page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Get_Outdoors
 */

get_header();
?>

	<main id="primary" class="site-main">
		<h1 class="screen-reader-text">Get Outdoors</h1>
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
						echo wp_get_attachment_image( $bundleproduct->get_image_id(), 'full' ); ?>
						<h2><?php echo $bundleproduct->get_name() ?></h2>
						<p class="bundle-desc"><?php echo $bundleproduct->get_description() ?></p>
						<p class="bundle-price"><?php echo $bundleproduct->get_price_html(); ?></p>
						<div id="bundled-items-container">
						<?php
						$results = WC_PB_DB::query_bundled_items( array(
							'return'    => 'id=>product_id',
							'bundle_id' => array( $featuredbundle->ID )
						) );
						foreach ($results as $result) {
						?> 
							<article class="featuredbundle-item"> 
							<?php
								echo get_the_post_thumbnail($result, "thumbnail");
							?>
								<h3><?php echo get_the_title($result); ?></h3>
							</article>
						<?php
						};
						?>
						</div>
						<div class="button-container">
							<a class="button" href="<?php echo $bundleproduct->get_permalink() ?>">See Bundle Info</a>
						</div>
						<?php
					};
				};
			?>
		</section>

		<section id="home-new-products">
			<?php
				if (function_exists('get_field')) {
					if (get_field('newest_products_heading')) {
						?> 
						<h2><?php echo get_field('newest_products_heading'); ?></h2>
						<?php
					}
				}
				$args = array(
					'post_type' => 'product',
					'posts_per_page' => 4,
					'orderby' => 'date',
					'tax_query' => array(
						array(
							'taxonomy' => 'product_cat',
							'field' => 'term_id',
							'terms' => array( 48 ),
							'operator' => 'NOT IN',
						),
					),
				);
				
				$query = new WP_Query( $args );
				if ( $query -> have_posts() ) {
					?>
					<div class="swiper">
						<div class="swiper-wrapper">
					<?php
					while ( $query -> have_posts() ) {
						$query -> the_post();
						$product = wc_get_product( get_the_ID() );
						?>
							<div class="swiper-slide">
								<?php the_post_thumbnail( 'medium' ); ?>
								<div class="slide-text-container">
									<h3><?php echo $product->get_name() ?></h3>
									<p><?php echo $product->get_price_html(); ?></p>
									<a class="button" href="<?php echo $product->get_permalink() ?>">Product Info</a>
								</div>
							</div>
						<?php
					}
					wp_reset_postdata();
					?>
					</div>
					<nav class="swiper-pagination"></nav>
				</div>
				<button class="swiper-button-prev"></button>
				<button class="swiper-button-next"></button>
				<?php
				}
			?>
		</section>

		<section id="home-featured-categories">
			<?php
				if (function_exists( 'get_field' )) {
					$terms = get_field('fourcate');
					if ($terms) {
						$sales_key = array_search(49, $terms);
						if ($sales_key) {
							$sales_captured = array_slice($terms, $sales_key, 1);
							unset($terms[$sales_key]);
							$sales_popped = array_pop($sales_captured);
							array_unshift($terms, $sales_popped);
						};
						?>
						<ul>
						<?php
						foreach ($terms as $term) {
							$thumb_id = get_term_meta( $term, 'thumbnail_id', true );
							?>
								<li>
									<a href="<?php echo esc_url(get_term_link( $term )) ?>">
										<img src="<?php echo wp_get_attachment_image_url( $thumb_id, 'thumbnail' ); ?>">
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
			<?php
				if (function_exists('get_field')) {
					if (get_field('upcoming_events_heading')) {
						?>
						<h2><?php echo get_field('upcoming_events_heading'); ?></h2>
						<?php
					};
				};
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
								<?php the_post_thumbnail( 'medium' ); ?>
								<div class="home-events-text-wrapper">
									<h3><?php the_title(); ?></h3>
									<?php the_content(); ?>
								</div>
							</article>
							<?php
						}
						wp_reset_postdata();
					}
			?>
				<div class="button-container">
					<a class="button" href="<?php echo get_post_type_archive_link( 'tribe_events' ) ?>">See All Events</a>
				</div>
		</section>

		<section id="home-faq-cta">
			<?php
			if (function_exists('get_field')) {
				if (get_field('faq_cta_heading')) {
					?>
					<h2><?php echo get_field('faq_cta_heading'); ?></h2>
					<?php
				};
				if (get_field('faq_cta_text')) {
					?>
					<p><?php echo get_field('faq_cta_text'); ?></p>
					<?php
				};
			};
			?>
			<a class="button" id="home-faq-button" href="<?php echo get_permalink( 14 ) ?>#faq">FAQs</a>
		</section>

		<section id="home-newsletter-signup">
		<?php
			if (function_exists('get_field')) {
				if (get_field('newsletter_sign-up_heading') && get_field('newsletter_sign-up_text')) {
					echo do_shortcode('[jetpack_subscription_form 
										title="'. get_field('newsletter_sign-up_heading') .'" 
										subscribe_placeholder="Enter your e-mail here..." 
										subscribe_text="'. get_field('newsletter_sign-up_text') .'" 
										subscribe_button="Submit" 
										success_message="You are now subscribed!"]');
					};
				};
		?>
		</section>
		<?php
			endwhile;
		?>
	</main><!-- #main -->

<?php
get_footer();