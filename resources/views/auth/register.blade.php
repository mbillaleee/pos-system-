<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

    <title>SignUp | WooTech</title>

    <link rel="icon" type="image/x-icon" href="{{asset('src/assets/img/favicon.ico')}}"/>

    <link href="{{asset('layouts/vertical-dark-menu/css/light/loader.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('src/assets/css/dark/custom.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('layouts/vertical-dark-menu/css/dark/loader.css')}}" rel="stylesheet" type="text/css" />

    <script src="{{asset('layouts/vertical-dark-menu/loader.js')}}"></script>

    

    <!-- BEGIN GLOBAL MANDATORY STYLES -->

    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">

    <link href="{{asset('src/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />


    <link href="{{asset('src/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />

    

    <link href="{{asset('layouts/vertical-dark-menu/css/light/plugins.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('src/assets/css/light/authentication/auth-boxed.css')}}" rel="stylesheet" type="text/css" />

    

    <link href="{{asset('layouts/vertical-dark-menu/css/dark/plugins.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('src/assets/css/dark/authentication/auth-boxed.css')}}" rel="stylesheet" type="text/css" />

    <!-- END GLOBAL MANDATORY STYLES -->

    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>

   
    <style>
        
        /* .form-section{
            display: none;
        }

        .form-section.current{
            display: inline;
        }

        .parsley-errors-list{
            color: #fc0000;
        } */
    </style>
    

</head>

<body class="form md-5">



    <!-- BEGIN LOADER -->

    <div id="load_screen"> <div class="loader"> <div class="loader-content">

        <div class="spinner-grow align-self-center"></div>

    </div></div></div>

    <!--  END LOADER -->



    <div class="auth-container d-flex">



        <div class="container mx-auto align-self-center">

    

            <div class="row">
                <div class="col-lg-5">
                    <img src="{{asset('uploads/restora-pos.png')}}" alt="image" width="100%">
                </div>
                <div class="col-lg-7">

                        <!-- <div>
                            <label for="" class="nav-link shadow-sm step1 border ml-2">Step 1</label>
                            <label for="" class="nav-link shadow-sm step2 border ml-2">Step 2</label>
                            <label for="" class="nav-link shadow-sm step3 border ml-2">Step 3</label>
                        </div> -->
                        <div>
                            <form class="row md-5 shop-form" id="regForm" action="{{route('customer.store')}}" method="POST" enctype="multipart/form-data">
                            
                                @csrf

                                <div class="tab row">

                                    <div class="col-6">

                                        <div class="mb-3">

                                            <label class="form-label">Business Name</label>

                                            <input type="text" class="form-control" name="business_name" id="business_name" value="{{ old('business_name') }}" required>


                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="mb-3">

                                            <label class="form-label">Start Dates</label>

                                            <!-- <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date') }}"  required> -->
                                            <input id="basicFlatpickr" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Select Date.." name="purchase_date">


                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="mb-3">

                                            <label class="form-label">Upload Logo</label>

                                            <input type="file" class="form-control" id="upload_logo" name="upload_logo" value="{{ old('upload_logo') }}"  required>


                                        </div>

                                    </div>

                                    <div class="col-6">

                                        <div class="mb-3">

                                            <label class="form-label">Courrency</label>

                                            <!-- <input type="text" class="form-control" id="currency" name="currency" value="{{ old('currency') }}" required> -->
                                            <select name="" id="" class="form-control">
                                                <option value=""> Select Courrency</option>
                                                <option value="">Bangladesh (BDT)</option>
                                                <option value="">USA (Doler)</option>
                                                <option value="">India (Fupi)</option>
                                                <option value="">China (Yean)</option>
                                            </select>


                                        </div>

                                    </div>



                                    <div class="col-6">

                                        <div class="mb-3">

                                            <label class="form-label">Website</label>

                                            <input type="text" class="form-control" id="website"  name="website" value="{{ old('website') }}" required >

                                        </div>

                                    </div>

                                    <div class="col-6">

                                        <div class="mb-3">

                                            <label class="form-label">Business Contact No</label>

                                            <input type="text" class="form-control" id="business_contact"  name="business_contact" value="{{ old('business_contact') }}" required>

                                        </div>

                                    </div>

                                    <div class="col-6">

                                        <div class="mb-3">

                                            <label class="form-label">Alternate Contact No</label>

                                            <input type="text" class="form-control" id="alternate_contact" name="alternate_contact" value="{{ old('alternate_contact') }}" required>

                                        </div>

                                    </div>

                                    <div class="col-6">

                                        <div class="mb-3">

                                            <label class="form-label">Country</label>

                                            <input type="text" class="form-control" id="counntry" name="counntry" value="{{ old('counntry') }}" required autocomplete="counntry">

                                        </div>

                                    </div>

                                    <div class="col-6">

                                        <div class="mb-3">

                                            <label class="form-label">State</label>

                                            <input type="text" class="form-control" id="state" name="state" value="{{ old('state') }}" required autocomplete="state">

                                        </div>

                                    </div>

                                    <div class="col-6">

                                        <div class="mb-3">

                                            <label class="form-label">City</label>

                                            <input type="text" class="form-control" id="city" name="city" value="{{ old('city') }}" required autocomplete="city">

                                        </div>

                                        </div>

                                    <div class="col-6">

                                        <div class="mb-3">

                                            <label class="form-label">Zip code</label>

                                            <input type="text" class="form-control" id="zip_code" name="zip_code" value="{{ old('zip_code') }}" required >

                                        </div>

                                    </div>

                                    <div class="col-6">

                                        <div class="mb-3">

                                            <label class="form-label">Land Mark</label>

                                            <input type="text" class="form-control" id="land_mark" name="land_mark" value="{{ old('land_mark') }}" required>

                                        </div>

                                    </div>

                                    <div class="col-6">

                                        <div class="mb-3">

                                            <label class="form-label">Time Zone</label>

                                            <select name="" id="" class="form-control">
                                                <option value=""> Select Time zone</option>
                                                <option value="">+6</option>
                                                <option value="">+5</option>
                                                <option value="">+4</option>
                                                <option value="">+3</option>
                                            </select>

                                            <!-- <input type="text" class="form-control" id="time_zone" name="time_zone" value="{{ old('time_zone') }}" required > -->

                                        </div>

                                    </div>
                                    
                                </div>
                                <div class="tab row">
                                    <div class="col-md-6">

                                        <div class="mb-3">

                                            <label class="form-label">First Name</label>

                                            <input type="text" class="form-control" name="fname" value="{{ old('fname') }}" required autocomplete="fname" autofocus>



                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="mb-3">

                                            <label class="form-label">Last Name</label>

                                            <input type="text" class="form-control" name="lname" value="{{ old('lname') }}" required autocomplete="lname" autofocus>

                                                                        

                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="mb-3">

                                            <label class="form-label">Uaername</label>

                                            <input type="text" class="form-control add-billing-address-input @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                                                            

                                        </div>
                                    </div>

                                    <div class="col-6">

                                        <div class="mb-3">

                                            <label class="form-label">Email</label>

                                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                        

                                        </div>

                                    </div>

                                    <div class="col-6">

                                        <div class="mb-3">

                                            <label class="form-label">Phone</label>

                                            <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone">


                                        </div>

                                    </div>

                                    <div class="col-6">

                                        <div class="mb-3">

                                            <label class="form-label">Password</label>

                                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                        

                                        </div>

                                    </div>

                                    <div class="col-6">

                                        <div class="mb-3">

                                            <label class="form-label">Confirm Password</label>

                                            <input type="password" class="form-control"  name="password_confirmation" required autocomplete="new-password">

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->

    <!-- <script src="{{asset('src/bootstrap/js/bootstrap.bundle.min.js')}}"></script> -->

    <!-- END GLOBAL MANDATORY SCRIPTS -->









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
        today = dd + '-' + mm + '-' + yyyy;

        //    console.log(today);
        document.getElementById('basicFlatpickr').value = today;
    </script>


