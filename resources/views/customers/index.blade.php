@extends('admin')

@section('content')

<div class="layout-px-spacing">
    <div class="middle-content container-xxl p-0">
        <!-- BREADCRUMB -->
        <div class="page-meta row">
            <nav class="breadcrumb-style-one float-start" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page"> Customers </li>
                </ol>
            </nav>
            <div class="mt-3">
                <a class="btn btn-primary btn-md float-end" href="{{ route('customer.create') }}"> Add Customer</a>
            </div>
        </div>
        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                <div class="widget-content widget-content-area br-8 table-responsive">
                    <table id="customers_datatable" class="table table-striped dt-table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Date of Birth</th>
                                <th>Country</th>
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

            ajax: "{{ route('customers.lists') }}",
            columns: [
                {data: 'name', name: 'name'},
                {data: 'phone', name: 'phone'},
                {data: 'email', name: 'email'},
                {data: 'date_of_birth', name: 'date_of_birth'},
                {data: 'country', name: 'country'},
                {data: 'opening_balance', name: 'opening_balance'},
                {data: 'address', name: 'address'},
                {data: 'action', name: 'action', orderable: true, searchable: true},
            ],

            columnDefs: [
                {
                    render: function(data, type, full, meta) {
                        return "<div class='text-wrap width-70'>" + data + "</div>";
                    },
                    targets: 7
                }
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
</script>

@endpush