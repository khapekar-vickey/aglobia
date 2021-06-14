<?php

/*
Template Name: Shop Page Template
*/

get_header(); 
?>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
<!-- ****************** Banner section ******************** -->
   <?php echo do_shortcode("[DkHomepageSlider number='10' posttype='homepage_slider']"); ?>
<!-- ****************** Banner section ******************** -->

   <!-- ******************Feature and category section **************************** -->
	<div class="home-categories-section">
		<div class="container">
		<div class="product-cat-head">
			<h2><?php echo get_field('product_category', $page_id); ?></h2>
		</div>
			<!-- ******************** (Vickey) Date :- 15-06-2020 ********************** -->
			<div class="category-sec">
				<?php echo do_shortcode("[get_me_list_of_SC]"); ?>
			</div>
			<!-- ******************** End (Vickey) Date :- 15-06-2020 ********************** -->       
		</div>
	</div>

<!-- *********************** Covid19 Banner Image  ****************************** -->
	<?php
	$page_id = get_queried_object_id();
	?>
	<div class="covid-19-banner-img-section">
		<div class="container">
			
			<div class="covid-19-header">
				<h2><?php echo get_field('covid-19_header', $page_id); ?></h2>
			</div>
			<?php 
			$banner_image_2 = get_field('banner_image_2', $page_id);
			?>
			<img src="<?php echo $banner_image_2; ?>" alt="<?php echo $banner_image_2; ?>" />
		</div>
	</div>
	



<!-- ************** Category banner section ************************* -->
	<div class="top-selling-silder-section">
		<div class="container">
			<div class="category-sec">
				<div class="top-selling-header">
					<h2><?php echo get_field('top_selling_product', $page_id); ?></h2>
				</div>
				<div class="owl-carousel owl-theme top-selling-owl-carousel">
				<?php
					$args = array(
						'post_type' => 'product',
						'meta_key' => 'total_sales',
						'orderby' => 'meta_value_num',
						'posts_per_page' => 1,
					);
					$loop = new WP_Query( $args );
					while ( $loop->have_posts() ) : $loop->the_post(); 
					global $product; ?>
					<div class="item">
						<a href="<?php the_permalink(); ?>" id="id-<?php the_id(); ?>" title="<?php the_title(); ?>">

							<?php if (has_post_thumbnail( $loop->post->ID )) 
									echo get_the_post_thumbnail($loop->post->ID, 'shop_catalog'); 
									else echo '<img src="'.woocommerce_placeholder_img_src().'" alt="product placeholder Image" width="65px" height="115px" />'; ?>

							<?php the_title(); ?><br>
							<span><?php echo get_woocommerce_currency_symbol().' '. $product->get_price(); ?></span>
						</a>
					</div>
					<?php endwhile; ?>
					<?php wp_reset_query(); ?>
				</div>

			</div>
			<!-- ******************** End (Vickey) Date :- 15-06-2020 ********************** -->       
		</div>
	</div>


<!-- *********************** Banner Image 3 ****************************** -->
	<?php
	$page_id = get_queried_object_id();
	?>
	<div class="banner-image-3-section">
		<div class="container">
			<?php 
			$image = get_field('banner_image_3', $page_id);
			?>
			<img src="<?php echo $image; ?>" alt="<?php echo $image; ?>" />
		</div>
	</div>
	
	
<!-- ****************** NEW MODULAR FURNITURE DESIGNS FOR YOU ********************** -->
<div class="new-modular-furniture-section">
	<div class="container">
		<div class="new_modular_furniture_head">
			<h2><?php echo get_field('new_modular_furniture_head', $page_id); ?></h2>
		</div>
		<div class="owl-carousel owl-theme products new-modular-furniture-owl-carousel"><!--products-->
			<?php
				$args = array( 'post_type' => 'product', 'product_cat' => 'new-modular-furniture', 'orderby' => 'rand' );
				$loop = new WP_Query( $args );
				while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
   
						<div class="item product">
							<a href="<?php echo get_permalink( $loop->post->ID ) ?>" title="<?php echo esc_attr($loop->post->post_title ? $loop->post->post_title : $loop->post->ID); ?>">

								<?php //woocommerce_show_product_sale_flash( $post, $product ); ?>

								<?php if (has_post_thumbnail( $loop->post->ID )) echo get_the_post_thumbnail($loop->post->ID, 'shop_catalog'); else echo '<img src="'.woocommerce_placeholder_img_src().'" alt="Placeholder" width="300px" height="300px" />'; ?>

								<?php the_title(); ?>
								<br>
								<span class="price"><?php echo $product->get_price_html(); ?></span>                    

							</a>

							<?php //woocommerce_template_loop_add_to_cart( $loop->post, $product ); ?>

						</div>

			<?php endwhile; ?>
			<?php wp_reset_query(); ?>
		</div><!--/.products-->
	</div>
