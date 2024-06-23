
<script setup>
import { VDialog } from 'vuetify/components';
import { defineModel, defineProps, ref, computed } from 'vue'
import { useChapterStore } from '../../Stores/chapterStore';
import { router } from '@inertiajs/vue3';

const props = defineProps({
    subjects: {
        type: Object
    },
    classes: {
        type: Object
    }
})

const model = defineModel('isDialogVisible')

const store = useChapterStore()

const selectedClass = ref(undefined)

const filteredSubjects = computed(function(){
    const filteredChapter = props.subjects.filter(function(item){
        return item.class_id == selectedClass.value
    })

    return filteredChapter
})

const closeDialog = () => {
    model.value = false
    store.reset()
}

const submit = async () => {
    let res

    if(store.chapter.id){
        res = await store.update()
    }
    else{
        res = await store.create()
    }

    if(res){
        router.reload({
            only: [
                'chapterList'
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
        <vCard :title="store.chapter.id ? 'Edit Chapter' : 'Add Chapter'" class="text-center">
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
                            label="Chapter Name"
                            v-model="store.chapter.name"
                            placeholder="Chapter Name"
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
                                v-model="selectedClass"
                            />
                        </VCol>
                        <VCol
                            cols="12"
                            md="12"
                            class="d-flex align-items-center"
                        >
                            <VSelect
                                label="Subjects"
                                item-value="id"
                                item-title="name"
                                :items="filteredSubjects"
                                variant="outlined"
                                v-model="store.chapter.subject_id"
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
