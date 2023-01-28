@extends('admin')



@section('content')

<div class="layout-px-spacing">



<div class="middle-content container-xxl p-0">

    

    <!-- BREADCRUMB -->

    <div class="page-meta row">

        <nav class="breadcrumb-style-one float-start" aria-label="breadcrumb">

            <ol class="breadcrumb">

                <li class="breadcrumb-item"><a href="#">Users</a></li>

                <li class="breadcrumb-item active" aria-current="page">List</li>

            </ol>

        </nav>

        <div class="">

        <a class="btn btn-primary float-end" href="{{ route('users.create') }}"> Create New User</a>

        </div>

        

    </div>

    <!-- /BREADCRUMB -->

    @php 

    $user_role = Auth::user()->user_role;

    @endphp

    <div class="row layout-top-spacing">

    

        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">

            <div class="widget-content widget-content-area br-8">

                <table id="zero-config" class="table table-striped dt-table-hover user_datatable" style="width:100%">

                    <thead>

                        <tr>

                            <th>#</th>

                            <th>Photo</th>

                            <th>First Name</th>

                            <th>Last Name</th>

                            <th>Username</th>

                            @if($user_role == 3)

                            <th>Role</th>

                            @endif

                            <th>Phone</th>
                            <th>Email</th>

                            <th width="70px">Action</th>

                        </tr>

                    </thead>

                    <tbody>

                    @foreach ($data as $key => $user)

                        <tr>

                            <td>{{$i++}}</td>

                            <td>

                                <div class="d-flex">                                                        

                                    <div class="usr-img-frame me-2 rounded-circle">

                                        @if($user->image != null)

                                        <img alt="{{$user->name}}" class="img-fluid rounded-circle" src="{{asset('uploads/users/'.$user->image)}}" width="34">

                                        @else

                                        <img alt="avatar" class="img-fluid rounded-circle" src="{{asset('src/assets/img/user.png')}}" width="34">

                                        @endif

                                    </div>

                                    <!-- <p class="align-self-center mb-0 admin-name"> Tiger </p> -->

                                </div>

                            </td>

                            <td>{{ $user->fname }}</td>

                            <td>{{ $user->lname }}</td>

                            <td>{{ $user->username }}</td>

                            

                            @if($user_role == 3)

                            <th><label class="badge badge-success">@if($user->user_role ==  1) Admin @elseif ($user->user_role == 2) Sales User @endif</label></th>

                            @endif

                            <td>{{ $user->phone }}</td>

                            <td>{{ $user->email }}</td>

                            <td class="text-center">

                                <!-- <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Show</a> -->

                                <a class="text-warning" href="{{ route('users.edit',$user->id) }}"><i class="fas fa-edit"></i></a>

                                <form class="d-inline" method="POST" action="{{route('users.destroy', $user->id)}}">

                                    @method('delete')

                                    @csrf

                                    <button class="text-danger border-0 bg-transparent show_confirm" type="submit"><i class="fa-solid fa-trash-can"></i></button>

                                </form>

                                <!-- <a class="text-danger" href="{{ route('users.destroy',$user->id) }}"><i class="fa-solid fa-trash-can"></i></a> -->



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


@push('js')

<script>
    $(document).ready(function () {
        $('.user_datatable').DataTable({
            lengthMenu: [
            [25, 50, 100, 200, -1],
            [25, 50, 100, 200, "All"]
            ],
            dom: 'Bfrtip',
        buttons: [
            'pageLength',

            {

                extend: 'csvHtml5',

                exportOptions: {

                    columns: [0, 1, 2, 3, 4, 5, 6]

                },

            },

            {
                extend: 'pdf',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6]
                }
            },
            // 'csvHtml5',
            // 'pageLength'
        ],
        });
    });
</script>
@endpush

