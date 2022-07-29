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
                User Permissions
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200 grid grid-cols-2 gap-4">

                        <div class="bg-blue-400 rounded-2xl border">
                            <SlickList axis="y" v-model:list="permissions" class="overflow-auto max-h-screen" group="a" :accept="['b']">
                                <SlickItem v-for="(permission, i) in permissions" :key="permission" :index="i" class="" helper-class="kanban-helper">
                                    <a href="#" class="block p-6 mx-auto my-3 max-w-sm bg-white rounded-2xl shadow-md hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                                        <h5 class="capitalize mb-2 text-md font-bold tracking-tight text-gray-900 dark:text-white">
                                            {{Object.keys(permission)[0]}}
                                        </h5>
                                        <div class="grid grid-cols-3">
                                            <fieldset v-for="wildcard in permission[Object.keys(permission)[0]]" :key="wildcard">
                                                <div class="flex items-center mb-4">
                                                    <input v-model="selected" id="checkbox" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" >
                                                    <label for="checkbox-1" class="capitalize ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                                        {{ wildcard }}
                                                    </label>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </a>
                                </SlickItem>
                            </SlickList>
                        </div>

                        <div class="bg-red-400 rounded-2xl">
                            <SlickList axis="y" v-model:list="permissionsAssigned" class="" group="b" :accept="['a']">
                                <SlickItem v-for="(permission, i) in permissionsAssigned" :key="permission" :index="i" class="kanban-list-item" helper-class="kanban-helper">
                                    <a href="#" class="block p-6 max-w-sm mx-auto my-3 bg-white rounded-2xl shadow-md hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                                        <h5 class="capitalize mb-2 text-md font-bold tracking-tight text-gray-900 dark:text-white">
                                            {{Object.keys(permission)[0]}}
                                        </h5>
                                        <div class="grid grid-cols-3">
                                            <fieldset v-for="wildcard in permission[Object.keys(permission)[0]]" :key="wildcard">
                                                <div class="flex items-center mb-4">
                                                    <input id="checkbox" type="checkbox" :value="true" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" >
                                                    <label for="checkbox-1" class="capitalize ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                                        {{ wildcard }}
                                                    </label>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </a>
                                </SlickItem>
                            </SlickList>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </BreezeAuthenticatedLayout>
</template>

<script>
import { SlickList, SlickItem } from 'vue-slicksort';

export default {
    components: {
        SlickItem,
        SlickList,
    },
    setup() {
        const form = useForm({
            permissionList:[],
        })
        return { form }
    },
    mounted() {
        this.loadPermissionsList()
    },
    data(){
        return {
            permissions : [],
            permissionsAssigned : [],
            selected:[]
        };
    },
    methods: {
        loadPermissionsList() {
            this.permissions = this.$attrs.permissions
            
        }
    },
};
</script>