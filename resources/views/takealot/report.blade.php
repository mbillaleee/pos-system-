@extends('admin')

@section('content')
<div class="layout-px-spacing"> 

<div class="middle-content container-xxl p-0">
    
    <!-- BREADCRUMB -->
    <div class="page-meta row">
        <nav class="breadcrumb-style-one float-start" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Takealot</a></li>
                <li class="breadcrumb-item active" aria-current="page">Report</li>
            </ol>
        </nav>
    </div>

    <div class="row layout-top-spacing">
    
        <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
            <div class="widget-content widget-content-area br-8">
            <form action="{{route('takealot.report')}}" method="get">
                <div class="row mb-5">
                    <div class="col-sm-12 mb-3">
                        <h4 class="text-center">Takealot Report through Sale Status</h4>
                    </div>
                    
                    <div class="col-sm-5">
                        <label for="sales_status" class="form-label">Select Sales Status</label>
                        <select name="sales_status" id="sales_status" class="form-control" required>
                            <option value="">Select Sale Status</option>
                            <option value="Top Selling Product">Top Selling Product</option>
                            <option value="Top Return Product">Top Return Product</option>
                            @foreach($sales_status as $sstatus)
                            <option value="{{$sstatus->sale_status}}" @if($status != null) {{ $sstatus->sale_status == $status ? 'selected' : '' }} @endif>{{$sstatus->sale_status}}</option>
                            @endforeach
                        </select>
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
                @if($status !== null || $drange != null)
                <div class="row mb-3">
                    <div class="col-sm-12">
                        <h4>Search Result: {{$status ?? ''}} - {{$drange ?? ''}}</h4>
                        <h5>Toatal Amount: {{number_format($selling_price,2) ?? ''}}</h5>
                    </div>
                </div>
                @endif
                @if($top_selling_product != null)
                <div class="row" id="reportlist">
                    <div class="col-sm-12 table-responsive">
                <table id="takealot-sales-status1" class="table table-striped dt-table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>TSIN</th>
                            <th>Quantity</th>
                            <th>Total Revenue</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($top_selling_product as $tresult)
                        @php 
                        $tsins = App\Models\Takealot::where('title',$tresult->product_name)->first();
                        @endphp
                        <tr>
                            <td>{{$tresult->product_name}}</td>
                            <td>{{$tsins->tsin ?? ''}}</td>
                            <td>{{$tresult->sale_item}}</td>
                            <td>{{$tresult->sale_price}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    
                   
                </table>
                
                </div>
                </div>

                @elseif($top_selling_product == null && $search_result != null) 
                <div class="row" id="reportlist">
                    <div class="col-sm-12 table-responsive">
                <table id="takealot-sales-status" class="table table-striped dt-table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>Order Date</th>
                            <th>Product Name</th>
                            <th>Selling Price</th>
                            <th>Quantity</th>
                            <th>Sales Status</th>
                            <th>Customer Name</th>
                            <th>DC</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($search_result as $sresult)
                        <tr>
                            <td>{{date('d/m/Y H:i:s', strtotime($sresult->order_date))}}</td>
                            <td>{{$sresult->product_name}}</td>
                            <td>{{$sresult->selling_price}}</td>
                            <td>{{$sresult->quantity}}</td>
                            <td>{{$sresult->sale_status}}</td>
                            <td>{{$sresult->cust_name}}</td>
                            <td>{{$sresult->dc}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    
                   
                </table>
                
                </div>
                </div>
                @endif
                
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

$('#takealot-sales-status').dataTable({
    lengthMenu: [
        [25, 50, 100, 200, -1],
        [25, 50, 100, 200, "All"]
    ],
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

        ],
    columnDefs: [
                {
                    render: function (data, type, full, meta) {
                        return "<div class='text-wrap width-80'>" + data + "</div>";
                    },
                    targets: 0
                },
                {
                    render: function (data, type, full, meta) {
                        return "<div class='text-wrap width-170'>" + data + "</div>";
                    },
                    targets: 1
                },
                {
                    render: function (data, type, full, meta) {
                        return "<div class='text-wrap width-70'>" + data + "</div>";
                    },
                    targets: 4
                },
                {
                    render: function (data, type, full, meta) {
                        return "<div class='text-wrap width-70'>" + data + "</div>";
                    },
                    targets: 5
                }
             ],
});
$('#takealot-sales-status1').dataTable({
    lengthMenu: [
        [25, 50, 100, 200, -1],
        [25, 50, 100, 200, "All"]
    ],
    dom: 'Bfrtip',
buttons: [
    'pageLength',
{
                extend:'csvHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2 ]
                },
            },
            {
           extend: 'pdf',
            exportOptions: {
                columns: [ 0, 1, 2 ]
            }
           
          
       },

        ],
    columnDefs: [
                {
                    render: function (data, type, full, meta) {
                        return "<div class='text-wrap width-300'>" + data + "</div>";
                    },
                    targets: 0
                },
                {
                    render: function (data, type, full, meta) {
                        return "<div class='text-wrap width-80'>" + data + "</div>";
                    },
                    targets: 1
                },
                {
                    render: function (data, type, full, meta) {
                        return "<div class='text-wrap width-80'>" + data + "</div>";
                    },
                    targets: 2
                },
             ],
             order: [[1, 'desc']],
});
var f3 = flatpickr(document.getElementById('rangeCalendarFlatpickr'), {
    mode: "range",
});
</script>
@endpush