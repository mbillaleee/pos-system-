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

        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-8 p-5">
                <form class="row g-3" action="{{route('product.update',$product->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="col-md-6">
                        <label for="name" class="form-label">Product Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}">
                    </div>

                    <div class="col-md-6">
                    <label for="address" class="form-label">Category <span class="text-danger">*</span></label>
                        <select class="form-select" id="category" name="category" value="{{ $product->category }}" required>
                            <option selected disabled value="">Please Select</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{($category->id==$product->category_id) ? 'selected':''}}>{{ $category->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                    <label for="address" class="form-label">Sub Category <span class="text-danger">*</span></label>
                        <select class="form-select" id="category" name="category_id" value="{{ $product->category_id }}" required>
                            <option selected disabled value="">Please Select</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{($category->id==$product->category_id) ? 'selected':''}}>{{ $category->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                    <label for="address" class="form-label">Brand <span class="text-danger">*</span></label>
                        <select class="form-select" id="brand_id" name="brand_id" required>
                            <option selected disabled value="">Please Select</option>
                            @foreach($brands as $brand)
                            <option value="{{ $brand->id }}" {{($brand->id==$product->brand_id) ? 'selected':''}}>{{ $brand->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="date_of_birth" class="form-label">Image <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" id="image" name="image">
                        @if($product->image != null)<img src="{{asset('uploads/products/'.$product->image)}}" width="80" alt="$product->name">@endif
                    </div>

                    <div class="col-md-6">
                        <label for="product_boosear" class="form-label">Product Boosear <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" id="product_boosear" name="product_boosear" value="{{ $product->product_boosear }}">
                    </div>

                    <div class="col-md-6">
                        <label for="user_id" class="form-label">SKU <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="sku" name="sku" value="{{ $product->sku }}">
                    </div>

                    <div class="col-md-6">
                        <label for="opening_balance" class="form-label">Weight <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="weight" name="weight" value="{{ $product->weight }}">
                    </div>

                    <div class="col-md-6">
                    <label for="address" class="form-label">Unit <span class="text-danger">*</span></label>
                        <select class="form-select" id="unit" name="unit" value="{{ $product->unit }}" required>
                            <option selected disabled value="">Please Select</option>
                            <option value="1" {{ ($product->unit) == (1) ? 'selected' : null }} > Pieces </option>
                            <option value="2" {{ ($product->unit) == (2) ? 'selected' : null }} > Packet </option>
                        </select>
                        <div class="invalid-feedback">
                        Please select a valid state.
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="city" class="form-label">Descrption <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="description" name="description" value="{{ $product->description }}">
                    </div>

                    <div class="col-md-6">
                        <label for="state" class="form-label">Sell Price <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="sell_price" name="sell_price" value="{{ $product->sell_price }}">
                    </div>

                    <div class="col-md-6">
                        <label for="country" class="form-label">Purchase Price <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="purchase_price" name="purchase_price" value="{{ $product->purchase_price }}">
                    </div>

                    <div class="col-md-6">
                        <label for="zip_code" class="form-label">Alert Query <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="alert_query" name="alert_query" value="{{ $product->alert_query }}">
                    </div>

                    <div class="col-md-6">
                        <label for="model_no" class="form-label">Model No<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="model_no" name="model_no" value="{{ $product->model_no }}"> <!-- Insert -->
                    </div>

                    <div class="col-md-6">
                        <label for="zip_code" class="form-label">Rack No<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="rack_no" name="rack_no" value="{{ $product->rack_no }}"> <!-- Insert -->
                    </div>

                    <div class="col-md-6">
                        <label for="zip_code" class="form-label">Barcode<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="barcode" name="barcode" value="{{ $product->barcode }}"> <!-- Insert -->
                    </div>

                    <div class="col-md-6">
                    <label for="address" class="form-label">Barcode Type <span class="text-danger">*</span></label>
                        <select class="form-select" id="barcode_type" name="barcode_type">
                            <option selected disabled value="">Please Select</option>
                            <option value="1" {{ ($product->barcode_type) == (1) ? 'selected' : null }}>Code 128 (C128)</option>
                            <option value="2" {{ ($product->barcode_type) == (2) ? 'selected' : null }}>Code 39 (C39)</option>
                            <option value="3" {{ ($product->barcode_type) == (3) ? 'selected' : null }}>Ena-13</option>
                            <option value="3" {{ ($product->barcode_type) == (4) ? 'selected' : null }}>Ena-8</option>
                            <option value="3" {{ ($product->barcode_type) == (5) ? 'selected' : null }}>UPC-A</option>
                            <option value="3" {{ ($product->barcode_type) == (6) ? 'selected' : null }}>UPC-E</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                    <label for="address" class="form-label">Product Type <span class="text-danger">*</span></label>
                        <select class="form-select" id="product_type" name="product_type" value="{{ $product->product_type }}" required>
                            <option selected disabled value="">Please Select</option>
                            <option value="1" {{ ($product->product_type) == (1) ? 'selected' : null }} > Single </option>
                            <option value="2" {{ ($product->product_type) == (2) ? 'selected' : null }} > Variable </option>
                            <option value="3" {{ ($product->product_type) == (3) ? 'selected' : null }} > Combo </option>
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
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection