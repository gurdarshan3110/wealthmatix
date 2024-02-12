<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('mrn_date', 'Mrn Date:') !!}
    {!! Form::date('mrn_date', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('batch_no', 'Batch No:') !!}
    {!! Form::text('batch_no', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('supplier', 'Supplier:') !!}
    <input type="text" name="supplier" id="supplier" class="form-control typeahead supplier" placeholder="Type to search...">
    {!! Form::hidden('supplier_id', null, ['id' => 'supplier_id']) !!}
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
<div class="col-12 col-sm-12 mt-2">
    <div class="table-responsive">
        <table class="table" id="items-table">
            <!-- Table header -->
            <thead>
                <tr>
                    <th width="20%">Item</th>
                    <th width="12%">Manufacturing</th>
                    <th width="12%">Expiry</th>
                    <th width="8%">MRP</th>
                    <th width="8%">Unit Price</th>
                    <th width="8%">Sale Price</th>
                    <th width="8%">Quantity</th>
                    <th width="5%">Amount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <!-- Table body -->
            <tbody>
                <tr>
                    <th width="20%" id="typeahead-column">
                        {!! Form::text('variant[]', null, ['class' => 'form-control variant', 'data-variant-id' => 'variant_id_1', 'placeholder' => 'Type to search...']) !!}
                        {!! Form::hidden('variant_id[]', null, ['class' => 'form-control variant_id','id'=>'variant_id_1']) !!}
                    </th>
                    <th width="12%">
                        {!! Form::date('manufacture_date[]', null, ['class' => 'form-control manufacture_date']) !!}
                    </th>
                    <th width="12%">
                        {!! Form::date('expiry_date[]', null, ['class' => 'form-control expiry_date']) !!}
                    </th>
                    <th width="9%">
                        {!! Form::text('mrp[]', null, ['class' => 'form-control mrp']) !!}
                    </th>
                    <th width="9%">
                        {!! Form::text('unit_price[]', null, ['class' => 'form-control unit_price']) !!}
                    </th>
                    <th width="9%">
                        {!! Form::text('sale_price[]', null, ['class' => 'form-control sale_price']) !!}
                    </th>
                    <th width="9%">
                        {!! Form::text('quantity[]', null, ['class' => 'form-control quantity']) !!}
                    </th>
                    <th width="5%" class="amount">0.00</th>
                    <th>
                        <a href="javascript:void(0);" class="add-row"><img src="{{ asset('/assets/images/plus.png') }}" class="icon" /></a>
                        <a href="javascript:void(0);" class="remove-row d-none"><img src="{{ asset('/assets/images/minus.png') }}" class="icon" /></a>
                    </th>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@push('jsscript')
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        // Function to calculate the amount based on unit price and quantity
        $('.supplier').typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        }, {
            name: 'suppliers',
            display: 'name', // Adjust based on your data structure
            source: function(query, sync, async) {
                $.ajax({
                    url: '{{ route("suppliers.search") }}',
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
            $('#supplier_id').val(data.id);
        });
        function calculateAmount(row) {
            var unitPrice = parseFloat(row.find('.unit_price').val()) || 0;
            var quantity = parseFloat(row.find('.quantity').val()) || 0;
            var amount = unitPrice * quantity;
            row.find('.amount').text(amount.toFixed(2));
        }

        // Add new row
        $(document).on('click', '.add-row', function() {
            $('.remove-row.d-none').removeClass('d-none');
            var newRow = $('#items-table tbody tr:first').clone();
            $('.add-row').addClass('d-none');
            newRow.find('input, select').val('');
            newRow.find('.amount').text('0.00');
            newRow.find('.add-row').removeClass('d-none');

            // Assign a unique data-variant-id attribute to the typeahead input
            $
            var newVariantId = 'variant_id_' + new Date().getTime();
            newRow.find('#typeahead-column').html('');
            var input = document.createElement('input');
            input.type = 'text';
            input.name = 'variant[]';
            input.className='form-control variant';
            input.placeholder = 'Type to search...';
            input.setAttribute('data-variant-id', newVariantId);
            var inputHidden = document.createElement('input');
            inputHidden.type = 'hidden';
            inputHidden.setAttribute('id', newVariantId);
            inputHidden.className='variant_id';
            inputHidden.name='variant_id[]';
            // Destroy Typeahead on cloned input elements
            newRow.find('#typeahead-column').append(input);
            newRow.find('#typeahead-column').append(inputHidden);

            newRow.appendTo('#items-table tbody');

            // Reinitialize the typeahead only for the new row
            initializeTypeahead(newVariantId);
        });

        // Remove row
        $(document).on('click', '.remove-row', function() {
            var rowCount = $('#items-table tbody tr').length;
            if (rowCount > 1) {
                $(this).closest('tr').remove();
            }
            if(rowCount == 2){
                $('.remove-row').addClass('d-none');
            }
            $('#items-table tbody tr:last').find('.add-row').removeClass('d-none');
        });

        // Update amount on unit price or quantity change
        $(document).on('input', '.unit_price, .quantity', function() {
            var row = $(this).closest('tr');
            calculateAmount(row);
        });

        // Your existing typeahead code...

    });
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
    initializeTypeahead('variant_id_1');

    // Your existing typeahead code...
    function initializeTypeahead(variantId) {
        
        $('.variant[data-variant-id="' + variantId + '"]').typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        }, {
            name: 'variants_' + variantId,
            display: 'name', // Adjust based on your data structure
            source: function(query, sync, async) {
                $.ajax({
                    url: '{{ route("variants.search") }}',
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
            $('#' + variantId).val(data.id);
        });
        
    }
</script>

@endpush
