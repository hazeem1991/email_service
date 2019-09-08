<template>
    <div class="card mt-3">
        <div class="card-body">
            <div class="card-title">
                List Of Logs
            </div>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Sender</th>
                    <th>Recipients</th>
                    <th>RawResponse</th>
                    <th>Provider</th>
                    <th>Message</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="log in logs" v-bind:key="log.id">
                    <td>{{log.id}}</td>
                    <td>{{log.sender}}</td>
                    <td>{{log.recipients}}</td>
                    <td>
                        <b-button v-b-tooltip.hover :title=log.rawResponse>View Response</b-button>
                    </td>
                    <td>{{log.provider}}</td>
                    <td>
                        <b-button v-b-tooltip.hover :title=log.message>View Message</b-button>
                    </td>
                    <td>{{log.created_at}}</td>
                    <td>
                        <div v-if="log.status === 0">
                            <span class="badge badge-danger">Not Sent</span>
                        </div>
                        <div v-else-if="log.status === 1">
                            <span class="badge badge-success">Sent</span>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    /* eslint-disable */
    import Config from '../config.js';

    export default {

        name: 'message_list',
        created() {
            $axios.get(`${Config['serverLink']}/log/`)
                .then((response) => {
                    this.logs = response.data.data;
                }, (error) => {
                    this.$toasted.global.my_app_error({
                        message: error.response.data.message
                    });
                })
        },
        data() {
            return {logs: []}
        }
    }
</script>