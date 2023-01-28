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

                <li class="breadcrumb-item"><a href="#">Calegory</a></li>

                <li class="breadcrumb-item active" aria-current="page">List</li>

            </ol>

        </nav>
@if($user_role != 3)
        <div class="">

        <a class="btn btn-primary float-end" href="{{ route('category.create') }}"> Add Category</a>

        </div>

        @endif

    </div>

    <!-- /BREADCRUMB -->
 

    <div class="row layout-top-spacing">
          <div class="col-xl-12 col-lg-12 col-sm-12">
              <div class="row widget-content widget-content-area">
                  <div class="col-lg-8">
                    <ul id="tree1" class="tree">
                      <!-- <li><a href="#" class="fs-4">Categories</a> -->
                        <ul>
                          @foreach($categories as $coa)
                          <li class="fs-6 text-primary"><a href="javascript:void(0)" data-toggle="tooltip" onClick="editFunc({{ $coa->id }})" data-original-title="Edit" class="edit text-primary">{{$coa->name}}</a><form class="d-inline" method="POST" action="{{route('category.destroy', $coa->id)}}">

@method('delete')

@csrf

<button class="text-danger border-0 bg-transparent show_confirm" type="submit"><i class="fa-solid fa-trash-can"></i></button>

</form></li>
                            @if($coa->child)
                                <ul>
                                  @foreach($coa->child as $coa2)
                                  <li class="text-warning"><a href="javascript:void(0)" data-toggle="tooltip" onClick="editFunc({{ $coa2->id }})" data-original-title="Edit" class="edit text-warning"> {{$coa2->name ?? ''}} </a><form class="d-inline" method="POST" action="{{route('category.destroy', $coa2->id)}}">

@method('delete')

@csrf

<button class="text-danger border-0 bg-transparent show_confirm" type="submit"><i class="fa-solid fa-trash-can"></i></button>

</form></li>
                                    @if($coa2->child)
                                        <ul>
                                          @foreach($coa2->child as $coa3)
                                          <!-- <li class="text-info">{{$coa3->name ?? ''}}</li> -->
                                          <li class="text-info"><a href="javascript:void(0)" data-toggle="tooltip" onClick="editFunc({{ $coa2->id }})" data-original-title="Edit" class="edit text-info"> {{$coa3->name ?? ''}} </a></li>
                                          @if($coa3->child)
                                          <ul>
                                            @foreach($coa3->child as $coa4)
                                            <!-- <li class="text-danger">{{$coa4->name ?? ''}}</li> -->
                                            <li class="text-danger"><a href="javascript:void(0)" data-toggle="tooltip" onClick="editFunc({{ $coa2->id }})" data-original-title="Edit" class="edit text-success"> {{$coa4->name ?? ''}} </a></li>
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
              </div>
          </div>
      </div>



</div>



</div>
@include('category.edit')
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
url: "{{ route('category.edit') }}",
data: { id: id },
dataType: 'json',

success: function(res){
  console.log(res);
    $('#catLabel').html(res.name);
    $('#catModal').modal('show');
    $('#id').val(res.id);
    $('#account_name').val(res.name);
    if(res.parent_id != 0){
        $('#parent_id option').attr('selected', false);
        $('#parent_id option[value="'+res.parent_id+'"]').attr('selected', true);
    }
}
});
} 

</script>
@endpush