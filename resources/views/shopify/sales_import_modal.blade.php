<!-- Modal -->
<div class="modal fade" id="shopifySaleImportModal" tabindex="-1" aria-labelledby="shopifySaleImportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="background:#fff;">
        <form action="{{ route('shopify.sales.import') }}" method="POST" enctype="multipart/form-data" id="shopifySaleImportForm">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="shopifySaleImportModalLabel">CSV Import</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body row">
                <div class="col-md-12 text-center">
                    <a href="{{asset('uploads/shopify_sales.csv')}}" download><h5 class="text-primary">Click for Example File</h5></a>
                </div>
                <div class="col-md-12">
                                            <label for="sku" class="form-label">Import CSV</label>
                                            <input type="file" accept=".csv" class="form-control" id="shopifysale_import" name="shopifysale_import">
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