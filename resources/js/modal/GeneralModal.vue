<!-- Modal.vue -->
<template>
  <div v-if="active_" class="modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">{{button_[0]}}</h5>
          <button type="button" class="btn-close" @click="closeModal"></button>
        </div>
        <div class="modal-body">
          <label for="modalInput" class="form-label">{{input_[0]}}</label>
          <input type="text" class="form-control" id="acount" required>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" @click="confirm">{{button_[0]}}</button>
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
    type: String,
    button_: Array,
    input_: Array,
  },
  active_: {
      type: Boolean,
      required: false,
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
