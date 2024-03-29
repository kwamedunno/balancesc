@extends('layouts.master')

@section('title') Add ScoreCard @endsection
@section('content-body')

    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-5" style="margin-top: 10px;">
                    <h5 class="card-title">Create Score Card</h5>
                </div>
                <div class="col-md-7" style="text-align: right; margin-bottom: 5px;">
                    <div class="btn btn-info" data-toggle="modal" data-target="#default">Save <i class="la la-disc"></i></div>
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
                        <table class="table table-striped table-bordered " id="scorecard">
                            <thead class="thead table-success">
                                <tr>
                                    <th>Objective</th>
                                    <th>Measure</th>
                                    <th>Metric</th>
                                    <th>Weight</th>
                                    <th>Target</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @for($i=0; $i<sizeof($objectives); $i++) 
                                    <tr style="background-color:#343a40; color:#fff !important;">
                                            <td colspan="5"><h4 style="color:#fff !important;">{{ $objectives[$i]['description'] }}</h4></td>
                                            
                                        @for($j=0; $j<sizeof($objectives[$i]['objectives']); $j++) 
                                            <tr >
                                                <td><h6 style="margin-left: 20px;">{{ $objectives[$i]['objectives'][$j]['description'] }}</h6></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <tr>
                                                @for($k=0; $k<sizeof($objectives[$i]['objectives'][$j]['measures']); $k++) 
                                                    
                                                        <td></td>
                                                        <td>{{ $objectives[$i]['objectives'][$j]['measures'][$k]['description'] }}</td>
                                                        
                                                        @for($l=0; $l<sizeof($objectives[$i]['objectives'][$j]['measures'][$k]['metrics']); $l++ ) 
                                                            <td>{{ $objectives[$i]['objectives'][$j]['measures'][$k]['metrics'][$l]['description'] }}</td>
                                                            <td><input style="height: 20px;" class="form-control" type="text" required></td>
                                                            <td><input style="height: 20px; width: 100px;" class="form-control" type="text" required></td>
                                                            @if ($l != sizeof($objectives[$i]['objectives'][$j]['measures'][$k]['metrics']) - 1)
                                                                <tr><td></td><td></td>
                                                            @endif
                                                            
                                                        @endfor
                                                        </tr>
                                                        
                                                @endfor
                                                </tr>
                                            </tr>
                                        @endfor
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