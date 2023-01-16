@extends('admin')



@section('content')

<div class="layout-px-spacing">



<div class="middle-content container-xxl p-0">

    

    <!-- BREADCRUMB -->

    <div class="page-meta row">

        <nav class="breadcrumb-style-one float-start" aria-label="breadcrumb">

            <ol class="breadcrumb">

                <li class="breadcrumb-item"><a href="#">Calegory</a></li>

                <li class="breadcrumb-item active" aria-current="page">List</li>

            </ol>

        </nav>

        <div class="">

        <a class="btn btn-primary float-end" href="{{ route('category.create') }}"> Add Category</a>

        </div>

        

    </div>

    <!-- /BREADCRUMB -->

    @php 

    $user_role = Auth::user()->user_role;

    @endphp

    <div class="row layout-top-spacing">

    

        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">

            <div class="widget-content widget-content-area br-8">

                <table id="zero-config" class="table table-striped dt-table-hover brand_datatable" style="width:100%">

                    <thead>

                        <tr>

                            @if($user_role == 3)
                            <th>#</th>

                            <th>Name</th>
                            
                            <th width="70px">Action</th>
                            @endif

                        </tr>

                    </thead>

                    <tbody>

                    @foreach ($categories as $key => $category)

                        <tr>

                            @if($user_role == 3)
                            <td>{{$i++}}</td>

                            </td>

                            <td>{{ $category->name }}</td>

                            
                            <td class="text-center">

                                <!-- <a class="btn btn-info" href="{{ route('category.index',$category->id) }}">Show</a> -->

                                <a class="text-warning" href="{{ route('category.edit',$category->id) }}"><i class="fas fa-edit"></i></a>

                                <form class="d-inline" method="POST" action="{{route('category.destroy', $category->id)}}">

                                    @method('delete')

                                    @csrf

                                    <button class="text-danger border-0 bg-transparent show_confirm" type="submit"><i class="fa-solid fa-trash-can"></i></button>

                                </form>

                                <!-- <a class="text-danger" href="{{ route('category.destroy',$category->id) }}"><i class="fa-solid fa-trash-can"></i></a> -->



                            </td>
                            @endif

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
        $('.brand_datatable').DataTable({
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

