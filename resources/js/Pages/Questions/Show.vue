<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { VForm, VTextField } from 'vuetify/components';


const props = defineProps({
    question: {
        type: Object,
    },
})
</script>
<template>
    <VCard :title="props.question?.name" color="orange" variant="outlined">
        <template #append>
            <Link href="/questions" as="button" type="button">
                <VBtn color="primary" prepend-icon="mdi-arrow-left">
                    Back
                </VBtn>
            </Link>
        </template>
        <VCardText>
            <VForm disabled>
                <VRow>
                <VCol cols="12" md="12">
                    <VTextField label="Name" :model-value="props.question?.name" variant="outlined" />
                </VCol>
                <VCol cols="12" md="6">
                    <VTextField label="Created On" :model-value="props.question?.created_at" variant="outlined" />
                </VCol>
                <VCol cols="12" md="6">
                    <VTextField label="Updated On" :model-value="props.question?.updated_at" variant="outlined" />
                </VCol>
                <VCol cols="12" md="6">
                    <VTextField label="Created By" :model-value="props.question?.created_by" variant="outlined" />
                </VCol>
                <VCol cols="12" md="6">
                    <VTextField label="Updated By" :model-value="props.question?.updated_by" variant="outlined" />
                </VCol>
            </VRow>
            </VForm>
        </VCardText>
    </VCard>
</template>