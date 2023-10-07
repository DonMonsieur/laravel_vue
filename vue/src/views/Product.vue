<template>
    <div class="container mx-auto px-4 mt-4">
        <!-- Filter and Button Container -->
        <div class="flex justify-between mb-4">
            <!-- Button -->
            <router-link to="/product/create">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Create
                </button>
            </router-link>


            <!-- Filter Inputs -->
            <div class="flex">
                <!-- Category Filter -->
                <div class="relative mr-2 flex space-x-1">
                    <!-- Sorting Select -->
                    <div>
                        <select v-model="sortDirection"
                            class="block w-15 bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                            <option value="asc">Ascending</option>
                            <option value="desc">Descending</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        </div>
                    </div>

                    <!-- Category Select -->
                    <div>
                        <select v-model="selectedCategory"
                            class="block w-50 bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                            <option value="">All Categories</option>
                            <option v-for="category in categories" :key="category.id" :value="category.name">
                                {{ category.name }}
                            </option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        </div>
                    </div>
                </div>


                <!-- Search Filter -->
                <input
                    class="block w-40 bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 rounded shadow leading-tight focus:outline-none focus:shadow-outline"
                    type="text" placeholder="Search Product" v-model="searchText" @input="onSearch" />

            </div>
        </div>

        <!-- Product Table -->
        <div class="overflow-auto max-h-[1000px]">
            <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                <!-- Table Headers -->
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="py-2 px-4 text-left">Name</th>
                        <th class="py-2 px-4 text-left">Category</th>
                        <th class="py-2 px-4 text-left">Description</th>
                        <th class="py-2 px-4 text-center">Actions</th>
                    </tr>
                </thead>

                <!-- Table Body -->
                <tbody class="text-gray-700">
                    <tr v-for="product in filteredProducts" :key="product.id" class="border-solid border-2 border-gray-500">

                        <td class="py-2 px-4 text-left">{{ product.name }}</td>
                        <td class="py-2 px-4 text-left">{{ product.category }}</td>
                        <td class="py-2 px-4 text-left">{{ product.description }}</td>
                        <td class="py-2 px-4 text-center w-1/6">
                            <router-link :to="`/product/update/${product.id}`">
                                <button
                                    class="rounded-md bg-blue-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                    Update
                                </button>
                            </router-link>


                            <button
                                class="rounded-md bg-red-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 ml-2"
                                @click="deleteProduct(product.id)">
                                Delete
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
            <div class="flex flex-1 justify-between sm:hidden">
                <a href="#"
                    class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Previous</a>
                <a href="#"
                    class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Next</a>
            </div>
            <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                <div>
                    <div class="flex items-center">
                        <div class="mr-2">
                            <p class="text-sm text-gray-700">
                                Showing
                                <span class="font-medium">1</span>
                                to
                                <span class="font-medium">{{ perPage }}</span>
                                of
                                <span class="font-medium">{{ total }}</span>
                                results
                            </p>
                        </div>
                        <div class="relative">
                            <select v-model="perPage"
                                class="block appearance-none w-30 bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                                <option value="10">10 Per Page</option>
                                <option value="25">25 Per Page</option>
                                <option value="50">50 Per Page</option>
                            </select>
                            <div
                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M19 9l-7 7-7-7">
                                    </path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                        <!-- Previous button with click event -->
                        <a href="#" @click="previousPage"
                            class="mr-2 relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-800 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                            <span class="sr-only">Previous</span>
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>

                        <!-- Label for current page -->
                        <div class="flex items-center px-2 text-gray-800">
                            Page {{ currentPage }}
                        </div>

                        <!-- Next button with click event -->
                        <a href="#" @click="nextPage"
                            class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-800 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                            <span class="sr-only">Next</span>
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                    </nav>

                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, computed, watch } from 'vue';
import api from '../config/api';

const products = ref([]);
const categories = ref([]);
const searchText = ref('');
const selectedCategory = ref('');
const total = ref();
const perPage = ref(10);
const currentPage = ref(1);
const totalPages = ref(1);
const sortDirection = ref('desc');

const previousPage = () => {
    if (currentPage.value > 1) {
        currentPage.value--;
        getProductList();
    }
};

const nextPage = () => {
    if (currentPage.value < totalPages.value) {
        currentPage.value++;
        getProductList();
    }
};

const getProductList = async () => {
    const response = await api.get('/product/list', {
        params: {
            search: searchText.value,
            category: selectedCategory.value,
            page: currentPage.value,
            perPage: perPage.value,
            sortDirection: sortDirection.value
        },
    });
    if (response.status === 200) {
        // console.log(response.data.meta.pagination);
        products.value = response.data.data;
        total.value = response.data.meta.pagination.total;
        totalPages.value = response.data.meta.pagination.total_pages
    } else {
        console.log('Failed to fetch products');
    }
};

const deleteProduct = async (productId) => {
    const response = await api.delete(`/product/delete/${productId}`);

    if (response.status == 200) {
        alert(response.data.message);
        getProductList();
    }
}

const getCategories = async () => {
    const response = await api.get('/category');

    if (response.status == 200) {
        categories.value = response.data.data;
    } else {
        console.log('Failed to fetch categories');
    }
}

const onSearch = () => {
    getProductList();
}

watch([selectedCategory, perPage, sortDirection], () => {
    currentPage.value = 1;
    getProductList();
});


onMounted(() => {
    getProductList();
    getCategories();
});

const filteredProducts = computed(() => {
    if (!selectedCategory.value) {
        return products.value;
    } else {
        return products.value.filter(product => product.category === selectedCategory.value);
    }
});

</script>

<style scoped></style>