</div>


	
<!-- ****************** TRENDY FURNITURE CUSTOMISED FOR YOUR HOME ********************** -->
<div class="trendy_furniture-section">
	<div class="container">
		<div class="trendy_furniture_head">
			<h2><?php echo $image = get_field('trendy_furniture_head', $page_id); ?></h2>
		</div>
		<div class="owl-carousel owl-theme products trendy_furniture-owl-carousel"><!--products-->
			<?php
				$args = array( 'post_type' => 'product', 'product_cat' => 'trendy-furniture', 'orderby' => 'rand' );
				$loop = new WP_Query( $args );
				while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>

					

						<div class="item product">    

							<a href="<?php echo get_permalink( $loop->post->ID ) ?>" title="<?php echo esc_attr($loop->post->post_title ? $loop->post->post_title : $loop->post->ID); ?>">

								<?php //woocommerce_show_product_sale_flash( $post, $product ); ?>

								<?php if (has_post_thumbnail( $loop->post->ID )) echo get_the_post_thumbnail($loop->post->ID, 'shop_catalog'); else echo '<img src="'.woocommerce_placeholder_img_src().'" alt="Placeholder" width="300px" height="300px" />'; ?>

								<?php the_title(); ?>
								<br>
								<span class="price"><?php echo $product->get_price_html(); ?></span>                    

							</a>

							<?php //woocommerce_template_loop_add_to_cart( $loop->post, $product ); ?>

						</div>

			<?php endwhile; ?>
			<?php wp_reset_query(); ?>
		</div><!--/.products-->
	</div>
</div>



<!-- ************* 3,000+ real reviews ********************** -->
<div class="real-reviews-section">
    <div class="container">
		<div class="real-reviews-head">
			<h2 class="home-review-h2"><?php echo  get_field('real_reviews', $page_id);?></h2>
		</div>
         <div class="row">
            <div class="col-md-3">
               <div class="reviews-card">
                  <div class="img-sec">
                     <img src="http://aglobia.icarefurnishers.com/wp-content/uploads/sites/5/2020/05/craftmanship2x.jpg">
                  </div>
                  <h3 class="home-review-title">Craftsmanship</h3>
                  <p class="home-review-p">“Quality of materials and craftsmanship make it look and feel like a high-end purchase, minus the price tag.”</p>
                  <!--<div class="home-stars hidden-xs"></div>-->
                  <span class="home-review-author"> <span class="home-review-emoji">😃</span> Tom W · New York</span>
               </div>
            </div>
            <div class="col-md-3">
               <div class="reviews-card">
                  <div class="img-sec">
                     <img src="http://aglobia.icarefurnishers.com/wp-content/uploads/sites/5/2020/05/design2x.jpg">
                  </div>
                  <h3 class="home-review-title">Design Advice</h3>
                  <p class="home-review-p">“We were given wonderful attention, advice&nbsp;and&nbsp;support through every stage&nbsp;of&nbsp;the process.”</p>
                  <!--<div class="home-stars hidden-xs"></div>-->
                  <span class="home-review-author"><span class="home-review-emoji">😘</span> Elise J · Brooklyn</span>
               </div>
            </div>
            <div class="col-md-3">
               <div class="reviews-card">
                  <div class="img-sec">
                     <img src="http://aglobia.icarefurnishers.com/wp-content/uploads/sites/5/2020/05/service2x.jpg">
                  </div>
                  <h3 class="home-review-title">Customer&nbsp;service</h3>
                  <p class="home-review-p">“No one can touch the customer service&nbsp;I&nbsp;have received from Interior Define.&nbsp;They are superb.”</p>
                  <!--<div class="home-stars hidden-xs"></div>-->
                  <span class="home-review-author"><span class="home-review-emoji">😊</span> Kathryn H · New York</span>
               </div>
            </div>
            <div class="col-md-3">
               <div class="reviews-card">
                  <div class="img-sec">
                     <img src="http://aglobia.icarefurnishers.com/wp-content/uploads/sites/5/2020/05/delivery2x.jpg">
                  </div>
                  <h3 class="home-review-title">Delivery</h3>
                  <p class="home-review-p">“Delivery was white glove and very good.&nbsp;I&nbsp;also liked the updates on the&nbsp;status&nbsp;of production.”</p>
                  <!--<div class="home-stars hidden-xs"></div>-->
                  <span class="home-review-author"><span class="home-review-emoji">😅</span> Daniel S · California</span>
               </div>
            </div>
         </div>
      </div>
   </div>
