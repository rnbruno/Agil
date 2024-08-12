<template>
    <div class="">

        <!-- Page Content -->
        <main>
            <div class="bg-white overflow-hidden shadow-sm min-w-full align-middle">

                <table style="width:755px"
                    class="table table-striped min-w-full divide-y divide-gray-200 table-striped">
                    <thead class="thead-light">
                        <tr class="thead-light">
                            <th>Marcação</th>
                            <th>Médico Atribuído</th>
                            <th>Tipo Animal</th>
                            <th>Data da marcação</th>
                            <th>Reason</th>
                            <th>Notes</th>
                            <th class="text-center items-center justify-end ">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="marcacao in marcacoes" :key="marcacao.id">
                            <td class="text-center">{{ marcacao.id }}</td>
                            <td :class="{ 'item-excluido': marcacao.excluido == 1 }">
                                <div v-if="marcacao.medical_id == 0 && user.type_user !== 1"><button
                                        class="btn btn-success btn-sm items-center"
                                        @click="ModalAtribuir(marcacao.id, marcacao.marcacao_date, marcacao.type_animal_name)"
                                        title="Atribua a um médico">Atribuir</button>

                                    <ModalAtribuir :isVisible="isModalVisible" @close="closeModal" :title="modalTitle"
                                        :initialInputValue="modalInputValue" :initialInputValue2="modalInputValue2"
                                        :initialInputValue3="modalInputValue3" :options="modalOptions"
                                        :initialOption="modalInitialOption" @confirm="confirmarAtribuir"
                                        :hiddenValue="marcacao.id">
                                        <template #bodyAtt>
                                            <div class="mb-3">
                                                <label for="modalInput" class="form-label">Name count</label>
                                                <input type="hidden" :value="hiddenValue" />
                                            </div>
                                        </template>
                                    </ModalAtribuir>
                                </div>

                                <div v-else>{{ marcacao.medical_name }}</div>

                            </td>
                            <td :class="{ 'item-excluido': marcacao.excluido === 1 }">{{ marcacao.type_animal_name }}
                            </td>
                            <td>{{ marcacao.marcacao_date }}</td>
                            <td>{{ marcacao.reason }}</td>
                            <td>{{ marcacao.notes }}</td>
                            <td class="items-center justify-end ">
                                <div v-if="marcacao.excluido == 1" class="" title="Excluído">Excluído</div>
                                <div v-else class="items-center justify-end ">

                                    <button v-if="user.type_user !== 1" @click.prevent="deleteMarcacao(marcacao.id)"
                                        class="btn btn-danger ml-2" title="Desativar marcação"><i class="fa fa-trash"
                                            aria-hidden="true"></i></button>
                                    <button @click="edit(marcacao.id, marcacao.reason, marcacao.notes)" class="btn btn-warning ml-2"
                                        title="Editar marcação"><i class="fa fa-trash"
                                            aria-hidden="true"></i>Edit</button>
                                    <Modal_e @close="closeModal1" :active_att="showModalAtt"
                                        :initialInputValue="modalInputValue" @confirm="confirmarEdicao1">
                                        <template #bodyAtt1>
                                            <div class="mb-3">
                                                <label for="modalInput" class="">Reason</label>
                                                <input type="hidden"  v-model="modalData.id" />
                                                <textarea class="form-control" type="text" 
                                                    v-model="modalData.reason"></textarea>
                                                <label for="modalInput" class="">Notes</label>
                                                <!-- <input v-model="inputValue" /> -->
                                                <textarea class="form-control" type="text" 
                                                    v-model="modalData.notes"></textarea>
                                            </div>
                                        </template>
                                    </Modal_e>

                                </div>

                            </td>
                        </tr>
                    </tbody>
                </table>


            </div>


        </main>
    </div>
</template>

<script>
import { ref, computed, onMounted } from 'vue';
import useMarcacoes from '@/composables/marcacoes';
import useMedicals from '@/composables/medicos';
import Swal from 'sweetalert2';
import ModalAtribuir from '../../modal/AtribuirModal.vue';
import Modal_e from '../../modal/Modal_e.vue';
import { format } from 'date-fns';
import useAuth from "../../composables/auth";

