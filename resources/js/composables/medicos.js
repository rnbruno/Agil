
import { ref, inject } from 'vue'
import { useRouter } from 'vue-router'

export default function useMedicos() {
    const medicals = ref({})
    const medical = ref({
        id: '',
        name: '',
        specialty: '',
        phone: '',
        email: '',
        created: ''
    })
    const router = useRouter()
    const validationErrors = ref({})
    const isLoading = ref(false)
    const swal = inject('$swal')

    const getMedicals = async () => {
        try {
            let response = await axios.get('/api/medical');
            medicals.value = response.data;
        } catch (error) {
            console.error('An error occurred while fetching Medical:', error);
            // Aqui você pode adicionar lógica para tratar o erro, por exemplo, mostrar uma mensagem ao usuário
        }
    }

    return {
        medicals,
        getMedicals,
       
    }
}
