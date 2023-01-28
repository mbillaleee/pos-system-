<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

    <title>SignUp | WooTech</title>

    <link rel="icon" type="image/x-icon" href="{{asset('src/assets/img/favicon.ico')}}"/>

    <link href="{{asset('layouts/vertical-dark-menu/css/light/loader.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('layouts/vertical-dark-menu/css/dark/loader.css')}}" rel="stylesheet" type="text/css" />

    <script src="{{asset('layouts/vertical-dark-menu/loader.js')}}"></script>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->

    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">

    <link href="{{asset('src/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />

    

    <link href="{{asset('layouts/vertical-dark-menu/css/light/plugins.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('src/assets/css/light/authentication/auth-boxed.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('src/plugins/src/flatpickr/flatpickr.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('src/plugins/css/dark/flatpickr/custom-flatpickr.css')}}" rel="stylesheet" type="text/css">
    

    <link href="{{asset('layouts/vertical-dark-menu/css/dark/plugins.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('src/assets/css/dark/authentication/auth-boxed.css')}}" rel="stylesheet" type="text/css" />

    <!-- END GLOBAL MANDATORY STYLES -->

    

</head>

<body class="form">

<style>
    /*form styles*/
#msform {
    /* text-align: center; */
    position: relative;
    margin-top: 30px;
}

#msform fieldset {
    background: #060818;
    border: 0 none;
    border-radius: 8px;
    box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.4);
    padding: 20px 30px;
    box-sizing: border-box;
    width: 80%;
    margin: 0 10%;

    /*stacking fieldsets above each other*/
    position: relative;
}

/*Hide all except first fieldset*/
#msform fieldset:not(:first-of-type) {
    display: none;
}

/*inputs*/
#msform input, #msform textarea {
    padding: 15px;
    border-radius: 4px;
    margin-bottom: 10px;
    width: 100%;
    box-sizing: border-box;
    font-size: 13px;
}

#msform input:focus, #msform textarea:focus {
    -moz-box-shadow: none !important;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    border: 1px solid #2098ce;
    outline-width: 0;
    transition: All 0.5s ease-in;
    -webkit-transition: All 0.5s ease-in;
    -moz-transition: All 0.5s ease-in;
    -o-transition: All 0.5s ease-in;
}

/*buttons*/
#msform .action-button {
    width: 100px;
    background: #2098ce;
    font-weight: bold;
    color: white;
    border: 0 none;
    border-radius: 25px;
    cursor: pointer;
    padding: 10px 5px;
    margin: 10px 5px;
}

#msform .action-button:hover, #msform .action-button:focus {
    box-shadow: 0 0 0 2px white, 0 0 0 3px #2098ce;
}

#msform .action-button-previous {
    width: 100px;
    background: #aCbEd0;
    font-weight: bold;
    color: white;
    border: 0 none;
    border-radius: 25px;
    cursor: pointer;
    padding: 10px 5px;
    margin: 10px 5px;
}

#msform .action-button-previous:hover, #msform .action-button-previous:focus {
    box-shadow: 0 0 0 2px white, 0 0 0 3px #aCbEd0;
}

/*headings*/
.fs-title {
    font-size: 18px;
    text-transform: uppercase;
    color: #2C3E50;
    margin-bottom: 10px;
    letter-spacing: 2px;
    font-weight: bold;
}

.fs-subtitle {
    font-weight: normal;
    font-size: 13px;
    color: #666;
    margin-bottom: 20px;
}

/*progressbar*/
#progressbar {
    margin-bottom: 30px;
    overflow: hidden;
    /*CSS counters to number the steps*/
    counter-reset: step;
}

#progressbar li {
    list-style-type: none;
    color: #666;
    text-transform: uppercase;
    font-size: 9px;
    width: 33.33%;
    float: left;
    position: relative;
    letter-spacing: 1px;
    text-align:center;
}

#progressbar li:before {
    content: counter(step);
    counter-increment: step;
    width: 24px;
    height: 24px;
    line-height: 26px;
    display: block;
    font-size: 12px;
    color: #333;
    background: white;
    border-radius: 25px;
    margin: 0 auto 10px auto;
}

/*progressbar connectors*/
#progressbar li:after {
    content: '';
    width: 100%;
    height: 2px;
    background: white;
    position: absolute;
    left: -50%;
    top: 9px;
    z-index: -1; /*put it behind the numbers*/
}

