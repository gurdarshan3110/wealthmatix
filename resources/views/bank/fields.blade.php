<!-- Name Field -->
<div class="form-group col-sm-6">
    <div class="form-group">
        {!! Form::label('avatar', 'Logo:') !!}
        {!! Form::file('image', ['class' => 'form-control', 'id' => 'file']) !!}
    </div>
    <div class="form-group mt-2">
        <?php 
        $src = '';
        $srcId = '';
        if(!empty($bank) && $bank->logo != '' ){ 
            $src = $bank->logoMedia->file_path;
            $srcId = $bank->logo;
        } 
        ?>
        {!! Form::hidden('logo', $srcId, ['class' => 'form-control', 'id' => 'logo_image']) !!}
        <img src="{{$src}}" alt="Preview" class="img-thumbnail" id="avatar-preview" style="display: {{(($src!='')?'block':'none')}}; max-width: 200px; max-height: 200px;">
    </div>
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('channel_name', 'Channel Name:') !!}
    {!! Form::text('channel_name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('channel_code', 'Channel Code:') !!}
    {!! Form::text('channel_code', null, ['class' => 'form-control']) !!}
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
