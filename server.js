const express = require('express');
const app = express();
const server  = require('http').createServer(app);
const socketIo = require('socket.io')(server,{
    cors:{origin:"*"}
});



socketIo.on('connection',(socket) => {
    console.log("Connected");

    socket.on('sendChatToServer',(message) => {
        console.log(message);
        socket.broadcast.emit('sendChatToClient',message);
    });


    socket.on('disconnect',(socket) => {
        console.log("disConnected");
    });

})


server.listen(3000,() => {
    console.log("Server run")
})

