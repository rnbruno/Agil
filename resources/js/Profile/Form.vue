<script setup>

    import { useForm } from '@inertiajs/vue3';
    import {router} from '@inertiajs/vue3';
    import Swal from '../../plugins/sweetalert2';

    defineProps({
        errors: Object
    });

    const form=useForm({
        name:null,
        email:null,
        phone:null,
    });

    function submit(){
        router.post('/customers',form)
      
    }
</script>
<style scoped>
/* Seus estilos aqui */
</style>
<template>
    <h2>Teste..</h2>
    <div class="card col-6 offset-3">
        <div class="card-header">
            Featured
        </div>
        <div class="card-body">
            <form @submit.prevent="submit" class="">

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="name" v-model="form.name" class="form-control" id="name">
                    <div class="text-danger text-xs" v-if="errors.name">{{ errors.name }}</div>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" v-model="form.email" class="form-control" id="email">
                    <div class="text-danger text-xs" v-if="errors.email">{{ errors.email }}</div>                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="number" v-model="form.phone" class="form-control" id="phone">
                    <div class="text-danger text-xs" v-if="errors.phone">{{ errors.phone }}</div>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" v-model="form.check" class="form-check-input" id="check">
                    <label class="form-check-label" for="check">Check me out</label>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Form'
}
</script>
