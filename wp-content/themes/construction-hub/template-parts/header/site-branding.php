<?php 
/*
* Display Logo and contact details
*/
?>

<div class="container">
  <div class=" headerbox">
    <div class="row m-0 contact-section ">
      <div class="col-lg-4 col-md-4">
        <i class="fas fa-phone"></i><span class="infotext"><?php echo esc_html( get_theme_mod('construction_hub_call_text','') ); ?></span>
        <?php if(get_theme_mod( 'construction_hub_call' ) != '') { ?>
          <span class="simplep"><?php echo esc_html( get_theme_mod('construction_hub_call','') ); ?></span>
        <?php } ?>
      </div>      
      <div class="col-lg-4 col-md-4">
        <div class="logo">
          <?php if( has_custom_logo() ){ construction_hub_the_custom_logo();
           }else{ ?>
          <h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
          <?php $construction_hub_description = get_bloginfo( 'description', 'display' );
          if ( $construction_hub_description || is_customize_preview() ) : ?> 
              <p class="site-description"><?php echo esc_html($construction_hub_description); ?></p> 
          <?php endif; }?>
        </div>
      </div>      
      <div class="col-lg-4 col-md-4 email">
        <i class="fas fa-at"></i><span class="infotext"><?php echo esc_html( get_theme_mod('construction_hub_mail_text','')); ?></span>
        <?php if( get_theme_mod( 'construction_hub_mail' ) != '') { ?>
          <span class="simplep"><?php echo esc_html( get_theme_mod('construction_hub_mail','') ); ?></span>
        <?php } ?>
      </div>
    </div>
  </div> 
</div>