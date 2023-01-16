@extends('admin')

@section('content')
<div class="layout-px-spacing">
    <div class="middle-content container-xxl p-0">
        <!-- BREADCRUMB -->
        <div class="page-meta row">
            <nav class="breadcrumb-style-one float-start" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page"> Purchases Report</li>
                </ol>
            </nav>
            <div class="mt-3">
                <!-- <a class="btn btn-primary btn-md float-end" href="{{ route('purchase.create') }}"> Add Purchase</a> -->
            </div>
        </div>
        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                <div class="widget-content widget-content-area br-8 table-responsive">
                <form class="row g-3 mb-5" action="" method="POST">
                        <h4>Filter:</h4>

                        <div class="col-md-3">
                        <label for="weight" class="form-label">Customer <span class="text-danger">*</span></label>
                                <select class="form-control supplier_id" id="supplier_id" name="supplier_id" style="width:100%">
                                    <option value="">Select Customer</option>
                                    @foreach($customers as $customer)
                                    <option value="{{ $customer->id}}">{{ $customer->name}}</option>
                                    @endforeach
                                </select>
                        </div>

                        <div class="col-md-3">
                            <label for="user_id" class="form-label">Date <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="sku" name="sku">
                        </div>

                        <div class="col-md-3">
                            <label for="city" class="form-label">SKU <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="description" name="description">
                        </div>

                        <div class="col-md-3">
                            <label for="zip_code" class="form-label">Alert Query <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="alert_query" name="alert_query">
                        </div>

                    </form>
                    <table id="sale_datatable" class="table table-striped dt-table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Customer</th>
                                <th>Reference Number</th>
                                <th>Payment Method</th>
                                <th>Due Amount</th>
                                <th>Paid Amount</th>
                                <th>Total Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sales as $sale)
                            <tr>
                                <td>{{ $sale->sale_date}}</td>
                                <td>{{ $sale->customers->name}}</td>
                                <td>{{ $sale->reference_num}}</td>
                                <!-- <td>{{ $sale->payment_method}}</td> -->
                               <td> 
                                @if($sale->payment_method == 10)
                                    Bank
                                @elseif($sale->payment_method == 9)
                                    Cash
                                @else
                                
                                @endif
                               </td>
                                <td>{{ $sale->due_amount}}</td>
                                <td>{{ $sale->paid_amount}}</td>
                                <td>{{ $sale->grand_total}}</td>
                                <td>
                                    <a class="text-warning" href="{{ route('saleinvoice',$sale->id) }}">view</i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
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

});
    $(document).ready(function () {
        $('#sale_datatable').DataTable({
            lengthMenu: [
            [25, 50, 100, 200, -1],
            [25, 50, 100, 200, "All"]
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
</script>

@endpush