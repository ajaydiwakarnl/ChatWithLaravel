<template>
    <div class="h-96 w-full">
        <div class="h-full p-2 flex flex-col-reverse overflow-scroll">
            <div v-for="(message,index) in messages" :key="index">
                  <message-item-component :message="message" ></message-item-component>
            </div>
        </div>
    </div>
</template>
<script>
import MessageItemComponent from "./MessageItemComponent";
export default {
    components: {MessageItemComponent},
    props:['messages']
}
</script>

