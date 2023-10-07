import { createStore } from "vuex";

const store = createStore({
    state: {
        user: {
            token: localStorage.getItem("ACCESS_TOKEN"),
            data: {},
        },
    },
    mutations: {
        setUser(state, user) {
            state.user = user;
        },
        setToken(state, token) {
            state.user.token = token;
            localStorage.setItem("ACCESS_TOKEN", token);
        },
    },
    actions: {},
    getters: {},
});

export default store;
