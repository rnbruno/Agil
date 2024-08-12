import { ref, reactive, inject, onMounted } from "vue";
import { useRouter } from "vue-router";
import { AbilityBuilder, Ability } from "@casl/ability";
import { ABILITY_TOKEN } from "@casl/vue";

const user = reactive({
    name: "",
    email_to: "",
    id_int: "",
});

export default function useAuth() {
    const processing = ref(false);
    const validationErrors = ref({});
    const router = useRouter();
    const swal = inject("$swal");
    const ability = inject(ABILITY_TOKEN);
    const logusergIn_ = ref({});

    const loginForm = reactive({
        email: "",
        password: "",
        remember: false,
    });
    const SendItemLogin = reactive({
        email: "",
        password: "",
        remember: false,
    });
    let transferir = ref(false);

    const registerForm = reactive({
        name: "",
        email: "",
        remail: "",
        password: "",
    });

    const loggedIn = ref(false);
    const user = ref({
        name: "",
        email: "",
        nameType: "",
        type_user: "",
    });

    onMounted(() => {
        // Recupera o estado de login do localStorage
        const loggIn_ = JSON.parse(localStorage.getItem("loggedIn"));

        // Verifica se o usuário está logado
        if (loggIn_) {
            // Recupera os dados do usuário do localStorage
            const logusergIn_ = JSON.parse(localStorage.getItem("user"));
            console.log(logusergIn_);
            if (logusergIn_) {
                // Atualiza a variável reativa com os dados do usuário
                user.value = {
                    name: logusergIn_.name || "",
                    id: logusergIn_.id || "",
                    email: logusergIn_.email || "",
                    nameType: logusergIn_.nameType || "",
                    type_user: logusergIn_.type_user || "",
                    id_int: logusergIn_.id_int || "",
                };
                loggedIn.value = true;
            }
        }
    });

    const submitLogin = async () => {
        if (processing.value) return;

        processing.value = true;
        validationErrors.value = {};

        axios
            .post("api/login", loginForm)
            .then(async (response) => {
                loginUser(response);
            })
            .catch((error) => {
                if (error.response?.data) {
                    validationErrors.value = error.response.data.errors;
                    swal({
                        icon: 'error',
                        title: '',
                        text: error.response.data.message,
                    });
                }
            })
            .finally(() => (processing.value = false));
    };

    const submitRegister = async () => {
        if (processing.value) return;

        processing.value = true;
        validationErrors.value = {};

        axios
            .post("api/register", registerForm)
            .then(async (response) => {
                // loginUser(response);
                swal({
                    icon: response.status,
                    title: response.status,
                    text: response.message,
                });
            })
            .catch((error) => {
                console.log(error.response); 
                if (error.response?.data) {
                    swal({
                        icon: 'error',
                        title: '',
                        text: error.response.data.message,
                    });
                }
            })
            .finally(() => (processing.value = false));
    };

    const loginUser = async (response) => {
        user.name = response.data.user.name;
        user.email = response.data.user.email;
        user.nameType = response.data.user.nameType;
        user.id_int = response.data.user.id_int;
        user.type_user = response.data.user.type_user;

        const loginTime = new Date().getTime();
        const updatedUser = {
            name: user.name,
            email: user.email,
            nameType: user.nameType,
            type_user: user.type_user,
            loginTime: loginTime,
            id_int: user.id_int,
        };
        // Armazena o usuário no localStorage
        localStorage.setItem("user", JSON.stringify(updatedUser));
        localStorage.setItem("loggedIn", JSON.stringify(true));
        sessionStorage.setItem('user', JSON.stringify(updatedUser));
        await getAbilities();
        await router.push({ name: "welcome.index" });
    };

    const getUser = () => {
        const loggIn_ = JSON.parse(localStorage.getItem("loggedIn"));
        if(loggIn_){
            axios.get("/api/user").then((response) => {
                loginUser(response);
            });
        }
    };

    const logout = async () => {
        if (processing.value) return;

        processing.value = true;
        localStorage.removeItem("user");
        localStorage.removeItem("loggedIn");
        sessionStorage.removeItem("user");
        try {
            const response = await axios.get("/logout");
            localStorage.removeItem("user");
            localStorage.removeItem("loggedIn");
            await router.push({ name: "login" });
        } catch (error) {
            console.error("Logout error:", error.response);
            swal({
                icon: "error",
                title: error.response.status,
                text: error.response.statusText,
            });
        } finally {
            processing.value = false;
        }
    };

    const getAbilities = async () => {
        axios.get("/api/abilities").then((response) => {
            const permissions = response.data;
            const { can, rules } = new AbilityBuilder(Ability);

            can(permissions);

            ability.update(rules);
        });
    };

    function checkLoginStatus() {
        const loginData = JSON.parse(localStorage.getItem("user"));
        if (!loginData) {
            // Não há dados de login no localStorage
            return false;
        }
    
        const currentTime = new Date().getTime();
        const loginTime = loginData.loginTime;
        const sessionDuration = 60 * 60 * 1000; // 1 hora
    
        if (currentTime - loginTime > sessionDuration) {
            // Tempo de sessão expirado
            localStorage.removeItem("user");
            return false;
        }
    
        return true;
    }
    return {
        loginForm,
        validationErrors,
        processing,
        submitLogin,
        user,
        getUser,
        logout,
        getAbilities,
        checkLoginStatus,
        submitRegister,
        registerForm,
        SendItemLogin,
        transferir,
        logusergIn_,
        
    };
}
