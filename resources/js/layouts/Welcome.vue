<template>
    <div>
        <div class=" py-3 my-4 bg-white">
            <div class="container-fluid">
                <div class="row">
                    <h2>Dashboard</h2>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header border-0">
                                <div class="d-flex justify-content-between">
                                    <h3 class="card-title">Accounts <p v-if="loading">Carregando dados...</p>
                                        <p v-else-if="accountExists">{{
                                            accounts[0].account_number }}</p>
                                        <p v-else>Erro ao carregar saldo.</p>
                                    </h3>
                                    <button class="btn btn-light
                                     34btn-sm">Alter Account 
                                        <p v-if="loading">Carregando dados...</p>
                                        <p class="badge text-bg-secondary" v-else-if="accountExists">{{
                                            accounts[0].accountsCount }}</p>
                                        <p v-else>Erro ao carregar saldo.</p>
                                    </button>
                                  
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- <div v-for="(q, key) in accounts" :key="key" class="d-flex"> -->
                                <p class="d-flex flex-column">
                                    <span class="text-bold text-lg">
                                        <p v-if="loading">Carregando dados...</p>
                                        <p v-else-if="accountExists">R$ {{
                                            accounts[0].balance }}</p>
                                        <p v-else>Erro ao carregar saldo.</p>
                                    </span>
                                    <span>Saldo</span>
                                </p>
                              
                                
                            </div>
                        </div>
                        <br><br>
                        <div class="card">
                            <div class="card-header border-0">
                                <h3 class="card-title">Price </h3>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-valign-middle" v-if="cotacoes && cotacoes.length">
                                    <thead>
                                        <tr>
                                            <th>Code</th>
                                            <th>Name</th>
                                            <th>High</th>
                                            <th>Low</th>
                                            <th>VariatioN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(moeda, key) in cotacoes" :key="key">
                                            <td>{{ moeda.code }}</td>
                                            <td>{{ moeda.name }}</td>
                                            <td>{{ moeda.high }}</td>
                                            <td>{{ moeda.low }}</td>
                                            <!-- <td>{{ moeda.low }}</td> -->
                                            <td>
                                                <small v-if="moeda.varBid > 0" class="text-success mr-1">
                                                    <i class="fas fa-arrow-up"></i>
                                                </small>
                                                <small v-else class="text-danger mr-1">
                                                    <i class="fas fa-arrow-down"></i>
                                                </small>
                                                {{ moeda.varBid }}
                                            </td>
                                        </tr>


                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header border-0">
                                <div class="d-flex justify-content-between">
                                    <h3 class="card-title">Actually Transfers</h3>
                                    <!-- <a href="javascript:void(0);">View Report</a> -->
                                </div>
                            </div>
                            <div class="card-body">
                                <div v-if="transferId.length > 0">
                                    <div class="d-flex" v-for="(transfer, key) in transferId" :key="key">

                                        <p :class="{
                                            'text-decoration-line-through': transfer.status === 'cancelada',
                                            'fst-italic': transfer.status === 'pendente'
                                        }" class="d-flex flex-column">
                                            <span class="text-bold text-lg">
                                                <i v-if="transfer.from_account_id == idInt"
                                                    class="fas fa-arrow-down text-danger"></i>
                                                <i v-else="transfer.from_account_id != idInt"
                                                    class="fas fa-arrow-up text-success"></i>
                                                {{ transfer.amount }}

                                            </span>
                                            <span>From {{ transfer.from_name }}</span>
                                        </p>
                                        <p :class="{
                                            'text-decoration-line-through': transfer.status === 'cancelada',
                                            'fst-italic': transfer.status === 'pendente'
                                        }" class="ml-auto d-flex text-purple flex-column text-center">
                                            <span class="">{{ transfer.created_at }}</span>
                                            <span class="text-dark">{{ transfer.mensagem }}</span>

                                        </p>
                                        <p class="ml-auto d-flex flex-column text-right">
                                            <span :class="{
                                                'text-danger': transfer.status === 'cancelada',
                                                'text-warning': transfer.status === 'pendente',
                                                'text-success': transfer.status === 'completada'
                                            }">{{ transfer.status }}</span>
                                            <span class="text-muted">To {{ transfer.to_name }}</span>
                                        </p>

                                    </div>
                                </div>
                                <div v-else class="text-center col-sm-4 offset-4">
                                    <span>Transfer is null</span>
                                </div>

                                <div class="position-relative mb-4">
                                    <div class="chartjs-size-monitor">
                                        <div class="chartjs-size-monitor-expand">
                                            <div class=""></div>
                                        </div>
                                        <div class="chartjs-size-monitor-shrink">
                                            <div class=""></div>
                                        </div>
                                    </div>
                                    <canvas id="sales-chart" height="200" width="484"
                                        style="display: block; width: 484px; height: 200px;"
                                        class="chartjs-render-monitor"></canvas>
                                </div>
                                <div class="d-flex flex-row justify-content-end">
                                    <span class="mr-2">
                                        <i class="fas fa-square text-primary"></i> This month
                                    </span>
                                    <span>
                                        <i class="fas fa-square text-gray"></i> Last month
                                    </span>
                                </div>

                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header border-0">
                                <h3 class="card-title">Motivaion</h3>
                                <div class="card-tools">
                                    <a href="#" class="btn btn-sm btn-tool">
                                        <i class="fas fa-download"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-tool">
                                        <i class="fas fa-bars"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                                    <p class="text-success text-xl">
                                        <i class="ion ion-ios-refresh-empty"></i>
                                    </p>
                                    <p class="d-flex flex-column text-right">
                                        <span class="font-weight-bold">
                                            <i class="ion ion-android-arrow-up text-success"></i> 12%
                                        </span>
                                        <span class="text-muted">CONVERSION RATE</span>
                                    </p>
                                </div>

                                <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                                    <p class="text-warning text-xl">
                                        <i class="ion ion-ios-cart-outline"></i>
                                    </p>
                                    <p class="d-flex flex-column text-right">
                                        <span class="font-weight-bold">
                                            <i class="ion ion-android-arrow-up text-warning"></i> 0.8%
                                        </span>
                                        <span class="text-muted">SALES RATE</span>
                                    </p>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-0">
                                    <p class="text-danger text-xl">
                                        <i class="ion ion-ios-people-outline"></i>
                                    </p>
                                    <p class="d-flex flex-column text-right">
                                        <span class="font-weight-bold">
                                            <i class="ion ion-android-arrow-down text-danger"></i> 1%
                                        </span>
                                        <span class="text-muted">REGISTRATION RATE</span>
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

