<!-- Modal -->
<div class="modal fade" id="shopifyApiModal" tabindex="-1" aria-labelledby="shopifyApiModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="background:#fff;">
        <form action="{{route('shopify.api.update')}}" id="shopifyApiForm" name="shopifyApiForm" method="POST">
            @csrf
            <input type="hidden" name="api_id" id="api_id" value="{{$shopify_api->id ?? ''}}">
            <div class="modal-header">
                <h5 class="modal-title" id="shopifyApiModalLabel">Shopify API</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body row">
                <div class="col-md-12 mb-2">
                    <label for="sku" class="form-label">Api <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="api" name="api" value="{{$shopify_api->api ?? ''}}">
                </div>
                <div class="col-md-12 mb-2">
                    <label for="sku" class="form-label">Password <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="password" name="password" value="{{$shopify_api->password ?? ''}}">
                </div>
                <div class="col-md-12">
                    <label for="sku" class="form-label">URL <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="url" name="url" value="{{$shopify_api->url ?? ''}}">
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