<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { VForm, VTextField } from 'vuetify/components';
import { defineProps } from 'vue';
import { useFormatDate } from '../../Composables/useFormatDate';


const props = defineProps({
    classData: {
        type: Object,
    },
})

const { formatDate } = useFormatDate()
</script>
<template>
    <VCard :title="props.classData?.name" color="purple-darken-4" variant="outlined">
        <template #append>
            <Link href="/classes" as="button" type="button">
                <VBtn color="primary" prepend-icon="mdi-arrow-left">
                    Back
                </VBtn>
            </Link>
        </template>
        <VCardText>
            <VForm disabled>
                <VRow>
                    <VCol cols="12" md="12">
                        <VTextField label="Name" :model-value="props.classData?.name" variant="outlined" />
                    </VCol>
                    <VCol cols="12" md="6">
                        <VTextField label="Created By" :model-value="props.classData?.creator.name" variant="outlined" />
                    </VCol>
                    <VCol cols="12" md="6">
                        <VTextField label="Created On" :model-value="formatDate(props.classData?.created_at)" variant="outlined" />
                    </VCol>
                    <VCol cols="12" md="6" v-if="props.classData?.updated_at">
                        <VTextField label="Updated By" :model-value="props.classData?.modifier?.name" variant="outlined" />
                    </VCol>
                    <VCol cols="12" md="6" v-if="props.classData?.updated_at">
                        <VTextField label="Updated On" :model-value="formatDate(props.classData?.updated_at)" variant="outlined" />
                    </VCol>
                </VRow>
            </VForm>
        </VCardText>
    </VCard>
</template>