<template>
    <main>


        <div class="row g-5">
            <div class="col-md-12">
                <form class="needs-validation" @submit.prevent="submitForm" method="post">
                    <div class="row g-3">

                        <div class="col-md-5">
                            <label for="country" class="form-label">Animal Cadastrado</label>
                            <select class="form-control" for="animaluser_" id="animaluser_" name="animaluser_"
                                v-model="selectedOptionAnimalUser" required>
                                <option v-for="optionAnimalUser in modalOptionsAnimalsUser"
                                    :key="optionAnimalUser.value" :value="optionAnimalUser.value">
                                    {{ optionAnimalUser.text }}
                                </option>
                            </select>

                        </div>

                        <div class="col-md-5">
                            <label for="country" class="form-label">Notes</label>
                            <div class="autocomplete">
                                <textarea type="text" for="note" id="note" name="note" v-model="searchQuery"
                                    @input="filterSuggestions" @focus="showSuggestions = true" @blur="hideSuggestions"
                                    class="form-control" required></textarea>
                                <ul v-if="showSuggestions" class="suggestions-list">
                                    <li v-for="(suggestion, index) in filteredSuggestions" :key="index"
                                        @mousedown.prevent="selectSuggestion(suggestion)" class="suggestion-item">
                                        {{ suggestion }}
                                    </li>
                                </ul>
                                <!-- <span v-if="errors.note">{{ errors.note }}</span> -->
                            </div>
                        </div>

                        <div class="col-md-5">
                            <label for="country" class="form-label">Horarios</label>
                            <select class="form-control" id="horariosD" name="horariosD" for="horariosD"
                                v-model="selectedOptionHorariosDisponiveis" required>
                                <option v-for="optionHorariosDisponivel in modalOptionsHorariosDisponiveis"
                                    :key="optionHorariosDisponivel.value" :value="optionHorariosDisponivel.value">
                                    {{ optionHorariosDisponivel.text }}
                                </option>
                            </select>
                        </div>
                        <div class="col-md-5">
                            <label for="country" class="form-label">Users</label>
                            <select v-if="user.type_user === 2" class="form-control" id="horariosD" name="horariosD"
                                for="horariosD" v-model="selectedOptionHorariosDisponiveis" required>
                                <option v-for="optionHorariosDisponivel in modalOptionsHorariosDisponiveis"
                                    :key="optionHorariosDisponivel.value" :value="optionHorariosDisponivel.value">
                                    {{ optionHorariosDisponivel.text }}
                                </option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <button class="btn btn-primary btn-lg items-center" type="submit"
                                title="marque um agendamento">Marcar</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </main>
</template>

<script>
import { useRouter } from 'vue-router';
import { ref, computed, onMounted } from 'vue';
import useMarcacoes from '@/composables/marcacoes';
import useMedicals from '@/composables/medicos';
import useHorariosDisponiveis from '@/composables/horariosDisponiveis';
import useAnimalUser from '@/composables/animalsUser';
import Swal from 'sweetalert2';
import ModalAtribuir from '../../modal/AtribuirModal.vue';
import Modal_e from '../../modal/Modal_e.vue';
import { format } from 'date-fns';
import useAuth from "@/composables/auth";


