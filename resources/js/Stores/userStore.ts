"use strict"
import axios from "axios";
import { defineStore } from "pinia";
import { ref, toRaw } from "vue";

export type user = {
    id?:number,
    name?:string,
    email?:string,
    group?: string,
    password?: string,
    confirm?:string,
    created_by?:number,
    updated_by?:number,
    created_at?: Date|string,
    updated_at?: Date|string,
}

export const useUserStore = defineStore('userStore', () => {
    const user = ref(<user>{})
    const users = ref(<user[]>[])
    const userList = ref({})

    const setUsers = (data) => {
        users.value = data
    }

    const setUser = (data) => {
        user.value = structuredClone(toRaw(data))
    }

    const setUserList = (data) => {
        userList.value = data
    }

    const create = async () => {
        try{
            const res = await axios.post('/users', user.value)
            return res
        }
        catch(error){
            return error.response.data
        }
        
    }

    const update = async () => {
        const res = await axios.put(`/users/${user.value.id}`, user.value)
        return res
    }

    const remove = async () => {
        const res = await axios.delete(`/users/${user.value.id}`)
        return res
    }

    const reset = () => {
        user.value = {
            id: undefined,
            name: undefined,
            email: undefined,
            group: 'teacher',
            password: undefined,
            confirm: undefined,
            created_by: undefined,
            updated_by: undefined,
            created_at: undefined,
            updated_at: undefined,
        }
    }

    return {
        user,
        users,
        setUsers,
        setUser,
        userList,
        setUserList,
        create,
        update,
        remove,
        reset
    }
})