<!-- <script>
    $(function(){
        var $section = $('.form-section');

        function navigateTo(index){
            $section.removeClass('current').eq(index).addClass('current');

            $('.form-navigation .previous').toggle(index>0)
            var atTheEnd = index >= $section.length -1;
            $('.form-navigation .next').toggle(!atTheEnd)
            $('.form-navigation [type=submit]').toggle(!atTheEnd)
        }

        function curIndex(){
            return sections.index($section.filter('.current'));
        }

        $('.form-navigation .previous').click(function(){
            navigateTo(curIndex() - 1);
        });

        $('.form-navigation .next').click(function(){
            $('.shop-form').parseley().whenValidate({
                group: 'block-'+curIndex()
            }).done(function(){
                navigateTo(curIndex()+1);
            });
        });


    })
</script> -->

<!-- 
<script>
    $(document).ready(function(){

var current_fs, next_fs, previous_fs; //fieldsets
var opacity;
var current = 1;
var steps = $("fieldset").length;

setProgressBar(current);

$(".next").click(function(){

current_fs = $(this).parent();
next_fs = $(this).parent().next();

//Add Class Active
$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

//show the next fieldset
next_fs.show();
//hide the current fieldset with style
current_fs.animate({opacity: 0}, {
step: function(now) {
// for making fielset appear animation
opacity = 1 - now;

current_fs.css({
'display': 'none',
'position': 'relative'
});
next_fs.css({'opacity': opacity});
},
duration: 500
});
setProgressBar(++current);
});

$(".previous").click(function(){

current_fs = $(this).parent();
previous_fs = $(this).parent().prev();

//Remove class active
$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

//show the previous fieldset
previous_fs.show();

//hide the current fieldset with style
current_fs.animate({opacity: 0}, {
step: function(now) {
// for making fielset appear animation
opacity = 1 - now;

current_fs.css({
'display': 'none',
'position': 'relative'
});
previous_fs.css({'opacity': opacity});
},
duration: 500
});
setProgressBar(--current);
});

function setProgressBar(curStep){
var percent = parseFloat(100 / steps) * curStep;
percent = percent.toFixed();
$(".progress-bar")
.css("width",percent+"%")
}

$(".submit").click(function(){
return false;
})

});
</script> -->



</body>

</html>