</template>
<script>
import { onMounted, onUnmounted, watchEffect, computed, ref } from 'vue';
import useDashboard from '../composables/dashboard'
import useAuth from "../composables/auth";

export default {
    name: 'Welcome',
    data() {
        return {
            logoUrl: '/img/logo_wallet.PNG', // Caminho relativo a partir da pasta public
            showDropdown: false,

        }
    },
    setup() {
        const { cotacoes, getCotacao, transferId, getTransfer, accounts, getAccount } = useDashboard();
        const { user, processing, logout } = useAuth()

        const fetchCotacoes = async () => {
            await getCotacao();

        };
        const idInt = JSON.parse(sessionStorage.getItem('user') ?? '{}').id_int;

        // Computed para verificar se o ID do primeiro item existe
        const accountExists = computed(() => {
            return accounts.value && accounts.value[0] && accounts.value[0].id !== null && accounts.value[0].id !== undefined;
        });
        const loading = ref(true);
        // Função assíncrona para carregar as contas
        const loadAccounts = async () => {
            loading.value = true;
            await getAccount();  // Aguarda a chamada assíncrona de getAccount
            loading.value = false;
        };

        console.log(accounts);

        let intervalId;

        onMounted(async () => {
            await fetchCotacoes();
            await getTransfer();
            loadAccounts();
            await getAccount();
            intervalId = setInterval(fetchCotacoes, 40000);

        });

        onUnmounted(() => {
            clearInterval(intervalId);
        });

        watchEffect(() => {
            // console.log("Mudança detectada em myRef:", cotacoes.value);
        });


        return {
            user, cotacoes, getCotacao, transferId, getTransfer, idInt, accounts, getAccount,
            accountExists, loading
        }
    },
    methods: {

    },
    computed: {
        accountExists() {
            return this.accounts[0] && this.accounts[0].id !== null && this.accounts[0].id !== undefined;
        }
    }
}
</script>