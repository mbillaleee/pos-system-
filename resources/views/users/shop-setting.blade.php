@extends('admin')



@section('content')

<div class="layout-px-spacing">



<div class="middle-content container-xxl p-0">

    

    <!-- BREADCRUMB -->

    <div class="page-meta row">

        <nav class="breadcrumb-style-one float-start" aria-label="breadcrumb">

            <ol class="breadcrumb">

                <li class="breadcrumb-item"><a href="#">Shop</a></li>

                <li class="breadcrumb-item active" aria-current="page">Edit</li>

            </ol>

        </nav>

    </div>

    <!-- /BREADCRUMB -->

    @if (count($errors) > 0)

    <div class="alert alert-danger">

        <strong>Whoops!</strong> There were some problems with your input.<br><br>

        <ul>

        @foreach ($errors->all() as $error)

            <li>{{ $error }}</li>

        @endforeach

        </ul>

    </div>

    @endif





    <div class="row layout-top-spacing">

    

        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">

            <div class="widget-content widget-content-area br-8 p-5">

                <form id="msform" action="{{route('shop.update', $shop->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-section row">

                        <div class="col-12">

                            <div class="mb-3">

                                <label class="form-label">Business Name <span class="text-danger">*</span></label>

                                <input type="text" class="form-control" name="business_name" id="business_name" value="{{old('business_name', $shop->business_name)}}">
                                @error('business_name')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="mb-3">

                                <label class="form-label">Start Date <span class="text-danger">*</span></label>

                                <!-- <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date') }}" > -->
                                <input id="basicFlatpickr" value="{{old('start_date', $shop->start_date)}}" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Select Date.." name="start_date">
                                @error('start_date')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="mb-3">

                                <label class="form-label">Upload Logo</label>

                                <input type="file" class="form-control" id="upload_logo" name="upload_logo" value="{{old('upload_logo', $shop->upload_logo)}}" >
                                @error('upload_logo')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                        </div>

                        <div class="col-6">

                            <div class="mb-3">

                                <label class="form-label">Courrency <span class="text-danger">*</span></label>

                                @php
                                $currencies = App\Models\Currency::all();
                                @endphp

                                <select name="currency" id="currency" class="form-control" value="{{old('currency', $shop->currency)}}">
                                    <option value=""> Select Courrency</option>
                                    @foreach($currencies as $courrency)
                                    <option value="{{$courrency->id}}" {{ ($shop->currency) == ($courrency->id) ? 'selected' : null }} > {{$courrency->country}} </option>
                                    @endforeach
                                </select>
                                @error('currency')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                        </div>



                        <div class="col-6">

                            <div class="mb-3">

                                <label class="form-label">Website</label>

                                <input type="text" class="form-control" id="website"  name="website" value="{{old('website', $shop->website)}}" >
                                @error('website')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>

                        <div class="col-6">

                            <div class="mb-3">

                                <label class="form-label">Business Contact No <span class="text-danger">*</span></label>

                                <input type="text" class="form-control" id="business_contact"  name="business_contact" value="{{old('business_contact', $shop->business_contact)}}">
                                @error('business_contact')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>

                        <div class="col-6">

                            <div class="mb-3">

                                <label class="form-label">Alternate Contact No</label>

                                <input type="text" class="form-control" id="alternate_contact" name="alternate_contact" value="{{old('alternate_contact', $shop->alternate_contact)}}">
                                @error('alternate_contact')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>

                        <div class="col-6">

                            <div class="mb-3">

                                <label class="form-label">Country <span class="text-danger">*</span></label>

                                <input type="text" class="form-control" id="country" name="country" value="{{old('country', $shop->country)}}" autocomplete="country">
                                @error('country')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>

                        <div class="col-6">

                            <div class="mb-3">

                                <label class="form-label">State</label>

                                <input type="text" class="form-control" id="state" name="state" value="{{old('state', $shop->state)}}" autocomplete="state">
                                @error('state')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            </div>

                            <div class="col-6">

                            <div class="mb-3">

                                <label class="form-label">City <span class="text-danger">*</span></label>

                                <input type="text" class="form-control" id="city" name="city" value="{{old('city', $shop->city)}}" autocomplete="city">
                                @error('city')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>

                        <div class="col-6">

                            <div class="mb-3">

                                <label class="form-label">Zip code <span class="text-danger">*</span></label>

                                <input type="text" class="form-control" id="zip_code" name="zip_code" value="{{old('zip_code', $shop->zip_code)}}" >
                                @error('zip_code')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>

                        <div class="col-6">

                            <div class="mb-3">

                                <label class="form-label">Land Mark</label>

                                <input type="text" class="form-control" id="land_mark" name="land_mark"value="{{old('land_mark', $shop->land_mark)}}">
                                @error('land_mark')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>

                        <div class="col-6">

                            <div class="mb-3">

                                <label class="form-label">Time Zone <span class="text-danger">*</span></label>
                                <select id="selecttime"  name="time_zone" class="form-control" value="{{old('time_zone', $shop->time_zone)}}"></select>
                                @error('time_zone')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>

            </div>

        </div>



    </div>



</div>



</div>

@endsection



@push('js')
<script src="{{asset('layouts/time-zone/dist/timezones.full.js')}}"></script>
<script>

    $('#selecttime').timezones();



    // var f1 = flatpickr(document.getElementById('basicFlatpickr'));

    

</script>

@endpush