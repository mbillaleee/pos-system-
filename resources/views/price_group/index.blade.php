@extends('admin')



@section('content')
@php 
$user_role = Auth::user()->user_role;
@endphp
<div class="layout-px-spacing">



<div class="middle-content container-xxl p-0">

    <!-- BREADCRUMB -->
    <div class="page-meta row">

        <nav class="breadcrumb-style-one float-start" aria-label="breadcrumb">

            <ol class="breadcrumb">

                <li class="breadcrumb-item"><a href="#">Price Group</a></li>

                <li class="breadcrumb-item active" aria-current="page">List</li>

            </ol>

        </nav>
    @if($user_role != 3)
        <div class="">

        <a class="btn btn-primary float-end" href="{{ route('price.group.create') }}"> Add Price Group</a>

        </div>

        @endif

    </div>

    <!-- /BREADCRUMB -->
 

    <div class="row layout-top-spacing">
          <div class="col-xl-12 col-lg-12 col-sm-12">
              <div class="row widget-content widget-content-area">
              <table id="priceGroup" class="table table-striped dt-table-hover brand_datatable" style="width:100%">

<thead>

    <tr>
        <th>#</th>
        <th>Name</th>
        <th class="text-center" width="150px">Action</th>
    </tr>

</thead>

<tbody class="">

@foreach ($price_group as $pg)

    <tr>

        <td>{{$i++}}</td>
        <td>{{ $pg->name }}</td>
        <td class="text-center">

        <a class="text-primary" href="{{ route('group_product_prices',$pg->id) }}"><i class="fas fa-eye"></i></a>

        <a class="text-warning" href="{{ route('price.group.edit',$pg->id) }}"><i class="fas fa-edit"></i></a>

        <form class="d-inline" method="POST" action="{{route('price.group.destroy', $pg->id)}}">

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




