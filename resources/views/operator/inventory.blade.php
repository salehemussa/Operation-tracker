@extends('layouts.master')

@section('css')
@endsection

@section('breadcrumb')
<div class="col-sm-6">
    <h4 class="page-title text-left">Inventory</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0);">Inventory</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0);">Inventory List</a></li>
    </ol>
</div>
@endsection

@section('button')
<a href="#addinventory" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="mdi mdi-plus mr-2"></i>Add new</a>
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
<!-- End showing Validation Errors -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th data-priority="1">Tool ID</th>
                            <th data-priority="2">Tool Name</th>
                            <th data-priority="3">Quantity</th>
                            <th data-priority="4">Last Updated</th>
                            <th data-priority="5">Status</th>
                            <th data-priority="6">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($inventorys as $inventory)
                        <tr>
                            <td>{{ $inventory->id }}</td>
                            <td>{{ $inventory->name }}</td>
                            <td>{{ $inventory->quantity }}</td>
                            <td>{{ $inventory->lastupdated }}</td>
                            <td>{{ $inventory->status }}</td>
                            <td>
                                <a href="#edit{{ $inventory->id }}" data-toggle="modal" class="btn btn-success btn-sm edit btn-flat"><i class='fa fa-edit'></i> Edit</a>
                                <a href="#delete{{ $inventory->id }}" data-toggle="modal" class="btn btn-danger btn-sm delete btn-flat"><i class='fa fa-trash'></i> Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modals for Edit and Delete -->
@foreach($inventorys as $inventory)
@include('includes.edit_delete_inventory')
@endforeach

<!-- Add Inventory Modal -->
<div class="modal fade" id="addinventory" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewLabel">Add New Inventory</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('inventory.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Tool Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter tool name" required />
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Enter quantity" required />
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="Available">Available</option>
                            <option value="Unavailable">Unavailable</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection

@section('script')
<!-- Responsive-table -->
<script>
    $(document).ready(function() {
        $('#datatable-buttons').DataTable();
    });
</script>
@endsection