export default {

    name: 'Marcacoes',
    props: {
        suggestions: {
            type: Array,
            required: true,
        },

    },
    components: {
        ModalAtribuir,
        Modal_e
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
        const { marcacao, marcacoes, getMarcacoes, updateMarcacoes, deleteMarcacao } = useMarcacoes();
        const { medical, medicals, getMedicals } = useMedicals();
        const { horariosDisponiveis, getHorariosDisponiveis } = useHorariosDisponiveis();
        const { animalsUsers, getAnimalsUser } = useAnimalUser();
        const { user, processing, logout } = useAuth();

        const modalOptions = ref([]);
        const modalOptionsAnimalsUser = ref([]);
        const modalOptionsHorariosDisponiveis = ref([]);

        const searchQuery = ref('');
        const showSuggestions = ref(false);

        const marcacoesNote = () => {
            // Assumindo que medicals é uma lista de objetos com id e name
            marcacoes_notes.value = marcacoes.value.map(notes => ({
                text: `${notes.notes}`,
            }));
        };

        const filteredSuggestions = computed(() => {
            if (searchQuery.value === '') {
                return [];
            }
            return marcacoes.value
                .filter(item =>
                    item.notes.toLowerCase().includes(searchQuery.value.toLowerCase())
                )
                .map(item => item.notes); // Apenas retorna o texto
        });

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

        const selectedOptionAnimalUser = ref(null);
        const selectedOptionHorariosDisponiveis = ref(null);

        const setOptions = () => {
            // Assumindo que medicals é uma lista de objetos com id e name
            modalOptions.value = horariosDisponiveis.value.map(horariosDisponivel => ({
                value: horariosDisponivel.id,
                text: `${horariosDisponivel.data} - ${horariosDisponivel.hora_inicio}`,

            }));
        };

        const setOptionsAnimalsUser = () => {
            // Assumindo que medicals é uma lista de objetos com id e name
            modalOptionsAnimalsUser.value = animalsUsers.value.map(animalUser => ({
                value: animalUser.id,
                text: `${animalUser.name} - ${animalUser.type_name}`,
            }));
            if (modalOptionsAnimalsUser.value.length > 0) {
                selectedOptionAnimalUser.value = modalOptionsAnimalsUser.value[0].value;
            }
        };

        const setOptionsHorariosDisponiveis = () => {
            // Assumindo que medicals é uma lista de objetos com id e name
            modalOptionsHorariosDisponiveis.value = horariosDisponiveis.value.map(horariosDisponivel => ({
                value: horariosDisponivel.id,
                text: `${horariosDisponivel.data}  ${horariosDisponivel.hora_inicio}`,
            }));
            if (modalOptionsHorariosDisponiveis.value.length > 0) {
                selectedOptionHorariosDisponiveis.value = modalOptionsHorariosDisponiveis.value[0].value;
            }
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
            await getMarcacoes();
            await getMedicals();
            await getHorariosDisponiveis();
            await getAnimalsUser();

            setOptions();
            setOptionsAnimalsUser();
            setOptionsHorariosDisponiveis();
        });



        onMounted(async () => {
            // Fetch marcacoes and medicals data here if needed
            // await getMarcacoes();
            // await getMedicals();
        });


        return {
            marcacoes,
            modalOptions,
            // modalInitialOption

            getHorariosDisponiveis,
            modalOptionsHorariosDisponiveis,
            modalOptionsAnimalsUser,
            selectedOptionAnimalUser,
            selectedOptionHorariosDisponiveis,
            searchQuery,
            showSuggestions,
            filteredSuggestions,
            filterSuggestions,
            hideSuggestions,
            selectSuggestion,
            marcacoesNote,
            errors,
            handleSubmit,
            form,
            router,
            user,

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
        async submitForm() {
            try {
                const formData = {
                    animaluser_: this.selectedOptionAnimalUser,  // Pegando o valor selecionado
                    horariosDisponiveis_: this.selectedOptionHorariosDisponiveis, // Pegando o valor selecionado
                    note: this.searchQuery  // Pegando o valor do textarea
                };
                const response = await axios.post('/api/submitMarcacao', formData);

                this.$router.push({ name: 'welcome.index' });

                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: 'Marcação inserida com sucesso!',
                    showConfirmButton: false,
                    timer: 1500
                });
            } catch (error) {
                Swal.fire({
                    position: "top-end",
                    icon: "error",
                    title: error,
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        },
        // async confirmarAtribuir(payload) {
        //     console.log('Received from modal:', payload);
        //     console.log('Confirmed with input:', this.modalInput, this.modalName);
        //     const { selectedOption } = payload;

        //     console.log('Selected Option:', selectedOption);
        //     // Lógica para lidar com a confirmação
        //     try {
        //         await this.update(selectedOption, 1);
        //         // const response = await axios.patch(`/api/contas/update-name/${this.modalInput}`, {
        //         //     conta: this.modalName, conta_id: this.modalInput
        //         // });
        //         // console.log('Item updated successfully:', response.data);
        //         Swal.fire({
        //             title: 'Medical atribuido',
        //             text: 'Marcação atribuida com sucesso.',
        //             icon: 'success',
        //             confirmButtonText: 'OK'
        //         });
        //         await this.atualizarMark();
        //     } catch (error) {
        //         if (error.response && error.response.data && error.response.data.message) {
        //             // Exibir SweetAlert de erro com a mensagem retornada pela API
        //             Swal.fire({
        //                 title: 'Error',
        //                 text: error.response.data.message,
        //                 icon: 'error',
        //                 confirmButtonText: 'OK'
        //             });
        //         } else {
        //             // Exibir mensagem de erro genérica
        //             Swal.fire({
        //                 title: 'Error',
        //                 text: 'Erro desconhecido ao atribuir medical.',
        //                 icon: 'error',
        //                 confirmButtonText: 'OK'
        //             });
        //         }
        //     }

        // },
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
<style src="./marcacao.css"></style>