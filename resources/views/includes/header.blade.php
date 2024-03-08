<!DOCTYPE html>

<html lang="en">
	<!--begin::Head-->
	<head>
		<title>SMS - {{ $title }}</title>
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta property="og:image" content="{{asset('/assets/images/favicon.png')}}">
		<meta property="og:image" content="{{asset('favicon.ico')}}">
		<!--begin::Fonts-->
		<meta property="twitter:image" content="{{asset('/favicon.ico')}}">

		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,600,700" />
		<link rel="icon" href="{{asset('/assets/images/favicon.ico')}}" />
		<!--end::Fonts-->
		<!--begin::Global Stylesheets Bundle(used by all pages)-->
		<link href="{{asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />

		
		<!--end::Global Stylesheets Bundle-->
		<link href="{{asset('assets/css/custom.css')}}" rel="stylesheet" type="text/css" />
		<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
		
		
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" style="background-image: url()" class="header-fixed header-tablet-and-mobile-fixed aside-fixed aside-secondary-enabled" data-kt-aside-minimize="off">
		<!-- <div class="position-absolute w-100 h-100 d-flex align-items-center justify-content-center" id="header-loader" style="z-index: 999 !important;display: none !important;">
			<img src="/images/loader.gif" style="z-index: 99999;" class="w-150px"/>
		</div> -->
		@yield('content')
		@yield('footer')