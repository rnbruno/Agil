
import { ref, inject } from 'vue'
import { useRouter } from 'vue-router'

export default function useTypeAnimal() {
    const typesAnimals = ref({})
    const typesAnimal = ref({
        id: '',
        typeAnimal: '',
        created: ''
    })
    const router = useRouter()
    const validationErrors = ref({})
    const isLoading = ref(false)
    const swal = inject('$swal')

    const getTypeAnimals = async () => {
        try {
            let response = await axios.get('/api/medical');
            medicals.value = response.data;
        } catch (error) {
            console.error('An error occurred while fetching Medical:', error);
            // Aqui você pode adicionar lógica para tratar o erro, por exemplo, mostrar uma mensagem ao usuário
        }
    }

    return {
        typesAnimals,
        getMedicals,
       
    }
}
