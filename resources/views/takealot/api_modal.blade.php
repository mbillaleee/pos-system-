<!-- Modal -->
<div class="modal fade" id="takealotApiModal" tabindex="-1" aria-labelledby="takealotApiModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="background:#fff;">
        <form action="{{route('takealot.api.update')}}" id="takealotApiForm" name="takealotApiForm" method="POST">
            @csrf
            <input type="hidden" name="api_id" id="api_id" value="{{$takealot_api->id ?? ''}}">
            <div class="modal-header">
                <h5 class="modal-title" id="takealotApiModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body row">
                <div class="col-md-12">
                                            <label for="sku" class="form-label">Api Key</label>
                                            <input type="text" class="form-control" id="api_key" name="api_key" value="{{$takealot_api->api_key ?? ''}}">
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