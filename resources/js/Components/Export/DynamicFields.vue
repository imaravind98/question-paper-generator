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
            <VTable class="text-no-wrap">
                <thead>
                    <tr>
                        <th>
                            Heading
                        </th>
                        <th>
                            Question Type
                        </th>
                        <th>
                            No Of Questions
                        </th>
                        <th>
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(question, index) in questions" :key="index">
                        <td class="pa-2">
                            <VTextField
                                label="Heading"
                                variant="outlined"
                                v-model="question.heading"
                            />
                        </td>
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
                                label="No of Questions"
                                variant="outlined"
                                v-model="question.no_of_questions"
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