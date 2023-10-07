
<template>
    <GuestLayout title="Create an Account">
        <form class="space-y-6" action="#" method="POST" @submit.prevent="register">
            <div>
                <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Username</label>
                <div class="mt-2">
                    <input id="username" name="username" type="text" v-model="user.username"
                        class="block p-2.5 w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                        autocomplete="off" />
                </div>
            </div>

            <div>
                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email</label>
                <div class="mt-2">
                    <input id="email" name="email" type="email" v-model="user.email" autocomplete="off"
                        class="block p-2.5 w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                </div>
            </div>

            <div>
                <div class="flex items-center justify-between">
                    <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>

                </div>
                <div class="mt-2">
                    <input id="password" name="password" type="password" autocomplete="current-password"
                        v-model="user.password"
                        class="block p-2.5 w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                </div>
            </div>

            <div>
                <div class="flex items-center justify-between">
                    <label for="password_confirmation" class="block text-sm font-medium leading-6 text-gray-900">Confirm
                        Password</label>

                </div>
                <div class="mt-2">
                    <input id="password_confirmation" name="password_confirmation" type="password"
                        v-model="user.password_confirmation" autocomplete="current-password"
                        class="block p-2.5 w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                </div>
            </div>

            <div>
                <router-link to="/login">
                    <button
                        class="flex w-full justify-center rounded-md bg-blue-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Back
                        to login</button>
                </router-link>


                <button
                    class="flex w-full justify-center mt-2 rounded-md bg-green-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    Create
                </button>


            </div>
        </form>
    </GuestLayout>
</template>

<script setup>
import GuestLayout from '../components/GuestLayout.vue';
import api from '../config/api'
import router from "../router/index";

const user = {
    username: '',
    email: '',
    password: '',
    password_confirmation: ''
};

const register = async () => {
    try {
        const response = await api.post('/register', {
            username: user.username,
            email: user.email,
            password: user.password,
            password_confirmation: user.password_confirmation
        });

        if (response.status == 201) {
            alert(response.data.message);
            router.push('/login')
        }
    } catch (error) {
        if (error.response?.data?.errors) {
            const errorMessages = Object.values(error.response.data.errors).flat();
            const errorMessage = errorMessages.join('\n');
            alert(errorMessage);
        } else {
            console.error('Error:', error.message);
        }
    }
}

</script>
  

<style scoped></style>