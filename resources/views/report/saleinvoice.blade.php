@extends('admin')

@section('content')
<div class="layout-px-spacing pdf">
<div class="container">
   <div class="col-md-12">
      <div class="invoice">
         <!-- begin invoice-company -->
         <div class="invoice-company text-inverse f-w-600">
            <span class="pull-right hidden-print">
            <a href="javascript:;" onclick="print()"  target="_blank" class="btn btn-sm btn-white m-b-10 p-l-5"><i class="fa fa-file t-plus-1 text-danger fa-fw fa-lg"></i> Export as PDF</a>
            <a href="javascript:;" onclick="window.print()" class="btn btn-sm btn-white m-b-10 p-l-5"><i class="fa fa-print t-plus-1 fa-fw fa-lg"></i> Print</a>
            
            </span>
            Woopos Company, Inc
         </div>
         <!-- end invoice-company -->
         <!-- begin invoice-header -->
         <div class="invoice-header">
            <div class="invoice-from">
               <small>from</small>
               <address class="m-t-5 m-b-5">
                  <strong class="text-inverse">Company Name : woopos</strong><br>
                  Name : {{auth()->user()->username}}<br>
                  Address : {{auth()->user()->address}}<br>
                  City: {{auth()->user()->city}}<br>
                  Phone: {{auth()->user()->phone}}<br>
                  Email: {{auth()->user()->email}}
               </address>
            </div>
            <div class="invoice-to">
               <small>to</small>
               <address class="m-t-5 m-b-5">
                  <strong class="text-inverse">Company Name : {{ $sales->customers->company_name ?? '' }}</strong><br>
                  Name : {{ $sales->customers->name ?? '' }}<br>
                  Address: {{ $sales->customers->address ?? '' }}<br>
                  City, Zip Code : {{ $sales->customers->city ?? '' }}, {{ $sales->customers->zip_code ?? '' }}<br>
                  Phone : {{ $sales->customers->phone ?? '' }}<br>
                  Email : {{ $sales->customers->email ?? '' }}
               </address>
            </div>
            <div class="invoice-date">
               <small>Invoice</small>
               <div class="date text-inverse m-t-5">{{ $sales->sale_date ?? '' }} <br></div>
               <div class="invoice-detail">
                  {{ $sales->reference_num ?? '' }} <br>
               </div>
            </div>
         </div>
         <!-- end invoice-header -->
         <!-- begin invoice-content -->
         <div class="invoice-content">
            <!-- begin table-responsive -->
            <div class="table-responsive">
               <table class="table table-invoice">
                  <thead>
                     <tr>
                        <th>Product</th>
                        <th class="text-center" width="10%">Paid</th>
                        <th class="text-center" width="10%">Due</th>
                        <th class="text-right" width="20%">TOTAL</th>
                     </tr>
                  </thead>
                  <tbody>
                    
                     @foreach($sales_extra as $sales_extr)
                     @php 
                     $products = App\Models\Product::where('id',$sales_extr->product_id)->first();
                     
                     @endphp
                     <tr>
                         <td>{{ $products->name }}</td>
                        <td class="text-center">{{$sales_extr->quantity }}</td>
                        <td class="text-center">{{$sales_extr->price }}</td>
                        <td class="text-right">{{$sales_extr->total_amount }}</td>
                     </tr>
                        @endforeach
                  </tbody>
               </table>
            </div>
            <!-- end table-responsive -->
            <!-- begin invoice-price -->
            <div class="invoice-price">
               <div class="invoice-price-left">
                  <div class="invoice-price-row">
                     <div class="sub-price">
                        <small>SUBTOTAL</small>
                        <span class="text-inverse">$4,500.00</span>
                     </div>
                     <div class="sub-price">
                        <i class="fa fa-plus text-muted"></i>
                     </div>
                     <div class="sub-price">
                        <small>PAYPAL FEE (5.4%)</small>
                        <span class="text-inverse">$108.00</span>
                     </div>
                  </div>
               </div>
               <div class="invoice-price-right">
                  <small class="text-white">TOTAL :</small> <span class="f-w-600">{{$sales_extr->quantity * $sales_extr->price }}</span>
               </div>
            </div>
            <!-- end invoice-price -->
         </div>
         <!-- end invoice-content -->
      </div>
   </div>
</div>
</div>

@endsection

@push('js')
<script>

</script>

<script>
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