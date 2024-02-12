"use strict";
$( document ).ready(function() {
    var request=window.location.pathname;
    $('#vehicleform').submit(function(e){
        e.preventDefault();
        var fd = new FormData();
        var id='';
        var $inputs = $('#vehicleform :input');
        if($('ownership').val()=='H'){
            if($('vendor').val()=='' || $('vendor_phone_no').val()==''){
                alert('Vendor and Vendor Phone No are required');
                return false;
            }
            if($('owner').val()=='' || $('owner_phone_no').val()==''){
                alert('Owner and Owner Phone No are required');
                return false;
            }
            if($('driver').val()=='' || $('driver_phone_no').val()==''){
                alert('Driver and Driver Phone No are required');
                return false;
            }
        }

        $inputs.each(function() {
            if(this.classList.contains('required') && $(this).val()==''){
                $('#'+[this.id]+'error').html('This field ('+[this.id]+') is required.');
                return false;
            }
            if([this.id]=='id' && $(this).val()!=''){
                fd.append([this.id],$(this).val());
                id=$(this).val();
            }else{
                fd.append([this.id],$(this).val());
            }
        });
        $.ajax({
            type:'POST',
            url:'/vehicles/'+((id=='')?'new':'update'),
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
    $( ".v-edit-btn" ).each(function( index ) {
      var idInp=this.id;
      $('#'+idInp).bind('click',function(){
        var id=this.id.split('edit')[1];
        
      });
    });
    $('#kt_toolbar_primary_button').click(function(e){
        $('#vehicle_type option[value=""]').attr('selected','selected');
        $('#name').val('');
        $('#registration_no').val('');
        $('#registration_date').val('');
        $('#model').val('');
        $('#engine_power').val('');
        $('#load_capacity').val('');
        $('#wheels').val('');
        $('#tire_size').val('');
        $('#insurance_due').val('');
        $('#pollution_due').val('');
        $('#description').val('');
        $('#id').val('');
    });
});
var KTCreateApp = function() {
    var e, t, o, r, a, i, n = [];
    return {
        init: function() {
            (e = document.querySelector("#vehicles_app")) && (new bootstrap.Modal(e), t = document.querySelector("#vehicles_app_stepper"), o = document.querySelector("#vehicleform"), r = t.querySelector('[data-kt-stepper-action="submit"]'), a = t.querySelector('[data-kt-stepper-action="next"]'), (i = new KTStepper(t)).on("kt.stepper.changed", (function(e) {
                4 === i.getCurrentStepIndex() ? (r.classList.remove("d-none"), r.classList.add("d-inline-block"), a.classList.add("d-none")) : 5 === i.getCurrentStepIndex() ? (r.classList.add("d-none"), a.classList.add("d-none")) : (r.classList.remove("d-inline-block"), r.classList.remove("d-none"), a.classList.remove("d-none"))
            })), i.on("kt.stepper.next", (function(e) {
                console.log("stepper.next");
                var t = n[e.getCurrentStepIndex() - 1];
                t ? t.validate().then((function(t) {
                    console.log("validated!"), "Valid" == t ? e.goNext() : Swal.fire({
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
            })), i.on("kt.stepper.previous", (function(e) {
                console.log("stepper.previous"), e.goPrevious(), KTUtil.scrollTop()
            })), r.addEventListener("click", (function(e) {
                /*n[3].validate().then((function(t) {
                    console.log("validated!"), "Valid" == t ? (e.preventDefault(), r.disabled = !0, r.setAttribute("data-kt-indicator", "on"), setTimeout((function() {
                        r.removeAttribute("data-kt-indicator"), r.disabled = !1, i.goNext()
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
            })),n.push(FormValidation.formValidation(o, {
                fields: {
                    vehicle_category: {
                        validators: {
                            notEmpty: {
                                message: "Vehicle category is required"
                            }
                        }
                    },
                    registration_no: {
                        validators: {
                            notEmpty: {
                                message: "Registration No. is required"
                            },
                            stringLength: {
                              min:5,
                              max:15,
                              message: 'Please enter valid Registration No.'
                            }
                        }
                    },
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger,
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: ".fv-row",
                        eleInvalidClass: "",
                        eleValidClass: ""
                    })
                }
            })), n.push(FormValidation.formValidation(o, {
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
            })), n.push(FormValidation.formValidation(o, {
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
            })), n.push(FormValidation.formValidation(o, {
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
            })))
        }
    }
}();
KTUtil.onDOMContentLoaded((function() {
    KTCreateApp.init()
}));


function view(id){
    var fd = new FormData();
    fd.append('id',id);
    $.ajax({
        type:'POST',
        url:'/vehicle/view',
        contentType: false,
        processData: false,
        dataType: 'json',
        data:fd,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success:function(data) {
            if(data.success==true){
                $('#kt_modal_create_app').modal('toggle');
                $('#vehicle_type').val(data.data.vehicle_type);
                $('#name').val(data.data.name);
                $('#registration_no').val(data.data.registration_no);
                $('#registration_date').val(data.data.registration_date);
                $('#model').val(data.data.model);
                $('#engine_power').val(data.data.engine_power);
                $('#load_capacity').val(data.data.load_capacity);
                $('#wheels').val(data.data.wheels);
                $('#tire_size').val(data.data.tire_size);
                $('#insurance_due').val(data.data.insurance_due);
                $('#pollution_due').val(data.data.pollution_due);
                $('#description').val(data.data.description);
                $('#id').val(data.data.id);

                //console.log(data);
            }else{
                //$("#defaultProject").removeClass('show');
                setTimeout(function(){ 
                    $('.project-invalid-feedback').html(data.msg);
                }, 1000);
            }
        }
    });
}
function edit(id){
    var fd = new FormData();
    fd.append('id',id);
    $.ajax({
      type:'POST',
      url:'/vehicles'+'/edit',
      contentType: false,
      processData: false,
      dataType: 'json',
      data:fd,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
      success:function(vdata) {
        if(vdata.success==true){
            $('#vehicles_app').modal('toggle');
            $('#vehicle_type').val(vdata.data.vehicle_type);
            $('#vehicle_category').val(vdata.data.vehicle_category);
            $('#vehicle_fuel_id').val(vdata.data.vehicle_fuel_id);
            $('#vehicle_make_id').val(vdata.data.vehicle_make_id);
            $('#container_make_id').val(vdata.data.container_make_id);
            $('#reefer_make_id').val(vdata.data.reefer_make_id);
            $('#reefer_model').val(vdata.data.reefer_model);
            $('#reefermodel').val(vdata.data.reefermodel);
            $('#container_model').val(vdata.data.container_model);
            $('#containermodel').val(vdata.data.containermodel);
            $('#container_length').val(vdata.data.container_length);
            $('#container_breadth').val(vdata.data.container_breadth);
            $('#container_height').val(vdata.data.container_height);
            $('#registration_no').val(vdata.data.registration_no);
            $('#registration_date').val(vdata.data.registration_date);
            $('#model').val(vdata.data.model);
            $('#vehiclemodel').val(vdata.data.vehiclemodel);
            $('#gpw').val(vdata.data.gpw);
            $('#unladen').val(vdata.data.unladen);
            $('#wheels').val(vdata.data.wheels);
            $('#tire_size').val(vdata.data.tire_size);
            $('#vehicle_tank_capacity').val(vdata.data.vehicle_tank_capacity);
            $('#vehicle_average').val(vdata.data.vehicle_average);
            $('#local_plain').val(vdata.data.local_plain);
            $('#local_hilly').val(vdata.data.local_hilly);
            $('#vehicle_rough_average').val(vdata.data.vehicle_rough_average);
            $('#vehicle_hilly_average').val(vdata.data.vehicle_hilly_average);
            $('#container_manufacturer').val(vdata.data.container_manufacturer);
            $('#container_model').val(vdata.data.container_model);
            $('#material').val(vdata.data.material);
            $('#side_door').val(vdata.data.side_door);
            $('#lock_type').val(vdata.data.lock_type);
            $('#lock_no').val(vdata.data.lock_no);
            $('#fasttag_id').val(vdata.data.fasttag_id);
            $('#fasttag_no').val(vdata.data.fasttag_no);
            $('#reefer_type').val(vdata.data.reefer_type);
            $('#reefer_size').val(vdata.data.reefer_size);
            $('#reefer_fuel_id').val(vdata.data.reefer_fuel_id);
            $('#reefer_separate_tank').val(vdata.data.reefer_separate_tank);
            $('#reefer_tank_capacity').val(vdata.data.reefer_tank_capacity);
            $('#reefer_average').val(vdata.data.reefer_average);
            $('#description').val(vdata.data.description);
            $('#id').val(vdata.data.id);
            $('#ownership').val(vdata.data.ownership);
            $('#valid_upto').val(vdata.data.valid_upto);
            $('#vendor').val(vdata.data.vendor);
            $('#vendor_phone_no').val(vdata.data.vendor_phone_no);
            $('#vendor_address').val(vdata.data.vendor_address);
            $('#vendor_pan').val(vdata.data.vendor_pan);
            $('#vendor_aadhaar').val(vdata.data.vendor_aadhaar);
            $('#vendor_gstin').val(vdata.data.vendor_gstin);
            $('#owner').val(vdata.data.owner);
            $('#owner_phone_no').val(vdata.data.owner_phone_no);
            $('#owner_address').val(vdata.data.owner_address);
            $('#owner_pan').val(vdata.data.owner_pan);
            $('#owner_aadhaar').val(vdata.data.owner_aadhaar);
            $('#driver').val(vdata.data.driver);
            $('#driver_phone_no').val(vdata.data.driver_phone_no);
            $('#driver_address').val(vdata.data.driver_address);
            $('#driver_license_no').val(vdata.data.driver_license_no);
            $('#driver_license_expiry').val(vdata.data.driver_license_expiry);
            $('#driver_aadhaar').val(vdata.data.driver_aadhaar);
            if(vdata.data.ownership=='H'){
                $('body').find('.owner-field').removeClass('d-none');
                $('body').find('.self-field').addClass('d-none');
            }
            if(vdata.data.vehicle_category=='Reefer'){
                $('body').find('.reefer-field').removeClass('d-none');
            }else{
                $('body').find('.reefer-field').addClass('d-none');
            }
            if(vdata.data.reefer_type=='S'){
                $('body').find('.reefer-field-1').removeClass('d-none');
            }else{
                $('body').find('.reefer-field-1').addClass('d-none');
            }
        }else{
          setTimeout(function(){ 
            $('.project-invalid-feedback').html(data.msg);
          }, 1000);
          
        }
      }
    });
}