<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Reset Password | WooTech</title>
    <link rel="icon" type="image/x-icon" href="{{asset('src/assets/img/favicon.ico')}}"/>
    <link href="{{asset('layouts/vertical-dark-menu/css/light/loader.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('layouts/vertical-dark-menu/css/dark/loader.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{asset('layouts/vertical-dark-menu/loader.js')}}"></script>
    
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{asset('src/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    
    <link href="{{asset('layouts/vertical-dark-menu/css/light/plugins.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('src/assets/css/light/authentication/auth-boxed.css')}}" rel="stylesheet" type="text/css" />
    
    <link href="{{asset('layouts/vertical-dark-menu/css/dark/plugins.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('src/assets/css/dark/authentication/auth-boxed.css')}}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    
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
    
                <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-8 col-12 d-flex flex-column align-self-center mx-auto">
                    <div class="card mt-3 mb-3">
                        <div class="card-body">
                            <form action="{{ route('password.update') }}" method="post">
                                @csrf
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    
                                    <h2>Reset Password</h2>
                                    
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Confirm Password</label>
                                        <input type="password" class="form-control"  name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>
                                
                                <div class="col-12">
                                    <div class="mb-4">
                                        <button class="btn btn-secondary w-100" type="submit">Reset Password</button>
                                    </div>
                                </div>
                                
                                <div class="col-12">
                                    <div class="text-center">
                                        <p class="mb-0"><a href="{{url('/')}}" class="text-warning">Sign in</a></p>
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
    <script src="{{asset('src/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

</body>
</html>