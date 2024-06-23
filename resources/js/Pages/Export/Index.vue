<script setup>
import { VCardText, VForm, VSelect } from 'vuetify/lib/components/index.mjs';
import { ref, defineProps, computed } from 'vue';
import DynamicFields from '../../Components/Export/DynamicFields.vue';
import axios from 'axios';
import { useFile } from '../../Composables/useFile.ts'

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
    { title: 'Match', value: 'match' },
    { title: 'Choose', value: 'choose' },
    { title: 'One Word', value: 'one_word'},
    { title: 'Short Answer', value: 'short_answer'},
    { title: 'Detail', value: 'detail' }
]

const questions = ref([
    { heading: undefined, questionType: undefined, no_of_questions: 0, marks: 0 }
])

const { downloadFile } = useFile()

const submit = async () => {
    const res = await axios.post('export', 
    {
        chapters: chapters.value,
        questions: questions.value
    }, 
    {
        responseType: 'blob'
    })

    downloadFile(res.data, 'question_paper')
}

</script>
<template>
    <VCard title="Export">
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
                        />
                    </VCol>
                    <VCol cols="12" md="12">
                        <VSelect
                            label="Chapters"
                            multiple
                            chips
                            item-value="id"
                            item-title="name"
                            :items="filteredChapters"
                            variant="outlined"
                            v-model="chapters"
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