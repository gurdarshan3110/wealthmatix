@extends('includes.app')

@section('content')
    <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
		
		<div id="kt_header" class="header" data-kt-sticky="true" data-kt-sticky-name="header" data-kt-sticky-offset="{default: '200px', lg: '300px'}">
			
			<div class="container-xxl d-flex align-items-center justify-content-between" id="kt_header_container">
				
				<div class="page-title d-flex flex-column align-items-start justify-content-center flex-wrap me-lg-2 pb-2 pb-lg-0" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', lg: '#kt_header_container'}">
					
					<h1 class="text-dark fw-bolder my-0 fs-2">{{$title}}</h1>
					
				</div>
				@include('includes.topper')
			</div>
			
		</div>
		
		<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
			
			<div class="container-xxl" id="kt_content_container">
				
			</div>
			
		</div>
	</div>
@endsection
@push('jsscript')

@endpush