#progressbar li:first-child:after {
    /*connector not needed before the first step*/
    content: none;
}

/*marking active/completed steps blue*/
/*The number of the step and the connector before it = blue*/
#progressbar li.active:before, #progressbar li.active:after {
    background: #2098ce;
    color: white;
}

</style>

    <!-- BEGIN LOADER -->

    <div id="load_screen"> <div class="loader"> <div class="loader-content">

        <div class="spinner-grow align-self-center"></div>

    </div></div></div>

    <!--  END LOADER -->



    <div class="auth-container d-flex">



        <div class="container mx-auto align-self-center">

    

            <div class="row">

    

                <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-8 col-12 d-flex flex-column align-self-center mx-auto">

                    <div class="card mt-3 mb-3" style="min-height:640px;">

                        <div class="card-body">

                           <!-- MultiStep Form -->
                            <div class="row">
                                <div class="col-md-12">
                                    <form id="msform" action="{{route('register')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <!-- progressbar -->
                                        <ul id="progressbar">
                                            <li class="active">Personal Details</li>
                                            <li>Social Profiles</li>
                                            <li>Account Setup</li>
                                        </ul>
                                        <!-- fieldsets -->
                                        <fieldset>
                                            <div class="form-section row">

                                                <div class="col-12">

                                                    <div class="mb-3">

                                                        <label class="form-label">Business Name <span class="text-danger">*</span></label>

                                                        <input type="text" class="form-control" name="business_name" id="business_name" value="{{ old('business_name') }}">
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
                                                        <input id="basicFlatpickr" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Select Date.." name="start_date">
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

                                                        <input type="file" class="form-control" id="upload_logo" name="upload_logo" value="{{ old('upload_logo') }}" >
                                                        @error('upload_logo')
                                                            <span class="text-danger" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>

                                                </div>

                                                <div class="col-6">

                                                    <div class="mb-3">

                                                        <label class="form-label">Currency <span class="text-danger">*</span></label>

                                                        @php
                                                        $currencies = App\Models\Currency::all();
                                                        @endphp

                                                        <select name="currency" id="currency" class="form-control">
                                                            <option value="">Select Currency</option>
                                                            @foreach($currencies as $currency)
                                                            <option value="{{$currency->id}}">{{$currency->country.' - '.$currency->currency_name.' - '.$currency->currency_code}}</option>
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

                                                        <input type="text" class="form-control" id="website"  name="website" value="{{ old('website') }}" >
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

                                                        <input type="text" class="form-control" id="business_contact"  name="business_contact" value="{{ old('business_contact') }}">
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

                                                        <input type="text" class="form-control" id="alternate_contact" name="alternate_contact" value="{{ old('alternate_contact') }}">
                                                        @error('alternate_contact')
                                                            <span class="text-danger" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>

                                                </div>

                                            </div>
                                        <input type="button" name="next" class="next action-button" value="Next"/>
                                        </fieldset>
                                        <fieldset>
                                            <div class="form-section row">
                                                <div class="col-6">

                                                    <div class="mb-3">

                                                        <label class="form-label">Country <span class="text-danger">*</span></label>

                                                        <input type="text" class="form-control" id="country" name="country" value="{{ old('country') }}" autocomplete="country">
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

                                                        <input type="text" class="form-control" id="state" name="state" value="{{ old('state') }}" autocomplete="state">
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

                                                        <input type="text" class="form-control" id="city" name="city" value="{{ old('city') }}" autocomplete="city">
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

                                                        <input type="text" class="form-control" id="zip_code" name="zip_code" value="{{ old('zip_code') }}" >
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

                                                        <input type="text" class="form-control" id="land_mark" name="land_mark" value="{{ old('land_mark') }}">
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
                                                        <select id="selecttime"  name="time_zone" class="form-control"></select>
                                                        @error('time_zone')
                                                            <span class="text-danger" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>

                                                </div>
                                            </div>
                                            <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                                            <input type="button" name="next" class="next action-button" value="Next"/>
                                        </fieldset>
                                        <fieldset>
                                            <div class="form-section row">
                                                <div class="col-md-6">

                                                    <div class="mb-3">

                                                        <label class="form-label">First Name <span class="text-danger">*</span></label>

                                                        <input type="text" class="form-control" name="fname" value="{{ old('fname') }}" autocomplete="fname" autofocus>
                                                        @error('fname')
                                                            <span class="text-danger" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror


                                                    </div>

                                                </div>

                                                <div class="col-md-6">

                                                    <div class="mb-3">

                                                        <label class="form-label">Last Name <span class="text-danger">*</span></label>

                                                        <input type="text" class="form-control" name="lname" value="{{ old('lname') }}" autocomplete="lname" autofocus>
                                                        @error('lname')
                                                            <span class="text-danger" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                                                    

                                                    </div>

                                                </div>

                                                <div class="col-md-6">

                                                    <div class="mb-3">

                                                        <label class="form-label">Username <span class="text-danger">*</span></label>

                                                        <input type="text" class="form-control add-billing-address-input @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" autocomplete="username" autofocus>

                                                        @error('username')
                                                            <span class="text-danger" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror                      

                                                    </div>
                                                </div>

                                                <div class="col-6">

                                                    <div class="mb-3">

                                                        <label class="form-label">Email <span class="text-danger">*</span></label>

                                                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">

                                                        @error('email')
                                                            <span class="text-danger" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>

                                                </div>

                                                <div class="col-6">

                                                    <div class="mb-3">

                                                        <label class="form-label">Phone</label>

                                                        <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" autocomplete="phone">
                                                        @error('phone')
                                                            <span class="text-danger" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>

                                                </div>

                                                <div class="col-6">

                                                    <div class="mb-3">

                                                        <label class="form-label">Password <span class="text-danger">*</span></label>

                                                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

                                                        @error('password')
                                                            <span class="text-danger" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>

                                                </div>

                                                <div class="col-6">

                                                    <div class="mb-3">

                                                        <label class="form-label">Confirm Password <span class="text-danger">*</span></label>

                                                        <input type="password" class="form-control"  name="password_confirmation" autocomplete="new-password">

                                                    </div>
                                                </div>
                                            </div>
                                            <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                                            <input type="submit" name="submit" class="submit action-button" value="Submit"/>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>


                            </div>

                            

                        </div>

                    </div>

                </div>

                

            </div>

            

        </div>



    </div>

    

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->

    <!-- <script src="{{asset('src/bootstrap/js/bootstrap.bundle.min.js')}}"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script src="{{asset('src/plugins/src/flatpickr/flatpickr.js')}}"></script>
