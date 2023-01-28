<!-- Modal -->

<div class="modal fade" id="catModal" tabindex="-1" aria-labelledby="catModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="background:#fff;">
        <form action="{{route('category.update')}}" id="catForm" name="catForm" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" id="id"> 
            <div class="modal-header">
                <h5 class="modal-title" id="catLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body row">
                <div class="col-md-12">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="account_name" name="name">
                </div>
                <div class="col-md-12">
                    <label for="parent_id" class="form-label">Parent Category</label>
                    <select name="parent_id" id="parent_id" class="form-control">
                        <option value="0">Select Parent Category</option>
                        @foreach($categories as $ccat)
                        <option value="{{$ccat->id}}">{{$ccat->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="btn-save">Update</button>
            </div>
        </form>
    </div>
  </div>
</div>