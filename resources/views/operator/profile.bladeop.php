@extends('layouts.master')

@section('content')
<div class="container mt-1">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <!-- User Profile Card -->
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4>User Profile</h4>
                </div>
                <div class="card-body">
                    <!-- User Information -->
                    <div class="mb-3">
                        <strong>Name:</strong>
                        <p id="userName">{{ auth()->user()->name }}</p>
                    </div>
                    <div class="mb-3">
                        <strong>Email:</strong>
                        <p id="userEmail">{{ auth()->user()->email }}</p>
                    </div>
                    <div class="mb-3">
                        <strong>Roles:</strong>
                        <p id="userRoles">
                            @php
                                $roles = explode(',', auth()->user()->roles ?? '');
                            @endphp
                            @if (!empty($roles))
                                @foreach ($roles as $role)
                                    <span class="badge ">{{ $role }}</span>
                                @endforeach
                            @else
                                <span>No roles assigned</span>
                            @endif
                        </p>
                    </div>
                    <hr>
                    <!-- Change Password Form -->
                    <h5>Change Password</h5>
                    <form method="POST" action="{{ route('user.changePasswordop') }}">
    @csrf
    <div class="form-group mb-3">
        <label for="currentPassword">Current Password</label>
        <input type="password" id="currentPassword" name="current_password" class="form-control" required>
    </div>
    <div class="form-group mb-3">
        <label for="newPassword">New Password</label>
        <input type="password" id="newPassword" name="new_password" class="form-control" required>
    </div>
    <div class="form-group mb-3">
        <label for="confirmPassword">Confirm New Password</label>
        <input type="password" id="confirmPassword" name="new_password_confirmation" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success">Change Password</button>
</form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
