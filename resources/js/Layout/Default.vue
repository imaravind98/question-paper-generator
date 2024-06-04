<script setup>
import Menu from '../Navigation/Menu.vue';
import { Link } from '@inertiajs/vue3';
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
                  <Link href="logout">Logout</Link>
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
