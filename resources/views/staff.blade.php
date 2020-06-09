@extends('layouts.master')

@section('title') Staff @endsection
@section('content-body')

    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-5" style="margin-top: 10px;">
                    <h5 class="card-title">Staff</h5>
                </div>
                <div class="col-md-7" style="text-align: right; margin-bottom: 5px;">
                    <div class="btn btn-info" data-toggle="modal" data-target="#default">Add <i class="la la-plus"></i></div>
                    @if(Auth::user()->role==1)
                    <div class="btn btn-warning" data-toggle="modal" data-target="#changeDepartment"> Edit <i class="la la-pencil"></i></div>
                    @endif
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
            @if(session()->has('deleted'))
            <div class="alert alert-danger alert-dismissible mb-2" style="color: #fff !important;" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                {{ session()->get('deleted') }}
            </div>
            @endif
            @if(session()->has('updated'))
            <div class="alert alert-primary alert-dismissible mb-2" style="color: #fff !important;" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                {{ session()->get('updated') }}
            </div>
            @endif
            <div class="card" style="">
                <div class="card-content collapse show">
                    <div class="card-body">
                        <table class="table table-striped table-bordered zero-configuration" id="staff">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Department</th>
                                    <th>Role</th>
                                    <th>Average</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @for($i=0; $i<sizeof($staff); $i++) 
                                    <tr>
                                        <td>{{ $staff[$i]['id'] }}</td>
                                        <td>{{ $staff[$i]['name'] }}</td> 
                                        <td>{{ $staff[$i]['email'] }}</td> 
                                        <td>{{ $staff[$i]['department']['description'] }}</td> 
                                        <td>{{ $staff[$i]['role']['description'] }}</td>
                                        <td>{{ round(($scoredStaff[$i]['averagescore']),2) }}</td>
                                        <td><a href="{{ route('show.profile',$staff[$i]['id']) }}"><button class="btn btn-info" style="padding: 0.3rem 0.5rem;;margin-right:1.5rem;"><i class="la la-eye"></i></button></a>
                                            @if((Auth::user()->role)==1)
                                                <a href="{{ route('delete.staff', $staff[$i]['id']) }}" onclick="return confirm('Are you sure?')"><button class="btn btn-danger" style="padding: 0.3rem 0.5rem;"><i class="la la-trash"></i></button></a>
                                            @endif
                                        </td>
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
                    <h4 class="modal-title" id="myModalLabel1">Add Staff</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('add.staff') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input id="name" name="name" class="form-control" placeholder="Enter staff name" type="text" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input id="email" name="email" class="form-control" placeholder="Enter staff email" type="email" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="type">Department</label>
                                    <select class="form-control" name='department' id="department" style='border-radius:7px;' required>
                                        <option value=''>Select Department</option>
                                        @for ($i = 0; $i < sizeof($departments); $i++)
                                            <option value="{{ $departments[$i]['id'] }}">{{ $departments[$i]['description'] }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="type">Role</label>
                                        <select class="form-control" name='role' id="role" style='border-radius:7px;' required>
                                            <option value=''>Select Role</option>
                                            @for ($i = 0; $i < sizeof($roles); $i++)
                                                <option value="{{ $roles[$i]['id'] }}">{{ $roles[$i]['description'] }}</option>
                                            @endfor
                                        </select>
                                    </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input id="password" name="password" class="form-control" placeholder="Enter staff password" type="text" required>
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
    <!-- Modal End -->
    
    <!-- Modal Edit Staff -->
    <div class="modal fade text-left" id="changeDepartment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel1">Add Department</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('edit.staff') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <select  class="form-control" name="name" id="">
                                        <option value=''>Choose Staff</option>
                                        @for ($i = 0; $i < sizeof($staff); $i++)
                                        <option value='{{ $staff[$i]['id'] }}'>{{ $staff[$i]['name'] }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="role">Role</label>
                                    <select  class="form-control" name="role" id="">
                                        <option value=''>Choose Role</option>
                                        @for ($i = 0; $i < sizeof($roles); $i++)
                                        <option value="{{ $roles[$i]['id'] }}">{{ $roles[$i]['description'] }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="department">department</label>
                                    <select  class="form-control" name="department" id="">
                                        <option value=''>Choose Department</option>
                                        @for ($i = 0; $i <(sizeof($departments)); $i++)
                                        <option value='{{ $departments[$i]["id"] }}'>{{ $departments[$i]['description'] }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="department">Reset Password</label>
                                    <input id="password_reset" name="password_reset" class="form-control" placeholder="Enter staff password" type="text">
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