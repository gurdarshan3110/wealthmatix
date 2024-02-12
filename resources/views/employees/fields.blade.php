<!-- Avatar Field -->
<div class="form-group col-sm-6">
    <div class="form-group">
        {!! Form::label('avatar', 'Image:') !!}
        {!! Form::file('image', ['class' => 'form-control', 'id' => 'file']) !!}
    </div>
    <div class="form-group mt-2">
        <?php 
        $src = '';
        $srcId = '';
        if(!empty($employee) && $employee->profile_picture != '' ){ 
            $src = $employee->media;
            $srcId = $employee->profile_picture;
        } 
        ?>
        {!! Form::hidden('profile_picture', $srcId, ['class' => 'form-control', 'id' => 'employee_image']) !!}
        <img src="{{$src}}" alt="Preview" class="img-thumbnail" id="avatar-preview" style="display: {{(($src!='')?'block':'none')}}; max-width: 200px; max-height: 200px;">
    </div>
</div>
<!-- Name Field -->
<div class="form-group col-sm-6"></div>
<div class="form-group col-sm-6">
    {!! Form::label('name', 'First Name:') !!}
    {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Last Name:') !!}
    {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
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
    {!! Form::label('hire_date', 'Hire Date:') !!}
    {!! Form::date('hire_date', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('salary', 'Salary:') !!}
    {!! Form::text('salary', null, ['class' => 'form-control']) !!}
</div>


<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    <?php 
    $status = '';
    if(!empty($employee) && $employee['status'] != '' ){ $status = $employee['status'];} else{ $status = 1; } 
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
                    $('#employee_image').val(response.file);
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
