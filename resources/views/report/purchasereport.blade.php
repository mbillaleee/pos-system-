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
                    
                    <form action="{{route('purchasereport.index')}}" method="get">
                   
                        <div class="row mb-5">
                            <div class="col-sm-12 mb-3">
                                <h4 class="text-center">Purchase Report</h4>
                            </div>
                            
                            <div class="col-sm-3">
                                <label for="supplier_id" class="form-label">Supplier</label>
                                <select name="supplier_id" id="selectProgrammingLanguage" class="form-control">
                                   <option value="">Choose Supplier</option>
                                    @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id}}">{{ $supplier->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <label for="reference_num" class="form-label">Reference Number</label>
                                <input type="text" class="form-control" id="reference_num" name="reference_num">
                            </div>
                            <!-- <div class="col-sm-3">
                                <label for="from_date" class="form-label">Date From</label>
                                <input id="from_date" name="from_date" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Select Date..">
                            </div>
                            <div class="col-sm-3">
                                <label for="to_date" class="form-label">Date To</label>
                                <input id="to_date" name="to_date" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Select Date..">
                            </div> -->
                            <div class="col-sm-5">
                            <label for="date_range" class="form-label">Select Date</label>
                            <div id="reportrange"  class="pull-left reportrange">
                                <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                                <input type="text" name="date_range" value="{{$drange ?? ''}}"> <b class="caret"></b>
                            </div>
                            </div>
                            <!-- <div class="col-sm-4">
                                <label for="to_date" class="form-label">Select Date</label>
                                <input id="rangeCalendarFlatpickr" name="date_range" value="{{$drange ?? ''}}" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Select Date.." required>
                            </div> -->
                            <div class="col-sm-2 mt-3 pt-3">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                            
                            
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
                                    <a title="View" class="text-primary" href="{{ route('purchase_invoice',$purchase->id) }}"><i class="fa-solid fa-eye"></i></a>
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
    $('#reportrange input').val(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
}

$('#reportrange').daterangepicker({
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


    $(document).ready(function() {
  $(".select2").select2();
});
</script>

@endpush

