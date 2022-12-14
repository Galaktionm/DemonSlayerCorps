<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model {

    protected $sender;

    protected $recipient;

    protected $messageBody;
}