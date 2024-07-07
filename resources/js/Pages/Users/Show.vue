<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { VForm, VImg, VTextField } from 'vuetify/components';
import { defineProps } from 'vue';
import { useFormatDate } from '../../Composables/useFormatDate';


const props = defineProps({
    UserData: {
        type: Object,
    },
})

const { formatDate } = useFormatDate()
</script>
<template>
    <VCard :title="props.UserData?.name" color="purple-darken-4" variant="outlined">
        <template #append>
            <Link href="/users" as="button" type="button">
                <VBtn color="primary" prepend-icon="mdi-arrow-left">
                    Back
                </VBtn>
            </Link>
        </template>
        <VCardText>
            <VForm disabled>
                <VRow>
                <VCol cols="12" md="6">
                    <VTextField label="Name" :model-value="props.UserData?.name" variant="outlined" />
                </VCol>
                <VCol cols="12" md="6">
                    <VTextField label="Email" :model-value="props.UserData?.email" variant="outlined" />
                </VCol>
                <VCol cols="12" md="6">
                    <VTextField label="Group" :model-value="props.UserData?.group" variant="outlined" />
                </VCol>
                <VCol cols="12" md="6" class="d-flex justify-start align-start" rounded="xs">
                    <p class="mr-4">Image</p>
                    <VImg :src="props.UserData?.image" max-width="50" height="50"/>
                </VCol>
                <VCol cols="12" md="6">
                    <VTextField label="Created On" :model-value="formatDate(props.UserData?.created_at)" variant="outlined" />
                </VCol>
                <VCol cols="12" md="6" v-if="props.UserData?.updated_at">
                    <VTextField label="Updated On" :model-value="formatDate(props.UserData?.updated_at)" variant="outlined" />
                </VCol>
            </VRow>
            </VForm>
        </VCardText>
    </VCard>
</template>