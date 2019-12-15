<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ScoreCard;
use App\Objective;
use App\Measure;
use App\Metric;
use App\ScoreCardObjective;
use App\Staff;

use Auth;

class ScoreCardsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:staff');
    }

    public function showScoreCards(){
        if (Auth::user()->role == 1) {
            # show all
            $scorecards = ScoreCard::with('staff.department')->get()->toArray();
        }elseif(Auth::user()->role == 2){
            # show only scorecards of staff in that department and having equal or higher permissions
            $ids = Staff::where('role', '>=', Auth::user()->role)->where('department', '=', Auth::user()->department)->get('id')->toArray();

            $scorecards = ScoreCard::whereIn('staff', $ids)->with('staff.department')->get()->toArray();
        }else{
            # Permission denied
            return redirect()->back()
                ->with('error', 'Permission Denied');
        }


        // var_dump($scorecards);
        // exit;


        return view('scorecards')
                ->with('scorecards', $scorecards);

    }                                                                                                                                                   
    public function showCreateScoreCard(){
        return view('scorecard.add')
            ->with('objectives', Objective::where('parent', null)->with('objectives.measures.metrics')->get()->toArray());
    }

    public function showViewScoreCard($id){

        $scoreCardObjectives = ScoreCardObjective::where('score_card', '=', $id)->with('actual', 'measures.actual', 'measures.metrics', 'measures.metrics.actual')->get()->toArray();
        // dd($scoreCardObjectives);
        // exit;
        return view('scorecard.view')
            ->with('objectives', ScoreCardObjective::where('score_card', '=', $id)->with('actual', 'measures.actual', 'measures.metrics', 'measures.metrics.actual')->get()->toArray());

        $scorecard = null;
        $scorecard['objectives'] = ScoreCardObjective::where('score_card', '=', $id)->with('actual', 'measures')->get()->toArray();
    }
}
