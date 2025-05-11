<?php
session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Beach Travel Website</title>
		<!-- fav icon -->
		<link href="./assets/img/fav/favicon.png" rel="icon" type="image/png" sizes="16x16" />
		<!-- bootstrap css1 js1 -->
		<link href="./assets/libs/bootstrap-5.3.2-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<!-- fontawesome css1 -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		<!-- jqueryui css1 js1 -->
		<link href="./assets/libs/jquery-ui-1.13.2/jquery-ui.min.css" rel="stylesheet" type="text/css" />
		<!-- lightbox2 css1 js1 -->
		<link href="./assets/libs/lightbox2-2.11.4/dist/css/lightbox.min.css" rel="stylesheet" type="text/css" />
		<!-- custom css -->
		<!-- <link href="./assets/css/style.css" rel="stylesheet" type="text/css" /> -->
		<style>
			@import url('https://fonts.googleapis.com/css2?family=Source+Sans+3:wght@300&family=Stick&display=swap');

			:root{
				--primary-color:hsla(203, 100%, 13%, 1);
				--secondary-color:hsl(330, 87%, 17%);
				--fruit-color:tomato;
			}

			*{
				box-sizing: border-box;
			}

			body{
				font-family: 'Source Sans 3', sans-serif;
				padding: 0;
				margin: 0;
			}

			/* Start Back to Top */
			.btn-backtotops{
				background-color: var(--secondary-color);
				color: #fff;
				padding: 10px;
				border-radius: 10px;

				position: absolute;
				right: 10px;
				bottom: 10px;

				z-index: 200;
			}

			/* End Back to Top */

			/*Start Header Section*/

			header{
				height: 100vh;
				background: linear-gradient(30deg,rgba(0,0,0,0),rgba(0,0,0,0.5)),url(./assets/img/banner/beach.jpg);
				background-repeat: no-repeat;
				background-size: cover;
				background-position: center;
				background-attachment: fixed;
			}

			/* Start Nav Bar */
			.navbar{
				background: linear-gradient(rgba(0,0,0,0.3),var(--primary-color));
				padding: 20px 30px;

				transition: all .7s;
			}

			.navmenus{
				background: linear-gradient(rgba(0,0,0,0.6),var(--primary-color));
				padding: 5px 30px;
			}

			.menuitems{
				color: #f4f4f4;
				font-size: 13px;
				letter-spacing: 1px;

				transition: color .5s;
			}

			.menuitems:hover{
				color: skyblue;
			}

			.lines1,.lines2,.lines3{
				width: 25px;
				height: 3px;
				margin: 6px;
			}

			.crossxs .lines1{
				transform: rotate(-45deg) translate(-6px,6px);
			}

			.crossxs .lines2{
				opacity: 0;
			}

			.crossxs .lines3{
				transform: rotate(45deg) translate(-6px,-6px);
			}

			/* End Nav Bar */

			/* Start Banner */
			.banners{
				width: 80%;

				position: absolute;
				left: 50%;
				top: 50%;

				transform: translate(-50%, -50%);
			}

			.bannertheaders{
				animation-name: bnanis;
				animation-duration: 2s;
			}

			.bannerparagraphs{
				animation-name: bnanis;
				animation-duration: 2s;
				animation-delay: 0.5s;

				animation-fill-mode: backwards;
			}

			@keyframes bnanis{
				
				0%{
					transform: translateX(-100px);
					opacity: 0;
				}

				100%{
					transform: translateX(0px);
					opacity: 1;
				}

			}
			/* End Banner */

			/*End Header Section*/

			/* Start About Us Section */

			.aboutuss{
				background-image: linear-gradient(
					rgba(0,0,0,0.3),
					rgba(0,0,0,0.3)
				), url(./assets/img/banner/beach.jpg);
				background-repeat: no-repeat;
				background-size: cover;
				background-position: center;
				background-attachment: fixed;

				position: relative;
			}

			.aboutuss .lines{
				width: 30%;
				height: 1.2px;
				background-color: #fff;
				margin-bottom: 3px;
			}

			.aboutuss .lines:nth-of-type(2){
				width: 20%;
				height: 1px;
			}

			.aboutuss .lines:nth-of-type(3){
				width: 10%;
				height: 0.5px;
				margin-bottom: 30px;
			}

			.aboutuss h5{
				background-color: #f4f4f4ff;
				color: #000;
				border-left: 5px solid red;
				padding: 10px;
			}

			.aboutuss h5 ~ p{
				text-align: left;
				margin: 30px 0;
			}

			.buildings img{
				width: 350px;

				position: absolute;
				bottom: 0;
			}

			/* End About Us Section */

			/* Start Hotels Section */

			.titles{
				text-transform: uppercase;
				/* background-color: steelblue; */
				display: inline-block;
				
				padding: 5px 20px;

				position: relative;
			}

			.titles::before,.titles::after{
				content: '';
				width: 20px;
				height: 20px;

				position: absolute;
			}

			.titles::before{
				border-left: 3px solid red;
				border-bottom: 3px solid red;

				left: 0;
				bottom: 0;
			}

			.titles::after{
				border-right: 3px solid red;
				border-top: 3px solid red;

				right: 0;
				top: 0;
			}

			.propertylists{
				color: #777;
				cursor: pointer;
				user-select: none;
			}

			.activeitems{
				color: var(--primary-color);
			}

			/* End Hotels Section */

			/* Start Beach Section */

			.beachtitles{
				text-transform: uppercase;
				/* background-color: steelblue; */
				display: inline-block;
				font-size: 40px;
				
				padding: 5px 20px;

				position: relative;
			}

			.missions{
				background-color: var(--primary-color);
			}

			.beaches{
				width: 100%;
				height: auto;
				margin: 0 auto;
			}

			.fromlefts{
				animation-name: fromleftani;
				animation-duration: 3s;
			}

			.fromrights{
				animation-name: fromrightani;
				animation-duration: 3s;
			}

			@keyframes fromleftani {
				0%{
					transform: translateX(-120px);
					opacity: 0;
				}
				100%{
					transform: translateX(0px);
					opacity: 1;
				}
			}

			@keyframes fromrightani {
				from{
					transform: translateX(30px);
					opacity: 0;
				}
				to{
					transform: translateX(0px);
					opacity: 1;
				}
			}

			.rounded-image {
				border-radius: 20px; /* or any value you like */
			}

			/* End Beach Section */

			/* Start Client Section */

			ul.clientlists{
				list-style: none;
				padding: 0;
				margin: 0;

				display: flex;
				justify-content: center;
				align-items: center;
			}

			ul.clientlists li{
				background-color: #f4f4f4f4;
				border: 5px solid #e9e9e9;
				padding: 20px 30px;
				margin: 0 auto;
			}

			ul.clientlists li:hover{
				border-color: var(--primary-color);
				box-shadow: 3px -5px 3px rgba(0,0,0,0.3);
			}

			ul.clientlists img{
				width: 100px;
			}

			@media(max-width:768px){

				ul.clientlists li{
					border: 2px solid #e9e9e9;
					padding: 10px 20px;
					margin: 0 5px;
				}

				ul.clientlists img{
					width: 70px;
				}

				ul.clientlists li:hover{
					box-shadow: 1px -2px 1px rgba(0,0,0,0.3);
				}

			}

			/* End Client Section */

			/* Start Customer Section */

			.customers{
				background-image: linear-gradient(
					rgba(0,0,0,0),
					rgba(0,0,0,0.1)
				) ,url(./assets/img/banner/beach2.jpg);
				background-repeat: no-repeat;
				background-size: cover;
				background-position: center;
				background-attachment: fixed;
			}

			/* End Customer Section */

			/* Start Quotation Section */

			.quotes{
				background-color: var(--primary-color);
				padding: 30px 50px;
				margin: -30px;

				display: flex;
				justify-content: space-between;
				align-items: center;
			}

			.quotes .infos{
				display: flex;
				text-align: left;
			}

			.quotes .btn-calls{
				width: 170px;
				height: 50px;
				background-color: var(--secondary-color);
				color: #fff;
				font-size: 15px;
				border-radius: 100px;
				line-height: 50px;

				padding: 0;

				transform: translateY(-1px);

				transition: all .3s;
			}

			.quotes .btn-calls:hover{
				transform: translateY(0px);
				box-shadow: -3px 3px 3px #444;
			}

			.phoneicons{
				width: 30px;
			}

			/* End Quotation Section */

			/* Start Service Section */

			.funicons img{
				width: 70px;
			}

			.funicons div:nth-last-of-type(even){
				background-color: #f1f1f1;
			}

			/* End Service Section */

			/* Start Contact Section */

			.contacts{
				background-image: linear-gradient(
					100deg,
					rgba(0,0,0,0.9) 50%,
					rgba(0,0,0,0.5) 30%,
					transparent
				),url(./assets/img/banner/beach2.jpg);
				background-repeat: no-repeat;
				background-size: cover;
				background-position: center;
				background-attachment: fixed;
			}

			.contacts .inputs{
				background-color: transparent;
				color: #fff;
				border-color: transparent;
				border-bottom: 2px solid #ccc;
				border-radius: 0;
			}

			.contacts .inputs:focus{
				border-bottom: 2px solid var(--secondary-color);
				box-shadow: none;
			}

			.inputs::placeholder{
				color: rgba(255,255,255,0.5);
			}

			.labels{
				color: red;
				display: block;
				margin-left: 10px;
				margin-top: -60px;
			}

			.inputs:placeholder-shown + .labels{
				opacity: 0;
				/* visibility: hidden; */
			}

			.summit-btns{
				background-color: var(--secondary-color);
				color: #fff;
				border: none;
				outline: none;
			}

			.summit-btns:hover{
				background-color: var(--primary-color);
				color: #fff;
			}

			/* End Contact Section */

			/* Start Footer Section */

			.footerlinks{
				color: #e2e2e2;
				text-decoration: none;
				font-size: 13px;

				transition: all .3s;
			}

			.footerlinks:hover{
				color: orange;
				border-bottom: 1px solid orange;
				letter-spacing: 1px;
			}

			/* End Footer Section */
		</style>
	</head>
	<body>
		
		<!-- Start Back to Top -->

		<div class="fixed-bottom">
			<a href="#" class="btn-backtotops"><i class="fas fa-arrow-up"></i></a>
		</div>

		<!-- End Back to Top -->


		<!-- Start Header Section -->

		<header>

			<!-- Start Nav Bar -->
			<nav class="navbar navbar-expand-lg fixed-top">

				<a href="index.php" class="navbar-brand text-light mx-3">
					<img src="./assets/img/fav/favicon.png" width="70px" alt="favicon" />
					<span class="text-uppercase h2 fw-bold mx-2 text-truncate">Beach Travel<span class="h3"> Website</span></span>
				</a>

				<button type="button" class="navbar-toggler navbuttons crossxs" data-bs-toggle="collapse" data-bs-target="#nav">
					<div class="bg-light lines1"></div>
					<div class="bg-light lines2"></div>
					<div class="bg-light lines3"></div>
				</button>

				<div id="nav" class="navbar-collapse collapse justify-content-end text-uppercase fw-bold">
					<ul class="navbar-nav">
						<li class="nav-item"><a href="index.php" class="nav-link mx-2 menuitems">Home</a></li>
						<li class="nav-item"><a href="./user/hotels.php" class="nav-link mx-2 menuitems">Hotels</a></li>
						<li class="nav-item"><a href="./contactus.php" class="nav-link mx-2 menuitems">Contact</a></li>
						<li class="nav-item"><a href="./aboutus.php" class="nav-link mx-2 menuitems">About Us</a></li>
						<?php if (isset($_SESSION['user_id'])): ?>
							<li class="nav-item"><a href="user/profile.php" class="nav-link mx-2 menuitems">Profile</a></li>
							<?php if ($_SESSION['role'] === 'admin'): ?>
								<li class="nav-item"><a href="admin/allbookinglists.php" class="nav-link mx-2 menuitems">Lists</a></li>
								<li class="nav-item"><a href="admin/manage_hotels.php" class="nav-link mx-2 menuitems">Manage</a></li>
							<?php elseif ($_SESSION['role'] === 'user'): ?>
								<li class="nav-item"><a href="user/booking_list.php" class="nav-link mx-2 menuitems">My Bookings</a></li>
							<?php endif; ?>
							<li class="nav-item"><a href="auth/logout.php" class="nav-link mx-2 menuitems">Logout</a></li>
						<?php else: ?>
							<li class="nav-item"><a href="auth/login.php" class="nav-link mx-2 menuitems">Login</a></li>
							<li class="nav-item"><a href="auth/register.php" class="nav-link mx-2 menuitems">Register</a></li>
						<?php endif; ?>
					</ul>
				</div>
				
			</nav>

			<!-- End Nav Bar -->

			<!-- Start Banner -->

			<div class="text-light text-center text-md-end banners">
				<h1 class="display-5 bannertheaders">Welcome to <span class="display-2 text-uppercase">Beach</span> Travel Services</h1>
				<p class="lead bannerparagraphs">Connecting Travelers with the Perfect Place to Stay</p>
			</div>
			
			<!-- End Banner -->

		</header>
		<!-- End Header Section -->


		<!-- Start About Us Section -->
		<section class="py-5 aboutuss">
			<div class="container">
				<div class="row">

					<div class="col-sm-6 buildings">
						<img src="./assets/img/users/staffgirl1.png" alt="staffgirl1" />
					</div>

					<div class="col-sm-6 text-light">

						<div class="col-md-12">
							<h2 class="text-uppercase">Who are we !!!</h2>
							<div class="lines"></div>
							<div class="lines"></div>
							<div class="lines"></div>
						</div>

						<h5><i>Making Hotel Booking Simple, Secure, and Stress-Free</i></h5>
						<p>We are a trusted hotel booking platform committed to making travel easy, affordable, and enjoyable. With a wide selection of handpicked hotels, secure payment options, and dedicated customer support, we help travelers find the perfect stay—whether it’s a luxury escape, a family vacation, or a quick weekend getaway.</p>
						<a href="javascript:void(0);" class="btn btn-danger rounded-0">Read Me</a>
					</div>

				</div>
			</div>
		</section>
		<!-- End About Us Section -->

		<!-- Start Hotel Section -->
		<section class="py-5">
			<div class="container-fluid">

				<!-- start title -->

					<div class="row text-center">
						<div class="col">
							<h3 class="titles">Hotel Rooms</h3>
						</div>
					</div>

				<!-- end title -->

				<ul class="list-inline text-center text-uppercase fw-bold">
					<li class="list-inline-item propertylists activeitems" data-filter="all">All <span class="mx-3 mx-md-5 text-muted">/</span></li>
					<li class="list-inline-item propertylists" data-filter="ngapali">Ngapali <span class="mx-3 mx-md-5 text-muted">/</span></li>
					<li class="list-inline-item propertylists" data-filter="chaungthar">Chaung Thar <span class="mx-3 mx-md-5 text-muted">/</span></li>
					<li class="list-inline-item propertylists" data-filter="ngwesaung">Ngwesaung</li>
				</ul>



				<div class="container-fluid">
					<div class="d-flex flex-wrap justify-content-center">
						<div class="filters ngapali"><a href="./assets/img/gallery/image1.jpg" data-title="image1" data-lightbox="roadtrip"><img src="./assets/img/gallery/image1.jpg" width="200px" alt="image1" /></a></div>
						<div class="filters ngapali"><a href="./assets/img/gallery/image2.jpg" data-title="image2" data-lightbox="roadtrip"><img src="./assets/img/gallery/image2.jpg" width="200px" alt="image2" /></a></div>
						<div class="filters ngapali"><a href="./assets/img/gallery/image3.jpg" data-title="image3" data-lightbox="roadtrip"><img src="./assets/img/gallery/image3.jpg" width="200px" alt="image3" /></a></div>
						<div class="filters ngapali"><a href="./assets/img/gallery/image4.jpg" data-title="image4"data-lightbox="roadtrip"><img src="./assets/img/gallery/image4.jpg" width="200px" alt="image4" /></a></div>
						<div class="filters chaungthar"><a href="./assets/img/gallery/image5.jpg" data-title="image5" data-lightbox="roadtrip"><img src="./assets/img/gallery/image5.jpg" width="200px" alt="image5" /></a></div>
						<div class="filters chaungthar"><a href="./assets/img/gallery/image6.jpg" data-title="image6" data-lightbox="roadtrip"><img src="./assets/img/gallery/image6.jpg" width="200px" alt="image6" /></a></div>
						<div class="filters chaungthar"><a href="./assets/img/gallery/image7.jpg" data-title="image7" data-lightbox="roadtrip"><img src="./assets/img/gallery/image7.jpg" width="200px" alt="image7" /></a></div>
						<div class="filters chaungthar"><a href="./assets/img/gallery/image8.jpg" data-title="image8" data-lightbox="roadtrip"><img src="./assets/img/gallery/image8.jpg" width="200px" alt="image8" /></a></div>
						<div class="filters funiture"><a href="./assets/img/gallery/image9.jpg" data-title="image9" data-lightbox="roadtrip"><img src="./assets/img/gallery/image9.jpg" width="200px" alt="image9" /></a></div>
						<div class="filters ngapali"><a href="./assets/img/gallery/image1.jpg" data-title="image1" data-lightbox="roadtrip"><img src="./assets/img/gallery/image1.jpg" width="200px" alt="image1" /></a></div>
						<div class="filters chaungthar"><a href="./assets/img/gallery/image2.jpg" data-title="image2" data-lightbox="roadtrip"><img src="./assets/img/gallery/image2.jpg" width="200px" alt="image2" /></a></div>
						<div class="filters chaungthar"><a href="./assets/img/gallery/image3.jpg" data-title="image3" data-lightbox="roadtrip"><img src="./assets/img/gallery/image3.jpg" width="200px" alt="image3" /></a></div>
						<div class="filters ngwesaung"><a href="./assets/img/gallery/image4.jpg" data-title="image4" data-lightbox="roadtrip"><img src="./assets/img/gallery/image4.jpg" width="200px" alt="image4" /></a></div>
						<div class="filters ngwesaung"><a href="./assets/img/gallery/image5.jpg" data-title="image5" data-lightbox="roadtrip"><img src="./assets/img/gallery/image5.jpg" width="200px" alt="image5" /></a></div>
						<div class="filters ngwesaung"><a href="./assets/img/gallery/image6.jpg" data-title="image6" data-lightbox="roadtrip"><img src="./assets/img/gallery/image6.jpg" width="200px" alt="image6" /></a></div>
						<div class="filters ngwesaung"><a href="./assets/img/gallery/image7.jpg" data-title="image7" data-lightbox="roadtrip"><img src="./assets/img/gallery/image7.jpg" width="200px" alt="image7" /></a></div>
					</div>
				</div>

			</div>
		</section>
		<!-- End Hotel Section -->

		<!-- Start Beach Section -->
		<section class="p-5 missions">
			<div class="container">

				<!-- start title -->

					<div class="row text-center">
						<div class="col">
							<h3 class="beachtitles text-light mb-5">Beaches</h3>
						</div>
					</div>

				<!-- end title -->

				<div class="row align-items-lg-center">

					<div class="col-lg-5">
						<img src="./assets/img/beach/chaungthar(2).jpg" class="fromlefts beaches rounded-image" alt="chaungthar" />
					</div>
					<div class="col-lg-7 text-white text-center text-lg-end fromrights">
						<h1><span><a href="https://maps.app.goo.gl/RgESaQeFASiVfBDw8"><i class="fas fa-map-marker-alt"></i></a></span> Chaung Thar</h1>
						<p>The long Chuang Tha Beach with white smooth sand, wearring different beautiful style compared to Ngwe Saung beach. At weekends or on vacations it is always crowded with travellers from many cities around the world. It is recommended probably to rent one boat to explore the islands surrounding, or diving to see the fish in the ocean. Visit Chaung Tha Beach with Indochina tours Myanmar. The beach itself is a long expanse of golden sand. Modern facilities can be found in bungalow type beach resort hotels. Its white sand and the blue crystal water attract the tourists to take beach leisure. There is a wide choice of standard dining places offer the fresh and reasonable. It’s ...</p>
						<a href="./chaungthar.html" class="btn btn-info">More</a>
					</div>

				</div>

				<br/>

				<div class="row align-items-lg-center">
					
					<div class="col-lg-7 text-white text-center text-lg-start fromrights">
						<h1>Ngwe Saung <span><a href="https://maps.app.goo.gl/YF579AkvMFJaLgEKA"><i class="fas fa-map-marker-alt"></i></a></span></h1>
						<p>Ngwe Saung Beach, meaning "Silver Beach" in Burmese, is one of Myanmar’s most popular coastal retreats, located about five hours’ drive west of Yangon. With its long stretch of soft silver-white sand, calm blue waters, and gently swaying palm trees, Ngwe Saung offers a refreshing balance between the lively buzz of Chaung Tha and the quiet luxury of Ngapali. The beach stretches over 15 kilometers, making it one of the longest in Southeast Asia, perfect for long walks, beach cycling, or simply unwinding on a hammock under the sun. During weekends and holidays, local and international travelers alike flock here to enjoy the sea breeze and vibrant beachside atmosphere. It’s ...</p>
						<div class="text-end mt-3">
							<a href="./ngwesaung.html" class="btn btn-info">More</a>
						</div>
					</div>

					<div class="col-lg-5">
						<img src="./assets/img/beach/ngwesaung.jpg" class="fromlefts beaches rounded-image" alt="ngwesaung" />
					</div>

				</div>

				<br/>

				<div class="row align-items-lg-center">

					<div class="col-lg-5">
						<img src="./assets/img/beach/ngapali.jpg" class="fromlefts beaches rounded-image" alt="ngapali" />
					</div>
					<div class="col-lg-7 text-white text-center text-lg-end fromrights">
						<h1><span><a href="https://maps.app.goo.gl/RgESaQeFASiVfBDw8"><i class="fas fa-map-marker-alt"></i></a></span> Ngapili</h1>
						<p>Ngapali Beach is Myanmar’s premier beach destination, a long stretch of soft, white sand kissed by the gentle waves of the Bay of Bengal. It lies quietly along the western coast of Rakhine State, offering a peaceful and picturesque escape from the noise and pace of modern city life. Unlike Chaung Tha and Ngwe Saung, Ngapali is far less crowded, known instead for its calm, tranquil atmosphere, more luxurious beachside resorts, and natural, unspoiled charm. The beach is lined with swaying palm trees, local fishing boats, and elegant resorts that blend traditional Myanmar architecture with modern comfort. Visitors often come here not only to soak up the sun or swim in the ...</p>
						<a href="./ngapali.html" class="btn btn-info">More</a>
					</div>

				</div>
			</div>			
		</section>
		<!-- End Beach Section -->

		<!-- Start Client Section -->
		<section class="p-3">

			<div class="container-fluid">

				<!-- Start title -->

				<div class="text-center">
					<div class="col">
						<h3 class="titles">Satisfied Clients</h3>
					</div>
				</div>

				<!-- End title -->

				<div class="row">
					<div class="col-12">
						<ul class="clientlists">
							<li><img src="./assets/img/clients/client1.png" alt="client1" /></li>
							<li><img src="./assets/img/clients/client2.png" alt="client2" /></li>
							<li><img src="./assets/img/clients/client3.png" alt="client3" /></li>
							<li><img src="./assets/img/clients/client4.png" alt="client4" /></li>
							<li><img src="./assets/img/clients/client5.png" alt="client5" /></li>
						</ul>
					</div>
				</div>

			</div>
			
		</section>
		<!-- End Client Section -->


		<!-- Start Customers Section -->
		<section class="py-3 customers">
			<div class="container-fluid">

				<!-- Start title -->

				<div class="text-center">
					<div class="col">
						<h3 class="titles">What Customers Says?</h3>
					</div>
				</div>

				<!-- End title -->

				<div class="row">
					<div class="col-md-6 mx-auto">

						<div id="customercarousels" class="carousel slides" data-bs-ride="carousel">
							
							<ol class="carousel-indicators">
								<li class="active" data-bs-target="#customercarousels" data-bs-slide-to="0"></li>
								<li data-bs-target="#customercarousels" data-bs-slide-to="1"></li>
								<li data-bs-target="#customercarousels" data-bs-slide-to="2"></li>
							</ol>

							<div class="carousel-inner">

								<div class="carousel-item text-center active">
									<img src="./assets/img/users/user1.jpg" class="rounded-circle" alt="user1" />
									<blockquote class="text-white">
										<p>Booking my hotel through this site was so easy! I found a great place in Yangon at a great price, and the whole process was smooth from start to finish.</p>
									</blockquote>
									<h5 class="text-light text-uppercase fw-bold mb-3">Ms.July</h5>
									<ul class="list-inline mb-5">
										<li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
										<li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
										<li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
										<li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
										<li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
									</ul>
								</div>

								<div class="carousel-item text-center">
									<img src="./assets/img/users/user2.jpg" class="rounded-circle" alt="user2" />
									<blockquote class="text-white">
										<p>Excellent service and support. The hotel matched the photos and description exactly, and I got instant confirmation. Highly recommend!</p>
									</blockquote>
									<h5 class="text-light text-uppercase fw-bold mb-3">Mr.Anton</h5>
									<ul class="list-inline mb-5">
										<li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
										<li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
										<li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
										<li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
										<li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
									</ul>
								</div>

								<div class="carousel-item text-center">
									<img src="./assets/img/users/user3.jpg" class="rounded-circle" alt="user3" />
									<blockquote class="text-white">
										<p>I’ve used this site for two trips now, and both times I got great deals and quick bookings. The team even helped when I had to change my dates!</p>
									</blockquote>
									<h5 class="text-light text-uppercase fw-bold mb-3">Ms.Yoon</h5>
									<ul class="list-inline mb-5">
										<li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
										<li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
										<li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
										<li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
										<li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
									</ul>
								</div>

							</div>
						</div>

					</div>
				</div>

			</div>
		</section>
		<!-- End Customers Section -->


		<!-- Start Quotation Section -->
		<section>
			<div class="container">
				<div class="quotes">
					<div class="infos">
						<div class="me-5">
							<img src="./assets/img/icon/phoneicon.png" class="phoneicons" alt="phoneicon" />
						</div>
						<div class="text-light">
							<h2 class="fw-bold text-uppercase">Request A Free Quote</h2>
							<p class="lead">Get answers and advice from people you want it from.</p>
						</div>
					</div>

					<div>
						<a href="tel:09259021082" class="btn btn-calls">Call Now <i class="fas fa-phone"></i></a>
					</div>
				</div>
			</div>
		</section>
		<!-- End Quotation Section -->


		<!-- Start Service Section -->
		<section class="bg-light text-center py-3">
			<div class="container">

				<!-- Start title -->
				<div class="text-center">
					<div class="col">
						<h3 class="titles">Services</h3>
						<p class="lead">Explore premium services that make you stay unforgettable</p>
					</div>
				</div>
				<!-- End title -->

				<div class="row funicons">

					<div class="col-md-4">
						<img src="./assets/img/icon/double-bed.png" alt="double-bed" />
						<h4>Luxury Rooms</h4>
						<p>Spacious, elegant rooms with modern amenities.</p>
					</div>

					<div class="col-md-4">
						<img src="./assets/img/icon/padlock.png" alt="padlock" />
						<h4>Secure Booking</h4>
						<p>Safe and encrypted online booking process.</p>
					</div>

					<div class="col-md-4">
						<img src="./assets/img/icon/man.png" alt="man" />
						<h4>Professional Staff</h4>
						<p>Friendly 24/7 front desk and room service.</p>
					</div>

					<div class="col-md-4">
						<img src="./assets/img/icon/price-tag.png" alt="price-tag" />
						<h4>Best Price Guarantee</h4>
						<p>Lowest prices when you book directly with us.</p>
					</div>

					<div class="col-md-4">
						<img src="./assets/img/icon/calendar-check.png" alt="calendar-check" />
						<h4>Flexible Cancellations</h4>
						<p>Change your plans easily with flexible cancellation policies.</p>
					</div>

					<div class="col-md-4">
						<img src="./assets/img/icon/award.png" alt="award" />
						<h4>Award-Winning Service</h4>
						<p>Recognized for outstanding hospitality.</p>
					</div>

				</div>

			</div>
		</section>
		<!-- End Service Section -->


		<!-- Start Contact Section -->
		<section class="p-5 contacts">

			<div class="container-fluid">
				<div class="col-md-5">
					<h5 class="display-4 text-white mb-3">Get New Letter</h5>
					<form action="" method="">
						<div class="form-group py-4">
							<input type="text" name="name" id="name" class="form-control p-3 inputs" placeholder="Enter Your Name" />
							<label for="name" class="labels">Name</label>
						</div>

						<div class="form-group py-4">
							<input type="email" name="email" id="email" class="form-control p-3 inputs" placeholder="Enter Your Email" autocomplete="off" />
							<label for="email" class="labels">Email</label>
						</div>

						<div class="my-5">
							<div class="form-check form-switch">
								<input for="check-box" name="accept" id="accept" class="form-check-input" type="checkbox" />		
								<label for="accept" class="text-light">I agree to get push notify.</label>
							</div>
						</div>

						<dic class="d-grid">
							<button type="submit" class="btn text-uppercase  fw-bold rounded-0 summit-btns">Subscribe</button>
						</dic>

					</form>

				</div>
			</div>
			
		</section>
		<!-- End Contact Section -->


		<!-- Start Footer Section -->
		<footer class="bg-dark px-5">
			<div class="container-fluid">
				<div class="row text-light py-4">

					<div class="col-md-3 col-sm-6">
						<h5 class="mb-3"><img src="./assets/img/fav/favicon.png" width="70" alt="footericon" /> About GOLDENSANDS</h5>
						<p class="small">GOLDENSANDS is a premium hospitality brand offering unforgettable stays along Myanmar’s most beautiful beaches. Known for its warm service, elegant accommodations, and stunning seaside views, GOLDENSANDS is the perfect escape for travelers seeking relaxation, romance, or adventure. With a focus on comfort, quality, and authentic local experiences, we welcome guests from around the world to discover the best of Myanmar’s coastal charm.</p>
					</div>

					<div class="col-md-3 col-sm-6">
						<h5 class="mb-3">Visit Us</h5>
						<ul class="list-unstyled">
							<li><a href="javascript:void(0);" class="footerlinks">Home</a></li>
							<li><a href="javascript:void(0);" class="footerlinks">About</a></li>
							<li><a href="javascript:void(0);" class="footerlinks">Hotels</a></li>
							<li><a href="javascript:void(0);" class="footerlinks">Services</a></li>
							<li><a href="javascript:void(0);" class="footerlinks">Contact</a></li>
						</ul>
					</div>

					<div class="col-md-3 col-sm-6">
						<h5 class="mb-3">Need Help?</h5>
						<ul class="list-unstyled">
							<li><a href="javascript:void(0);" class="footerlinks">Customers Services</a></li>
							<li><a href="javascript:void(0);" class="footerlinks">Online Chat</a></li>
							<li><a href="javascript:void(0);" class="footerlinks">Support</a></li>
							<li><a href="javascript:void(0);" class="footerlinks">info@goldensands.com</a></li>
						</ul>
					</div>

					<div class="col-md-3 col-sm-6">
						<h5 class="mb-3">Contact Us</h5>
						<ul class="list-unstyled">
							<li>Email: <a href="javascript:void(0);" class="footerlinks">goldensands@gmail.com</a></li>
							<li>Phone: <a href="javascript:void(0);" class="footerlinks">+95 9 123456789 / +95 9 987654321</a></li>
						</ul>
					</div>
				</div>


				<div class="text-light border-top pt-4 d-flex justify-content-between">
					<p>&copy; <span id="getyear">2000</span> Copyright. Inc,ALl rights reserced.</p>
					<ul class="list-unstyled d-flex">
						<li><a href="jacascript:void(0);" class="nav-link"><i class="fab fa-twitter"></i></a></li>
						<li class="ms-3"><a href="jacascript:void(0);" class="nav-link"><i class="fab fa-instagram"></i></a></li>
						<li class="ms-3"><a href="jacascript:void(0);" class="nav-link"><i class="fab fa-facebook"></i></a></li>
					</ul>
				</div>
			</div>
		</footer>
		<!-- End Footer Section -->


		<!-- bootstrap css1 js1 -->
		<script src="./assets/libs/bootstrap-5.3.2-dist/js/bootstrap.bundle.min.js" type="text/javascript"></script>
		<!-- jquery js1 -->
		<script src="./assets/libs/jquery/jquery-3.7.1.min.js" type="text/javascript"></script>
		<!-- jqueryui css1 js1 -->
		<script src="./assets/libs/jquery-ui-1.13.2/jquery-ui.min.js" type="text/javascript"></script>
		<!-- lightbox2 css1 js1 -->
		<script src="./assets/libs/lightbox2-2.11.4/dist/js/lightbox.min.js" type="text/javascript"></script>
		<!-- custom js -->
		<script src="./assets/js/app.js" type="text/javascript"></script>

	</body>
</html>