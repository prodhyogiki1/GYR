<?php 
include('../../mypartner/session.php');
include('../../mypartner/class/Admin.php');
$admin = new Admin();
$company = $admin->get_company();
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
	<!-- Meta -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="Awaiken">
	<!-- Page Title -->
	<title><?php echo $company[0]['cname']; ?></title>
	<!-- Favicon Icon -->
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo $web_url;?>images/favicon_new.png">
	<!-- Google Fonts Css-->
	<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Epilogue:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
	<!-- Bootstrap Css -->
	<link href="<?php echo $web_url;?>css/bootstrap.min.css" rel="stylesheet" media="screen">
	<!-- SlickNav Css -->
	<link href="<?php echo $web_url;?>css/slicknav.min.css" rel="stylesheet">
	<!-- Swiper Css -->
	<link rel="stylesheet" href="<?php echo $web_url;?>css/swiper-bundle.min.css">
	<!-- Font Awesome Icon Css-->
	<link href="<?php echo $web_url;?>css/all.css" rel="stylesheet" media="screen">
	<!-- Animated Css -->
	<link href="<?php echo $web_url;?>css/animate.css" rel="stylesheet">
	<!-- Magnific Popup Core Css File -->
	<link rel="stylesheet" href="<?php echo $web_url;?>css/magnific-popup.css">
	<!-- Mouse Cursor Css File -->
	<link rel="stylesheet" href="<?php echo $web_url;?>css/mousecursor.css">
    <!-- font awesome -->
    <link rel="stylesheet" href="<?php echo $web_url;?>css/fontawesome-672/css/fontawesome.min.css">
    <link rel="stylesheet" href="<?php echo $web_url;?>css/fontawesome-672/css/brands.css">
    <link rel="stylesheet" href="<?php echo $web_url;?>css/fontawesome-672/css/solid.css">
	<!-- Main Custom Css -->
	<link href="<?php echo $web_url;?>css/custom.css?ver=<?php echo rand(0,999);?>" rel="stylesheet" media="screen">
    <!-- Main untouched Css -->
	<link href="<?php echo $web_url;?>css/untouched.css?ver=<?php echo rand(0,999);?>" rel="stylesheet" media="screen">
    <!-- Select2 Css -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <style>
        .select2-container { width: 100% !important; }
        .select2-container .select2-dropdown { z-index: 2099 !important; }
    </style>
