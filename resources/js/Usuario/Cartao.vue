<script setup>

    import { useForm } from '@inertiajs/vue3';
    import {router} from '@inertiajs/vue3';
    import Swal from '../plugins/sweetalert2';
    import axios from 'axios';

    // defineProps({
    //     cartoes: Object
    // });



</script>

<template>
    <div>
      <h1>Lista de Cartões</h1>
      <ul>
        <li v-for="cartao in cartoes" :key="cartao.cartao_id">
          {{ cartao.produto }} - {{ cartao.cartao_id }}
        </li>
      </ul>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        cartoes: []
      };
    },
    created() {
      this.fetchUsuarios();
    },
    methods: {
      async fetchUsuarios() {
        try {
          const response = await axios.get('/cartao/listar');
          this.cartoes = response.data.data;
        } catch (error) {
          console.error('Erro ao buscar usuários:', error);
        }
      }
    }
  };
  </script>