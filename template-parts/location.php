<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Get_Outdoors
 */

?>

<div id="locationpart-store-info">
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
<div id="locationpart-store-hours">
	<h2>Store Hours</h2>
		<?php
			if (get_field('store_hours', 14)) {
				the_field('store_hours', 14);
			};
		};
	?>
</div>

<?php