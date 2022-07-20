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
                Administración de Tours
                <Button >Nuevo</Button>
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        Permissions CRUD
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
                    :delete-method="deleteTour"
                    :update-method="updateTour"
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
                    { name: "Guard", reference: "guard_name" },
                    { name: "Created", reference: "created_at" },
                    { name: "Last update", reference: "updated_at" },
                ],
            };
        },
        methods: {
            goToCreateTour() {
                this.$inertia.get(this.$attrs.create_url)
            },
            deleteTour(itemId) {
                
            },
            updateTour(itemId) {
                
            }
        },
    };
</script>
