
<script setup>
"use strict"
import { VDialog, VTextarea } from 'vuetify/components';
import { computed, defineModel } from 'vue'
import { useQuestionStore } from '../../Stores/questionStore';
import { router } from '@inertiajs/vue3';
import ChooseBestAnswer from './ChooseBestAnswer.vue';
import MatchTheFollowing from './MatchTheFollowing.vue'
import { useValidator } from '../../Composables/useValidator';
import ImageQuestion from './ImageQuestion.vue';

const props = defineProps({
    classes: {
        type: Object
    },
    subjects: {
        type: Object
    },
    chapters: {
        type: Object
    }
})

const model = defineModel('isDialogVisible')

const store = useQuestionStore()

const { requiredValidator } = useValidator() 

const closeDialog = () => {
    model.value = false
    store.reset()
}

const submit = async () => {

    if(requiredValidator(store.question.class_id) != true){
        return
    }

    if(requiredValidator(store.question.subject_id) != true){
        return
    }

    if(requiredValidator(store.question.chapter_id) != true){
        return
    }

    if(requiredValidator(store.question.type) != true){
        return
    }

    if(requiredValidator(store.question.question) != true){
        return
    }

    let res

    if(store.question.id){
        res = await store.update()
    }
    else{
        res = await store.create()
    }

    if(res){
        router.reload({
            only: [
                'questionList'
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

const quetionType = [
    { title: 'Fill Ups', value: 'one_word' },
    { title: 'MCQ', value: 'choose' },
    { title: 'True Or False', value: 'true_or_false' },
    { title: 'Match', value: 'match' },
    { title: 'Short Answer', value: 'short_answer' },
    { title: 'Random Question', value: 'random_question' },
    { title: 'Detail', value: 'detail' },
    { title: 'Image Question', value: 'image_question' }
]


const subjects = computed(function(){
    const filteredSubject = props.subjects.filter(function(item){
        return item.class_id == store.question.class_id
    })

    return filteredSubject
})

const chapters = computed(function(){
    const filteredChapter = props.chapters.filter(function(item){
        return item.subject_id == store.question.subject_id
    })

    return filteredChapter
})
</script>
<template>
    <VDialog width="900" :model-value="model" @update:model-value="($event) => { updateModelValue($event) }">
        <vCard :title="store.question.id ? 'Edit question' : 'Add question'" class="text-center" color="purple-lighten-5">
            <v-card-text>
                <VForm @submit.prevent="() => { submit() }">
                    <VRow>
                        <VCol
                            cols="12"
                            md="6"
                            class="d-flex align-items-center text-left"
                        >
                            <VSelect
                                label="Class"
                                item-value="id"
                                item-title="name"
                                :items="props.classes"
                                variant="outlined"
                                v-model="store.question.class_id"
                                :rules="[requiredValidator]"
                            />
                        </VCol>
                        <VCol
                            cols="12"
                            md="6"
                            class="d-flex align-items-center text-left"
                        >
                            <VSelect
                                label="Subject"
                                item-value="id"
                                item-title="name"
                                :items="subjects"
                                variant="outlined"
                                v-model="store.question.subject_id"
                                :rules="[requiredValidator]"
                            />
                        </VCol>
                        <VCol
                            cols="12"
                            md="6"
                            class="d-flex align-items-center text-left"
                        >
                            <VSelect
                                label="Chapter"
                                item-value="id"
                                item-title="name"
                                :items="chapters"
                                variant="outlined"
                                v-model="store.question.chapter_id"
                                :rules="[requiredValidator]"
                            />
                        </VCol>
                        <VCol
                            cols="12"
                            md="6"
                            class="d-flex align-items-center text-left"
                        >
                            <VSelect
                                label="Type"
                                :items="quetionType"
                                variant="outlined"
                                v-model="store.question.type"
                                :rules="[requiredValidator]"
                            />
                        </VCol>
                        <VCol
                            cols="12"
                            md="12"
                            class="d-flex align-items-center text-left"
                        >
                            <VTextarea
                            variant="outlined"
                            label="question"
                            v-model="store.question.question"
                            placeholder="question"
                            :rules="[requiredValidator]"
                            />
                        </VCol>
                    </VRow>
                    <ChooseBestAnswer v-if="store.question.type == 'choose'" v-model="store.question.option" />
                    <MatchTheFollowing v-if="store.question.type == 'match'" v-model="store.question.option" />
                    <ImageQuestion v-if="store.question.type == 'image_question'" v-model="store.question.option" />
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
