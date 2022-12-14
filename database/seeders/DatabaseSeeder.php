<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\DemonSlayer;
use App\Models\FinalSelectionResults;
use App\Models\Hashira;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    
    public function run()
    {
        $rengoku=new Hashira(['username'=>'Rengoku', 'name'=>'Kyoujuro Rengoku', 'password'=>Hash::make('password')]);
        $tengen=new Hashira(['username'=>'Tengen', 'name'=>'Tenten Uzui', 'password'=>Hash::make('password')]);
        $tanjiro=new DemonSlayer(['username'=>'Tanjiro', 'name'=>'Tanjiro Kamado', 'password'=>Hash::make('password')]);
        $inosuke=new DemonSlayer(['username'=>'Inosuke', 'name'=>'Inosuke Hashibara', 'password'=>Hash::make('password')]);
        $zenitsu=new DemonSlayer(['username'=>'Zenitsu', 'name'=>'Zenitsu Agatsuma', 'password'=>Hash::make('password')]);
        $hashiras=[$rengoku, $tengen];

        collect($hashiras)->map(function($hashira){
            return $hashira->save();
        });

        $tanjiro->hashira()->associate($rengoku);
        $inosuke->hashira()->associate($rengoku);
        $zenitsu->hashira()->associate($rengoku);
        $tanjiro->save();
        $inosuke->save();
        $zenitsu->save();

        $result1=new FinalSelectionResults();
        $result1->demonSlayerId=12;
        $result1->demonsKilled=12;
        $result1->demonsKilledAlone=3;
        $result1->save();

        $result2=new FinalSelectionResults();
        $result2->demonSlayerId=23;
        $result2->demonsKilled=45;
        $result2->demonsKilledAlone=5;
        $result2->save();

        $result3=new FinalSelectionResults();
        $result3->demonSlayerId=34;
        $result3->demonsKilled=14;
        $result3->demonsKilledAlone=6;
        $result3->save();

        

        
    }
}
