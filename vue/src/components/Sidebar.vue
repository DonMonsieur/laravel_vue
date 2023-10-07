<template>
    <div class="flex bg-gray-900">
        <aside class="md:w-30 md:h-screen bg-gray-800">

            <div class="h-full md:h-auto p-5">
                <nav class="space-y-2">
                    <router-link to="/dashboard"
                        class="text-white hover:bg-gray-700 block p-2 rounded transition duration-200">
                        Dashboard
                    </router-link>
                    <router-link to="/product"
                        class="text-white hover:bg-gray-700 block p-2 rounded transition duration-200">
                        Products
                    </router-link>
                    <router-link to="/product/create"
                        class="text-white hover:bg-gray-700 block p-2 rounded transition duration-200">
                        Create Product
                    </router-link>
                </nav>
            </div>

        </aside>
    </div>
</template>
