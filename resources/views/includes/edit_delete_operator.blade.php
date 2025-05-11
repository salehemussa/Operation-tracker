
<!-- Edit Modal -->
<div class="modal fade" id="edit{{ $operator->id }}" tabindex="-1" role="dialog" aria-labelledby="editLabel{{ $operator->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editLabel{{ $operator->id }}">Edit operator</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" method="POST" action="{{ route('operator.update', $operator->name) }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name-{{ $operator->id }}" class="control-label">Name</label>
                        <input type="text" class="form-control" id="name-{{ $operator->id }}" name="name" value="{{ $operator->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="position-{{ $operator->id }}" class="control-label">Position</label>
                        <input type="text" class="form-control" id="position-{{ $operator->id }}" name="roles" value="{{ $operator->roles }}" required>
                    </div>
                    <div class="form-group">
                        <label for="email-{{ $operator->id }}" class="control-label">Email</label>
                        <input type="email" class="form-control" id="email-{{ $operator->id }}" name="email" value="{{ $operator->email }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Delete Modal -->
<div class="modal fade" id="delete{{ $operator->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteLabel{{ $operator->name }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteLabel{{ $operator->id }}">Delete operator</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" method="POST" action="{{ route('operator.destroy', $operator->name) }}">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <p>Are you sure you want to delete <strong>{{ $operator->name }}</strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
