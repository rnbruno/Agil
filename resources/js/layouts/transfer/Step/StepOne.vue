<script>
// import { ref, computed } from "vue";

import { useStepOneStore } from "../../../composables/mainStore";
import { watch, computed, onMounted, ref } from 'vue';
import Swal from 'sweetalert2';
import useUsers from "../../../composables/users";

export default {
  // const store = useStepOneStore();
  props: {
    suggestions: {
      type: Array,
      required: true,
    },

  },
  data() {
    return {
      validationErrors: null, // ou algum valor inicial
    };
  },
  setup() {
    const { usersEmails, getUserEmail } = useUsers();
    const valor = ref('');
    const email = ref('');
    const modalOptions = ref([]);
    const searchQuery = ref('');
    const showSuggestions = ref(false);
    const selectedOptionPrimeiroEmail = ref(null);
    const stepOneStore = useStepOneStore();
    const selectedItem = ref(''); // Armazena o item selecionado
    const showInput = ref(true);

    const submit = () => {
      console.log('aaa');
    };

    const marcacoesNote = () => {
      // Assumindo que medicals é uma lista de objetos com id e name
      item_user.value = usersEmails.value.map(notes => ({
        text: `${notes.notes}`,
      }));
    };

    const filteredSuggestions = computed(() => {
      if (searchQuery.value === '') {
        return [];
      }

      return usersEmails.value
        .filter(item =>
          item.email.toLowerCase().includes(searchQuery.value.toLowerCase())
        )
        .map(item => item.email); // Apenas retorna o texto
    });

    const filterSuggestions = () => {
      showSuggestions.value = true;
    };

    const hideSuggestions = () => {
      setTimeout(() => {
        showSuggestions.value = false;
      }, 100);
    };

    const selectSuggestion = (suggestion) => {
      searchQuery.value = suggestion;
      selectedItem.value = suggestion.toUpperCase(); //
      showSuggestions.value = false;
      showInput.value = false;
      stepOneStore.email = suggestion; 
    };

    watch(
      () => [valor, email],
      (val) => {
        console.log(val);
      }
    );
    onMounted(async () => {
      await getUserEmail();

    });

    const form = ref({
      email: '',
    });

    const errors = ref({});

    const validateForm = () => {
      errors.value = {};
      if (!form.value.note) errors.value.note = 'A note é obrigatória';

      // return Object.keys(errors.value).length === 0;
    };

    return {
      modalOptions,
      selectedOptionPrimeiroEmail,
      showSuggestions,
      filterSuggestions,
      hideSuggestions,
      selectSuggestion,
      filteredSuggestions,
      searchQuery,
      form,
      stepOneStore,
      selectedItem,
      showInput,
      valor
    }
  },
  methods: {
    formatValor() {
      // Remove todos os caracteres que não são números ou pontos
      let formattedValue = this.valor.replace(/[^0-9.]/g, '');

      // Limita o número de casas decimais a 2
      if (formattedValue.includes('.')) {
        const parts = formattedValue.split('.');
        formattedValue = `${parts[0]}.${parts[1].substring(0, 2)}`;
      }

      this.valor = formattedValue.toUpperCase(); 
    },
    clearSelection(){
      this.showInput = true;
      this.selectedItem = '';
    }
  }

}
</script>

<template>
  <div class="main">
    <div class="form">
      <h3 class="title" v-text="'Send money'" />
      <p class="subtitle" v-text="'Please provide your valor e email address.'" />
      <form class="form" @submit.prevent="submit">
        <div class="row">
          <div class="col-sm-4 offset-4">
            <label style="font-size:12px !important" class="label" for="name">
              <h3 class="label">Valor</h3>
            </label>
          </div>
          <div class="col-sm-4 offset-4">
            <input type="int" name="valor" id="valor" @input="formatValor" v-model="stepOneStore.valor"
              placeholder="ex. 15.00" />
          </div>
          <div class="col-sm-4 offset-4">
            <label class="label" for="email">
              <h3 class="label">Email Address</h3>
            </label>
          </div>

          <div class="col-sm-5 offset-4">
            <input v-if="showInput" type="email" name="email" id="email" v-model="searchQuery"
              @input="filterSuggestions" @focus="showSuggestions = true" @blur="hideSuggestions"
              placeholder="e.g. stephenking@lorem.com" />
            <ul v-if="showSuggestions" class="col-sm-4 suggest suggestions-list">
              <li v-for="(suggestion, index) in filteredSuggestions" :key="index"
                @mousedown.prevent="selectSuggestion(suggestion)" class="suggestion-item">
                {{ suggestion }}
              </li>
            </ul>
            <div v-if="selectedItem" id="selected-item" class="selected-item-container">

              <div class="btn-group btn-sm" role="group" aria-label="Basic example">

              <button class="btn btn-primary" :data-selected-item="selectedItem"
              :data-email="stepOneStore.email" >
                {{ selectedItem }}
              </button>
              <button class="btn btn-danger" @click="clearSelection">
                X
              </button>
            </div>
          </div>

        </div>
    </div>
    </form>
  </div>
  </div>
</template>

<style lang="scss" scoped>
.title {
  font-weight: bold;
  margin-bottom: 16px;
  color: #485534;
}

.subtitle {
  color: #045111;
  margin-bottom: 20px;
  line-height: 1.4;
}

.form {
  display: flex;
  flex-direction: column;

  .label {
    font-size: 12px;
    color: mediumaquamarine;
    margin-bottom: 3px;
  }

  input {
    margin-bottom: 15px;
    padding: 10px;
    border: 1px solid gray;
    border-radius: 3px;
  }
}

.suggest {
  width: 15%;
  /* Ajuste o tamanho conforme necessário */
  margin: 0 auto;
  /* Centraliza o elemento na tela */
  background-color: #f8f9fa;
  /* Cor de fundo opcional */
  padding: 10px;
  /* Espaçamento interno opcional */
  border-radius: 5px;
  /* Bordas arredondadas opcionais */
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  /* Sombra opcional */
}

.suggest-item {
  padding: 5px 10px;
  /* Espaçamento interno dos itens */
  border-bottom: 1px solid #ddd;
  /* Linha separadora entre os itens */
}

.suggest-item:last-child {
  border-bottom: none;
  /* Remove a linha separadora do último item */
}

.suggest-item:hover {
  background-color: #e9ecef;
  /* Cor de fundo ao passar o mouse */
}
</style>
