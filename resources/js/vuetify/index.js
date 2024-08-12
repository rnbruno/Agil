// plugins/vuetify.js
import { createVuetify } from 'vuetify'
import 'vuetify/styles' // Importa os estilos do Vuetify
import { aliases, mdi } from 'vuetify/iconsets/mdi'

import '@mdi/font/css/materialdesignicons.css'

// Vuetify components and directives
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

export default createVuetify({
  icons: {
    defaultSet: 'mdi', // Define o conjunto de ícones padrão
    aliases,
    sets: {
      mdi,
    },
  }, 
  components,
  directives,
})
