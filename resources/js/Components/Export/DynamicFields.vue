<script setup>
import { defineModel } from 'vue';

const props = defineProps({
    questionTypes: {
        type: Object
    }
})

const questions = defineModel()

const addField = () => {
    questions.value.push({
        heading: undefined, 
        questionType: undefined, 
        marks: 0,
        no_of_questions: 0
    })
}

const removeField = (index) => {
    questions.value.splice(index, 1)
}
</script>
<template>
    <VRow>
        <VCol
            cols="12"
            md="12"
        >
            <VTable class="text-no-wrap w-100">
                <thead>
                    <tr>
                        <th style="width: 300px;">
                            Question Type
                        </th>
                        <th>
                            Heading
                        </th>
                        <th style="width: 100px;">
                            No Of Questions
                        </th>
                        <th style="width: 100px;">
                            Marks
                        </th>
                        <th style="width: 80px;">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(question, index) in questions" :key="index">
                        <td class="pa-2">
                            <VSelect
                                label="Question Type"
                                :items="props.questionTypes"
                                variant="outlined"
                                v-model="question.questionType"
                            />
                        </td>
                        <td class="pa-2">
                            <VTextField
                                :disabled="question.questionType == 'match'"
                                label="Heading"
                                variant="outlined"
                                v-model="question.heading"
                            />
                        </td>
                        <td class="pa-2">
                            <span :ref="(el) => { if(question.questionType == 'match') question.no_of_questions = 1 }" />
                            <VTextField
                                :disabled="question.questionType == 'match'"
                                label="No of Questions"
                                variant="outlined"
                                v-model="question.no_of_questions"
                            />
                        </td>
                        <td class="pa-2">
                            <VTextField
                                label="Marks"
                                variant="outlined"
                                v-model="question.marks"
                            />
                        </td>
                        <td class="pa-2">
                            <v-btn 
                                variant="flat" 
                                v-if="index == (questions.length-1)"
                                @click="addField"
                            >
                                <VIcon icon="mdi-plus" />
                                <VTooltip
                                    activator="parent"
                                    location="top"
                                >
                                    Add Questions
                                </VTooltip>
                            </v-btn>
                            <v-btn 
                                variant="flat" 
                                v-if="index != (questions.length-1)"
                                @click="removeField(index)"
                            >
                                <VIcon icon="mdi-minus" />
                                <VTooltip
                                    activator="parent"
                                    location="top"
                                >
                                    Remove Questions
                                </VTooltip>
                            </v-btn>
                        </td>
                    </tr>
                </tbody>
            </VTable>
        </VCol>
    </VRow>
</template>