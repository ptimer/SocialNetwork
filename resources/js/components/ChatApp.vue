<template>
    <div class="chat-app">
        <Conversation :contact="selectedContact" :messages="messages" @new="saveNewMessage" />
        <ContactsList :contacts="contacts" @selected="startConversationWith" />
    </div>
</template>

<script>
    import Conversation from './Conversation';
    import ContactsList from './ContactsList';
    export default {

        props: {
            user: {
                type: Object,
                required: true
            }
        },

        data(){
            return{
                selectedContact: null,
                messages: [],
                contacts: []
            };
        },

        mounted() {
            Echo.private('messages.' + this.user.id)
                .listen('NewMessage', (e) => {
                    this.handleIncoming(e.message);
                });

            axios.get('/message/contacts')
            .then((response) => {
                this.contacts = response.data;
                console.table(this.contacts);
            });
        },

        methods: {
            startConversationWith(contact){
                axios.get('/conversation/' + contact.id)
                .then((response) => {
                    this.messages = response.data;
                    this.selectedContact = contact;
                })
            },
            saveNewMessage(text){
                this.messages.push(text);
            },

            handleIncoming(message){
                if(this.selectedContact && message.from == this.selectedContact.id){
                    this.saveNewMessage(message);
                    return;
                }

                console.log(message.text);
            }
        },

        components: {Conversation, ContactsList}
    }
</script>

<style lang="scss" scoped>
.chat-app {
    display: flex;
}
</style>
