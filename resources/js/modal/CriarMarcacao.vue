<template>
  <div v-if="isVisible" class="modal-overlay">
    <div class="modal-content">
      <button @click="closeModal">Close</button>
      <h2>{{ title }}</h2>
      <input v-model="inputValue" />
      <slot></slot>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ModalAtribuir',
  props: ['isVisible', 'title', 'initialInputValue'],
  data() {
    return {
      inputValue: this.initialInputValue
    };
  },
  methods: {
    closeModal() {
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
