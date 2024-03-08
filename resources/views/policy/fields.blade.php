
<div class="form-group col-sm-6">
    {!! Form::label('bank', 'Bank:') !!}

    <?php 
    $bank = '';
    if(!empty($policy) && $policy['bank_id'] != '' ){ $policy = $policy['bank_id'];} 
    ?>
    {!! Form::select('bank_id', $banks, $bank, ['class' => 'form-select1 form-control','data-control'=>"select2",'data-hide-search'=>"false",'id'=>'bank_id']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('loan', 'Loan:') !!}

    <?php 
    $loan = '';
    if(!empty($policy) && $policy['loan_id'] != '' ){ $policy = $policy['loan_id'];} 
    ?>
    {!! Form::select('loan_id', $loans, $loan, ['class' => 'form-select1 form-control','data-control'=>"select2",'data-hide-search'=>"false",'id'=>'loan_id']) !!}
</div>

<div class="form-group col-sm-6">
    <div class="form-group">
        {!! Form::label('avatar', 'Upload Policy Document:') !!}
        {!! Form::file('image', ['class' => 'form-control', 'id' => 'file']) !!}
    </div>
    <div class="form-group mt-2">
        <?php 
        $src = '';
        $srcId = '';
        if(!empty($policy) && $policy->policy != '' ){ 
            $src = $policy->policyMedia->file_path;
            $srcId = $policy->policy;
        } 
        ?>
        {!! Form::hidden('policy', $srcId, ['class' => 'form-control', 'id' => 'logo_image']) !!}
        <a href="{{$src}}" target="_blank" class="img-thumbnail" id="avatar-preview" style="display: {{(($src!='')?'block':'none')}};" >Policy</a>
    </div>
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    <?php 
    $status = '';
    if(!empty($policy) && $policy['status'] != '' ){ $status = $policy['status'];} else{ $status = 1; } 
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
                    $("#avatar-preview").attr("href", e.target.result).show();
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    });
    
</script>
@endpush

