<template>
    <h1 class="h3 mb-3">Messages</h1>
    <div class="card">
        <div class="row">
            <div class="col-12">
                <div class="py-2 px-4 border-bottom">

                    <div class="position-relative">
                        <div class="chat-messages p-4">

                            <div class="chat-message-right mb-4">
                                <div class="flex-shrink-1 bg-primary text-light rounded py-2 px-3 mr-3">
                                    <div class="font-weight-bold mb-1">YOUR NAME</div>
                                    Morbi finibus, lorem id placerat ullamcorper, nunc enim ultrices massa, id
                                    dignissim metus urna eget purus.
                                </div>
                            </div>

                            <div class="chat-message-left pb-4">
                                <div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
                                    <div class="font-weight-bold mb-1">CHATTERS NAME</div>
                                    Sed pulvinar, massa vitae interdum pulvinar, risus lectus porttitor magna,
                                    vitae
                                    commodo lectus mauris et velit.
                                    Proin ultricies placerat imperdiet. Morbi varius quam ac venenatis tempus.
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="py-3 px-4 border-top">
                        <div class="row g-3">
                            <div class="col-sm-2">
                                <input type="text" class="form-control" placeholder="Your name" aria-label="Your name">
                            </div>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Your message"
                                    aria-label="Your message">
                            </div>
                            <div class="col-sm text-end">
                                <button type="button" class="btn btn-primary" aria-label="Send message">Send</button>
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
            counter: 0,
        }
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
</style>