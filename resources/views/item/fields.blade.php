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
        if(!empty($item) && $item->item_image != '' ){ 
            $src = $item->media;
            $srcId = $item->item_image;
        } 
        ?>
        {!! Form::hidden('item_image', $srcId, ['class' => 'form-control', 'id' => 'item_image']) !!}
        <img src="{{$src}}" alt="Preview" class="img-thumbnail" id="avatar-preview" style="display: {{(($src!='')?'block':'none')}}; max-width: 200px; max-height: 200px;">
    </div>
</div>
<!-- Name Field -->
<div class="form-group col-sm-6"></div>
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('size', 'HSN Code:') !!}
    {!! Form::text('hsn_code', null, ['class' => 'form-control']) !!}
</div>

<!-- Category Field -->
<div class="form-group col-sm-6">
    {!! Form::label('category', 'Category:') !!}
    <input type="text" name="category" id="category" class="form-control typeahead category" placeholder="Type to search...">
    {!! Form::hidden('category_id', null, ['id' => 'category_id']) !!}
</div>

<!-- Tax Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tax', 'Tax:') !!}
    <input type="text" name="tax" id="tax" class="form-control typeahead tax" placeholder="Type to search...">
    {!! Form::hidden('tax_id', null, ['id' => 'tax_id']) !!}
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
                    $('#item_image').val(response.file);
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
        $('.category').typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        }, {
            name: 'categories',
            display: 'name', // Adjust based on your data structure
            source: function(query, sync, async) {
                $.ajax({
                    url: '{{ route("categories.search") }}',
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
            $('#category_id').val(data.id);
        });

        $('.tax').typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        }, {
            name: 'taxes',
            display: 'name', // Adjust based on your data structure
            source: function(query, sync, async) {
                $.ajax({
                    url: '{{ route("taxes.search") }}',
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
            $('#tax_id').val(data.id);
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

        $('.store').typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        }, {
            name: 'stores',
            display: 'name', // Adjust based on your data structure
            source: function(query, sync, async) {
                $.ajax({
                    url: '{{ route("stores.search") }}',
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
            $('#store_id').val(data.id);
        });

        // var taxes = new Bloodhound({
        //     datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
        //     queryTokenizer: Bloodhound.tokenizers.whitespace,
        //     remote: {
        //         url: '{{ route("taxes.search") }}?query=%QUERY',
        //         wildcard: '%QUERY'
        //     }
        // });

        // $('#tax').typeahead({
        //     hint: true,
        //     highlight: true,
        //     minLength: 1
        // }, {
        //     name: 'taxes',
        //     display: 'name',
        //     source: taxes,
        //     templates: {
        //         suggestion: function(tax) {
        //             return '<div>' + tax.name + '</div>';
        //         }
        //     }
        // }).on('typeahead:select', function(e, tax) {
        //     $('#tax_id').val(tax.id);
        // });

        // // Unit Typeahead
        // var units = new Bloodhound({
        //     datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
        //     queryTokenizer: Bloodhound.tokenizers.whitespace,
        //     remote: {
        //         url: '{{ route("units.search") }}?query=%QUERY',
        //         wildcard: '%QUERY'
        //     }
        // });

        // $('#unit').typeahead({
        //     hint: true,
        //     highlight: true,
        //     minLength: 1
        // }, {
        //     name: 'units',
        //     display: 'name',
        //     source: units,
        //     templates: {
        //         suggestion: function(unit) {
        //             return '<div>' + unit.name + '</div>';
        //         }
        //     }
        // }).on('typeahead:select', function(e, unit) {
        //     $('#unit_id').val(unit.id);
        // });

        // // Store Typeahead
        // var stores = new Bloodhound({
        //     datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
        //     queryTokenizer: Bloodhound.tokenizers.whitespace,
        //     remote: {
        //         url: '{{ route("stores.search") }}?query=%QUERY',
        //         wildcard: '%QUERY'
        //     }
        // });

        // $('#store').typeahead({
        //     hint: true,
        //     highlight: true,
        //     minLength: 1
        // }, {
        //     name: 'stores',
        //     display: 'name',
        //     source: stores,
        //     templates: {
        //         suggestion: function(store) {
        //             return '<div>' + store.name + '</div>';
        //         }
        //     }
        // }).on('typeahead:select', function(e, store) {
        //     $('#store_id').val(store.id);
        // });
    });
</script>

@endpush
