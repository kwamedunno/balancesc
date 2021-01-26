@extends('layouts.master')

@section('title') Staff Profile @endsection
@section('content-body')

    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-7" style="margin-top: 10px;">
                    <h5 class="card-title">{{ $staff->name }}'s Performance Overall for {{ \Carbon\Carbon::now()->format('Y')}}:<strong> {{ round(($staff['averagescore']),2) }}</strong>%</h5>
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
                                    <th>Period</th>
                                    <th>Score</th>
                                    <th>Action</th>
                                </tr>
                            </thead> 
                            <tbody> 
                                @for($i=0; $i<sizeof($allcards); $i++) 
                                    <tr>
                                        <td>{{ $allcards[$i]['id'] }}</td>
                                        <td>{{ \Carbon\Carbon::parse('01-'.$allcards[$i]['period'])->format('M Y') }}</td>
                                        <td>{{ $allcards[$i]['total_score'] }}</td> 
                                        <td><a href="{{ route('show.view.scorecard', $allcards[$i]['id']) }}" ><button data-target="modal" class="btn btn-info" style="padding: 0.3rem 0.5rem;;margin-right:1.5rem;"><i class="la la-eye"></i></button></a>
                                            @if((Auth::user()->role)==1)
                                                <a href="{{ route('delete.scorecard', $allcards[$i]['id']) }}" onclick="return confirm('Are you sure?')"><button class="btn btn-danger" style="padding: 0.3rem 0.5rem;"><i class="la la-trash"></i></button></a>
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
    

@endsection