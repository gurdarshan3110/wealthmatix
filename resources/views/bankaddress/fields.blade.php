
<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('bank_id', 'Bank:') !!}
    {!! Form::label('bank_id', 'Bank:') !!}
    <?php 
    $bank_id = '';
    if(!empty($bankaddress) && $bank['bankaddress'] != '' ){ $bank_id = $bankaddress['bank_id'];} 
    ?>
    {!! Form::select('bank_id',$banks, $bank_id, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('City', 'City:') !!}
    {!! Form::text('city', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('address', 'Address:') !!}
    {!! Form::text('address', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('sales_manager', 'Sales Manager:') !!}
    {!! Form::text('sales_manager', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('sales_manager_email', 'Sales manager Email:') !!}
    {!! Form::email('sales_manager_email', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('sales_manager_phone', 'Sales Manager Phone:') !!}
    {!! Form::text('sales_manager_phone', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('area_sales_manager', 'Area Sales Manager:') !!}
    {!! Form::text('area_sales_manager', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('area_sales_manager_email', 'Area Sales manager Email:') !!}
    {!! Form::email('area_sales_manager_email', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('area_sales_manager_phone', 'Area Sales Manager Phone:') !!}
    {!! Form::text('area_sales_manager_phone', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    <?php 
    $status = '';
    if(!empty($bank) && $bank['status'] != '' ){ $status = $bank['status'];} else{ $status = 1; } 
    ?>
    {!! Form::select('status', ['' =>'Select Status',0 =>'In Active', 1 => 'Active'], $status, ['class' => 'form-control']) !!}
</div>
@push('jsscript')
<script type="text/javascript">
    $(document).ready(function() {
        $("#file").change(function() {
            
            var formData = new FormData();
            var imageInput = $("#file")[0]; // Get the DOM element of the input
            // Check if an image is selected
            if (imageInput.files.length > 0) {
                formData.append("image", imageInput.files[0]);
            }
            formData.append("_token", "{{ csrf_token() }}");
            $.ajax({
                url: "{{ route('upload.media') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#logo_image').val(response.file);
                },
                error: function(error) {
                    alert("Error occurred while uploading the image.");
                    console.error(error);
                }
            });

            readURL(this);
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $("#avatar-preview").attr("src", e.target.result).show();
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    });
    
</script>
@endpush
