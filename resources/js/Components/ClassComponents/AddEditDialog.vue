
<script setup>
import { VDialog } from 'vuetify/components';
import { defineModel } from 'vue'
import { useClassesStore } from '../../Stores/classStore';
import { router } from '@inertiajs/vue3';

const model = defineModel('isDialogVisible')

const store = useClassesStore()

const closeDialog = () => {
    model.value = false
    store.reset()
}

const submit = async () => {
    let res

    if(store.classData.id){
        res = await store.update()
    }
    else{
        res = await store.create()
    }

    if(res){
        router.reload({
            only: [
                'classList'
            ]
        })
    }
    model.value = false
    store.reset()
}

const updateModelValue = (event) => {
    if(!event){
        store.reset()
    }
    model.value = event
}

</script>
<template>
    <VDialog width="400" :model-value="model" @update:model-value="($event) => { updateModelValue($event) }">
        <vCard :title="store.classData.id ? 'Edit class' : 'Add class'" class="text-center" color="orange-lighten-5">
            <v-card-text>
                <VForm @submit.prevent="() => { submit() }">
                    <VRow>
                        <VCol
                            cols="12"
                            md="12"
                            class="d-flex align-items-center"
                        >
                            <VTextField
                            variant="outlined"
                            label="Name"
                            v-model="store.classData.name"
                            placeholder="class Name"
                            />
                        </VCol>
                    </VRow>
                    <VRow>
                        <VCol
                            cols="12"
                            md="12"
                            class="d-flex gap-4 justify-center"
                        >
                            <VBtn class="me-2" type="submit" color="primary">
                            Submit
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
                </VForm>
            </v-card-text>
        </vCard>
    </VDialog>
</template>
