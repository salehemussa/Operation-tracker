
<!-- Edit Modal -->
<div class="modal fade" id="edit{{ $employee->id }}" tabindex="-1" role="dialog" aria-labelledby="editLabel{{ $employee->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editLabel{{ $employee->id }}">Edit Employee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" method="POST" action="{{ route('employees.update', $employee->name) }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name-{{ $employee->id }}" class="control-label">Name</label>
                        <input type="text" class="form-control" id="name-{{ $employee->id }}" name="name" value="{{ $employee->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="position-{{ $employee->id }}" class="control-label">Position</label>
                        <input type="text" class="form-control" id="position-{{ $employee->id }}" name="position" value="{{ $employee->position }}" required>
                    </div>
                    <div class="form-group">
                        <label for="email-{{ $employee->id }}" class="control-label">Email</label>
                        <input type="email" class="form-control" id="email-{{ $employee->id }}" name="email" value="{{ $employee->email }}" required>
                    </div>
                    <div class="form-group">
                        <label for="schedule-{{ $employee->id }}" class="control-label">Schedule</label>
                        <select class="form-control" id="schedule-{{ $employee->id }}" name="schedule" required>
                            <option value="" selected>- Select -</option>
                            @foreach ($schedules as $schedule)
                                <option value="{{ $schedule->slug }}" {{ $employee->schedules->first() && $employee->schedules->first()->slug == $schedule->slug ? 'selected' : '' }}>
                                    {{ $schedule->slug }} -> from {{ $schedule->time_in }} to {{ $schedule->time_out }}
                                </option>
                            @endforeach
                        </select>
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
<div class="modal fade" id="delete{{ $employee->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteLabel{{ $employee->name }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteLabel{{ $employee->id }}">Delete Employee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" method="POST" action="{{ route('employees.destroy', $employee->name) }}">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <p>Are you sure you want to delete <strong>{{ $employee->name }}</strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
