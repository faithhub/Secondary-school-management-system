<!DOCTYPE html>
<html lang="en">
    
<head>
	<!-- META ============================================= -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="" />
	<meta name="author" content="" />
	<meta name="robots" content="" />
	
	<!-- DESCRIPTION -->
	<meta name="description" content="EduChamp : Education HTML Template" />
	
	<!-- OG -->
	<meta property="og:title" content="EduChamp : Education HTML Template" />
	<meta property="og:description" content="EduChamp : Education HTML Template" />
	<meta property="og:image" content="" />
    <meta name="format-detection" content="telephone=no">
    
	<!-- FAVICONS ICON ============================================= -->
	<link rel="icon" href="assets/images/favicon.ico" type="image/x-icon" />
	<link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.png" />
	
	<!-- MOBILE SPECIFIC ============================================= -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	
	<!-- PAGE TITLE HERE ============================================= -->
    <title>EduChamp : Education HTML Template </title>
    
	<!--[if lt IE 9]>
	<script src="assets/js/html5shiv.min.js"></script>
	<script src="assets/js/respond.min.js"></script>
	<![endif]-->
    
    @include('web.layouts.includes.style')
    @include('web.layouts.includes.alert')	
</head>
<body id="bg">
    <div class="page-wraper">
    <div id="loading-icon-bx"></div>
        <!-- Header Top ==== -->
        @include('web.layouts.includes.header')
        <!-- Header Top END ==== -->
        <!-- Content -->     
        @yield('content')
        <!-- Content END-->
        <!-- Footer ==== -->
        @include('web.layouts.includes.footer')
        <!-- Footer END ==== -->
        <button class="back-to-top fa fa-chevron-up" ></button>
    </div>
    @include('web.layouts.includes.script')
</body>
</html>