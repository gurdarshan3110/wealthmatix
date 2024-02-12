@extends('includes.app')

@section('content')
    <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
		<!--begin::Header-->
		<div id="kt_header" class="header" data-kt-sticky="true" data-kt-sticky-name="header" data-kt-sticky-offset="{default: '200px', lg: '300px'}">
			<!--begin::Container-->
			<div class="container-xxl d-flex align-items-center justify-content-between" id="kt_header_container">
				<!--begin::Page title-->
				<div class="page-title d-flex flex-column align-items-start justify-content-center flex-wrap me-lg-2 pb-2 pb-lg-0" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', lg: '#kt_header_container'}">
					<!--begin::Heading-->
					<h1 class="text-dark fw-bolder my-0 fs-2">{{$title}}</h1>
					<!--end::Heading-->
					<!--begin::Breadcrumb-->
					<ul class="breadcrumb fw-bold fs-base my-1">
						<li class="breadcrumb-item text-muted">
							<a href="/tags" class="text-muted">Listing</a>
						</li>
					</ul>
					<!--end::Breadcrumb-->
				</div>
				<!--end::Page title=-->
				@include('includes.topper')
				<!--begin::Toolbar wrapper-->
				<div class="d-flex flex-shrink-0">
					<!--begin::Create app-->
					<div class="d-flex ms-3">
						<a href="{{route('sale.create')}}" class="btn btn-primary" tooltip="New">
						    <span class=" d-md-inline">New</span>
						</a>
					</div>
					<!--end::Create app-->
				</div>
				<!--end::Toolbar wrapper-->
			</div>
			<!--end::Container-->
		</div>
		<!--end::Header-->
		<!--begin::Content-->
		<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
			<!--begin::Container-->
			<div class="container-xxl" id="kt_content_container">
				<!--begin::Row-->
				<div class="row gy-5 g-xl-8">
					<!--begin::Col-->
					<div class="col-xxl-12">
						<div class="card card-flush">
                            
                            <!--begin::Card body-->
                            <div class="card-body">
								@include('errors.flash.message')
								<!--begin::Table container-->
								@include('saleitem.table')
								<!--end::Table container-->
							</div>
							<!--end::Card body-->
						</div>
					</div>
					<!--end::Col-->
				</div>
				<!--end::Row-->
			</div>
			<!--end::Container-->
		</div>
		<!--end::Content-->
	</div>
</div>

@endsection

