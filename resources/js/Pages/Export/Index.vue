<script setup>
import { VCardText, VForm, VSelect, VTextField } from 'vuetify/lib/components/index.mjs';
import { ref, defineProps, computed } from 'vue';
import DynamicFields from '../../Components/Export/DynamicFields.vue';
import axios from 'axios';
import { useFile } from '../../Composables/useFile.ts'
import { useValidator } from '../../Composables/useValidator';

const props = defineProps({
    classes: {
        type: Object,
    },
    subjects: {
        type: Object,
    },
    chapters: {
        type: Object,
    },
})

const classes = ref()
const subject = ref()
const chapters = ref([])
const totalMark = ref(0)
const duration = ref(0)
const testName = ref('')
const { requiredValidator } = useValidator()

const filteredSubject = computed(function(){
    const filteredArray = props.subjects.filter(function(item){
        return item.class_id == classes.value
    })

    return filteredArray
})

const filteredChapters = computed(function(){
    const filteredArray = props.chapters.filter(function(item){
        return item.subject_id == subject.value
    })

    return filteredArray
})

const questionTypes = [
    { title: 'Fill Ups', value: 'one_word' },
    { title: 'MCQ', value: 'choose' },
    { title: 'True Or False', value: 'true_or_false' },
    { title: 'Match', value: 'match' },
    { title: 'Short Answer', value: 'short_answer' },
    { title: 'Random Question', value: 'random_question' },
    { title: 'Detail', value: 'detail' },
    { title: 'Image Question', value: 'image_question' }
]

const questions = ref([
    { heading: undefined, questionType: undefined, no_of_questions: 0, marks: 0 }
])

const { downloadFile } = useFile()

const submit = async () => {
    if(requiredValidator(testName.value) != true){
        return
    }

    if(requiredValidator(duration.value) != true){
        return
    }

    if(requiredValidator(totalMark.value) != true){
        return
    }

    if(requiredValidator(chapters.value) != true){
        return
    }

    if(requiredValidator(subject.value) != true){
        return
    }

    if(requiredValidator(classes.value) != true){
        return
    }

    const res = await axios.post('export', 
    {
        testName: testName.value,
        duration: duration.value,
        totalMark: totalMark.value,
        chapters: chapters.value,
        questions: questions.value,
        subject: subject.value,
        classes: classes.value
    }, 
    {
        responseType: 'blob'
    })

    downloadFile(res.data, 'question_paper')
}

</script>
<template>
    <VCard title="Export" color="purple-darken-4" variant="outlined">
        <VCardText>
            <VForm @submit.prevent="() => { submit() }">
                <VRow>
                    <VCol cols="12" md="6">
                        <VSelect
                            label="Class"
                            item-value="id"
                            item-title="name"
                            :items="props.classes"
                            variant="outlined"
                            v-model="classes"
                            :rules="[requiredValidator]"
                        />
                    </VCol>
                    <VCol cols="12" md="6">
                        <VSelect
                            label="Subject"
                            item-value="id"
                            item-title="name"
                            :items="filteredSubject"
                            variant="outlined"
                            v-model="subject"
                            :rules="[requiredValidator]"
                        />
                    </VCol>
                    <VCol cols="12" md="6">
                        <VSelect
                            label="Chapters"
                            multiple
                            chips
                            item-value="id"
                            item-title="name"
                            :items="filteredChapters"
                            variant="outlined"
                            v-model="chapters"
                            :rules="[requiredValidator]"
                        />
                    </VCol>
                    <VCol cols="12" md="6">
                        <VTextField
                            label="Test Name"
                            placeholder="Enter Test Name"
                            variant="outlined"
                            v-model="testName"
                            :rules="[requiredValidator]"
                        />
                    </VCol>
                    <VCol cols="12" md="6">
                        <VTextField
                            label="Total Marks"
                            type="number"
                            placeholder="Enter Total Marks"
                            variant="outlined"
                            v-model="totalMark"
                            :rules="[requiredValidator]"
                        />
                    </VCol>
                    <VCol cols="12" md="6">
                        <VTextField
                            label="Duration(Mins)"
                            type="number"
                            placeholder="Enter Duration"
                            variant="outlined"
                            v-model="duration"
                            :rules="[requiredValidator]"
                        />
                    </VCol>
                </VRow>
                <DynamicFields 
                    :questionTypes="questionTypes" 
                    v-model="questions"
                />
                <VRow>
                    <VCol
                        cols="12"
                        md="12"
                        class="d-flex gap-4 justify-end"
                    >
                        <VBtn class="me-2" type="submit" color="primary">
                            Export
                        </VBtn>
                    </VCol>
                </VRow>
            </VForm>
        </VCardText>
    </VCard>
</template>