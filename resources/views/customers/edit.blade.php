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
                        <!-- @if($errors)
                                    @foreach($errors->all() as $error) 
                                        {{ $error }}
                                    @endforeach
                                @endif
                                        {{ $errors }} -->

                        <div class="col-md-6">

                            <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>

                            <input type="text" class="form-control" id="name" name="name" value="{{ $customer->name }}">

                        </div>

                        <div class="col-md-6">

                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>

                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ $customer->email }}">

                        </div>

                        <div class="col-md-6">

                            <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>

                            <input type="text" class="form-control" id="phone" name="phone"
                                value="{{ $customer->phone }}">

                        </div>

                        <div class="col-md-6">

                            <label for="date_of_birth" class="form-label">Date of Birth <span
                                    class="text-danger">*</span></label>

                            <input type="date" class="form-control" id="date_of_birth" name="date_of_birth"
                                value="{{ $customer->date_of_birth }}">

                        </div>

                        <div class="col-md-6">

                            <label for="opening_balance" class="form-label">Opening Balance <span
                                    class="text-danger">*</span></label>

                            <input type="text" class="form-control" id="email" name="opening_balance"
                                value="{{ $customer->opening_balance }}">

                        </div>

                        <div class="col-md-6">

                            <label for="address" class="form-label">Address <span class="text-danger">*</span></label>

                            <input type="text" class="form-control" id="address" name="address"
                                value="{{ $customer->address }}">

                        </div>

                        <div class="col-md-6">

                            <label for="city" class="form-label">City <span class="text-danger">*</span></label>

                            <input type="text" class="form-control" id="city" name="city" value="{{ $customer->city }}">

                        </div>

                        <div class="col-md-6">

                            <label for="state" class="form-label">State <span class="text-danger">*</span></label>

                            <input type="text" class="form-control" id="state" name="state"
                                value="{{ $customer->state }}">

                        </div>

                        <div class="col-md-6">

                            <label for="country" class="form-label">Country <span class="text-danger">*</span></label>

                            <input type="text" class="form-control" id="country" name="country"
                                value="{{ $customer->country }}">

                        </div>

                        <div class="col-md-6">

                            <label for="zip_code" class="form-label">Zip Code <span class="text-danger">*</span></label>

                            <input type="text" class="form-control" id="zip_code" name="zip_code"
                                value="{{ $customer->zip_code }}">

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