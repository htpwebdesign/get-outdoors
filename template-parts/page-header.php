<?php
/**
 * Template part for displaying hero banner + page title
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Get_Outdoors
 */

?>

<header class="page-header">
	<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

	<?php get_outdoors_post_thumbnail(); ?>

</header>
