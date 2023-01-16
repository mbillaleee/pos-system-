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
                    <!-- <form class="row g-3 mb-5" id="search-form" action="{{ route('purchasereport.index') }}" method="get" role="form">
                        <h4>Filter:</h4>
                        <div class="form-group row">
                            <label for="client_id" class="col-sm-4 col-form-label">{{ __('Supplier Name') }} <span class="req-star">*</span></label>
                            <div class="col-sm-8">
                                
                            </div>
                        </div>
                        <input type="text" name="reference_no">
                        <button type="submit">Submit</button>
                         <tr>
                                 <th><input type="text" class="form-control filter_input" data-column="0"></th>
                                <input type="text" class="form-control filter_input" name="daterange" value="01/01/2018 - 01/15/2018" data-column="0"/>
                                <th><input type="text" class="form-control filter_input" data-column="1" placeholder="enter supplier"></th>
                                <th><input type="text" class="form-control filter_input" data-column="2"></th>
                                <th><input type="text" class="form-control filter_input" data-column="3"></th>
                                <th><input type="text" class="form-control filter_input" data-column="4"></th>
                                <th><input type="text" class="form-control filter_input" data-column="5"></th>
                                <th><input type="text" class="form-control filter_input" data-column="6"></th>
                            </tr>
                    </form> -->
                    <form class="row g-3 mb-5" id="search-form" action="{{ route('purchasereport.index') }}" method="get" role="form">
                        <h4>Filter:</h4>

                        <div class="col-md-3">
                        <label for="weight" class="form-label">Supplier <span class="text-danger">*</span></label>
                                <select class="form-control supplier_id" id="supplier_id" name="supplier_id" style="width:100%">
                                    <option value="">Select Supplier</option>
                                    @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id}}">{{ $supplier->name}}</option>
                                    @endforeach
                                </select>
                        </div>

                        <div class="col-md-3">
                            <label for="weight" class="form-label">Reference Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control reference_num" id="reference_num" name="reference_num">
                        </div>

                        <div class="col-md-3">
                        <label for="payment_type" class="">{{ __('Payment Method') }} <span class="req-star">*</span></label>
                            <div>
                                <select class="form-control" id="payment_method" name="payment_method" style="width:100%">
                                    <option value="">Select Type</option>
                                    <option value="9">Cash</option>
                                    <option value="10">Bank</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                        <!-- <label for="payment_type" class="">Date range<span class="req-star">*</span></label> -->
                        <label for="to_date" class="form-label">Select Date</label>
                            <div>

                                <div id="reportrange1"  class="pull-left reportrange form-control">

                                <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;

                                <input type="text" name="date_range"> <b class="caret"></b>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                        <button type="submit" class="btn btn-info">Report generate</button>
                        </div>
                    </form>
                    <table id="customers_datatable" class="table table-striped dt-table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Supplier</th>
                                <th>Reference Number</th>
                                <th>Payment Method</th>
                                <th>Due Amount</th>
                                <th>Paid Amount</th>
                                <th>Total Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($purchases as $purchase)
                            <tr>
                                <td>{{ $purchase->purchase_date}}</td>
                                <td>{{ $purchase->suppliers->name}}</td>
                                <td>{{ $purchase->reference_num}}</td>
                                <!-- <td>{{ $purchase->payment_method}}</td> -->
                               <td> 
                                @if($purchase->payment_method == 9)
                                Cash
                                @elseif($purchase->payment_method == 10)
                                Bank
                                @else
                                
                                @endif
                               </td>
                                <td>{{ $purchase->due_amount}}</td>
                                <td>{{ $purchase->paid_amount}}</td>
                                <td>{{ $purchase->grand_total}}</td>
                                <td>
                                    <a class="text-warning" href="{{ route('purchase_invoice',$purchase->id) }}">view</i></a>
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
    $(function() {



var start = moment().subtract(29, 'days');

var end = moment();



function cb(start, end) {

    $('#reportrange1 input').val(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

}



$('#reportrange1').daterangepicker({

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
</script>

<script>
    $(document).ready(function () {
        $('#customers_datatable').DataTable({
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

