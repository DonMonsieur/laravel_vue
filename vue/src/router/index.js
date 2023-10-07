import { createRouter, createWebHistory } from "vue-router";
import Dashboard from "../views/Dashboard.vue";
import Login from "../views/Login.vue";
import store from "../store";
import AppLayout from "../components/AppLayout.vue";
import Product from "../views/Product.vue";
import NotFound from "../views/NotFound.vue";
import Register from "../views/Register.vue";

const routes = [
    {
        path: "/app",
        name: "app",
        component: AppLayout,
        meta: { requiresAuth: true },
        children: [
            {
                path: "/dashboard",
                name: "dashboard",
                component: Dashboard,
            },
            {
                path: "/product",
                name: "product",
                component: Product,
            },
        ],
    },

    {
        path: "/:pathMatch(.*)",
        name: "notfound",
        component: NotFound,
    },
    {
        path: "/login",
        name: "login",
        component: Login,
    },
    {
        path: "/register",
        name: "register",
        component: Register,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    if (to.meta.requiresAuth && !store.state.user.token) {
        console.log(store.state.user.token);
        next({ name: "login" });
    } else if (to.meta.requiresGuest && store.state.user.token) {
        console.log(store.state.user.token);
        next({ name: "dashboard" });
    } else {
        next();
    }
});

export default router;
