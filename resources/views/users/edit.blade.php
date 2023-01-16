@extends('admin')



@section('content')

<div class="layout-px-spacing">



<div class="middle-content container-xxl p-0">

    

    <!-- BREADCRUMB -->

    <div class="page-meta row">

        <nav class="breadcrumb-style-one float-start" aria-label="breadcrumb">

            <ol class="breadcrumb">

                <li class="breadcrumb-item"><a href="#">Users</a></li>

                <li class="breadcrumb-item active" aria-current="page">Edit</li>

            </ol>

        </nav>

        <div class="">

        <a class="btn btn-primary float-end" href="{{ route('users.index') }}"> Back</a>

        </div>

        

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

                <form class="row g-3" method="POST" action="{{route('users.update', $user->id)}}">

                        @method('patch')

                        @csrf

                            <div class="col-md-6">

                                <label for="name" class="form-label">First Name <span class="text-danger">*</span></label>

                                <input type="text" class="form-control" value="{{$user->fname}}" id="fname" name="fname">

                            </div>

                            <div class="col-md-6">

                                <label for="name" class="form-label">Last Name <span class="text-danger">*</span></label>

                                <input type="text" class="form-control" value="{{$user->lname}}" id="lname" name="lname">

                            </div>

                            <div class="col-md-6">

                                <label for="username" class="form-label">Username <span class="text-danger">*</span></label>

                                <input type="text" class="form-control" value="{{$user->username}}" id="username" name="username">

                            </div>

                            <div class="col-md-6">

                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>

                                <input type="email" class="form-control" value="{{$user->email}}" id="email" name="email">

                            </div>

                            <div class="col-md-6">

                                <label for="name" class="form-label">Phone <span class="text-danger">*</span></label>

                                <input type="text" class="form-control" value="{{$user->phone}}" id="phone" name="phone">

                            </div>

                            @if(Auth::user()->user_role == 1)
                            <div class="col-md-6">

                                <label for="image" class="form-label">User Role</label>

                                <select class="form-select" id="user_role" name="user_role" required>
                                    <option value="">Please Select</option>
                                    <option value="2" {{$user->user_role == 2 ? 'selected' : ''}}>Manager</option>
                                    <option value="4" {{$user->user_role == 4 ? 'selected' : ''}}>Sales Agent</option>
                                </select>

                            </div>
                            @endif

                            <div class="col-md-6">

                                <label for="image" class="form-label">Photo</label>

                                <div class="row">

                                    <div class="col-sm-8">

                                    <input type="file" class="form-control" id="image" name="image" style="border: none;">

                                    </div>

                                    <div class="col-sm-4">

                                    @if($user->image != null)<img src="{{asset('uploads/users/'.$user->image)}}" width="80" alt="{{$user->name}}">@endif

                                    </div>

                                </div>

                                

                            </div>

                            <div class="col-md-6">

                                <label for="password" class="form-label">Password <span class="text-danger">*</span></label>

                                <input type="password" class="form-control" id="password" name="password">

                            </div>

                            <div class="col-md-6">

                                <label for="password" class="form-label">Confirm Password <span class="text-danger">*</span></label>

                                <input type="password" class="form-control" id="confirm_password" name="confirm-password">

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