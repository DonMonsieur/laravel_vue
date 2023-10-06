import api from "../config/api";

export function getCurrentUser({ commit }, data) {
    return api.get("/user", data).then(({ data }) => {
        commit("setUser", data);
        return data;
    });
}

export function login({ commit }, data) {
    return api.post("/login", data).then(({ data }) => {
        commit("setUser", data.user);
        commit("setToken", data.token);

        return data;
    });
}

export function logout({ commit }) {
    return api.post("/logout").then((response) => {
        commit("setToken", null);
        return response;
    });
}
