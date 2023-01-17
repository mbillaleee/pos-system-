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

    $('#customers_datatable').DataTable({

        // responsive: true,

        processing: true,

        serverSide: true,

        "ajax": "table",

        "autoWidth": false,

        lengthMenu: [

            [25, 50, 100, 200, -1],

            [25, 50, 100, 200, "All"]

        ],



        ajax: "{{ route('purchase.index') }}", 

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
                    return "<span class='badge bg-warning text-dark'>Cash</span>";
                    }else{
                        return "<span class='badge bg-primary'>Cheque</span>";
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
        

        

    });

  


});





</script>

@endpush