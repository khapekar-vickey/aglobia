<?php

/*
Template Name: Team Page Template -old
*/

get_header(); 
$page_id = get_queried_object_id();
?>
<style type="text/css">
.page-template-page-team #about {
	padding-top:80px; 
	padding-bottom:0;
}
.page-template-page-team .block {
    padding: 100px 0;
    overflow: hidden;
    position: relative;
}
.page-template-page-team .block  h3 {
    font-size: 16px;
    font-weight: bold;
    margin-bottom: 30px;
}
.page-template-page-team #about h2 {
    margin-top: 5px;
    margin-bottom: 60px;
    font-weight:normal; 
    font-size:20px; 
    opacity:0.6;
}
.page-template-page-team #team{
	padding-top:100px;
	 padding:0;
}
.page-template-page-team .team ul {
    padding: 0;
    list-style: none;
    display: flex;
    display: -webkit-flex;
    display: -ms-flex;
    flex-direction: row;
    justify-content: space-between;
    flex-wrap: wrap;
}
.page-template-page-team .team ul li {
    width: 30%;
    position: relative;
    margin-top: 30px;
}
.page-template-page-team .team ul li img {
    width: 100%;
}
.page-template-page-team .team ul li .team-desc {
    width: 100%;
    display: flex;
    display: -webkit-flex;
    display: -ms-flex;
    flex-direction: column;
    position: relative;
    transition: all .3s ease-in-out;
    -webkit-transition: all .3s ease-in-out;
    -ms-transition: all .3s ease-in-out;
    -o-transition: all .3s ease-in-out;
    -moz-transition: all .3s ease-in-out;
}
.page-template-page-team .team ul li .team-desc h3 {
    color: #000;
    margin-bottom: 10px;
    font-size: 16px;
    font-weight: bold;
}
.page-template-page-team .team ul li .team-desc p {
    color: #000;
    opacity: 1.6;
    line-height: 20px;
}
/*Detailed about section*/
.page-template-page-team .detail {
    margin-bottom: 80px;
}
.page-template-page-team .detail:last-child {
    margin-bottom: 30px;
}
.page-template-page-team .detail .title {
    z-index: 2;
    position: relative;
}
.page-template-page-team .detail.left-align .title {
    text-align: left;
}
.page-template-page-team .detail.left-align .title .framed {
    padding-right: 100px;
}
.page-template-page-team .detail .title .framed {
    padding-bottom: 100px;
}
.page-template-page-team .detail .title h3 {
    margin-top: 0px;
    margin-bottom: -80px;
}
h3.framed{
    display: inline-block;
}
.framed {
    border: 15px solid rgba(0, 0, 0, 0.05);
    padding: 25px;
}
.page-template-page-team .detail.left-align .gallery {
    padding-left: 70px;
}
.page-template-page-team .detail.right-align .title {
    text-align: right;
}
.page-template-page-team .detail.right-align .title .framed {
    padding-left: 100px;
}
/*Responsive*/
@media screen and (max-width: 992px){
	.page-template-page-team .team ul li {
    	width: 48%;
	}
}
@media screen and (max-width: 600px){
	.page-template-page-team .team ul li {
	    width: 100%;
	}
}

</style>


<div class="team-description-section" style="background-image: url('https://aglobia.co.in/wp-content/uploads/2020/07/pattern.png');width: 100%; height: 400px;">
	<div class="container">
		<div id="team-discription" class="hero-section project-discription">
			<h2><?php echo get_field('top_banner_heading', $page_id);?></h2>
		</div>
	</div>	

</div>

<div class="block" id="about">
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

<div class="block team" id="team">
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

<div class="block" id="about">
    <div class="container">
        <div class="detail left-align" data-scroll-reveal="enter left and move 20px" data-scroll-reveal-initialized="true" data-scroll-reveal-complete="true">
            <div class="title">
                <h3 class="framed"><?php echo get_field('distribution_block_title', $page_id);?></h3>
            </div>
            <!--end title-->
            <div class="row">
                <div class="col-md-7 col-sm-7">
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
                <div class="col-md-5 col-sm-5">
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
                <div class="col-md-5 col-sm-5">
                    <div class="description"><?php echo get_field('manufacturing_block_info', $page_id);?></div>
                    <!--end description-->
                </div>
                <!--end col-md-5-->
                <div class="col-md-7 col-sm-7">
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
                <div class="col-md-7 col-sm-7">
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
                <div class="col-md-5 col-sm-5">
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

<?php

get_footer(); 

?>