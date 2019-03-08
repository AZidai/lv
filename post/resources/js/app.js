import Vue from 'vue'
import VueAxios from 'vue-axios'
import bootstrap from './bootstrap'

import VueRouter from 'vue-router'
import Login from './Login'
import Register from './Register'
import Navbar from './Navbar'

Vue.use(VueRouter)

Vue.component(Navbar)

const router = new VueRouter({
    mode: 'history',
    base: '/',
    routes: [
        {path: '/login', component: Login},
        {path: '/register', component: Register}
    ]
})

new Vue({
    router
}).$mount('#app')
