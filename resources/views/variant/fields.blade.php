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
        if(!empty($variant) && $variant->variant_image != '' ){ 
            $src = $variant->media;
            $srcId = $variant->variant_image;
        } 
        ?>
        {!! Form::hidden('variant_image', $srcId, ['class' => 'form-control', 'id' => 'variant_image']) !!}
        <img src="{{$src}}" alt="Preview" class="img-thumbnail" id="avatar-preview" style="display: {{(($src!='')?'block':'none')}}; max-width: 200px; max-height: 200px;">
    </div>
</div>
<!-- Name Field -->
<div class="form-group col-sm-6"></div>
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Category Field -->
<div class="form-group col-sm-6">
    {!! Form::label('item', 'Item:') !!}
    <?php
    $item = '';
    if(!empty($variant) && $variant['item'] != '' ){ $item = $variant['item']['name'];} else{ $item = ''; } 
    ?>
    {!! Form::text('item', $item, ['id' => 'item','class'=>'form-control typeahead item','placeholder'=>'Type to search...']) !!}
    {!! Form::hidden('item_id', null, ['id' => 'item_id']) !!}
</div>

<!-- Unit Field -->
<div class="form-group col-sm-6">
    {!! Form::label('unit', 'Unit:') !!}
    <?php
    $unit = '';
    if(!empty($variant) && $variant['unit'] != '' ){ $unit = $variant['unit']['name'];} else{ $unit = ''; } 
    ?>
    {!! Form::text('unit', $unit, ['id' => 'unit','class'=>'form-control typeahead unit','placeholder'=>'Type to search...']) !!}
    {!! Form::hidden('unit_id', null, ['id' => 'unit_id']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    <?php 
    $status = '';
    if(!empty($customer) && $customer['status'] != '' ){ $status = $customer['status'];} else{ $status = 1; } 
    ?>
    {!! Form::select('status', ['' =>'Select Status',0 =>'In Active', 1 => 'Active'], $status, ['class' => 'form-control']) !!}
</div>
@push('jsscript')
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.jquery.min.js"></script>
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
                    $('#variant_image').val(response.file);
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
    $(document).ready(function(){
        $('.item').typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        }, {
            name: 'items',
            display: 'name', // Adjust based on your data structure
            source: function(query, sync, async) {
                $.ajax({
                    url: '{{ route("items.search") }}',
                    method: 'GET',
                    data: { query: query },
                    success: function(data) {
                        async(data);
                    },
                    error: function(error) {
                        console.error('Error fetching data', error);
                    }
                });
            },
            templates: {
                suggestion: function(data) {
                    return '<div>' + data.name + '</div>';
                }
            }
        }).on('typeahead:select', function(e, data) {
            $('#item_id').val(data.id);
        });


        $('.unit').typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        }, {
            name: 'units',
            display: 'name', // Adjust based on your data structure
            source: function(query, sync, async) {
                $.ajax({
                    url: '{{ route("units.search") }}',
                    method: 'GET',
                    data: { query: query },
                    success: function(data) {
                        async(data);
                    },
                    error: function(error) {
                        console.error('Error fetching data', error);
                    }
                });
            },
            templates: {
                suggestion: function(data) {
                    return '<div>' + data.name + '</div>';
                }
            }
        }).on('typeahead:select', function(e, data) {
            $('#unit_id').val(data.id);
        });

    });
</script>

@endpush
