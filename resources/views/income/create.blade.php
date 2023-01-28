@extends('admin')

@section('content')
<div class="layout-px-spacing">
    <div class="middle-content container-xxl p-0">
        <!-- BREADCRUMB -->
        <div class="page-meta row">
            <nav class="breadcrumb-style-one float-start" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Income</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create</li>
                </ol>
            </nav>
            <div class="">
            <a class="btn btn-primary float-end" href="{{ url('income') }}"> Back</a>
            </div>
        </div>
        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-8 p-5">
                <form class="row g-3" action="{{route('income.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="col-md-6">
                        <label for="name" class="form-label">Reference No <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="reference_num" name="reference_num">
                    </div>

                    <div class="col-md-6"> 
                    <label for="address" class="form-label">Customer <span class="text-danger">*</span></label>
                        <select class="form-select" id="customer_id" name="customer_id" required>
                            <option selected disabled value="">Please Select</option>
                            @foreach($customers as $customer)
                            <option value="{{ $customer->id}}">{{ $customer->name}}</option>
                            @endforeach  
                        </select>
                    </div>

<!-- 
                    <div class="col-md-6">

                    <label for="address" class="form-label">Income type <span class="text-danger">*</span></label>
                        <select class="form-select" id="income_type" name="income_type" required>
                            <option selected disabled value="">Please Select</option>
                            @foreach($cartofacc as $cartofac)
                            <option value="{{ $cartofac->id}}">{{ $cartofac->name}}</option>
                            @endforeach  
                        </select>
                    </div> -->

                    <!-- <label for="address" class="form-label">Expense type <span class="text-danger">*</span></label>
                        <select class="form-select" id="expense_type" name="expense_type" required>
                            <option selected disabled value="">Please Select</option>
                            @foreach($cartofacc as $cartofac)
                            @if($cartofac->id != 5)
                            <option value="{{ $cartofac->id}}">{{ $cartofac->name}}</option>
                                @if($cartofac->child)
                                @foreach($cartofac->child as $cartofac2)
                                <option value="{{ $cartofac2->id}}">{{ $cartofac2->name}}</option>
                                    @if($cartofac2->cartofac3)
                                    @foreach($cartofac->child as $cartofac2)
                                    <option value="{{ $cartofac3->id}}">{{ $cartofac3->name}}</option>
                                    @endforeach
                                    @endif
                                @endforeach
                                @endif
                            @endif
                            @endforeach  
                        </select>
                    </div> -->

                    <div class="col-md-6">

                    <label for="address" class="form-label">Income type <span class="text-danger">*</span></label>
                    <select class="form-select" id="income_type" name="income_type" required>
                            <option selected disabled value="">Please Select</option>
                            @foreach($cartofacc as $cartofac)
                            @if($cartofac->id != 6)
                            <option value="{{ $cartofac->id}}">{{ $cartofac->name}}</option>
                                @if($cartofac->child)
                                @foreach($cartofac->child as $cartofac2)
                                <option value="{{ $cartofac2->id}}">{{ $cartofac2->name}}</option>
                                    @if($cartofac2->cartofac3)
                                    @foreach($cartofac->child as $cartofac2)
                                    <option value="{{ $cartofac3->id}}">{{ $cartofac3->name}}</option>
                                    @endforeach
                                    @endif
                                @endforeach
                                @endif
                            @endif
                            @endforeach  
                        </select>
                    </div>

                    <div class="col-md-6">
                    <label for="address" class="form-label">Payment Method <span class="text-danger">*</span></label>
                    <select class="form-control" onchange="bank_paymet(this.value)" id="payment_method" name="payment_method" style="width:100%" required>
                        <option  selected disabled>Select Type</option>
                        <option value="9">Cash</option>
                        <option value="10">Bank</option>
                    </select>
                    </div>

                    <div class="col-md-6">
                        <label for="image" class="form-label">Date <span class="text-danger">*</span></label>
                        <input id="basicFlatpickr" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Select Date.." name="date">
                        <!-- <input type="date" class="form-control" id="date" name="date"> -->
                    </div>
                    <div class="col-md-6">
                        <label for="att_document" class="form-label">Document <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" id="att_document" name="att_document">
                    </div>

                    <div class="col-md-6">
                        <label for="state" class="form-label">Total Amount <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="total_amount" name="total_amount">
                    </div>

                    <div class="col-md-6">
                        <label for="weight" class="form-label">Paid Amount <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="paid_amount" name="paid_amount">
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<script>
    $(document).ready(function () {

  $('#category_id').on('change', function () {
      var category_id = this.value;
      
      $.ajax({
          url: "{{url('product/getsubcategory')}}",
          type: "POST",
          data: {
                category_id: category_id,
              _token: '{{csrf_token()}}'
          },
          dataType: 'json',
          success: function (data) {
                $("#sub_category_id").html('');
              $('#sub_category_id').html('<option value="">Please Select</option>');
              $.each(data, function (key, value) {
                  $("#sub_category_id").append('<option value="' + value
                      .id + '">' + value.name + '</option>');
              });
          }
      });
  });
});

</script>

<script>
    var today = new Date();

    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!
    var yyyy = today.getFullYear();

    if(dd<10) {
        dd = '0'+dd
    }

    if(mm<10) {
        mm = '0'+mm
    }

    // today = yyyy + '/' + mm + '/' + dd;
    today = dd + '-' + mm + '-' + yyyy;

    //    console.log(today);
    document.getElementById('basicFlatpickr').value = today;
</script>
@endpush