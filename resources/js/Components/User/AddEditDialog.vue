
<script setup>
import { VDialog } from 'vuetify/components';
import { defineModel, ref } from 'vue'
import { useUserStore } from '../../Stores/userStore';
import { router } from '@inertiajs/vue3';
import { useValidator } from '../../Composables/useValidator';

const model = defineModel('isDialogVisible')

const store = useUserStore()

const { requiredValidator, confirmPasswordValidator } = useValidator()

const errorMessages = ref({})

const closeDialog = () => {
    model.value = false
    errorMessages.value = {}
    store.reset()
}

const submit = async () => {
    if(requiredValidator(store.user.name) != true){
        return
    }
    if(requiredValidator(store.user.email) != true){
        return
    }
    if(requiredValidator(store.user.password) != true){
        return
    }
    if(requiredValidator(store.user.confirm) != true){
        return
    }
    if(confirmPasswordValidator(store.user.confirm, store.user.password) != true){
        return 
    }

    let res

    if(store.user.id){
        res = await store.update()
    }
    else{
        res = await store.create()
    }

    if(!res.errors){
        router.reload({
            only: [
                'userList'
            ]
        })
    }
    else{
        errorMessages.value = res.errors
        console.log(res.errors)
        return 
    }
    model.value = false
    errorMessages.value = {}
    store.reset()
}

const updateModelValue = (event) => {
    if(!event){
        store.reset()
    }
    model.value = event
    errorMessages.value = {}
}

</script>
<template>
    <VDialog width="700" :model-value="model" @update:model-value="($event) => { updateModelValue($event) }">
        <vCard :title="store.user.id ? 'Edit user' : 'Add user'" class="text-center" color="purple-lighten-5">
            <v-card-text>
                <VForm @submit.prevent="() => { submit() }">
                    <VRow>
                        <VCol
                            cols="12"
                            md="12"
                            class="d-flex align-items-center text-left"
                        >
                            <VTextField
                                variant="outlined"
                                label="user Name"
                                v-model="store.user.name"
                                placeholder="user Name"
                                :rules="[requiredValidator]"
                            />
                        </VCol>
                        <VCol
                            cols="12"
                            md="12"
                            class="d-flex flex-column align-items-center text-left"
                        >
                            <VTextField
                                variant="outlined"
                                label="user Email"
                                v-model="store.user.email"
                                placeholder="user Email"
                                :rules="[requiredValidator]"
                                :errorMessages="errorMessages.email?.length ? [errorMessages.email[0]] : []"
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
                            class="d-flex align-items-center text-left"
                        >
                            <VTextField
                                type="password"
                                variant="outlined"
                                label="user Password"
                                v-model="store.user.password"
                                placeholder="user Password"
                                :rules="[requiredValidator]"
                                :errorMessages="errorMessages.password?.length ? [errorMessages.password[0]] : []"
                            />
                        </VCol>
                        <VCol
                            cols="12"
                            md="12"
                            class="d-flex align-items-center text-left"
                        >
                            <VTextField
                                type="password"
                                variant="outlined"
                                label="Confirm Password"
                                v-model="store.user.confirm"
                                placeholder="Confirm Password"
                                :rules="[requiredValidator, confirmPasswordValidator(store.user.confirm, store.user.password)]"
                            />
                        </VCol>
                        <VCol
                            cols="12"
                            md="12"
                            class="d-flex align-items-center text-left"
                        >
                            <VFileInput
                                label="Upload Image"
                                v-model="store.user.image"
                                variant="outlined"
                                placeholder="Choose a image"
                                prepend-icon="mdi-camera-outline"
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
