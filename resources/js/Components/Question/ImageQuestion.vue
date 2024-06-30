<script setup>
import { defineModel } from 'vue';
import { useFile } from '../../Composables/useFile'

const model = defineModel()
const { uploadFile } = useFile()

const upload = async (event) => {
    const image = event.target.files[0]
    const res = await uploadFile(image, 'image_questions')

    if(res){
        model.value = res
    }

}
</script>
<template>
     <p class="text-left mb-1">Upload Image</p>
    <VRow>
        <VCol
            cols="12"
            md="12"
            class="d-flex align-items-center text-left"
        >
            <VFileInput
                label="Upload Image"
                variant="outlined"
                placeholder="Choose a image"
                prepend-icon="mdi-camera-outline"
                @change="upload($event)"
            />
        </VCol>
    </VRow>
</template>