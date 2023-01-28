@extends('admin')



@section('content')

<div class="layout-px-spacing">



<div class="middle-content container-xxl p-0">

    

    <!-- BREADCRUMB -->

    <div class="page-meta row">

        <nav class="breadcrumb-style-one float-start" aria-label="breadcrumb">

            <ol class="breadcrumb">

                <li class="breadcrumb-item"><a href="#">Variant</a></li>

                <li class="breadcrumb-item active" aria-current="page">Create</li>

            </ol>

        </nav>

        <div class="">

       
            <a class="btn btn-primary float-end" href="{{ route('variant.create') }}"> Add Variant</a>

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

                            <th>Variant</th>
                            <th>Attribute</th>

                            @if($user_role == 1)

                            <th width="70px">Action</th>

                            @endif

                            

                        </tr>

                    </thead>
                    <tbody>
                        @foreach($variants as $variant)
                        @php 
                        $variant_val = App\Models\Value::where('variants_id',$variant->id)->get();
                        @endphp
 
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{ $variant->vari_name }}</td>
                            <td>
                                @if(isset($variant_val))
                                @foreach($variant_val as $vval)
                                <span>{{$vval->value_name}}<span>,
                                @endforeach
                                @endif
                            </td>
                            <td>
                            <a class="text-warning" href="{{ route('variant.edit',$variant->id) }}"><i class="fas fa-edit"></i></a>
                            <!-- <a class="text-warning" href="{{ route('variant.destroy',$variant->id) }}"><i class="fas fa-delete">del</i></a> -->
                            <form class="d-inline" method="POST" action="{{ route('variant.destroy',$variant->id) }}">

                                @method('delete')

                                @csrf

                                <button class="text-danger border-0 bg-transparent show_confirm" type="submit"><i class="fa-solid fa-trash-can"></i></button>

                            </form>
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

