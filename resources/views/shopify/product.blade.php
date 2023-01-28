@extends('admin')



@section('content')

<div class="layout-px-spacing">



<div class="middle-content container-xxl p-0">

    

    <!-- BREADCRUMB -->

    <div class="page-meta row">

        <nav class="breadcrumb-style-one float-start" aria-label="breadcrumb">

            <ol class="breadcrumb">

                <li class="breadcrumb-item"><a href="#">Shopify</a></li>

                <li class="breadcrumb-item active" aria-current="page">Products</li>

            </ol>

        </nav>

        <div class="mt-3">

        <!-- <a class="btn btn-primary float-end" href="{{ route('users.create') }}"> Create New User</a> -->

        @if($shopify_api)

        <a class="btn btn-primary float-start" id="syncBtn" href="{{ route('shopify.sync') }}">Product Sync</a>

        @endif

        <div class="float-end">

        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#shopifyApiModal">API Import</button>

        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#shopifyImportModal">Import New Data</button>

        </div>

        

        

        </div>

        

    </div>



    <div class="row layout-top-spacing">

    

        <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">

            <div class="widget-content widget-content-area br-8 table-responsive">

                <table id="shopify-products" class="table table-striped dt-table-hover" style="width:100%">

                    <thead>

                        <tr>

                            <th style="width:150px!important;">Product Name</th>

                            <th>Regular Price</th>

                            <th>Sale Price</th>

                            <th>Qty</th>

                            <th>SKU</th>

                            <th>Barcode</th>

                            <th width="150px">Action</th>

                        </tr>

                    </thead>

                    

                   

                </table>

                

            </div>

        </div>



    </div>



</div>



</div>

@include('shopify.product_modal')

@include('shopify.import_modal')

@include('shopify.api_modal')

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

$('#shopify-products').DataTable({

// responsive: true,

processing: true,

serverSide: true,

"ajax": "table",

"autoWidth": false,

lengthMenu: [

        [25, 50, 100, 200, -1],

        [25, 50, 100, 200, "All"]

    ],



ajax: "{{ route('shopify.product') }}",

columns: [

{ data: 'title', name: 'title',

    fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {

            if(oData.title) {

                $(nTd).html("<div class='text-wrap width-170'><a href="+oData.link+" target='new'>"+oData.title+"</a></div>");

            }

        }

     },

{ data: 'regular_price', name: 'regular_price' },

{ data: 'price', name: 'price' },

{ data: 'qty', name: 'qty' },

{ data: 'sku', name: 'sku' },

{ data: 'barcode', name: 'barcode' },

{data: 'action', name: 'action', orderable: true, 

                searchable: true},

],

columnDefs: [

                {

                    render: function (data, type, full, meta) {

                        return "<div class='text-wrap width-70'>" + data + "</div>";

                    },

                    targets: 6

                }

             ],

order: [[0, 'desc']],

dom: 'Bfrtip',

buttons: [

    'pageLength',

{

                extend:'csvHtml5',

                exportOptions: {

                    columns: [ 0, 1, 2, 3, 4, 5, 6 ]

                },

            },

            {

           extend: 'pdf',

            exportOptions: {

                columns: [ 0, 1, 2, 3, 4, 5, 6 ]

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

            $('#shopifyModalLabel').html(res.title);

            $('#shopifyModal').modal('show');

            $('#id').val(res.id);

            $('#regular_price').val(res.regular_price);

            $('#price').val(res.price);

            $('#qty').val(res.qty);

            $('#barcode').val(res.barcode);

        }

    });

} 





$('#shopifyForm').submit(function(e) { 

    e.preventDefault();

    var formData = new FormData(this);



    $.ajax({

        type:'POST',

        url: "{{ route('shopify.update')}}",

        data: formData,

        cache:false,

        contentType: false,

        processData: false,

        success: (data) => {

        $("#shopifyModal").modal('hide');

        var oTable = $('#shopify-products').dataTable();

        oTable.fnDraw(false);

        $("#btn-save").html('Submit');

        $("#btn-save"). attr("disabled", false);

        toastr.options =

            {

                "closeButton" : true,

                "progressBar" : true

            }

        toastr.success("Shopify Product Updated Successfully!");

        },

        error: function(data){

        console.log(data);

        },

    });

});







</script>

@endpush