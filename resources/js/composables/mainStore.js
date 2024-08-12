import { defineStore } from 'pinia';
import { computed, ref } from 'vue';

export const useMainStore = defineStore('mainStore', () => {
  const currentStep = ref(1);

  const nextStep = () => {
    if (currentStep.value == 4) return;
    currentStep.value++;
  };
  const prevStep = () => {
    currentStep.value--;
  };

  return {
    nextStep,
    currentStep,
    prevStep,
  };
});

export const useStepOneStore = defineStore('stepOneStore', () => {
  const valor = ref('');
  const email = ref('');

  const isValorValid  = computed(() => {
    return !!(valor.value && email.value);
  });

  const isEmailValid = computed(() => {
    // Adicione aqui sua lógica para validar 'email'
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailPattern.test(email.value); // Verifica se o email tem um formato válido
  });

  const validate = computed(() => {
    return isValorValid.value && isEmailValid.value;
  });

  return {
    valor,
    email,
    isValorValid,
    isEmailValid,
    validate,
  };
  
});
