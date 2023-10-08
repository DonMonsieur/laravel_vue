<template>
    <div class="bg-gray-300 min-h-screen">
        <div class="bg-indigo-500 py-6 text-white text-center">
            <h1 class="text-3xl font-semibold">Welcome {{ user.username }}</h1>
        </div>
        <div class="container mx-auto mt-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4">
                <!-- Products Section -->
                <div class="bg-white rounded-lg p-4 shadow-md">
                    <h2 class="text-2xl font-semibold mb-4 text-center">
                        <i class="fas fa-box"></i> Available Products
                    </h2>
                    <div class="bg-indigo-500 text-white p-4 rounded-md mb-4">
                        <p class="text-2xl font-bold text-center">{{ products }}</p>
                    </div>
                </div>

                <!-- Users Section -->
                <div class="bg-white rounded-lg p-4 shadow-md">
                    <h2 class="text-2xl font-semibold mb-4 text-center">
                        <i class="fas fa-users"></i> Users Count
                    </h2>
                    <div class="bg-indigo-500 text-white p-4 rounded-md mb-4">
                        <p class="text-2xl font-bold text-center">{{ users }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
  
  
<script setup>
import { onMounted, ref } from 'vue';
import api from '../config/api';

const user = ref({
    id: '',
    username: '',
    email: '',
});

const products = ref();
const users = ref();

const currentUser = async () => {
    try {
        const response = await api.get('/user');
        if (response.status === 200) {

            user.value = {
                id: response.data.data.id,
                username: response.data.data.username,
                email: response.data.data.email,
            };
        }
    } catch (error) {
        console.error('Error fetching current user:', error);
    }
};

const availableProducts = async () => {
    try {
        const response = await api.get('/product/count');

        if (response.status == 200) {
            products.value = response.data.data
        }
    } catch (error) {
        console.error('Error fetching current user:', error);
    }
}

const UserCount = async () => {
    try {
        const response = await api.get('/user/count');

        if (response.status == 200) {
            users.value = response.data.data
        }
    } catch (error) {
        console.error('Error fetching current user:', error);
    }
}

onMounted(async () => {
    await currentUser();
    await availableProducts();
    await UserCount();
});

</script>
