
import { ref, inject } from 'vue'
import { useRouter } from 'vue-router'

export default function useAnimalsUser() {
    const animalsUsers = ref({})
    const animalUser = ref({
        id: '',
        name: '',
        breed: '',
        type_animals_id: '',
        age: '',
        weight: '',
        user_id: '',
        created_at: '',
    })
    const router = useRouter()
    const validationErrors = ref({})
    const isLoading = ref(false)
    const swal = inject('$swal')


    const getAnimalsUser = async () => {
        const logusergIn = JSON.parse(localStorage.getItem('user'));
        try {
            let response = await axios.get(`/api/animaluser/${logusergIn.id_int}`);
            animalsUsers.value = response.data;
        } catch (error) {
            console.error('An error occurred while fetching Medical:', error);
            // Aqui você pode adicionar lógica para tratar o erro, por exemplo, mostrar uma mensagem ao usuário
        }
    }

    return {
        animalsUsers,
        getAnimalsUser,
       
    }
}
