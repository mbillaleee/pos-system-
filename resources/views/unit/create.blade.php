@extends('admin')



@section('content')

<div class="layout-px-spacing">



<div class="middle-content container-xxl p-0">

    

    <!-- BREADCRUMB -->

    <div class="page-meta row">

        <nav class="breadcrumb-style-one float-start" aria-label="breadcrumb">

            <ol class="breadcrumb">

                <li class="breadcrumb-item"><a href="#">Unit</a></li>

                <li class="breadcrumb-item active" aria-current="page">Create</li>


            </ol>

        </nav>

        <div class="">

        <a class="btn btn-primary float-end" href="{{ route('brand.lists') }}"> Back</a>

        </div>

        

    </div>


    <div class="row layout-top-spacing">

    

        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">

            <div class="widget-content widget-content-area br-8 p-5">

                <form class="row g-3" action="{{route('unit.store')}}" method="POST">

                    @csrf

                    <div class="col-md-6 offset-md-3">

                    <div class="form-group mb-3">

                        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>

                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
                        @error('name')
                            <div class="error text-danger">{{ $message }}</div>
                        @enderror

                    </div>

                    <div class="form-group mb-3">

                        <label for="short_name" class="form-label">Short Name <span class="text-danger">*</span></label>

                        <input type="text" class="form-control" id="short_name" name="short_name" placeholder="Enter Short Name">

                    </div>

                    
                    <div class="col-12">

                        <button type="submit" class="btn btn-primary">Create</button>

                    </div>
                    </div>

                </form>

            </div>

        </div>



    </div>



</div>



</div>

@endsection