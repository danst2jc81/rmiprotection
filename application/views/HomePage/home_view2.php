

<!DOCTYPE html>
<!--[if IE 8]>			<html class="ie ie8"> <![endif]-->
<!--[if IE 9]>			<html class="ie ie9"> <![endif]-->
<!--[if gt IE 9]><!-->	<html> <!--<![endif]-->
	<head>
		<meta charset="utf-8" />
		<title>Vertect</title>
		<meta name="keywords" content="HTML5,CSS3,Template" />
		<meta name="description" content="" />

		<!-- mobile settings -->
		<meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
		<!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->

		<!-- WEB FONTS : use %7C instead of | (pipe) -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400%7CRaleway:300,400,500,600,700%7CLato:300,400,400italic,600,700" rel="stylesheet" type="text/css" />

		<!-- CORE CSS -->
		<link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

		<!-- REVOLUTION SLIDER -->
		<link href="assets/plugins/slider.revolution/css/extralayers.css" rel="stylesheet" type="text/css" />
		<link href="assets/plugins/slider.revolution/css/settings.css" rel="stylesheet" type="text/css" />

		<!-- THEME CSS -->
		<link href="assets/css/essentials.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/layout.css" rel="stylesheet" type="text/css" />

		<!-- PAGE LEVEL SCRIPTS -->
		<link href="assets/css/header-1.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/color_scheme/yellow.css" rel="stylesheet" type="text/css" id="color_scheme" />
	</head>

	<!--
		AVAILABLE BODY CLASSES:
		
		smoothscroll 			= create a browser smooth scroll
		enable-animation		= enable WOW animations

		bg-grey					= grey background
		grain-grey				= grey grain background
		grain-blue				= blue grain background
		grain-green				= green grain background
		grain-blue				= blue grain background
		grain-orange			= orange grain background
		grain-yellow			= yellow grain background
		
		boxed 					= boxed layout
		pattern1 ... patern11	= pattern background
		menu-vertical-hide		= hidden, open on click
		
		BACKGROUND IMAGE [together with .boxed class]
		data-background="assets/images/boxed_background/1.jpg"
	-->
	
	<script>
		base_url = '<?php echo base_url();?>';
	</script>
	<body class="smoothscroll enable-animation bg-grey">

		<!-- SLIDE TOP -->
		<div id="slidetop">

			<div class="container">
				
				<div class="row">

					<div class="col-md-4">
						<h6><i class="icon-heart"></i> Why Vertect</h6>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas metus nulla, commodo a sodales sed, dignissim pretium nunc. Nam et lacus neque. Ut enim massa, sodales tempor convallis et, iaculis ac massa. </p>
					</div>

					<div class="col-md-4">
						<h6><i class="icon-attachment"></i> </h6>
						<ul class="list-unstyled">
							
						</ul>
					</div>

					<div class="col-md-4">
						<h6><i class="icon-envelope"></i> CONTACT INFO</h6>
						<ul class="list-unstyled">
							<li><b>Address:</b> PO Box 21132, Here Weare St, <br /> Melbourne, Vivas 2355 Australia</li>
							<li><b>Phone:</b> 1-800-565-2390</li>
							<li><b>Email:</b> <a href="mailto:support@yourname.com">support@yourname.com</a></li>
						</ul>
					</div>

				</div>

			</div>

			<a class="slidetop-toggle" href="#"><!-- toggle button --></a>

		</div>
		<!-- /SLIDE TOP -->


		<!-- wrapper -->
		<div id="wrapper">

			<!-- 
				AVAILABLE HEADER CLASSES

				Default nav height: 96px
				.header-md 		= 70px nav height
				.header-sm 		= 60px nav height

				.noborder 		= remove bottom border (only with transparent use)
				.transparent	= transparent header
				.translucent	= translucent header
				.sticky			= sticky header
				.static			= static header
				.dark			= dark header
				.bottom			= header on bottom
				
				shadow-before-1 = shadow 1 header top
				shadow-after-1 	= shadow 1 header bottom
				shadow-before-2 = shadow 2 header top
				shadow-after-2 	= shadow 2 header bottom
				shadow-before-3 = shadow 3 header top
				shadow-after-3 	= shadow 3 header bottom

				.clearfix		= required for mobile menu, do not remove!

				Example Usage:  class="clearfix sticky header-sm transparent noborder"
			-->
			<div id="header" class="sticky clearfix">

				<!-- SEARCH HEADER -->
				<div class="search-box over-header">
					<a id="closeSearch" href="#" class="glyphicon glyphicon-remove"></a>

					<form action="page-search-result-1.html" method="get">
						<input type="text" class="form-control" placeholder="SEARCH" />
					</form>
				</div> 
				<!-- /SEARCH HEADER -->

				<!-- TOP NAV -->
				<header id="topNav">
					<div class="container">

						<!-- Mobile Menu Button -->
						<button class="btn btn-mobile" data-toggle="collapse" data-target=".nav-main-collapse">
							<i class="fa fa-bars"></i>
						</button>

						<!-- BUTTONS -->
						<ul class="pull-right nav nav-pills nav-second-main">

							<!-- SEARCH -->
							<li class="search">
								<a href="javascript:;">
									<i class="fa fa-search"></i>
								</a>
							</li>
							<!-- /SEARCH -->

						</ul>
						<!-- /BUTTONS -->


						<!-- Logo -->
						<a class="logo pull-left" href="<?php echo base_url();?>">
							<img src="assets/images/vertect.png" alt="" />
						</a>

						<!-- 
							Top Nav 
							
							AVAILABLE CLASSES:
							submenu-dark = dark sub menu
						-->
						
						<?php
							$this->load->view('mainmenu_view');			 
						?>
					</div>
				</header>
				<!-- /Top Nav -->

			</div>



			<!-- REVOLUTION SLIDER -->
			<div class="slider fullwidthbanner-container roundedcorners">
				<!--
					Navigation Styles:
					
						data-navigationStyle="" theme default navigation
						
						data-navigationStyle="preview1"
						data-navigationStyle="preview2"
						data-navigationStyle="preview3"
						data-navigationStyle="preview4"
						
					Bottom Shadows
						data-shadow="1"
						data-shadow="2"
						data-shadow="3"
						
					Slider Height (do not use on fullscreen mode)
						data-height="300"
						data-height="350"
						data-height="400"
						data-height="450"
						data-height="500"
						data-height="550"
						data-height="600"
						data-height="650"
						data-height="700"
						data-height="750"
						data-height="800"
				-->
				
				
				<div class="fullwidthbanner" data-height="600" data-shadow="0" data-navigationStyle="preview2">
					<ul class="hide">
						<?php
							$homeBanner = $this->mainpage_model->getHomeBanner();
							foreach($homeBanner as $key=>$val){
								$bannerPosition = $val['banner_position'];
								
								if ($bannerPosition == 0 ){
						?>
						<!-- SLIDE  -->
						<li data-transition="parallaxtobottom" data-slotamount="7" data-masterspeed="600"  data-saveperformance="off"  data-title="<?php echo $val['banner_title'] ?>">
							<!-- MAIN IMAGE -->
							<img src="<?php echo $val['banner_images'] ?>"  alt="cover image"  data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat">

							<div class="tp-caption white_big skewfromleft tp-resizeme"
								data-x="471"
								data-y="100" 
								data-speed="400"
								data-start="1500"
								data-easing="Power3.easeInOut"
								data-splitin="words"
								data-splitout="none"
								data-elementdelay="0.1"
								data-endelementdelay="0.1"
								data-endspeed="600"
								style="z-index: 2; color:#fff; font-size:65px; line-height:85px; font-weight:bold; letter-spacing:0; text-shadow:none;">
									<?php
										echo $val['banner_title'];
									?>
							</div>

							<div class="tp-caption content_text_center skewfromleft tp-resizeme"
								data-x="530"
								data-y="195" 
								data-speed="500"
								data-start="2000"
								data-easing="Power3.easeInOut"
								data-splitin="none"
								data-splitout="none"
								data-elementdelay="0.1"
								data-endelementdelay="0.1"
								data-endspeed="600"

								style="z-index: 3; font-size:20px; color:#fff; font-weight:300; text-shadow:none;">
									<?php
										echo $val['banner_headline'];
									?>
							</div>
							
							<?php 
								$bannerButton1 = $val['banner_button1'];
								$bannerButton2 = $val['banner_button2'];
							?>
							
							<?php
								if ($bannerButton1 != ''){
							?>
								<div class="tp-caption skewfromleft tp-resizeme  un-button-2-lg"
									data-x="530"
									data-y="300" 
									data-speed="300"
									data-start="2500"
									data-easing="Power3.easeInOut"
									data-splitin="none"
									data-splitout="none"
									data-elementdelay="0.1"
									data-endelementdelay="0.1"
									data-endspeed="300"

									style="z-index: 5; max-width: auto; max-height: auto; white-space: nowrap;">
										<a class="btn btn-warning btn-lg" href="#"><?php echo $val['banner_button1']?> &nbsp; <i class="fa fa-angle-right"></i></a>
								</div>
							<?php
								}
							?>
							
							<?php 
								if ($bannerButton2 != ''){
							?>
								<div class="tp-caption skewfromleft tp-resizeme  un-button-2-lg"
									data-x="665"
									data-y="300" 
									data-speed="300"
									data-start="2500"
									data-easing="Power3.easeInOut"
									data-splitin="none"
									data-splitout="none"
									data-elementdelay="0.1"
									data-endelementdelay="0.1"
									data-endspeed="300"

									style="z-index: 5; max-width: auto; max-height: auto; white-space: nowrap;">
										<a class="btn btn-warning btn-lg" href="#"><?php echo $val['banner_button1']?> &nbsp; <i class="fa fa-angle-right"></i></a>
								</div>
							<?php
								}
							?>
						</li>	
							<?php
								}
								elseif ($bannerPosition == 1){
							?>
								<li data-transition="parallaxtotop" data-slotamount="7" data-masterspeed="300"  data-saveperformance="off" data-title="<?php echo $val['banner_title']?>">
									<!-- MAIN IMAGE -->
									<img src="<?php echo $val['banner_images'] ?>" alt="cover image"  data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat">

									<div class="overlay dark-4"><!-- dark overlay [0 to 9 opacity] --></div>

									<div class="tp-caption font-roboto skewfromleft tp-resizeme"
										data-x="50"
										data-y="100" 
										data-speed="500"
										data-start="1500"
										data-easing="Cubic.easeOut"
										data-splitin="none"
										data-splitout="none"
										data-elementdelay="0.1"
										data-endelementdelay="0.1"
										data-endspeed="500"
										style="z-index: 2; color:#fff; font-size:65px; line-height:85px; font-weight:bold; letter-spacing:0; text-shadow:none;">
											<?php
												echo $val['banner_title'];
											?>
									</div>

									<div class="tp-caption skewfromrightshort tp-resizeme"
										data-x="50"
										data-y="300" 
										data-speed="500"
										data-start="1000"
										data-easing="easeInCirc"
										data-splitin="none"
										data-splitout="none"
										data-elementdelay="0.1"
										data-endelementdelay="0.1"
										data-endspeed="500"
										style="z-index: 3; font-size:20px; color:#fff; font-weight:300; text-shadow:none;">
											<?php
												echo $val['banner_headline'];
											?>
									</div>
									
									<?php
										$bannerButton1 = $val['banner_button1'];
										$bannerButton2 = $val['banner_button2'];
									?>
									
									
									<?php
										if ($bannerButton1 != ''){
									?>

										<div class="tp-caption sfb tp-resizeme"
											data-x="50"
											data-y="410" 
											data-speed="500"
											data-start="1500"
											data-easing="Power3.easeIn"
											data-splitin="none"
											data-splitout="none"
											data-elementdelay="1"
											data-endelementdelay="0.1"
											data-endspeed="500"
											style="z-index: 4; max-width: auto;">
												<a class="btn btn-warning btn-lg" href="#"><?php echo $bannerButton1 ?> &nbsp; <i class="fa fa-angle-right"></i></a>
										</div>
									<?php
										}
									?>
									
									<?php
										if ($bannerButton2 != ''){
									?>

										<div class="tp-caption sfb tp-resizeme"
											data-x="250"
											data-y="410" 
											data-speed="500"
											data-start="1500"
											data-easing="Power3.easeInOut"
											data-splitin="none"
											data-splitout="none"
											data-elementdelay="0.1"
											data-endelementdelay="0.1"
											data-endspeed="500"
											style="z-index: 6; max-width: auto; max-height: auto; white-space: nowrap;">
												<a class="btn btn-default btn-lg" href="#"><?php echo $bannerButton1 ?> &nbsp; <i class="fa fa-angle-right"></i></a>
										</div>
									
									<?php
										}
									?>
								</li>
								<?php 
									}
								?>
						
						<?php
							}
						?>
					</ul>

				</div>
			</div>
			<!-- /REVOLUTION SLIDER -->


			<hr class="nomargin" /><!-- 1px line separator -->


			<!-- BUTTON CALLOUT -->
			<a href="#" class="btn btn-xlg btn-primary size-20 fullwidth nomargin noradius padding-40">
				<span class="font-lato size-30">
					Did Smarty convinced you? 
					<strong>Contact us &raquo;</strong>
				</span>
			</a>
			<!-- /BUTTON CALLOUT -->


			
			<!-- Services -->
			<section>
				<div class="container">
					<div class="heading-title heading-dotted text-center">
						<h2>Services</h2>
					</div>
					
					<div class="row">
						<?php
							$contentServices = $this->mainpage_model->getContentServices();
							foreach($contentServices as $key=>$val){
								echo "<div class=\"col-sm-3\">
									<img class=\"img-responsive\" src=\"assets/images/services/".$val['services_images']."\" alt=\"img\" />
									<h3 class=\"margin-top-10\">".$val['services_name']."</h3>
									<p>".$val['services_headline']."</p>
									<a href=\"#\" class=\"btn btn-default\">READ MORE</a>
								</div>";
							}
						?>
					</div>
				</div>
			</section>
			<!-- /Services -->

			


			<!-- Parallax -->
			<section class="parallax parallax-1" style="background-image: url('assets/images/demo/1200x800/34-min.jpg');">
				<div class="overlay dark-5"><!-- dark overlay [1 to 9 opacity] --></div>

				<div class="container">

					<div class="text-center">
						<h2 class="size-40 weight-300">Contractor &amp; Construction Since 1982</h2>
						<a class="btn btn-default btn-lg" href="#">GET A QUOTE <i class="fa fa-angle-right"></i></a> 
						&nbsp; OR &nbsp; 
						<a class="btn btn-warning btn-lg" href="#">OUR SERVICES <i class="fa fa-angle-right"></i></a>
					</div>

				</div>
			</section>
			<!-- /Parallax -->




			<!-- PORTFOLIO -->
			<section>
				<div class="container">
				
					<div class="heading-title heading-dotted text-center">
						<h2>Featured Work</h2>
					</div>

					<div id="portfolio" class="portfolio-gutter">

						<ul class="nav nav-pills mix-filter margin-bottom-60">
							<li data-filter="all" class="filter active"><a href="#">All</a></li>
							
							<?php 
								$portfolioCategory = $this->mainpage_model->getPortfolioCategory();
								foreach($portfolioCategory as $key=>$val){
									//echo "<li data-filter=$val['portfolio_category_id'] class=filter></li>";
									
									echo "<li data-filter=".$val['portfolio_category_id']." class=\"filter\"><a href=\"#\">".$val['portfolio_category_name']."</a></li>";
								}
							?>
						</ul>
						<div class="row mix-grid">
							<?php
								$projectPortfolio = $this->mainpage_model->getProjectPortfolio();
								foreach($projectPortfolio as $key=>$val){
									/* echo $val['portfolio_category_id'];
									echo $this->mainpage_model->getPortfolioCategoryName($val['portfolio_category_id']);
									echo "col-md-4 col-sm-4 mix ".$val['portfolio_category_id']; */
									echo "<div class=\"col-md-4 col-sm-4 mix ".$val['portfolio_category_id']."\">";
							?>
								<div class="item-box">
									<figure>
										<span class="item-hover">
											<span class="overlay dark-5"></span>
											<span class="inner">
												
												<?php
													$projectPortfolioImagesFirst = $this->mainpage_model->getProjectPortfolioImagesFirst($val['portfolio_id']);
													foreach($projectPortfolioImagesFirst as $key=>$valFirst){
														/* <!-- lightbox --> */
														echo "<a class=\"ico-rounded lightbox\" href=\"assets/images/portfolio/".$valFirst[portfolio_images_name]."\" data-plugin-options='{\"type\":\"image\"}'>
															<span class=\"fa fa-plus size-20\"></span>
														</a>";
													}
												?>
												

												<!-- details -->
												<a class="ico-rounded" href="portfolio-single-slider.html">
													<span class="glyphicon glyphicon-option-horizontal size-20"></span>
												</a>

											</span>
										</span>

										<!-- carousel -->
										<div class="owl-carousel buttons-autohide controlls-over nomargin" data-plugin-options='{"singleItem": true, "autoPlay": 4000, "navigation": false, "pagination": true, "transitionStyle":"goDown"}'>
											<?php 
												$projectPortfolioImages = $this->mainpage_model->getProjectPortfolioImages($val['portfolio_id']);
												/* print_r($projectPortfolioImages);
												print_r('<BR>'); */
												foreach($projectPortfolioImages as $key=>$valImages){
													/* print_r($valImages[portfolio_images_name]); */
													echo "<div>
														<img class=\"img-responsive\" src=\"assets/images/portfolio/".$valImages[portfolio_images_name]."\" width=\"600\" height=\"399\" alt=\"\">
													</div>";
												} 
											?>
										</div>
										<!-- /carousel -->

									</figure>

									<div class="item-box-desc">
										<h3><?php echo $val['portfolio_name'] ?></h3>
										<ul class="list-inline categories nomargin">
											<li><a href="#"><?php echo $this->mainpage_model->getPortfolioCategoryName($val['portfolio_category_id']) ?></a></li>
										</ul>
									</div>

								</div>

							</div><!-- /item -->
							
							<?php
								}
							?>
						</div>

					</div>
					
				</div>
			</section>
			<!-- /PORTFOLIO -->




			<!-- Testimonials -->
			<section class="padding-xxs dark">
				<div class="container">

					<div class="owl-carousel text-center owl-testimonial nomargin" data-plugin-options='{"singleItem": true, "autoPlay": 3500, "navigation": false, "pagination": true, "transitionStyle":"fade"}'>
						<div class="testimonial">
							<figure>
								<img class="rounded" src="assets/images/demo/people/300x300/11-min.jpg" alt="" />
							</figure>
							<div class="testimonial-content nopadding">
								<p class="lead">Incidunt deleniti blanditiis quas aperiam recusandae consequatur ullam quibusdam cum libero.</p>
								<cite>
									Joana Doe
									<span>Company Ltd.</span>
								</cite>
							</div>
						</div>
						<div class="testimonial">
							<figure>
								<img class="rounded" src="assets/images/demo/people/300x300/12-min.jpg" alt="" />
							</figure>
							<div class="testimonial-content nopadding">
								<p class="lead">Quod necessitatibus quis expedita harum provident eos obcaecati id culpa.</p>
								<cite>
									Melissa Doe
									<span>Company Ltd.</span>
								</cite>
							</div>
						</div>
					</div>

				</div>
			</section>
			<!-- /Testimonials -->





			<!-- News -->
			<section>
				<div class="container">

					<div class="heading-title heading-dotted text-center">
						<h2>Recent News</h2>
					</div>

					<!-- 
						controlls-over		= navigation buttons over the image 
						buttons-autohide 	= navigation buttons visible on mouse hover only
						
						data-plugin-options:
							"singleItem": true
							"autoPlay": true (or ms. eg: 4000)
							"navigation": true
							"pagination": true
							"items": "4"

						owl-carousel item paddings
							.owl-padding-0
							.owl-padding-3
							.owl-padding-6
							.owl-padding-10
							.owl-padding-15
							.owl-padding-20
					-->
					<div class="owl-carousel owl-padding-10 buttons-autohide controlls-over" data-plugin-options='{"singleItem": false, "items":"3", "autoPlay": 4000, "navigation": true, "pagination": false}'>
						<?php
							$contentNews = $this->mainpage_model->getContentNews();
							foreach($contentNews as $key=>$val){
								$contentNewsImagesFirst = $this->mainpage_model->getContentNewsImagesFirst($val['news_id']);
								echo "<div class=\"img-hover\">
									<a href=\"blog-single-default.html\">";
										foreach($contentNewsImagesFirst as $key=>$valNewsImagesFirst){
											echo "<img class=\"img-responsive\" src=\"assets/images/news/".$valNewsImagesFirst['news_images_name']."\" alt=\"\">";
										}		
									echo "</a>

									<h4 class=\"text-left margin-top-20\"><a href=\"blog-single-default.html\">".$val['news_title']."</a></h4>
									<p class=\"text-left\">".$val['news_headline']."</p>
									<ul class=\"text-left size-12 list-inline list-separator\">
										<li>
											<i class=\"fa fa-calendar\"></i> 
											".tgltoview($val['news_date'])."
										</li>
									</ul>
								</div>";
							}
						?>
					</div>

				</div>
			</section>
			<!-- /News -->




			<!-- Overview -->
			<section>
				<div class="container text-center">

					<div class="row text-left">

						<div class="col-sm-8">
							<img src="assets/images/demo/laptop.png" alt="product image" />
						</div>

						<div class="col-sm-4">
							<h3 class="weight-300">Quick <span>Overview</span></h3>
						
							<p>Lorem ipsum dolor sit amet, hinc dolores noluisse at vel, ex quod aperiri scaevola has, cum te sanctus denique. Eu liber docendi petentium has, labore.</p>
							<p>Etiam falli mentitum id mel, ut mel sumo postulant referrentur. At has minim imperdiet, soluta offendit ocurreret sea an. </p>
							
							<hr />

							<ul class="list-unstyled list-icons">
								<li><i class="fa fa-check"></i> Nobis nemore epicuri pro ea</li>
								<li><i class="fa fa-check"></i> Qui dicunt singulis dissentias an</li>
								<li><i class="fa fa-check"></i> Ea vis diceret constituam</li>
								<li><i class="fa fa-check"></i> Mei no autem idque integre, sumo facilis</li>
								<li><i class="fa fa-check"></i> Est quodsi labitur moderatius an</li>
							</ul>

						</div>
					</div>

				</div>
			</section>
			<!-- /Overview -->





			<!-- Clients -->
			<section class="alternate">
				<div class="container">

					<div class="heading-title heading-dotted text-center">
						<h2>Our Clients</h2>
					</div>

					<ul class="row clients-dotted list-inline">
						<?php
							$contentClientLogo = $this->mainpage_model->getContentClientLogo();
							foreach($contentClientLogo as $key=>$val){
								echo "<li class=\"col-md-3 col-sm-3 col-xs-6\">
									<a href=\"#\">
										<img class=\"img-responsive\" src=\"assets/images/client/".$val['client_logo_images']."\" alt=\"client\" />
									</a>
								</li>";
							}
						?>
					</ul>

				</div>
			</section>
			<!-- /Clients -->




			<!-- FOOTER -->
				<?php
					$this->load->view('mainfooter_view');			 
				?>
			<!-- /FOOTER -->

		</div>
		<!-- /wrapper -->


		<!-- SCROLL TO TOP -->
		<a href="#" id="toTop"></a>


		<!-- PRELOADER -->
		<div id="preloader">
			<div class="inner">
				<span class="loader"></span>
			</div>
		</div><!-- /PRELOADER -->


		<!-- JAVASCRIPT FILES -->
		<script type="text/javascript">var plugin_path = 'assets/plugins/';</script>
		<script type="text/javascript" src="assets/plugins/jquery/jquery-2.1.4.min.js"></script>

		<script type="text/javascript" src="assets/js/scripts.js"></script>
		
		<!-- REVOLUTION SLIDER -->
		<script type="text/javascript" src="assets/plugins/slider.revolution/js/jquery.themepunch.tools.min.js"></script>
		<script type="text/javascript" src="assets/plugins/slider.revolution/js/jquery.themepunch.revolution.min.js"></script>
		<script type="text/javascript" src="assets/js/view/demo.revolution_slider.js"></script>

	</body>
</html>