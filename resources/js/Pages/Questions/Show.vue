<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { VForm, VTextField } from 'vuetify/components';
import { useFormatDate } from '../../Composables/useFormatDate';


const props = defineProps({
    question: {
        type: Object,
    },
})

const { formatDate } = useFormatDate()
</script>
<template>
    <VCard :title="props.question?.name" color="purple-darken-4" variant="outlined">
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
                <VCol cols="12" md="6">
                    <VTextField label="Name" :model-value="props.question?.question" variant="outlined" />
                </VCol>
                <VCol cols="12" md="6">
                    <VTextField label="Chapter" :model-value="props.question?.chapter?.name" variant="outlined" />
                </VCol>
                <VCol cols="12" md="6">
                    <VTextField label="Subject" :model-value="props.question?.chapter?.subject?.name" variant="outlined" />
                </VCol>
                <VCol cols="12" md="6">
                    <VTextField label="Class" :model-value="props.question?.chapter?.subject?.classes?.name" variant="outlined" />
                </VCol>
                <VCol cols="12" md="6">
                    <VTextField label="Created By" :model-value="props.question?.creator.name" variant="outlined" />
                </VCol>
                <VCol cols="12" md="6">
                    <VTextField label="Created On" :model-value="formatDate(props.question?.created_at)" variant="outlined" />
                </VCol>
                <VCol cols="12" md="6" v-if="props.question?.updated_at">
                    <VTextField label="Updated By" :model-value="props.question?.modifier?.name" variant="outlined" />
                </VCol>
                <VCol cols="12" md="6" v-if="props.question?.updated_at">
                    <VTextField label="Updated On" :model-value="formatDate(props.question?.updated_at)" variant="outlined" />
                </VCol>
            </VRow>
            </VForm>
        </VCardText>
    </VCard>
</template>