<!-- ************* OUR HAPPY CUSTOMER REVIEW VIDEO SECTION *************** -->
<div class="customer review-vedie-section">
	<div class="container">
		<div class="our-happy-customer-head">
			<h2><?php echo  get_field('our_happy_customers', $page_id);?></h2>
		</div>
		<div class="row">
			<div class="col youtube_video">
				<?php // use inside loop
					//echo the_field('youtube_video_3');
					$videoEmbeddPlease = the_field('youtube_video_1');
					if (!empty($videoEmbeddPlease)): ?>

						<iframe src="<?php echo $videoEmbeddPlease?>" allow="accelerometer; autoplay;" allowfullscreen></iframe>

					<?php endif ?>
			</div>
		</div>
	</div>
</div>

<!-- ************* Our policies are top-notch *************** -->
   <div class="our-policies-section">
      <div class="container">
         <div class="our-policies-head">
            <h2 class="home-policies-h2"><?php echo  get_field('our_policies_are_top-notch', $page_id);?></h2>
         </div>
         <div class="row home-policies-row">
            <a href="#" class="home-policies-col home-policies-col-delivery">
				<?php 
				$image1 = get_field('image_1', $page_id);
				?>
				<img src="<?php echo $image1; ?>" alt="<?php echo $image1; ?>" />
				<p>Unlimited furniture delivery</p>
			</a>
            <a href="#" class="home-policies-col home-policies-col-warranty">
				<?php 
				$image2 = get_field('image_2', $page_id);
				?>
				<img src="<?php echo $image2; ?>" alt="<?php echo $image2; ?>" />
				<p>10-year warranty</p>
			</a>
            <a href="#" class="home-policies-col home-policies-col-returns">
				<?php 
				$image3 = get_field('image_3', $page_id);
				?>
				<img src="<?php echo $image3; ?>" alt="<?php echo $image3; ?>" />
				<p>60-day returns</p>
			</a>
            <a href="#" class="home-policies-col home-policies-col-payment">
				<?php 
				$image4 = get_field('image_4', $page_id);
				?>
				<img src="<?php echo $image4; ?>" alt="<?php echo $image4; ?>" />
				<p>Flexible payments</p>
			</a>
         </div>
      </div>  
   </div>

<!-- ************ PRESS ****************** -->
<div class="press-section">
   <div class="press-head">
      <h2 class="home-press-h2"><?php echo  get_field('press_head', $page_id);?></h2>
   </div>
   <div class="press-slider-sec">
      <div class="owl-carousel owl-press">
         <div class="item">
            <p class="home-press-swiper-text">“Finely made and customizable”</p>
         </div>
         <div class="item">
            <p class="home-press-swiper-text">“Changing the way consumers buy furniture”</p>
         </div>
         <div class="item">
            <p class="home-press-swiper-text">“Personalized customer service”</p>
         </div>
         <div class="item">
            <p class="home-press-swiper-text">“Brush aside any worries about customization”</p>
         </div>
         <div class="item">
            <p class="home-press-swiper-text">“Customers are pampered”</p>
         </div>
         <div class="item">
            <p class="home-press-swiper-text">“Finely made and customizable”</p>
         </div>
         <div class="item">
            <p class="home-press-swiper-text">“Changing the way consumers buy furniture”</p>
         </div>
         <div class="item">
            <p class="home-press-swiper-text">“Personalized customer service”</p>
         </div>
         <div class="item">
            <p class="home-press-swiper-text">“Brush aside any worries about customization”</p>
         </div>
         <div class="item">
            <p class="home-press-swiper-text">“Customers are pampered”</p>
         </div>
         <div class="item">
            <p class="home-press-swiper-text">“Finely made and customizable”</p>
         </div>
         <div class="item">
            <p class="home-press-swiper-text">“Changing the way consumers buy furniture”</p>
         </div>
      </div>
   </div>
</div>

<script type="text/javaScript">

</script>

<?php

get_footer(); 

?>