<template>
    <div>
      <h1>Lista de Usuários</h1>
      <ul>
        <li v-for="usuario in usuarios" :key="usuario.usuario_id">
          {{ usuario.nome }} - {{ usuario.telefone }}
        </li>
      </ul>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        usuarios: []
      };
    },
    created() {
      this.fetchUsuarios();
    },
    methods: {
      async fetchUsuarios() {
        try {
          const response = await axios.get('/api/usuarios');
          this.usuarios = response.data.data;
        } catch (error) {
          console.error('Erro ao buscar usuários:', error);
        }
      }
    }
  };
  </script>
  