@extends('includes.header')
@section('title') {{'Dashboard'}} @endsection
@section('content')
	@section('sidebar')
	        @include('includes.sidebar-main')
	    @show
	<!--begin::Wrapper-->
	<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
		<!--begin::Header-->
		<div id="kt_header" class="header" data-kt-sticky="true" data-kt-sticky-name="header" data-kt-sticky-offset="{default: '200px', lg: '300px'}">
			<!--begin::Container-->
			<div class="container-xxl d-flex align-items-center justify-content-between" id="kt_header_container">
				<!--begin::Page title-->
				<div class="page-title d-flex flex-column align-items-start justify-content-center flex-wrap me-lg-2 pb-2 pb-lg-0" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', lg: '#kt_header_container'}">
					<!--begin::Heading-->
					<h1 class="text-dark fw-bolder my-0 fs-2">Dashboard</h1>
					<!--end::Heading-->
					<!--begin::Breadcrumb-->
					<ul class="breadcrumb fw-bold fs-base my-1">
						<li class="breadcrumb-item text-muted">
							<a href="/" class="text-muted">Home</a>
						</li>
						<li class="breadcrumb-item text-dark">Default</li>
					</ul>
					<!--end::Breadcrumb-->
				</div>
				<!--end::Page title=-->
				<!--begin::Wrapper-->
				<div class="d-flex d-lg-none align-items-center ms-n2 me-2">
					<!--begin::Aside mobile toggle-->
					<div class="btn btn-icon btn-active-icon-primary" id="kt_aside_toggle">
						<!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
						<span class="svg-icon svg-icon-2x">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								<path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="black" />
								<path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="black" />
							</svg>
						</span>
						<!--end::Svg Icon-->
					</div>
					<!--end::Aside mobile toggle-->
					<!--begin::Logo-->
					<a href="/" class="d-flex align-items-center">
						<img alt="Logo" src="assets/media/logos/logo-demo7.svg" class="h-30px" />
					</a>
					<!--end::Logo-->
				</div>
				<!--end::Wrapper-->
				<!--begin::Toolbar wrapper-->
				<div class="d-flex flex-shrink-0">
					@include('includes.new-user-button')
					@include('includes.new-vehicle-button')
					@include('includes.vehicle-tags-button')
					@include('includes.allocate-funds-button')
					@include('includes.expense-bill-button')
					@include('includes.export-ledger-button')
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
					<div class="col-xxl-4">
						<!--begin::Mixed Widget 12-->
						<div class="card card-xl-stretch mb-xl-8">
							<!--begin::Header-->
							<div class="card-header border-0 bg-primary py-5">
								<h3 class="card-title fw-bolder text-white">Ledger Report</h3>
								
							</div>
							<!--end::Header-->
							<!--begin::Body-->
							<div class="card-body p-0">
								<!--begin::Chart-->
								<div class="mixed-widget-12-chart card-rounded-bottom bg-primary" data-kt-color="primary" style="height: 250px"></div>
								<!--end::Chart-->
								<!--begin::Stats-->
								<div class="card-rounded bg-body mt-n10 position-relative card-px py-2">
									<!--begin::Row-->
									<div class="row g-0 mb-7">
										<!--begin::Col-->
										<div class="col mx-5">
											<div class="fs-6 text-gray-400">Funds Alloted</div>
											<div class="fs-2 fw-bolder text-gray-800">&#x20b9;{{$totFunds}}</div>
										</div>
										<!--end::Col-->
										<!--begin::Col-->
										<div class="col mx-5">
											<div class="fs-6 text-gray-400">Expense Bills</div>
											<div class="fs-2 fw-bolder text-gray-800">&#x20b9;{{$totExpenses}}</div>
										</div>
										<!--end::Col-->
									</div>
									<!--end::Row-->
								</div>
								<!--end::Stats-->
							</div>
							<!--end::Body-->
						</div>
						<!--end::Mixed Widget 12-->
					</div>
					<!--end::Col-->
					<!--begin::Col-->
					<div class="col-xxl-8">
						<!--begin::Tables Widget 9-->
						<div class="card card-xxl-stretch mb-5 mb-xl-8">
							<!--begin::Header-->
							<div class="card-header border-0 pt-5">
								<h3 class="card-title align-items-start flex-column">
									<span class="card-label fw-bolder fs-3 mb-1">Tagged Vehicles</span>
								</h3>
							</div>
							<!--end::Header-->
							<!--begin::Body-->
							<div class="card-body py-3">
								<!--begin::Table container-->
								<div class="table-responsive">
									<!--begin::Table-->
									<table id="kt_profile_overview_table" class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bolder">
										<!--begin::Head-->
										<thead class="fs-7 text-gray-400 text-uppercase">
											<tr>
												<th class="min-w-60px">Date</th>
												<th class="min-w-150px">Vehicle</th>
												<th class="min-w-150px">Tag</th>
												<th class="min-w-50px">Action</th>
											</tr>
										</thead>
										<!--end::Head-->
										<!--begin::Body-->
										<tbody class="fs-6">
											@if(count($vehicletags)>0)
												@foreach($vehicletags as $record)
												<tr style="color:{{$record->tag->color}}">
													<td>{{date('d M Y',strtotime($record->tag_date))}}</td>
													<td>{{$record->vehicle->registration_no}}</td>
													<td>{{$record->tag->name}}</td>
													<td><!-- {{(($record->status=='A')?'Active':'Cancelled')}} -->
													<a href="#" class="btn btn-sm btn-light btn-active-light-primary">View</a>
													</td>
												</tr>
												@endforeach
											@else
												<tr>
													<td colspan="4" align="center">No records found</td>
												</tr>
											@endif
										</tbody>
										<!--end::Body-->
									</table>
									<!--end::Table-->
								</div>
								<!--end::Table container-->
							</div>
							<!--begin::Body-->
						</div>
						<!--end::Tables Widget 9-->
					</div>
					<!--end::Col-->
				</div>
				<!--end::Row-->
				<div class="row gy-5 g-xl-8">
					<!--begin::Col-->
					<?php
						$i=0;
					?>
					@if(count($documents)>0)
					@foreach($documents as $r => $document)
						@if(count($document->documentcount)>0)
						@if($i==0)
						<h3 class="align-items-start flex-column">
								<span class="card-label fw-bolder fs-3 mb-1">Documents Expiring Soon</span>
								<span class="ms-5">
								@foreach($alerts as $k => $alert)
									<span class="ms-4"><span style="color:{{$alert->color}};background:{{$alert->color}}" class="w-30px h-30px rounded-5">&#xF309;</span> Less then {{(($k==0)?7:(($k==1)?15:30))}} Days </span>
								@endforeach
								</span>
							</h3>
							<?php
							$i++;
							?>
						@endif
						@foreach($document->documentcount as $doc)
						<div class="col-xxl-3">
							<!--begin::Tables Widget 9-->
							<a href="/vehicle-documents-alert/{{$document->id}}">
								<div class="card card-xxl-stretch mb-5 mb-xl-8">
									<!--begin::Header-->
									<div class="card-header border-0 p-5">
										<h3 class="card-title align-items-start flex-column">
											<span class="card-label fw-bolder fs-3 mb-1" style="color:{{$doc['color']}}">{{$document->name}} - {{$doc['count']}}</span>
										</h3>
									</div>
									<!--end::Header-->
								</div>
							</a>
							<!--end::Tables Widget 9-->
						</div>
						@endforeach
						@endif
					@endforeach
					@endif
					<!--end::Col-->
				</div>
				<div class="row gy-5 g-xl-8">
					<!--begin::Col-->
					<?php
						$i=0;
					?>
					@if(count($licenses)>0)
					@foreach($licenses as $r => $driver)
						@if($driver['count']>0)
						@if($i==0)
						<h3 class="align-items-start flex-column">
								<span class="card-label fw-bolder fs-3 mb-1">Driver Licenses Expiring Soon </span>
								<span class="ms-5">
								@foreach($alerts as $k => $alert)
									<span class="ms-4"><span style="color:{{$alert->color}};background:{{$alert->color}}" class="w-30px h-30px rounded-5">&#xF309;</span> Less then {{(($k==0)?7:(($k==1)?15:30))}} Days </span>
								@endforeach
								</span>
							</h3>
							<?php
							$i++;
							?>
						@endif
						@endif
					@endforeach
					@foreach($licenses as $lic)
						<div class="col-xxl-3">
							<!--begin::Tables Widget 9-->
							<div class="card card-xxl-stretch mb-5 mb-xl-8">
								<!--begin::Header-->
								<div class="card-header border-0 p-5">
									<h3 class="card-title align-items-start flex-column">
										<span class="card-label fw-bolder fs-3 mb-1" style="color:{{$lic['color']}}">{{$lic['name']}}</span>
									</h3>
									<h4 class="card-label fw-bolder fs-5 mb-1" style="color:{{$lic['color']}}">No. {{$lic['license_no']}}</h4>
									<h4 class="card-label fw-bolder fs-5 mb-1" style="color:{{$lic['color']}}">Date {{dateFormatdMY($lic['license_expiry'])}}</h4>
								</div>
								<!--end::Header-->
							</div>
							<!--end::Tables Widget 9-->
						</div>
						@endforeach
					@endif
					<!--end::Col-->
				</div>
			</div>
			<!--end::Container-->
		</div>
		<!--end::Content-->
		<!--begin::Footer-->
		<div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
			<!--begin::Container-->
			<div class="container-xxl d-flex flex-column flex-md-row flex-stack">
				<!--begin::Copyright-->
				<div class="text-dark order-2 order-md-1">
					<span class="text-gray-400 fw-bold me-1">Created by</span>
					<a href="/" target="_blank" class="text-muted text-hover-primary fw-bold me-2 fs-6">Mzigo</a>
				</div>
				<!--end::Copyright-->
				<!--begin::Menu-->
				<ul class="menu menu-gray-600 menu-hover-primary fw-bold order-1">
					<li class="menu-item">
						<a href="/" target="_blank" class="menu-link px-2">About</a>
					</li>
					<li class="menu-item">
						<a href="/" target="_blank" class="menu-link px-2">Support</a>
					</li>
					<li class="menu-item">
						<a href="/" target="_blank" class="menu-link px-2">Purchase</a>
					</li>
				</ul>
				<!--end::Menu-->
			</div>
			<!--end::Container-->
		</div>
		<!--end::Footer-->
	</div>
@endsection
@section('footer')
	@include('includes.new-company-modal')        
	@include('includes.footer')
@endsection