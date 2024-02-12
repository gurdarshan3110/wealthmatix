<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('parent', 'Parent Category:') !!}
    <?php 
    $parent = '';
    if(!empty($category) && $category['parent'] != '' ){ $parent = $category['parent'];}  
    ?>
    {!! Form::select('parent', $categoryOptions, $parent, ['class' => 'form-control']) !!}

</div>


<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    <?php 
    $status = '';
    if(!empty($category) && $category['status'] != '' ){ $status = $category['status'];} else{ $status = 1; } 
    ?>
    {!! Form::select('status', ['' =>'Select Status',0 =>'In Active', 1 => 'Active'], $status, ['class' => 'form-control']) !!}
</div>
