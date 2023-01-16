<!-- Modal -->

<div class="modal fade" id="shopifyModal" tabindex="-1" aria-labelledby="shopifyModalLabel" aria-hidden="true">

  <div class="modal-dialog modal-dialog-centered">

    <div class="modal-content" style="background:#fff;">

        <form action="javascript:void(0)" id="shopifyForm" name="shopifyForm" method="POST" enctype="multipart/form-data">

            <input type="hidden" name="id" id="id">

            <div class="modal-header">

                <h5 class="modal-title" id="shopifyModalLabel"></h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> 

            </div>

            <div class="modal-body row">

                <div class="col-md-12">

                                            <label for="regular_price" class="form-label">Regular Price</label>

                                            <input type="text" class="form-control" id="regular_price" name="regular_price">

                                        </div>

                                        <div class="col-md-12">

                                            <label for="price" class="form-label">Selling Price</label>

                                            <input type="text" class="form-control" id="price" name="price">

                                        </div>

                                        <div class="col-md-12">

                                            <label for="qty" class="form-label">Quantity</label>

                                            <input type="number" class="form-control" id="qty" name="qty">

                                        </div>

                                        <div class="col-md-12">

                                            <label for="barcode" class="form-label">Barcode</label>

                                            <input type="text" class="form-control" id="barcode" name="barcode">

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