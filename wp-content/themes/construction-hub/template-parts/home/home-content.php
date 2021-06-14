<?php
/**
 * Template part for displaying home page content
 *
 * @package Construction Hub
 * @subpackage construction_hub
 */

?>

<div id="main-content">
	<div class="container">
	  	<?php while ( have_posts() ) : the_post(); ?>
	  		<?php the_content(); ?>
	  	<?php endwhile; // end of the loop. ?>
	</div>
</div>