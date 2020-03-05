@extends('layouts.master')

@section('title') View ScoreCard @endsection
@section('content-body')

    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <form action="{{ route('save.scorecard', $scorecard['id']) }}" method="post">
                <div class="col-md-12" style="margin-top: 10px;">
                <h4 class="card-title">View <b>{{ $scorecard['staff']['name'] }}</b>'s Score Card for <b>{{  $scorecard['period'] }}</b></h4>
                </div>
            </div>
            {{-- <div class="row">
                <div class="col-md-12" style="text-align: right; margin-bottom: 5px;">
                    <span>Comments: </span><input type="text" style="width:80%">
                    <button class="btn btn-success" type ="submit"> Save <i class="la la-disc"></i></button>
                </div>
            </div> --}}
            @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible mb-2" style="color: #fff !important;" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    {{ session()->get('success') }}
                </div>
            @endif
            <div class="" style="">
                <div class="collapse show">
                    <div class="">
                        <table class="table table-striped table-bordered " id="scorecard">
                            <thead class="thead table-success">
                                <tr>
                                    <th>Objective</th>
                                    <th>Measure</th>
                                    <th>Metric</th>
                                    <th>Actual</th>
                                    <th>Target</th>
                                    <th>Weight %</th>
                                    <th>Rating %</th>
                                    
                                    
                                </tr>
                            </thead>
                            <tbody> 
                                    @csrf
                                    <input type="hidden" name="scorecard_id" value="{{ $scorecard['id'] }}">
                                    @for($i=0; $i<sizeof($objectives); $i++) 
                                        <tr style="background-color:#343a40; color:#fff !important;">
                                            <td colspan="7"><h4 style="color:#fff !important;">{{ $i+1 }}.&nbsp;{{ $objectives[$i]['actual']['description'] }}</h4></td>
                                            
                                            @for($j=0; $j<sizeof($objectives[$i]['objectives']); $j++) 
                                                <tr >
                                                    <td><h6 style="margin-left: 20px;">{{ $objectives[$i]['objectives'][$j]['actual']['description'] }}</h6></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <tr>
                                                    @for($k=0; $k<sizeof($objectives[$i]['objectives'][$j]['measures']); $k++) 
                                                        
                                                            <td></td>
                                                            <td>{{ $objectives[$i]['objectives'][$j]['measures'][$k]['actual']['description'] }}</td>
                                                            
                                                            @for($l=0; $l<sizeof($objectives[$i]['objectives'][$j]['measures'][$k]['metrics']); $l++ ) 
                                                                <td>{{ $objectives[$i]['objectives'][$j]['measures'][$k]['metrics'][$l]['actual']['description'] }}</td>
                                                                <td><input style="height: 20px; min-width: 100px;" class="form-control" name = "metric_{{ $objectives[$i]['objectives'][$j]['measures'][$k]['metrics'][$l]['id'] }}" value="{{ $objectives[$i]['objectives'][$j]['measures'][$k]['metrics'][$l]['score'] }}" type="text" required></td>

                                                                    <td>{{ $objectives[$i]['objectives'][$j]['measures'][$k]['metrics'][$l]['target'] }}</td>
                                                                    <td>{{ $objectives[$i]['objectives'][$j]['measures'][$k]['metrics'][$l]['weight'] }}</td>
                                                                    

                                                                    <td>
                                                                        @if($objectives[$i]['objectives'][$j]['measures'][$k]['metrics'][$l]['target']!=0)
                                                                            {{ round(($objectives[$i]['objectives'][$j]['measures'][$k]['metrics'][$l]['score'] * $objectives[$i]['objectives'][$j]['measures'][$k]['metrics'][$l]['weight']) / $objectives[$i]['objectives'][$j]['measures'][$k]['metrics'][$l]['target'], 2) }}
                                                                        @else
                                                                            N/A
                                                                        @endif
                                                                    </td>

                                                                
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
                                        <tr style="background-color:#343a40; color:#fff !important;">
                                            <td colspan="7" style="text-align: right; font-weight: 800"><h5 style="color:#fff;">Total Score:<b> {{ round($scorecard['total_score'], 2) }} %</b></h5></td>
                                        </tr>
                                        {{-- <tr>
                                            <td></td><td></td><td></td><td></td><td></td><td></td><td><textarea style="border:1px solid black; border-radius:5px;" name="" id="" cols="30" rows="5"></textarea></td>
                                        </tr> --}}
                                </form>
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