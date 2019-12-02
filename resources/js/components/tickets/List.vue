<template>
    <div>
        <template v-if="!tickets.length">
            <h5 colspan="2" class="text-center">Тикеты отсутствуют</h5>
        </template>
        <template v-else>
            <h2 align="center">Просмотр всех тикетов</h2>
            <div v-for="ticket in tickets" :key="ticket.id" class="card mt-4">
                <div class="card-header">
                    <div class="float-left">{{ ticket.user.name }}</div>
                    <div class="float-right">{{ ticket.department.name }}  {{ticket.created_at}}</div>
                </div>
                <div class="card-body">
                    <h5 class="card-title">
                        {{ ticket.title }}
                    </h5>
                    <h6 class="card-subtitle mb-2 text-muted">
                        {{ ticket.description}}
                    </h6>
                    <div v-if="ticket.last_response">
                        <hr>
                        Последний ответ:
                        <br>
                        <div class="float-left">{{ ticket.last_response.text}}</div>
                        <div class="float-right">{{ ticket.last_response.created_at}}</div>
                    </div>
                    <br>
                    <div class="float-left">
                        <router-link :to="`/tickets/${ticket.id}`" class="btn btn-primary">К диалогу</router-link>
                    </div>
                    <div v-if="currentUser.role_id == 1 && ticket.is_active == 1" class="float-right">
                        <button @click="closeTicket(ticket.id)" class="btn btn-danger mb-2 mr-3">Закрыть тикет</button>
                    </div>
                    <div v-else-if="currentUser.role_id == 1 || currentUser.role_id == 2 && ticket.is_active == 0" class="float-right mt-2">
                        Тикет закрыт
                    </div>
                    <div v-else class="float-right">

                    </div>
                </div>
            </div>
        </template>
    </div>
</template>

<script>
    export default {
        name: 'list',
        mounted() {
            if (this.tickets.length) {
                return;
            }

            this.$store.dispatch('getTickets');
        },
        computed: {
            tickets() {
                return this.$store.getters.tickets;
            },
            currentUser() {
                return this.$store.getters.currentUser;
            }
        },
        methods: {
            closeTicket(id) {
                axios.put(`/api/tickets/${id}`, {}, {
                    headers: {
                        "Authorization": `Bearer ${this.currentUser.token}`
                    }
                });
                window.location.reload();
            },
        },
        data() {
            return {
                url: 'api/tickets',
                pagination: {}
            }
        }
    }
</script>
