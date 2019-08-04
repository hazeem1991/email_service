<template>
    <main-layout>
        <div class="card mt-3">
            <div class="card-body">
                <div class="card-title">
                    About This App
                </div>
            </div>
            <div class="card-body">
                i build this project to applay realtime chat app with laravel backend and socket.io as we know we can not use socket.io without node
                and using php socket is so complicated there is a serise in laracast Real time with laravel socket IO.
                from this serise i got the idea of building this kinde of app
                it is so complcated i used laravel 5.4 and enabled event brodcating with Redis so i can make connection with the node
                and the node with sockec.io will do the rest by connection with the client app (written in vuejs) in the client app after i login i lestin to the socket that comes from the node side after firing from laravel so i have this stack for a chat app backbone
                <br>
                <br>
                all most of the code are wrote in the Chat.vue
                i written some coments in the code for help
                <br>
                <br>
                For any Informayion Plase Contact me at hazeem.arian@gmail.com
            </div>
        </div>
    </main-layout>
</template>

<script>
    import MainLayout from '../layouts/Main.vue'
    export default {
        components: {
            MainLayout
        }
    }
</script>