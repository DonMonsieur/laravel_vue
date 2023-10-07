<template>
    <form class="space-y-6" action="#" method="POST" @submit.prevent="createProduct">
        <div>
            <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Create new
                product</label>
            <div class="mt-2">
                <input id="name" name="name" type="text" autocomplete="off" v-model="product.name"
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
            </div>
        </div>

        <div>
            <div class="flex items-center justify-between">
                <label for="category" class="block text-sm font-medium leading-6 text-gray-900">Create new category</label>

            </div>
            <div class="mt-2">
                <input id="category" name="category" type="text" autocomplete="off" v-model="product.category"
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
            </div>
        </div>

        <div>
            <div class="flex items-center justify-between">
                <label for="category" class="block text-sm font-medium leading-6 text-gray-900">Create new
                    description</label>

            </div>
            <div class="mt-2">
                <input id="category" name="category" type="text" autocomplete="off" v-model="product.description"
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
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
</template>

<script setup>
import api from '../config/api';
import router from '../router';

const product = {
    name: '',
    category: '',
    description: ''
}


const createProduct = async () => {
    const response = await api.post('/product/create', {
        name: product.name,
        category: product.category,
        description: product.description
    });

    if (response.status == 201) {
        alert(response.data.message);
        router.push('/product')
    }
}


</script>