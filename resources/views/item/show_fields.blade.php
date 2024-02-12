<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    <p>{{$customer->name}}</p>
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Email:') !!}
    <p>{{$customer->email}}</p>
</div>

<!-- Phone No Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Phone No:') !!}
    <p>{{$customer->phone_no}}</p>
</div>

<!-- Street Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Street:') !!}
    <p>{{$customer->address}}</p>
</div>

<!-- Suburb Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Suburb:') !!}
    <p>{{$customer->suburb}}</p>
</div>

<!-- State Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'State:') !!}
    <p>{{$customer->state}}</p>
</div>

<!-- Postcode Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Postcode:') !!}
    <p>{{$customer->postcode}}</p>
</div>

<!-- ABN Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'ABN:') !!}
    <p>{{$customer->abn}}</p>
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    <?php 
    $status = 'Active';
    if(!empty($customer) && $customer['status'] == '0' ){ $status = 'In Active';} 
    ?>
    <p>{{$status}}</p>
</div>
</div>
</div>
</div>
</div>
<div class="col-xxl-12">
    <div class="card card-flush">
                            
        <!--begin::Card body-->
        <div class="card-body">
            <div class="row">
                <div class="form-group col-sm-12">
                    {!! Form::label('Trips', 'Associated Trips:') !!}
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="record-table">
                            <thead>
                                <th>Job</th>
                                <th>Pickup</th>
                                <th>Drop Off</th>
                                <th>Trip Start</th>
                                <th>Trip End</th>
                                <th>Status</th>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
@push('jsscript')
    <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
    <script type="text/javascript">
        var minDate, maxDate;
        
        var table=$('#record-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "/customer-trips/list?id={{$customer->id}}",
                columns: [
                    {data: 'job', name: 'job'},
                    {data: 'pickup', name: 'pickup'},
                    {data: 'dropoff', name: 'dropoff'},
                    {data: 'start_time', name: 'start_time'},
                    {data: 'end_time', name: 'end_time'},
                    {data: 'status', name: 'status'}
                    
                ],
                order: [],
                pageLength:10,
                dom: 'Blfrtip',
                responsive: true,
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                "scrollX": true,  // enables horizontal scrolling
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5',
                ],
                "language": {
                        "search": '',
                        "searchPlaceholder": "Search {{$title}}",
                        "paginate": {
                        "previous": '<i class="fa fa-angle-left"></i>',
                            "next": '<i class="fa fa-angle-right"></i>'
                    }
                },
                "drawCallback": function () {
                    $('.dataTables_filter input').addClass('form-control form-control-solid w-250px');
                    $('.dt-buttons button').addClass('fs-7 active-menu-item text-light border-0');
                    $('.dt-buttons').addClass('mb-2');
                    $('.dt-button').addClass('btn-primary');
                    $('.paginate_button').addClass('fs-7');
                    $('.paginate_button.current').addClass('fs-7 active-menu-item');
                    $('.paginate_button.active-menu-item').removeClass('current');
                    
                }
            });
            $('#filter').click(function(){
                var min=$('#min').val();
                var max=$('#max').val();
                table.ajax.url( '/vehicle/list?min='+min+'&max='+max ).load();
            });
    </script>
@endpush