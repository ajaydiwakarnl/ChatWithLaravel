<?php

namespace App\Http\Controllers;

use App\Models\ChatRoom;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\NewChatMessage;
class ChatController extends Controller
{
    public function  rooms(Request $request){
        return ChatRoom::all();
    }

    public  function  messages (Request  $request,$roomId){
        return Message::where('chat_room_id',$roomId)->with('user')->orderBy('created_at','DESC')->get();
    }

    public function  newMessage(Request  $request,$roomId){
        $message = new Message;
        $message->user_id = auth()->user()->id;
        $message->chat_room_id = $roomId;
        $message->message = $request->message;
        $message->save();

        broadcast(new NewChatMessage($message))->toOthers();
        return $message;
    }
}
