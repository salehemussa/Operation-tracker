@extends('layouts.master')

@section('css')
@endsection

@section('breadcrumb')
<div class="col-sm-6">
    <h4 class="page-title text-left">Items</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0);">Items</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0);">Item List</a></li>
  
    </ol>
</div>
@endsection
@section('button')
<a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="mdi mdi-plus mr-2"></i>Add</a>
@endsection

@section('content')
@include('includes.flash')
<!--Show Validation Errors here-->
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<!--End showing Validation Errors here-->


                      <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        
                                                    <thead>
                                                    <tr>
                                                        <th data-priority="1">Tool ID</th>
                                                        <th data-priority="2">Tool Name</th>
                                                        <th data-priority="4">last updated</th>
                                                        <th data-priority="5">status</th>
                                                     
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach( $inventorys as $inventory)
                                                        <tr>
                                                            <td>{{$inventory->id}}</td>
                                                            <td>{{$inventory->name}}</td>
                                                            <td>{{$inventory->created_at}}</td>
                                                            <td>{{$inventory->status}}</td>

                                                        </tr>
                                                        @endforeach
                                                   
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->    
                                    

@foreach( $inventorys as $inventory)
@include('includes.edit_delete_inventory')
@endforeach

@include('includes.add_inventory')

@endsection


@section('script')
<!-- Responsive-table-->

@endsection