@extends('layouts.master')

@section('css')
@endsection

@section('breadcrumb') 
<div class="col-sm-6">
    <h4 class="page-title text-left">Stocks</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0);">Stock</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0);">Stock List</a></li>
    </ol>
</div>
@endsection

@section('button')
<a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat">
    <i class="mdi mdi-plus mr-2"></i> Request
</a>
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
                            <th>Tool Name</th>
                            <th>Quantity</th>
                            <th>Request</th>
           
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($inventorys as $inventory)
                        <tr>
                            <td>{{ $inventory->id }}</td>
                            <td>{{ $inventory->name }}</td>
                            <td>{{ $inventory->quantity }}</td>
                            <td>
                                <button 
                                    class="btn btn-primary btn-sm update-stock btn-flat" 
                                    data-id="{{ $inventory->id }}" 
                                    data-name="{{ $inventory->name }}" 
                                    data-quantity="{{ $inventory->quantity }}" 
                                    data-action="{{ route('sendrequest.store', $inventory->id) }}" 
                                    data-toggle="modal" 
                                    data-target="#updateStockModal">
                                    <i class="mdi mdi-plus mr-2"></i> Send Request
                                </button>
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
<script>
    // Attach data to the Update Stock Modal
    $(document).on('click', '.update-stock', function () {
    const id = $(this).data('id');
    const name = $(this).data('name');
    const quantity = $(this).data('quantity');
    const action = $(this).data('action');

    // Populate modal fields
    $('#updateName').val(name);  // Populate the name field
    $('#updateQuantity').val(quantity); // Populate the quantity field
    
    // Set the form action dynamically
    $('#updateStockForm').attr('action', action);
});

</script>
@endsection
<!-- Update Stock Modal -->
<div class="modal fade" id="updateStockModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><b>Send Stock</b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="updateStockForm" method="POST" action="">
                    @csrf
                    @method('POST')

                    <!-- Name Field (Ensure this is included) -->
                    <div class="form-group">
                        <label for="name">Tool Name</label>
                        <input type="text" class="form-control" id="updateName" name="name" required />
                    </div>

                    <!-- Quantity Field -->
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" class="form-control" id="updateQuantity" name="quantity" required />
                    </div>

                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                            Send
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
