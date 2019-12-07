<!DOCTYPE html>
<html lang="en">
  <head>
    <title>{{$konfig->nama_website}}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:200,300,400,600,700,800,900" rel="stylesheet">

    <meta charset="utf-8" name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="front/css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="front/css/animate.css">

    <link rel="stylesheet" href="front/css/owl.carousel.min.css">
    <link rel="stylesheet" href="front/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="front/css/magnific-popup.css">

    <link rel="stylesheet" href="front/css/aos.css">

    <link rel="stylesheet" href="front/css/ionicons.min.css">

    <link rel="stylesheet" href="front/css/flaticon.css">
    <link rel="stylesheet" href="front/css/icomoon.css">
    <link rel="stylesheet" href="front/css/style.css">
  </head>
  <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

  <div id="app">


    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light site-navbar-target" id="ftco-navbar">
	    <div class="container">
	      {{-- <a class="navbar-brand" href="index.html">Digi<span>Lab</span></a> --}}
        <img src="front/images/logo.png" class="navbar-brand" width="60" height="60" alt="">
	      <button class="navbar-toggler js-fh5co-nav-toggle fh5co-nav-toggle" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>

	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav nav ml-auto">
	          <li class="nav-item"><a href="#home-section" class="nav-link"><span>Home</span></a></li>
	          <li class="nav-item"><a href="#about-section" class="nav-link"><span>Tentang Kami</span></a></li>
	          <li class="nav-item"><a href="#services-section" class="nav-link"><span>Layanan</span></a></li>
	          <li class="nav-item"><a href="#projects-section" class="nav-link"><span>Projek</span></a></li>
	          <li class="nav-item"><a href="#contact-section" class="nav-link"><span>Kontak</span></a></li>
	        </ul>
	      </div>
	    </div>
	  </nav>
	  <section id="home-section" class="hero">
		  <div class="home-slider js-fullheight owl-carousel">
	      <div class="slider-item js-fullheight">
	      	<div class="overlay"></div>
	        <div class="container-fluid p-0">
	          <div class="row d-md-flex no-gutters slider-text js-fullheight align-items-center justify-content-end" data-scrollax-parent="true">
	          	<div class="one-third order-md-last img js-fullheight" style="background-image:url(front/images/bg_1.jpg);">
	          		<div class="overlay"></div>
	          	</div>
		          <div class="one-forth d-flex js-fullheight align-items-center ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
		          	<div class="text">
			            <h1 class="mb-4 mt-3">{{$konfig->nama_website}}</span></h1>
			            <p>{{$konfig->deskripsi}}</p>

			            {{-- <p><a href="#" class="btn btn-primary px-5 py-3 mt-3">Get in touch</a></p> --}}
		            </div>
		          </div>
	        	</div>
	        </div>
	      </div>
	    </div>
    </section>

    <router-view></router-view>

    <footer class="ftco-footer ftco-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
              {{-- <h2 class="ftco-heading-2">Tentang {{$konfig->nama_website}}</h2> --}}
              <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                <li class="ftco-animate"><a href="{{$konfig->twitter}}" target="_blank"><span class="icon-twitter"></span></a></li>
                <li class="ftco-animate"><a href="{{$konfig->facebook}}" target="_blank"><span class="icon-facebook"></span></a></li>
                <li class="ftco-animate"><a href="{{$konfig->instagram}}" target="_blank"><span class="icon-instagram"></span></a></li>
              </ul>
              <img src="front/images/logo.png" class="img-fluid" alt="">
              {{-- <p>{{$konfig->deskripsi}}</p> --}}

            </div>
          </div>

        </div>
        <div class="row">
          <div class="col-md-12 text-center">

            <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
  Copyright @2019 All rights reserved
  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
          </div>
        </div>
      </div>
    </footer>



  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>

</div>

  <script src="https://kit.fontawesome.com/e1f2af104f.js" crossorigin="anonymous"></script>
  <script type="text/javascript" src="js/app.js"></script>
  <script src="front/js/jquery.min.js"></script>
  <script src="front/js/jquery-migrate-3.0.1.min.js"></script>
  <script src="front/js/popper.min.js"></script>
  <script src="front/js/bootstrap.min.js"></script>
  <script src="front/js/jquery.easing.1.3.js"></script>
  <script src="front/js/jquery.waypoints.min.js"></script>
  <script src="front/js/jquery.stellar.min.js"></script>
  <script src="front/js/owl.carousel.min.js"></script>
  <script src="front/js/jquery.magnific-popup.min.js"></script>
  <script src="front/js/aos.js"></script>
  <script src="front/js/jquery.animateNumber.min.js"></script>
  <script src="front/js/scrollax.min.js"></script>
  {{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script> --}}
  {{-- <script src="front/js/google-map.js"></script> --}}

  <script src="front/js/main.js"></script>

  </body>
</html>
