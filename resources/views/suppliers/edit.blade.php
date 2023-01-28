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
                    <form class="row g-3" action="{{ route('suppliers.update',$supplier->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="col-md-6">
                            <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $supplier->name }}">
                            @error('name')
                            <div class="error text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="company_name" class="form-label">Company Name <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="company_name" name="company_name"
                                value="{{ $supplier->company_name }}">
                        </div>

                        <div class="col-md-6">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ $supplier->email }}">
                                @error('email')
                            <div class="error text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="phone" name="phone"
                                value="{{ $supplier->phone }}">
                                @error('phone')
                            <div class="error text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="tax_number" class="form-label">Tax Number <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="tax_number" name="tax_number"
                                value="{{ $supplier->tax_number }}">
                        </div>

                        <div class="col-md-6">
                            <label for="opening_balance" class="form-label">Opening Balance <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="opening_balance" name="opening_balance"
                                value="{{ $supplier->opening_balance }}">
                                @error('opening_balance')
                            <div class="error text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="address" name="address"
                                value="{{ $supplier->address }}">
                                @error('address')
                            <div class="error text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="city" class="form-label">City <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="city" name="city" value="{{ $supplier->city }}">
                            @error('city')
                            <div class="error text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="state" class="form-label">State <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="state" name="state"
                                value="{{ $supplier->state }}">

                        </div>

                        <div class="col-md-6">
                            <label for="country" class="form-label">Country <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="country" name="country"
                                value="{{ $supplier->country }}">
                                @error('country')
                            <div class="error text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="zip_code" class="form-label">Zip Code <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="zip_code" name="zip_code"
                                value="{{ $supplier->zip_code }}">
                                @error('date_of_birth')
                            <div class="error text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                            <div class="form-check"><br>
                                <div class="form-check form-check-primary form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="status" value="1"
                                        {{ $supplier->status == '1' ? 'checked' : ''}}>
                                    <label class="form-check-label" for="form-check-radio-default-checked">
                                        Active
                                    </label>
                                </div>
                                <div class="form-check form-check-primary form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="status" value="0"
                                        {{ $supplier->status == '0' ? 'checked' : ''}}>
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





@push('js')
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
    // today = yyyy + '-' + mm + '-' + dd;
    today = {{ date('Y-m-d', strtotime($supplier->date_of_birth)) }};

    //    console.log(today);
    document.getElementById('basicFlatpickr').value = today;

</script>

@endpush