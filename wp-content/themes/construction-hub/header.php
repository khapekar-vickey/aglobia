<?php
/**
 * The header for our theme
 *
 * @package Construction Hub
 * @subpackage construction_hub
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width">
  <link rel="profile" href="<?php echo esc_url( __( 'http://gmpg.org/xfn/11', 'construction-hub' ) ); ?>">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div class="headerimg"></div>
<div id="header">
<?php
  get_template_part( 'template-parts/header/site', 'branding' );

  get_template_part( 'template-parts/navigation/site', 'nav' );
?>
</div>