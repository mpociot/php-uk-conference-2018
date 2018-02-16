<template>
    <div class="chatbox">
        <div class="chatbox__list">
            <p v-for="message in messages">
                <template v-if="message.user !== 'botman'">
                    {{message.user}} {{ message.text }}
                </template>
                <template v-else>
                    <img src="/img/logo.png" style="margin-bottom: -8px;" height="50"> {{ message.text }}
                </template>
                <template v-if="message.actions">
                    <button style="font-size: 30px;" @click="respondButton(button)" v-for="button in message.actions" :value="button.value">{{ button.text }}</button>
                </template>
                <img v-if="message.attachment.type === 'image' && message.attachment.url" style="height:100px;border:none;background:none;box-shadow:none;" :src="message.attachment.url" />
                <video height="160" v-if="message.attachment.type === 'video' && message.attachment.url" autoplay="">
                    <source :src="message.attachment.url" type="video/mp4">
                </video>
            </p>
        </div>
        <div class="chatbox__input">
            <input type="text" @keyup.ctrl.76="clearMessage" @keyup.left="prevSlide" @keyup.right="nextSlide" @keyup.enter="sendMessage" v-model="newMessage" placeholder="">
        </div>
    </div>
</template>

<style type="text/css">
    .chatbox {
        min-width: 100%;
        min-height: 40%;
    }
    .chatbox__input {
        width: 100%;
    }
    .chatbox__input input {
        font-size: 25px;
        width: 80%;
    }
</style>

<script>
    export default {
        data() {
            return {
                messages: [],
                newMessage: null
            };
        },

        methods: {
            prevSlide() {
                Reveal.navigatePrev();
            },

            nextSlide() {
                Reveal.navigateNext();
            },

            clearMessage() {
                this.messages = [];
            },

            respondButton: function(button) {
                let self = this;
                this.messages = [];
                this.messages.push({
                    'user': '👨',
                    'text': button.text,
                    'attachment': {}
                });

                this.$http.post('/botman', {
                    driver: 'web',
                    userId: 9999999,
                    message: button.value
                }).then(response => {
                    let messages = response.body.messages || [];
                    messages.forEach(function(msg) {
                        self.messages.push({
                            'user': 'botman',
                            'text': msg.text,
                            'attachment': msg.attachment || {},
                            'actions': msg.actions || []
                        });
                    });
                }, response => {

                });
            },

            sendMessage() {
                let self = this;
                let messageText = this.newMessage;
                this.newMessage = '';
                if (messageText === 'clear') {
                    this.messages = [];
                    return;
                }
                this.messages.push({
                    'user': '👨',
                    'text': messageText,
                    'attachment': {},
                });
                this.$http.post('/botman', {
                    driver: 'web',
                    userId: 9999999,
                    message: messageText
                }).then(response => {
                    let messages = response.body.messages || [];
                    messages.forEach(function(msg) {
                        self.messages.push({
                            'user': 'botman',
                            'text': msg.text,
                            'attachment': msg.attachment || {},
                            'actions': msg.actions || []
                        });
                    });
                }, response => {

                });
            }
        }
    }
</script>
