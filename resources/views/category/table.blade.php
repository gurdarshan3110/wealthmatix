<div class="table-responsive">
    <table class="table table-bordered table-striped fs-3 align-middle" id="record-table">
        <thead>
        <tr>
            <th width="10%">Logo</th>
            <th>Name</th>
            <th>Status</th>
            <th  style="width:15%;">Action</th>
        </tr>
        </thead>
        <tbody>
        
        </tbody>
    </table>
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
                ajax: "/category/list",
                columns: [
                    {data: 'logo', name: 'logo'},
                    {data: 'name', name: 'name'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action',className:'action'},
                    
                ],
                pageLength:10,
                //dom: 'Blfrtip',
                responsive: true,
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                "scrollX": true,  // enables horizontal scrolling
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
                    //$('.dt-buttons button').addClass('fs-7 active-menu-item text-light border-0');
                    //$('.dt-buttons').addClass('mb-2 d-none');
                    //$('.dt-button').addClass('btn-primary d-none');
                    $('.paginate_button').addClass('fs-7');
                    $('.paginate_button.current').addClass('fs-7 active-menu-item');
                    $('.paginate_button.active-menu-item').removeClass('current');
                    
                }
            });
            $('#filter').click(function(){
                var min=$('#min').val();
                var max=$('#max').val();
                table.ajax.url( '/category/list?min='+min+'&max='+max ).load();
            });
    </script>
@endpush
