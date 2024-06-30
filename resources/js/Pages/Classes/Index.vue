
<script setup>
import { VDataTableServer, VDivider, VIcon, VTextField } from 'vuetify/components';
import { VTooltip } from 'vuetify/components';
import { VBtn } from 'vuetify/components';
import { useClassesStore } from '../../Stores/classStore';
import { defineProps, onMounted, ref, watch } from 'vue';
import AddEditDialog from '../../Components/ClassComponents/AddEditDialog.vue'
import DeleteDialog from '../../Components/Global/dialogBoxes/DeleteDialog.vue'
import { Link } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';
import { useFormatDate } from '../../Composables/useFormatDate'

const props = defineProps(
    {
        classList: {
            type: Object
        }
    }
)

const classStore = useClassesStore()
const { formatDate } = useFormatDate()

onMounted(async function(){
    classStore.reset()
    await classStore.setclassesList(props.classList)
})

watch(props, async function(newProps, oldProps){
    classStore.setclassesList(newProps.classList)
})

const headers = [
    { title: 'Name', key: 'name', sortable: false, class: "blue lighten-5" },
    { title: 'Created On', key: 'created_at', width:200, sortable: false },
    { title: 'Action', key: 'action', width:200, sortable: false}
]

const addEditDialogShow = ref(false)
const deleteDialogShow = ref(false)

const create = () => {
    addEditDialogShow.value = true
}

const remove = (item) => {
    classStore.setclasses(item)
    deleteDialogShow.value = true
}

const edit = (item) => {
    classStore.setclasses(item)
    addEditDialogShow.value = true
}

const urlParams = new URLSearchParams(window.location.search);

const page = ref(urlParams.get('page') ?? 1)
const size = ref(urlParams.get('size')?? 15)
const searchTerm = ref(urlParams.get('search')?? '')

watch(searchTerm, async function(newSearchTerm, oldSearchTerm){
    router.get('chapters', { size: size.value, page: page.value, search: newSearchTerm }, { only: ['classList'], preserveState: true })
})

const changePage = (pageNumber) => {
    page.value = pageNumber
    router.get('chapters', { size: size.value, page: page.value }, { only: ['classList'] })
}

const changePageSize = (pageSize) => {
    size.value = pageSize
    router.get('chapters', { size: size.value, page: page.value }, { only: ['classList'] })
}


</script>
<template>
    <VCard title="Classes" color="orange" variant="outlined">
        <template #append>
            <div class="d-flex justify-center align-end ga-3">
                <VTextField 
                    v-model="searchTerm"
                    placeholder="Search" 
                    variant="outlined"
                    append-inner-icon="mdi-magnify"
                    clearable
                    width="12rem"
                    density="compact"
                    hide-details
                />
                <VBtn 
                    prepend-icon="mdi-plus" 
                    color="primary"
                    height="40"
                    @click="create"
                >
                    Add New Class
                    <VTooltip
                        activator="parent"
                        location="top"
                    >
                        Create new Classes
                    </VTooltip>
                </VBtn>
            </div>
        </template>
        <VDivider />
        <VDataTableServer
            color="light-blue"
            :headers="headers"
            :items="classStore.classesList.data"
            :items-per-page="classStore.classesList.per_page"
            :items-length="classStore.classesList.total"
            :page="classStore.classesList.current_page"
            fixed-header
            first-icon="mdi-skip-backward-outline"
            last-icon="mdi-skip-forward-outline"
            next-icon="mdi-arrow-right"
            prev-icon="mdi-arrow-left"
            @update:itemsPerPage="changePageSize($event)"
            @update:page="changePage($event)"
        >
        <template #item.created_at="{item}">
            {{ formatDate(item.created_at) }}
        </template>
        <template #item.action="{item}">
            <div class="d-flex ga-2">
                <Link :href="`/classes/${item.id}`" style="color:unset">
                    <v-btn variant="flat">
                        <VIcon icon="mdi-eye-outline" />
                        <VTooltip
                            activator="parent"
                            location="top"
                        >
                            View
                        </VTooltip>
                    </v-btn>
                </Link>
                <v-btn variant="flat" @click="edit(item)">
                    <VIcon icon="mdi-note-edit-outline" />
                    <VTooltip
                        activator="parent"
                        location="top"
                    >
                        Edit
                    </VTooltip>
                </v-btn>
                <v-btn variant="flat" @click="remove(item)">
                    <VIcon icon="mdi-trash-can-outline" />
                    <VTooltip
                        activator="parent"
                        location="top"
                    >
                        Delete
                    </VTooltip>
                </v-btn>
            </div>
        </template>
        </VDataTableServer>
    </VCard>
    <AddEditDialog v-model:isDialogVisible="addEditDialogShow" />
    <DeleteDialog v-model:isDialogVisible="deleteDialogShow" />
</template>