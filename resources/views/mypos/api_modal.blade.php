<!-- Modal -->
<div class="modal fade" id="myposApiModal" tabindex="-1" aria-labelledby="myposApiModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="background:#fff;">
        <form action="{{route('mypos.api.update')}}" id="myposApiForm" name="myposApiForm" method="POST">
            @csrf
            <input type="hidden" name="api_id" id="api_id" value="{{$mypos_api->id ?? ''}}">
            <div class="modal-header">
                <h5 class="modal-title" id="myposApiModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body row">
                <div class="col-md-12">
                                            <label for="sku" class="form-label">Api Url</label>
                                            <input type="text" class="form-control" id="api_url" name="api_url" value="{{$mypos_api->api_url ?? ''}}">
                                        </div>
                                                                               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="btn-api-save">submit</button>
            </div>
        </form>
    </div>
  </div>
</div>