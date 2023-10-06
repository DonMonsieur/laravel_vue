<template>
    <div class="container mx-auto px-4 mt-4">
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
                <tr>
                    <td class="py-2 px-4 text-left">Product 1</td>
                    <td class="py-2 px-4 text-left">Category A</td>
                    <td class="py-2 px-4 text-left">Description of Product 1</td>
                    <td class="py-2 px-4 text-center">
                        <button class="text-indigo-600 hover:text-indigo-900 focus:outline-none">
                            Update
                        </button>
                        <button class="text-red-600 hover:text-red-900 focus:outline-none ml-2">
                            Delete
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
  
<script setup>

</script>
  
<style scoped></style>
  