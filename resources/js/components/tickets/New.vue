<template>
    <div class="new-ticket">
        <form @submit.prevent="add">
            <strong>Заголовок</strong>
            <input type="text" class="form-control" v-model="ticket.title" required>
            <strong>Описание</strong>
            <input type="text" class="form-control" v-model="ticket.description" required>
            <strong>Отдел</strong>
            <br>
            <select v-model="ticket.department_id" required>
                <option value="1">IT отдел</option>
                <option value="2">Финансовый отдел</option>
                <option value="3">Отдел продаж</option>
            </select>
            <hr>
            <input type="submit" value="Создать" class="btn btn-primary">
        </form>
    </div>
</template>

<script>
    export default {
        name: 'new',
        data() {
            return {
                ticket: {
                    title: '',
                    description: '',
                    department_id: ''
                },
                errors: null
            };
        },
        computed: {
            currentUser() {
                return this.$store.getters.currentUser;
            }
        },
        methods: {
            add() {
                console.log(this.$data.ticket);
                axios.post('/api/tickets', this.$data.ticket, {
                    headers: {
                        "Authorization": `Bearer ${this.currentUser.token}`
                    }
                })
                    .then((response) => {
                        this.$router.push('/tickets');
                    });
            }
        }
    }
</script>
