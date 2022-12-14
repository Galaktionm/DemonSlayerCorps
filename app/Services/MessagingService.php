<?php

namespace App\Services;

use App\Models\Message;
use Illuminate\Database\Eloquent\Collection;

class MessagingService {

    public static function saveMessages(string $sender, array $names, string $messageBody){

        foreach($names as $name){
            $message=new Message();
            $message->sender=$sender;
            $message->recipient=$name->username;
            $message->messageBody=$messageBody;
            $message->save();
        }

    }


}
