<!-- Modal -->

<div class="modal fade" id="chartofaccModal" tabindex="-1" aria-labelledby="chartofaccModalLabel" aria-hidden="true">

  <div class="modal-dialog modal-dialog-centered">

    <div class="modal-content" style="background:#fff;">

        <form action="javascript:void(0)" id="cartofaccForm" name="cartofaccForm" method="POST" enctype="multipart/form-data">

            <input type="hidden" name="id" id="id">

            <div class="modal-header">

                <h5 class="modal-title" id="chartofaccLabel"></h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="modal-body row">

                <div class="col-md-12">

                    <label for="name" class="form-label">Account Head</label>

                    <input type="text" class="form-control" id="account_name" name="name">

                </div>

                <div class="col-md-12">

                    <label for="opening_balance" class="form-label">Opening Balance</label>

                    <input type="number" class="form-control" id="openingBalance" name="opening_balance">

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