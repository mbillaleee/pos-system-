<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

    <title>SignUp | WooTech</title>

    <link rel="icon" type="image/x-icon" href="{{asset('src/assets/img/favicon.ico')}}"/>

    <!-- <link href="{{asset('layouts/vertical-dark-menu/css/light/loader.css')}}" rel="stylesheet" type="text/css" /> -->

    <!-- <link href="{{asset('src/assets/css/dark/custom.css')}}" rel="stylesheet" type="text/css" /> -->

    <link href="{{asset('layouts/vertical-dark-menu/css/dark/loader.css')}}" rel="stylesheet" type="text/css" />

    <script src="{{asset('layouts/vertical-dark-menu/loader.js')}}"></script>


    

    

    <!-- BEGIN GLOBAL MANDATORY STYLES -->

    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">

    <link href="{{asset('src/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />

     <!-- BEGIN THEME GLOBAL STYLES -->
     <link href="{{asset('src/plugins/src/flatpickr/flatpickr.css')}}" rel="stylesheet" type="text/css">
     <!-- <link href="{{asset('src/plugins/css/light/flatpickr/custom-flatpickr.css')}}" rel="stylesheet" type="text/css"> -->
     <link href="{{asset('src/plugins/css/dark/flatpickr/custom-flatpickr.css')}}" rel="stylesheet" type="text/css">

    

    <!-- <link href="{{asset('layouts/vertical-dark-menu/css/light/plugins.css')}}" rel="stylesheet" type="text/css" /> -->

    <!-- <link href="{{asset('src/assets/css/light/authentication/auth-boxed.css')}}" rel="stylesheet" type="text/css" /> -->

    

    <link href="{{asset('layouts/vertical-dark-menu/css/dark/plugins.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('src/assets/css/dark/authentication/auth-boxed.css')}}" rel="stylesheet" type="text/css" />
    <!-- <link href="{{asset('layouts/collapsible-menu/css/light/loader.css')}}" rel="stylesheet" type="text/css" /> -->
    <!-- <link href="{{asset('layouts/collapsible-menu/css/dark/loader.css')}}" rel="stylesheet" type="text/css" /> -->
    <!-- <script src="{{asset('layouts/collapsible-menu/loader.js')}}"></script> -->
    <!-- <link href="{{asset('layouts/collapsible-menu/css/light/plugins.css')}}" rel="stylesheet" type="text/css" /> -->
    <!-- <link href="{{asset('layouts/collapsible-menu/css/dark/plugins.css')}}" rel="stylesheet" type="text/css" /> -->
    <!-- END GLOBAL MANDATORY STYLES -->
    
    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link rel="stylesheet" type="text/css" href="{{asset('src/plugins/src/stepper/bsStepper.min.css')}}">

    <!-- <link rel="stylesheet" type="text/css" href="{{asset('src/assets/css/light/scrollspyNav.css')}}"/> -->
    <!-- <link rel="stylesheet" type="text/css" href="{{asset('src/plugins/css/light/stepper/custom-bsStepper.css')}}"> -->

    <!-- <link rel="stylesheet" type="text/css" href="{{asset('src/assets/css/dark/scrollspyNav.css')}}"/> -->
    <link rel="stylesheet" type="text/css" href="{{asset('src/plugins/css/dark/stepper/custom-bsStepper.css')}}">

    <!-- END GLOBAL MANDATORY STYLES -->

    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- <style>
        
        .form-section{
            display: none;
        }

        .form-section.current{
            display: inline;
        }

        .parsley-errors-list{
            color: #fc0000;
        }
    </style> -->
    

</head>

