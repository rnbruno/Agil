<!-- Modal.vue -->
<template>
  <div v-if="active_" class="modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">{{ title }}</h5>
          <button type="button" class="btn-close" @click="closeModal"></button>
        </div>
        <div class="modal-body">
          <slot name="body1"></slot>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" @click="confirm">Confirm edit</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    title: String,
    active_: Boolean,
    nameItem: String,
  },
  active_: {
      type: Boolean,
      required: true,
  },
  methods: {
    closeModal() {
      console.log('Closing modal');
      this.$emit('update:active_', false);
    },
    confirm() {
        console.log('Confirm button clicked');
        this.$emit('confirm');
        // Mostrar uma mensagem de sucesso
        // Fechar o modal
        this.$emit('update:active_', false);

    },
    
  },
  created() {
    console.log('Modal created with title:', this.title);
    console.log('Modal active_ status:', this.active_);
  },
  watch: {
    active_(newVal) {
      console.log('Modal active_ status changed:', newVal);
    },
    title(newVal) {
      console.log('Modal title changed:', newVal);
    },
  },
};
</script>

<style scoped>
.modal {
  /* Estilos para o modal */
}
</style>
