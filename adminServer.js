const path = require('path');
const http = require('http');
const express = require('express');
const socketio=require('socket.io');
const moment=require('moment');
mongoose = require('mongoose');
const formatMessage = require('./utils/messages');
const {userJoin,getCurrentUser,userLeave,getRoomUsers}= require('./utils/users');


const app = express();
const server = http.createServer(app);
const io = socketio(server);
//database connect
mongoose.connect('mongodb://localhost/chat',function(err){
    if(err){
        console.log(err);
    }
    else {
        console.log('MongoDB Connected Successfully');
    }
});

//creating Schema 
var chatSchema = mongoose.Schema({
    username: String,    
    time: String,
    text: String,
});



//Set static folder
app.use(express.static(path.join(__dirname,'/')));

const adminName = 'Admin - MediHelp';

//Run when a client connects
io.on('connection',socket =>{
    
    socket.on('joinRoom',({room})=>{
        const user = userJoin(socket.id,room);
        socket.join(user.room);
        var Chat = mongoose.model(user.room, chatSchema);

        socket.emit('message',formatMessage(adminName,'Welcome to MediHelpChatRoom'));
        
        //Broadcast when a user connects
        socket.broadcast
        .to(user.room)
        .emit('message', formatMessage(adminName, `${adminName} has made an announcement!`));    
           
        //send users and room info
            io.to(user.room).emit('roomUsers',{
                room:user.room,
                users: getRoomUsers(user.room)
            });
            Chat.find({},function(err,docs)
            {
                if(err) throw err;
                socket.emit('Load Old Message',docs);
            });
            socket.on('chatMessage',msg=>{

                const user= getCurrentUser(socket.id);
                var newMsg = new Chat({username:adminName,time:moment().format('DD/MM/YYYY hh:mm a'),text:msg});
                newMsg.save(function(err){
                    if(err) throw err;
                    io.to(user.room).emit('message',formatMessage(adminName,msg));
                });
               
            });
    });
    
    //Client disconnects
        socket.on('disconnect',()=>{
            const user = userLeave(socket.id);
            if(user){
                 //send users and room info
            io.to(user.room).emit('roomUsers',{
                room:user.room,
                users: getRoomUsers(user.room)
            });
            }
            
        });
});

const PORT = 8008 || process.env.PORT;

server.listen(PORT, () => console.log ('Server running on port',PORT));