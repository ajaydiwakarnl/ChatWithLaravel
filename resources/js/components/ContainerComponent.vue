<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div>
                            <chat-room-selection-component
                                v-if="currentRoom.id"
                                :rooms="chatRooms"
                                :currentRoom="currentRoom"
                                v-on:roomChanged="setRooms($event)"
                            ></chat-room-selection-component>
                        </div>
                    </div>
                    <div class="card-body">
                       <message-container-component :messages="message" ></message-container-component>
                       <input-message-component :room="currentRoom" v-on:messagesent="getMessages()"></input-message-component>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import messageContainer from "./MessageContainerComponent";
import inputMessage from "./InputMessageComponent";
import ChatRoomSelectionComponent from "./ChatRoomSelectionComponent";

export default {
    components:{
        ChatRoomSelectionComponent,
        messageContainer,
        inputMessage,
    },
    data: function (){
        return{
            chatRooms:[],
            currentRoom:[],
            message:[]
        }
    },
    watch:(){
        currentRoom(){
            this.connect();
        }
    },
    methods:{
        connect(){
            if(this.currentRoom.id){
                let vm = this;
                this.getMessages();
                window.Echo.private('chat.'+this.currentRoom.id).listen('.message.new',e => {
                    vm.getMessages();
                })
            }
        },
        getRooms(){
            axios.get('/chat/rooms').then(response => {
                this.chatRooms = response.data;
                this.setRooms(response.data[0]);
            }).catch(error => {
                console.log(error);
            })

        },
        setRooms(room){
            this.currentRoom = room;
            this.getMessages();
        },
        getMessages(){
            axios.get('/chat/room/' + this.currentRoom.id + '/messages').then(response => {
                this.message = response.data;
            }).catch(error => {
                console.log(error);
            })
        }
    },
    created(){
      this.getRooms();

    }

}
</script>
