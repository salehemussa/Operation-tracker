<!-- Add Modal -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><b>Add Inventory</b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form method="POST" action="{{ route('inventory.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="name">name</label>
                        <input type="text" class="form-control" id="quantity" name="name" placeholder="Enter name" required />
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Enter Quantity" required />
                    </div>

                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                            Submit
                        </button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
