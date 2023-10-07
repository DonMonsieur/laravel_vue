<template>
    <nav class="bg-gray-800">
        <div class="mx-auto px-2 sm:px-6 lg:px-8">
            <div class="relative flex h-16 items-center justify-between">
                <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start"></div>
                <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                    <button @click="logOut"
                        class="text-white hover:bg-gray-700 hover:text-indigo-400 block p-2 rounded transition duration-200">Log
                        Out</button>
                </div>
            </div>
        </div>
    </nav>
</template>
  
<script setup>
import { ref } from 'vue'
import store from "../store/index";
import router from "../router/index";
import api from '../config/api';

let loading = ref(false);

const logOut = async () => {
    loading.value = true;
    store.commit('setUser', { token: null, data: {} });
    localStorage.removeItem('ACCESS_TOKEN');
    try {
        loading.value = true;
        const response = await api.post('/logout');

        if (response.status === 200) {
            console.log(response);
            loading.value = false;
            router.push('/login');
        } else {
            console.log('Logout failed:', response);
        }
    } catch (error) {
        console.error('Logout error:', error);
    }
}
</script>



  