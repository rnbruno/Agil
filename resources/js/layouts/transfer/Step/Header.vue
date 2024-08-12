<script >
  import { useMainStore } from '../../../composables/mainStore';
  export default {
    data() {
      return {
        send: '/img/send.jpg', // Caminho relativo a partir da pasta public
        showDropdown: false
      }
    },
    setup () {
      const store = useMainStore();
      return {
        store,
      }
    }
  }

</script>

<template>
  <header class="main-header">
    <div class="image">
      <img :src="send"  style="width:65px" alt="Send" />
    </div>
    <div class="steps">
      <div class="step" :class="{ active: store.currentStep === step }" v-for="step in 3" :key="step">
        {{ step }}
      </div>
    </div>
  </header>
</template>

<style lang="scss" scoped>
.main-header {
  position: relative;

  .image {
    position: relative;
    z-index: 1;

    img {
      width: 100%;
    }
  }

  .steps {
    display: flex;
    position: absolute;
    top: 40px;
    left: 50%;
    transform: translateX(-50%);

    >*:not(:last-child) {
      margin-right: 12px;
    }

    .step {
      width: 30px;
      height: 30px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 999px;
      border: 1px solid #fff;
      color: white;
      font-size: 14px;
    }

    .active {
      color: black;
      background-color: #000;
    }
  }
}
</style>
