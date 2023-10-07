<template>
    <div class="flex justify-center items-center">
        <form class="space-y-8 border-solid max-w-xl w-full" action="#" method="POST" @submit.prevent="createProduct">
            <div>
                <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Create new
                    product</label>
                <div class="mt-2">
                    <input id="name" name="name" type="text" autocomplete="off" v-model="product.name"
                        class="block p-2.5 w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                </div>
            </div>

            <div>
                <div class="flex items-center">
                    <label for="category" class="text-sm font-medium leading-6 text-gray-900 mr-7">Select category</label>

                    <select v-model="selectedCategory"
                        class="max-w-md w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                        <option v-for="category in categories" :key="category.id" :value="category.name">
                            {{ category.name }}
                        </option>
                    </select>
                </div>



            </div>

            <div>
                <div class="flex items-center justify-between">
                    <label for="category" class="block text-sm font-medium leading-6 text-gray-900">Create new
                        description</label>

                </div>
                <div class="mt-2">
                    <textarea id="category" rows="4" name="category" type="text" autocomplete="off"
                        v-model="product.description"
                        class="block p-2.5 w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                        placeholder="Enter new description here..."></textarea>
                </div>
            </div>

            <div class="flex justify-end">
                <router-link to="/product">
                    <button type="submit"
                        class="max-w-xs rounded-md bg-blue-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Back</button>
                </router-link>

                <button
                    class="max-w-xs ml-2 rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Create
                </button>

            </div>

        </form>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import api from '../config/api';
import router from '../router';

const categories = ref([]);
const selectedCategory = ref('');

const product = {
    name: '',
    category: '',
    description: ''
}


const createProduct = async () => {
    try {
        const response = await api.post('/product/create', {
            name: product.name,
            category: selectedCategory.value,
            description: product.description
        });

        if (response.status == 201) {
            alert(response.data.message);
            router.push('/product')
        }
    } catch (error) {
        if (error.response?.data?.errors) {
            const errorMessages = Object.values(error.response.data.errors).flat();
            const errorMessage = errorMessages.join('\n');
            alert(errorMessage);
        } else {
            console.error('Error:', error.message);
        }
    }

}

const getCategories = async () => {
    const response = await api.get('/category');

    if (response.status == 200) {
        categories.value = response.data.data;
    }
}

onMounted(() => {
    getCategories();
});

</script>