<script src="{{asset('layouts/time-zone/dist/timezones.full.js')}}"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

<script>
    $('#selecttime').timezones();

    var f1 = flatpickr(document.getElementById('basicFlatpickr'));

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
<script>
    
//jQuery time
var current_fs, next_fs, previous_fs; //fieldsets
var left, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches

$(".next").click(function(){
	if(animating) return false;
	animating = true;
	
	current_fs = $(this).parent();
	next_fs = $(this).parent().next();
	
	//activate next step on progressbar using the index of next_fs
	$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
	
	//show the next fieldset
	next_fs.show(); 
	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
		step: function(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale current_fs down to 80%
			scale = 1 - (1 - now) * 0.2;
			//2. bring next_fs from the right(50%)
			left = (now * 50)+"%";
			//3. increase opacity of next_fs to 1 as it moves in
			opacity = 1 - now;
			current_fs.css({
        'transform': 'scale('+scale+')',
        'position': 'absolute'
      });
			next_fs.css({'left': left, 'opacity': opacity});
		}, 
		duration: 800, 
		complete: function(){
			current_fs.hide();
			animating = false;
		}, 
		//this comes from the custom easing plugin
		easing: 'easeInOutBack'
	});
});

$(".previous").click(function(){
	if(animating) return false;
	animating = true;
	
	current_fs = $(this).parent();
	previous_fs = $(this).parent().prev();
	
	//de-activate current step on progressbar
	$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
	
	//show the previous fieldset
	previous_fs.show(); 
	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
		step: function(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale previous_fs from 80% to 100%
			scale = 0.8 + (1 - now) * 0.2;
			//2. take current_fs to the right(50%) - from 0%
			left = ((1-now) * 50)+"%";
			//3. increase opacity of previous_fs to 1 as it moves in
			opacity = 1 - now;
			current_fs.css({'left': left});
			previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
		}, 
		duration: 800, 
		complete: function(){
			current_fs.hide();
			animating = false;
		}, 
		//this comes from the custom easing plugin
		easing: 'easeInOutBack'
	});
});

// $(".submit").click(function(){
// 	return false;
// })
</script>


</body>

</html>