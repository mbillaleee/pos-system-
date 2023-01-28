@extends('admin')

@section('content')
<div class="layout-px-spacing">

<div class="middle-content container-xxl p-0">
    
    <!-- BREADCRUMB -->
    <div class="page-meta row">
        <nav class="breadcrumb-style-one float-start" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Shopify</a></li>
                <li class="breadcrumb-item active" aria-current="page">Sales</li>
            </ol>
        </nav>
        <div class="mt-3">
        <!-- <a class="btn btn-primary float-end" href="{{ route('users.create') }}"> Create New User</a> -->
        @if($shopify_api)
        <a class="btn btn-primary float-start" id="syncBtn" href="{{ route('shopify.sales.sync') }}">Sales Sync</a>
        @endif
        <div class="float-end">
        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#shopifySaleImportModal">Import New Data</button>
        </div>
        
        </div>
        
    </div>

    <div class="row layout-top-spacing">
    
        <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
            <div class="widget-content widget-content-area br-8 table-responsive">
                <table id="shopify-sales" class="table table-striped dt-table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th class="nowrapclasss">Order Date</th>
                            <th class="nowrapclasss">Customer Name</th>
                            <th class="nowrapclasss">Total Amount</th>
                            <th class="nowrapclasss">Sales Status</th>
                            <th class="nowrapclasss">Payment Method</th>
                            <th class="nowrapclasss">Collect No</th>
                            <th class="nowrapclasss">Waybill No</th>
                            <th class="nowrapclasss">Booking Status</th>
                        </tr>
                    </thead>
                    
                   
                </table>
                
            </div>
        </div>

    </div>

</div>

</div>
@include('takealot.sales_import_modal')
@endsection

@push('js')
<script>
$(document).ready(function () {
    $("#syncBtn").click(function () {
            $("#syncBtn").text(($("#syncBtn").text() == 'Sales Sync') ? 'Please Wait...' : 'Sales Sync');
    })
});
$(document).ready( function () {
$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});
$('#shopify-sales').DataTable({
// responsive: true,
processing: true,
serverSide: true,
"ajax": "table",
"autoWidth": false,
lengthMenu: [
        [25, 50, 100, 200, -1],
        [25, 50, 100, 200, "All"]
    ],
    
ajax: "{{ route('shopify.sales') }}",
columns: [
    { data: 'sales_date', name: 'sales_date' },
    { data: 'cust_firstname',
        render: function ( data, type, row ) {
            return row.cust_firstname + ' ' + row.cust_lastname;
        }
    },
    { data: 'total_amount', name: 'total_amount' },
    { data: 'sales_status', name: 'sales_status' },
    { data: 'payment_method', name: 'payment_method' },
    { data: 'collectno', name: 'collectno' },
    { data: 'waybillno', name: 'waybillno' },
    { data: 'booking_status', name: 'booking_status' },
        		    
        		],
                columnDefs: [
                {
                    render: function (data, type, full, meta) {
                        return "<div class='text-wrap width-100'>" + data + "</div>";
                    },
                    targets: 0
                },
                {
                    render: function (data, type, full, meta) {
                        return "<div class='text-wrap width-80'>" + data + "</div>";
                    },
                    targets: 4
                }
             ],

order: [[0, 'desc']],
dom: 'Bfrtip',
buttons: [
    'pageLength',
{
                extend:'csvHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                },
            },
            {
           extend: 'pdf',
            exportOptions: {
                columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
            }
           
          
       },
            // 'csvHtml5',
            // 'pageLength'

        ],
});
});

function editFunc(id){
    $.ajax({
        type:"POST",
        url: "{{ route('shopify.edit') }}",
        data: { id: id },
        dataType: 'json',
        success: function(res){
            $('#takealotModalLabel').html(res.product_name);
            $('#takealotModal').modal('show');
            $('#id').val(res.id);
            $('#selling_price').val(res.selling_price);
            $('#rrp').val(res.rrp);
            $('#quantity').val(res.quantity);
            $('#sku').val(res.sku);
        }
    });
} 


$('#takealotForm').submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);

    $.ajax({
        type:'POST',
        url: "{{ route('takealot.update')}}",
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
        success: (data) => {
        $("#takealotModal").modal('hide');
        var oTable = $('#takealot-products').dataTable();
        oTable.fnDraw(false);
        $("#btn-save").html('Submit');
        $("#btn-save"). attr("disabled", false);
        },
        error: function(data){
        console.log(data);
        },
    });
});

</script>
@endpush