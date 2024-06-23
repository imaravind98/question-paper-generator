import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'
import { mdi } from 'vuetify/iconsets/mdi';
import { aliases, fa } from 'vuetify/iconsets/fa'
import '@mdi/font/css/materialdesignicons.css'
import 'vuetify/styles'
import { customTheme } from './theme';

export const vuetify = createVuetify({
    components,
    directives,
    ssr: true,
    theme: {
      defaultTheme: 'customTheme',
      themes: {
        customTheme,
      },
    },
    icons: {
      defaultSet: 'mdi',
      aliases,
      sets: {
        fa,
        mdi,
      },
    },
})