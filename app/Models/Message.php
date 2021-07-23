<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'message'
    ];

    public function room(){
        return $this->hasOne('App\Models\ChatRoom','id','chat_room_id');
    }


    public function user(){
        return $this->hasOne('App\Models\User','id','user_id');
    }

}
