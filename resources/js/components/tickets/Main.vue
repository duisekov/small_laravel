<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2 align="center">Просмотр всех тикетов</h2>
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'tickets-main'
    }
</script>
