<!-- Modal -->

<div class="modal fade" id="posminpriceModal" tabindex="-1" aria-labelledby="posminpriceModalLabel" aria-hidden="true">

  <div class="modal-dialog modal-dialog-centered">
 
    <div class="modal-content" style="background:#fff;">

        <form action="javascript:void(0)" id="posminpriceForm" name="posminpriceForm" method="POST" enctype="multipart/form-data">

            <input type="hidden" name="id" id="id">

            <div class="modal-header">

                <h5 class="modal-title" id="posminpriceModalLabel"></h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

                <div class="modal-body row">

                                        <div class="col-md-12">

                                            <label for="tsin" class="form-label">TSIN</label>

                                            <input type="text" class="form-control" id="tsin" name="tsin">

                                        </div>

                                        

                                        

            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                <button type="submit" class="btn btn-primary" id="posminprice-btn-save">Update</button>

            </div>

        </form>

    </div>

  </div>

</div>