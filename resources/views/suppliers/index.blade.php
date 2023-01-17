@extends('admin')



@section('content')

<div class="layout-px-spacing">



    <div class="middle-content container-xxl p-0">



        <!-- BREADCRUMB -->

        <div class="page-meta row">

            <nav class="breadcrumb-style-one float-start" aria-label="breadcrumb">

                <ol class="breadcrumb">

                    <li class="breadcrumb-item active" aria-current="page"> Suppliers </li>
                </ol>
                

            </nav>

            <div class="mt-3">

                <a class="btn btn-primary float-end" href="{{ route('suppliers.create') }}"> Add Supplier</a>

            </div>



        </div>



        <div class="row layout-top-spacing">



            <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">

                <div class="widget-content widget-content-area br-8 table-responsive">

                    <table id="supplier_datatable" class="table table-striped dt-table-hover" style="width:100%">

                        <thead>

                            <tr>


                                <th>Name</th>
                                <th>Company Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Tax Number</th>
                                <th>Opening Balance</th>
                                <th>Address</th>
                                <th width="150px">Action</th>

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

    $("#syncBtn").click(function() {

        $("#syncBtn").text(($("#syncBtn").text() == 'Supplier Sync') ? 'Please Wait...' :
            'Supplier Sync');

    })

});

$(document).ready(function() {

    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });

    $('#supplier_datatable').DataTable({

        // responsive: true,

        processing: true,

        serverSide: true,

        "ajax": "table",

        "autoWidth": false,

        lengthMenu: [

            [25, 50, 100, 200, -1],

            [25, 50, 100, 200, "All"]

        ],



        ajax: "{{ route('suppliers.list') }}",

        columns: [

            {
                data: 'name',
                name: 'name'
            },

            {
                data: 'company_name',
                name: 'company_name'
            },

            {
                data: 'phone',
                name: 'phone'
            },

            {
                data: 'email',
                name: 'email'
            },

            {
                data: 'tax_number',
                name: 'tax_number'
            },

            {
                data: 'opening_balance',
                name: 'opening_balance'
            },
            {
                data: 'address',
                name: 'address'
            },
            {data: 'action', name: 'action', orderable: true, searchable: true},


        ],

        columnDefs: [

            {

                render: function(data, type, full, meta) {

                    return "<div class='text-wrap width-70'>" + data + "</div>";

                },

                targets: 7

            },
    //         {

    //         render: function (data, type, full, meta) {

    //             return "<div class='text-wrap width-70'>" + data + "</div>";
    //             '<a href="{{route("suppliers.edit",'.$supplier.')}}" data-toggle="tooltip"  data-original-title="Edit"
    // class="edit text-info"><i class="fa-solid fa-pen-to-square"></i></a>'

    //         },

    //         targets: 8

    //         }

        ],

        order: [
            [0, 'desc']
        ],

        dom: 'Bfrtip',

        buttons: [

            'pageLength',

            {

                extend: 'csvHtml5',

                exportOptions: {

                    columns: [0, 1, 2, 3, 4, 5, 6, 7]

                },

            },

            {

                extend: 'pdf',

                exportOptions: {

                    columns: [0, 1, 2, 3, 4, 5, 6, 7]

                }





            },

            // 'csvHtml5',

            // 'pageLength'



        ],

    });

});



function editFunc(id) {

    $.ajax({

        type: "POST",

        url: "",

        data: {
            id: id
        },

        dataType: 'json',

        success: function(res) {

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

        type: 'POST',

        url: "",

        data: formData,

        cache: false,

        contentType: false,

        processData: false,

        success: (data) => {

            $("#takealotModal").modal('hide');

            var oTable = $('#supplier_datatable').dataTable();

            oTable.fnDraw(false);

            $("#btn-save").html('Submit');

            $("#btn-save").attr("disabled", false);

            toastr.options =

                {

                    "closeButton": true,

                    "progressBar": true

                }

            toastr.success("Takealot Product Updated Successfully!");

        },

        error: function(data) {

            console.log(data);

        },

    });

});
</script>

@endpush