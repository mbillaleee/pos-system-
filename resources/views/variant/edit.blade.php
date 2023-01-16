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

        <a class="btn btn-primary float-end" href="{{ route('brand.lists') }}"> Back</a>

        </div>

        

    </div>


    <div class="row layout-top-spacing">

    

        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">

            <div class="widget-content widget-content-area br-8 p-5">

                <form class="row g-3" action="{{route('variant.update',$variant->id)}}" method="POST">

                    @csrf

                    <div class="col-md-6 offset-md-3">

                    <div class="form-group mb-3">

                        <label for="name" class="form-label">Variation <span class="text-danger">*</span></label>

                        <input type="text" class="form-control" id="vari_name" name="vari_name" value="{{$variant->vari_name}}" placeholder="Enter Name">

                    </div>

                    <div class="form-group mb-3" >
                        <table class="table table-bordered mt-4" id="tbl_posts">
                            
                            <label for="name" class="form-label">Value <span class="text-danger">*</span></label>
                            <tbody id="sale_table">
                            @foreach($variant_value as $key=>$val)
                            <tr>
                                <td>
                                    <input type="text" class="form-control value_name" id="value_name" value="{{$val->value_name}}" name="value_name[]">
                                </td>
                                    @if($key==0)
                                    <td style="text-align: center;"><button type="button" class="addRow btn btn-success"><i class="fa fa-plus"></i> </button></td>
                                    @else
                                <td style="text-align: center;"><button type="button" class="btn btn-danger remove"><i class="fa fa-close"></i></button></td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                        
                    </table>
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

@endsection


@push('js')
<!-- <script src="{{ asset('assets/node_modules/jquery/dist/jquery.min.js') }}"></script> -->
    <script type="text/javascript">

        $('.addRow').on('click',function(){
            addRow();
        });
        function addRow() {
            var tr =  '<tr>'+
                '<td><input type="text" class="form-control value_name" id="value_name" name="value_name[]"></td>'+
                '<td style="text-align: center;"><button type="button" class="btn btn-danger remove"><i class="fa fa-close"></i></button></td>'+
                '</tr>';
            $('tbody').append(tr);
        };
        $('tbody').on('click','.remove',function() {
            var l = $('tbody tr').length;
            if(l==1) {
                alert('You can not remove last one');
            }else {
                $(this).parent().parent().remove();
            }
        });


    
    </script>

@endpush