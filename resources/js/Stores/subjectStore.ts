"use strict"
import axios from "axios";
import { defineStore } from "pinia";
import { ref, toRaw } from "vue";

export type subject = {
    id?:number,
    name?:string,
    created_by?:number,
    updated_by?:number,
    created_at?: Date|string,
    updated_at?: Date|string,
}

export const useSubjectStore = defineStore('subjectStore', () => {
    const subject = ref(<subject>{})
    const subjects = ref(<subject[]>[])
    const subjectList = ref({})

    const setSubjects = (data) => {
        subjects.value = data
    }

    const setSubject = (data) => {
        subject.value = structuredClone(toRaw(data))
    }

    const setSubjectList = (data) => {
        subjectList.value = data
    }

    const create = async () => {
        const res = await axios.post('/subjects', subject.value)
        return res
    }

    const update = async () => {
        const res = await axios.put(`/subjects/${subject.value.id}`, subject.value)
        return res
    }

    const remove = async () => {
        const res = await axios.delete(`/subjects/${subject.value.id}`)
        return res
    }

    const reset = () => {
        subject.value = {
            id: undefined,
            name: undefined,
            created_by: undefined,
            updated_by: undefined,
            created_at: undefined,
            updated_at: undefined,
        }
    }

    return {
        subject,
        subjects,
        setSubjects,
        setSubject,
        subjectList,
        setSubjectList,
        create,
        update,
        remove,
        reset
    }
})