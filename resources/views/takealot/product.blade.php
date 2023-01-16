@extends('admin')



@section('content')

<div class="layout-px-spacing">



<div class="middle-content container-xxl p-0">

    

    <!-- BREADCRUMB -->

    <div class="page-meta row">

        <nav class="breadcrumb-style-one float-start" aria-label="breadcrumb">

            <ol class="breadcrumb">

                <li class="breadcrumb-item"><a href="#">Takealot</a></li>

                <li class="breadcrumb-item active" aria-current="page">Products</li>

            </ol>

        </nav>

        <div class="mt-3">

        <!-- <a class="btn btn-primary float-end" href="{{ route('users.create') }}"> Create New User</a> -->

        @if($takealot_api)

        <a class="btn btn-primary float-start" id="syncBtn" href="{{ route('takealot.sync') }}">Product Sync</a>

        @endif

        <div class="float-end">

        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#takealotApiModal">API Import</button>

        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#takealotImportModal">Import New Data</button>

        </div>

        

        

        </div>

        

    </div>



    <div class="row layout-top-spacing">

    

        <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">

            <div class="widget-content widget-content-area br-8 table-responsive">

                <table id="takealot-products" class="table table-striped dt-table-hover" style="width:100%">

                    <thead>

                        <tr>

                            <th style="width:150px!important;">Name</th>

                            <th>Selling Price</th>

                            <th>RRP</th>

                            <th>Qty</th>

                            <th>SKU</th>

                            <th>TSIN</th>

                            <th>Status</th>

                            <th width="150px">Action</th>

                        </tr>

                    </thead>

                    

                   

                </table>

                

            </div>

        </div>



    </div>



</div>



</div>

@include('takealot.product_modal')

@include('takealot.import_modal')

@include('takealot.api_modal')

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

$('#takealot-products').DataTable({

// responsive: true,

processing: true,

serverSide: true,

"ajax": "table",

"autoWidth": false,

lengthMenu: [

        [25, 50, 100, 200, -1],

        [25, 50, 100, 200, "All"]

    ],



ajax: "{{ route('takealot.product') }}",

columns: [

{ data: 'title', name: 'title',

    fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {

            if(oData.title) {

                $(nTd).html("<div class='text-wrap width-170'><a href="+oData.takealot_url+" target='new'>"+oData.title+"</a></div>");

            }

        }

     },

{ data: 'selling_price', name: 'selling_price' },

{ data: 'rrp', name: 'rrp' },

{ data: 'quantity', name: 'quantity' },

{ data: 'sku', name: 'sku' },

{ data: 'tsin', name: 'tsin' },

{ data: 'status', name: 'status' },

{data: 'action', name: 'action', orderable: true, searchable: true},

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

        url: "{{ route('takealot.edit') }}",

        data: { id: id },

        dataType: 'json',

        success: function(res){

            $('#takealotModalLabel').html(res.title);

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

        toastr.options =

            {

                "closeButton" : true,

                "progressBar" : true

            }

        toastr.success("Takealot Product Updated Successfully!");

        },

        error: function(data){

        console.log(data);

        },

    });

});







</script>

@endpush