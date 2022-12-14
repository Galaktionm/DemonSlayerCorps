<?php

namespace App\Http\Controllers;

use App\Jobs\AssignJob;
use App\Models\FinalSelectionResults;
use App\Models\Hashira;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class DemonSlayerController extends Controller {

    public function showDemonSlayerView(){

        if(Auth::guard()->user()!=null){     
            return view("demonSlayerView", ['demonSlayer'=>Auth::guard()->user(),
            'resultSubmitted'=>FinalSelectionResults::where('demonSlayerId', Auth::guard()->user()->id)->get()]);
        }

       abort(403);
    }

public function queueAssignJob(Request $request){
    
        $result=new FinalSelectionResults();
        $result->demonSlayerId=Auth::guard()->user()->id;
        $result->demonsKilled=$request->input('demonsKilled');
        $result->demonsKilledAlone=$request->input('demonsKilledAlone');

        $result->save();

        AssignJob::dispatch(Auth::guard()->user(), $result)->onQueue('assignJobs');
}




}