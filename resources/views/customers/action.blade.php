
<a href="{{route('customers.edit',$id)}}" data-toggle="tooltip"  data-original-title="Edit" class="edit text-info">
<i class="fa-solid fa-pen-to-square"></i>
</a>

<form class="d-inline" method="POST" action="{{ route('customers.destroy', $id) }}">
@csrf
<input name="_method" type="hidden" value="DELETE">
<button type="submit" class="border-0 bg-transparent text-danger show_confirm" data-toggle="tooltip" title='Delete'><i class="fa-solid fa-trash-can"></i></button>
</form>