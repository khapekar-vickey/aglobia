<?php
/**
 * Template for displaying search forms in Construction Hub
 *
 * @package Construction Hub
 * @subpackage construction_hub
 */
?>

<?php $construction_hub_unique_id = esc_attr( uniqid( 'search-form-' ) ); ?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">	
	<input type="search" id="<?php echo esc_attr( $construction_hub_unique_id ); ?>" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'construction-hub' ); ?>" value="<?php echo esc_attr(get_search_query()); ?>" name="s" />
	<button type="submit" class="search-submit"><?php echo esc_attr_x( 'Search', 'submit button', 'construction-hub' ); ?></button>
</form>