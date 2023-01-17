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
                <!-- @if($errors)
                    @foreach($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                @endif
                {{ $errors }} -->

                <div class="col-md-6">

                    <label for="name" class="form-label">Product Name <span class="text-danger">*</span></label>

                    <input type="text" class="form-control" id="name" name="name">

                </div>

                <div class="col-md-6">

                    <label for="user_id" class="form-label">SKU <span class="text-danger">*</span></label>

                    <input type="text" class="form-control" id="sku" name="sku">

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

                    <label for="weight" class="form-label">Weight <span class="text-danger">*</span></label>

                    <input type="text" class="form-control" id="weight" name="weight">

                </div>

                <div class="col-md-6">
                <label for="address" class="form-label">Unit <span class="text-danger">*</span></label>
                    <select class="form-select" id="unit" name="unit" required>
                        <option selected disabled value="">Please Select</option>
                        <option value="1">Pieces</option>
                        <option value="2">Packet</option>
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

                    <label for="country" class="form-label">Purchase Price <span class="text-danger">*</span></label>

                    <input type="text" class="form-control" id="purchase_price" name="purchase_price">

                </div>

                <div class="col-md-6">

                    <label for="zip_code" class="form-label">Alert Query <span class="text-danger">*</span></label>

                    <input type="text" class="form-control" id="alert_query" name="alert_query">

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
@endpush