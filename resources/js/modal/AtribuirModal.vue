<template>
  <div v-if="isVisible" class="modal-overlay">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Atribuição <div style="color:gray" class="text-left">{{ title }}</div>
          </h5>
        </div>
        <!-- <h2>{{ title }}<div class="text-bg-secondary">{{ initialInputValue2 }}</div>
        </h2> -->
        <div class="modal-body">
          <br>
          <label for="modalInput" class="form-label">Medical</label>
          <select class="form-control" v-model="selectedOption">
            <option v-for="option in options" :key="option.value" :value="option.value">
              {{ option.text }}
            </option>
          </select>
          <label for="modalInput" class="form-label"></label>
          <slot name="bodyAtt"></slot>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" title="Selecione para atribuir" @click="confirm">Confirmar</button>
          <button type="button" class="btn btn-light ml-2" @click="closeModal">Close</button>
        </div>

      </div>
    </div>
  </div>
</template>

<script>

export default {
  name: 'ModalAtribuir',
  props: ['isVisible', 'title', 'initialInputValue', 'initialInputValue2', 'initialInputValue3','options', 'initialOption','hiddenValue'],
  data() {
    return {
      inputValue: this.initialInputValue,
      selectedOption: this.initialOption,
      hiddenValue: this.hiddenValue
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
