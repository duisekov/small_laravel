<template>
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">
                <div class="card-body">
                    <h5 class="card-title text-center">Войти</h5>
                    <form class="form-signin" method="post" @submit.prevent="authenticate">
                        <div class="form-label-group">
                            <strong>Email</strong>
                            <input type="email" v-model="form.email" class="form-control" placeholder="Email" required autofocus>
                        </div>

                        <div class="form-label-group">
                            <strong>Password</strong>
                            <input type="password" v-model="form.password" class="form-control" placeholder="Пароль" required>
                        </div>
                        <hr>
                        <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Войти</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {login} from '../../helpers/auth';

    export default {
        name: 'login',
        data() {
            return {
                form: {
                    email: '',
                    password: ''
                },
                error: null
            };
        },
        methods: {
            authenticate() {
                this.$store.dispatch('login');

                login(this.$data.form)
                    .then((res) => {
                        this.$store.commit('loginSuccess', res);
                        this.$router.push({path: '/'});
                    })
                    .catch((error) => {
                        this.$store.commit('loginFailed', {error});
                    })
            }
        }
    }
</script>
