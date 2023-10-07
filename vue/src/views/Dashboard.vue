<template>
    <div class="bg-gray-100 min-h-screen">
        <div class="bg-blue-500 py-6 text-white text-center">
            <h1 class="text-3xl font-semibold">Welcome, User!</h1>
        </div>
        <div class="container mx-auto mt-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <!-- Products Section -->
                <div class="bg-white rounded-lg p-4 shadow-md">
                    <h2 class="text-2xl font-semibold mb-4">Current Products</h2>
                    <!-- Dummy product cards -->
                    <div class="bg-gray-200 p-4 rounded-md mb-4">

                        <p class="text-lg font-semibold">Product Name 1</p>
                        <p class="text-gray-600">Price: $10.99</p>
                    </div>

                </div>

                <!-- Users Section -->
                <div class="bg-white rounded-lg p-4 shadow-md">
                    <h2 class="text-2xl font-semibold mb-4">Users</h2>

                    <div class="bg-gray-200 p-4 rounded-md mb-4">

                        <p class="text-lg font-semibold">User Name 1</p>
                        <p class="text-gray-600">Email: user@example.com</p>
                    </div>
                    <!-- Repeat for each user -->
                </div>
            </div>
        </div>
    </div>
</template>
  
<script>
export default {
    name: 'Dashboard',
};
</script>