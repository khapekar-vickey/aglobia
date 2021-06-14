<?php
/**
 * Template Name: Front Page
 *
 * @package Construction Hub
 * @subpackage construction_hub
 */
?>

<?php do_action( 'construction_hub_before_slider' ); ?>

<?php get_template_part( 'template-parts/home/slider' ); ?>
<?php do_action( 'construction_hub_after_slider' ); ?>
<?php get_header(); ?>
<?php do_action( 'construction_hub_after_header' ); ?> 
<?php get_template_part( 'template-parts/home/our-project' ); ?>
<?php do_action( 'construction_hub_after_our_project' ); ?>

<?php get_template_part( 'template-parts/home/home-content' ); ?>
<?php do_action( 'construction_hub_after_home_content' ); ?>

<?php get_footer();
