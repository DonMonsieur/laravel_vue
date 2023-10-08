<template>
    <nav class="bg-gradient-to-r from-gray-800 via-gray-700 to-gray-900 relative">
        <div class="mx-auto px-2 sm:px-6 lg:px-8">
            <div class="relative flex h-16 items-center justify-between">
                <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start"></div>
                <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                    <!-- Avatar Trigger -->
                    <div x-data="{ isAvatarMenuOpen: true }">
                        <button @click="toggleAvatarMenu"
                            class="text-white hover:bg-gray-700 hover:text-indigo-400 block p-2 rounded-full transition duration-200 focus:outline-none">
                            <div class="flex items-center justify-between">
                                <span class="text-lg">👤</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <template v-if="isAvatarMenuOpen">
                                        <path fill-rule="evenodd"
                                            d="M6.293 7.293a1 1 0 011.414 0L10 9.586l2.293-2.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </template>
                                    <template v-else>
                                        <path fill-rule="evenodd"
                                            d="M13.293 12.293a1 1 0 01-1.414 0L10 9.586l-2.293 2.293a1 1 0 11-1.414-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 010 1.414z"
                                            clip-rule="evenodd" />
                                    </template>
                                </svg>
                            </div>
                        </button>
                        <!-- Dropdown Menu -->
                        <div x-show="isAvatarMenuOpen" v-if="isAvatarMenuOpen"
                            class="origin-top-right absolute right-0 mt-2 w-48 rounded-md bg-gray-700 shadow-lg bg-gray-700 ring-1 ring-black ring-opacity-5 focus:outline-none z-10"
                            x-cloak>
                            <div class="py-1">
                                <!-- Log Out Option -->
                                <a @click="logOut" href="#"
                                    class="text-center text-white hover:bg-gray-700 hover:text-indigo-400 block p-2 rounded transition duration-200">
                                    Log Out
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</template>
  

<script setup>
import { ref } from 'vue';
import store from "../store/index";
import router from "../router/index";
import api from '../config/api';

const isAvatarMenuOpen = ref(false);

const toggleAvatarMenu = () => {
    isAvatarMenuOpen.value = !isAvatarMenuOpen.value;
}

const loading = ref(false);

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
