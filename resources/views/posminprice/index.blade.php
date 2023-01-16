@extends('admin')



@section('content')

<div class="layout-px-spacing">



<div class="middle-content container-xxl p-0">

    

    <!-- BREADCRUMB -->

    <div class="page-meta row">

        <nav class="breadcrumb-style-one float-start" aria-label="breadcrumb">

            <ol class="breadcrumb">

                <li class="breadcrumb-item"><a href="#">Home</a></li>

                <li class="breadcrumb-item active" aria-current="page">POS Minimum Price</li>

            </ol>

        </nav>

        <div class="mt-3">

        <a class="btn btn-primary float-end" href="{{ route('posminprice.sync') }}"> Sync </a>

        </div>

        

    </div>



    <div class="row layout-top-spacing">

    

        <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">

            <div class="widget-content widget-content-area br-8 table-responsive">

                <table id="posminprice-products" class="table table-striped dt-table-hover" style="width:100%">

                    <thead>

                        <tr>

                            <th style="width:150px!important;">Product Name</th>
                            <th>TSIN</th>
                            <th>Cost Price</th>

                            <th>Minimum Sale Price</th>

                            <th>Rack No</th>

                            <th>SKU</th>

                        </tr>

                    </thead>

                    

                   

                </table>

                

            </div>

        </div>



    </div>



</div>



</div>

@include('posminprice.minprice_modal')

@endsection



@push('js')

<script>

$(document).ready( function () {

$.ajaxSetup({

headers: {

'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

}

});

$('#posminprice-products').DataTable({

// responsive: true,

processing: true,

serverSide: true,

"ajax": "table",

"autoWidth": false,

lengthMenu: [

        [25, 50, 100, 200, -1],

        [25, 50, 100, 200, "All"]

    ],



ajax: "{{ route('posminprice') }}",

columns: [

{ data: 'product_name', name: 'product_name' },

{ data: 'tsin', name: 'tsin' },

{ data: 'product_price', name: 'product_price' },

{ data: 'product_min_price', name: 'product_min_price' },

{ data: 'rack_no', name: 'rack_no' },

{ data: 'sku', name: 'sku' },

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

        url: "{{ route('posminprice.edit') }}",

        data: { id: id },

        dataType: 'json',

        success: function(res){

            $('#posminpriceModalLabel').html(res.product_name);

            $('#posminpriceModal').modal('show');

            $('#id').val(res.id);

            $('#tsin').val(res.tsin);

        }

    });

} 





$('#posminpriceForm').submit(function(e) {

    e.preventDefault();

    var formData = new FormData(this);



    $.ajax({

        type:'POST',

        url: "{{ route('posminprice.update')}}",

        data: formData,

        cache:false,

        contentType: false,

        processData: false,

        success: (data) => {

        $("#posminpriceModal").modal('hide');

        var oTable = $('#posminprice-products').dataTable();

        oTable.fnDraw(false);

        $("#posminprice-btn-save").html('Submit');

        $("#posminprice-btn-save"). attr("disabled", false);

        toastr.options =

            {

                "closeButton" : true,

                "progressBar" : true

            }

        toastr.success("Pos Minimum Price Updated Successfully!");

        },

        error: function(data){

        console.log(data);

        },

    });

});



</script>

@endpush