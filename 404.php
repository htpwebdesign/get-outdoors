<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Get_Outdoors
 */

get_header();
?>

	<main id="primary" class="site-main">

		<section class="error-404 not-found">
			<header class="page-header">
				<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'get-outdoors' ); ?></h1>
			</header><!-- .page-header -->

			<div class="page-content">
				<?php 
				$custom_logo_id = get_theme_mod( 'custom_logo' );
				$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
				 
				if ( has_custom_logo() ) {
					echo '<img src="' . esc_url( $logo[0] ) . '" alt="' . get_bloginfo( 'name' ) . '">';
				} else {
					echo '<h1>' . get_bloginfo('name') . '</h1>';
				}
				?>

				<p class="go-back-home"> <?php esc_html_e( 'Please go back to the home.', 'get-outdoors' ) ?> </p>
				<a class="button home-link" href="<?php echo get_home_url(); ?>"><?php esc_html_e( 'Home', 'get-outdoors' ) ?></a>
			</div><!-- .page-content -->
		</section><!-- .error-404 -->

	</main><!-- #main -->

<?php
get_footer();
