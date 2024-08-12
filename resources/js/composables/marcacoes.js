import { ref, inject } from "vue";
import { useRouter } from "vue-router";

export default function useMarcacoes() {
    const marcacoes = ref({});
    const notes = ref({});
    const marcacao = ref({
        id: "",
        animals_use: "",
        medical_id: "",
        reason: "",
        notes: "",
        data_formacao: "",
    });
    const router = useRouter();
    const validationErrors = ref({});
    const isLoading = ref(false);
    const swal = inject("$swal");

    const getMarcacoes = async () => {
        try {
            let response = await axios.get("/api/marcacoes/recepcionista");
            marcacoes.value = response.data;
        } catch (error) {
            console.error("An error occurred while fetching Marcacoes:", error);
            // Aqui você pode adicionar lógica para tratar o erro, por exemplo, mostrar uma mensagem ao usuário
        }
    };

    const updateMarcacoes = async (id, status) => {
        if (isLoading.value) return;

        isLoading.value = true;
        validationErrors.value = {};
        axios
            .put(`/api/marcacoes/update/${id}`, { id: id, medical_id: status })
            .then((response) => {
                swal({
                    icon: "success",
                    title: "Atribuição realizada com sucesso",
                });
            })
            .catch((error) => {
                if (error.response?.data) {
                    validationErrors.value = error.response.data.errors;
                }
            })
            .finally(() => (isLoading.value = false));
    };
    const edicaoMarcacoes = async (reason, notes) => {
        if (isLoading.value) return;

        isLoading.value = true;
        validationErrors.value = {};
        axios
            .put(`/api/marcacoes/edicao/${reason}`, {
                reason: reason,
                notes: notes,
            })
            .then((response) => {
                swal({
                    icon: "success",
                    title: "Atribuição realizada com sucesso",
                });
            })
            .catch((error) => {
                if (error.response?.data) {
                    validationErrors.value = error.response.data.errors;
                }
            })
            .finally(() => (isLoading.value = false));
    };

    const deleteMarcacao = async (id) => {
        console.log(id);
        swal({
            title: "Are you sure?",
            text: "You won't be able to revert this action!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            confirmButtonColor: "#ef4444",
            timer: 20000,
            timerProgressBar: true,
            reverseButtons: true,
        }).then((result) => {
            if (result.isConfirmed) {
                axios
                    .put(`/api/marcacoes/excluido/${id}`, { id: id })
                    .then((response) => {
                        swal({
                            icon: "success",
                            title: "Marcação deleted successfully",
                        });
                        getMarcacoes();
                    })
                    .catch((error) => {
                        swal({
                            icon: "error",
                            title: "Something went wrong",
                        });
                    });
            }
        });
    };

    return {
        marcacoes,
        getMarcacoes,
        updateMarcacoes,
        deleteMarcacao,
        edicaoMarcacoes
    };
}
