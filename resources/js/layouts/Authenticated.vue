<template>
    <div class="min-h-screen ">
        <nav class="bg-white ">
            <!-- Primary Navigation Menu -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="shrink-0 flex items-center">
                            <router-link   active-class="border-b-2 border-indigo-400" :to="{ name: 'welcome.index' }">
                                <img :src="logoUrl" style="width:65px" alt="Logo">
                            </router-link >
                        </div>

                        <!-- Navigation Links -->
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <router-link v-if="user.type_user != 0"
                            :to="{ name: 'transfer.sendMoney' }"  class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-gray-900 focus:outline-none transition duration-150 ease-in-out"> Send Money
                            </router-link>
                            <router-link v-if="user.type_user != 0"
                            :to="{ name: 'transfer.receive' }" class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-gray-900 focus:outline-none transition duration-150 ease-in-out"> Receive Money
                   
                            </router-link>

                            <router-link v-if="user.type_user == 0"
                            :to="{ name: 'transfer.receive' }" class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-gray-900 focus:outline-none transition duration-150 ease-in-out"> Register Finish
                   
                            </router-link>
                            
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div>
                            <div>Hi, {{ user.name }}</div>
                            <div class="text-sm text-gray-500">{{ user.email }}</div>
                            <div class="text-sm text-gray-500">{{ user.nameType }}</div>
                        </div>
                    </div>
                    <button @click="logout" type="button" class=" btn btn-outline-primary  active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150 ml-4" :class="{ 'opacity-25': processing }" :disabled="processing">
                        Log out
                    </button>
                </div>
            </div>
        </nav>

        <!-- Page Heading -->
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ currentPageTitle }}
                </h2>
            </div>
        </header>

        <!-- Page Content -->
        <main>
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <router-view></router-view>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>

<script>
import useAuth from "../composables/auth";

export default {
    data() {
        return {
            logoUrl: '/img/logo_wallet.PNG', // Caminho relativo a partir da pasta public
            showDropdown: false
        }
    },
    setup() {
        const { user, processing, logout } = useAuth()

        return { user, processing, logout }
    },
    computed: {
        currentPageTitle() {
            return this.$route.meta.title;
        }
    }
}
</script>