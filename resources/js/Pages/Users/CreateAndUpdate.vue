<template>
    <Head title="Create permission" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2
                class="flex justify-between font-semibold text-xl text-gray-800 capitalize leading-tight"
            >
                {{this.$attrs.modelName}}
                <button type="button" class="text-white text-sm bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 rounded-lg px-5 py-2.5 mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" @click="goBack">Back</button>
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                    <div class="p-6 bg-white border-b border-gray-200 capitalize">
                        {{this.$attrs.modelName}} <span v-if="$attrs.method=='create'">create</span><span v-else>edit</span>
                    </div>
                </div>
                <div class="p-4 mb-4 text-sm text-blue-700 bg-blue-100 rounded-lg dark:bg-blue-200 dark:text-blue-800" role="alert">
                    <span class="font-bold">Developer note:</span> You may have noticed this form is exactly the same for creating and updating
                    records, an that's because, they are actually the same component, but by using vue conditional you can change its content
                    for your purposes
                </div>
            </div>
            <form @submit.prevent="submit">
                <div
                    class="max-w-full py-12 sm:max-w-7xl sm:px-6 lg:px-8 grid mx-auto grid-cols-1 sm:grid-cols-6 sm:grid-rows-2 sm:grid-flow-row gap-4"
                >
                    <div
                        class="sm:row-span-2 sm:col-span-6 block p-6 bg-white rounded-lg border border-gray-200 shadow-md"
                    >
                        <div class="mb-6">
                            <label
                                for="name"
                                class="block mb-2 text-md font-medium text-gray-900"
                                >Name</label
                            >
                            <input
                                type="text"
                                v-model="form.name"
                                id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                required
                            />
                        </div>
                        <div class="mb-6">
                            <label
                                for="name"
                                class="block mb-2 text-md font-medium text-gray-900"
                                >Email</label
                            >
                            <input
                                type="text"
                                v-model="form.email"
                                id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                required
                            />
                        </div>
                        <div class="mb-6">
                            <label
                                for="name"
                                class="block mb-2 text-md font-medium text-gray-900"
                                >Password</label
                            >
                            <input
                                type="text"
                                v-model="form.password"
                                id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                required
                            />
                        </div>
                        <div class="mb-6">
                            <label
                                for="description"
                                class="block mb-2 text-md font-medium text-gray-900"
                                >Confirm password</label
                            >
                            <textarea
                                type="text"
                                v-model="form.password_confirmation"
                                id="guard_name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                required
                            />
                        </div>
                        <button type="submit" class="sm:col-end-5 text-white bg-blue-600 hover:bg-sky-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-full sm:col-span-2 px-5 py-2.5 text-center">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import Button from "@/Components/Button.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import { XIcon } from "@heroicons/vue/outline";
import { onMounted } from 'vue'

export default {
    components: {
        BreezeAuthenticatedLayout, Button, Head, Link, XIcon
    },
    setup() {
        const form = useForm({
            name: '',
            email: '',
            password: '',
            password_confirmation: '',
        })
        return { form }
    },
    data() {
        return {
            backLink: "",
        };
    },
    mounted() {
        this.loadFormInfo()
    },
    methods: {
        submit() {
            if (this.$attrs.method=='create') {
                this.form.post(route(`${this.$attrs.modelName}.store`), {forceFormData: true})
            } else {
                this.form.put(route(`${this.$attrs.modelName}.update`, this.$attrs.item))
            }
        },
        goBack() {
            this.backLink = window.history.back();
        },
        loadFormInfo() {
            if (this.$attrs.item) {

                //Im sure there is a better way to do this
                this.form.name = this.$attrs.item.name
                this.form.description = this.$attrs.item.description
            }
        }
    },
};
</script>
