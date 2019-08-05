<template>
    <div class="card mt-3">
        <div class="card-body">
            <div class="card-title">
                List Of Messages
            </div>
        </div>
        <div class="card-body">
            <form class="needs-validation" v-on:submit="submit" method="post">
                <div class="form-row">
                    <div class="col-md-3 mb-3">
                        <label for="SenderEmail">Sender Email</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" v-b-tooltip.hover
                                      title="For some providers you MUST use the email that you register with">!</span>
                            </div>
                            <input type="email" class="form-control" id="SenderEmail" name="SenderEmail"
                                   placeholder="Sender Email"
                                   required>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="RecipientEmail">Receiver Email</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" v-b-tooltip.hover
                                      title="For more than one recipient seperate emails with `,` comma">!</span>
                            </div>
                            <input type="text" class="form-control" id="RecipientEmail" name="RecipientEmail"
                                   placeholder="Recipient"
                                   required>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="Subject">Subject</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="Subject" name="Subject" placeholder="Subject"
                                   required>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="Type">Type</label>
                        <div class="input-group">
                            <select id="Type" name="Type" class="form-control" @change="onChange($event)">
                                <option>Select Type</option>
                                <option v-for="message_type in message_types" v-bind:key="message_type"
                                        :value=message_type>{{message_type}}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 message-container" v-if="message_type==='plain'">
                        <textarea id="Body" name="Body"></textarea>
                    </div>
                    <div class="col-md-12 message-container" v-if="message_type==='html'">
                        <ckeditor :editor="editor" v-model="editorData" :config="editorConfig"></ckeditor>
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">Send</button>
            </form>
        </div>
    </div>
</template>
<script>
    /* eslint-disable */
    import Config from '../config.js';
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

    export default {
        name: 'add_message',
        created() {
            $axios.get(`${Config['serverLink']}/messages/add`)
                .then((response) => {
                    this.message_types = response.data.data.message_types;
                }, (error) => {
                    this.$toasted.global.my_app_error({
                        message: error.response.data.message
                    });
                })
        },
        methods: {
            submit(event) {
                event.preventDefault();
                let sender = event.target.elements.SenderEmail.value;
                let recipients = event.target.elements.RecipientEmail.value;
                let type = event.target.elements.Type.value;
                let subject = event.target.elements.Subject.value;
                let body;
                if (type === 'html') {
                    body = this.editorData
                } else if (type === 'plain') {
                    body = this.event.target.elements.Body.value;
                }
                let data = {
                    sender: sender,
                    subject: subject,
                    recipients: recipients.split(','),
                    type: type,
                    body: body
                };
                $axios.post(`${Config['serverLink']}/messages/add`, data)
                    .then((response) => {
                        this.$toasted.global.my_app_done({
                            message: "Message Sent"
                        });
                        this.$router.push('/messages')
                    }, (error) => {
                        console.log(error.response.data.errors);
                        Object.keys(error.response.data.errors).map((value) => {
                            this.$toasted.global.my_app_error({
                                message: error.response.data.errors[value][0]
                            });
                        })

                    })

            },
            onChange(event) {
                this.message_type = event.target.value;
            }
        },
        data() {
            return {
                message_types: [],
                message_type: 'plain',
                editorConfig: {
                    toolbar: {
                        items: [
                            'heading',
                            '|',
                            'bold',
                            'italic',
                            'link',
                            'bulletedList',
                            'numberedList',
                            'blockQuote',
                            'undo',
                            'redo'
                        ]
                    },
                },
                editor: ClassicEditor,
                editorData: '<p></p>',
            }
        }
    }
</script>
<style>
    .message-container {
        height: 250px;
    }

    .ck.ck-editor {
        height: 80%;
    }

    .ck-content, .ck-editor__main {
        height: 100%;
    }

    textarea {
        height: 90%;
        margin-bottom: 20px;
        float: left;
        width: 100%;
    }

    p {
        text-align: left;
    }
</style>