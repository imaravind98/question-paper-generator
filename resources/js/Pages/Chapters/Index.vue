
<script setup>
import { VDataTableServer, VDivider, VIcon, VTextField } from 'vuetify/components';
import { VTooltip } from 'vuetify/components';
import { VBtn } from 'vuetify/components';
import { useChapterStore } from '../../Stores/chapterStore';
import { defineProps, onMounted, ref, watch } from 'vue';
import AddEditDialog from '../../Components/Chapter/AddEditDialog.vue'
import DeleteDialog from '../../Components/Global/dialogBoxes/DeleteDialog.vue'
import { Link } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';

const props = defineProps(
    {
        chapterList: {
            type: Object
        },
        subjects: {
            type: Object
        },
        classes: {
            type: Object
        }
    }
)

const store = useChapterStore()

onMounted(async function(){
    store.reset()
    await store.setChapterList(props.chapterList)
})

watch(props, async function(newProps, oldProps){
    store.setChapterList(newProps.chapterList)
})

const headers = [
    { title: 'Name', key: 'name', sortable: false },
    { title: 'Subject', key: 'subject.name', sortable: false },
    { title: 'Class', key: 'subject.classes.name', sortable: false },
    { title: 'Created On', key: 'created_at', width:200, sortable: false },
    { title: 'Action', key: 'action', width:200, sortable: false}
]

const addEditDialogShow = ref(false)
const deleteDialogShow = ref(false)

const create = () => {
    addEditDialogShow.value = true
}

const remove = (item) => {
    store.setChapter(item)
    deleteDialogShow.value = true
}

const edit = (item) => {
    store.setChapter(item)
    addEditDialogShow.value = true
}

const urlParams = new URLSearchParams(window.location.search);

const page = ref(urlParams.get('page') ?? 1)
const size = ref(urlParams.get('size')?? 15)
const searchTerm = ref(urlParams.get('search')?? '')

watch(searchTerm, async function(newSearchTerm, oldSearchTerm){
    router.get('chapters', { size: size.value, page: page.value, search: newSearchTerm }, { only: ['chapterList'], preserveState: true })
})

const changePage = (pageNumber) => {
    page.value = pageNumber
    router.get('chapters', { size: size.value, page: page.value }, { only: ['chapterList'] })
}

const changePageSize = (pageSize) => {
    size.value = pageSize
    router.get('chapters', { size: size.value, page: page.value }, { only: ['chapterList'] })
}


</script>
<template>
    <VCard title="Chapters" color="orange" variant="outlined">
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
                    Add New Chapter
                    <VTooltip
                        activator="parent"
                        location="top"
                    >
                        Create new Chapters
                    </VTooltip>
                </VBtn>
            </div>
        </template>
        <VDivider />
        <VDataTableServer
            :headers="headers"
            :items="store.chapterList.data"
            :items-per-page="store.chapterList.per_page"
            :items-length="store.chapterList.total"
            :page="store.chapterList.current_page"
            fixed-header
            first-icon="mdi-skip-backward-outline"
            last-icon="mdi-skip-forward-outline"
            next-icon="mdi-arrow-right"
            prev-icon="mdi-arrow-left"
            @update:itemsPerPage="changePageSize($event)"
            @update:page="changePage($event)"
        >
        <template #item.action="{item}">
            <div class="d-flex ga-2">
                <Link :href="`/chapters/${item.id}`" style="color:unset">
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
    <AddEditDialog v-model:isDialogVisible="addEditDialogShow" :subjects="props.subjects" :classes="props.classes" />
    <DeleteDialog v-model:isDialogVisible="deleteDialogShow" />
</template>