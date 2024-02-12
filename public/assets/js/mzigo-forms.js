$( document ).ready(function() {
	var request=window.location.pathname;
	$('#mzigoform').submit(function(e){
		e.preventDefault();
		var fd = new FormData();
		var id='';
		var $inputs = $('#mzigoform :input');
		$('#submit').attr("disabled", true);
		$('#header-loader').attr('style',"display:flex !important;z-index:999999 !important");
	    $inputs.each(function() {
	    	if(this.classList.contains('required') && $(this).val()==''){
	    		$('#'+[this.id]+'error').html('This field is required.');
	    		return false;
	    	}
	    	if([this.id]=='id' && $(this).val()!=''){
	    		fd.append([this.id],$(this).val());
	    		id=$(this).val();
	    	}else if([this.id]=='request'){
	    		request=$(this).val();
	    	}else if(this.classList.contains('radioBtn')){
	    		fd.append([this.id],$('input[name="'+this.id+'"]:checked').val());
	    	}else{
	    		fd.append([this.id],$(this).val());
	        }
	    });
	    //alert(request);
		$.ajax({
			type:'POST',
			url:((request!='vehicle-checklist-add')?request+'/'+((id=='')?'new':'update'):'vehicle-checklist/add'),
			contentType: false,
			processData: false,
			dataType: 'json',
			data:fd,
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			success:function(data) {
				if(data.success==true){
					window.location.reload();
				}else{
					//$("#defaultProject").removeClass('show');
					setTimeout(function(){ 
					$('.project-invalid-feedback').html(data.msg);
					}, 1000);
				}
			},
			error: function(data){
			 	data=JSON.parse(data.responseText);
			 	console.log(data.message);
			    alert(data.message);
			}
		});
	});

	$('#mzigoformbuilty').submit(function(e){
		e.preventDefault();
		var fd = new FormData();
		var id='';
		var $inputs = $('#mzigoformbuilty :input');
		$('#submit').attr("disabled", true);
		$('#header-loader').attr('style',"display:flex !important;z-index:999999 !important");
	    $inputs.each(function() {
	    	if(this.classList.contains('required') && $(this).val()==''){
	    		$('#'+[this.id]+'error').html('This field is required.');
	    		return false;
	    	}
	    	if([this.id]=='id' && $(this).val()!=''){
	    		fd.append([this.id],$(this).val());
	    		id=$(this).val();
	    	}else if([this.id]=='request'){
	    		request=$(this).val();
	    	}else if(this.classList.contains('radioBtn')){
	    		fd.append([this.id],$('input[name="'+this.id+'"]:checked').val());
	    	}else{
	    		fd.append([this.id],$(this).val());
	        }
	    });
	    //alert(request);
		$.ajax({
			type:'POST',
			url:((request!='vehicle-checklist-add')?request+'/'+((id=='')?'new':'update'):'vehicle-checklist/add'),
			contentType: false,
			processData: false,
			dataType: 'json',
			data:fd,
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			success:function(data) {
				if(data.success==true){
					window.location.reload();
				}else{
					//$("#defaultProject").removeClass('show');
					setTimeout(function(){ 
					$('.project-invalid-feedback').html(data.msg);
					}, 1000);
				}
			},
			error: function(data){
			 	data=JSON.parse(data.responseText);
			 	console.log(data.message);
			    alert(data.message);
			}
		});
	});

	$('#mzigoform2').submit(function(e){
		e.preventDefault();
		var fd = new FormData();
		var id='';
		var $inputs2 = $('#mzigoform2 :input');
		$('#submit').attr("disabled", true);
		$('#header-loader').attr('style',"display:flex !important;z-index:999999 !important");
	    $inputs2.each(function() {
	    	if(this.classList.contains('required') && $(this).val()==''){
	    		$('#'+[this.id]+'error').html('This field is required.');
	    		return false;
	    	}
	    	if([this.id]=='id' && $(this).val()!=''){
	    		fd.append([this.id],$(this).val());
	    		id=$(this).val();
	    	}else if([this.id]=='request2'){
	    		request=$(this).val();
	    	}else{
	        	fd.append([this.id],$(this).val());
	        }
	    });
		$.ajax({
			type:'POST',
			url:request+'/'+((id=='')?'new':'update'),
			contentType: false,
			processData: false,
			dataType: 'json',
			data:fd,
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			success:function(data) {
				if(data.success==true){
					window.location.reload();
				}else{
					//$("#defaultProject").removeClass('show');
					setTimeout(function(){ 
					$('.project-invalid-feedback').html(data.msg);
					}, 1000);
				}
			}
		});
	});

	$('#mzigoform3').submit(function(e){
		e.preventDefault();
		var fd = new FormData();
		var id='';
		var $inputs = $('#mzigoform3 :input');
		$('#submit').attr("disabled", true);
		$('#header-loader').attr('style',"display:flex !important;z-index:999999 !important");
	    $inputs.each(function() {
	    	if(this.classList.contains('required') && $(this).val()==''){
	    		$('#'+[this.id]+'error').html('This field is required.');
	    		return false;
	    	}
	    	if([this.id]=='id' && $(this).val()!=''){
	    		fd.append([this.id],$(this).val());
	    		id=$(this).val();
	    	}else if([this.id]=='request3'){
	    		request=$(this).val();
	    	}else{
	        	fd.append([this.id],$(this).val());
	        }
	    });
		$.ajax({
			type:'POST',
			url:request+'/'+((id=='')?'new':'update'),
			contentType: false,
			processData: false,
			dataType: 'json',
			data:fd,
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			success:function(data) {
				if(data.success==true){
					window.location.reload();
				}else{
					data=JSON.parse(data.responseText);
				 	//console.log(data.message);
				    alert(data.message);
				    $('#submit').attr("disabled", false);
					$('#header-loader').attr('style',"display:none !important;z-index:999999 !important");
				}
			},
			error:function(data){
				data=JSON.parse(data.responseText);
				 	//console.log(data.message);
				    alert(data.message);
				    $('#submit').attr("disabled", false);
					$('#header-loader').attr('style',"display:none !important;z-index:999999 !important");
			}
		});
	});

	$('#mzigoform4').submit(function(e){
		e.preventDefault();
		var fd = new FormData();
		var id='';
		var $inputs = $('#mzigoform4 :input');
		$('#submit').attr("disabled", true);
		$('#header-loader').attr('style',"display:flex !important;z-index:999999 !important");
	    $inputs.each(function() {
	    	if(this.classList.contains('required') && $(this).val()==''){
	    		$('#'+[this.id]+'error').html('This field is required.');
	    		return false;
	    	}
	    	if([this.id]=='id' && $(this).val()!=''){
	    		fd.append([this.id],$(this).val());
	    		id=$(this).val();
	    	}else if([this.id]=='request4'){
	    		request=$(this).val();
	    	}else{
	    		//alert([this.id]);
	        	fd.append([this.id],$(this).val());
	        }
	    });
	    var vehicleType=$('#vehicle_type').val();
	    if(vehicleType=='H'){
	    	var advance=$('#advance').val();
			var freight_value=$('#freight_value').val();
			var detention_per_day=$('#detention_per_day').val();
			var trip_days=$('#trip_days').val();
			var starting_notes=$('#starting_notes').val();
			fd.append('advance',advance);
			fd.append('freight_value',freight_value);
			fd.append('detention_per_day',detention_per_day);
			fd.append('trip_days',trip_days);
			fd.append('starting_notes',starting_notes);
	    }
		$.ajax({
			type:'POST',
			url:request+'/'+((id=='')?'new':'update'),
			contentType: false,
			processData: false,
			dataType: 'json',
			data:fd,
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			success:function(data) {
				if(data.success==true){
					window.location.reload();
				}else{
					//$("#defaultProject").removeClass('show');
					setTimeout(function(){ 
					$('.project-invalid-feedback').html(data.msg);
					}, 1000);
				}
			}
		});
	});

	$('#mzigoform5').submit(function(e){
		e.preventDefault();
		var fd = new FormData();
		var id='';
		var $inputs = $('#mzigoform5 :input');
		$('#submit').attr("disabled", true);
		$('#header-loader').attr('style',"display:flex !important;z-index:999999 !important");
	    $inputs.each(function() {
	    	if(this.classList.contains('required') && $(this).val()==''){
	    		$('#'+[this.id]+'error').html('This field is required.');
	    		return false;
	    	}
	    	if([this.id]=='id' && $(this).val()!=''){
	    		fd.append([this.id],$(this).val());
	    		id=$(this).val();
	    	}else if([this.id]=='request5'){
	    		request=$(this).val();
	    	}else{
	        	fd.append([this.id],$(this).val());
	        }
	    });

		$.ajax({
			type:'POST',
			url:request+'/settled',
			contentType: false,
			processData: false,
			dataType: 'json',
			data:fd,
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			success:function(data) {
				if(data.success==true){
					window.location.reload();
				}else{
					//$("#defaultProject").removeClass('show');
					setTimeout(function(){ 
					$('.project-invalid-feedback').html(data.msg);
					}, 1000);
				}
			}
		});
	});

	$('#kt_toolbar_primary_button').click(function(e){
		$('#name').val('');
		$('#description').val('');
		$('#id').val('');
	});

	$( ".edit-btn" ).each(function( index ) {
		var idInp=this.id;
		$('#'+idInp).bind('click',function(){
			var id = this.id.split('edit')[1];
			var fd = new FormData();
			fd.append('id',id);
			$.ajax({
				type:'POST',
				url:request+'/edit',
				contentType: false,
				processData: false,
				dataType: 'json',
				data:fd,
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				success:function(data) {
					if(data.success==true){
						$('#'+request.split('/')[1]+'_app').modal('toggle');
						var keys=data.data;
						$.each(keys, function( index, value ) {
							if($('#'+index)){
								if(index=='franchise'){
									$('#franchise').val(value.name);
								}else{
									$('#'+index).val(value);
								}
							}
						});
					}else{
						setTimeout(function(){ 
						$('.project-invalid-feedback').html(data.msg);
						}, 1000);
					}
				}
			});
		});
	});

	$( ".status-btn" ).each(function( index ) {
		var idInp=this.id;
		$('#'+idInp).bind('click',function(){
			if(!confirm('Please click `OK` to proceed ?')){
				return false;
			}
			var id = this.id.split('status')[1];
			var fd = new FormData();
			fd.append('id',id);
			$.ajax({
				type:'POST',
				url:request+'/status',
				contentType: false,
				processData: false,
				dataType: 'json',
				data:fd,
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				success:function(data) {
					if(data.success==true){
						window.location.reload();
					}else{
						setTimeout(function(){ 
						$('.project-invalid-feedback').html(data.msg);
						}, 1000);
					}
				}
			});
		});
	});
	$('#vehicle_category').change(function(e){
		if($('#vehicle_category').val()=='Reefer'){
			$('body').find('.reefer-field').removeClass('d-none');
		}else{
			$('body').find('.reefer-field').addClass('d-none');
		}
	});
	$('#ownership').change(function(e){
		if($('#ownership').val()=='H'){
			$('body').find('.owner-field').removeClass('d-none');
			$('body').find('.self-field').addClass('d-none');
		}else{
			$('body').find('.self-field').removeClass('d-none');
			$('body').find('.owner-field').addClass('d-none');
		}
	});
	$('#reefer_type').change(function(e){
		if($('#reefer_type').val()=='S'){
			$('body').find('.reefer-field-1').removeClass('d-none');
		}else{
			$('body').find('.reefer-field-1').addClass('d-none');
		}
	});
});
function changeStatus(id,request){
	if(!confirm('Please click `OK` to proceed ?')){
		return false;
	}
	var fd = new FormData();
	fd.append('id',id);
	$.ajax({
		type:'POST',
		url:request+'/status',
		contentType: false,
		processData: false,
		dataType: 'json',
		data:fd,
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		success:function(data) {
			if(data.success==true){
				window.location.reload();
			}else{
				setTimeout(function(){ 
				$('.project-invalid-feedback').html(data.msg);
				}, 1000);
			}
		}
	});
}