export default {

    name: 'AgendarMarcacoes',
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
            isModalVisible1: false,
        };
    },
    setup() {
        const { marcacao, marcacoes, getMarcacoes, updateMarcacoes, deleteMarcacao, edicaoMarcacoes } = useMarcacoes();
        const { medical, medicals, getMedicals } = useMedicals();
        const { user, processing, logout } = useAuth()

        const modalOptions = ref([]);

        const setOptions = () => {
            // Assumindo que medicals é uma lista de objetos com id e name
            modalOptions.value = medicals.value.map(medical => ({
                value: medical.id,
                text: medical.name
            }));
        };

        onMounted(async () => {
            await getMarcacoes();
            await getMedicals();

            setOptions();
        });


        const desactiveconta = async (id) => {
            try {
                await deleteMarcacao(id);
                // await getContas();
                Swal.fire({
                    title: 'Desativado',
                    text: 'Conta desativada com sucesso.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            } catch (error) {
                if (error.response && error.response.data && error.response.data.message) {
                    Swal.fire({
                        title: 'Error',
                        text: error.response.data.message,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: 'Erro desconhecido ao atualizar a conta.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            }
        };
        const activeconta = async (id) => {
            try {
                const result = await updateContas(id, 0);
                await getContas();
                Swal.fire({
                    title: 'Ativada',
                    text: 'Conta ativada com sucesso.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
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
        };
        const atualizarMark = async (id) => {
            await getMarcacoes();
        }

        const modalData = ref({
            reason: '',
            notes: '',
            id: ''
        });
        const confirmarAtribuir = async (payload) => {
            const { selectedOption, hiddenValue } = payload;
            updateMarcacoes(hiddenValue, selectedOption);
            await atualizarMark(hiddenValue);
        };
        const confirmarEdicao1 = async (payload) => {
            const { selectedOption, hiddenValue } = payload;
            edicaoMarcacoes(hiddenValue, selectedOption);
            await atualizarMark(hiddenValue);
        };

        onMounted(async () => {
            // Fetch marcacoes and medicals data here if needed
            // await getMarcacoes();
            // await getMedicals();
        });


        return {
            marcacoes,
            modalOptions,
            // modalInitialOption
            atualizarMark,
            confirmarAtribuir,
            desactiveconta,
            deleteMarcacao,
            user, processing, logout,
            confirmarEdicao1
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
        closeModal1() {
            // this.isModalVisible = false;
            this.showModalAtt = false;
        },
        CreateMarcacao() {
            this.modalTitle = `Marcação ID: ${marcacaoId}`;
            this.modalInputValue = 'Initial value'; // Substitua pelo valor desejado
            this.modalInputValue2 = date; // Substitua pelo valor desejado
            this.modalInputValue3 = name_animal; // Substitua pelo valor desejado
            this.isModalVisible = true;
            this.marcacaoId_ = marcacaoId;
        },
        edit(id) {
            console.log("selecioanndo")
            this.modalInputValue = 'Initial value'; // Substitua pelo valor desejado
            this.initialInputValue = id; // Substitua pelo valor desejado
            this.showModalAtt = true; // Substitua pelo valor desejado
            this.isModalVisible = true;
        },
        async editw(marcacao_id) {
            // this.modalTitle = `Marcação ID: ${marcacaoId}`;
            this.modalInputValue = 'Initial value'; // Substitua pelo valor desejado
            // this.modalInputValue2 = date; // Substitua pelo valor desejado
            this.showModalAtt = true; // Substitua pelo valor desejado
            this.isModalVisible = true;
            // this.marcacaoId_ = marcacaoId;               
            // const { selectedOption } = payload;
            // Lógica para lidar com a confirmação
            try {
                await this.update(selectedOption, 1);
                // const response = await axios.patch(`/api/contas/update-name/${this.modalInput}`, {
                //     conta: this.modalName, conta_id: this.modalInput
                // });
                // console.log('Item updated successfully:', response.data);
                Swal.fire({
                    title: 'Medical atribuido',
                    text: 'Marcação atribuida com sucesso.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
                await this.atualizarMark();
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
                        text: 'Erro desconhecido ao atribuir medical.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            }

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
</style>
<style src="./marcacao.css"></style>