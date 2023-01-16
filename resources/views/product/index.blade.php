@extends('admin')

@section('content')

@php
    $user_role = Auth::user()->user_role;
@endphp

<div class="layout-px-spacing">
    <div class="middle-content container-xxl p-0">
        <!-- BREADCRUMB -->
        <div class="page-meta row">
            <nav class="breadcrumb-style-one float-start" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page"> Products </li>
                </ol>
            </nav>
            <div class="mt-3">
                <a class="btn btn-primary float-end" href="{{ route('product.create') }}"> Add Product</a>
            </div>
        </div>
        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                <div class="widget-content widget-content-area br-8 table-responsive">
                    <table id="product_datatable" class="table table-striped dt-table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Sub Category</th>
                                <th>Image</th>
                                <th>Selling Price</th>
                                <th>Purchase Price</th>
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

    $('#product_datatable').DataTable({
        // responsive: true,
        processing: true,
        serverSide: true,
        "ajax": "table",
        "autoWidth": false,
        lengthMenu: [
            [25, 50, 100, 200, -1],
            [25, 50, 100, 200, "All"]
        ],

        ajax: "{{ route('product.index') }}",
        columns: [
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'category_id',
                name: 'category_id'
            },
            {
                data: 'sub_category_id',
                name: 'sub_category_id'
            },
            {
                data: 'image',
                name: 'image'
            },
            {
                data: 'sell_price',
                name: 'sell_price'
            },
            {
                data: 'purchase_price',
                name: 'purchase_price'
            },
           
            {
                data: 'action', 
                name: 'action', orderable: true, searchable: true
            },
           
        ],

        columnDefs: [ 

            // {

            //     render: function(data, type, full, meta) {

            //         if(data==0){
            //         return "<span class='badge bg-warning text-dark'>{}</span>";
            //         }else{
            //             return "<span class='badge bg-primary'>{}</span>";
            //         }
            //         },

            //     targets: 2

            // },
            {
                render: function(data, type, full, meta) {
                    if(data){
                    return '<img src="/uploads/products/'+data+'" width="80" alt="product image" title="product image">';
                    }
                },
                targets: 3
            },
            
    //         {

    //         render: function (data, type, full, meta) {

    //             return "<div class='text-wrap width-70'>" + data + "</div>";
    //             '<a href="{{route("suppliers.edit",'.$supplier.')}}" data-toggle="tooltip"  data-original-title="Edit"
    // class="edit text-info"><i class="fa-solid fa-pen-to-square"></i></a>'

    //         },

    //         targets: 10

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
                    columns: [0, 1, 2, 3, 4, 5, 6]
                },
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6]
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