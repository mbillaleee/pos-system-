@extends('admin')

@section('content')
<div class="layout-px-spacing">
    <div class="middle-content container-xxl p-0">
        <!-- BREADCRUMB -->
        <div class="page-meta row">
            <nav class="breadcrumb-style-one float-start" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Product</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create</li>
                </ol>
            </nav>
            <div class="">
            <a class="btn btn-primary float-end" href="{{ url('product') }}"> Back</a>
            </div>
        </div>
        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-8 p-5">
                <form class="row g-3" action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="col-md-6">
                        <label for="name" class="form-label">Product Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>

                    <div class="col-md-6">
                    <label for="address" class="form-label">Category <span class="text-danger">*</span></label>
                        <select class="form-select" id="category_id" name="category_id" required>
                            <option selected disabled value="">Please Select</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id}}">{{ $category->name}}</option>
                            @endforeach  
                        </select>
                    </div>

                    <div class="col-md-6">
                    <label for="address" class="form-label">Sub Category <span class="text-danger">*</span></label>
                        <select class="form-select" id="sub_category_id" name="sub_category_id">
                            <option value="">Please Select</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                    <label for="address" class="form-label">Brand <span class="text-danger">*</span></label>
                        <select class="form-select" id="brand_id" name="brand_id" required>
                            <option selected disabled value="">Please Select</option>
                            @foreach($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="image" class="form-label">Image <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>

                    <div class="col-md-6">
                        <label for="product_boosear" class="form-label">Product Boosear <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" id="product_boosear" name="product_boosear">
                    </div>

                    <div class="col-md-6">
                        <label for="user_id" class="form-label">SKU <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="sku" name="sku">
                    </div>

                    <div class="col-md-6">
                        <label for="weight" class="form-label">Weight <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="weight" name="weight">
                    </div>

                    <div class="col-md-6">
                    <label for="address" class="form-label">Unit <span class="text-danger">*</span></label>
                        <select class="form-select" id="unit" name="unit" required>
                            <option selected disabled value="">Please Select</option>
                            @foreach($units as $unit)
                            <option value="{{ $unit->id }}">{{ $unit->name}}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                        Please select a valid state.
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="city" class="form-label">Descrption <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="description" name="description">
                    </div>

                    <div class="col-md-6">
                        <label for="state" class="form-label">Sell Price <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="sell_price" name="sell_price">
                    </div>

                    <div class="col-md-6">
                        <label for="purchase_price" class="form-label">Purchase Price <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="purchase_price" name="purchase_price">
                    </div>

                    <div class="col-md-6">
                        <label for="alert_query" class="form-label">Alert Query <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="alert_query" name="alert_query">
                    </div>

                    <div class="col-md-6">
                        <label for="model_no" class="form-label">Model No<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="model_no" name="model_no"> <!-- Insert -->
                    </div>

                    <div class="col-md-6">
                        <label for="zip_code" class="form-label">Rack No<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="rack_no" name="rack_no"> <!-- Insert -->
                    </div>

                    <div class="col-md-6">
                        <label for="zip_code" class="form-label">Barcode<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="barcode" name="barcode"> <!-- Insert -->
                    </div>

                    <div class="col-md-6">
                    <label for="address" class="form-label">Barcode Type <span class="text-danger">*</span></label>
                        <select class="form-select" id="barcode_type" name="barcode_type">
                            <option selected disabled value="">Please Select</option>
                            <option value="1">Code 128 (C128)</option>
                            <option value="2">Code 39 (C39)</option>
                            <option value="3">Ena-13</option>
                            <option value="3">Ena-8</option>
                            <option value="3">UPC-A</option>
                            <option value="3">UPC-E</option>
                        </select>
                    </div>
                  
                    <div class="col-md-6">
                    <label for="address" class="form-label">Product Type <span class="text-danger">*</span></label>
                        <select class="form-select" id="product_type" name="product_type" required>
                            <option selected disabled value="">Please Select</option>
                            <option value="1">Single</option>
                            <option value="2">Variable</option>
                            <option value="3">Combo</option>
                        </select>
                    </div>

                    <div class="col-md-6"> 
                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                        <div class="form-check">
                            <div class="form-check form-check-primary form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="status" value="1" checked="">
                                <label class="form-check-label" for="form-check-radio-default-checked">
                                Active
                                </label>
                            </div>
                            <div class="form-check form-check-primary form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="status" value="0" >
                                <label class="form-check-label" for="form-check-radio-default-checked">
                                Inactive
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12"> 
                    <div class="form-group">
                            <label for="sel5">Product Type</label>
                                <select name="result" class="form-control" id="sel5" onchange="showresult(this.value)">
                                    <option value="0">--Please Select--</option>
                                    <option value="1">Single</option>
                                    <option value="2">Variant</option>
                                    <option value="3">Combo</option>
                                </select>
                            </div>

                            

                                <table class="table table-bordered mt-4" id="fallowupdate" style="display:none;">
                                    <thead>
                                    <tr>
                                        <th width="20%">Variant</th>
                                        <th width="20%">Variant value</th>
                                        <th>Purchase Price *</th>
                                        <th>Sell Price *</th>
                                        <th>Image</th>
                                        <th style="text-align: center;"><button type="button" class="addRow btn btn-success"><i class="fa fa-plus"></i> </button></th>
                                    </tr>
                                    </thead>
                                    <tbody id="variant_table">
                                    <tr>
                                        <td>
                                            <select class="form-control variant_id" id="variant_id" name="variant_id[]" style="width: 100%;" required>
                                                <option  selected disabled>Please Select</option>
                                                @foreach($variants as $variant)
                                                <option value="{{$variant->id}}">{{$variant->vari_name}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-select varient_value_id" id="varient_value_id" name="varient_value_id">
                                                <option value="">Please Select</option>
                                            </select>
                                        </td>
                                     
                                        <td>
                                            <input type="number" class="form-control text-end vari_purch_price" id="vari_purch_price" name="vari_purch_price[]" placeholder="0.00">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control text-end vari_sell_price" id="vari_sell_price" name="vari_sell_price[]" placeholder="0.00">
                                        </td>

                                        <td>
                                            <input type="file" class="form-control text-end vari_image" id="vari_image" name="vari_image[]" placeholder="0.00">
                                        </td>
                                        <td style="text-align: center;"><button type="button" class="remove btn btn-danger"><i class="fa fa-close"></i></button></td>
                                    </tr>

                                    </tbody>
                                </table>
                       


                                <table class="table table-bordered mt-4" id="combofallupdate" style="display:none;">
                                    <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Purchase Price *</th>
                                        <th>Total</th>
                                        <th style="text-align: center;"><button type="button" class="addRow2 btn btn-success"><i class="fa fa-plus"></i> </button></th>
                                    </tr>
                                    </thead>
                                    <tbody id="combo_table">
                                    <tr>
                                        <td>
                                            <select class="form-control product_id" id="product_id" name="product_id[]" style="width: 100%;" required>
                                                <option>Please Select</option>
                                                @foreach($products as $product)
                                                <option value="{{$product->id}}">{{$product->name}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                     
                                        <td>
                                            <input type="number" class="form-control text-end combo_quan" id="combo_quan" name="combo_quan[]" placeholder="0.00">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control text-end comb_pur_pri" id="comb_pur_pri" name="comb_pur_pri[]" placeholder="0.00" readonly>
                                        </td>
                                        <td>
                                            <input type="number" class="form-control text-end total_amount" id="total_amount" name="total_amount[]" placeholder="0.00" readonly>
                                        </td>

                                        <td style="text-align: center;"><button type="button" class="remove btn btn-danger"><i class="fa fa-close"></i></button></td>
                                    </tr>

                                    </tbody>
                                    <tfoot>
                                    <tr>
                                            <th colspan="3" class="text-end">Purchase Total:</th>
                                            <th class="text-end">
                                                <input type="text" class="form-control text-end sub_total" id="sub_total" name="sub_total" placeholder="0.00" readonly>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th colspan="3" class="text-end">Sell Price:</th>
                                            <th class="text-end">
                                                <input type="text" class="form-control text-end comb_sell_pri" id="sub_total" name="sub_total" placeholder="0.00">
                                            </th>
                                        </tr>
                                    </tfoot>
                                </table>
                           
                    </div>
                

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')

<script>
function showresult(str) {
  if (str == 2) {
    $("#combofallupdate").css('display', 'none');
      $("#fallowupdate").css('display', 'block');
    }else if (str == 3) {
    $("#fallowupdate").css('display', 'none');
      $("#combofallupdate").css('display', 'block');
    }else{
        $("#fallowupdate").css('display', 'none');  
        $("#combofallupdate").css('display', 'none'); 
  } 
}

$('.addRow').on('click',function(){
            addRow();
        });
        function addRow() {
            var tr =  '<tr>'+
                '<td>'+
                    '<select class="form-control variant_id" id="variant_id" name="variant_id[]" style="width: 100%;" required>'+
                        '<option  selected disabled>Select Product</option>'+
                        '@foreach($variants as $variant)'+
                        '<option value="{{$variant->id}}">{{$variant->vari_name}}</option>'+
                    '@endforeach'+
                    '</select>'+
                '</td>'+
                '<td>'+
                '<select class="form-select varient_value_id" id="varient_value_id" name="varient_value_id">'+
                    '<option value="">Please Select</option>'+
                '</select>'+
                '</td>'+
                '<td><input type="number" class="form-control text-end vari_purch_price" id="vari_purch_price" name="vari_purch_price[]" placeholder="0.00" ></td>'+
                '<td><input type="number" class="form-control text-end vari_sell_price" id="vari_sell_price" name="vari_sell_price[]" placeholder="0.00" ></td>'+
                '<td><input type="file" class="form-control text-end vari_image" id="vari_image" name="vari_image[]" placeholder="0.00" ></td>'+
                '<td style="text-align: center;"><button type="button" class="btn btn-danger remove"><i class="fa fa-close"></i></button></td>'+
                '</tr>';
            $('#variant_table').append(tr);
        };
        $('#variant_table').on('click','.remove',function() {
            var l = $('#variant_table tr').length;
            if(l==1) {
                alert('You can not remove last one');
            }else {
                $(this).parent().parent().remove();
            }
        });


        $('.addRow2').on('click',function(){
            addRow2();
        });
        function addRow2() {
            var tr =  '<tr>'+
                '<td>'+
                    '<select class="form-control product_id" id="product_id" name="product_id[]" style="width: 100%;" required>'+
                        '<option  selected disabled>Select Product</option>'+
                        '@foreach($products as $product)'+
                        '<option value="{{$product->id}}">{{$product->name}}</option>'+
                    '@endforeach'+
                    '</select>'+
                '</td>'+
                '<td><input type="number" class="form-control text-end combo_quan" id="combo_quan" name="combo_quan[]" placeholder="0.00" ></td>'+
                '<td><input type="number" class="form-control text-end comb_pur_pri" id="comb_pur_pri" name="comb_pur_pri[]" placeholder="0.00" readonly></td>'+
                '<td><input type="number" class="form-control text-end total_amount" id="total_amount" name="total_amount[]" placeholder="0.00" readonly></td>'+
                '<td style="text-align: center;"><button type="button" class="btn btn-danger remove"><i class="fa fa-close"></i></button></td>'+
                '</tr>';
            $('#combo_table').append(tr);
        };
        $('#combo_table').on('click','.remove',function() {
            var l = $('#combo_table tr').length;
            if(l==1) {
                alert('You can not remove last one');
            }else {
                $(this).parent().parent().remove();
            }
        });
</script>


<script>
    $(document).ready(function () {

  $('#category_id').on('change', function () {
      var category_id = this.value;
      
      $.ajax({
          url: "{{url('product/getsubcategory')}}",
          type: "POST",
          data: {
                category_id: category_id,
              _token: '{{csrf_token()}}'
          },
          dataType: 'json',
          success: function (data) {
                $("#sub_category_id").html('');
              $('#sub_category_id').html('<option value="">Please Select</option>');
              $.each(data, function (key, value) {
                  $("#sub_category_id").append('<option value="' + value
                      .id + '">' + value.name + '</option>');
              });
          }
      });
  });
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


        $('tbody').delegate('.combo_quan, .comb_pur_pri, .total_amount','keyup', function(){
            var tr = $(this).parent().parent();
            var combo_quan = tr.find('.combo_quan').val();
            var comb_pur_pri = tr.find('.comb_pur_pri').val();
            var total_amount = (combo_quan * comb_pur_pri);
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

        $('.invoice_discount').keyup(function () {
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
        $('#variant_table').delegate('.variant_id','change', function(){
            var tr = $(this).parent().parent();
            var id = tr.find('#variant_id :selected').val();
            // console.log(id);
            // var dataID = {'id':id};

            $.ajax({
                type:"POST",
                url:"{{url('product/getvarientvalue')}}",
                dataType: 'json',
                // data: dataID,
                data: {
                    id:id,
                    _token: '{{csrf_token()}}'
                },
                success:function (data) {
                    // console.log(data);

                    tr.find('.varient_value_id').html('');
                    tr.find('.varient_value_id').html('<option value="">Please Select</option>');
                    $.each(data, function (key, value) {
                        tr.find(".varient_value_id").append('<option value="' + value
                            .id + '">' + value.value_name + '</option>');
                    });
                    // tr.find('.price').val(data.pack_amount);

                }

            });
        });


        // Package Price
        $('#combo_table').delegate('.product_id','change', function(){
            var tr = $(this).parent().parent();
            var id = tr.find('#product_id :selected').val();
            var dataID = {'id':id};
            // console.log(id);

            $.ajax({
                type:"GET",
                url:"{{url('/purchase/productPrice')}}",
                dataType: 'json',
                data: dataID,
                success:function (data) {
                    // alert(data.purchase_price);
                     tr.find('.comb_pur_pri').val(data.purchase_price);

                }

            });
        });


    </script>

        
@endpush