const chatForm = document.getElementById('chat-form');
const chatMessages = document.querySelector('.chat-messages');
const roomName = document.getElementById('room-name');
//Get username and room from URL
const username="Admin";
const {room}=Qs.parse(location.search,{
    ignoreQueryPrefix:true
});
console.log(`Joined ${room}`);
roomName.innerText=room

const socket=io();

//Join Chatroom
socket.emit('joinRoom',{room});

//Get room and users
socket.on('message', message =>{
    console.log(message);
    outputMessage(message);

    //scroll down
    chatMessages.scrollTop = chatMessages.scrollHeight;

});

//Message submit
chatForm.addEventListener('submit',(e)=>{
    e.preventDefault();
//Get message
    const msg=e.target.elements.msg.value;
//Emit message to server
    socket.emit('chatMessage',msg);

//Clear chatbox
    e.target.elements.msg.value='';
    e.target.elements.msg.focus();
});

//Load Old Messages
socket.on('Load Old Message',function(docs){
        for(var i=0;i<docs.length;i++){
            outputMessage(docs[i]);
        }
});
//Output message to DOM
function outputMessage(message){
    const div=document.createElement('div');
    div.classList.add('message');
    div.innerHTML=`<p class="meta">${message.username} <span>${message.time}</span></p>
    <p class="text">
        ${message.text}
    </p>`;
    document.querySelector('.chat-messages').appendChild(div);
}

