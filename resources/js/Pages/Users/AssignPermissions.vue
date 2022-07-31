<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2
                class="flex justify-between font-semibold text-xl text-gray-800 capitalize leading-tight"
            >
                User Permissions
                <button type="button" class="text-white text-sm bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 rounded-lg px-5 py-2.5 mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" @click="storeUserPermissions">Save</button>
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div
                        class="p-6 bg-white border-b border-gray-200 grid grid-cols-2 gap-4"
                    >
                        <!-- Permisos asignados -->
                        
                        <div class="bg-red-400 rounded-2xl">
                            <SlickList
                                axis="y"
                                v-model:list="permissionsAssigned"
                                class=""
                                group="b"
                                :accept="['a']"
                            >
                                <SlickItem
                                    v-for="(
                                        permission, i
                                    ) in permissionsAssigned"
                                    :key="permission"
                                    :index="i"
                                    class="kanban-list-item"
                                    helper-class="kanban-helper"
                                >
                                    <a
                                        href="#"
                                        class="block p-6 max-w-sm mx-auto my-3 bg-white rounded-2xl shadow-md hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700"
                                    >
                                        <h5
                                            class="capitalize mb-2 text-md font-bold tracking-tight text-gray-900 dark:text-white"
                                        >
                                            {{ permission }}
                                        </h5>
                                        <div class="grid grid-cols-3">
                                            <fieldset
                                                v-for="wildcard in wildcards"
                                                :key="wildcard"
                                            >
                                                <div
                                                    class="flex items-center mb-4"
                                                >
                                                    <input
                                                        @click="
                                                            assignPermission(
                                                                permission,
                                                                wildcard,
                                                                $event.target
                                                                    .checked
                                                            )
                                                        "
                                                        id="checkbox"
                                                        type="checkbox"
                                                        :value="true"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                                    />
                                                    <label
                                                        for="checkbox-1"
                                                        class="capitalize ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                                    >
                                                        {{ wildcard != '*' ? wildcard : 'All' }}
                                                    </label>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </a>
                                </SlickItem>
                            </SlickList>
                        </div>

                        <!-- Lista de permisos -->
                        <div class="bg-blue-400 rounded-2xl border">
                            <SlickList
                                @sort-insert="unassignPermission"
                                axis="y"
                                v-model:list="permissionsList"
                                class="overflow-auto max-h-screen"
                                group="a"
                                :accept="['b']"
                            >
                                <SlickItem
                                    v-for="(permission, i) in permissionsList"
                                    :key="permission"
                                    :index="i"
                                    class=""
                                    helper-class="kanban-helper"
                                >
                                    <a
                                        href="#"
                                        class="block p-6 mx-auto my-3 max-w-sm bg-white rounded-2xl shadow-md hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700"
                                    >
                                        <h5
                                            class="capitalize mb-2 text-md font-bold tracking-tight text-gray-900 dark:text-white"
                                        >
                                            {{ permission }}
                                        </h5>
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
import { SlickList, SlickItem } from "vue-slicksort";
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head, 
        Link,
        SlickItem,
        SlickList,
    },
    setup () {
        const form = useForm({
            permissionList: [],
        })

        return { form }
    },
    mounted() {
        this.loadPermissionsList();
        this.loadWildcardsNames();
    },
    data() {
        return {
            permissionsList: [],
            permissionsAssigned: [],
            permissionsSelected: [],
            wildcards: []
        };
    },
    methods: {
        loadWildcardsNames() {
            this.wildcards = this.$attrs.permissions.map(function (element){return element.name.split('.')[1]})
                                             .filter(function (value, index, self){return self.indexOf(value) === index})
        },
        storeUserPermissions() {
            this.form.permissionList = this.permissionsSelected
            this.form.post(route(`permissions.user`, this.$attrs.user.id), {forceFormData: true})
        },
        loadPermissionsList() {
            this.permissionsList = this.$attrs.permissions.map(function (element){return element.name.split('.')[0]})
                                   .filter(function (value, index, self){return self.indexOf(value) === index});
        },
        assignPermission(model, wildcard, bool) {

            if (bool) {
                this.addPermission(model, wildcard);
            } else {
                this.deletePermission(model, wildcard);
            }
        },
        addPermission(model, wildcard) {
            this.permissionsSelected.push(`${model}.${wildcard}`)
        },
        deletePermission(model, wildcard) {
            let index = this.permissionsSelected.findIndex((item) =>
                item == `${model}.${wildcard}`
            );
            this.permissionsSelected.splice(index,1)
        },
        unassignPermission(info) {
            const modelName = info.value
            this.permissionsSelected = this.permissionsSelected.filter(function (permission) {
                return !permission.includes(modelName)
            })
        },
    },
};
</script>
