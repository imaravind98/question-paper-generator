"use strict"
import axios from "axios";
import { defineStore } from "pinia";
import { ref, toRaw } from "vue";

export type classes = {
    id?:number,
    name?:string,
    created_by?:number,
    updated_by?:number,
    created_at?: Date|string,
    updated_at?: Date|string,
}

export const useClassesStore = defineStore('classesStore', () => {
    const classData = ref(<classes>{})
    const classess = ref(<classes[]>[])
    const classesList = ref({})

    const setclassess = (data) => {
        classess.value = data
    }

    const setclasses = (data) => {
        classData.value = structuredClone(toRaw(data))
    }

    const setclassesList = (data) => {
        classesList.value = data
    }

    const create = async () => {
        const res = await axios.post('/classes', classData.value)
        return res
    }

    const update = async () => {
        const res = await axios.put(`/classes/${classData.value.id}`, classData.value)
        return res
    }

    const remove = async () => {
        const res = await axios.delete(`/classes/${classData.value.id}`)
        return res
    }

    const reset = () => {
        classData.value = {
            id: undefined,
            name: undefined,
            created_by: undefined,
            updated_by: undefined,
            created_at: undefined,
            updated_at: undefined,
        }
    }

    return {
        classData,
        classess,
        setclassess,
        setclasses,
        classesList,
        setclassesList,
        create,
        update,
        remove,
        reset
    }
})