<body class="form">

    <!-- BEGIN LOADER -->
    <div id="load_screen"> <div class="loader"> <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div></div></div>
    <!--  END LOADER -->

    <div class="auth-container d-flex">

        <div class="container mx-auto align-self-center">
    
            <div class="row">
    
                <div class="col-4 d-lg-flex d-none h-100 my-auto top-0 start-0 text-center justify-content-center flex-column">
                    <div class="auth-cover-bg-image"></div>
                    <div class="auth-overlay"></div>
                        
                    <div class="auth-cover">
    
                        <div class="position-relative">
    
                            <img src="../src/assets/img/auth-cover.svg" alt="auth-img">
                        </div>
                        
                    </div>

            </div>

            <div class="col-8 col-xl-8 col-lg-8 col-md-8 col-8 d-flex flex-column ms-lg-auto  mx-auto">
                    <div id="wizard_Default" class="col-lg-12 layout-spacing">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-content widget-content-area">
                                    <div class="bs-stepper stepper-form-one">
                                        <div class="bs-stepper-header" role="tablist">
                                            <div class="step" data-target="#defaultStep-one">
                                                <button type="button" class="step-trigger" role="tab" >
                                                    <span class="bs-stepper-circle">1</span>
                                                    <span class="bs-stepper-label">Business Information</span>
                                                </button>
                                            </div>
                                            <div class="line"></div>
                                            <div class="step" data-target="#defaultStep-two">
                                                <button type="button" class="step-trigger" role="tab"  >
                                                    <span class="bs-stepper-circle">2</span>
                                                    <span class="bs-stepper-label">Location</span>
                                                </button>
                                            </div>
                                            <div class="line"></div>
                                            <div class="step" data-target="#defaultStep-three">
                                                <button type="button" class="step-trigger" role="tab"  >
                                                    <span class="bs-stepper-circle">3</span>
                                                    <span class="bs-stepper-label">
                                                        <span class="bs-stepper-title">Owoner</span>
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="bs-stepper-content">
                                            <form action="{{route('register')}}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div id="defaultStep-one" class="content" role="tabpanel">
                                            
                                                        <div class="form-section row">

                                                            <div class="col-12">

                                                                <div class="mb-3">

                                                                    <label class="form-label">Business Name</label>

                                                                    <input type="text" class="form-control" name="business_name" id="business_name" value="{{ old('business_name') }}" required>


                                                                </div>

                                                            </div>

                                                            <div class="col-md-6">

                                                                <div class="mb-3">

                                                                    <label class="form-label">Start Dates</label>

                                                                    <!-- <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date') }}" > -->
                                                                    <input id="basicFlatpickr" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Select Date.." name="start_date">


                                                                </div>

                                                            </div>

                                                            <div class="col-md-6">

                                                                <div class="mb-3">

                                                                    <label class="form-label">Upload Logo</label>

                                                                    <input type="file" class="form-control" id="upload_logo" name="upload_logo" value="{{ old('upload_logo') }}" >


                                                                </div>

                                                            </div>

                                                            <div class="col-6">

                                                                <div class="mb-3">

                                                                    <label class="form-label">Courrency</label>

                                                                    @php
                                                                    $currencies = App\Models\Currency::all();
                                                                    @endphp

                                                                    <select name="currency" id="currency" class="form-control">
                                                                        <option value=""> Select Courrency</option>
                                                                        @foreach($currencies as $courrency)
                                                                        <option value="{{$courrency->id}}">{{$courrency->country}}</option>
                                                                        @endforeach
                                                                    </select>


                                                                </div>

                                                            </div>



                                                            <div class="col-6">

                                                                <div class="mb-3">

                                                                    <label class="form-label">Website</label>

                                                                    <input type="text" class="form-control" id="website"  name="website" value="{{ old('website') }}" >

                                                                </div>

                                                            </div>

                                                            <div class="col-6">

                                                                <div class="mb-3">

                                                                    <label class="form-label">Business Contact No</label>

                                                                    <input type="text" class="form-control" id="business_contact"  name="business_contact" value="{{ old('business_contact') }}">

                                                                </div>

                                                            </div>

                                                            <div class="col-6">

                                                                <div class="mb-3">

                                                                    <label class="form-label">Alternate Contact No</label>

                                                                    <input type="text" class="form-control" id="alternate_contact" name="alternate_contact" value="{{ old('alternate_contact') }}">

                                                                </div>

                                                            </div>

                                                            
                                                            
                                                        </div>
                                            
                                                    
                                                    <div class="button-action mt-5">
                                                        <button class="btn btn-secondary btn-prev me-3" disabled>Prev</button>
                                                        <button class="btn btn-secondary btn-nxt">Next</button>
                                                    </div>
                                                </div>
                                                <div id="defaultStep-two" class="content" role="tabpanel">

                                                        <div class="form-section row">
                                                            <div class="col-6">

                                                                <div class="mb-3">

                                                                    <label class="form-label">Country</label>

                                                                    <input type="text" class="form-control" id="country" name="country" value="{{ old('country') }}" autocomplete="country">

                                                                </div>

                                                            </div>

                                                            <div class="col-6">

                                                                <div class="mb-3">

                                                                    <label class="form-label">State</label>

                                                                    <input type="text" class="form-control" id="state" name="state" value="{{ old('state') }}" autocomplete="state">

                                                                </div>

                                                                </div>

                                                                <div class="col-6">

                                                                <div class="mb-3">

                                                                    <label class="form-label">City</label>

                                                                    <input type="text" class="form-control" id="city" name="city" value="{{ old('city') }}" autocomplete="city">

                                                                </div>

                                                            </div>

                                                            <div class="col-6">

                                                                <div class="mb-3">

                                                                    <label class="form-label">Zip code</label>

                                                                    <input type="text" class="form-control" id="zip_code" name="zip_code" value="{{ old('zip_code') }}" >

                                                                </div>

                                                            </div>

                                                            <div class="col-6">

                                                                <div class="mb-3">

                                                                    <label class="form-label">Land Mark</label>

                                                                    <input type="text" class="form-control" id="land_mark" name="land_mark" value="{{ old('land_mark') }}">

                                                                </div>

                                                            </div>

                                                            <div class="col-6">

                                                                <div class="mb-3">

                                                                    <label class="form-label">Time Zone</label>
                                                                    <select id="selecttime"  name="time_zone" class="form-control"></select>
                                                                </div>

                                                            </div>
                                                        </div>

                                                    
                                                    <div class="button-action mt-5">
                                                        <button class="btn btn-secondary btn-prev me-3">Prev</button>
                                                        <button class="btn btn-secondary btn-nxt">Next</button>
                                                    </div>
                                                </div>
                                                <div id="defaultStep-three" class="content" role="tabpanel" >
                                                
                                                        <div class="form-section row">
                                                                <div class="col-md-6">

                                                                    <div class="mb-3">

                                                                        <label class="form-label">First Name</label>

                                                                        <input type="text" class="form-control" name="fname" value="{{ old('fname') }}" autocomplete="fname" autofocus>



                                                                    </div>

                                                                </div>

                                                                <div class="col-md-6">

                                                                    <div class="mb-3">

                                                                        <label class="form-label">Last Name</label>

                                                                        <input type="text" class="form-control" name="lname" value="{{ old('lname') }}" autocomplete="lname" autofocus>

                                                                                                    

                                                                    </div>

                                                                </div>

                                                                <div class="col-md-6">

                                                                    <div class="mb-3">

                                                                        <label class="form-label">Uaername</label>

                                                                        <input type="text" class="form-control add-billing-address-input @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" autocomplete="username" autofocus>

                                                                                                        

                                                                    </div>
                                                                </div>

                                                                <div class="col-6">

                                                                    <div class="mb-3">

                                                                        <label class="form-label">Email</label>

                                                                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">

                                                                    

                                                                    </div>

                                                                </div>

                                                                <div class="col-6">

                                                                    <div class="mb-3">

                                                                        <label class="form-label">Phone</label>

                                                                        <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" autocomplete="phone">


                                                                    </div>

                                                                </div>

                                                                <div class="col-6">

                                                                    <div class="mb-3">

                                                                        <label class="form-label">Password</label>

                                                                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

                                                                    

                                                                    </div>

                                                                </div>

                                                                <div class="col-6">

                                                                    <div class="mb-3">

                                                                        <label class="form-label">Confirm Password</label>

                                                                        <input type="password" class="form-control"  name="password_confirmation" autocomplete="new-password">

                                                                    </div>
                                                                </div>
                                                        </div>
                                                
                                                

                                                    <div class="button-action mt-3">
                                                        <button class="btn btn-secondary btn-prev me-3">Prev</button>
                                                        <!-- <button class="btn btn-success me-3">Submit</button> -->
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                <div>
                    
                </div>
                </div>

                </div>
            </div>
                
        </div>
            
    </div>

    
    
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{asset('src/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- <script src="{{asset('src/plugins/src/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script> -->
    <!-- <script src="{{asset('src/plugins/src/mousetrap/mousetrap.min.js')}}"></script> -->
    <!-- <script src="{{asset('layouts/collapsible-menu/app.js')}}"></script> -->
    <!-- <script src="{{asset('src/plugins/src/highlight/highlight.pack.js')}}"></script> -->
    <!-- <script src="{{asset('src/assets/js/scrollspyNav.js')}}"></script> -->
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{asset('src/plugins/src/stepper/bsStepper.min.js')}}"></script>
    <script src="{{asset('src/plugins/src/stepper/custom-bsStepper.min.js')}}"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->


      <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{asset('src/plugins/src/flatpickr/flatpickr.js')}}"></script>

    <!-- <script src="{{asset('src/plugins/src/flatpickr/custom-flatpickr.js')}}"></script> -->
    <!-- END PAGE LEVEL SCRIPTS -->


    <!-- <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script> -->
    <script src="{{asset('layouts/time-zone/dist/timezones.full.js')}}"></script>



        <script>
        $('#selecttime').timezones();
    </script>

    <script>
         var f1 = flatpickr(document.getElementById('basicFlatpickr'));
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
    today = yyyy + '-' + mm + '-' + dd;
    
    //    console.log(today);
    document.getElementById('basicFlatpickr').value = today;

   
</script>

</body>

</html>