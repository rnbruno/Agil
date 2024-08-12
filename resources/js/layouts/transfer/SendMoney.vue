<template>
    <main>


        <div class="row g-5">
            <div class="col-md-12">
                <main>
                    <Header />
                    <StepOne v-if="store.currentStep === 1" />
                    <StepTwo v-if="store.currentStep === 2" />
                    <StepThree v-if="store.currentStep === 3" />
                    <Bottom />
                </main>
            </div>
        </div>
    </main>
</template>

<script>
import { useRouter } from 'vue-router';
import { ref, computed, onMounted, defineProps  } from 'vue';

import Swal from 'sweetalert2';
import ModalAtribuir from '../../modal/AtribuirModal.vue';
import Modal_e from '../../modal/Modal_e.vue';
import { format } from 'date-fns';
import useAuth from "../../composables/auth";
import StepOne from '../transfer/Step/StepOne.vue';
import StepTwo from '../transfer/Step/StepTwo.vue';
import StepThree from '../transfer/Step/StepThree.vue';

import Header from '../transfer/Step/Header.vue';
import Bottom from '../transfer/Step/Bottom.vue';

// import { useStore } from 'pinia';
import { useMainStore } from '../../composables/mainStore';

export default {

    name: 'SendMoney',
 
    components: {
        ModalAtribuir,
        Modal_e,
        Header,
        Bottom,
        StepOne,
        StepTwo,
        StepThree,
    },
    data() {
        return {
            modalTitle: '',
            showModal: false,
            showModalAdd: false,
            showModalAtt: false,
            isModalVisible: false,
            modalTitleAdd: '',
            modalTitleAtt: '',
            modalType: '',
            modalTypeAtt: '',
            modalName: '',
            modalInput: Array,
            modalButton: Array,
            modalAtribuir_: Array,
            currentPageTitle: 'Título da Página Atual', // Defina a propriedade aqui
            isModalVisible: false,
            modalInputValue: '',
            modalInputValue2: '',
            modalInputValue3: '',
            modalInitialOption: 1,
            hiddenValue: 'hidden_value',
            marcacaoId_: '',

        };
    },
    setup() {
        const router = useRouter();
        const { user, processing, logout } = useAuth();

        const store = useMainStore();

        const modalOptions = ref([]);
  
        const searchQuery = ref('');
        const showSuggestions = ref(false);
        const pageTitle = computed(() => router.meta.title || 'Default Title');
        const suggestions = ref();
        const filterSuggestions = () => {
            showSuggestions.value = true;
        };
        const hideSuggestions = () => {
            setTimeout(() => {
                showSuggestions.value = false;
            }, 100);
        };
        const selectSuggestion = (suggestion) => {
            searchQuery.value = suggestion;
            showSuggestions.value = false;
        };

        const form = ref({
            note: '',
        });

        const errors = ref({});

        const validateForm = () => {
            errors.value = {};
            if (!form.value.note) errors.value.note = 'A note é obrigatória';

            // return Object.keys(errors.value).length === 0;
        };

        const handleSubmit = async () => {
            // if (validateForm()) {
            try {
                console.log(form.value);
                const response = await axios.post('/api/submitMarcacao', form.value);
                console.log('Formulário enviado com sucesso:', response.data);
                // Limpar o formulário após envio bem-sucedido
                form.value = { name: '', email: '', message: '' };
            } catch (error) {
                console.error('Erro ao enviar o formulário:', error);
            }
            // }
        };

        onMounted(async () => {


        });

        return {

            modalOptions,
            // modalInitialOption
            searchQuery,
            showSuggestions,
            filterSuggestions,
            hideSuggestions,
            selectSuggestion,
            errors,
            handleSubmit,
            form,
            router,
            user,
            store,
            suggestions

        };
    },
    methods: {
        formatDate(date) {
            return format(new Date(date), 'dd/MM/yyyy HH:mm');
        },
        ModalAtribuir(marcacaoId, date, name_animal) {
            this.modalTitle = `Marcação ID: ${marcacaoId}`;
            this.modalInputValue = 'Initial value'; // Substitua pelo valor desejado
            this.modalInputValue2 = date; // Substitua pelo valor desejado
            this.modalInputValue3 = name_animal; // Substitua pelo valor desejado
            this.isModalVisible = true;
            this.marcacaoId_ = marcacaoId;
        },
        closeModal() {
            this.isModalVisible = false;
        },
        CreateMarcacao() {
            this.modalTitle = `Marcação ID: ${marcacaoId}`;
            this.modalInputValue = 'Initial value'; // Substitua pelo valor desejado
            this.modalInputValue2 = date; // Substitua pelo valor desejado
            this.modalInputValue3 = name_animal; // Substitua pelo valor desejado
            this.isModalVisible = true;
            this.marcacaoId_ = marcacaoId;
        },
       
        async handleConfirmAcount() {
            console.log('Confirmed with input:', this.modalInput, this.modalName);
            // Lógica para lidar com a confirmação
            try {
                const response = await axios.patch(`/api/contas/update-name/${this.modalInput}`, {
                    conta: this.modalName, conta_id: this.modalInput
                });
                console.log('Item updated successfully:', response.data);
                Swal.fire({
                    title: 'Count edit',
                    text: 'Conta editada com sucesso.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
                await this.atualizarCount();
            } catch (error) {
                if (error.response && error.response.data && error.response.data.message) {
                    // Exibir SweetAlert de erro com a mensagem retornada pela API
                    Swal.fire({
                        title: 'Error',
                        text: error.response.data.message,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                } else {
                    // Exibir mensagem de erro genérica
                    Swal.fire({
                        title: 'Error',
                        text: 'Erro desconhecido ao atualizar a conta.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            }

        },
        openModal(marcacaoId) {
            this.currentMarcacaoId = marcacaoId;
            this.showModalAtt = true;
        },
    }
}

</script>
<style>
.tela {
    width: 500px;
}

.autocomplete {
    position: relative;
}

.suggestions-list {
    position: absolute;
    background: white;
    border: 1px solid #ccc;
    max-height: 200px;
    overflow-y: auto;
    width: 100%;
    list-style: none;
    padding: 0;
    margin: 0;
    z-index: 10;
}

.suggestion-item {
    padding: 10px;
    cursor: pointer;
}

.suggestion-item:hover {
    background-color: #f0f0f0;
}
</style>
