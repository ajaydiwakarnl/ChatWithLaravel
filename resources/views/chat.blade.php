@extends('layouts.app')
@section('content')
    <script src='//production-assets.codepen.io/assets/editor/live/console_runner-079c09a0e3b9ff743e39ee2d5637b9216b3545af0de366d4b9aad9dc87e26bfd.js'></script><script src='//production-assets.codepen.io/assets/editor/live/events_runner-73716630c22bbc8cff4bd0f07b135f00a0bdc5d14629260c3ec49e5606f98fdd.js'></script><script src='//production-assets.codepen.io/assets/editor/live/css_live_reload_init-2c0dc5167d60a5af3ee189d570b1835129687ea2a61bee3513dee3a50c115a77.js'></script><meta charset='UTF-8'><meta name="robots" content="noindex"><link rel="shortcut icon" type="image/x-icon" href="//production-assets.codepen.io/assets/favicon/favicon-8ea04875e70c4b0bb41da869e81236e54394d63638a1ef12fa558a4a835f1164.ico" /><link rel="mask-icon" type="" href="//production-assets.codepen.io/assets/favicon/logo-pin-f2d2b6d2c61838f7e76325261b7195c27224080bc099486ddd6dccb469b8e8e6.svg" color="#111" /><link rel="canonical" href="https://codepen.io/emilcarlsson/pen/ZOQZaV?limit=all&page=74&q=contact+" />
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700,300' rel='stylesheet' type='text/css'>
    <script src="https://use.typekit.net/hoy3lrg.js"></script>
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css'><link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.2/css/font-awesome.min.css'>
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700,300' rel='stylesheet' type='text/css'>

    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <div class="chatcontent">
        <div id="frame">
            <div id="sidepanel">
                <div id="profile">
                    <div class="wrap">
                        <img id="profile-img" src="http://emilcarlsson.se/assets/mikeross.png" class="online" alt="" />
                        <p>{{auth()->user()->name}}</p>
                    </div>
                </div>
                <div id="search">
                    <label for=""><i class="fa fa-search" aria-hidden="true"></i></label>
                    <input type="text" placeholder="Search contacts..." />
                </div>
                <div id="contacts">
                    <ul>
                        @foreach($getUserList as $getUser)
                            <li class="contact" onclick="getConversation({{ $getUser->id }})" >
                                <div class="wrap">
                                    <span class="contact-status online"></span>
                                    <img src="http://emilcarlsson.se/assets/louislitt.png" alt="" />
                                    <div class="meta">
                                        <p class="name">{{$getUser->name}}</p>
                                        <p class="preview">You just got LITT up, Mike.</p>
                                    </div>
                                </div>
                            </li>
                            <input type="hidden" value="" id="receivedId">
                        @endforeach

                    </ul>
                </div>
            </div>
            <div  class="content" id="chat-content">
                <img src="{{asset('images/chat.png')}}" class="startConverstionIcon">
                <div class="startConverstionText">Lets  start your conversation with your friend</div>
            </div>

        </div>
    </div>

    <script>
        function  getConversation(id){

            $.ajax({
                url: "{{route('getMessages')}}",
                type: "post",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id
                },
                success: function (response) {
                    $('#receivedId').val(id);
                    $('#chat-content').html(response);

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }

    </script>

@endsection

