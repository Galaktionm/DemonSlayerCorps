<?php

namespace App\Http\Controllers;

use App\Models\DemonSlayer;
use App\Models\Hashira;
use App\Services\MessagingService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class HashiraController extends Controller {

    protected $service;

    public function __construct(MessagingService $service)
    {
        $this->service=$service;
    }


    public function showHashiraView(){
        if(Gate::forUser(Auth::guard("Hashiras")->user())->denies("isHashira")){
            abort(403);
        }
        return view("hashiraView", ['demonSlayers'=>
        DemonSlayer::where('hashira_id', $this->hashira()->id)->get(), 
        'hashira'=>Auth::guard("Hashiras")->user()]);
    }

    public function sendMessages(Request $request) {
        
        $names=$this->hashira()->demonSlayers()->get()->flatMap(function($demonSlayer){
            $names=[];
            array_push($names, $demonSlayer);
            return $names;
        });
        $this->service::saveMessages($this->hashira()->name, $names->all(), $request->all()['message']);
        return redirect("/hashira/account");

    }

    private function hashira() : Hashira{
        return Auth::guard("Hashiras")->user();
    }


}