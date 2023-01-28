@extends('admin')

@section('content')
<div class="layout-px-spacing pdf">
   <div class="container">
      <div class="col-md-12">
         <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <input type="button" class="btn btn-primary" onclick="printDiv('printableArea')" value="print" />
         </div>
         <div id="editor"></div>
         <div class="invoice printableArea" id="printableArea">
            <!-- begin invoice-company -->
            <div class="invoice-company text-inverse f-w-600">
               <span class="pull-right hidden-print">
               </span>
               {{Auth::user()->shops->business_name ?? 'Company Name'}}
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
                  <table class="invoice-table table-bordered" style="width:100%;">
                     <thead>
                        <tr>
                           <th class="ps-2">Product</th>
                           <th class="text-center" width="10%">Quantity</th>
                           <th class="text-center" width="10%">Price</th>
                           <th class="text-end pe-2" width="20%">TOTAL</th>
                        </tr>
                     </thead>
                     <tbody>
                     
                        
                           @foreach($sales_extra as $sales_extr)
                           <tr>
                              <td class="ps-2">{{ $sales_extr->products->name }}  {{  $sales_extr->variants->vari_name ?? '' }} : {{ $sales_extr->values->value_name ?? '' }}</td>
                              <td class="text-center">{{$sales_extr->quantity }}</td>
                              <td class="text-center">{{$sales_extr->sell_price }}</td>
                              <td class="text-end pe-2">{{$sales_extr->total_amount }}</td>
                           </tr>
                           @endforeach
                           <tr>
                                            <td colspan="3" class="text-end pe-2">Sub Total:</td>
                                            <td class="text-end pe-2">
                                            {{ $sales->sub_total ?? 0 }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-end pe-2">Discount (%):</td>
                                            <td class="text-end pe-2">
                                            {{ $sales->discount_percent ?? 0 }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-end pe-2">Grand Total:</td>
                                            <td class="text-end pe-2">
                                            {{ $sales->grand_total ?? 0 }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-end pe-2">Paid Amount:</td>
                                            <td class="text-end pe-2">
                                            {{ $sales->paid_amount ?? 0 }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-end pe-2">Due:</td>
                                            <td class="text-end pe-2">
                                            {{ $sales->due_amount ?? 0 }}
                                            </td>
                                        </tr>
                     </tbody>
                  </table>
               </div>
               <!-- end table-responsive -->
               @if($sales->note)
            <div class="purchase_note mt-3">
               <p><strong>Note:</strong> {{ $sales->note}}</p>
            </div>
            @endif
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

    function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;

     

     
}


</script>

@endpush