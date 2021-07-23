<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $getUserList = User::where('id','!=',auth()->user()->id)->get();
        return view('chat',compact('getUserList'));
    }

    public  function  getMessagesList(Request  $request){
        $getSendMessage =   Message::where('user_Id',$request->id)->where('senderId',auth()->user()->id)->get();
        $getReplyMessage =  Message::where('user_Id',auth()->user()->id)->where('senderId',$request->id)->get();
        $getUser = User::findorFail($request->id);
        return view('components.message-component',compact('getSendMessage','getReplyMessage','getUser'));
    }

    public function create(Request  $request){
        $client = new Client();
        $url = "http://localhost:3000/message/new";
        $response = $client->request('POST',
            $url, [
                    'headers' => [
                        'User-Agent' => 'testing/1.0',
                        'Accept' => 'application/json',
                        'X-Foo' => ['Bar', 'Baz']
                    ],
                    'form_params' => [
                        'user_id' =>  $request->receivedId,
                        'message' => $request->message,
                        'senderId' =>  $request->senderId,
                        'type' => $request->type,
                    ]
            ]);
        $response = $response->getBody()->getContents();
        if($response === "OK"){
            $message = new  Message;
            $message->user_id = $request->receivedId;
            $message->message = $request->message;
            $message->senderId = $request->senderId;
            $message->type = $request->type;
            $message->save();
        }
    }
}
