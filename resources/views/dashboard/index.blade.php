@extends('includes.app')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
				<div class="row gy-5 g-xl-8">
					
					<div class="col-xxl-12">
						<div class="row g-6 g-xl-9 mb-6">
		                    <div class="col-sm-6 col-xl-2 w-20 me-auto">
		                        
		                        <div class="card h-100 bg-primary">
		                            
		                            <a class="card-body d-flex flex-column px-9 flex-center" href="">
		                                
		                                <div class="fs-3 text-light fw-bolder m-0 text-center">Total Inqueries</div>
		                                
		                                <span class="fs-2hx fw-bolder text-light fw-boldest counted" data-kt-countup="true" data-kt-countup-value="256">256</span>
		                            </a>
		                            
		                        </div>
		                        
		                    </div>

		                    <div class="col-sm-6 col-xl-2 w-20 me-auto">
		                        
		                        <div class="card h-100 bg-success">
		                            
		                            <a class="card-body d-flex flex-column px-9 flex-center" href="">
		                                
		                                <div class="fs-3 text-light fw-bolder m-0 text-center">Processing</div>
		                                
		                                <span class="fs-2hx fw-bolder text-light fw-boldest counted" data-kt-countup="true" data-kt-countup-value="150">150</span>
		                            </a>
		                            
		                        </div>
		                        
		                    </div>

		                    <div class="col-sm-6 col-xl-2 w-20 me-auto">
		                        
		                        <div class="card h-100 bg-secondary">
		                            
		                            <a class="card-body d-flex flex-column px-9 flex-center" href="">
		                                
		                                <div class="fs-3 text-light fw-bolder m-0 text-center">Hold</div>
		                                
		                                <span class="fs-2hx fw-bolder text-light fw-boldest counted" data-kt-countup="true" data-kt-countup-value="15">15</span>
		                            </a>
		                            
		                        </div>
		                        
		                    </div>

		                    <div class="col-sm-6 col-xl-2 w-20 me-auto">
		                        
		                        <div class="card h-100 bg-success">
		                            
		                            <a class="card-body d-flex flex-column px-9 flex-center" href="">
		                                
		                                <div class="fs-3 text-light fw-bolder m-0 text-center">Waiting</div>
		                                
		                                <span class="fs-2hx fw-bolder text-light fw-boldest counted" data-kt-countup="true" data-kt-countup-value="50">50</span>
		                            </a>
		                            
		                        </div>
		                        
		                    </div>

		                    <div class="col-sm-6 col-xl-2 w-20 me-auto">
		                        
		                        <div class="card h-100 bg-danger">
		                            
		                            <a class="card-body d-flex flex-column px-9 flex-center" href="">
		                                
		                                <div class="fs-3 text-light fw-bolder m-0 text-center">Completed</div>
		                                
		                                <span class="fs-2hx fw-bolder text-light fw-boldest counted" data-kt-countup="true" data-kt-countup-value="48">48</span>
		                            </a>
		                            
		                        </div>
		                        
		                    </div>

						</div>
						<div class="row g-6 g-xl-9 mb-6">
							<div class="col-md-6">
						        <canvas id="lineChart"></canvas>
						    </div>
						    <div class="col-md-6">
						    	<canvas id="barChart"></canvas>
						        
						    </div>
						    <div class="row mt-4">
						      <div class="col-md-6">
						        <canvas id="pieChart" style="max-width: 350px; max-height: 350px;"></canvas>
						      </div>
						      <div class="col-md-6">
						        <canvas id="lineChart1"></canvas>
						    </div>
						    </div>
						</div>
					</div>
				</div>
			</div>
			
		</div>
	</div>
@endsection
@push('jsscript')
	<script type="text/javascript">
		var ctxLine = document.getElementById('lineChart').getContext('2d');
	    var lineChart = new Chart(ctxLine, {
	      type: 'line',
	      data: {
	        labels: ['January', 'February', 'March', 'April', 'May'],
	        datasets: [{
	          label: 'Enqueries',
	          data: [120, 190, 150, 200, 180],
	          borderColor: 'blue',
	          borderWidth: 2
	        }]
	      },
	      options: {}
	    });

	    var ctxLine1 = document.getElementById('lineChart1').getContext('2d');
	    var lineChart1 = new Chart(ctxLine1, {
	      type: 'line',
	      data: {
	        labels: ['January', 'February', 'March', 'April', 'May'],
	        datasets: [{
	          label: 'Delivered',
	          data: [120, 190, 150, 200, 180],
	          borderColor: 'blue',
	          borderWidth: 2
	        }]
	      },
	      options: {}
	    });

	    // Pie Chart
	    var ctxPie = document.getElementById('pieChart').getContext('2d');
	    var pieChart = new Chart(ctxPie, {
	      type: 'pie',
	      data: {
	        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple'],
	        datasets: [{
	          data: [12, 19, 3, 5, 2],
	          backgroundColor: ['red', 'blue', 'yellow', 'green', 'purple']
	        }]
	      },
	      options: {}
	    });

	    // Bar Chart
	    var ctxBar = document.getElementById('barChart').getContext('2d');
	    var barChart = new Chart(ctxBar, {
	      type: 'bar',
	      data: {
	        labels: ['January', 'February', 'March', 'April', 'May'],
	        datasets: [{
	          label: 'Disbursed',
	          data: [100, 200, 150, 250, 180],
	          backgroundColor: 'orange'
	        }]
	      },
	      options: {}
	    });
	</script>
@endpush

