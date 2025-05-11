@extends('layouts.master')

@section('css')
@endsection

@section('breadcrumb') 
<div class="col-sm-6">
    <h4 class="page-title text-left">Requests</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0);">Request</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0);">Request List</a></li>
    </ol>
</div>
@endsection



@section('content')
@include('includes.flash')

<!-- Show Validation Errors -->
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<!-- End Validation Errors -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>Tool ID</th>
                            <th>Sender Name</th>
                            <th>Tool Name</th>
                            <th>Quantity</th>
                            <th>Last Updated</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
    @foreach ($inventorys as $inventory)
    <tr>
        <td>{{ $inventory->id }}</td>
        <td>{{ $inventory->user ? $inventory->user->name : 'N/A' }}</td> <!-- Display user name -->
        <td>{{ $inventory->name }}</td>
        <td>{{ $inventory->quantity }}</td>
        <td>{{ $inventory->created_at }}</td>
        <td>
            @if ($inventory->status === 0)
                <span class="badge badge-secondary">Pending</span>
            @elseif ($inventory->status === 1)
                <span class="badge badge-success">Accepted</span>
            @elseif ($inventory->status === 2)
                <span class="badge badge-danger">Rejected</span>
            @endif
        </td>
        <td>
       

            <form method="POST" action="{{ route('requests.updateStatus', ['id' => $inventory->id, 'status' => 1]) }}" style="display:inline-block;">
    @csrf
    @method('PUT')
    <button type="submit" class="btn btn-success btn-sm">Accept</button>
           </form>

            <form method="POST" action="{{ route('requests.updateStatus', ['id' => $inventory->id, 'status' => 2]) }}" style="display:inline-block;">
                @csrf
                @method('PUT')
                <button type="submit" class="btn btn-danger btn-sm">Reject</button>
            </form>
        </td>
    </tr>
    @endforeach
</tbody>

                </table>
            </div>
        </div>
    </div>
</div>


<!-- Include additional modals -->
@foreach ($inventorys as $inventory)
@include('includes.edit_delete_inventory')
@endforeach
@include('includes.add_inventory')

@endsection

@section('script')
<!-- Responsive-table -->
