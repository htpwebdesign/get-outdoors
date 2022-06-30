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
			<?php get_template_part( 'template-parts/location' ); ?>
			<nav id="footer-social-media">
				<a id="footer-sm-facebook" href="https://www.facebook.com/">Facebook</a>
				<a id="footer-sm-twitter" href="https://www.twitter.com/">Twitter</a>
				<a id="footer-sm-instagram" href="https://www.instagram.com/">Instagram</a>
			</nav>
			<nav id="footer-misc-links">
				<a id="footer-privacy-policy" href="<?php echo get_permalink( 3 ) ?>">Privacy Policy</a>
				<a id="home-refundsreturns-policy" href="<?php echo get_permalink( 24 ) ?>">Refunds and Returns Policy</a>	
				<a id="home-faq-button" href="<?php echo get_permalink( 14 ) ?>#faq">FAQs</a>	
			</nav>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
