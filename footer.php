<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Get_Outdoors
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="site-info">
			<div id="footer-store-info">
			<h2>Store Info</h2>
				<?php
					if (function_exists('get_field')) {
						if ( get_field('store_address', 14)) {
							the_field('store_address', 14);
						};
						if ( get_field('store_phone_number', 14)) {
							?>
							<p><?php the_field('store_phone_number', 14); ?></p>
							<?php
						};
						if ( get_field('store_e-mail', 14)) {
							?>
							<p><?php the_field('store_e-mail', 14); ?></p>
							<?php
						};
				?>
			</div>
			<div id="footer-store-hours">
				<h2>Store Hours</h2>
					<?php
						if (get_field('store_hours', 14)) {
							the_field('store_hours', 14);
						};
					};
				?>
			</div>
			<div id="footer-social-media">
				<a id="footer-sm-facebook" href="https://www.facebook.com/">Facebook</a>
				<a id="footer-sm-twitter" href="https://www.twitter.com/">Twitter</a>
				<a id="footer-sm-instagram" href="https://www.instagram.com/">Instagram</a>
			</div>
			<div id="footer-misc-links">
				<a id="footer-privacy-policy" href="<?php echo get_permalink( 3 ) ?>">Privacy Policy</a>
				<a id="home-refundsreturns-policy" href="<?php echo get_permalink( 24 ) ?>">Refunds and Returns Policy</a>	
				<a id="home-faq-button" href="<?php echo get_permalink( 14 ) ?>#faq">FAQs</a>	
			</div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
