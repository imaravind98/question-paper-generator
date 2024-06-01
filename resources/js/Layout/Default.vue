<script setup>
import { ref } from 'vue'

const links = [
  ['mdi-inbox-arrow-down', 'Inbox'],
  ['mdi-send', 'Send'],
  ['mdi-delete', 'Trash'],
  ['mdi-alert-octagon', 'Spam'],
]

const drawer = ref(null)
</script>
<template>
    <v-app id="inspire">
      <v-system-bar>
        <v-spacer></v-spacer>
  
        <v-icon>mdi-square</v-icon>
  
        <v-icon>mdi-circle</v-icon>
  
        <v-icon>mdi-triangle</v-icon>
      </v-system-bar>
  
      <v-navigation-drawer v-model="drawer">
        <v-sheet
          class="pa-4"
          color="grey-lighten-4"
        >
          <v-avatar
            class="mb-4"
            color="grey-darken-1"
            size="64"
          ></v-avatar>
  
          <div>john@google.com</div>
        </v-sheet>
  
        <v-divider></v-divider>
  
        <v-list>
          <v-list-item
            v-for="[icon, text] in links"
            :key="icon"
            :prepend-icon="icon"
            :title="text"
            link
          ></v-list-item>
        </v-list>
      </v-navigation-drawer>
  
      <v-main>
        <v-container
          class="py-8 px-6"
          fluid
        >
          <v-row>
            <v-col
              cols="12"
            >
              <v-card>
                <slot></slot>
              </v-card>
            </v-col>
          </v-row>
        </v-container>
      </v-main>
    </v-app>
</template>
