<script lang="ts" setup>
import { ref, defineOptions } from 'vue'
import Login from '../../Layout/Login.vue'
import { router } from '@inertiajs/vue3';

defineOptions({ layout: Login })

const email = ref('')
const password = ref<string>()

const submit = async () => {
  router.post('/login', { email: email.value, password: password.value })
}
</script>

<template>
  <VCard title="Login" class="text-center">
    <VCardText>
      <VForm @submit.prevent="() => { submit() }">
        <VRow>
          <VCol cols="12">
            <!-- 👉 Email -->
            <VTextField
              variant="outlined"
              v-model="email"
              label="Email"
              type="email"
              placeholder="johndoe@email.com"
            />
          </VCol>

          <VCol cols="12">
            <!-- 👉 Password -->
            <VTextField
              variant="outlined"
              v-model="password"
              label="Password"
              autocomplete="on"
              type="password"
              persistent-hint
              placeholder="············"
              hint="Your password must be 8-20 characters long."
            />
          </VCol>

          <VCol
            cols="12"
            class="d-flex gap-4 justify-center"
          >
            <!-- 👉 submit and reset button -->
            <VBtn type="submit" class="me-3">
              Submit
            </VBtn>

            <VBtn
              color="secondary"
              type="reset"
              variant="tonal"
            >
              Reset
            </VBtn>
          </VCol>
        </VRow>
      </VForm>
    </VCardText>
  </VCard>
</template>
