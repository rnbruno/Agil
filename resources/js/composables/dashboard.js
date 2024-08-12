import { ref } from "vue";

export default function useDashboard() {
    const cotacoes = ref(null);
    const transferId = ref(null);
    
    const getCotacao = async () => {
        try {
            const response = await axios.get("/api/getCotacao");
            cotacoes.value = Object.entries(response.data).map(([key, value]) => ({ key, ...value }));
        } catch (error) {
            console.error("Erro ao buscar as cotações:", error);
        }
    };
    const getTransfer = async () => {
        try {
            const idInt = JSON.parse(sessionStorage.getItem('user') ?? '{}').id_int;
            const response = await axios.get(`/api/getTransfer/${idInt}`);
            console.log(response);
            transferId.value = Object.entries(response.data).map(([key, value]) => ({ key, ...value }));
        } catch (error) {
            console.error("Erro ao buscar as cotações:", error);
        }
    };

    return { cotacoes, getCotacao, transferId, getTransfer };
}
