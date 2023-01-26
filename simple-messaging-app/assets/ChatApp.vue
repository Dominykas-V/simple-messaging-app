<template>
    <h1 class="h3 mb-3">Messages</h1>
    <div class="card m-6">
        <div class="row">
            <div class="col-12">
                <div class="py-2 px-4 border-bottom">
                    <div class="position-relative">
                        <div class="chat-messages p-4">
                            <template v-for="(message) in messages">
                                <template v-if="message.name === this.user_name">
                                    <div class="chat-message-right mb-4">
                                        <div class="flex-shrink-1 bg-primary text-light rounded py-2 px-3 mr-3">
                                            <div class="name-display mb-1">{{ message.name }}</div>
                                            {{ message.message }}
                                        </div>
                                    </div>
                                </template>
                                <template v-else>
                                    <div class="chat-message-left pb-4">
                                        <div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
                                            <div class="name-display mb-1">{{ message.name }}</div>
                                            {{ message.message }}
                                        </div>
                                    </div>
                                </template>
                            </template>
                        </div>
                    </div>
                    <div class="py-3 px-4 border-top">
                        <div class="row g-3">
                            <div class="col-sm-2">
                                <input type="text" class="form-control" placeholder="Your name" aria-label="Your name"
                                    v-model.lazy="user_name">
                            </div>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Your message"
                                    aria-label="Your message" v-model="user_message">
                            </div>
                            <div class="col-sm text-end">
                                <button type="button" class="btn btn-primary" aria-label="Send message"
                                    @click.prevent="postMessage">Send</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            messages: [],
            MESSAGES_CALL: '',

            user_name: '',
            user_message: '',

            emojis: [{ code: ":)", emoji: "😊" }, { code: ":(", emoji: "🙁" }, { code: ":p", emoji: "😋" }, { code: ":D", emoji: "😃" }],
        }
    },
    beforeDestroy() {
        clearInterval(this.MESSAGES_CALL)
    },
    watch: {
        user_message: function (val) {
            this.emojis.forEach((emoji) => {
                this.user_message = this.user_message.replace(emoji.code, emoji.emoji);
            })
        },
    },
    mounted: function () {
        this.MESSAGES_CALL = setInterval(() => {
            axios.post('/messages/', {
            })
                .then((response) => {
                    this.messages = response.data;
                })
                .catch((error) => {
                    console.log("Error mounted (MESSAGES_CALL) axios.");
                    console.log(error);
                })
        }, 1000)
    },
    methods: {
        postMessage(e) {
            e.preventDefault();
            axios.post('/messages/new', {
                name: this.user_name,
                message: this.user_message,
            })
                .then((response) => {
                    this.user_message = '';
                    if (response.data === 'error') {
                        alert("Message not sent.");
                    };
                })
                .catch((error) => {
                    console.log("Error during ax.");
                    console.log(error);
                });
        },
    }
}
</script>

<style scoped>
.card {
    -webkit-box-shadow: -2px -1px 15px 7px rgba(0, 0, 0, 0.5);
    -moz-box-shadow: -3px -2px 30px 14px rgba(0, 0, 0, 0.425);
    box-shadow: -4px -3px 45px 21px rgba(0, 0, 0, 0.35);
}

.chat-messages {
    display: flex;
    flex-direction: column;
    max-height: 800px;
    overflow-y: scroll
}

.chat-message-left,
.chat-message-right {
    display: flex;
    flex-shrink: 0
}

.chat-message-left {
    margin-right: auto
}

.chat-message-right {
    flex-direction: row-reverse;
    margin-left: auto
}

.py-3 {
    padding-top: 1rem !important;
    padding-bottom: 1rem !important;
}

.px-4 {
    padding-right: 1.5rem !important;
    padding-left: 1.5rem !important;
}

.flex-grow-0 {
    flex-grow: 0 !important;
}

.border-top {
    border-top: 1px solid #dee2e6 !important;
}

.name-display {
    font-weight: 650;
}
</style>