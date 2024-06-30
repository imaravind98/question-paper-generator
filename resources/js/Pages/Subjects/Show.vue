<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { VForm, VTextField } from 'vuetify/components';
import { defineProps } from 'vue';
import { useFormatDate } from '../../Composables/useFormatDate';

const props = defineProps({
    subject: {
        type: Object,
    },
})

const { formatDate } = useFormatDate()
</script>
<template>
    <VCard :title="props.subject?.name" color="orange" variant="outlined">
        <template #append>
            <Link href="/subjects" as="button" type="button">
                <VBtn color="primary" prepend-icon="mdi-arrow-left">
                    Back
                </VBtn>
            </Link>
        </template>
        <VCardText>
            <VForm disabled>
                <VRow>
                <VCol cols="12" md="6">
                    <VTextField label="Name" :model-value="props.subject?.name" variant="outlined" />
                </VCol>
                <VCol cols="12" md="6">
                    <VTextField label="Class" :model-value="props.subject?.classes?.name" variant="outlined" />
                </VCol>
                <VCol cols="12" md="6">
                    <VTextField label="Created By" :model-value="props.subject?.creator.name" variant="outlined" />
                </VCol>
                <VCol cols="12" md="6">
                    <VTextField label="Created On" :model-value="formatDate(props.subject?.created_at)" variant="outlined" />
                </VCol>
                <VCol cols="12" md="6" v-if="props.subject?.updated_at">
                    <VTextField label="Updated By" :model-value="props.subject?.modifier?.name" variant="outlined" />
                </VCol>
                <VCol cols="12" md="6" v-if="props.subject?.updated_at">
                    <VTextField label="Updated On" :model-value="formatDate(props.subject?.updated_at)" variant="outlined" />
                </VCol>
            </VRow>
            </VForm>
        </VCardText>
    </VCard>
</template>