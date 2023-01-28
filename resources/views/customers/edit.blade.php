@extends('admin')

@section('content')
<div class="layout-px-spacing">
    <div class="middle-content container-xxl p-0">
        <!-- BREADCRUMB -->
        <div class="page-meta row">
            <nav class="breadcrumb-style-one float-start" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Supplier</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Update</li>
                </ol>
            </nav>
            <div class="">
                <a class="btn btn-primary float-end" href="{{ route('suppliers.list') }}"> Back</a>
            </div>
        </div>
        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-8 p-5">
                    <form class="row g-3" action="{{ route('customers.update',$customer->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-6">
                            <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" value="{{old('name', $customer->name)}}">
                            @error('name')
                            <div class="error text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="company_name" class="form-label">Company Name </label>
                            <input type="text" class="form-control" id="company_name" name="company_name"
                                value="{{ $customer->company_name }}">
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ $customer->email }}">
                                @error('email')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="phone" name="phone"
                                value="{{ $customer->phone }}">
                                @error('phone')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="price_group_id" class="form-label">Price Group <span class="text-danger">*</span></label>
                            <select name="price_group_id" id="price_group_id" class="form-control">
                                <option value="">Select Price Group</option>
                                @foreach($price_group as $pg)
                                <option value="{{$pg->id}}" {{old('price_group_id',$customer->price_group_id) == $pg->id ? 'selected':''}}>{{$pg->name}}</option>
                                @endforeach
                            </select>
                            @error('price_group_id')
                            <div class="error text-danger">{{ $message }}</div>
                            @enderror
                    </div>

                        <div class="col-md-6">
                            <label for="tax_number" class="form-label">Tax Number </label>
                            <input type="text" class="form-control" id="tax_number" name="tax_number"  value="{{ $customer->tax_number }}">
                            
                        </div>

                        <div class="col-md-6">
                            <label for="opening_balance" class="form-label">Opening Balance <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="email" name="opening_balance"
                                value="{{ $customer->opening_balance }}">
                                @error('opening_balance')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="address" name="address"
                                value="{{ $customer->address }}">
                                @error('address')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="city" class="form-label">City <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="city" name="city" value="{{ $customer->city }}">
                            @error('city')
                                <span class="city-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="state" class="form-label">State </label>
                            <input type="text" class="form-control" id="state" name="state"
                                value="{{ $customer->state }}">
                        </div>

                        <div class="col-md-6">
                            <label for="country" class="form-label">Country <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="country" name="country"
                                value="{{ $customer->country }}">
                                @error('country')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="zip_code" class="form-label">Zip Code <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="zip_code" name="zip_code"
                                value="{{ $customer->zip_code }}">
                                @error('zip_code')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                            <div class="form-check"><br>
                                <div class="form-check form-check-primary form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="status" value="1"
                                        {{ $customer->status == '1' ? 'checked' : ''}}>
                                    <label class="form-check-label" for="form-check-radio-default-checked">
                                        Active
                                    </label>
                                </div>
                                <div class="form-check form-check-primary form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="status" value="0"
                                        {{ $customer->status == '0' ? 'checked' : ''}}>
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