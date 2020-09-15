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
                                            <td><h4 style="color:#fff !important;">{{ $i+1 }}.&nbsp;{{ $objectives[$i]['actual']['description'] }}</h4></td>
                                            <td></td>
                                            <td></td>
                                            <td>Actual</td>
                                            <td>Target</td>
                                            <td>Weight</td>
                                            <td>Rating</td>
                                            
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
                                                                <td><input style="height: 20px; min-width: 100px;" class="form-control" name = "metric_{{ $objectives[$i]['objectives'][$j]['measures'][$k]['metrics'][$l]['id'] }}" @if(($scorecard['approval']=='yes')&&(Auth::user()->role>2)) {{'readonly'}} @endif value="{{ $objectives[$i]['objectives'][$j]['measures'][$k]['metrics'][$l]['score'] }}" type="text" required></td>

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
                            </tbody>
                            <tfoot>
                            </tfoot>
                        </table>
                        <div class="row">
                            <div class="d-flex form-group col-md-12" style=" margin-bottom: 5px; text-align:left;">
                                <div class="col-md-8">
                                    <span>Comments: <input type="textarea" name="comments" style="width:80%"><br><br></span>
                                    <fieldset class="">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input"  
                                            @if((Auth::user()->role)>2) {{'disabled'}}@endif
                                            @if($scorecard['approval']=='yes') {{'checked'}}@endif 
                                            name="approval" id="customCheck1">
                                            <label class="custom-control-label" for="customCheck1">Approved and Complete</label><br><br>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="form-group col-md-12 justify-content-right">
                                    <button class="btn btn-warning" @if(($scorecard['approval']=='yes')&&((Auth::user()->role)>2)) {{'disabled'}}@endif type ="save"> Save <i class="la la-disc"></i></button>
                                    <button class="btn btn-success" @if(($scorecard['approval']=='yes')&&((Auth::user()->role)>2)) {{'disabled'}}@endif type ="submit"> Submit <i class="la la-disc"></i></button><br><br>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection