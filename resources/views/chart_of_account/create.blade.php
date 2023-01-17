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

                <li class="breadcrumb-item"><a href="#">Cart of Account</a></li>

                <!-- <li class="breadcrumb-item active" aria-current="page">Create</li> -->

            </ol>

        </nav>

        <div class="">

        <!-- <a class="btn btn-primary float-end" href="{{ route('chart_of_account.index') }}"> Back</a> -->

        </div>

        

    </div>



    <div class="row layout-top-spacing">

    

        <div class="col-xl-12 col-lg-12 col-sm-12">

            <div class="row widget-content widget-content-area">

                <div class="col-lg-8">
                  <ul id="tree1">
                    <li><a href="#" class="fs-4">Chart Of Account</a>

                      <ul>
                        @foreach($cartofaccounts as $coa)
                        <li class="fs-6 text-primary">{{$coa->name}}</li>
                          @if($coa->child)
                              <ul>
                                @foreach($coa->child as $coa2)
                                <li class="text-warning">@if($user_role == 3)<a href="javascript:void(0)" data-toggle="tooltip" onClick="editFunc({{ $coa2->id }})" data-original-title="Edit" class="edit text-info">@endif {{$coa2->name ?? ''}} @if($user_role == 3)</a>@endif</li>
                                  @if($coa2->child)
                                      <ul>
                                        @foreach($coa2->child as $coa3)
                                        <li class="text-info">{{$coa3->name ?? ''}}</li>
                                          @if($coa3->child)
                                              <ul>
                                                @foreach($coa3->child as $coa4)
                                                <li class="text-danger">{{$coa4->name ?? ''}}</li>
                                                @endforeach
                                              </ul>
                                          @endif
                                        @endforeach
                                      </ul>
                                  @endif
                                @endforeach
                              </ul>
                          @endif
                        @endforeach
                      </ul>
                    </li>
                  </ul>
                </div>
                @if($user_role == 3)
                <div class="col-lg-4">
                <form class="g-3" action="{{route('chart_of_account.store')}}" method="POST">

                    @csrf

                    <div class="form-group mb-3">

                        <label for="name" class="form-label">Account Head <span class="text-danger">*</span></label>

                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">

                    </div>

                    <div class="form-group mb-3">

                        <label for="parent_id" class="form-label">Parent Head <span class="text-danger">*</span></label>

                        <!-- <select name="parent_id" id="parent_id" class="form-control">
                            <option value="" disabled selected>Select Parent id</option>
                            
                            <option value="1" id="expense">Expense</option>
                            <option value="2">Income</option>
                        
                        </select> -->

                        <select class="form-control" name="parent_id" class="form-control">
                          <option value="">Select Sub-Category</option>
                          @foreach($cartofaccounts as $cartofaccount)
                          <option value="{{ $cartofaccount->id }}">{{ $cartofaccount->name }}</option>
                          @endforeach
                        </select>

                    </div>

                    <div class="form-group mb-3">

                        <label for="name" class="form-label">Opening Balance <span class="text-danger">*</span></label>

                        <input type="text" class="form-control" id="opening_balance" name="opening_balance" placeholder="Opening balance">

                    </div>

                    <div class="form-group">

                        <button type="submit" class="btn btn-primary">Create</button>

                    </div>

                </form>
                </div>
              @endif
                

            </div>

        </div>



    </div>



</div>



</div>
@include('chart_of_account.cartofmodal')
@endsection

@push('js')
<script>

    $.fn.extend({
    treed: function (o) {
      
      var openedClass = 'glyphicon-minus-sign';
      var closedClass = 'glyphicon-plus-sign';
      
      if (typeof o != 'undefined'){
        if (typeof o.openedClass != 'undefined'){
        openedClass = o.openedClass;
        }
        if (typeof o.closedClass != 'undefined'){
        closedClass = o.closedClass;
        }
      };
      
        //initialize each of the top levels
        var tree = $(this);
        tree.addClass("tree");
        tree.find('li').has("ul").each(function () {
            var branch = $(this); //li with children ul
            branch.prepend("<i class='indicator glyphicon " + closedClass + "'></i>");
            branch.addClass('branch');
            // branch.on('click', function (e) {
            //     if (this == e.target) {
            //         var icon = $(this).children('i:first');
            //         icon.toggleClass(openedClass + " " + closedClass);
            //         $(this).children().children().toggle();
            //     }
            // })
            // branch.children().children().toggle();
        });
        //fire event from the dynamically added icon
      tree.find('.branch .indicator').each(function(){
        $(this).on('click', function () {
            $(this).closest('li').click();
        });
      });
        //fire event to open branch if the li contains an anchor instead of text
        tree.find('.branch>a').each(function () {
            $(this).on('click', function (e) {
                $(this).closest('li').click();
                e.preventDefault();
            });
        });
        //fire event to open branch if the li contains a button instead of text
        tree.find('.branch>button').each(function () {
            $(this).on('click', function (e) {
                $(this).closest('li').click();
                e.preventDefault();
            });
        });
    }
});

//Initialization of treeviews

$('#tree1').treed();

$('#tree2').treed({openedClass:'glyphicon-folder-open', closedClass:'glyphicon-folder-close'});

$('#tree3').treed({openedClass:'glyphicon-chevron-right', closedClass:'glyphicon-chevron-down'});

$.ajaxSetup({

headers: {

'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

}

});
function editFunc(id){

$.ajax({

    type:"POST",

    url: "{{ route('chart_of_account.edit') }}",

    data: { id: id },

    dataType: 'json',

    success: function(res){

      console.log(res);

        $('#chartofaccLabel').html(res.name);

        $('#chartofaccModal').modal('show');

        $('#id').val(res.id);

        $('#account_name').val(res.name);

        $('#openingBalance').val(res.opening_balance);

    }

});

} 





$('#cartofaccForm').submit(function(e) {

e.preventDefault();

var formData = new FormData(this);



$.ajax({

    type:'POST',

    url: "{{ route('chart_of_account.update')}}",

    data: formData,

    cache:false,

    contentType: false,

    processData: false,

    success: (data) => {

    $("#chartofacc").modal('hide');

    var oTable = $('#shopify-products').dataTable();

    oTable.fnDraw(false);

    $("#btn-save").html('Submit');

    $("#btn-save"). attr("disabled", false);

    toastr.options =

        {

            "closeButton" : true,

            "progressBar" : true

        }

    toastr.success("Account Head Updated Successfully!");

    },

    error: function(data){

    console.log(data);

    },

});

});



</script>
@endpush