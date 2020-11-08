<?php

namespace App\Http\Controllers;

use Auth;

use App\Staff;
use App\Metric;
use App\Measure;
use App\Objective;
use App\ScoreCard;
use App\Mail\SendMail;

use App\ScoreCardMetric;
use App\ScoreCardMeasure;
use App\ScoreCardObjective;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ScoreCardsController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:staff');
    }

    //Display List of Scorecards
    public function showScoreCards(){

        try {
            //code...
            if (Auth::user()->role == 1) {
            # show all
            $scorecards = ScoreCard::with('staff.department', 'lastUpdatedBy')->get()->toArray();
        }elseif(Auth::user()->role == 2){
            # show only scorecards of staff in that department and having equal or higher permissions
            $ids = Staff::where('role', '>=', Auth::user()->role)->where('department', '=', Auth::user()->department)->get('id')->toArray();

            $scorecards = ScoreCard::whereIn('staff', $ids)->with('staff.department', 'lastUpdatedBy')->get()->toArray();
        }
        elseif(Auth::user()->role == 3){
            $id = Staff::where('role','=',Auth::user()->role)->where('department','=', Auth::user()->department)->where('name','=',Auth::user()->name)->get('id')->toArray();
            
            $scorecards = ScoreCard::whereIn('staff', $id)->with('staff.department', 'lastUpdatedBy')->get()->toArray();
        }
        else{
            # Permission denied
            return redirect()->back()
                ->with('error', 'Permission Denied');
        }


        return view('scorecards')
                ->with('scorecards', $scorecards);

        } 
        
        catch (\Exception $e) {

            Log::error("\t".$e->getTraceAsString());
            Log::error("\t".$e->getMessage());
            //return $e->getMessage();

        }
        

    }  

    public function showViewScoreCard($id){

        $objectives = ScoreCardObjective::where('parent',null)->where('score_card', '=', $id)->with('actual','objectives.actual', 'objectives.measures.actual', 'objectives.measures.metrics.actual')->get()->toArray();
        $scorecard = ScoreCard::where('id','=', $id)->with('staff')->first()->toArray();
        $scorecard['period'] = date('F Y', strtotime("01-".$scorecard['period']));
        $metrics = ScoreCardMetric::where('scorecard', '=', $id)->orderBy('id', 'asc')->get()->toArray();
        $scorecard['total_score'] = 0;
        $scorecard['target_weight'] = 0;
        $entire_staff = Staff::with('role','department')->get()->toArray();
        
        for ($i=0; $i < (sizeof($metrics)) ; $i++) { 
            $scorecard['total_score'] += ($metrics[$i]['score'] * $metrics[$i]['weight']) / $metrics[$i]['target']; //score
        }
        $savedcard = ScoreCard::where('id','=',$id)->first();
        $savedcard->total_score = $scorecard['total_score'];
        $savedcard->save();

        // $saved_score = Scorecard::find($id->scorecard_id);
        // $scorecard['total_score'] => $saved_score['total_score'];

        return view('scorecard.view')
            ->with('objectives', $objectives)
            ->with('scorecard', $scorecard)
            ->with('entire_staff',$entire_staff)
            ->with('metrics', $metrics);
        
        
    }

    //Saving Scorecard input from the user
    public function saveScoreCard(Request $request){
        $id = ScoreCardMetric::where('scorecard','=',$request->input('scorecard_id'))->get('id')->toArray();
        for ($i=0; $i <(sizeof($id)) ; $i++) { 
            ScoreCardMetric::where('id','=',$id[$i]['id'])->update(['score' => $request->input('metric_'.$id[$i]['id'])]);
        }

        $sc = ScoreCard::find($request->scorecard_id);
        $sc->last_updated_by = Auth::user()->id;
        $sc->updated_at = date("Y-m-d H:i:s"); 
        if($request->has('approval')){
            $sc->approval = "yes";
        }
        else{
            $sc->approval = "no";
        }
        $sc->save();

        
        $request->scorecard_id;
        if($request->scorecard_id)
        {
            $staffMail = Staff::where('id', ScoreCard::where('id',$request->scorecard_id)->first()->staff)->first()->email;
            if($sc->approval == "no" || $sc->approval == "")
            {
                $body = "<h3>Hi from BSC</h3><br><p>Your scorecard for ". $sc->period ." has been updated. Please login here to access it >> <a href='https://scorecard.instntmny.com'>Balanced Scorecard</a></p><p>Comments:". $request->comments ."from". Auth::user()->name ."</p>";
            }
            elseif($sc->approval == "yes")
            {
                $body = "<h1>Hi from BSC</h1><br><p>Your scorecard for ". $sc->period ." has been approved and cannot be updated anymore. Please login here to view your final form >> <a href='https://scorecard.instntmny.com'>Balanced Scorecard</a></p><p>Comments:". $request->comments ." from " . Auth::user()->name ."</p>";
            }
        }
        
        $mailStructure = array(
            "body"      => $body
        );

        Mail::to($staffMail)->send(new SendMail($mailStructure));

        return redirect()->back()
                ->with('success', 'Score Card Saved');
    }

    // Saving created scorecard
    public function saveCreatedScoreCard(Request $request){
        $metrics = $measures_id = $objectives_id = $parent_objectives_id = [];
        $count=0;
        $all_metrics = Metric::all()->toArray();
        for ($i=0; $i < count(Metric::get()) ; $i++) { 
            if (!is_null($request->input('target_'.$all_metrics[$i]['id'])) && (!is_null($request->input('weight_'.$all_metrics[$i]['id'])))) {
                
                $metrics[$count]['id'] = ($request->input('metric_'.$all_metrics[$i]['id']));
                $metrics[$count]['target'] = ($request->input('target_'.$all_metrics[$i]['id']));
                $metrics[$count]['weight'] = ($request->input('weight_'.$all_metrics[$i]['id']));
                $measures_id[$i] = Metric::where('id', '=', $metrics[$count]['id'])->first()->measure;
                $metrics[$count]['measure'] = $measures_id[$i];
                $count++;
            }
        }


        $measures_id = (array_values(array_unique($measures_id)));
        for ($i=0; $i < (sizeof($measures_id)); $i++) { 
            $objectives_id[$i] = Measure::where('id', '=', $measures_id[$i])->first()->objective;
        }

        $objectives_id = array_values(array_unique(($objectives_id)));
        // dd($objectives_id);

        for ($i=0; $i < (sizeof($objectives_id)); $i++) { 
            $parent_objectives_id[$i]= Objective::where('id', '=', $objectives_id[$i])->first()->parent;
        }

        $parent_objectives_id = array_values(array_unique($parent_objectives_id));

        $scorecard = New ScoreCard;
        $scorecard->staff = $request->staff;
        $scorecard->period = $request->month."-".$request->year;
        $scorecard->approval = "no";
        $scorecard->last_updated_by = Auth::user()->id;
        $scorecard->save();
        

        // dd($parent_objectives_id);
        for ($i=0; $i < sizeof($parent_objectives_id); $i++) { 
            $scorecardParentObjective = new ScoreCardObjective;
            $scorecardParentObjective->score_card = $scorecard->id;
            $scorecardParentObjective->objective = $parent_objectives_id[$i];

            $scorecardParentObjective->save();
            for ($j=0; $j <(sizeof($objectives_id)); $j++) { 
                $scorecardObjectiveActual = Objective::where('id', '=', $objectives_id[$j])->first();

                if ($scorecardObjectiveActual->parent == $scorecardParentObjective->objective) {
                    $scorecardObjective = new ScoreCardObjective;
                    $scorecardObjective->score_card = $scorecard->id;
                    $scorecardObjective->objective = $objectives_id[$j];
                    $scorecardObjective->parent = $scorecardParentObjective->id;
                    $scorecardObjective->save();

                    for ($k=0; $k < (sizeof($measures_id)); $k++) { 
                        $scorecardMeasureActual = Measure::where('id','=',$measures_id[$k])->first();
    
                        if($scorecardMeasureActual->objective == $scorecardObjective->objective){
                            
                            $scorecardMeasure = new ScoreCardMeasure;
                            $scorecardMeasure->objective = $scorecardObjective->id;
                            $scorecardMeasure->measure = $measures_id[$k];
                            $scorecardMeasure->save();
                            
                            for ($l=0; $l < (sizeof($metrics)); $l++) {
                                $scorecardMetricActual = Metric::where('id','=',$metrics[$l]['id'])->first();

                                if($scorecardMetricActual->measure == $scorecardMeasure->measure){
                                    $scorecardMetric = new ScoreCardMetric;
                                    $scorecardMetric->metric = $metrics[$l]['id'];
                                    $scorecardMetric->scorecard = $scorecard->id;
                                    $scorecardMetric->measure = $scorecardMeasure->id;
                                    $scorecardMetric->score = 0;
                                    $scorecardMetric->target = $metrics[$l]['target'];
                                    $scorecardMetric->weight = $metrics[$l]['weight'];
                                    $scorecardMetric->save();
                                }
                            }
                        }
                    }
                }
            }
        }

        if($scorecard->staff)
        {
            $staffMail = Staff::where('id','=',$scorecard->staff)->first()->email;
            
            $body = "<h3>Hi from BSC</h3><br><p>Your scorecard for ". $scorecard->period ." has been created. Please login here to access it >> <a href='https://scorecard.instntmny.com'>Balanced Scorecard</a></p>";
            
        }
        
        $mailStructure = array(
            "body"      => $body
        );

        Mail::to($staffMail)->send(new SendMail($mailStructure));
        return back()->with('success', 'Score Card Created and mail sent');
    }

    //viewing the create scorecard page
    public function createScoreCard(){
        $staff = Staff::where('department','=',Auth::user()->department)->where('role','>=',Auth::user()->role)->get()->toArray();
        $entire_staff = Staff::with('role','department')->get()->toArray();
        
        return view('scorecard.create')
            ->with('objectives', Objective::where('parent', null)->with('objectives.measures.metrics')->get()->toArray())
            ->with('sub_objectives',Objective::whereNotNull('parent')->with('measures.metrics')->get()->toArray())
            ->with('measures',Measure::all()->toArray())
            ->with('metrics',Metric::all()->toArray())
            ->with('staff',$staff)
            ->with('entire_staff',$entire_staff);
    }

    //Deleting scorecard
    public function deleteScoreCard($id){
        $scorecard = ScoreCard::where('id','=', $id)->first();
        $scorecard->delete();

        return redirect()->back()
            ->with('deleted','Score Card has been deleted');

        
    }

    //Add Objective to score
    public function createObjective(Request $request){
        $objective = Objective::where('id','=',$request->objective)->first();
        $sub_objective = new Objective;
        $sub_objective->parent = $objective->id;
        $sub_objective->description = $request->sub_objective;

        $sub_objective->save();
        return redirect()->back()
        ->with('success','You have successfully added a new Objective');

    }

    //Add Measure & Metric to score 
    public function createMeasure(Request $request){

        $objective = Objective::where('id','=',$request->objective)->first();
        $sub_objective = Objective::where('id','=',$request->sub_objective)->first();
        $measure = Measure::where('id','=',$request->measure)->first();

        if($request->measure){
            $new_measure  = new Measure;
            $new_measure->objective = $request->sub_objective;
            $new_measure->description = $request->measure;
            $new_measure ->save();
            if($request->metric){
                $new_metric  = new Metric;
                $new_metric->description = $request->metric;
                $new_metric->measure = $new_measure->id;
                $new_metric->save();
            }
            else{return "";}
        }
        else{return null;}
        

        return redirect()->back()
        ->with('success','You have successfully added a new Meaure and Metric');


    }

        //Add Only Metric to score 
    public function createMetric(Request $request){

        $measure = Measure::where('id','=',$request->measure)->first();

            if($request->metric){
                $new_metric  = new Metric;
                $new_metric->description = $request->metric;
                $new_metric->measure = $request->measure;
                $new_metric->save();
            }
            else{return "";}
        

        return redirect()->back()
        ->with('success','You have successfully added a new Metric');


    }


}
