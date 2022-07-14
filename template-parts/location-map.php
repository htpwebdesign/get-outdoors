<?php
/**
 * Template part for Map/Location Google Map
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Get_Outdoors
 */

$location = get_field('store_map');
if( $location ): ?>
    <div class="acf-map" data-zoom="13.75">
        <div class="marker" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>"></div>
    </div>
<?php endif;
