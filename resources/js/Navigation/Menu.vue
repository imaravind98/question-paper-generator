<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { ref, computed } from 'vue'

const page = usePage()

const links = [
  ['mdi-account-outline', 'Users', '/users', 'admin'],
  ['mdi-school-outline', 'Classes', '/classes', 'teacher'],
  ['mdi-bookshelf', 'Subjects',  '/subjects', 'teacher'],
  ['mdi-book-open-variant-outline', 'Chapters', '/chapters', 'teacher'],
  ['mdi-head-question-outline', 'Questions', '/questions', 'teacher'],
  ['mdi-export', 'Export', '/', 'teacher'],
]

const drawer = ref(null)

const user = computed(() => page.props.auth.user)
</script>
<template>
    <v-navigation-drawer v-model="drawer" color="orange-lighten-5">
        <v-sheet
          class="pa-4 d-flex flex-column w-100 align-center"
          color="orange-lighten-3"
        >
          <v-avatar
            class="mb-4"
            color="grey-darken-1"
            size="64"
            :image="user.image"
          ></v-avatar>
  
          <p class="text-h6">{{ user.name }}</p>
          <p>{{ user.group }}</p>
        </v-sheet>
  
        <v-divider></v-divider>
  
        <VList>
            <Link :href="url" v-for="([icon, text, url, group], index) in links" :key="index" style="color: unset;text-decoration: none;">
                <v-list-item
                    v-if="group === 'admin' ? user.group === 'admin' : true" 
                    :active="$page.url.startsWith(url)"
                    :prepend-icon="icon"
                    :title="text"
                />
            </Link>
        </VList>
      </v-navigation-drawer>
</template>