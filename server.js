const express = require('express');
const app = express();
const server  = require('http').createServer(app);
const io = require('socket.io')(server,{
    cors:{origin:"*"}
});
const bodyParser = require('body-parser');
require('dotenv').config({path: '.env'});
const port = process.env.PORT;

app.use(bodyParser.urlencoded({ extended: true }));
app.use(bodyParser.json());


app.post('/message/new', (req, res) => {
    io.sockets.emit("message.new", req.body);
    res.sendStatus(200);
});



io.on('connection', (socket) => {
    socket.on('start_typing', (data) => {
        io.sockets.emit("start_typing", data);
    });
    socket.on('stop_typing', (data) => {
        io.sockets.emit("stop_typing", data);
    });
});

server.listen(port, function(){
    console.log('listening on *:' + port);
});
