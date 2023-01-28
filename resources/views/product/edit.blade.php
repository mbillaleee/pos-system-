@extends('admin')

@section('content')
<div class="layout-px-spacing">
    <div class="middle-content container-xxl p-0">
        <!-- BREADCRUMB -->
        <div class="page-meta row">
            <nav class="breadcrumb-style-one float-start" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Product</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
            <div class="">
            <a class="btn btn-primary float-end" href="{{ url('product') }}"> Back</a>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="">
                    <form class="" action="{{route('product.update',$product->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="g-3 widget-content widget-content-area br-8 layout-top-spacing">
                            <div class="row">
                            <h5 class="pb-2">Edit Product</h5> 
                            <div class="col-md-6 col-12">
                                <label for="name" class="form-label">Product Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Product Title" value="{{ $product->name }}">
                                @error('name')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3 col-12" id="hide_pur_price">
                                <label for="purchase_price" class="form-label">Cost Price </label>
                                <input type="text" class="form-control" id="purchase_price" name="purchases_price" placeholder="Cost Price" value="{{ $product->purchase_price }}">
                                @error('purchase_price')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3 col-12" id="hide_sell_price">
                                <label for="sell_price" class="form-label">Selling Price </label>
                                <input type="text" class="form-control" id="sell_price" name="sells_price" placeholder="Selling Price" value="{{ $product->sell_price }}">
                                @error('sell_price')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            </div>
                            <div class="row">
                            <div class="col-md-6 col-12 mt-2">
                                <label for="barcode" class="form-label">Barcode<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="barcode" name="barcode" placeholder="Barcode" value="{{ $product->Barcode }}">
                                <input type="hidden" name="status" value="1">
                                @error('barcode')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3 col-12 mt-2">
                                <label for="sku" class="form-label">Sku </label>
                                <input type="text" class="form-control" id="sku" name="sku" placeholder="Sku" value="{{ $product->Sku }}">
                                @error('sku')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3 col-12 mt-2">
                                <label for="model_no" class="form-label">Model No</label>
                                <input type="text" class="form-control" id="model_no" name="model_no" placeholder="Model No" value="{{ $product->model_no }}"> 
                                @error('model_no')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            </div>
                        </div>
                        <div class="g-3 widget-content widget-content-area br-8 layout-top-spacing">
                            <div class="row">
                        <div class="col-md-4 col-12">
                            <label for="address" class="form-label">Brand <span class="text-danger">*</span></label>
                                <select class="form-select" id="brand_id" name="brand_id">
                                    <option value="">Please Select</option>
                                    @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}" {{($brand->id==$product->brand_id) ? 'selected':''}}>{{ $brand->name}}</option>
                                    @endforeach
                                </select>
                                @error('brand_id')
                                    <div class="error text-danger">The brand field is required.</div>
                                @enderror
                            </div>
                            <div class="col-md-4 col-12">
                                <label for="address" class="form-label">Category <span class="text-danger">*</span></label>
                                <select class="form-select" id="category_id" name="category_id">
                                    <option selected value="">Please Select</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{($category->id==$product->category_id) ? 'selected':''}}>{{ $category->name}}</option>
                                    @endforeach  
                                </select>
                                @error('category_id')
                                    <div class="error text-danger">The Category field is required.</div>
                                @enderror
                            </div>

                            <div class="col-md-4 col-12">
                            <label for="address" class="form-label">Sub Category </label>
                                <select class="form-select" id="sub_category_id" name="sub_category_id">
                                <option value="{{ $category->id }}" {{($category->id==$product->category_id) ? 'selected':''}}>{{ $category->name}}</option>
                                </select>
                            </div>

                            <div class="col-md-4 col-12 mt-2">
                                <label for="zip_code" class="form-label">Rack No</label>
                                <input type="text" class="form-control" id="rack_no" name="rack_no" placeholder="Rack No" value="{{ $product->rack_no}}"> 
                                @error('rack_no')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 col-12 mt-2">
                            <label for="supplier_id" class="form-label">Supplier</label>
                                <select class="form-select" id="supplier_id" name="supplier_id">
                                    <option value="">Please Select</option>
                                    @foreach($suppliers as $sup)
                                    <option value="{{ $sup->id }}" @if($product->supplier_id != ''){{ $product->supplier_id == $sup->id ? 'selected' : null }} @endif>{{ $sup->name}}</option>
                                    @endforeach
                                </select>
                                @error('supplier_id')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 col-12 pt-5 text-center">
                            <div class="form-check form-check-primary form-check-inline">
                                <input class="form-check-input" type="radio" name="unit" id="unit1" value="1" value="1" {{ ($product->unit) == (1) ? 'checked' : null }} checked>
                                <label class="form-check-label" for="unit1">
                                    Piece
                                </label>
                            </div>
                            <div class="form-check form-check-info form-check-inline">
                                <input class="form-check-input" type="radio" name="unit" value="2" id="unit2" value="2" {{ ($product->unit) == (2) ? 'checked' : null }}>
                                <label class="form-check-label" for="unit2">
                                    Kg
                                </label>
                            </div>
                            <div class="form-check form-check-success form-check-inline">
                                <input class="form-check-input" type="radio" name="unit" value="3" id="unit3" value="3" {{ ($product->unit) == (3) ? 'checked' : null }}>
                                <label class="form-check-label" for="unit3">
                                    Litter
                                </label>
                            </div>
                                @error('unit')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            </div>
                            </div>
                        <div class="g-3 widget-content widget-content-area br-8 layout-top-spacing">
                        <div class="row">
                            <div class="col-md-12 col-12">
                                <label for="city" class="form-label">Descrption </label>
                                <textarea class="form-control" id="editor" name="description" placeholder="Descrption">{{ $product->description }}</textarea>
                                @error('description')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 col-12 mt-2">
                                <label for="image" class="form-label">Image </label>
                                <input type="file" class="form-control" id="image" name="image">
                                @if($product->image != null)<img src="{{asset('uploads/products/'.$product->image)}}" width="50" class="mt-2" alt="{{$product->name}}">@endif
                                @error('image')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 col-12 mt-2">
                                <label for="product_boosear" class="form-label">Product Brochure </label>
                                <input type="file" class="form-control" id="product_boosear" name="product_boosear">
                                @if($product->product_boosear != null)<img src="{{asset('uploads/products/'.$product->product_boosear)}}" width="50" class="mt-2" alt="{{$product->name}}">@endif
                               
                                @error('product_boosear')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 col-12 mt-2">
                                <label for="weight" class="form-label">Weight </label>
                                <input type="text" class="form-control" id="weight" name="weight" placeholder="Weight" value="{{ $product->Weight }}">
                                @error('weight')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            </div>
                            </div>
                        <div class="g-3 widget-content widget-content-area br-8 layout-top-spacing">
                        <div class="row">
                            <div class="col-md-4 col-12">
                                <label for="alert_query" class="form-label">Alert Query <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="alert_query" name="alert_query" placeholder="Alert Query" value="{{ $product->alert_query }}">
                                @error('alert_query')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 col-12">
                            <label for="address" class="form-label">Barcode Type <span class="text-danger">*</span></label>
                                <select class="form-select" id="barcode_type" name="barcode_type">
                                    <option value="">Please Select</option>
                                    <option value="1" {{ ($product->barcode_type) == (1) ? 'selected' : null }}>Code 128 (C128)</option>
                                    <option value="2" {{ ($product->barcode_type) == (2) ? 'selected' : null }}>Code 39 (C39)</option>
                                    <option value="3" {{ ($product->barcode_type) == (3) ? 'selected' : null }}>Ena-13</option>
                                    <option value="3" {{ ($product->barcode_type) == (4) ? 'selected' : null }}>Ena-8</option>
                                    <option value="3" {{ ($product->barcode_type) == (5) ? 'selected' : null }}>UPC-A</option>
                                    <option value="3" {{ ($product->barcode_type) == (6) ? 'selected' : null }}>UPC-E</option>
                                </select>
                                @error('barcode_type')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 col-12"> 
                                <div class="form-group">
                                    <label for="sel5">Product Type <span class="text-danger">*</span></label>
                                        <select class="form-control" id="product_type" onchange="showresult(this.value)" name="product_type">
                                            <option value="1" {{ ($product->product_type) == (1) ? 'selected' : null }}>Simple</option>
                                            <option value="2" {{ ($product->product_type) == (2) ? 'selected' : null }}>Variable</option>
                                            <option value="3" {{ ($product->product_type) == (3) ? 'selected' : null }}>Combo</option>
                                        </select>
                                        @error('product_type')
                                        <div class="error text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                    
                                <div class="col-md-12 col-12"> 
                                    <table class="table table-bordered mt-4" id="fallowupdate" @if($product->product_type != 2)style="display:none;"@endif>
                                        <thead>
                                            <tr>
                                                <th width="20%">Variant <span class="text-danger">*</span></th>
                                                <th width="20%">Variant value <span class="text-danger">*</span></th>
                                                <th  width="20%">Purchase Price <span class="text-danger">*</span></th>
                                                <th  width="20%">Sell Price <span class="text-danger">*</span></th>
                                                <th  width="20%">Image</th>
                                                <th style="text-align: center;"><button type="button" class="addRow btn btn-success"><i class="fa fa-plus"></i> </button></th>
                                            </tr>
                                        </thead>
                                        <tbody id="variant_table">
                                            @foreach($product_variants as $key=>$val)
                            
                                            <tr>
                                                <td>
                                                    <input type="hidden" name="variant_id[]" value="{{$val->id}}">
                                                    <select class="form-control product_variants_id" id="product_variants_id" name="product_variants_id[]" style="width: 100%;">
                                                        <option>Please Select</option>
                                                        @foreach($variants as $variant)
                                                        <option value="{{$variant->id}}" {{ ($variant->id) == $val->product_variants_id ? 'selected' : '' }}>{{$variant->vari_name ?? ''}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-select variants_value_id" id="variants_value_id" name="variants_value_id[]">
                                                        <option value="">Please Select</option>
                                                        <option value="{{$val->variants_value_id}}" selected>{{$val->product_variant_values->value_name}}</option>
                                                    </select>
                                                </td>
                                            
                                                <td>

                                                    <input type="number" class="form-control text-end variant_purchase_price" id="variant_purchase_price" value="{{$val->variant_purchase_price}}" name="variant_purchase_price[]" placeholder="0.00">
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control text-end variant_sell_price" id="variant_sell_price" value="{{$val->variant_sell_price}}" name="variant_sell_price[]" placeholder="0.00">
                                                </td>

                                                <td class="row">
                                                    <div class="col-lg-10">
                                                    <input type="file" class="form-control text-end variable_image" id="variable_image" name="variable_image[]">
                                                    </div>
                                                    <div class="col-lg-2">
                                                    @if($val->variable_image != null)<img src="{{asset('uploads/variantproducts/'.$val->variable_image)}}" width="30px" alt="$product->variable_image">@endif
                                                    </div>

                                                </td>
                                                @if($key==0)
                                                <td style="text-align: center;"><button type="button" class="remove btn btn-danger"><i class="fa fa-close"></i></button></td>
                                                @else
                                                <td style="text-align: center;"><button type="button" class="btn btn-danger remove"><i class="fa fa-close"></i></button></td>
                                                @endif
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    
                                    <table class="table table-bordered mt-4" id="combofallupdate" @if($product->product_type != 3)style="display:none;"@endif>
                                        <thead>
                                        <tr>
                                            <th width="20%">Product <span class="text-danger">*</span></th>
                                            <th width="20%">Quantity <span class="text-danger">*</span></th>
                                            <th width="20%">Purchase Price <span class="text-danger">*</span></th>
                                            <th width="20%">Total</th>
                                            <th style="text-align: center;"><button type="button" class="addRow2 btn btn-success"><i class="fa fa-plus"></i> </button></th>
                                        </tr>
                                        </thead>
                                        <tbody id="combo_table">
                                        @foreach($combo_products as $key=>$val)
                                        <tr>
                                            <td>
                                                
                                                <select class="form-control product_id" id="product_id" name="product_id[]" style="width: 100%;" required>
                                                    <option>Please Select</option>
                                                    @foreach($products as $product)
                                                    <option value="{{$product->id}}" {{ ($product->id) == $val->combo_product_id  ? 'selected' : '' }}>{{$product->name ?? ''}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        
                                            <td>
                                                <input type="number" class="form-control text-end combo_quantity" value="{{$val->combo_quantity}}" id="combo_quantity" name="combo_quantity[]" placeholder="0">
                                            </td>
                                            <td>
                                                <input type="number" class="form-control text-end combo_purchase_price" value="{{$val->combo_purchase_price}}" id="combo_purchase_price" name="combo_purchase_price[]" placeholder="0.00">
                                            </td>
                                            <td>
                                                <input type="number" class="form-control text-end total_amount" value="{{$val->total_amount}}" id="total_amount" name="total_amount[]" placeholder="0.00" readonly>
                                            </td>

                                            @if($key==0)
                                            <td style="text-align: center;"><button type="button" class="remove btn btn-danger"><i class="fa fa-close"></i></button></td>
                                            @else
                                            <td style="text-align: center;"><button type="button" class="btn btn-danger remove"><i class="fa fa-close"></i></button></td>
                                            @endif
                                        </tr>
                                        @endforeach

                                        </tbody>
                                        <tfoot>
                                        <tr>
                                                <th colspan="3" class="text-end">Purchase Total: </th>
                                                <th class="text-end">
                                                    <input type="text" class="form-control text-end sub_total" id="sub_total" name="combo_purchase_price1" placeholder="0.00">
                                                </th>
                                            </tr>
                                            <tr>
                                                <th colspan="3" class="text-end">Sell Price: <span class="text-danger">*</span></th>
                                                <th class="text-end">
                                                    <input type="text" class="form-control text-end combo_sell_price" id="combo_sell_price" name="combo_sell_price1" placeholder="0.00" require>
                                                </th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        

                            <div class="col-md-12 col-12 mt-3">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
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

<script>
function showresult(str) {
  if (str == 2) {
        $("#combofallupdate").css('display', 'none');
        $("#hide_pur_price").css('display', 'block');
        $("#hide_sell_price").css('display', 'block');
        $("#fallowupdate").css('display', 'block');
    }else if (str == 3) {
        $("#hide_pur_price").css('display', 'none');
        $("#hide_sell_price").css('display', 'none');
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
                '<input type="hidden" name="variant_id[]" value="">'+
                    '<select class="form-control product_variants_id" id="product_variants_id" name="product_variants_id[]" style="width: 100%;" required>'+
                    '<option value="">Please Select</option>'+
                        '@foreach($variants as $variant)'+
                        '<option value="{{$variant->id}}">{{$variant->vari_name}}</option>'+
                        '@endforeach'+
                    '</select>'+
                '</td>'+
                '<td>'+
                '<select class="form-select variants_value_id" id="variants_value_id" name="variants_value_id[]">'+

                    '<option value="">Please Select </option>'+
                '</select>'+
                '</td>'+
                '<td><input type="number" class="form-control text-end variant_purchase_price" id="variant_purchase_price" name="variant_purchase_price[]" placeholder="0.00" ></td>'+
                '<td><input type="number" class="form-control text-end variant_sell_price" id="variant_sell_price" name="variant_sell_price[]" placeholder="0.00" ></td>'+
                '<td><input type="file" class="form-control text-end variable_image" id="variable_image" name="variable_image[]" placeholder="0.00"></td>'+

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
                        '<option>Select Product</option>'+
                        '@foreach($products as $product)'+
                        '<option value="{{$product->id}}">{{$product->name}}</option>'+
                    '@endforeach'+
                    '</select>'+
                '</td>'+
                '<td><input type="number" class="form-control text-end combo_quantity" id="combo_quantity" name="combo_quantity[]" placeholder="0.00" value="1" ></td>'+
                '<td><input type="number" class="form-control text-end combo_purchase_price" id="combo_purchase_price" name="combo_purchase_price[]" placeholder="0.00"></td>'+
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
        var tr = $('#combo_table .product_id').parent().parent();
        var combo_quantity = tr.find('.combo_quantity').val();
        var combo_purchase_price = tr.find('.combo_purchase_price').val();
        var total_amount = (combo_quantity * combo_purchase_price);
        tr.find('.total_amount').val(total_amount);

        subtotal();

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

        $('#combo_table').delegate('.combo_quantity, .combo_purchase_price, .total_amount','keyup', function(){
            var tr = $(this).parent().parent();
            var combo_quantity = tr.find('.combo_quantity').val();
            var combo_purchase_price = tr.find('.combo_purchase_price').val();
            var total_amount = (combo_quantity * combo_purchase_price);
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
        $('#variant_table').delegate('.product_variants_id','change', function(){
            var tr = $(this).parent().parent();
            var id = tr.find('#product_variants_id :selected').val();
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

                    tr.find('.variants_value_id').html('');
                    tr.find('.variants_value_id').html('<option value="">Please Select</option>');
                    $.each(data, function (key, value) {
                        tr.find(".variants_value_id").append('<option value="' + value
                            .id + '">' + value.value_name + '</option>');
                    });
                    tr.find('.price').val(data.pack_amount);

                }

            });
        });

        $('#combo_table').delegate('.product_id','change', function(){
            var tr = $(this).parent().parent();
            var id = tr.find('#product_id :selected').val();
            console.log(id);
            // var dataID = {'id':id};

            $.ajax({
                type:"POST",
                url:"{{url('product/productComboPrice')}}",
                dataType: 'json',
                // data: dataID,
                data: {
                    id:id,
                    _token: '{{csrf_token()}}'
                },
                success:function (data) {
                     console.log(data.purchase_price);

                    // alert(data.purchase_price);
                     tr.find('.combo_purchase_price').val(data.purchase_price);

                     var combo_quantity = tr.find('.combo_quantity').val();
                        var combo_purchase_price = tr.find('.combo_purchase_price').val();
                        var total_amount = (combo_quantity * combo_purchase_price);
                        tr.find('.total_amount').val(total_amount);

                        subtotal();

                }

            });
        });


        // // Package Price
        // $('#combo_table').delegate('.product_id','change', function(){
        //     var tr = $(this).parent().parent();
        //     var id = tr.find('#product_id :selected').val();
        //     alert(id);
        //     var dataID = {'id':id};
        //     console.log(dataID);

        //     $.ajax({
        //         type:"POST",
        //         url:"{{url('/product/productComboPrice')}}",
        //         dataType: 'json',
        //         data: {
        //             id:id,
        //             _token: '{{csrf_token()}}'
        //         },
        //         alert(purchase_price);
        //         success:function (data) {
        //             // alert(data.purchase_price);
        //              tr.find('.combo_purchase_price').val(data.purchase_price);

        //         }

        //     });
        // });


        // $('tbody').delegate('.product_id', '.combo_purchase_price' 'change', function(){
        //     var tr = $(this).parent().parent();
        //     var id = tr.find('#product_id :selected').val();
        //     console.log(id);
        //     var dataID = {'id':id};

        //     $.ajax({
        //         type:"GET",
        //         url:"{{url('/purchase/productPrice')}}",
        //         dataType: 'json',
        //         data: dataID,
        //         success:function (data) {
        //             alert(data.combo_purchase_price);
        //              tr.find('.combo_purchase_price').val(data.sell_price);

        //         }

        //     });
        // });


    </script>

    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>



        
@endpush