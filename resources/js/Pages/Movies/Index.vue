<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import Datatable from "@/Components/Datatable.vue";
import { Head } from '@inertiajs/inertia-vue3';
import { Link } from '@inertiajs/inertia-vue3'
</script>

<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="flex justify-between font-semibold text-xl text-gray-800 leading-tight">
                Movies
                <button type="button" class="text-white text-sm bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 rounded-lg  px-5 py-2.5 mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" @click="goToCreate">New</button>
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        Movies CRUD
                    </div>
                </div>
            </div>
        </div>


        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <Datatable 
                    :items="$attrs.items" 
                    :columns="columns"
                    :delete-method="deletePermission"
                    :update-method="updatePermission"
                    ></Datatable>
                </div>
            </div>
        </div>

    </BreezeAuthenticatedLayout>
</template>

<script>
    export default {
        data(){
            return {
                columns: [
                    { name: "ID", reference: "id" },
                    { name: "Name", reference: "name" },
                    { name: "Description", reference: "description" },
                    { name: "Created", reference: "created_at" },
                    { name: "Last update", reference: "updated_at" },
                ],
            };
        },
        methods: {
            goToCreate() {
                this.$inertia.get(this.$attrs.create_url)
            },
            deletePermission(itemId) {
                this.$inertia.delete(route(`${this.$attrs.modelName}.destroy`, itemId))
            },
            updatePermission(itemId) {
                this.$inertia.get(route(`${this.$attrs.modelName}.edit`, itemId))
            }
        },
    };
</script>
