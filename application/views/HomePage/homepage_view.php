
<!DOCTYPE html>
<!--[if IE 8]>			<html class="ie ie8"> <![endif]-->
<!--[if IE 9]>			<html class="ie ie9"> <![endif]-->
<!--[if gt IE 9]><!-->	<html> <!--<![endif]-->
	<head>
		<meta charset="utf-8" />
		<title>Keisha Chemical - Enterprise Business System</title>
		<meta name="keywords" content="HTML5,CSS3,Template" />
		<meta name="description" content="" />
		<meta name="Author" content="Dorin Grigoras [www.stepofweb.com]" />

		<!-- mobile settings -->
		<meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
		<!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->

		<!-- WEB FONTS : use %7C instead of | (pipe) -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400%7CRaleway:300,400,500,600,700%7CLato:300,400,400italic,600,700" rel="stylesheet" type="text/css" />

		<!-- CORE CSS -->
		<link href="<?php echo base_url() ?>assetshome/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		
		<!-- THEME CSS -->
		<link href="<?php echo base_url() ?>assetshome/css/essentials.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url() ?>assetshome/css/layout.css" rel="stylesheet" type="text/css" />

		<!-- PAGE LEVEL SCRIPTS -->
		<link href="<?php echo base_url() ?>assetshome/css/header-1.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url() ?>assetshome/css/color_scheme/green.css" rel="stylesheet" type="text/css" id="color_scheme" />
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
		data-background="<?php echo base_url() ?>assetshome/images/boxed_background/1.jpg"
	-->
	<body class="smoothscroll enable-animation">

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
			<div id="header" class="sticky transparent clearfix">

				<!-- TOP NAV -->
				<header id="topNav">
					<div class="container">

						<!-- Mobile Menu Button -->
						<button class="btn btn-mobile" data-toggle="collapse" data-target=".nav-main-collapse">
							<i class="fa fa-bars"></i>
						</button>

						<!-- Logo -->
						<a class="logo pull-left" href="index.html">
							<img src="<?php echo base_url() ?>assetshome/images/logo_dark.png" alt="" />
						</a>

						<!-- 
							Top Nav 
							
							AVAILABLE CLASSES:
							submenu-dark = dark sub menu
						-->
						<div class="navbar-collapse pull-right nav-main-collapse collapse">
							<nav class="nav-main">

								<!-- 
									.nav-onepage
									Required for onepage navigation links
									
									Add .external for an external link!
								-->
								<ul id="topMain" class="nav nav-pills nav-main nav-onepage">
									<li class="active"><!-- HOME -->
										<a href="#slider">
											HOME
										</a>
									</li>
									<li><!-- FEATURES -->
										<a href="#features">
											FEATURES
										</a>
									</li>
									<li><!-- PRICING -->
										<a href="#pricing">
											PRICING
										</a>
									</li>
									<li><!-- TESTIMONIALS -->
										<a href="#testimonials">
											TESTIMONIALS
										</a>
									</li>
									<li><!-- PURCHASE -->
										<a class="external" href="#purchase">
											PURCHASE
										</a>
									</li>
									<li><!-- PURCHASE -->
										<a class="external" href="<?php echo base_url() ?>MainPage">
											LOGIN
										</a>
									</li>
								</ul>

							</nav>
						</div>

					</div>
				</header>
				<!-- /Top Nav -->

			</div>


			<!-- HOME -->
			<section id="slider" class="fullheight" style="background:url('<?php echo base_url() ?>assetshome/images/demo/1200x800/36-min.jpg')">
				<div class="overlay dark-5"><!-- dark overlay [1 to 9 opacity] --></div>

				<div class="display-table">
					<div class="display-table-cell vertical-align-middle">
						
						<div class="container text-center">
							
							<h1 class="nomargin size-50 weight-300 wow fadeInUp" data-wow-delay="0.4s">Unlimited Easy Landing Pages</h1>
							<p class="lead font-lato size-30 wow fadeInUp" data-wow-delay="0.7s">Building a Landing Page was never so Easy &amp; Interactive.</p>
							
							<div class="margin-top-30">
								<a href="#" class="btn btn-3d btn-lg btn-teal"><i class="glyphicon glyphicon-th-large"></i>FREE TRIAL</a>
								<span class="size-17 hidden-xs btn btn-lg">&nbsp; OR &nbsp;</span>
								<a href="#" class="btn btn-3d btn-lg btn-red"><i class="glyphicon glyphicon-user"></i>START FOR A SIBSCRIPTION</a>
							</div>

						</div>

					</div>
				</div>
			</section>
			<!-- /HOME -->




			<!-- FEATURES -->
			<section id="features">
				<div class="container">

					<header class="text-center margin-bottom-60">
						<h2>Our Features</h2>
						<p class="lead font-lato">Lorem ipsum dolor sit amet adipiscium elit</p>
						<hr />
					</header>

					<!-- FEATURED BOXES 3 -->
					<div class="row">
						<div class="col-md-3 col-xs-6">
							<div class="text-center">
								<i class="ico-light ico-lg ico-rounded ico-hover et-circle-compass"></i>
								<h4>Pixel Perfect</h4>
								<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus.</p>
							</div>
						</div>
						<div class="col-md-3 col-xs-6">
							<div class="text-center">
								<i class="ico-light ico-lg ico-rounded ico-hover et-piechart"></i>
								<h4>Graphs</h4>
								<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus.</p>
							</div>
						</div>
						<div class="col-md-3 col-xs-6">
							<div class="text-center">
								<i class="ico-light ico-lg ico-rounded ico-hover et-strategy"></i>
								<h4>Startegy</h4>
								<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus.</p>
							</div>
						</div>
						<div class="col-md-3 col-xs-6">
							<div class="text-center">
								<i class="ico-light ico-lg ico-rounded ico-hover et-streetsign"></i>
								<h4>SEO Optimized</h4>
								<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus. </p>
							</div>
						</div>
					</div>
					<!-- /FEATURED BOXES 3 -->

					<!-- FEATURED BOXES 3 -->
					<div class="row">
						<div class="col-md-3 col-xs-6">
							<div class="text-center">
								<i class="ico-light ico-lg ico-rounded ico-hover et-trophy"></i>
								<h4>Winners</h4>
								<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus.</p>
							</div>
						</div>
						<div class="col-md-3 col-xs-6">
							<div class="text-center">
								<i class="ico-light ico-lg ico-rounded ico-hover et-gears"></i>
								<h4>Responsive</h4>
								<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus.</p>
							</div>
						</div>
						<div class="col-md-3 col-xs-6">
							<div class="text-center">
								<i class="ico-light ico-lg ico-rounded ico-hover et-tools"></i>
								<h4>Costomizable</h4>
								<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus.</p>
							</div>
						</div>
						<div class="col-md-3 col-xs-6">
							<div class="text-center">
								<i class="ico-light ico-lg ico-rounded ico-hover et-layers"></i>
								<h4>Easy to Modify</h4>
								<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus. </p>
							</div>
						</div>
					</div>
					<!-- /FEATURED BOXES 3 -->

				</div>
			</section>
			<!-- /FEATURES -->




			<!-- PRICING -->
			<section id="pricing">
				<div class="container">

					<header class="text-center margin-bottom-60">
						<h2>Our Pricing</h2>
						<p class="lead font-lato">Lorem ipsum dolor sit amet adipiscium elit</p>
						<hr />
					</header>

					<div class="row">

						<div class="col-md-3 col-sm-3">
							
							<div class="price-clean">                                
								<h4>
									<sup>$</sup>15<em>/month</em>
								</h4>
								<h5> Starter </h5>
								<hr />
								<p>For individuals looking for something simple to get started.</p>
								<hr />
								<a href="#" class="btn btn-3d btn-teal">Learn More</a>
							</div>
						
						</div>

						<div class="col-md-3 col-sm-3">
							
							<div class="price-clean">                                
								<h4>
									<sup>$</sup>25<em>/month</em>
								</h4>
								<h5> BUSINESS </h5>
								<hr />
								<p>For individuals looking for something simple to get started.</p>
								<hr />
								<a href="#" class="btn btn-3d btn-teal">Learn More</a>
							</div>
						
						</div>

						<div class="col-md-3 col-sm-3">
							
							<div class="price-clean price-clean-popular"> 
								<div class="ribbon"> 
									<div class="ribbon-inner">POPULAR</div>
								</div>
								
								<h4>
									<sup>$</sup>35<em>/month</em>
								</h4>
								<h5> DEVELOPER </h5>
								<hr />
								<p>For individuals looking for something simple to get started.</p>
								<hr />
								<a href="#" class="btn btn-3d btn-primary">Learn More</a>
							</div>
						
						</div>

						<div class="col-md-3 col-sm-3">
							
							<div class="price-clean">                                
								<h4>
									<sup>$</sup>50<em>/month</em>
								</h4>
								<h5> VIP </h5>
								<hr />
								<p>For individuals looking for something simple to get started.</p>
								<hr />
								<a href="#" class="btn btn-3d btn-teal">Learn More</a>
							</div>
						
						</div>

					</div>

				</div>
			</section>
			<!-- /PRICING -->



			<!-- TESTIMONIALS -->
			<section id="testimonials" class="alternate">
				<div class="container">

					<header class="text-center margin-bottom-60">
						<h2>Testimonials</h2>
						<p class="lead font-lato">Lorem ipsum dolor sit amet adipiscium elit</p>
						<hr />
					</header>

					<!-- 
						Note: remove class="rounded" from the img for squared image!
					-->
					<div class="row margin-bottom-60">
						<div class="col-md-4">
							<div class="testimonial testimonial-bordered padding-15">
								<figure class="pull-left">
									<img class="rounded" src="<?php echo base_url() ?>assetshome/images/demo/people/300x300/2-min.jpg" alt="" />
								</figure>
								<div class="testimonial-content">
									<p>Incidunt deleniti blanditiis quas aperiam recusandae consequatur ullam quibusdam cum libero!</p>
									<cite>
										Felicia Doe
										<span>Company Ltd.</span>
									</cite>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="testimonial testimonial-bordered padding-15">
								<figure class="pull-left">
									<img class="rounded" src="<?php echo base_url() ?>assetshome/images/demo/people/300x300/1-min.jpg" alt="" />
								</figure>
								<div class="testimonial-content">
									<p>Incidunt deleniti blanditiis quas aperiam recusandae consequatur ullam quibusdam cum libero!</p>
									<cite>
										Joana Doe
										<span>Company Ltd.</span>
									</cite>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="testimonial testimonial-bordered padding-15">
								<figure class="pull-left">
									<img class="rounded" src="<?php echo base_url() ?>assetshome/images/demo/people/300x300/6-min.jpg" alt="" />
								</figure>
								<div class="testimonial-content">
									<p>Incidunt deleniti blanditiis quas aperiam recusandae consequatur ullam quibusdam cum libero!</p>
									<cite>
										Melissa Doe
										<span>Company Ltd.</span>
									</cite>
								</div>
							</div>
						</div>
					</div>

					<!-- 
						Note: remove class="rounded" from the img for squared image!
					-->
					<ul class="row clearfix testimonial-dotted list-unstyled">
						<li class="col-md-4">
							<div class="testimonial">
								<figure class="pull-left">
									<img class="rounded" src="<?php echo base_url() ?>assetshome/images/demo/people/300x300/2-min.jpg" alt="" />
								</figure>
								<div class="testimonial-content">
									<p>Incidunt deleniti blanditiis quas aperiam recusandae consequatur ullam quibusdam cum libero illo rerum!</p>
									<cite>
										Joana Doe
										<span>Company Ltd.</span>
									</cite>
								</div>
							</div>
						</li>
						<li class="col-md-4">
							<div class="testimonial">
								<figure class="pull-left">
									<img class="rounded" src="<?php echo base_url() ?>assetshome/images/demo/people/300x300/6-min.jpg" alt="" />
								</figure>
								<div class="testimonial-content">
									<p>Incidunt deleniti blanditiis quas aperiam recusandae consequatur ullam quibusdam cum libero illo rerum!</p>
									<cite>
										Melissa Doe
										<span>Company Ltd.</span>
									</cite>
								</div>
							</div>
						</li>
						<li class="col-md-4">
							<div class="testimonial">
								<figure class="pull-left">
									<img class="rounded" src="<?php echo base_url() ?>assetshome/images/demo/people/300x300/7-min.jpg" alt="" />
								</figure>
								<div class="testimonial-content">
									<p>Incidunt deleniti blanditiis quas aperiam recusandae consequatur ullam quibusdam cum libero illo rerum!</p>
									<cite>
										Stephany Doe
										<span>Company Ltd.</span>
									</cite>
								</div>
							</div>
						</li>
						<li class="col-md-4">
							<div class="testimonial">
								<figure class="pull-left">
									<img class="rounded" src="<?php echo base_url() ?>assetshome/images/demo/people/300x300/8-min.jpg" alt="" />
								</figure>
								<div class="testimonial-content">
									<p>Incidunt deleniti blanditiis quas aperiam recusandae consequatur ullam quibusdam cum libero illo rerum!</p>
									<cite>
										Pamela Doe
										<span>Company Ltd.</span>
									</cite>
								</div>
							</div>
						</li>
						<li class="col-md-4">
							<div class="testimonial">
								<figure class="pull-left">
									<img class="rounded" src="<?php echo base_url() ?>assetshome/images/demo/people/300x300/11-min.jpg" alt="" />
								</figure>
								<div class="testimonial-content">
									<p>Incidunt deleniti blanditiis quas aperiam recusandae consequatur ullam quibusdam cum libero illo rerum!</p>
									<cite>
										Simina Doe
										<span>Company Ltd.</span>
									</cite>
								</div>
							</div>
						</li>
						<li class="col-md-4">
							<div class="testimonial">
								<figure class="pull-left">
									<img class="rounded" src="<?php echo base_url() ?>assetshome/images/demo/people/300x300/12-min.jpg" alt="" />
								</figure>
								<div class="testimonial-content">
									<p>Incidunt deleniti blanditiis quas aperiam recusandae consequatur ullam quibusdam cum libero illo rerum!</p>
									<cite>
										Mihaela Doe
										<span>Company Ltd.</span>
									</cite>
								</div>
							</div>
						</li>
					</ul>

				</div>
			</section>
			<!-- /TESTIMONIALS -->




			<!-- -->
			<section>
				<div class="container">
					
					<div class="row">
					
						<div class="col-lg-4">

							<div class="heading-title heading-border-bottom">
								<h3>Smarty Vision</h3>
							</div>

							<div class="toggle toggle-transparent-body toggle-accordion">

								<div class="toggle active">
									<label>Who we are?</label>
									<div class="toggle-content">
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
									</div>
								</div>

								<div class="toggle">
									<label>Our long-term vison</label>
									<div class="toggle-content">
										<p>Maecenas metus nulla, commodo a sodales sed, dignissim pretium nunc.</p>
									</div>
								</div>

								<div class="toggle">
									<label>How can we help you?</label>
									<div class="toggle-content">
										<p>Ut enim massa, sodales tempor convallis et, iaculis ac massa.</p>
									</div>
								</div>

							</div>

						</div>

						<div class="col-lg-4">

							<div class="heading-title heading-border-bottom">
								<h3>Smarty Skills</h3>
							</div>

							<div class="progress progress-lg"><!-- progress bar -->
								<div class="progress-bar progress-bar-warning progress-bar-striped active text-left" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%; min-width: 2em;">
									<span>WEB DESIGN 90%</span>
								</div>
							</div><!-- /progress bar -->

							<div class="progress progress-lg"><!-- progress bar -->
								<div class="progress-bar progress-bar-danger progress-bar-striped active text-left" role="progressbar" aria-valuenow="98" aria-valuemin="0" aria-valuemax="100" style="width: 98%; min-width: 2em;">
									<span>HTML/CSS 98%</span>
								</div>
							</div><!-- /progress bar -->

							<div class="progress progress-lg"><!-- progress bar -->
								<div class="progress-bar progress-bar-success progress-bar-striped active text-left" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%; min-width: 2em;">
									<span>JAVASCRIPT 60%</span>
								</div>
							</div><!-- /progress bar -->

							<div class="progress progress-lg"><!-- progress bar -->
								<div class="progress-bar progress-bar-info progress-bar-striped active text-left" role="progressbar" aria-valuenow="88" aria-valuemin="0" aria-valuemax="100" style="width: 88%; min-width: 2em;">
									<span>PHP/MYSQL 88%</span>
								</div>
							</div><!-- /progress bar -->

						</div>

						<div class="col-lg-4">

							<div class="heading-title heading-border-bottom">
								<h3>Smarty Special</h3>
							</div>
							
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis aliquam id pariatur accusantium perspiciatis deserunt officiis similique nihil dolor blanditiis dignissimos iure praesentium vero suscipit doloribus aperiam unde hic non sint neque molestiae consectetur voluptatum beatae ratione corporis.</p>
							
							<a href="#" class="btn btn-default btn-block btn-lg">Join Us Now</a>
							
						</div>

					</div>

				</div>
			</section>
			<!-- / -->



			<!-- -->
			<section class="alternate">
				<div class="container">
					
					<div class="text-center">
						<h2 class="wow fadeInUp nomargin" data-wow-delay="0.3s">DOES SMARTY CONVINCED YOU?</h2>

						<p class="lead font-lato size-30 wow fadeInUp margin-bottom-60" data-wow-delay="0.5s">Building a Landing Page was never so Easy &amp; Interactive.</p>
						
						<div class="margin-top-30">
							<a href="#" class="btn btn-3d btn-lg wow fadeInUp btn-teal" data-wow-delay="0.7"><i class="glyphicon glyphicon-th-large"></i>FREE TRIAL</a>
							<span class="size-17 hidden-xs wow fadeInUp" data-wow-delay="1s">&nbsp; OR &nbsp;</span>
							<a href="#" class="btn btn-3d btn-lg wow fadeInUp btn-red" data-wow-delay="0.59"><i class="glyphicon glyphicon-user"></i>START FOR A SIBSCRIPTION</a>
						</div>
					</div>

				</div>
			</section>
			<!-- / -->





			<!-- FOOTER -->
			<footer id="footer">
				<div class="container">

					<div class="row">
						
						<div class="col-md-3">
							<!-- Footer Logo -->
							<img class="footer-logo" src="<?php echo base_url() ?>assetshome/images/logo-footer.png" alt="" />

							<!-- Small Description -->
							<p>Integer posuere erat a ante venenatis dapibus posuere velit aliquet.</p>

							<!-- Contact Address -->
							<address>
								<ul class="list-unstyled">
									<li class="footer-sprite address">
										PO Box 21132<br>
										Here Weare St, Melbourne<br>
										Vivas 2355 Australia<br>
									</li>
									<li class="footer-sprite phone">
										Phone: 1-800-565-2390
									</li>
									<li class="footer-sprite email">
										<a href="mailto:support@yourname.com">support@yourname.com</a>
									</li>
								</ul>
							</address>
							<!-- /Contact Address -->

						</div>

						<div class="col-md-3">

							<!-- Latest Blog Post -->
							<h4 class="letter-spacing-1">LATEST NEWS</h4>
							<ul class="footer-posts list-unstyled">
								<li>
									<a href="#">Donec sed odio dui. Nulla vitae elit libero, a pharetra augue</a>
									<small>29 June 2015</small>
								</li>
								<li>
									<a href="#">Nullam id dolor id nibh ultricies</a>
									<small>29 June 2015</small>
								</li>
								<li>
									<a href="#">Duis mollis, est non commodo luctus</a>
									<small>29 June 2015</small>
								</li>
							</ul>
							<!-- /Latest Blog Post -->

						</div>

						<div class="col-md-2">

							<!-- Links -->
							<h4 class="letter-spacing-1">EXPLORE SMARTY</h4>
							<ul class="footer-links list-unstyled">
								<li><a href="#">Home</a></li>
								<li><a href="#">About Us</a></li>
								<li><a href="#">Our Services</a></li>
								<li><a href="#">Our Clients</a></li>
								<li><a href="#">Our Pricing</a></li>
								<li><a href="#">Smarty Tour</a></li>
								<li><a href="#">Contact Us</a></li>
							</ul>
							<!-- /Links -->

						</div>

						<div class="col-md-4">

							<!-- Newsletter Form -->
							<h4 class="letter-spacing-1">KEEP IN TOUCH</h4>
							<p>Subscribe to Our Newsletter to get Important News &amp; Offers</p>

							<form class="validate" action="php/newsletter.php" method="post" data-success="Subscribed! Thank you!" data-toastr-position="bottom-right">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
									<input type="email" id="email" name="email" class="form-control required" placeholder="Enter your Email">
									<span class="input-group-btn">
										<button class="btn btn-success" type="submit">Subscribe</button>
									</span>
								</div>
							</form>
							<!-- /Newsletter Form -->

							<!-- Social Icons -->
							<div class="margin-top-20">
								<a href="#" class="social-icon social-icon-border social-facebook pull-left" data-toggle="tooltip" data-placement="top" title="Facebook">

									<i class="icon-facebook"></i>
									<i class="icon-facebook"></i>
								</a>

								<a href="#" class="social-icon social-icon-border social-twitter pull-left" data-toggle="tooltip" data-placement="top" title="Twitter">
									<i class="icon-twitter"></i>
									<i class="icon-twitter"></i>
								</a>

								<a href="#" class="social-icon social-icon-border social-gplus pull-left" data-toggle="tooltip" data-placement="top" title="Google plus">
									<i class="icon-gplus"></i>
									<i class="icon-gplus"></i>
								</a>

								<a href="#" class="social-icon social-icon-border social-linkedin pull-left" data-toggle="tooltip" data-placement="top" title="Linkedin">
									<i class="icon-linkedin"></i>
									<i class="icon-linkedin"></i>
								</a>

								<a href="#" class="social-icon social-icon-border social-rss pull-left" data-toggle="tooltip" data-placement="top" title="Rss">
									<i class="icon-rss"></i>
									<i class="icon-rss"></i>
								</a>
					
							</div>
							<!-- /Social Icons -->

						</div>

					</div>

				</div>

				<div class="copyright">
					<div class="container">
						<ul class="pull-right nomargin list-inline mobile-block">
							<li><a href="#">Terms &amp; Conditions</a></li>
							<li>&bull;</li>
							<li><a href="#">Privacy</a></li>
						</ul>
						&copy; All Rights Reserved, Company LTD
					</div>
				</div>
			</footer>
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
		<script type="text/javascript">var plugin_path = '<?php echo base_url() ?>assetshome/plugins/';</script>
		<script type="text/javascript" src="<?php echo base_url() ?>assetshome/plugins/jquery/jquery-2.1.4.min.js"></script>

		<script type="text/javascript" src="<?php echo base_url() ?>assetshome/js/scripts.js"></script>
		
		<!-- STYLESWITCHER - REMOVE -->
		
	</body>
</html>