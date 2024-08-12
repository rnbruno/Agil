import { createRouter, createWebHistory } from "vue-router";

import AuthenticatedLayout from "../layouts/Authenticated.vue";
import GuestLayout from "../layouts/Guest.vue";

import Login from '../components/Login.vue'
import Register from '../components/Register.vue'

import MarcacoesLayout from '../layouts/marcacoes/Marcacoes.vue';
import WelcomeLayout from '../layouts/Welcome.vue';
import SendMoney from '../layouts/transfer/SendMoney.vue';
import IncompleteRegisterLayout from '../layouts/confirmation/IncompleteRegister.vue';

function auth(to, from, next) {
    const loggIn = JSON.parse(localStorage.getItem('loggedIn'));

    if (loggIn) {
        next()
    }else{
        if (to.name == 'login'){
            next({name: 'login'});
        }else if (to.name == 'logout'){
            next({name: 'logout'});
        }else{
           next({name: 'layout'});
        }
    }
}


const routes = [
    {
        path: '/',
        name: 'layout',
        component: GuestLayout,
    },
    {
        path: '/login',
        name: 'login',
        component: Login,
        
    },    
    {
        path: '/register',
        name: 'register',
        component: Register,
        
    },    
    {
        component: AuthenticatedLayout,
        beforeEnter: auth,
        children: [
            {
                path: '/',
                name: 'welcome.index',
                component: WelcomeLayout,
                meta: { title: 'Welcome', }
            },
            {
                path: '/transfer/SendMoney',
                name: 'transfer.sendMoney',
                component: SendMoney,
                meta: { title: 'Send Money' }
            },
            {
                path: '/transfer/ReceiveMoney',
                name: 'transfer.receive',
                component: MarcacoesLayout,
                meta: { title: 'Receive Money' }
            },
            {
                path: '/confirmation/CompleteRegister',
                name: 'confirmation.CompleteRegister',
                component: IncompleteRegisterLayout,
                meta: { title: 'Register incomplete' }
            },

        ]
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router;