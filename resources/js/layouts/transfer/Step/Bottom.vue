<script setup>
import { useMainStore } from '../../../composables/mainStore';

const store = useMainStore();
</script>

<template>
  <!-- <div class="row">
    <button
      class="back-btn btn btn-secondary"
      @click="store.prevStep"
      v-if="store.currentStep > 1"
    >
      Go Back
    </button>
    <button
      class="next-btn btn btn-secondary"
      @click="store.nextStep"
      v-if="store.currentStep < 4"
    >
      Next Step
    </button>
  </div> -->
  <div class="row">
    <div class="d-flex justify-content-between w-100">
      <button class="back-btn btn btn-secondary" @click="store.prevStep" v-if="store.currentStep > 1">
        Go Back
      </button>
      <h2 class="badge bg-secondary ">{{ store.currentStep }}</h2 >
      <button class="next-btn btn btn-secondary" @click="store.nextStep" v-if="store.currentStep < 3">
        Next Step
      </button>
    </div>
  </div>
</template>

<style lang="scss" scoped>
.bottom-section {
  position: fixed;
  bottom: 0;
  background-color: #fff;
  padding: 15px;
  width: 100%;
  display: flex;
  justify-content: space-between;

  button {
    padding: 10px 15px;
    border-radius: 5px;
  }

  .next-btn {
    background-color: #fff;
    color: white;
    border: none;
    margin-left: auto;
  }

  .back-btn {
    background-color: #fff;
    border: none;
    color: #000;
    margin-right: auto;
  }
  .vertical-text {
    writing-mode: vertical-rl; /* Texto vertical da direita para a esquerda */
    transform: rotate(180deg); /* Gira o texto para ficar de cabeça para cima */
    text-align: center; /* Centraliza o texto dentro do elemento */
  }
}
</style>
