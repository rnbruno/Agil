
import { ref, inject } from 'vue'
import { useRouter } from 'vue-router'

export default function useHorariosDisponiveis() {
    const horariosDisponiveis = ref({})
    const horariosDisponivel = ref({
        id: '',
        data: '',
        horario_inicial: '',
        horario_final: '',
        disponivel: 0,
    })
    const router = useRouter()
    const validationErrors = ref({})
    const isLoading = ref(false)
    const swal = inject('$swal')

    const getHorariosDisponiveis = async () => {
        try {
            let response = await axios.get('/api/horarios_disponiveis');
            console.log(response.data)
            horariosDisponiveis.value = response.data;
        } catch (error) {
            console.error('An error occurred while fetching Horarios Dispoíveis:', error);
            // Aqui você pode adicionar lógica para tratar o erro, por exemplo, mostrar uma mensagem ao usuário
        }
    }

    return {
        horariosDisponiveis,
        getHorariosDisponiveis,
       
    }
}
