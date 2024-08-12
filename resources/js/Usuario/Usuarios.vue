<script setup>

    import { useForm } from '@inertiajs/vue3';
    import {router} from '@inertiajs/vue3';
    import Swal from '../plugins/sweetalert2';
    import axios from 'axios';

    defineProps({
        usuarios: Object
    });



</script>
<style scoped>
/* Seus estilos aqui */
</style>
<template>
    <h2>Teste..</h2>
    <div class="card col-10 offset-1">
         <div class="card-body">
            <h3>Usu&aacute;rios Operadores do Sistema</h3>
      <div class="table-responsive small">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">C&oacute;d.</th>
              <th scope="col">Nome</th>
              <th scope="col">Email</th>
              <th scope="col">Telefone</th>
              <th scope="col">Header</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(usuario,index) in usuarios" :key="index">
              <td><div class="badge text-bg-secondary">{{index+1}}</div></td>
              <td>{{usuario.pessoa_id}}</td>
              <td>{{ usuario.nome }}</td>
              <td>{{ usuario.usuario }}</td>
              <td>{{ usuario.telefone }}</td>
              <td><button type="button" class="btn btn-warning m-1" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">Editar</button>
                <button type="button" class="btn btn-danger" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" @click="sendAjaxRequest(usuario.pessoa_id,usuario.pessoa_inativo)" v-if="usuario.pessoa_inativo == 0">Desativar</button>
                <button type="button" class="btn btn-success" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"  @click="sendAjaxRequest(usuario.pessoa_id,usuario.pessoa_inativo)"  v-else>Ativar</button>
              </td>
            </tr>
                
           
            
            
          </tbody>
        </table>
      </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Usuarios',
    data() {
    return {
      message: ''
    };
  },
  methods: {
    sendAjaxRequest(pessoa_id,inativo) {
      axios.post('/ajax-request-usuario', {
        pessoa_id: pessoa_id,
        inativo: inativo
      })
      .then(response => {
        this.message = response.data.message;

        Swal.fire({
          position: "top-end",
          icon: "success",
          title: this.message,
          showConfirmButton: false,
          timer: 1500
        });
      })
      .catch(error => {
        console.error('Erro ao processar a requisi��o AJAX:', error);
      });
    }
  }
};

</script>
