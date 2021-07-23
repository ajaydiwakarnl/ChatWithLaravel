    <div id="chatContent">
        <div class="contact-profile">
            <img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />
            <p>{{$getUser->name}}</p>
        </div>

        <div class="messages">
                <ul>
                    @if($getSendMessage->count() > 0 || $getReplyMessage->count() > 0)
                        @foreach($getSendMessage as $message )
                            <li class="sent">
                                <img src="http://emilcarlsson.se/assets/mikeross.png" alt="" />
                                <p>{{$message->message}}</p>
                                </li>
                            @endforeach
                        @foreach($getReplyMessage as $message )
                            <li class="replies">
                                <img src="http://emilcarlsson.se/assets/mikeross.png" alt="" />
                                <p>{{$message->message}}</p>
                                </li>
                            @endforeach
                    @else
                        <div class="text-center" style="margin-top: 10px;">
                            Let start your conversation with {{$getUser->name  }}
                            </div>
                    @endif

                </ul>
        </div>

    </div>
    <div class="message-input">
        <div class="wrap">
            <input type="text" placeholder="Write your message..." />
            <i class="fa fa-paperclip attachment" aria-hidden="true"></i>
            <button  class="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
        </div>
    </div>
    <script>

        $(".messages").animate({ scrollTop: $(document).height() }, "fast");

        function newMessage() {
            message = $(".message-input input").val();
            if($.trim(message) === '') {
                return false;
            }
            $('<li class="sent"><img src="http://emilcarlsson.se/assets/mikeross.png" alt="" /><p>' + message + '</p></li>').appendTo($('.messages ul'));
            $('.message-input input').val(null);
            $('.contact.active .preview').html('<span>You: </span>' + message);
            $(".messages").animate({ scrollTop: $(document).height() }, "fast");
        }

        $('.submit').click(function() {
            receivedId = $('#receivedId').val();
            message = $(".message-input input").val();
            senderId = {{ auth()->user()->id }};
            if(message!== ""){
                type = 1
            }else{
                type = 2
            }
            $.ajax({
                url: "{{route('message.send')}}",
                type: "post",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "receivedId": receivedId,
                    "message": message,
                    "senderId": senderId,
                    "type":type,
                },
                success: function (response) {
                    newMessage()
                    replayMessage()
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        });
        function  replayMessage(){

        }
    </script>
