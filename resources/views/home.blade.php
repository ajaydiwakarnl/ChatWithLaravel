@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <h2>Messages</h2>

                                <div id="sent-message">
                                    <ul> </ul>
                                </div>

                                <div id="recevied-message">
                                    <ul> </ul>
                                </div>

                                <div class="input-group">
                                    <input type="text" name="message"  id="message" class="form-control" placeholder="Type your message here...">

                                    <button  class="btn btn-primary" id="sendChat"> Send </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script>
    $(function() {
        let ipAddress = 'localhost';
        let serverPort = '3000';
        let socket = io(ipAddress  + ':' + serverPort);
        socket.on('connected successfully')

        $('#sendChat').click(function (){
            let getMessage = $('#message').val();
            $('#sent-message ul').append(
                '<div class="text-right card bg-success"><div class="card-body text-white">'+getMessage+'</div></div>&nbsp;');
            socket.emit('sendChatToServer',getMessage);
            $('#message').val('')
        })

        socket.on('sendChatToClient',(message) => {
            $('#recevied-message ul').append('<div class="text-right card bg-white"><div class="card-body text-black-50">'+message+'</div></div>&nbsp;');
        });
    });
</script>
