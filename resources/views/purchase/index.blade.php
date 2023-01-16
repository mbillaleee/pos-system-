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
                <div class="widget-content widget-content-area br-8 table-responsive">
                    <form class="row g-3 mb-5" id="search-form" action="" method="">
                        <h4>Filter:</h4>

                        <div class="col-md-3">
                            <label for="name" class="form-label">Supplier <span class="text-danger">*</span></label>
                            <input type="text" class="form-control supplier_id" id="supplier_id" name="supplier_id">
                        </div>

                        <div class="col-md-3">
                            <label for="weight" class="form-label">Reference Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control reference_num" id="reference_num" name="reference_num">
                        </div>

                        <!-- <div class="col-md-3">
                            <label for="city" class="form-label">Purchase Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control purchase_date" id="purchase_date" name="purchase_date">
                        </div> -->

                        <div class="col-md-3">
                            <label for="zip_code" class="form-label">Payment Method <span class="text-danger">*</span></label>
                            <input type="text" class="form-control payment_method" id="payment_method" name="payment_method">
                        </div>

                    </form>
                    <table id="customers_datatable" class="table table-striped dt-table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>Supplier</th>
                                <th>Reference Number</th>
                                <th>Purchase Date</th>
                                <th>Payment Method</th>
                                <th>Total Amount</th>
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
        // responsive: true,
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
            {data: 'payment_method', name: 'payment_method', orderable: true, searchable: true},
            {data: 'sub_total', name: 'sub_total'},
        ],

        columnDefs: [
            {
                render: function(data, type, full, meta) {
                    if(data==1){
                    return "<span class='badge bg-warning'>Cash</span>";
                    }else{
                        return "<span class='badge bg-primary'>Bank</span>";
                    }
                    },
                targets: 3
            } 
        ],

        order: [
            [0, 'desc']
        ],
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
    })
    $('#search-form').on('change', function(e) {
        alert();
        table
        .search( this.value )
        .draw();
        e.preventDefault();
    });
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