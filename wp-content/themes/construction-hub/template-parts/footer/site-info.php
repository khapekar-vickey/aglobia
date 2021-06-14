<?php
/**
 * Displays footer site info
 *
 * @package Construction Hub
 * @subpackage construction_hub
 */

?>
<div class="site-info">
	<div class="container">
		<p><?php echo esc_html(get_theme_mod('construction_hub_footer_text',__('Construction WordPress Theme By','construction-hub'))); ?> <?php construction_hub_credit(); ?></p>
	</div>
</div>