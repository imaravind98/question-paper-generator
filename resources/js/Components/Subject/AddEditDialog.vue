
<script setup>
import { VDialog } from 'vuetify/components';
import { defineModel, defineProps } from 'vue'
import { useSubjectStore } from '../../Stores/subjectStore';
import { router } from '@inertiajs/vue3';

const props = defineProps({
    classes: {
        type: Object
    }
})

const model = defineModel('isDialogVisible')

const store = useSubjectStore()

const closeDialog = () => {
    model.value = false
    store.reset()
}

const submit = async () => {
    let res

    if(store.subject.id){
        res = await store.update()
    }
    else{
        res = await store.create()
    }

    if(res){
        router.reload({
            only: [
                'subjectList'
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
        <vCard :title="store.subject.id ? 'Edit Subject' : 'Add Subject'" class="text-center" color="orange-lighten-5">
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
                                v-model="store.subject.name"
                                placeholder="Subject Name"
                            />
                        </VCol>
                        <VCol
                            cols="12"
                            md="12"
                            class="d-flex align-items-center"
                        >
                            <VSelect
                                label="Class"
                                item-value="id"
                                item-title="name"
                                :items="props.classes"
                                variant="outlined"
                                v-model="store.subject.class_id"
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
