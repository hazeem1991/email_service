<template>
    <div class="card mt-3">
        <div class="card-body">
            <div class="card-title">
                List Of Messages
            </div>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Type</th>
                    <th>Sender</th>
                    <th>Recipients</th>
                    <th>Subject</th>
                    <th>Body</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="message in messages">
                    <td>{{message.id}}</td>
                    <td>{{message.type}}</td>
                    <td>{{message.sender}}</td>
                    <td>{{message.recipients}}</td>
                    <td>{{message.subject}}</td>
                    <td>{{message.body}}</td>
                    <td>{{message.created_at}}</td>
                    <td>
                        <div v-if="message.status === '0'">
                            <span class="badge badge-secondary">Added</span>
                        </div>
                        <div v-else-if="message.status === '1'">
                            <span class="badge badge-warning">In Queue</span>
                        </div>
                        <div v-else-if="message.status === '2'">
                            <span class="badge badge-success">Sent</span>
                        </div>
                        <div v-else-if="message.status === '3'">
                            <span class="badge badge-danger">Not Sent</span>
                        </div>
                        <div v-else>
                            <span class="badge badge-danger">Not Sent</span>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import Config from '../config.js';

    export default {

        name: 'message_list',
        created() {
            $axios.get(`${Config['serverLink']}/messages/`)
                .then((response) => {
                    this.messages=response.data.data;
                }, (error) => {
                    this.$toasted.global.my_app_error({
                        message: error.response.data.message
                    });
                })
        },
        data() {
            return {messages: []}
        }
    }
</script>