
<script setup>
import { VDialog } from 'vuetify/components';
import { defineModel, ref } from 'vue'
import { useChapterStore } from '@/Stores/chapterStore';
import { router } from '@inertiajs/vue3';

const model = defineModel('isDialogVisible')
const deleteSuccess = ref(false)

const store = useChapterStore()

const closeDialog = () => {
    model.value = false
    deleteSuccess.value=false
    store.reset()
}

const confirmDelete = async () => {
    const res = await store.remove()
    if(res){
        router.reload({
            only: [
                'chapterList'
            ]
        })
    }
    model.value = false
    deleteSuccess.value=true
    store.reset()
}

</script>
<template>
    <VDialog width="400" v-model="model">
        <vCard class="text-center" title="Are you sure want to delete?">
            <v-card-text>
                <VRow>
                    <VCol
                        cols="12"
                        md="12"
                        class="d-flex gap-4 justify-center"
                    >
                        <VBtn class="me-2" 
                        color="error"
                        @click="confirmDelete"
                        >
                            Delete
                        </VBtn>

                        <VBtn
                        color="secondary"
                        variant="tonal"
                        @click="closeDialog"
                        >
                            Cancel
                        </VBtn>
                    </VCol>
                </VRow>
            </v-card-text>
        </vCard>
    </VDialog>
    <VDialog width="400" v-model="deleteSuccess">
        <vCard class="text-center" title="Deleted Successfully">
            <v-card-text>
                <VRow>
                    <VCol
                        cols="12"
                        md="12"
                        class="d-flex gap-4 justify-center"
                    >
                        <VIcon icon="mdi-check-circle-outline" color="success" size="100"/>
                    </VCol>
                </VRow>
                <VRow>
                    <VCol
                        cols="12"
                        md="12"
                        class="d-flex gap-4 justify-center"
                    >
                        <VBtn class="me-2" 
                        color="success"
                        @click="closeDialog"
                        >
                            Ok
                        </VBtn>
                    </VCol>
                </VRow>
            </v-card-text>
        </vCard>
    </VDialog>
</template>
