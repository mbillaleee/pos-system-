@extends('admin')

@section('content')
<div class="layout-px-spacing">
    <div class="middle-content container-xxl p-0">
        <!-- BREADCRUMB -->
        <div class="page-meta row">
            <nav class="breadcrumb-style-one float-start" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Supplier</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create</li>
                </ol>
            </nav>
            <div class="">
            <a class="btn btn-primary float-end" href="{{ url('suppliers') }}"> Back</a>
            </div>
        </div>
        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-8 p-5">
                    <form class="row g-3" action="{{route('supplier.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-6">
                            <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
                            @error('name')
                            <div class="error text-danger">{{ $message }}</div>
                        @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="company_name" class="form-label">Company Name </label>
                            <input type="text" class="form-control" id="company_name" name="company_name" value="{{old('company_name')}}">
                            
                        </div>

                        <div class="col-md-6">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}">
                            @error('email')
                            <div class="error text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{old('phone')}}">
                            @error('phone')
                            <div class="error text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="tax_number" class="form-label">Tax Number </label>
                            <input type="text" class="form-control" id="tax_number" name="tax_number" value="{{old('tax_number')}}">
                            
                        </div>

                        <div class="col-md-6">
                            <label for="opening_balance" class="form-label">Opening Balance <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="email" name="opening_balance" value="{{old('opening_balance')}}">
                            @error('opening_balance')
                            <div class="error text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="address" name="address" value="{{old('address')}}">
                            @error('address')
                            <div class="error text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="city" class="form-label">City <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="city" name="city" value="{{old('city')}}">
                            @error('city')
                            <div class="error text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="state" class="form-label">State </label>
                            <input type="text" class="form-control" id="state" name="state" value="{{old('state')}}">
                        </div>

                        <div class="col-md-6">
                            <label for="country" class="form-label">Country <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="country" name="country" value="{{old('country')}}">
                            @error('country')
                            <div class="error text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="zip_code" class="form-label">Zip Code <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="zip_code" name="zip_code" value="{{old('zip_code')}}">
                            @error('zip_code')
                            <div class="error text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- <div class="col-md-6">
                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                            <div class="form-check"><br>
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
                        </div> -->

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