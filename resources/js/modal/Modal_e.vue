<!-- <template>
  <div v-if="active_att" class="modal-overlay">
    <div class="modal-content">
      <button @click="closeModal">Close</button>
      <h2></h2>
      <input v-model="inputValue" />
      <slot></slot>
    </div>
  </div>
</template> -->

<template>
  <div v-if="active_att" class="modal-overlay">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Atribuição <div style="color:gray" class="text-left">{{ title }}</div>
          </h5>
        </div>
        <!-- <h2>{{ title }}<div class="text-bg-secondary">{{ initialInputValue2 }}</div>
        </h2> -->
        <div class="modal-body">
          <br>
          <!-- <input v-model="inputValue" /> -->
          <!-- <label for="modalInput" class="form-label">Medical</label>
          
          <label for="modalInput" class="form-label"></label> -->
          <slot name="bodyAtt1"></slot>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" title="Selecione para atribuir" @click="confirm">Editar</button>
          <button type="button" class="btn btn-light ml-2" @click="closeModal">Close</button>
        </div>

      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ModalEditar',
  props: ['active_att', 'title', 'initialInputValue'],
  data() {
    return {
      inputValue: this.initialInputValue
    };
  },
  methods: {
    closeModal() {
      this.$emit('close');
    },
    confirm(){
      this.$emit('confirm', {
        selectedOption: this.selectedOption, hiddenValue: this.hiddenValue 
      });
      // Mostrar uma mensagem de sucesso
      // Fechar o modal
      this.$emit('close');
    }
  }
};
</script>

<style scoped>
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
}

.modal-content {
  background: white;
  padding: 20px;
  border-radius: 5px;
}
</style>
