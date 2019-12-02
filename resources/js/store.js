import {getLocalUser} from "./helpers/auth";

const user = getLocalUser();

export default {
    state: {
        currentUser: user,
        isLoggedIn: !!user,
        loading: false,
        auth_error: null,
        tickets: []
    },
    mutations: {
        login(state) {
            state.loading = true;
            state.auth_error = null;
        },
        loginSuccess(state, payload) {
            state.auth_error = null;
            state.isLoggedIn = true;
            state.loading = false;
            state.currentUser = Object.assign({}, payload.user, {token: payload.token.token});

            localStorage.setItem("user", JSON.stringify(state.currentUser));
        },
        loginFailed(state, payload) {
            state.loading = false;
            state.auth_error = payload.error;
        },
        logout(state) {
            localStorage.removeItem("user");
            state.isLoggedIn = false;
            state.currentUser = null;
            state.tickets = [];
        },
        updateTickets(state, payload) {
            state.tickets = payload;
        }
    },
    getters: {
        isLoading(state) {
            return state.loading;
        },
        isLoggedIn(state) {
            return state.isLoggedIn;
        },
        currentUser(state) {
            return state.currentUser;
        },
        authError(state) {
            return state.auth_error;
        },
        tickets(state) {
            return state.tickets;
        }
    },
    actions: {
        login(context) {
            context.commit("login");
        },
        getTickets(context) {
            axios.get('/api/tickets', {
                headers: {
                    "Authorization": `Bearer ${context.state.currentUser.token}`
                }
            }).then((response) => {
                context.commit('updateTickets', response.data.data);
            })
        }
    }
}