</head>
<body>

    <!-- Preloader Start -->
	<div class="preloader">
		<div class="loading-container">
			<div class="loading"></div>
			<div id="loading-icon"><img src="<?php echo $web_url;?>images/favicon_new.png" alt=""></div>
		</div>
	</div>
	<!-- Preloader End -->

    <!-- Login/Signup Modal Include -->
    <?php include_once __DIR__ . '/login-signup.php'; ?>

    <!-- Header Start -->
	<header class="main-header">
		<div class="header-sticky">
			<nav class="navbar navbar-expand-lg">
				<div class="container">
					<!-- Logo Start -->
					<a class="navbar-brand" href="<?php echo $web_url;?>./">
						<img src="<?php echo $web_url;?>images/logo_new.png" style="height:45px; width:auto;" >
					</a>
					<!-- Logo End -->

					<!-- Main Menu Start -->
					<div class="collapse navbar-collapse main-menu">
                        <div class="nav-menu-wrapper">
                            <ul class="navbar-nav mr-auto" id="menu">
                                <li class="nav-item"><a class="nav-link" href="<?php echo $web_url;?>./">Home</a>
                                    <!-- <ul>
                                        <li class="nav-item submenu"><a class="nav-link" href="<?php echo $web_url;?>index.html">Home - Light</a>
                                            <ul>    
                                                <li class="nav-item"><a class="nav-link" href="<?php echo $web_url;?>index.html">Home - Background Image</a></li>
                                                <li class="nav-item"><a class="nav-link" href="<?php echo $web_url;?>index-2.html">Home - Background Video</a></li>
                                                <li class="nav-item"><a class="nav-link" href="<?php echo $web_url;?>index-3.html">Home - Background Slider</a></li>
                                            </ul>
                                        </li>
                                        <li class="nav-item submenu"><a class="nav-link" href="<?php echo $web_url;?>../dark/index.html">Home - Dark</a>
                                            <ul>    
                                                <li class="nav-item"><a class="nav-link" href="<?php echo $web_url;?>../dark/index.html">Home - Background Image</a></li>
                                                <li class="nav-item"><a class="nav-link" href="<?php echo $web_url;?>../dark/index-2.html">Home - Background Video</a></li>
                                                <li class="nav-item"><a class="nav-link" href="<?php echo $web_url;?>../dark/index-3.html">Home - Background Slider</a></li>
                                            </ul>
                                        </li>
                                    </ul> -->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#about-us">About Us</a></li>
                                <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                                <!-- <li class="nav-item submenu"><a class="nav-link" href="<?php echo $web_url;?>#">Cars</a>
                                    <ul>
                                        <li class="nav-item"><a class="nav-link" href="<?php echo $web_url;?>cars.html">Car Lists</a></li>
                                        <li class="nav-item"><a class="nav-link" href="<?php echo $web_url;?>car-single.html">Car Details</a></li>
                                        <li class="nav-item"><a class="nav-link" href="<?php echo $web_url;?>car-type.html">Cars Type</a></li>
                                    </ul>
                                </li>                               
                                <li class="nav-item submenu"><a class="nav-link" href="<?php echo $web_url;?>#">Pages</a>
                                    <ul>
                                        <li class="nav-item"><a class="nav-link" href="<?php echo $web_url;?>service-single.html">Service Details</a></li>
                                        <li class="nav-item"><a class="nav-link" href="<?php echo $web_url;?>blog.html">Blog</a></li>
                                        <li class="nav-item"><a class="nav-link" href="<?php echo $web_url;?>blog-single.html">Blog Details</a></li>                                    
                                        <li class="nav-item"><a class="nav-link" href="<?php echo $web_url;?>drivers.html">Drivers</a></li>
                                        <li class="nav-item"><a class="nav-link" href="<?php echo $web_url;?>driver-single.html">Driver Details</a></li>  
                                        <li class="nav-item"><a class="nav-link" href="<?php echo $web_url;?>pricing.html">Pricing</a></li>
                                        <li class="nav-item"><a class="nav-link" href="<?php echo $web_url;?>image-gallery.html">Image Gallery</a></li>
                                        <li class="nav-item"><a class="nav-link" href="<?php echo $web_url;?>video-gallery.html">Video Gallery</a></li>
                                        <li class="nav-item"><a class="nav-link" href="<?php echo $web_url;?>testimonials.html">Testimonials</a></li>
                                        <li class="nav-item"><a class="nav-link" href="<?php echo $web_url;?>faqs.html">FAQ's</a></li>                                        
                                        <li class="nav-item"><a class="nav-link" href="<?php echo $web_url;?>404.html">404</a></li>
                                    </ul>
                                </li> -->
                                <li class="nav-item"><a class="nav-link" href="#contact">Contact Us</a></li>
<!-- Let’s Start Button Start -->

                                <li class="btn btn-secondary">
                                    <i class="fas fa-map-marker-alt mr-2" aria-hidden="true"></i>
                            <span id="selectedLocationText"><?php echo !empty($_SESSION['location_name']) ? $_SESSION['location_name'] : 'Select Location'; ?></span>
                                </li>
                            </ul>
                        </div>
                        
                        <?php if (!isset($_SESSION['website_user_logged_in']) || $_SESSION['website_user_logged_in'] !== true) { ?>
                            <a href="#" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#loginSignupModal">Login / Sign Up</a>
                        <?php } else { ?>
                            <div class="dropdown">
                                <a href="#" class="btn btn-warning dropdown-toggle" data-bs-toggle="dropdown">
                                    <?php echo $_SESSION['website_user_name']; ?>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                                </ul>
                            </div>
                        <?php } ?>
                    
                        <!-- Let’s Start Button End -->
					</div>
					<!-- Main Menu End -->
					<div class="navbar-toggle"></div>
				</div>
			</nav>
			<div class="responsive-menu"></div>
		</div>
	</header>