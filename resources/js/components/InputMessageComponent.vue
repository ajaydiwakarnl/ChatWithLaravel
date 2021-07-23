<template>
    <div class="relative h-10 m-1">
        <div class="row">
            <div class="col-lg-10">
                <input
                    type="text"
                    v-model="message"
                    @keyup.enter="sendMessage()"
                    placeholder="Type the your message..."
                    class="form-control"
                />
            </div>
            <div class="col-lg-2">
                <button @click="sendMessage()" class="btn btn-primary">Send</button>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props:['room'],
    data:function (){
        return{
            message:''
        }
    },
    methods:{
        sendMessage(){
            if(this.message === ''){
                return;
            }
            axios.post('/chat/room/'+this.room.id+'/message',{
                message:this.message
            })
            .then(response => {
                if(response.status === 201){
                    this.message = '';
                    this.$emit('messagesent');
                }
            }).catch(error => {
                console.log(error);
            })
        }
    }
}
</script>
