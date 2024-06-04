"use strict"
import axios from "axios";
import { defineStore } from "pinia";
import { ref, toRaw } from "vue";

export type chapter = {
    id?:number,
    name?:string,
    created_by?:number,
    updated_by?:number,
    created_at?: Date|string,
    updated_at?: Date|string,
}

export const useChapterStore = defineStore('chapterStore', () => {
    const chapter = ref(<chapter>{})
    const chapters = ref(<chapter[]>[])
    const chapterList = ref({})

    const setChapters = (data) => {
        chapters.value = data
    }

    const setChapter = (data) => {
        chapter.value = structuredClone(toRaw(data))
    }

    const setChapterList = (data) => {
        chapterList.value = data
    }

    const create = async () => {
        const res = await axios.post('/chapters', chapter.value)
        return res
    }

    const update = async () => {
        const res = await axios.put(`/chapters/${chapter.value.id}`, chapter.value)
        return res
    }

    const remove = async () => {
        const res = await axios.delete(`/chapters/${chapter.value.id}`)
        return res
    }

    const reset = () => {
        chapter.value = {
            id: undefined,
            name: undefined,
            created_by: undefined,
            updated_by: undefined,
            created_at: undefined,
            updated_at: undefined,
        }
    }

    return {
        chapter,
        chapters,
        setChapters,
        setChapter,
        chapterList,
        setChapterList,
        create,
        update,
        remove,
        reset
    }
})