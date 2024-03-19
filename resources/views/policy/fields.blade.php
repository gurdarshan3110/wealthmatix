
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


<div class="form-group col-sm-6">
    {!! Form::label('category_id', 'Category:') !!}
    <br>
    <?php 
    $category = '';
    if(!empty($policy) && $policy['category_id'] != '' ){ $policy = $policy['category_id'];} 
    ?>
    {!! Form::select('category_id[]', $categories, $category, ['class' => 'form-select form-control','id'=>'category_id',"multiple data-live-search"=>"true"]) !!}
</div>

<div class="form-group col-sm-6"></div>
<!-- Model Field -->

@if(isset($route->stops))
    @foreach($route->stops as $index => $stop)
        <div class="form-group col-sm-4 stop-container">
            {!! Form::label('name', 'Parameter:') !!}
            {!! Form::select('parameter_id[]', $parameters, null, ['class' => 'form-select form-control parameter','id'=>'parameter_id']) !!}
        </div>
        <div class="form-group col-sm-3">
            <label>Start/Min</label>
            {!! Form::text("start[]", null, ["class" => "form-control"]) !!}
        </div>
        <div class="form-group col-sm-3">
            <label>End/Max</label>
            {!! Form::text("end[]", null, ["class" => "form-control"]) !!}
        </div>
        <div class="form-group col-sm-2">
            <br><br>
            <button type="button" class="btn btn-primary btn-sm addStop"><i class="fa fa-plus"></i></button>
        </div>
    @endforeach
@else
    <div class="form-group col-sm-4 stop-container">
        {!! Form::label('name', 'Parameter:') !!}
        {!! Form::select('parameter_id[]', $parameters, null, ['class' => 'form-select form-control parameter','id'=>'parameter_id']) !!}
    </div>
    <div class="form-group col-sm-3">
        <label>Start/Min</label>
        {!! Form::text("start[]", null, ["class" => "form-control"]) !!}
    </div>
    <div class="form-group col-sm-3">
        <label>End/Max</label>
        {!! Form::text("end[]", null, ["class" => "form-control"]) !!}
    </div>
    <div class="form-group col-sm-2">
        <br><br>
        <button type="button" class="btn btn-primary btn-sm addStop"><i class="fa fa-plus"></i></button>
    </div>
@endif


<div class="form-group col-sm-4 laststop">
</div>

@push('jsscript')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/css/bootstrap-select.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#category_id').selectpicker();
    });
    $("body").on("click", ".addStop", function() {
        placeSelected=false;
        var count = document.getElementsByClassName("parameter").length+1;
        var newStop = '<div class="row" id="stopContainer' + count + '">' +
    '<div class="form-group col-sm-4 stop-container">' +
    '<label>Parameter:</label>' +
    '{!! Form::select("parameter_id[]", $parameters, null, ["class" => "form-select1 form-control parameter","data-control" => "select2","data-hide-search" => "false","id" => "parameter_id'+count+'"]) !!}' +
    '</div>' +
    '<div class="form-group col-sm-3">' +
    '<label>Start/Min</label>'+
    '{!! Form::text("start[]", null, ["class" => "form-control"]) !!}'+
    '</div><div class="form-group col-sm-3">' +
    '<label>End/Max</label>'+
    '{!! Form::text("end[]", null, ["class" => "form-control"]) !!}'+
    '</div><div class="form-group col-sm-2"><br><br>' +
    '<button type="button" class="removeStop btn btn-sm btn-danger" data-count="' + count + '"><i class="fa fa-times"></i></button>' +
    '&nbsp;<button type="button" class="btn btn-sm btn-primary addStop"><i class="fa fa-plus"></i></button>' +
    '</div>' +
    '<div class="form-group col-sm-6 stop-container"></div>' +
    '</div>';
        $(".laststop").before(newStop);
    });
    $(document).on("click", ".removeStop", function () {
        var count = $(this).data('count');
        $("#stopContainer" + count).remove();
    });
    
</script>

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

