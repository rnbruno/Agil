import { ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'
import CryptoJS from 'crypto-js';


 
export default function useContas() {
    const contas = ref([])
 
    const errors = ref('')
    const router = useRouter()
 
    const getContas = async () => {
        try {
            let response = await axios.get('/api/contas');
            contas.value = response.data;
        } catch (error) {
            console.error('An error occurred while fetching contas:', error);
            // Aqui você pode adicionar lógica para tratar o erro, por exemplo, mostrar uma mensagem ao usuário
        }
    }
 
    const storeContas = async (data) => {
        errors.value = ''
        try {
            await axios.post('/api/contas', data)
            await router.push({ name: 'copntas.index' })
        } catch (e) {
            if (e.response.status === 422) {
                for (const key in e.response.data.errors) {
                    errors.value = e.response.data.errors
                }
            }
        }
 
    }
 
    const updateContas = async (id, status) => {
        errors.value = ''
        // hash = CryptoJS.MD5(id).toString(CryptoJS.enc.Hex)
        try {
            await axios.patch(`/api/contas/${id}`, { conta_id: id, inativo: status })
            // await router.push({ name: 'companies.index' })
        } catch (e) {
            if (error.response && error.response.data && error.response.data.message) {
                Swal.fire({
                    title: 'Error',
                    text: error.response.data.message,
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            } else {
                Swal.fire({
                    title: 'Error',
                    text: 'Unknown error occurred while updating the item.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        }
    }
 
    return {
        errors,
        contas,
        getContas,
        storeContas,
        updateContas
    }
}