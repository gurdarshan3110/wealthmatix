<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('category', 'Category:') !!}
    {!! Form::text('category', $subcategory->category->name ?? null, ['id' => 'category','class'=>'form-control typeahead category','placeholder'=>'Type to search...']) !!}
    {!! Form::hidden('category_id', $subcategory->category->id ?? null, ['id' => 'category_id']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    <?php 
    $status = '';
    if(!empty($subcategory) && $subcategory['status'] != '' ){ $status = $subcategory['status'];} else{ $status = 1; } 
    ?>
    {!! Form::select('status', ['' =>'Select Status',0 =>'In Active', 1 => 'Active'], $status, ['class' => 'form-control']) !!}
</div>

@push('jsscript')
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.jquery.min.js"></script>
<script type="text/javascript">
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
    });
    </script>

@endpush

