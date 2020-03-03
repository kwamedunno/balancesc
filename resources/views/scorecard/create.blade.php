@extends('layouts.master')

@section('title') Add ScoreCard @endsection
@section('content-body')

    <div class="row">
        <div class="col-md-12">
        <form method="POST" action="{{ route('save.create.scorecard') }}">
            @csrf
            <div class="row">
                <div class="col-md-5" style="margin-top: 10px;">
                    <h5 class="card-title">Create Score Card</h5>
                </div>

                <div class="col-md-7" style="text-align: right; margin-bottom: 5px;">
                    <button type="submit" class="btn btn-success" >Save <i class="la la-disc"></i></button>
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
                <div class="row">
                    <div class="input-group mb-3 col-lg-4">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Name</label>
                        </div>
                        @if((Auth::user()->role)==2)
                        <select class="custom-select" required name="officer_name" id="inputGroupSelect01">
                            <option value="">Choose...</option>
                            @for ($i = 0; $i < sizeof($staff); $i++)
                                <option value="{{ $staff[$i]['name'] }}">{{ $staff[$i]['name'] }}</option>
                            @endfor
                        </select>
                        @elseif((Auth::user()->role)==1)
                        <select class="custom-select" required name="staff" id="inputGroupSelect01">
                            <option value="">Choose...</option>
                            @for ($i = 0; $i < sizeof($entire_staff); $i++)
                                <option value="{{ $entire_staff[$i]['id'] }}">{{ $entire_staff[$i]['name'] }}</option>
                            @endfor
                        </select>
                        @endif
                        <div class="invalid-feedback text-right">Choose officer Name</div>
                    </div>
                    <div class="input-group mb-3 col-lg-4">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect02">Month</label>
                        </div>
                        <select class="custom-select" required name="month" id="">
                            <option value="">Choose...</option>
                            <option value="01">Jan</option>
                            <option value="02">Feb</option>
                            <option value="03">Mar</option>
                            <option value="04">Apr</option>
                            <option value="05">May</option>
                            <option value="06">Jun</option>
                            <option value="07">Jul</option>
                            <option value="08">Aug</option>
                            <option value="09">Sep</option>
                            <option value="10">Oct</option>
                            <option value="11">Nov</option>
                            <option value="12">Dec</option>
                        </select>
                        <div class="invalid-feedback text-right">Pick a month</div>
                    </div>
                    <div class="input-group mb-3 col-lg-4">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Year</label>
                        </div>
                        <select class="custom-select" required name="year" id="">
                            <option value="">Choose...</option> 
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            <option value="2026">2026</option>
                            <option value="2027">2027</option>
                            <option value="2028">2028</option>
                            <option value="2029">2029</option>
                            <option value="2030">2030</option>
                        </select>
                        <div class="invalid-feedback text-right">Choose Year</div>
                    </div>
                </div>
            </div>
                        <table class="table table-striped table-bordered " id="scorecard">
                            <thead class="thead table-success">
                                <tr>
                                    <th style="position:relative;position:sticky">Objective</th>
                                    <th>Measure</th>
                                    <th>Metric</th>
                                    <th>Target</th>
                                    <th>Weight %</th>
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

                                                            <td><input style="height: 20px; width: 100px;" class="form-control" name="target_{{ $objectives[$i]['objectives'][$j]['measures'][$k]['metrics'][$l]['id'] }}" value=""type="text">
                                                            <input type="hidden" name="metric_{{ $objectives[$i]['objectives'][$j]['measures'][$k]['metrics'][$l]['id'] }}" value="{{ $objectives[$i]['objectives'][$j]['measures'][$k]['metrics'][$l]['id'] }}"></td>

                                                            <td><input style="height: 20px;" class="form-control" name="weight_{{ $objectives[$i]['objectives'][$j]['measures'][$k]['metrics'][$l]['id'] }}" type="text" value="" ></td>

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
                        <div class="row">
                            <div class="col-md-5" style="margin-top: 10px;">
                                
                            </div>
            
                            <div class="col-md-7" style="text-align: right; margin-bottom: 5px;">
                                <button type="submit" class="btn btn-success" tb="10;">Save <i class="la la-disc"></i></button>
                            </div>
                        </div>
                </form>  
            </div>
        </div>
    </div>


@endsection