<script>
import IconArcade from "../../../layouts/transfer/Step/icons/IconArcade.vue"
import IconAdvanced from "../../../layouts/transfer/Step/icons/IconAdvanced.vue";
import IconPro from "../../../layouts/transfer/Step/icons/IconPro.vue";
import { useStepOneStore } from "../../../composables/mainStore";

export default {
  data() {
    return {
      validationErrors: null, // ou algum valor inicial
    };
  },
  setup() {
    const stepOneStore = useStepOneStore();

    // Acessar os valores
    const valorDoPrimeiroPasso = stepOneStore.valor;
    const emailDoPrimeiroPasso = stepOneStore.email;
    

    return {
      valorDoPrimeiroPasso,
      emailDoPrimeiroPasso
    }
  }
}
</script>

<template>
  <div class="main">
    <h3 class="text-center" v-text="'Verify the user and value and move to the next step'"></h3>
    <div class="selects">

    </div>
    <br>
    <div class="list-group col-sm-4 offset-4 text-center">
      Valor: R$ <a href="#" class="items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-ls text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none  focus:shadow-outline-gray transition ease-in-out duration-150 ml-4">{{ valorDoPrimeiroPasso }}</a>

      Email: <a href="#" class="lnline-flex items-center px-4 py-2 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150 ml-4">{{ emailDoPrimeiroPasso
        }}</a>
    </div>

            
    <br>
  </div>
</template>

<style lang="scss" scoped></style>
