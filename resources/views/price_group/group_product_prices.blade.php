@extends('admin')



@section('content')

<div class="layout-px-spacing">
<div class="middle-content container-xxl p-0">

    

    <!-- BREADCRUMB -->

    <div class="page-meta row">

        <nav class="breadcrumb-style-one float-start" aria-label="breadcrumb">

            <ol class="breadcrumb">

                <li class="breadcrumb-item"><a href="#">Group Product Prices</a></li>

                <li class="breadcrumb-item active" aria-current="page">{{$price_group->name}}</li>

            </ol>

        </nav>

        <div class="">

        <a class="btn btn-primary float-end" href="{{ route('price.group') }}"> Back</a>

        </div>

        

    </div>



    <div class="row layout-top-spacing">

    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">

<div class="widget-content widget-content-area br-8 p-5">

<table id="groupProductPrice" class="table table-striped dt-table-hover brand_datatable" style="width:100%">

<thead>

    <tr>
        <th>#</th>
        <th>Product Name</th>
        <th>Price</th>
        <th class="text-center" width="150px">Action</th>
    </tr>

</thead>

<tbody id="price_group">

@foreach ($products as $pt)
    <tr>
        <td width="30">{{$pt->id}}</td>
        <td>{{ $pt->name }}</td>
        <td>
            @php 
            $group_price = App\Models\GroupProductPrice::where('price_group_id',$price_group->id)->where('product_id',$pt->id)->first();
            @endphp
            <input type="hidden" class="form-control price_group_id" value="{{$price_group->id}}" name="price_group_id">
            <input type="hidden" class="form-control product_id" value="{{$pt->id}}" name="product_id">
            <input type="hidden" class="form-control group_product_prices_id" value="{{$group_price->id ?? ''}}">
            <input type="text" class="form-control price" name="price" value="{{$group_price->price ?? ''}}" placeholder="Enter Price" required>
        </td>
        <td class="text-center">
            <button class="btn btn-danger price_group_remove" style="@if(!isset($group_price)) display:none; @endif"><i class="fas fa-close"></i></button>
            <button class="btn btn-primary price_group_submit" style="@if(isset($group_price)) display:none; @endif"><i class="fas fa-check"></i></button>
        </td>
    </tr>
    @endforeach

 

</tbody>



</table>

</div>





</div>

@endsection
@push('js')
<script>
$('#groupProductPrice').DataTable();

$('#price_group').delegate('.price_group_submit','click', function(){
            var tr = $(this).parent().parent();
            var price_group_id = tr.find('.price_group_id').val();
            var price = tr.find('.price').val();
            var product_id = tr.find('.product_id').val();
            
            $.ajax({
                type:"POST",
                url:"{{route('group_product_prices.update')}}",
                dataType: 'json',
                data: {
                    price_group_id:price_group_id,
                    price:price,
                    product_id:product_id,
                    _token: '{{csrf_token()}}'
                },
                success:function (data) {
                    console.log(data);
                    if(data == 'price_empty'){
                        toastr.options =
                        {
                            "closeButton": true,
                            "progressBar": true,
                        }
                        toastr.error("Group Product Price is empty!");
                    }else{
                        tr.find('.price_group_submit').hide();
                        tr.find('.price_group_remove').show();
                        tr.find('.group_product_prices_id').val(data.id);
                        toastr.options =
                        {
                            "closeButton": true,
                            "progressBar": true,
                        }
                        toastr.success("Group Product Price Updated Successfully!");
                    }

                }

            });

});

$('#price_group').delegate('.price_group_remove','click', function(){
            var tr = $(this).parent().parent();
            var group_product_prices_id = tr.find('.group_product_prices_id').val();
            
            $.ajax({
                type:"POST",
                url:"{{route('group_product_prices.delete')}}",
                dataType: 'json',
                data: {
                    group_product_prices_id:group_product_prices_id,
                    _token: '{{csrf_token()}}'
                },
                success:function (data) {
                    console.log(data);
                    
                    if(data == 'success'){
                        tr.find('.price_group_remove').hide();
                        tr.find('.price_group_submit').show();
                        tr.find('.price').val('');
                        tr.find('.group_product_prices_id').val('');
                        toastr.options =
                        {
                            "closeButton": true,
                            "progressBar": true,
                        }
                        toastr.success("Group Product Price Deleted Successfully!");
                    }else if(data == 'data_empty'){
                        toastr.options =
                        {
                            "closeButton": true,
                            "progressBar": true,
                        }
                        toastr.error("Group Product Price not exist!");
                    }

                }

            });

});
</script>

@endpush