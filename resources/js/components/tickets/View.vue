<template>
    <div class="view-ticket" v-if="ticket">
        <h2 align="center">Тикет</h2>
        <div class="card">
            <div class="card-header">
                <div class="float-left">{{ ticket.user_id }}</div>
                <div class="float-right">{{ ticket.department_id }}  {{ticket.created_at}}</div>
            </div>
            <div class="card-body">
                <h5 class="card-title">
                    {{ ticket.title }}
                </h5>
                <h6 class="card-subtitle mb-2 text-muted">
                    {{ ticket.description}}
                </h6>
            </div>
        </div>
        <div class="messages" v-if="messages.length > 0">
            <h2 align="center">Диалог</h2>
            <div v-for="message in messages" class="card mb-2">
                <div class="card-header">
                    <div class="float-left">{{ message.user.name }}</div>
                    <div class="float-right">{{ message.created_at }}</div>
                </div>
                <div class="card-body">
                    {{ message.text }}
                </div>
            </div>
        </div>
        <form @submit.prevent="newMessage" v-if="ticket.is_active == 1">
            <h2 align="center">Отправить сообщение</h2>
            <textarea v-model="message.text" name="text" cols="30" rows="3" placeholder="Введите сообщение" class="form-control"></textarea>
            <input type="submit" value="Отправить сообщение" class="btn btn-success mt-2 float-right">
        </form>
    </div>
</template>

<script>
    export default {
        name: 'view',
        created() {
            axios.get(`/api/ticket/${this.$route.params.id}`, {
                headers: {
                    "Authorization": `Bearer ${this.currentUser.token}`
                }
            })
                .then((response) => {
                    this.ticket = response.data.data;
                })
            axios.get(`/api/tickets/${this.$route.params.id}/messages`, {
                headers: {
                    "Authorization": `Bearer ${this.currentUser.token}`
                }
            })
                .then((response) => {
                    this.messages = response.data.data;
                })
        },
        data() {
            return {
                ticket: null,
                messages: [],
                message: {
                    text: '',
                }
            }
        },
        computed: {
            currentUser() {
                return this.$store.getters.currentUser
            }
        },
        methods: {
            newMessage() {
                console.log(this.$data.ticket);
                axios.post(`/api/tickets/${this.$route.params.id}/messages`, this.$data.message, {
                    headers: {
                        "Authorization": `Bearer ${this.currentUser.token}`
                    }
                })
                    .then((response) => {
                        window.location.reload();
                    });
            }
        }
    }
</script>
