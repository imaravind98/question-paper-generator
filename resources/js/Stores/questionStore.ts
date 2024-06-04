"use strict"
import axios from "axios";
import { defineStore } from "pinia";
import { ref, toRaw } from "vue";

export type question = {
    id?:number,
    question?:string,
    type?:string,
    option?: Object,
    mark?: number|string,
    class_id?: number,
    subject_id?: number,
    chapter_id?: number,
    created_by?:number,
    updated_by?:number,
    created_at?: Date|string,
    updated_at?: Date|string,
}

export const useQuestionStore = defineStore('questionStore', () => {
    const question = ref(<question>{})
    const questions = ref(<question[]>[])
    const questionList = ref({})

    const setQuestions = (data) => {
        questions.value = data
    }

    const setQuestion = (data) => {
        question.value = structuredClone(toRaw(data))
    }

    const setQuestionList = (data) => {
        questionList.value = data
    }

    const create = async () => {
        const res = await axios.post('/questions', question.value)
        return res
    }

    const update = async () => {
        const res = await axios.put(`/questions/${question.value.id}`, question.value)
        return res
    }

    const remove = async () => {
        const res = await axios.delete(`/questions/${question.value.id}`)
        return res
    }

    const reset = () => {
        question.value = {
            id: undefined,
            question: undefined,
            type: undefined,
            option: [],
            mark: undefined,
            class_id: undefined,
            subject_id: undefined,
            chapter_id: undefined,
            created_by: undefined,
            updated_by: undefined,
            created_at: undefined,
            updated_at: undefined,
        }
    }

    return {
        question,
        questions,
        setQuestions,
        setQuestion,
        questionList,
        setQuestionList,
        create,
        update,
        remove,
        reset
    }
})