<!-- Modal -->
<div class="modal fade" id="takealotModal" tabindex="-1" aria-labelledby="takealotModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="background:#fff;">
        <form action="javascript:void(0)" id="takealotForm" name="takealotForm" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" id="id">
            <div class="modal-header">
                <h5 class="modal-title" id="takealotModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body row">
                <div class="col-md-12">
                                            <label for="sku" class="form-label">SKU</label>
                                            <input type="text" class="form-control" id="sku" name="sku">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="rrp" class="form-label">RRP</label>
                                            <input type="text" class="form-control" id="rrp" name="rrp">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="quantity" class="form-label">Quantity</label>
                                            <input type="number" class="form-control" id="quantity" name="quantity">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="selling_price" class="form-label">Selling Price</label>
                                            <input type="text" class="form-control" id="selling_price" name="selling_price">
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