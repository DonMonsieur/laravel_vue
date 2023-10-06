<template>
    <div class="min-h-full bg-gray-200 flex">

        <Sidebar />

        <div class="flex-1">

            <Navbar />

            <main class="p-6">
                <router-view></router-view>
            </main>

        </div>

    </div>
</template>

<script setup>
import Navbar from './Navbar.vue';
import Sidebar from './Sidebar.vue';


</script>
