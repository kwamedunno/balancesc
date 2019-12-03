@extends('layouts.master')

@section('title') Department @endsection
@section('content-body')

    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-5" style="margin-top: 10px;">
                    <h5 class="card-title">Department</h5>
                </div>
                <div class="col-md-7" style="text-align: right; margin-bottom: 5px;">
                    <div class="btn btn-info" data-toggle="modal" data-target="#default">Add <i class="la la-plus"></i></div>
                </div>
            </div>
            @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible mb-2" style="color: #fff !important;" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    {{ session()->get('success') }}
                </div>
            @endif
            <div class="card" style="">
                <div class="card-content collapse show">
                    <div class="card-body">
                        <table class="table table-striped table-bordered zero-configuration" id="departments">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Department</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @for($i=0; $i<sizeof($department); $i++) 
                                    <tr>
                                        <td>{{ $department[$i]['id'] }}</td>
                                        <td>{{ $department[$i]['description'] }}</td> 
                                        <td><button data-target="modal" class="btn btn-warning" style="padding: 0.3rem 0.5rem;"><i class="la la-eye"></i></button></td>
                                    </tr>
                                @endfor
                            </tbody>
                            <tfoot>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel1">Add Department</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('add.department') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="department">Department Name</label>
                                    <input id="description" name="description" class="form-control" placeholder="Enter department name" type="text" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn danger btn-outline-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn success btn-outline-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection