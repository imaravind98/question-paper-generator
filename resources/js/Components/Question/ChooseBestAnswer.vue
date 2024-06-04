<script setup>
import { VTextField } from 'vuetify/lib/components/index.mjs';
import { defineModel } from 'vue';

const model = defineModel()

console.log(model.value.length)
model.value = model.value.length && model.value.length > 4 ? model.value : [
    { option: 'A', value: '' },
    { option: 'B', value: '' },
    { option: 'C', value: '' },
    { option: 'D', value: '' }
]
</script>
<template>
    <p class="text-left mb-1">Options</p>
    <VRow>
        <VCol 
            v-for="(option, index) in model" 
            :key="index"
            cols="12"
            md="6"
            class="d-flex align-items-center"
        >
            <VTextField
                :label="option.option"
                placeholder="Marks alloted"
                variant="outlined"
                v-model="option.value"
            />
        </VCol>
    </VRow>
</template>