
import { ref, inject } from 'vue'
import { useRouter } from 'vue-router'

export default function useUsers() {
    localStorage.removeItem("user");
    localStorage.removeItem("loggedIn");

    const logins = ref({})
    const users = ref({})
    const login = ref({
        email: '',
        password: '',
        remember: ''
    })
    const usersEmails = ref({})

    const router = useRouter()
    const validationErrors = ref({})
    const isLoading = ref(false)
    const swal = inject('$swal')

    const getUsers = async (login) => (
        page = 1,
        email = '',
        password = '',
    ) => {
        axios.get('/api/user?email=' + email +
            '&password=' + password )
            .then(response => {
                logins.value = response.data;
            })
    }

    const getUser = async (login) => {
        axios.get('/api/user/' + email)
            .then(response => {
                logins.value = response.data.data;
            })
    }
    const getUserEmail = async () => {

        try {
            const response = await axios.get("/api/useremail");
            usersEmails.value = Object.entries(response.data).map(([key, value]) => ({ key, ...value }));
        } catch (error) {
            console.error("Erro ao buscar as cotações:", error);
        }
    }


    return {
        getUsers,
        getUser,
        validationErrors,
        isLoading,
        getUserEmail,
        usersEmails
    }
}
