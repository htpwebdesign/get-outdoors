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
				<?php wp_nav_menu( array( 'theme_location' => 'footer-1') ); ?>
			</nav>
			<nav id="footer-misc-links">
				<?php wp_nav_menu( array( 'theme_location' => 'footer-2') ); ?>
			</nav>
			<section class="copyright">
				<p>&copy; Get Outdoors - 
					<a href="https://michikohasegawa.com/" target="_blank" rel="noopener noreferrer">Michiko Hasegawa</a>,
					<a href="https://evanwliao.com/" target="_blank" rel="noopener noreferrer">Evan Liao</a>,
					<a href="https://casims.ca/" target="_blank" rel="noopener noreferrer">Connor Sims</a>,
					<a href="https://dywprojects.ca/" target="_blank" rel="noopener noreferrer">David Wang</a>
				</p>
			</section>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
