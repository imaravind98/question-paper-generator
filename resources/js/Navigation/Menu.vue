<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { ref, computed } from 'vue'

const page = usePage()

const links = [
  ['mdi-school-outline', 'Classes', '/classes'],
  ['mdi-bookshelf', 'Subjects',  '/subjects'],
  ['mdi-book-open-variant-outline', 'Chapters', '/chapters'],
  ['mdi-head-question-outline', 'Questions', '/questions'],
  ['mdi-account-outline', 'Users', '/users'],
]

const drawer = ref(null)

const user = computed(() => page.props.auth.user)
</script>
<template>
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
  
          <div>{{ user.name }}</div>
        </v-sheet>
  
        <v-divider></v-divider>
  
        <VList>
            <Link :href="url" v-for="([icon, text, url], index) in links" :key="index" style="color: unset;text-decoration: none;">
                <v-list-item
                    :active="$page.url.startsWith(url)"
                    :prepend-icon="icon"
                    :title="text"
                />
            </Link>
        </VList>
      </v-navigation-drawer>
</template>