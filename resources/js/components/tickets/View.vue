<template>
    <div class="view-ticket" v-if="ticket">
        <h5>{{ ticket.title }}</h5>
        <h5>{{ ticket.description }}</h5>
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
        },
        data() {
            return {
                ticket: null
            }
        },
        computed: {
            currentUser() {
                return this.$store.getters.currentUser
            }
        }
    }
</script>
