
<script setup>
import { VDialog } from 'vuetify/components';
import { defineModel, defineProps } from 'vue'
import { useUserStore } from '../../Stores/userStore';
import { router } from '@inertiajs/vue3';

const model = defineModel('isDialogVisible')

const store = useUserStore()

const closeDialog = () => {
    model.value = false
    store.reset()
}

const submit = async () => {
    let res

    if(store.user.id){
        res = await store.update()
    }
    else{
        res = await store.create()
    }

    if(res){
        router.reload({
            only: [
                'userList'
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

</script>
<template>
    <VDialog width="700" :model-value="model" @update:model-value="($event) => { updateModelValue($event) }">
        <vCard :title="store.user.id ? 'Edit user' : 'Add user'" class="text-center" color="orange-lighten-5">
            <v-card-text>
                <VForm @submit.prevent="() => { submit() }">
                    <VRow>
                        <VCol
                            cols="12"
                            md="12"
                            class="d-flex align-items-center"
                        >
                            <VTextField
                            variant="outlined"
                            label="user Name"
                            v-model="store.user.name"
                            placeholder="user Name"
                            />
                        </VCol>
                        <VCol
                            cols="12"
                            md="12"
                            class="d-flex align-items-center"
                        >
                            <VTextField
                                variant="outlined"
                                label="user Email"
                                v-model="store.user.email"
                                placeholder="user Email"
                            />
                        </VCol>
                        <VCol
                            cols="12"
                            md="12"
                            class="d-flex align-items-center"
                        >
                            <VSelect
                                :disabled="store.user.id == 1"
                                label="Group"
                                :items="[
                                    'admin',
                                    'teacher'
                                ]"
                                variant="outlined"
                                v-model="store.user.group"
                            />
                        </VCol>
                        <VCol
                            cols="12"
                            md="12"
                            class="d-flex align-items-center"
                        >
                            <VTextField
                                type="password"
                                variant="outlined"
                                label="user Password"
                                v-model="store.user.password"
                                placeholder="user Password"
                            />
                        </VCol>
                        <VCol
                            cols="12"
                            md="12"
                            class="d-flex align-items-center"
                        >
                            <VTextField
                                type="password"
                                variant="outlined"
                                label="Confirm Password"
                                v-model="store.user.confirm"
                                placeholder="Confirm Password"
                            />
                        </VCol>
                    </VRow>
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
