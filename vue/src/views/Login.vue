
<template>
    <GuestLayout title="Sign in to your account">
        <form class="space-y-6" action="#" method="POST" @submit.prevent="login">
            <div>
                <label for="username_or_email" class="block text-sm font-medium leading-6 text-gray-900">Username / Email
                    Address</label>
                <div class="mt-2">
                    <input id="username_or_email" name="username_or_email" type="text" autocomplete="off"
                        v-model="user.username_or_email"
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                </div>
            </div>

            <div>
                <div class="flex items-center justify-between">
                    <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>

                </div>
                <div class="mt-2">
                    <input id="password" name="password" type="password" autocomplete="off" v-model="user.password"
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                </div>
            </div>


            <div class="mt-4 flex items-center justify-between">
                <label for="remember" class="block text-sm font-medium leading-5 text-gray-900">Remember Me</label>
                <input id="remember" name="remember" type="checkbox"
                    class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" />
            </div>

            <div>
                <button type="submit"
                    class="flex w-full justify-center rounded-md bg-blue-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign
                    in</button>

                <router-link to="/register">
                    <button
                        class="flex w-full justify-center mt-2 rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Create
                        an account
                    </button>
                </router-link>

            </div>

        </form>
    </GuestLayout>
</template>

<script setup>
import { ref } from 'vue'
import GuestLayout from "../components/GuestLayout.vue";
import store from "../store/index";
import router from "../router/index";

let loading = ref(false);
let errorMsg = ref("");

const user = {
    username_or_email: '',
    password: '',
    remember: false
}

function login() {
    loading.value = true;
    store.dispatch('login', user)
        .then((response) => {
            loading.value = false;
            alert(response.message);
            router.push({ name: 'dashboard' });
        })
        .catch((error) => {
            loading.value = false;
            if (error.response) {
                errorMsg.value = error.response.data;
                console.error('Login error. Response:', errorMsg.value);
            } else {
                console.error('Login error. Response:', error.message);
            }
        })
}



</script>

  

<style scoped></style>