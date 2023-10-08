<template>
    <div class="relative min-h-screen bg-gray-300">
        <Navbar />

        <div class="absolute top-16 left-0 right-0 bottom-0 flex">
            <Sidebar />

            <main class="p-2 flex-1">
                <router-view></router-view>
            </main>
        </div>
    </div>
</template>

<script setup>
import Navbar from './Navbar.vue';
import Sidebar from './Sidebar.vue';


</script>
