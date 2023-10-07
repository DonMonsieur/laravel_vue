<template>
    <div class="flex">
        <aside class="md:w-30 md:h-screen bg-gray-800">
            <div class="h-full md:h-auto p-5 mt-12">
                <nav class="space-y-2">
                    <router-link to="/dashboard"
                        class="text-white hover:bg-gray-700 hover:text-indigo-400 block p-2 rounded transition duration-200">
                        Dashboard
                    </router-link>
                    <div @click="toggleProductMenu" class="cursor-pointer">
                        <div class="flex items-center justify-between">
                            <span :class="{ 'text-indigo-400': isProductMenuOpen }"
                                class="text-white block p-2 rounded transition duration-200">
                                Products
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 20 20"
                                fill="currentColor">
                                <template v-if="isProductMenuOpen">
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
                        <div v-if="isProductMenuOpen" class="ml-2">
                            <router-link to="/product"
                                class="text-white hover:bg-gray-700 hover:text-indigo-400 block p-2 rounded transition duration-200">
                                Product List
                            </router-link>
                            <router-link to="/product/create"
                                class="text-white hover:bg-gray-700 hover:text-indigo-400 block p-2 rounded transition duration-200">
                                Create Product
                            </router-link>
                        </div>
                    </div>
                </nav>
            </div>
        </aside>
    </div>
</template>
  
<script>
export default {
    data() {
        return {
            isProductMenuOpen: false,
        };
    },
    methods: {
        toggleProductMenu() {
            this.isProductMenuOpen = !this.isProductMenuOpen;
        },
    },
};
</script>
  