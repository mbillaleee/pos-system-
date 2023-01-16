<!-- Modal -->
<div class="modal fade" id="myposModal" tabindex="-1" aria-labelledby="myposModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="background:#fff;">
        <form action="javascript:void(0)" id="myposForm" name="myposForm" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" id="id">
            <div class="modal-header">
                <h5 class="modal-title" id="myposModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body row">
                <div class="col-md-12">
                
                                            <label for="tsin" class="form-label">TSIN</label>
                                            <!-- <input type="text" id="tsin" name="tsin"> -->
                                            <input type="text" name="tsin" id="tsin" class="form-control" />
                                            <!-- <input type="text" 
                                                data-role="tagsinput" class="form-control" value=""> -->
                                            <!-- <input class="js-tag-input" name="tsin" placeholder="Enter new tag..." id="tsin"/> -->
                                        </div>
                                        <div class="col-md-12">
                                            <label for="rack_no" class="form-label">Rack Number</label>
                                            <input type="text" class="form-control" id="rack_no" name="rack_no">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="code" class="form-label">Barcode</label>
                                            <input type="text" class="form-control" id="code" name="code">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="price" class="form-label">Selling Price</label>
                                            <input type="text" class="form-control" id="price" name="price">
                                        </div>
                                        
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="mypos-btn-save">Update</button>
            </div>
        </form>
    </div>
  </div>
</div>