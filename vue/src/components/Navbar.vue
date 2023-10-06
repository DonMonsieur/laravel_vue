<template>
    <nav class="bg-gray-800">
        <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
            <div class="relative flex h-16 items-center justify-between">
                <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start"></div>
                <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                    <button @click="logOut"
                        class="text-white hover:bg-gray-700 block p-2 rounded transition duration-200">Log Out</button>
                </div>
            </div>
        </div>
    </nav>
</template>
  
<script setup>
import { ref } from 'vue'
import store from "../store/index";
import router from "../router/index";

let loading = ref(false);

function logOut() {
    loading.value = true;
    store.dispatch('logout')
        .then((response) => {
            loading.value = false;
            alert(response.message);
            console.log(response);
            router.push({ name: 'login' });
        })
        .catch((error) => {
            loading.value = false;
            console.error('Logout error:', error);
        })
}
</script>

  