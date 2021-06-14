<?php

/*
Template Name: Team Page Template
*/

get_header(); 
$page_id = get_queried_object_id();
?>
<div class="team-template">
	<div class="team-description-section" style="background: url(<?php echo get_field('top_banner_background', $page_id); ?>); width: 100%; height: 400px;">
		<div class="wrapper">
			<div class="hero-title">
				<div class="container">
					<div id="team-discription">
						<h2><?php echo get_field('top_banner_heading', $page_id);?></h2>
					</div>
				</div>	
			</div>
		</div>
	</div>

	<div class="team-block" id="about-team">
	    <div class="container">
	        <div class="row">
	            <div class="col-md-12 col-sm-12" data-scroll-reveal="enter left and move 20px" data-scroll-reveal-initialized="true" data-scroll-reveal-complete="true">
	                <h3><?php echo get_field('our_team_heading', $page_id);?></h3>
	                <h2><?php echo get_field('our_team_para', $page_id);?></h2>
	            </div>
	        </div>
	        <!--end row-->
	    </div>
	    <!--end container-->
	</div>
	<!-- team card section -->
	<div class="team-block team-n" id="team">
	    <div class="container">
	        <ul class="featured-block">
	            <li class="team-card">
	                <img src="<?php echo get_field('team_member_1_img', $page_id);?>" alt="Mr. Balram Jyotwani">
	                <div class="team-desc">
	                    <h3><?php echo get_field('team_member_1_name', $page_id);?></h3>
	                    <p><?php echo get_field('team_member_1_info', $page_id);?></p>
	                </div>
	            </li>
	            <li class="team-card">
	                <img src="<?php echo get_field('team_member_2_img', $page_id);?>" alt="Mr. Jeevan Gujalwar">
	                <div class="team-desc">
	                    <h3><?php echo get_field('team_member_2_name', $page_id);?></h3>
	                    <p><?php echo get_field('team_member_2_info', $page_id);?></p>
	                </div>
	            </li>
	            <li class="team-card">
	                <img src="<?php echo get_field('team_member_3_img', $page_id);?>" alt="Mr. Mahendra Sharma">
	                <div class="team-desc">
	                    <h3><?php echo get_field('team_member_3_name', $page_id);?></h3>
	                    <p><?php echo get_field('team_member_3_info', $page_id);?></p>
	                </div>
	            </li>
	        </ul>
	    </div>
	</div>

	<div class="team-block" id="about-team">
	    <div class="container">
	        <div class="detail left-align" data-scroll-reveal="enter left and move 20px" data-scroll-reveal-initialized="true" data-scroll-reveal-complete="true">
	            <div class="title">
	                <h3 class="framed"><?php echo get_field('distribution_block_title', $page_id);?></h3>
	            </div>
	            <!--end title-->
	            <div class="row">
	                <div class="col-md-7 col-sm-12 middle-align">
	                    <div class="gallery">
	                        <div id="distribution-sldr" class="carousel slide" data-ride="carousel">
								  <ol class="carousel-indicators">
								    <li data-target="#distribution-sldr" data-slide-to="0" class="active"></li>
								    <li data-target="#distribution-sldr" data-slide-to="1"></li>
								    <li data-target="#distribution-sldr" data-slide-to="2"></li>
								  </ol>
								  <div class="carousel-inner">
								    <div class="carousel-item active">
								      <img class="" src="<?php echo get_field('distribution_slider_img1', $page_id);?>" alt="Distribution">
								    </div>
								    <div class="carousel-item">
								      <img class="" src="<?php echo get_field('distribution_slider_img2', $page_id);?>" alt="Distribution">
								    </div>
								    <div class="carousel-item">
								      <img class="" src="<?php echo get_field('distribution_slider_img3', $page_id);?>" alt="Distribution">
								    </div>
								  </div>
							</div>
	                    </div>
	                    <!--end gallery-->
	                </div>
	                <!--end col-md-7-->
	                <div class="col-md-5 col-sm-12">
	                    <div class="description"><?php echo get_field('distribution_block_info', $page_id);?></div>
	                    <!--end description-->
	                </div>
	                <!--end col-md-5-->
	            </div>
	            <!--end row-->
	        </div>
	        <!--end detail-->
	        <div class="detail right-align" data-scroll-reveal="enter right and move 20px" data-scroll-reveal-initialized="true" data-scroll-reveal-complete="true">
	            <div class="title">
	                <h3 class="framed"><?php echo get_field('manufacturing_block_title', $page_id);?></h3>
	            </div>
	            <!--end title-->
	            <div class="row">
	                <div class="col-md-5 col-sm-12">
	                    <div class="description"><?php echo get_field('manufacturing_block_info', $page_id);?></div>
	                    <!--end description-->
	                </div>
	                <!--end col-md-5-->
	                <div class="col-md-7 col-sm-12 middle-align">
	                    <div class="gallery">
	                        <div id="manufacturing-sldr" class="carousel slide" data-ride="carousel">
								 <ol class="carousel-indicators">
								    <li data-target="#manufacturing-sldr" data-slide-to="0" class="active"></li>
								    <li data-target="#manufacturing-sldr" data-slide-to="1"></li>
								    <li data-target="#manufacturing-sldr" data-slide-to="2"></li>
								 </ol>
								 <div class="carousel-inner">
								    <div class="carousel-item active">
								      <img class="" src="<?php echo get_field('manufacturing_slider_img1', $page_id);?>" alt="Manufacturing">
								    </div>
								    <div class="carousel-item">
								      <img class="" src="<?php echo get_field('manufacturing_slider_img2', $page_id);?>" alt="Manufacturing">
								    </div>
								    <div class="carousel-item">
								      <img class="" src="<?php echo get_field('manufacturing_slider_img3', $page_id);?>" alt="Manufacturing">
								    </div>
								</div>
							</div>
	                    </div>
	                    <!--end gallery-->
	                </div>
	                <!--end col-md-7-->
	            </div>
	            <!--end row-->
	        </div>
	        <!--end detail-->
	        <div class="detail left-align" data-scroll-reveal="enter left and move 20px" data-scroll-reveal-initialized="true">
	            <div class="title">
	                <h3 class="framed"><?php echo get_field('process_block_title', $page_id);?></h3>
	            </div>
	            <!--end title-->
	            <div class="row">
	                <div class="col-md-7 col-sm-12 middle-align">
	                    <div class="gallery">
	                        <div id="process-sldr" class="carousel slide" data-ride="carousel">
								 <ol class="carousel-indicators">
								    <li data-target="#process-sldr" data-slide-to="0" class="active"></li>
								    <li data-target="#process-sldr" data-slide-to="1"></li>
								    <li data-target="#process-sldr" data-slide-to="2"></li>
								 </ol>
								 <div class="carousel-inner">
								    <div class="carousel-item active">
								      <img class="" src="<?php echo get_field('process_slider_img1', $page_id);?>" alt="Process">
								    </div>
								    <div class="carousel-item">
								      <img class="" src="<?php echo get_field('process_slider_img2', $page_id);?>" alt="Process">
								    </div>
								    <div class="carousel-item">
								      <img class="" src="<?php echo get_field('process_slider_img3', $page_id);?>" alt="Process">
								    </div>
								</div>
							</div>
	                    </div>
	                    <!--end gallery-->
	                </div>
	                <!--end col-md-7-->
	                <div class="col-md-5 col-sm-12">
	                    <div class="description"><?php echo get_field('process_block_info', $page_id);?></div>
	                    <!--end description-->
	                </div>
	                <!--end col-md-5-->
	            </div>
	            <!--end row-->
	        </div>
	        <!--end detail-->
	    </div>
	    <!--end container-->
	</div>	
</div>

<?php

get_footer(); 

?>