<script>
import { PencilIcon, TrashIcon, EyeIcon } from "@heroicons/vue/outline";

export default {
    components: { PencilIcon, TrashIcon, EyeIcon },
    props: {
        items: {
            type: Array,
            required: true
        },
        columns: {
            type: Array,
            required: true
        },
        deleteMethod: {
            type: Function,
            required: false
        },
        updateMethod: {
            type: Function,
            required: false
        }
    },
    data() {
        return {

        }
    },
    methods: {
        showLongText($text) {
            this.$swal.fire($text);
        },
        clickDeleteButton(itemId) {
            this.deleteMethod(itemId);
        },
        clickUpdateButton(itemId) {
            this.updateMethod(itemId);
        }
    }
}
</script>

<template>
    <div class="relative overflow-x-auto shadow-lg sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs  text-gray-700 uppercase bg-slate-300">
                <tr>
                    <th v-for="column in columns" :key="column.id" scope="col" class="px-6 py-3 max-w-md">
                        {{ column.name }}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Edit</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in items" :key="item.id" class="bg-white border-b hover:bg-gray-50">
                    <th v-for="column in columns" :key="column.id" scope="row" class="px-6 py-4 font-medium max-w-md text-gray-900 whitespace-nowrap">
                        <div class="truncate">
                            {{ item[column.reference]}}
                        </div>
                    </th>
                    <td class="px-6 py-4 text-center">
                        <button @click="clickUpdateButton(item.id)" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center mr-2">
                            <PencilIcon class="w-4 h-4"></PencilIcon>
                        </button>
                        <button @click="clickDeleteButton(item.id)" type="button" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center mr-2">
                            <TrashIcon class="w-4 h-4"></TrashIcon>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>