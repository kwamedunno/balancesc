<?php

namespace App\Http\Controllers;

use Auth;

use App\Staff;
use App\Metric;
use App\Measure;
use App\Objective;
use App\ScoreCard;
use App\ScoreCardMetric;

use App\ScoreCardObjective;
use Illuminate\Http\Request;

class ScoreCardsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:staff');
    }

    public function showScoreCards(){
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
    public function showCreateScoreCard(){
        return view('scorecard.add')
            ->with('objectives', Objective::where('parent', null)->with('objectives.measures.metrics')->get()->toArray());
    }

    public function showViewScoreCard($id){

        $objectives = ScoreCardObjective::where('parent',null)->where('score_card', '=', $id)->with('actual','objectives.actual', 'objectives.measures.actual', 'objectives.measures.metrics.actual')->get()->toArray();
        // dd($scorecard);
        // exit;
        $scorecard = ScoreCard::where('id','=', $id)->with('staff')->first()->toArray();
        $scorecard['period'] = date('F Y', strtotime("01-".$scorecard['period']));
        $metrics = ScoreCardMetric::where('scorecard', '=', $id)->orderBy('id', 'asc')->get()->toArray();
        $scorecard['total_score'] = 0;
        $scorecard['target_weight'] = 0;
        for ($i=0; $i < (sizeof($metrics)) ; $i++) { 
            $scorecard['total_score'] += ($metrics[$i]['score'] * $metrics[$i]['weight']) / $metrics[$i]['target']; //score
        }

        return view('scorecard.view')
            ->with('objectives', $objectives)
            ->with('scorecard', $scorecard)
            ->with('metrics', $metrics);

        
    }

    public function saveScoreCard(Request $request){

        $id = ScoreCardMetric::where('scorecard','=',$request->input('scorecard_id'))->get('id')->toArray();
        for ($i=0; $i <(sizeof($id)) ; $i++) { 
            ScoreCardMetric::where('id','=',$id[$i]['id'])->update(['score' => $request->input('metric_'.$id[$i]['id'])]);
        }

        $sc = ScoreCard::find($request->scorecard_id);
        $sc->last_updated_by = Auth::user()->id;
        $sc->updated_at = date("Y-m-d H:i:s");
        $sc->save();
        return redirect()->back()
                ->with('success', 'Score Card Saved');
    }

    public function addScoreCard(Request $request){
        
    }
}
