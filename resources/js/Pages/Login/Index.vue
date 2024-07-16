<script lang="ts" setup>
import { defineOptions } from 'vue'
import Login from '../../Layout/Login.vue'
import { useForm } from '@inertiajs/vue3'

const form = useForm({
  email: null,
  password: null,
  remember: false,
})


defineOptions({ layout: Login })

const submit = async () => {
  form.post('/login')
  console.log(form)

}
</script>

<template>
  <VCard class="text-center" color="purple-darken-4" variant="tonal">
    <template #title>
      <v-avatar
        color="grey"
        rounded="0"
        size="150"
      >
        <v-img src="/assets/logo.png" cover></v-img>
      </v-avatar>
      <h1 class="text-h6">Shashwat Public School</h1>
    </template>
    <VCardText>
      <VForm @submit.prevent="() => { submit() }">
        <VRow>
          <VCol cols="12" class="text-left">
            <!-- 👉 Email -->
            <VTextField
              variant="outlined"
              v-model="form.email"
              label="Email"
              type="email"
              placeholder="johndoe@email.com"
              :error-messages="form.errors?.email ? [form.errors.email] : []"
            />
          </VCol>

          <VCol cols="12" class="text-left">
            <!-- 👉 Password -->
            <VTextField
              variant="outlined"
              v-model="form.password"
              label="Password"
              autocomplete="on"
              type="password"
              persistent-hint
              placeholder="············"
              :error-messages="form.errors?.password ? [form.errors.password] : []"
            />
            <p style="color: red;">{{ form.errors?.password }}</p>
          </VCol>

          <VCol
            cols="12"
            class="d-flex gap-4 justify-center align-center"
          >
            <!-- 👉 submit and reset button -->
            <VBtn type="submit" class="me-3" color="primary">
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
