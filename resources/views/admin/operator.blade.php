@extends('layouts.master')

@section('css')
@endsection

@section('breadcrumb')
<div class="col-sm-6">
    <h4 class="page-title text-left">Sites</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0);">Sites</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0);">Sites List</a></li>
  
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
                                                        <th data-priority="1">Site ID</th>
                                                        <th data-priority="2">Site Name</th>
                                                        <th data-priority="3">Roles</th>
                                                        <th data-priority="4">Email</th>
                                                        <th data-priority="6">Actions</th>
                                                     
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach( $operators as $operator)

                                                        <tr>
                                                            <td>{{$operator->id}}</td>
                                                            <td>{{$operator->name}}</td>
                                                            <td>{{$operator->roles}}</td>
                                                            <td>{{$operator->email}}</td>
                                                         
                                                            <td>
                        
    <!-- Edit Button -->
    <a href="#edit{{ $operator->id }}" data-toggle="modal" class="btn btn-success btn-sm edit btn-flat">
        <i class="fa fa-edit"></i> Edit
    </a>
    <!-- Delete Button -->
    <a href="#delete{{ $operator->id }}" data-toggle="modal" class="btn btn-danger btn-sm delete btn-flat">
        <i class="fa fa-trash"></i> Delete
    </a>





                                                            </td>
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
                                    



@include('includes.add_operator')

@foreach ($operators as $operator)
    @include('includes.edit_delete_operator', ['operator' => $operator])
@endforeach



@endsection


@section('script')
<!-- Responsive-table-->

@endsection