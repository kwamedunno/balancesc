@extends('layouts.master')

@section('title') Score Cards @endsection

@section('content-body')

    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-5" style="margin-top: 10px;">
                    <h5 class="card-title">Score Cards</h5>
                </div>
                <div class="col-md-7" style="text-align: right; margin-bottom: 5px;">
                    <a href="{{ route('show.create.scorecard') }}"><button class="btn btn-info" data-toggle="modal" data-target="#default">Add Score Card <i class="la la-plus"></i></button></a>
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
                        <table class="table table-striped table-bordered zero-configuration" id="score_card">
                            <thead>
                                <tr>
                                    <th>Score Card ID</th>
                                    <th>Staff Name</th>
                                    <th>Staff Department</th>
                                    <th>Period</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @for($i=0; $i<sizeof($scorecards); $i++) 
                                    <tr>
                                        <td>{{ $scorecards[$i]['id'] }}</td>
                                        <td>{{ $scorecards[$i]['staff']['name'] }}</td> 
                                        <td>{{ $scorecards[$i]['staff']['department']['description'] }}</td> 
                                        <td>{{ $scorecards[$i]['period'] }}</td> 
                                        <td><a href="{{ route('show.view.scorecard', $scorecards[$i]['id']) }}"><button class="btn btn-info" style="padding: 0.3rem 0.5rem;"><i class="la la-eye"></i></button></td></a>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
        


@endsection