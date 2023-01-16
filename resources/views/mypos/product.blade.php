@extends('admin')

@section('content')
<div class="layout-px-spacing">

<div class="middle-content container-xxl p-0">
    
    <!-- BREADCRUMB -->
    <div class="page-meta row">
        <nav class="breadcrumb-style-one float-start" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">My Pos</a></li>
                <li class="breadcrumb-item active" aria-current="page">Products</li>
            </ol>
        </nav>
        <div class="mt-3">
        <!-- <a class="btn btn-primary float-end" href="{{ route('users.create') }}"> Create New User</a> -->
        @if($mypos_api)
        <a class="btn btn-primary float-start" id="syncBtn" href="{{ route('mypos.sync') }}">Product Sync</a>
        @endif
        
        <div class="float-end">
        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#myposApiModal">API Import</button>
        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#myposImportModal">Import New Data</button>
        </div>
        </div>
        
    </div>

    <div class="row layout-top-spacing">
    
        <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
            <div class="widget-content widget-content-area br-8 table-responsive">
                <table id="mypos-products" class="table table-striped dt-table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th style="width:150px!important;">Product Name</th>
                            <th>Barcode</th>
                            <th>Cost Price</th>
                            <th>Selling Price</th>
                            <th>Qty</th>
                            <th>Price Group</th>
                            <th>Rack No.</th>
                            <th>TSIN</th>
                            <th width="150px">Action</th>
                        </tr>
                    </thead>
                    
                   
                </table>
                
            </div>
        </div>

    </div>

</div>

</div>
<!-- <style>
    
    .bootstrap-tagsinput .tag {
     margin-right: 2px;
     color: white;
     background: #1d2b36;
     padding: 3px;
}

</style> -->
@include('mypos.product_modal')
@include('mypos.import_modal')
@include('mypos.api_modal')
@endsection

@push('js')

<script>
$(document).ready(function () {
    $("#syncBtn").click(function () {
            $("#syncBtn").text(($("#syncBtn").text() == 'Product Sync') ? 'Please Wait...' : 'Product Sync');
    })
});
$(document).ready( function () {
$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});
$('#mypos-products').DataTable({
// responsive: true,
processing: true,
serverSide: true,
"ajax": "table",
"autoWidth": false,
lengthMenu: [
        [25, 50, 100, 200, -1],
        [25, 50, 100, 200, "All"]
    ],

ajax: "{{ route('mypos.product') }}",
columns: [
{ data: 'name', name: 'name' },
{ data: 'code', name: 'code' },
{ data: 'cost', name: 'cost' },
{ data: 'price', name: 'price' },
{ data: 'quantity', name: 'quantity' },
{ data: 'price_group_name', name: 'price_group_name' },
{ data: 'rack_no', name: 'rack_no' },
{ data: 'tsin', name: 'tsin' },
{data: 'action', name: 'action', orderable: true, 
                searchable: true},
],
columnDefs: [
                {
                    render: function (data, type, full, meta) {
                        return "<div class='text-wrap width-200'>" + data + "</div>";
                    },
                    targets: 0
                },
                {
        targets: 4,
        render: $.fn.dataTable.render.number(',', '.', 0, '')
    },
    {
        targets: 3,
        render: $.fn.dataTable.render.number(',', '.', 2, '')
    },
    {
        targets: 2,
        render: $.fn.dataTable.render.number(',', '.', 2, '')
    },
             ],
order: [[0, 'desc']],
dom: 'Bfrtip',
buttons: [
    'pageLength',
{
                extend:'csvHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5 ]
                },
            },
            {
           extend: 'pdf',
            exportOptions: {
                columns: [ 0, 1, 2, 3, 4, 5 ]
            }
           
          
       },
            // 'csvHtml5',
            

        ],
});
});

function editFunc(id){
    $.ajax({
        type:"POST",
        url: "{{ route('mypos.edit') }}",
        data: { id: id },
        dataType: 'json',
        success: function(res){
             console.log(res.tsin);
            $('#myposModalLabel').html(res.name);
            $('#myposModal').modal('show');
            $('#id').val(res.id);
            $('#rack_no').val(res.rack_no);
            $('#code').val(res.code);
            // tagInput1.addData(res.tsin);
            $('#tsin').val(res.tsin);
            $('#price').val(parseFloat(res.price).toFixed(2));
        }
    });
} 


$('#myposForm').submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        type:'POST',
        url: "{{ route('mypos.update')}}",
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
        success: (data) => {
        $("#myposModal").modal('hide');
        var oTable = $('#mypos-products').dataTable();
        oTable.fnDraw(false);
        $("#mypos-btn-save").html('Submit');
        $("#mypos-btn-save"). attr("disabled", false);
        toastr.options =
            {
                "closeButton" : true,
                "progressBar" : true
            }
        toastr.success("My Pos Product Updated Successfully!");
        },
        error: function(data){
        console.log(data);
        },
    });
});
</script>
@endpush