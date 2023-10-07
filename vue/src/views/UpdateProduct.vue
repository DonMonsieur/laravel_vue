<template>
    <div class="flex justify-center items-center">
        <form class="space-y-8 border-solid max-w-xl w-full mt-12" action="#" method="POST" @submit.prevent="UpdateProduct">
            <div>
                <label for="name" class="block text-md font-medium leading-6 text-gray-900">Update
                    product</label>
                <div class="mt-2">
                    <input id="name" name="name" type="text" autocomplete="off" v-model="product.name"
                        class="block p-2.5 w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-md sm:leading-6" />
                </div>
            </div>

            <div>
                <div class="flex items-center">
                    <label for="category" class="text-md font-medium leading-6 text-gray-900 mr-4">Select category</label>

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
                    <label for="category" class="block text-md font-medium leading-6 text-gray-900">Update
                        description</label>

                </div>
                <div class="mt-2">
                    <textarea id="category" rows="4" name="category" type="text" autocomplete="off"
                        v-model="product.description"
                        class="block p-2.5 w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-md sm:leading-6"
                        placeholder="Enter new description here..."></textarea>
                </div>
            </div>

            <div>
                <label for="images" class="block text-md font-medium leading-6 text-gray-900">Upload Images</label>
                <div class="mt-2">
                    <input id="images" name="images" type="file" accept="image/*" multiple @change="handleImageChange"
                        class="block p-2.5 w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-md sm:leading-6" />
                </div>
            </div>

            <div class="flex justify-end">
                <router-link to="/product">
                    <button
                        class="max-w-xs rounded-md bg-blue-600 px-3 py-1.5 text-md font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Back</button>
                </router-link>

                <button type="submit"
                    class="max-w-xs ml-2 rounded-md bg-green-600 px-3 py-1.5 text-md font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save
                </button>

            </div>

        </form>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import api from '../config/api';
import router from '../router';
import { useRoute } from 'vue-router';

const categories = ref([]);
const selectedCategory = ref('');
const selectedImages = ref([]);

const route = useRoute();
const id = ref(route.params.id);

const product = ref({
    name: '',
    category: '',
    description: ''
})

const handleImageChange = (event) => {
    const selectedFiles = event.target.files;
    selectedImages.value = [];
    for (let i = 0; i < selectedFiles.length; i++) {
        selectedImages.value.push(selectedFiles[i]);
    }
    // console.log(selectedImages);
}


const UpdateProduct = async () => {
    try {
        const formData = new FormData();
        formData.append("name", product.value.name);
        formData.append("category", selectedCategory.value);
        formData.append("description", product.value.description);

        // Append image files
        for (let i = 0; i < selectedImages.value.length; i++) {
            formData.append("images[]", selectedImages.value[i]);
        }

        const response = await api.post(`/product/update/${id.value}`, formData);

        if (response.status == 200) {
            alert(response.data.message);
            router.push('/product');
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



const showCurrentProduct = async () => {
    const response = await api.get(`/product/${id.value}`);

    // console.log(response.data.data.product);
    if (response.status == 200) {
        product.value = {
            name: response.data.data.product.name,
            description: response.data.data.product.category,
        }

        selectedCategory.value = response.data.data.product.category;
    };
}



const getCategories = async () => {
    const response = await api.get('/category');

    if (response.status == 200) {
        categories.value = response.data.data;
    }
}

onMounted(async () => {
    await showCurrentProduct();
    await getCategories();
});


</script>