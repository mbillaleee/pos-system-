@extends('admin')

@section('content')
<div class="layout-px-spacing">
    <div class="middle-content container-xxl p-0">
        <!-- BREADCRUMB -->
        <div class="page-meta row">
            <nav class="breadcrumb-style-one float-start" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page"> Purchases </li>
                </ol>
            </nav>
            <div class="mt-3">
                <a class="btn btn-primary btn-md float-end" href="{{ route('purchase.create') }}"> Add Purchase</a>
            </div>
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
                            <div class="supplier-filter filterReference col-md-3">
                                <label for="referenceFilter">Search by Reference Number</label>
                                <input type="text" class="form-control" id="referenceFilter" placeholder="Reference No">
                            </div>
                            <div class="supplier-filter col-md-5">
                            <label for="supplierFilter">Search by Date</label>
                            <div id="daterange" class="pull-left reportrange">
                                <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                                <input type="text" id="dateFilter"> <b class="caret"></b>
                            </div>
                            </div>
                        </div>
                        <table id="customers_datatable" class="table table-striped dt-table-hover mt-5" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">Supplier</th>
                                    <th scope="col">Reference Number</th>
                                    <th scope="col">Purchase Date</th>
                                    <th scope="col">Payment Method</th>
                                    <th scope="col">Total Amount</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                        </table>
                   
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
            url: "{{ route('purchase.index') }}",
            data: function (d) {
                d.supplier_id = $('#supplierFilter').val();
                d.reference_num = $('#referenceFilter').val();
                d.purchase_date = $('#dateFilter').val();
                console.log(d.purchase_date);
                // d.payment_method = $('input[name=payment_method]').val();
                // console.log(d.payment_method);
            }
        },
        columns: [
            {data: 'supplier_id', name: 'supplier_id'},
            {data: 'reference_num', name: 'reference_num'},
            {data: 'purchase_date', name: 'purchase_date'},
            {data: 'payment_method', name: 'payment_method', orderable: true, searchable: true},
            {data: 'sub_total', name: 'sub_total'},
            {
                data: 'action', 
                name: 'action', orderable: true, searchable: true
            },
        ],

        columnDefs: [
            {
                render: function(data, type, full, meta) {
                    if(data==9){
                    return "<span class='badge bg-success'>Cash</span>";
                    }else{
                        return "<span class='badge bg-primary'>Bank</span>";
                    }
                    },
                targets: 3
            } 
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
    //   $("#dateFilter").change(function () {
        
    //   });

    //   $('#approved').change(function(){
    //     table.draw();
    // });

    });

</script>
   
<!-- <script>
    // $(function () {
$('.supplier_id').on('change',function(){

        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
      
      var table = $('#customers_datatable').DataTable({
                processing: true,
                serverSide: true,
                retrieve: true,
                paging: false,
          ajax: {
            url: "{{ route('purchase.index') }}",
            data: function (d) {
                  d.supplier_id = $('#supplier_id').val();
                  d.reference_num = $('#reference_num').val();
                  d.purchase_date = $('#purchase_date').val();
                  d.payment_method = $('#payment_method').val();
                  alert(d.reference_num);
                //   d.search = $('input[type="search"]').val()
              }
          },
          columns: [
            {data: 'supplier_id', name: 'supplier_id'},
            {data: 'reference_num', name: 'reference_num'},
            {data: 'purchase_date', name: 'purchase_date'},
            {data: 'payment_method', name: 'payment_method', orderable: true, searchable: true},
          ]
      });
    });

    
        // var supplier_id = $('.supplier_id').val();
        // var reference_num = $('.reference_num').val();
        // var purchase_date = $('.purchase_date').val();
        // var payment_method = $('.payment_method').val();
        // alert(purchase_date);
        // table.draw();
    // });
</script> -->

<!-- <script>
    var oTable = $('#customers_datatable').DataTable({
        dom: "<'row'<'col-xs-12'<'col-xs-6'l><'col-xs-6'p>>r>"+
            "<'row'<'col-xs-12't>>"+
            "<'row'<'col-xs-12'<'col-xs-6'i><'col-xs-6'p>>>",
            processing: true,
                serverSide: true,
                retrieve: true,
                paging: false,
                searching: true
        ajax: {
            url: '{{ url("collection/custom-filter-data")  }}',
            data: function (d) {
                d.supplier_id = $('input[name=supplier_id]').val();
                d.reference_num = $('input[name=reference_num]').val();
                // d.purchase_date = $('input[name=purchase_date]').val();
                d.payment_method = $('input[name=payment_method]').val();
                console.log(d.payment_method);
            }
        },
        columns: [
            {data: 'supplier_id', name: 'supplier_id'},
            {data: 'reference_num', name: 'reference_num'},
            {data: 'purchase_date', name: 'purchase_date'},
            {data: 'payment_method', name: 'payment_method'}
        ]
    });

    $('#search-form').on('change', function(e) {
        oTable.draw();
        e.preventDefault();
    });
</script> -->

@endpush