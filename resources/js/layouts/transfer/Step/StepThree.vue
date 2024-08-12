<script>

import { useStepOneStore } from "../../../composables/mainStore";
import { watch, computed, onMounted, ref } from 'vue';
import { useRouter } from 'vue-router';
import LoginFragment from '../../../components/LoginFragment.vue';
import useConfirmation from '../../../composables/auth'
import Swal from 'sweetalert2';


export default {
  // const store = useStepOneStore();
  props: {
    suggestions: {
      type: Array,
      required: true,
    },

  },
  component: {
    LoginFragment
  },
  data() {
    return {
      validationErrors: null, // ou algum valor inicial
    };
  },
  setup() {
    const { user, processing, logusergIn_, SendItemLogin, submitLogin } = useConfirmation()
    const stepOneStore = useStepOneStore();
    const validationErrors = ref({});
    const validation = ref({})
    const proccess_ = ref(true);
    const elements = ref([]);
    const container = ref(null);
    let combinedData = {};

    const SendLogin = async () => {
      if (processing.value) return;

      processing.value = true;
      validationErrors.value = {};

      axios
        .post("/verification/login/", SendItemLogin)
        .then(async (response) => {
          validation.value = response.data;
          ConfirmationSend(validation, SendItemLogin);
        })
        .catch((response) => {
          validation.value = response.data;
          ConfirmationSend(validation, SendItemLogin);
        })
        .finally(() => (processing.value = false));
    };

    const ConfirmationSend = async (item, SendItemLogin) => {
      let send_status = JSON.stringify(item.value.status, null, 2);
      if (send_status) {
        createElement();
        console.log(send_status);
        transferir_action(SendItemLogin);
        proccess_.value = false
      } else {
        createElement();
        console.log(send_status);
        proccess_.value = false
      }
    };

    const createElement = async () => {
      if (container.value) {
        const transferringElement = `<div class="transferring-message">
      <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
      <p class="mt-2">Transferindo...</p>
      </div>
    `;
        container.value.insertAdjacentHTML('beforeend', transferringElement);
      }
    };

    const createElementReturn = async (status, message) => {
      if (container.value) {
        // Check if the transferring element already exists
        const existingElement = container.value.querySelector('.transferring-message');

        if (existingElement) {
          // Remove the existing element
          existingElement.remove();
        }

          const transferringElement = `
      <div class="transferring-message">
        
        <p class="mt-2">${message}</p>
      </div>
    `;
       
        container.value.insertAdjacentHTML('beforeend', transferringElement);
      }
    };

    // console.log(JSON.parse(sessionStorage.getItem('user')));

    const transferir_action = async (SendItemLogin) => {
      // if (processing.value) return;

      // processing.value = true;
      // validationErrors.value = {};

      const userJson = sessionStorage.getItem("user");
      let combinedData = {};
      if (userJson) {
        const user = JSON.parse(userJson);
        combinedData = {
          ...user,             // Dados do localStorage
          ...stepOneStore,
        };
        axios.post("/api/transfer/valor", combinedData)
          .then(response => {
            console.log("Resposta do servidor:", response.data);
            createElementReturn(response.data.status, response.data.message)
          })
          .catch(error => {
            console.error("Erro na requisição:", error);
            Swal.fire({
              title: 'Aviso',
              text: response.data.message,
              icon: 'error',
            });
          });
      } else {
        console.log("O usuário não está armazenado no localStorage.");
      }


    }

    // return { SendLogin, Chamar };
    // console.log(transferir);

    return {
      SendLogin,
      processing,
      SendItemLogin,
      validation,
      submitLogin,
      ConfirmationSend,
      proccess_,
      container,
      createElement,
      transferir_action,
      logusergIn_,
      user,
      stepOneStore,
      createElementReturn
    }
  }
}
</script>

<template>
  <div class="main col-sm-4 offset-4">
    <h3 v-if="proccess_" v-text="'Digite sua senha'" class="text-center"></h3>
    <form v-if="proccess_" @submit.prevent="SendLogin">
      <div class="form-floating">
        <input type="email" class="form-control" v-model="SendItemLogin.email" id="email" placeholder="name@example.com"
          required autofocus autocomplete="username">
        <label for="email">Email address</label>
        <!-- Validation Errors -->
        <div class="text-red-600 mt-1 font-6">
          <div v-for="message in validationErrors?.email">
            {{ message }}
          </div>
        </div>
      </div>
      <div class="form-floating">
        <input type="password" class="form-control" v-model="SendItemLogin.password" id="password"
          placeholder="Password" required>
        <label for="password">Password</label>
        <!-- Validation Errors -->
        <div class="text-red-600 mt-1 text-wrap">
          <div v-for="message in validationErrors?.password">
            {{ message }}
          </div>
        </div>
      </div>


      <div class="flex items-center justify-end mt-4">
        <button
          class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150 ml-4"
          :class="{ 'opacity-25': processing }" :disabled="processing">
          Send

        </button>
      </div>
    </form>
    <div ref="container"></div>


  </div>
</template>

<style>
.transferring-message {
  padding: 10px;
  background-color: #f0f0f0;
  border: 1px solid #ccc;
  border-radius: 5px;
  color: #333;
  font-size: 16px;
  text-align: center;
  margin: 10px 0;
}
</style>
