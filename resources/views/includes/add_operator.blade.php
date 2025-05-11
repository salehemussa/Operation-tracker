<!-- Add Operator Modal -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>

            <h4 class="modal-title"><b>Add Site</b></h4>
            <div class="modal-body">
                <div class="card-body text-left">
                    <form method="POST" action="{{ route('admin.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Site Name</label>
                            <input type="text" class="form-control" placeholder="Enter Operator Name" id="name" name="name" required />
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" placeholder="Enter Operator Email" id="email" name="email" required />
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-sm-3 control-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required />
                        </div>

                        <div class="form-group">
                            <div>
                                <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
                                <button type="reset" class="btn btn-secondary waves-effect m-l-5" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
