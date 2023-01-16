@extends('admin')



@section('content')

<div class="layout-px-spacing">



<div class="middle-content container-xxl p-0">

    

    <!-- BREADCRUMB -->

    <div class="page-meta row">

        <nav class="breadcrumb-style-one float-start" aria-label="breadcrumb">

            <ol class="breadcrumb">

                <li class="breadcrumb-item"><a href="#">Brand</a></li>

                <li class="breadcrumb-item active" aria-current="page">Create</li>

            </ol>

        </nav>

        <div class="">

        <a class="btn btn-primary float-end" href="{{ route('brand.create') }}"> Add Brand</a>

        </div>

        

    </div>

    <!-- /BREADCRUMB -->

    @php 

    $user_role = Auth::user()->user_role;

    @endphp

    <div class="row layout-top-spacing">

    

        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">

            <div class="widget-content widget-content-area br-8">

                <table id="zero-config" class="table table-striped dt-table-hover" style="width:100%">

                    <thead>

                        <tr>

                            <th>#</th>

                            <th>Name</th>
                            <th>Short Description</th>

                            @if($user_role == 3)

                            <th width="70px">Action</th>

                            @endif

                            

                        </tr>

                    </thead>

                    <tbody class="">

                    @foreach ($brands as $key => $brand)

                        <tr>

                            <td>{{$i++}}</td>

                            @if($user_role == 3)

                            <td>{{ $brand->name }}</td>
                            <td>{{ $brand->short_desc }}</td>

                            @endif
                            <td class="text-center">

                            <!-- <a class="btn btn-info" href="{{ route('brand.edit',$brand->id) }}">Show</a> -->

                            <a class="text-warning" href="{{ route('brand.edit',$brand->id) }}"><i class="fas fa-edit"></i></a>

                            <form class="d-inline" method="POST" action="{{route('brand.destroy', $brand->id)}}">

                                @method('delete')

                                @csrf

                                <button class="text-danger border-0 bg-transparent show_confirm" type="submit"><i class="fa-solid fa-trash-can"></i></button>

                            </form>

                            <!-- <a class="text-danger" href="{{ route('brand.destroy',$brand->id) }}"><i class="fa-solid fa-trash-can"></i></a> -->



                            </td>
                            

                        </tr>

                        @endforeach

                     

                    </tbody>

                    

                </table>

            </div>

        </div>



    </div>



</div>



</div>

@endsection

