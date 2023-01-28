@extends('admin')



@section('content')

<div class="layout-px-spacing">



<div class="middle-content container-xxl p-0">

    

    <!-- BREADCRUMB -->

    <div class="page-meta row">

        <nav class="breadcrumb-style-one float-start" aria-label="breadcrumb">

            <ol class="breadcrumb">

                <li class="breadcrumb-item"><a href="#">Users</a></li>

                <li class="breadcrumb-item active" aria-current="page">Create</li>

            </ol>

        </nav>

        <div class="">

        <a class="btn btn-primary float-end" href="{{ route('users.index') }}"> Back</a>

        </div>

        

    </div>



    <div class="row layout-top-spacing">

    

        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">

            <div class="widget-content widget-content-area br-8 p-5">

            <form class="row g-3" action="{{route('users.store')}}" method="POST" enctype="multipart/form-data">

                @csrf

                <div class="col-md-6">

                    <label for="name" class="form-label">First Name <span class="text-danger">*</span></label>

                    <input type="text" class="form-control" id="fname" name="fname">
                    @error('fname')
                        <div class="error text-danger">{{ $message }}</div>
                     @enderror

                </div>
                <div class="col-md-6">

                    <label for="name" class="form-label">Last Name <span class="text-danger">*</span></label>

                    <input type="text" class="form-control" id="lname" name="lname">
                    @error('lname')
                        <div class="error text-danger">{{ $message }}</div>
                    @enderror

                </div>

                <div class="col-md-6">

                    <label for="username" class="form-label">Username <span class="text-danger">*</span></label>

                    <input type="text" class="form-control" id="username" name="username">
                    @error('username')
                        <div class="error text-danger">{{ $message }}</div>
                    @enderror

                </div>

                <div class="col-md-6">

                    <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>

                    <input type="text" class="form-control" id="phone" name="phone">
                    @error('phone')
                        <div class="error text-danger">{{ $message }}</div>
                    @enderror

                </div>

                <div class="col-md-6">

                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>

                    <input type="email" class="form-control" id="email" name="email">
                    @error('email')
                        <div class="error text-danger">{{ $message }}</div>
                    @enderror

                </div>
                @if(Auth::user()->user_role == 1)
                <div class="col-md-6">

                    <label for="image" class="form-label">User Role <span class="text-danger">*</span></label>

                    <select class="form-select" id="user_role" name="user_role">
                        <option value="">Please Select</option>
                        <option value="2">Manager</option>
                        <option value="4">Sales Agent</option>
                    </select>
                    @error('user_role')
                        <div class="error text-danger">{{ $message }}</div>
                    @enderror

                </div>
                @endif
                <div class="col-md-6">

                    <label for="image" class="form-label">Photo</label>

                    <input type="file" class="form-control" id="image" name="image" style="border: none;">

                </div>

                <div class="col-md-6">

                    <label for="password" class="form-label">Password <span class="text-danger">*</span></label>

                    <input type="password" class="form-control" id="password" name="password">
                    @error('password')
                        <div class="error text-danger">{{ $message }}</div>
                    @enderror

                </div>

                <div class="col-md-6">

                    <label for="password" class="form-label">Confirm Password <span class="text-danger">*</span></label>

                    <input type="password" class="form-control" id="confirm_password" name="confirm-password">
                    

                </div>

                

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