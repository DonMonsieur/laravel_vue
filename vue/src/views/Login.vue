<template>
    <GuestLayout title="Sign in to your account">
        <form class="space-y-6" action="#" method="POST" @submit.prevent="login">
            <div>
                <label for="username_or_email" class="block text-sm font-medium leading-6 text-gray-900">Username / Email
                    Address</label>
                <div class="mt-2">
                    <input id="username_or_email" name="username_or_email" type="text" autocomplete="off"
                        v-model="user.username_or_email"
                        class="block p-2.5 w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                </div>
            </div>

            <div>
                <div class="flex items-center justify-between">
                    <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>

                </div>
                <div class="mt-2">
                    <input id="password" name="password" type="password" autocomplete="off" v-model="user.password"
                        class="block p-2.5 w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                </div>
            </div>


            <div class="mt-2 flex items-center justify-between">
                <label for="remember" class="block text-sm font-medium leading-5 text-gray-900">Remember Me</label>
                <input id="remember" name="remember" type="checkbox" v-model="user.rememberMe"
                    class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out"
                    @change="handleRememberMeChange" />
            </div>


            <div>
                <div class="flex items-center">
                    <p class="mr-2">Not Registered?</p>
                    <router-link to="/register" class="text-indigo-600 hover:underline">Create an account</router-link>
                </div>


                <button type="submit"
                    class="flex w-full mt-2 justify-center rounded-md bg-blue-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign
                    in</button>
            </div>

        </form>
    </GuestLayout>
</template>

<script setup>
import { onMounted, ref } from 'vue'
import GuestLayout from "../components/GuestLayout.vue";
import store from "../store/index";
import router from "../router/index";
import api from "../config/api";

let loading = ref(false);

const user = {
    username_or_email: '',
    password: '',
    rememberMe: false,
}

const login = async () => {
    const payload = {
        username_or_email: user.username_or_email,
        password: user.password,
        remember: user.rememberMe,
    };

    try {
        loading.value = true;
        const response = await api.post("/login", payload);

        const data = response.data;

        store.commit('setUser', data.user);
        store.commit('setToken', data.token);

        // const token = localStorage.getItem("ACCESS_TOKEN");
        // console.log("TOKEN: ", token);

        user.username_or_email = '';
        user.password = '';
        loading.value = false;
        router.push('/dashboard');
    } catch (error) {
        loading.value = false;
        if (error.response?.data?.errors) {
            const errorMessages = Object.values(error.response.data.errors).flat();
            const errorMessage = errorMessages.join('\n');
            alert(errorMessage);
        } else {
            console.error('Error:', error.message);
        }
    }
}

// const handleRememberMeChange = () => {
//     console.log('New value:', user.rememberMe);
// };


</script>

<style scoped></style>
