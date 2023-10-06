<template>
    <div class="flex h-screen bg-gray-900">
        <aside class="w-30 bg-gray-800">

            <div class="h-full p-5">
                <!-- <div class="text-white text-2xl font-semibold mb-6">My App</div> -->
                <nav class="space-y-2">

                    <router-link to="/" class="text-white hover:bg-gray-700 block p-2 rounded transition duration-200">
                        Dashboard
                    </router-link>
                    <router-link to="/product"
                        class="text-white hover:bg-gray-700 block p-2 rounded transition duration-200">
                        Products
                    </router-link>

                </nav>
            </div>

        </aside>
    </div>
</template>
  
<script setup>

</script>
  
<style scoped></style>
  