<script setup>
import { router } from '@inertiajs/vue3';
import Menu from '../Navigation/Menu.vue';

const logout = () => {
  router.visit('/logout')
}
</script>
<template>
    <v-app id="default">
  
      <Menu />
  
      <v-main>
        <v-container
          class="py-8 px-6"
          fluid
        >
          <v-row>
            <v-col
              cols="12"
            >
              <VCard class="mb-5">
                <template #append>
                  <VBtn
                    prepend-icon="mdi-logout"
                    @click="logout"
                  >
                    Logout
                  </VBtn>
                </template>
              </VCard>
              <v-card>
                <slot></slot>
              </v-card>
            </v-col>
          </v-row>
        </v-container>
      </v-main>
    </v-app>
</template>
