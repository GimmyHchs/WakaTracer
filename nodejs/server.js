var app = require('express')();
var server = require('http').Server(app);
var io = require('socket.io')(server);


// var Redis = require('ioredis');
// var redis = new Redis();
server.listen(8890);
io.on('connection', function (socket) {
    console.log('connection!!');
});
console.log('listen port 8890...');
// redis.subscribe('global-channel');
//
// redis.on('message', function(channel, message){
//     console.log(channel);
//     console.log(message);
//     message = JSON.parse(message);
//     io.emit(channel + ':' + message.event, message.data);
// });
