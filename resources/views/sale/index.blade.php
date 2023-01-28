@extends('admin')

@section('content')
<div class="layout-px-spacing">
    <div class="middle-content container-xxl p-0">
        <!-- BREADCRUMB -->
        <div class="page-meta row">
            <nav class="breadcrumb-style-one float-start" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page"> Sales </li>
                </ol>
            </nav>
            <div class="mt-3">
                <a class="btn btn-primary btn-md float-end" href="{{ route('sale.create') }}">Add Sale</a>
            </div>
        </div>
        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
            <div class="row mb-3">
                            <div class="customer-filter col-md-4">
                                <label for="customerFilter">Search by Customer</label>
                                <select id="customerFilter" class="form-control">
                                    <option value="">Show All</option>
                                    @foreach($customers as $cus)
                                    <option value="{{$cus->id}}">{{$cus->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="customer-filter filterReference col-md-3">
                                <label for="referenceFilter">Search by Reference Number</label>
                                <input type="text" class="form-control" id="referenceFilter" placeholder="Reference No">
                            </div>
                            <div class="customer-filter col-md-5">
                            <label for="customerFilter">Search by Date</label>
                            <div id="daterange" class="pull-left reportrange">
                                <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                                <input type="text" id="dateFilter"> <b class="caret"></b>
                            </div>
                            </div>
                        </div>
                <div class="widget-content widget-content-area br-8 table-responsive">
                    <table id="sale_datatable" class="table table-striped dt-table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>Customer</th>
                                <th>Reference Number</th>
                                <th>Sale Date</th>
                                <th>Payment Method</th>
                                <th>Total Amount</th>
                                <th>Action</th>
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

 var oTable =  $('#sale_datatable').DataTable({
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
          url: "{{ route('sale.index') }}",
          data: function (d) {
              d.customer_id = $('#customerFilter').val();
              d.reference_num = $('#referenceFilter').val();
              d.sale_date = $('#dateFilter').val();
              console.log(d.sale_date);
              // d.payment_method = $('input[name=payment_method]').val();
              // console.log(d.payment_method);
          }
      },
      columns: [
            {data: 'customer_id', name: 'customer_id'},
            {data: 'reference_num', name: 'reference_num'},
            {data: 'sale_date', name: 'sale_date'},
            {data: 'payment_method', name: 'payment_method'},
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
                  columns: [0, 1, 2, 3, 4]
              }
          },
          // 'csvHtml5',
          // 'pageLength'
      ],
  });

    $("#customerFilter").change(function () {
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