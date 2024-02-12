"use strict";
var KTCreateAccount = function() {
    var e, t, i, o, s, r, a = [];
    return {
        init: function() {
            (e = document.querySelector("#franchises_app")) && new bootstrap.Modal(e), t = document.querySelector("#franchises_app_stepper"), i = t.querySelector("#franchiseform"), o = t.querySelector('[data-kt-stepper-action="submit"]'), s = t.querySelector('[data-kt-stepper-action="next"]'), (r = new KTStepper(t)).on("kt.stepper.changed", (function(e) {
                5 === r.getCurrentStepIndex() ? (o.classList.remove("d-none"), o.classList.add("d-inline-block"), s.classList.add("d-none")) : 5 === r.getCurrentStepIndex() ? (o.classList.add("d-none"), s.classList.add("d-none")) : (o.classList.remove("d-inline-block"), o.classList.remove("d-none"), s.classList.remove("d-none"))
            })), r.on("kt.stepper.next", (function(e) {
                console.log("stepper.next");
                var t = a[e.getCurrentStepIndex() - 1];
                t ? t.validate().then((function(t) {
                    console.log("validated!"), "Valid" == t ? (e.goNext(), KTUtil.scrollTop()) : Swal.fire({
                        text: "Sorry, looks like there are some errors detected, please try again.",
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-light"
                        }
                    }).then((function() {
                        KTUtil.scrollTop()
                    }))
                })) : (e.goNext(), KTUtil.scrollTop())
            })), r.on("kt.stepper.previous", (function(e) {
                console.log("stepper.previous"), e.goPrevious(), KTUtil.scrollTop()
            })), a.push(FormValidation.formValidation(i, {
                fields: {
                    name: {
                        validators: {
                            notEmpty: {
                                message: "Name is required"
                            }
                        }
                    },
                    designation: {
                        validators: {
                            notEmpty: {
                                message: "Designation is required"
                            }
                        }
                    },
                    email: {
                        validators: {
                            notEmpty: {
                                message: "Email is required"
                            }
                        }
                    },
                    /*phone_no: {
                        validators: {
                            notEmpty: {
                                message: "Phone no is required"
                            },
                            digits: {
                                message: "Phone no must contain only digits"
                            },
                            stringLength: {
                                min: 10,
                                max: 12,
                                message: "Phone no must contain 10 to 12 digits only"
                            }
                        }
                    },*/
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger,
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: ".fv-row",
                        eleInvalidClass: "",
                        eleValidClass: ""
                    })
                }
            })), a.push(FormValidation.formValidation(i, {
                fields: {
                    
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger,
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: ".fv-row",
                        eleInvalidClass: "",
                        eleValidClass: ""
                    })
                }
            })), a.push(FormValidation.formValidation(i, {
                fields: {
                    
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger,
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: ".fv-row",
                        eleInvalidClass: "",
                        eleValidClass: ""
                    })
                }
            })), a.push(FormValidation.formValidation(i, {
                fields: {
                    
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger,
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: ".fv-row",
                        eleInvalidClass: "",
                        eleValidClass: ""
                    })
                }
            })), a.push(FormValidation.formValidation(i, {
                fields: {
                
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger,
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: ".fv-row",
                        eleInvalidClass: "",
                        eleValidClass: ""
                    })
                }
            })), o.addEventListener("click", (function(e) {
                /*a[3].validate().then((function(t) {
                    console.log("validated!"), "Valid" == t ? (e.preventDefault(), o.disabled = !0, o.setAttribute("data-kt-indicator", "on"), setTimeout((function() {
                        o.removeAttribute("data-kt-indicator"), o.disabled = !1, r.goNext()
                    }), 2e3)) : Swal.fire({
                        text: "Sorry, looks like there are some errors detected, please try again.",
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-light"
                        }
                    }).then((function() {
                        KTUtil.scrollTop()
                    }))
                }))*/
            }))
        }
    }
}();
KTUtil.onDOMContentLoaded((function() {
    KTCreateAccount.init()
}));
$( document ).ready(function() {
	var request=window.location.pathname;
    $('#franchiseform').submit(function(e){
		e.preventDefault();
		var fd = new FormData();
		var id = '';
		var $inputs = $('#franchiseform :input');
	    $inputs.each(function() {
	    	if(this.classList.contains('required') && $(this).val()==''){
	    		$('#'+[this.id]+'error').html('This field ('+[this.id]+') is required.');
	    		return false;
	    	}
	    	if([this.id]=='id' && $(this).val()!=''){
	    		fd.append([this.id],$(this).val());
	    		id=$(this).val();
	    	}else if([this.id]=='gender'){
	    		fd.append([this.id],$('input[name="gender"]:checked').val());
	    	}else{
	        	fd.append([this.id],$(this).val());
	        }
	    });
		$.ajax({
			type:'POST',
			url:'/franchises/'+((id=='')?'new':'update'),
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
			    alert(data.data[Object.keys(data.data)]);
			  }
		});
	});
	$('#kt_toolbar_primary_button').click(function(e){
		$('#name').val('');
		$('#description').val('');
		$('#id').val('');
	});
	$( ".u-edit-btn" ).each(function( index ) {
		var idInp=this.id;
		$('#'+idInp).bind('click',function(){
			var id=this.id.split('edit')[1];
			var fd = new FormData();
			fd.append('id',id);
			$.ajax({
				type:'POST',
				url:'/franchises'+'/edit',
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
						$('#name').val(data.data.name);
						$('#email').val(data.data.email);
						$('#phone_no').val(data.data.user_details.phone_no);
						$('#contact_person').val(data.data.user_details.contact_person);
						$('#mobile_no').val(data.data.user_details.mobile_no);
						$('#address').val(data.data.user_details.address);
						$('#gstno').val(data.data.user_details.gstno);
						$('#website').val(data.data.user_details.website);
						$('#id').val(data.data.id);
					}else{
						setTimeout(function(){ 
							console.log(data.msg);
							$('.project-invalid-feedback').html(data.msg);
						}, 1000);
					}
				}
			});
		});
	});
	$('#kt_toolbar_primary_button').click(function(e){
		$('#name').val('');
		$('#email').val('');
		$('#phone_no').val('');
		$('#gender').val('');
		$('#designation').val('');
		$('#dob').val('');
		$('#address').val('');
		$('#id_no').val('');
		$('#id_type').val('');
		$('#id').val('');
	});
	$( ".u-view-btn" ).each(function( index ) {
		var idInp=this.id;
		$('#'+idInp).bind('click',function(){
			var id = this.id.split('view')[1];
		  	var fd = new FormData();
		    fd.append('id',id);
		    $.ajax({
				type:'POST',
				url:'/users'+'/view',
				contentType: false,
				processData: false,
				dataType: 'json',
				data:fd,
				headers: {
				    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				success:function(data) {
					console.log(data);
					if(data.success==true){
						$('#'+request.split('/')[1]+'_details').modal('toggle');
						$('#name').val(data.data.name);
						$('#email').val(data.data.email);
						$('#phone_no').val(data.data.user_details.phone_no);
						$('#contact_person').val(data.data.user_details.contact_person);
						$('#mobile_no').val(data.data.user_details.mobile_no);
						$('#gender').val(data.data.user_details.gender);
						$('#dob').val(data.data.user_details.dob);
						$('#address').val(data.data.user_details.address);
						$('#gstno').val(data.data.user_details.gstno);
						$('#website').val(data.data.user_details.website);
					}else{
						setTimeout(function(){ 
							$('.project-invalid-feedback').html(data.msg);
						}, 1000);
					}
				}
			});
		});
	});
});