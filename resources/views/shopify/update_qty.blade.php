@extends('admin')

@section('content')
<div class="layout-px-spacing">

<div class="middle-content container-xxl p-0">
    
    <!-- BREADCRUMB -->
    <div class="page-meta row">
        <nav class="breadcrumb-style-one float-start" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Update Quantity</li>
            </ol>
        </nav>
    </div>

    <div class="row layout-top-spacing">
    
        <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
            <div class="widget-content widget-content-area br-8">
        
               <div class="row">
                <div class="col-md-12 text-center">
                    <h3>Update Qty From Pos Data is Barcode match</h3>
                <a id="updateBtn" class="btn btn-primary m-5" href="{{route('shopify.qty')}}">Update Quantity Now</a>
                </div>
               </div>
                
                
            </div>
        </div>

    </div>

</div>

</div>
@endsection

@push('js')
<script>
$(document).ready(function () {
    $("#updateBtn").click(function () {
            $("#updateBtn").text(($("#updateBtn").text() == 'Update Quantity Now') ? 'Please Wait...' : 'Update Quantity Now');
    })
});
</script>
@endpush