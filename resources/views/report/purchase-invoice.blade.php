@extends('admin')

@section('content')
<div class="layout-px-spacing pdf_generate">
<div class="container">
   <div class="col-md-12">
      <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <input type="button" class="btn btn-primary" onclick="printDiv('printableArea')" value="print" />
      </div>
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
                  <strong class="text-inverse"> Company  :{{ $purchases->suppliers->company_name ?? '' }}</strong><br>
                  Supplier   : {{ $purchases->suppliers->name ?? '' }} <br>
                  Address     : {{ $purchases->suppliers->address }}<br>
                  City, Zip Code : {{ $purchases->customers->city ?? ''}}, {{ $purchases->customers->zip_code ?? '' }}<br>
                  Phone       : {{ $purchases->suppliers->phone ?? '' }}<br>
                  Email       : {{ $purchases->suppliers->email ?? '' }}
               </address>
            </div>
            <div class="invoice-to">
               <small>to</small>
               <address class="m-t-5 m-b-5">
                  <strong class="text-inverse">Company Name : woopos</strong><br>
                  Name : {{auth()->user()->username}}<br>
                  Address : {{auth()->user()->address}}<br>
                  City: {{auth()->user()->city}}<br>
                  Phone: {{auth()->user()->phone}}<br>
                  Email: {{auth()->user()->email}}
               </address>
            </div>
            <div class="invoice-date">
               <small>Invoice: invoice no</small>
               <div class="date text-inverse m-t-5">{{ $purchases->purchase_date ?? '' }} <br></div>
               <div class="invoice-detail">
                  {{ $purchases->reference_num ?? '' }} <br>
               </div>
            </div>
         </div>
         <!-- end invoice-header -->
         <!-- begin invoice-content -->
         <div class="invoice-content mb-3">
            <!-- begin table-responsive -->
            <div class="table-responsive">
               <table class="invoice-table table-bordered" style="width:100%;">
                  <thead>
                     <tr>
                        <th class="ps-2">Product</th>
                        <th class="text-center" width="10%">Quantity</th>
                        <th class="text-center" width="10%">Price</th>
                        <th class="text-end pe-2" width="20%">Amount</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($purchase_extra as $purchase_extr)
                     <tr>
                        <td class="ps-2">{{ $purchase_extr->products->name }}    {{  $purchase_extr->variants->vari_name ?? '' }} : {{ $purchase_extr->values->value_name ?? '' }}</td>
                        <td class="text-center">{{$purchase_extr->quantity }}</td>
                        <td class="text-center">{{$purchase_extr->purchase_price }}</td>
                        <td class="text-end pe-2">{{$purchase_extr->total_amount }}</td>
                     </tr>
                     @endforeach
                  
                                        <tr>
                                            <td colspan="3" class="text-end pe-2">Sub Total:</td>
                                            <td class="text-end pe-2">
                                            {{ $purchases->sub_total ?? 0 }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-end pe-2">Discount (%):</td>
                                            <td class="text-end pe-2">
                                            {{ $purchases->discount_percent ?? 0 }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-end pe-2">Grand Total:</td>
                                            <td class="text-end pe-2">
                                            {{ $purchases->grand_total ?? 0 }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-end pe-2">Paid Amount:</td>
                                            <td class="text-end pe-2">
                                            {{ $purchases->paid_amount ?? 0 }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-end pe-2">Due:</td>
                                            <td class="text-end pe-2">
                                            {{ $purchases->due_amount ?? 0 }}
                                            </td>
                                        </tr>
                                    </tbody>
               </table>
            </div>
            <!-- end table-responsive -->
            <!-- begin invoice-price --> 

            <!-- end invoice-price -->
            @if($purchases->note)
            <div class="purchase_note mt-3">
               <p><strong>Note:</strong> {{ $purchases->note}}</p>
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