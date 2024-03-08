
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Firm Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone_no', 'Phone No:') !!}
    {!! Form::text('phone_no', null, ['class' => 'form-control']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('residential_address', 'Residential Address:') !!}
    {!! Form::text('residential_address', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('office_address', 'Office Address:') !!}
    {!! Form::text('office_address', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('city', 'City:') !!}
    {!! Form::text('city', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('state', 'State:') !!}
    {!! Form::text('state', null, ['class' => 'form-control']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('gst_no', 'GST No:') !!}
    {!! Form::text('gst_no', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('account_no', 'Account No:') !!}
    {!! Form::text('account_no', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('ifsc', 'IFSC Code:') !!}
    {!! Form::text('ifsc', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('bank', 'Bank:') !!}
    {!! Form::text('bank', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('branch', 'Branch:') !!}
    {!! Form::text('branch', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    <div class="form-group">
        {!! Form::label('aadhaar', 'Aadhaar:') !!}
        {!! Form::file('aadhaarn', ['class' => 'form-control', 'id' => 'file2']) !!}
    </div>
    <div class="form-group mt-2">
        <?php 
        $src = '';
        $srcId = '';
        if(!empty($agent) && $agent->aadhaar != '' ){ 
            $src = $agent->aadhaarMedia->file_path;
            $srcId = $agent->aadhaar;
        } 
        ?>
        {!! Form::hidden('aadhaar', $srcId, ['class' => 'form-control', 'id' => 'aadhaar']) !!}
        <a href="{{$src}}" id="aadhaar-preview" style="display: {{(($src!='')?'block':'none')}};">Aadhaar</a>
    </div>
</div>

<div class="form-group col-sm-6">
    <div class="form-group">
        {!! Form::label('avatar', 'Pan:') !!}
        {!! Form::file('pan', ['class' => 'form-control', 'id' => 'file']) !!}
    </div>
    <div class="form-group mt-2">
        <?php 
        $src = '';
        $srcId = '';
        if(!empty($agent) && $agent->pan != '' ){ 
            $src = $agent->panMedia->file_path;
            $srcId = $agent->pan;
        } 
        ?>
        {!! Form::hidden('pan', $srcId, ['class' => 'form-control', 'id' => 'pan']) !!}
        <a href="{{$src}}" id="avatar-preview" style="display: {{(($src!='')?'block':'none')}};">PAN</a>
    </div>
</div>
<div class="form-group col-sm-6">
    <div class="form-group">
        {!! Form::label('cancel_cheque', 'Cancelled Cheque:') !!}
        {!! Form::file('cancel_cheque', ['class' => 'form-control', 'id' => 'file1']) !!}
    </div>
    <div class="form-group mt-2">
        <?php 
        $src = '';
        $srcId = '';
        if(!empty($agent) && $agent->bank_cancel_cheque != '' ){ 
            $src = $agent->chequeMedia->file_path;
            $srcId = $agent->bank_cancel_cheque;
        } 
        ?>
        {!! Form::hidden('bank_cancel_cheque', $srcId, ['class' => 'form-control', 'id' => 'bank_cancel_cheque']) !!}
        <a href="{{$src}}" id="cancel-cheque-preview" style="display: {{(($src!='')?'block':'none')}};">Cancelled Cheque</a>
    </div>
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    <?php 
    $status = '';
    if(!empty($agent) && $agent['status'] != '' ){ $status = $agent['status'];} else{ $status = 1; } 
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
                    $('#pan').val(response.file);
                },
                error: function(error) {
                    alert("Error occurred while uploading the image.");
                    console.error(error);
                }
            });

            readURL(this,'avatar-preview');
        });

        $("#file1").change(function() {
            
            var formData = new FormData();
            var imageInput = $("#file1")[0]; // Get the DOM element of the input
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
                    $('#bank_cancel_cheque').val(response.file);
                },
                error: function(error) {
                    alert("Error occurred while uploading the image.");
                    console.error(error);
                }
            });

            readURL(this,'cancel-cheque-preview');
        });

        $("#file2").change(function() {
            
            var formData = new FormData();
            var imageInput = $("#file2")[0]; // Get the DOM element of the input
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
                    $('#aadhaar').val(response.file);
                },
                error: function(error) {
                    alert("Error occurred while uploading the image.");
                    console.error(error);
                }
            });

            readURL(this,'aadhaar-preview');
        });

        function readURL(input,id) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $("#"+id).attr("href", e.target.result).show();
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    });
    
</script>
@endpush
