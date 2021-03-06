<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
//    protected $fillable = ['text'];

    public function ticket()
    {
        return $this->belongsTo('App\Ticket');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
