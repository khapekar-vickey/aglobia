<?php
/**
 * The template for displaying the footer
 *
 * @package Construction Hub
 * @subpackage construction_hub
 */

?>

		</div>
		<div id="footer" class="site-footer">
			<?php
				get_template_part( 'template-parts/footer/footer', 'widgets' );

				get_template_part( 'template-parts/footer/site', 'info' );
			?>
		</div>
	</div>
</div>
<?php wp_footer(); ?>

</body>
</html>
