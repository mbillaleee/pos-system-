@extends('admin')



@section('content')

<div class="layout-px-spacing">



<div class="middle-content container-xxl p-0">

    

    <!-- BREADCRUMB -->

    <div class="page-meta row">

        <nav class="breadcrumb-style-one float-start" aria-label="breadcrumb">

            <ol class="breadcrumb">

                <li class="breadcrumb-item"><a href="#">Takealot</a></li>

                <li class="breadcrumb-item active" aria-current="page">Profit Calculation</li>

            </ol>

        </nav>

        

    </div>



    <div class="row layout-top-spacing">

    

        <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">

            <div class="widget-content widget-content-area br-8 table-responsive">

            <form action="" method="get">

                <div class="row mb-5">

                    <div class="col-sm-5">

                        <label for="to_date" class="form-label">Select Date</label>

                        <div id="reportrange1"  class="pull-left reportrange">

                        <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;

                        <input type="text" name="date_range" value="{{$drange ?? ''}}" required> <b class="caret"></b>

                        </div>

                    </div>

                    <div class="col-sm-7 mt-3 pt-3">

                        <button class="btn btn-primary" type="submit">Submit</button>

                    </div>

                    

                </div>

            </form>

            <table id="takealot-profit" class="table table-striped dt-table-hover" style="width:100%">

                    <thead>

                        <tr>

                            <th style="width:170px;white-space: normal;">Product Name</th>

                            <th style="width:170px;white-space: normal;">TSIN</th>

                            <th style="width:70px;white-space: normal;">POS Minimum Sale Price</th>

                            <th style="width:70px;white-space: normal;">Total Sold Unit</th>

                            <th style="width:70px;white-space: normal;">Selling Price TK</th>

                            <th style="width:70px;white-space: normal;">Total Sold Amount</th>

                            <th style="width:70px;white-space: normal;">Total Retun</th>

                            <th style="width:70px;white-space: normal;">Total Return Amount</th>

                            <th style="width:70px;white-space: normal;">Profit From Sold Amount</th>

                            <th style="width:70px;white-space: normal;">Final Profit</th>

                        </tr>

                    </thead>

                    <tbody>

                        @php 

                            $users = Auth::user();

                            if($users->user_role != 2){

                                $user_id = $users->id;

                            }else{

                                $user_id = $users->parent_id;

                            }

                            $min_price = App\Models\MyPos::whereNotNull('tsin')->where('user_id',$user_id)->get();

                        @endphp

                            @foreach($min_price as $mprice)

       

                            @php 

                                $posminsaleprice = $mprice->product_min_price;

                                $commatsin = $mprice->tsin;

                                $fetcharray = preg_split ("/\,/", $commatsin);

                            @endphp



                            @foreach($fetcharray as $fethvalue)

                            @php 

                                $fethctsin = $fethvalue;

                                if(Request::input('date_range') != null){

                                    $dt = explode(" - ",Request::input('date_range'));

                                    $from_date = date('Y-m-d', strtotime($dt[0]));

                                    $to_date = date('Y-m-d', strtotime($dt[1]));

                                  

                                    $seltkpname = App\Models\TakealotSale::where('tsin',$fethctsin)->whereBetween('order_date', [date('Y-m-d H:i:s', strtotime($from_date." 00:00:00")), date('Y-m-d H:i:s', strtotime($to_date." 23:59:59"))])->orderBy('order_date','desc')->get();

                                    $seltkpn = App\Models\TakealotSale::where('tsin',$fethctsin)->whereBetween('order_date', [date('Y-m-d H:i:s', strtotime($from_date." 00:00:00")), date('Y-m-d H:i:s', strtotime($to_date." 23:59:59"))])->orderBy('order_date','desc')->first();

                                }else{

                                $seltkpname = App\Models\TakealotSale::where('tsin',$fethctsin)->orderBy('order_date','desc')->get();

                                $seltkpn = App\Models\TakealotSale::where('tsin',$fethctsin)->orderBy('order_date','desc')->first();

                                }

                            @endphp

                            

                            



                            @if($seltkpn != null)

                      

                            @php 

                            $totalsoldunit = count($seltkpname);

                            $sellrpicetk = $seltkpn->selling_price;

                            $selreturnitem = App\Models\TakealotSale::where('tsin',$fethvalue)->where('sale_status','Returned')->orderBy('order_date','desc')->get()->toArray();

                            $returitemval = count($selreturnitem);



                            $totalreturnamt = ($posminsaleprice*$returitemval)+($returitemval*40);

                            $profitfromsoldamt = ($sellrpicetk-$posminsaleprice)*$totalsoldunit;

                            @endphp

                        

                        <tr>

                            <td>{{ $seltkpn['product_name'] }}</td>

                            <td>{{ $seltkpn['tsin'] }}</td>

                            <td>{{ $posminsaleprice }}</td>

                            <td>{{ $totalsoldunit }}</td>

                            <td>{{ $sellrpicetk }}</td>

                            <td>{{ $totalsoldunit * $sellrpicetk }}</td>

                            <td>{{ $returitemval }}</td>

                            <td>{{ $totalreturnamt }}</td>

                            <td>{{ $profitfromsoldamt }}</td>

                            <td>{{ $profitfromsoldamt-$totalreturnamt }}</td>

                        </tr>

                        @endif

                        

                        @endforeach

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



// var f3 = flatpickr(document.getElementById('rangeCalendarFlatpickr'), {

//     mode: "range",

// });

$('#takealot-profit').DataTable({

    "autoWidth": false,

    columnDefs: [

                {

                    render: function (data, type, full, meta) {

                        return "<div class='text-wrap width-160'>" + data + "</div>";

                    },

                    targets: 0

                },

                

            ]

});

</script>

@endpush