<script setup>
import { VTextField } from 'vuetify/lib/components/index.mjs';
import { defineModel } from 'vue';

const model = defineModel()

model.value = model.value.length ? model.value : [
    { column_1: undefined, column_2: undefined }
]
const add = () => {
    model.value.push({ column_1: undefined, column_2: undefined })
}

const remove = (index) => {
    model.value.splice(index, 1)
}
</script>
<template>
    <p class="text-left mb-1">Options</p>
    <VRow 
        v-for="(column, index) in model" 
        :key="index">
        <VCol 
            cols="12"
            md="5"
            class="d-flex align-items-center"
        >
            <VTextField
                :label="'Option '+(index+1)"
                placeholder="Marks alloted"
                variant="outlined"
                v-model="column.column_1"
            />
        </VCol>
        <VCol 
            cols="12"
            md="5"
            class="d-flex align-items-center"
        >
            <VTextField
                :label="'Option '+(index+1)"
                placeholder="Marks alloted"
                variant="outlined"
                v-model="column.column_2"
            />
        </VCol>
        <VCol 
            cols="12"
            md="2"
            class="d-flex align-items-center"
        >
            <v-btn variant="flat" @click="remove(index)">
                <VIcon icon="mdi-minus" />
                <VTooltip
                    activator="parent"
                    location="top"
                >
                    Delete Row
                </VTooltip>
            </v-btn>
        </VCol>
    </VRow>
    <VRow>
        <VCol 
            cols="12"
            md="12"
            class="d-flex justify-center align-items-center w-100"
        >
            <v-btn variant="flat" @click="add">
                <VIcon icon="mdi-plus" />
                <VTooltip
                    activator="parent"
                    location="top"
                >
                    Add Row
                </VTooltip>
            </v-btn>
        </VCol>
    </VRow>
</template>