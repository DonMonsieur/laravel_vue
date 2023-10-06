import axios from "axios";
import store from "../store";
import router from "../router";

const api = axios.create({
    baseURL: "http://127.0.0.1:8000/api/",
});

api.interceptors.request.use((config) => {
    const token = store.state.user.token;
    config.headers.Authorization = `Bearer ${token}`;
    return config;
});

api.interceptors.response.use(
    (response) => {
        return response;
    },
    (error) => {
        if (error.response.status === 401) {
            store.commit("setToken", null);
            router.push({ name: "login" });
        }
        throw error;
    }
);

export default api;
