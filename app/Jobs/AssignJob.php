<?php

namespace App\Jobs;

use App\Models\DemonSlayer;
use App\Models\FinalSelectionResults;
use App\Models\Hashira;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class AssignJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $demonSlayer;

    public $result;
    

    public function __construct(DemonSlayer $demonSlayer, FinalSelectionResults $result)
    {
        $this->demonSlayer=$demonSlayer;
        $this->result=$result;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach(Hashira::all() as $hashira){
            if(count($hashira->demonSlayers)<10){
                foreach(FinalSelectionResults::orderByDesc('demonsKilledAlone')->get() as $resultFromDb) {
                    if($this->result->demonsKilledAlone > $resultFromDb->demonsKilledAlone){
                        DemonSlayer::find($this->result->demonSlayerId)->hashira()->associate($hashira);
                        return $hashira->save();
                    } else {
                        return $this->result->save();
                    }
                }
            }
        }
        
    }
}
