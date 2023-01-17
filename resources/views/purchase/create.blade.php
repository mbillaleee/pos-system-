@extends('admin')



@section('content')

<div class="layout-px-spacing">



<div class="middle-content container-xxl p-0">

    

    <!-- BREADCRUMB -->

    <div class="page-meta row">

        <nav class="breadcrumb-style-one float-start" aria-label="breadcrumb">

            <ol class="breadcrumb">

                <li class="breadcrumb-item"><a href="#">Purchase</a></li>

                <li class="breadcrumb-item active" aria-current="page">Create</li>

            </ol>

        </nav>

        <div class="">

        <a class="btn btn-primary float-end" href="{{ url('purchase') }}"> Back</a>

        </div>

        

    </div>



    <div class="row layout-top-spacing">

    

        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">

            <div class="widget-content widget-content-area br-8 p-5">

                <form role="form" class="forms-sample" action="{{route('purchase.store')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <div class="form-group row">
                                    <label for="client_id" class="col-sm-4 col-form-label">{{ __('Supplier Name') }} <span class="req-star">*</span></label>
                                    <div class="col-sm-8">
                                        <select class="form-control supplier_id" id="supplier_id" name="supplier_id" style="width:100%" required>
                                            <option selected disabled>Select Supplier</option>
                                            @foreach($suppliers as $supplier)
                                            <option value="{{ $supplier->id}}">{{ $supplier->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div><br>
                                
                                <div class="form-group row">
                                    <label for="invoice_no" class="col-sm-4 col-form-label">{{ __('Reference Number') }} <span class="req-star">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="reference_num" value="" class="form-control p-input" id="reference_num" placeholder="Enter reference Number" >
                                    </div>
                                </div><br>

                                

                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group row">
                                    <label for="invoice_date" class="col-sm-4 col-form-label">{{ __('Purchase Date') }} <span class="req-star">*</span></label>
                                    <div class="col-sm-8">
                                    <input id="basicFlatpickr" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Select Date.." name="purchase_date">
                                        <!-- <input type="date" name="purchase_date" class="form-control p-input datepickernew" id="purchase_date" placeholder="Enter Invoice Date"> -->
                                    </div>
                                </div><br>

                                <div class="form-group row">
                                    <label for="payment_type" class="col-sm-4 col-form-label">{{ __('Payment Method') }} <span class="req-star">*</span></label>
                                    <div class="col-sm-8">
                                        <select class="js-example-basic-single form-control" onchange="bank_paymet(this.value)" id="payment_method" name="payment_method" style="width:100%" required>
                                            <option  selected disabled>Select Type</option>
                                            <option value="1">Cash</option>
                                            <option value="0">Cheque</option>
                                        </select>
                                    </div>
                                </div>


                            </div>

                            <table class="table table-bordered mt-4" id="tbl_posts">
                                <thead>
                                <tr>
                                    <th width="25%">Product Name *</th>
                                    <th>Qty *</th>
                                    <th>Price *</th>
                                    <th>Total</th>
                                    <th style="text-align: center;"><button type="button" class="addRow btn btn-success"><i class="fa fa-plus"></i> </button></th>
                                </tr>
                                </thead>
                                <tbody id="sale_table">
                                <tr>
                                    <td>
                                        <select class="form-control product_id" id="product_id" name="product_id[]" style="width: 100%;" required>
                                            <option  selected disabled>Select Product</option>
                                            @foreach($products as $product)
                                            <option value="{{ $product->id}}">{{ $product->name}}</option>
                                            @endforeach
                                            
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" class="form-control text-end quantity" id="quantity" name="quantity[]" placeholder="0.00">
                                    </td>
                                    <td>
                                        <input type="number" class="form-control text-end price" id="price" name="price[]" placeholder="0.00" readonly>
                                    </td>

                                    <td>
                                        <input type="number" class="form-control text-end total_amount" id="total_amount" name="total_amount[]" placeholder="0.00" readonly>
                                    </td>
                                    <td style="text-align: center;"><button type="button" class="remove btn btn-danger"><i class="fa fa-close"></i></button></td>
                                </tr>

                                </tbody>
                                <tfoot>
                                <tr>
                                    <th colspan="3" class="text-end">Sub Total:</th>
                                    <th class="text-end">
                                        <input type="text" class="form-control text-end sub_total" id="sub_total" name="sub_total" placeholder="0.00" readonly>
                                    </th>
                                </tr>
                                <tr>
                                    <th colspan="3" class="text-end">Discount (%):</th>
                                    <th class="text-end">
                                        <input type="text" class="form-control text-end discount_percent" id="discount_percent" name="discount_percent" placeholder="0.00">
                                    </th>
                                </tr>
                                <tr>
                                    <th colspan="3" class="text-end">Grand Total:</th>
                                    <th class="text-end">
                                        <input type="text" class="form-control text-end grand_total" value="{{old('grand_total')}}" id="grand_total" name="grand_total" placeholder="0.00" readonly>
                                    </th>
                                </tr>
                                <tr>
                                    <th colspan="3" class="text-end">Paid Amount:</th>
                                    <th class="text-end">
                                        <input type="number" class="form-control text-end paid_amount" value="{{old('paid_amount')}}" id="paid_amount" name="paid_amount" placeholder="0.00">
                                    </th>
                                </tr>
                                <tr>
                                    <th colspan="3" class="text-end">Due:</th>
                                    <th class="text-end">
                                        <input type="text" class="form-control text-end due_amount" id="due_amount" name="due_amount" placeholder="0.00" readonly>
                                    </th>
                                </tr>
                                </tfoot>
                            </table>
                            
                            <div class="col-sm-8">
                                    <div class="form-group">
                                        <label for="note">{{ __('Note') }}</label>
                                        <textarea name="note" id="note" class="form-control" rows="3"></textarea>
                                    </div>
                            </div>
                            <div class="col-sm-4 text-center">
                                <button type="submit" class="btn btn-success mt-4">{{ __('Submit') }}</button>
                            </div>

                        </div>
                    </form>

            </div>

        </div>



    </div>



</div>



</div>

@endsection


@push('js')
<!-- <script src="{{ asset('assets/node_modules/jquery/dist/jquery.min.js') }}"></script> -->
    <script type="text/javascript">

        $('.addRow').on('click',function(){
            addRow();
        });
        function addRow() {
            var tr =  '<tr>'+
                '<td>'+
                '<select class="form-control select2 product_id" id="product_id" name="product_id[]" style="width: 100%;">'+
                '<option>Select Product</option>'+
                '@foreach($products as $product)'+
                '<option value="{{$product->id}}">{{$product->name}}</option>'+
                '@endforeach'+
                '</select>'+
                '</td>'+
                '<td><input type="number" class="form-control text-end quantity" id="quantity" name="quantity[]" placeholder="0.00"></td>'+
                '<td><input type="number" class="form-control text-end price" id="price" name="price[]" placeholder="0.00" readonly></td>'+
                '<td><input type="number" class="form-control text-end total_amount" id="total_amount" name="total_amount[]" placeholder="0.00" readonly></td>'+
                '<td style="text-align: center;"><button type="button" class="btn btn-danger remove"><i class="fa fa-close"></i></button></td>'+
                '</tr>';
            $('tbody').append(tr);
        };
        $('tbody').on('click','.remove',function() {
            var l = $('tbody tr').length;
            if(l==1) {
                alert('You can not remove last one');
            }else {
                $(this).parent().parent().remove();
            }
        });
    </script>
    <script>
        function bank_paymet(val){
            if(val==0){
                document.getElementById('bankID').style.display = 'block';
                document.getElementById('chequeID').style.display = 'block';
                document.getElementById('bank_id').setAttribute("required", true);
            }else{
                document.getElementById('bankID').style.display = 'none';
                document.getElementById('chequeID').style.display = 'none';
                document.getElementById('bank_id').removeAttribute("required");
            }

         //   document.getElementById('bankID').style.display = style;
        }


        $('tbody').delegate('.quantity, .price, .total_amount','change', function(){
            var tr = $(this).parent().parent();
            var quantity = tr.find('.quantity').val();
            var price = tr.find('.price').val();
            var total_amount = (quantity * price);
            tr.find('.total_amount').val(total_amount);

            subtotal();
        });
        function subtotal () {
            var subtotal = 0;
            $('.total_amount').each(function (i,e) {
                var total_p = $(this).val()-0;
                subtotal += total_p;
            });
            $('.sub_total').val(subtotal);
            $('.grand_total').val(subtotal);
        }

        $('.discount_percent').keyup(function () {
            //   var totaldis = 0;
            var invdis = $(this).val();
            var subt = $('.sub_total').val();
            if (invdis) {
                $('.grand_total').empty();
                var totaldis = (subt/100 * invdis);
                var gtotal = subt - totaldis;
                $('.grand_total').val(gtotal);
            }

        });
        $('.paid_amount').keyup(function () {
            var paidamount = $('.paid_amount').val();
            var gttal = $('.grand_total').val();
            var dueamount = gttal - paidamount;
            var changeamount = paidamount - gttal;
            if (gttal > paidamount ) {
                $('.due_amount').empty();
                $('.due_amount').val(dueamount);
            }else {
                $('.due_amount').empty();
                $('.due_amount').val('0');
            }

        });


        // Package Price
        $('tbody').delegate('.product_id','change', function(){
            var tr = $(this).parent().parent();
            var id = tr.find('#product_id :selected').val();
            var dataID = {'id':id};

            $.ajax({
                type:"GET",
                url:"{{url('/purchase/productPrice')}}",
                dataType: 'json',
                data: dataID,
                success:function (data) {
                    // alert(data.name);
                     tr.find('.price').val(data.purchase_price);

                }

            });
        });


    </script>
    <script type="text/javascript">
     /*   $('#client_id').change(function(){
            var id = $('#client_id').val();
            var dataID = {'id':id};
                $.ajax({
                    type:"GET",
                    url:" ",
                    dataType: 'json',
                    data: dataID,
                    success:function(data){
                        $('#supplier_id').val(data.supplier_id);
                    }
                });
        });*/

        $('#supplier_id').change(function(){
            var id = $(this).val();
            var dataID = {'id':id};
                $.ajax({
                    type:"GET",
                    url:"{{url('invoice/clientID')}}",
                    dataType: 'json',
                    data: dataID,
                    success:function(data){
                        if(data){
                            document.getElementById('client_id').removeAttribute("disabled");
                            $("#client_id").empty();
                            $("#client_id").append('<option>Select</option>');
                            $.each(data,function(key,value){
                                $("#client_id").append('<option value="'+key+'">'+value+'</option>');
                            });

                        }else{
                            $("#client_id").empty();
                        }
                    }
                });

        });


    </script>
<script>
    var today = new Date();

    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!
    var yyyy = today.getFullYear();

    if(dd<10) {
        dd = '0'+dd
    }

    if(mm<10) {
        mm = '0'+mm
    }

    // today = yyyy + '/' + mm + '/' + dd;
    today = dd + '-' + mm + '-' + yyyy;

    //    console.log(today);
    document.getElementById('basicFlatpickr').value = today;
</script>
@endpush