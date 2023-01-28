@extends('admin')

@section('content')
<div class="layout-px-spacing">
    <div class="middle-content container-xxl p-0">
        <!-- BREADCRUMB -->
        <div class="page-meta row">
            <nav class="breadcrumb-style-one float-start" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page"> Top Purchase </li>
                </ol>
            </nav>
        </div>
        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                        <div class="row mb-3">
                            <div class="supplier-filter col-md-4">
                                <label for="supplierFilter">Search by Supplier</label>
                                <select id="supplierFilter" class="form-control">
                                    <option value="">Show All</option>
                                    @foreach($suppliers as $sup)
                                    <option value="{{$sup->id}}">{{$sup->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="supplier-filter col-md-5">
                            <label for="supplierFilter">Search by Date</label>
                            <div id="daterange" class="pull-left reportrange">
                                <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                                <input type="text" id="dateFilter"> <b class="caret"></b>
                            </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area br-8 table-responsive">
                        <table id="customers_datatable" class="table table-striped dt-table-hover mt-5" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">Product</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total Amount</th>
                                </tr>
                            </thead>
                        </table>
</div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<script>
$(function() {

var start = moment().subtract(29, 'days');
var end = moment();

function cb(start, end) {
    $('#daterange input').val(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
}

$('#daterange').daterangepicker({
    startDate: start,
    endDate: end,
    ranges: {
       'Today': [moment(), moment()],
       'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
       'Last 7 Days': [moment().subtract(6, 'days'), moment()],
       'Last 30 Days': [moment().subtract(29, 'days'), moment()],
       'This Month': [moment().startOf('month'), moment().endOf('month')],
       'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    }
}, cb);

cb(start, end);

});

$(document).ready(function() {
  
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

   var oTable =  $('#customers_datatable').DataTable({
    dom: "<'row'<'col-xs-12'<'col-xs-6'l><'col-xs-6'p>>r>"+
            "<'row'<'col-xs-12't>>"+
            "<'row'<'col-xs-12'<'col-xs-6'i><'col-xs-6'p>>>",
        responsive: true,
        processing: true,
        serverSide: true,
        retrieve: true,
        paging: false,
        searching: true,
        "ajax": "table",
        "autoWidth": false,
        lengthMenu: [
            [25, 50, 100, 200, -1],
            [25, 50, 100, 200, "All"]
        ],

        // ajax: "{{ route('purchase.index') }}", 
        ajax: {
            url: "{{ route('toppurchase.report') }}",
            data: function (d) {
                 d.supplier_id = $('#supplierFilter').val();
                 d.purchase_date = $('#dateFilter').val();
                // console.log(d.purchase_date);
                // d.payment_method = $('input[name=payment_method]').val();
                // console.log(d.payment_method);
            }
        },
        columns: [
            {data: 'product_id', name: 'product_id'},
            {data: 'quantity', name: 'quantity'},
            {data: 'total_amount', name: 'total_amount'},
        ],

        // order: [
        //     [0, 'desc']
        // ],
        dom: 'Bfrtip',
        buttons: [
            'pageLength',

            // {

            //     extend: 'csvHtml5',

            //     exportOptions: {

            //         columns: [0, 1, 2, 3, 4, 5]

            //     },

            // },

            {
                extend: 'pdf',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5]
                }
            },
            // 'csvHtml5',
            // 'pageLength'
        ],
    });

      $("#supplierFilter").change(function () {
        oTable.draw();
      });
    $("#referenceFilter").on("keyup change", function(e) {
        oTable.draw();
    });

      $('#daterange').on('apply.daterangepicker', (e, picker) => {
        oTable.draw();
    });
 

    });

</script>


@endpush