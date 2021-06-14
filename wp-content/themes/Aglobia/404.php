<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package icarefurnishers
 */

get_header();
?>

	<div id="primary" class="content-area vickey">
		<main id="main" class="site-main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'icarefurnishers' ); ?></h1>
				</header><!-- .page-header -->
				<div class="error-404-image-sec">
						<img src="http://aglobia.icarefurnishers.com/wp-content/uploads/sites/5/2020/06/404-page.png" alt="">
				</div>
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
