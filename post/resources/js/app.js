import Vue from 'vue'
import bootstrap from 'bootstrap'
import VueRouter from 'vue-router'
import Master from './layouts/Master'
import Login from './auth/Login'
import Logout from './auth/Logout'
import Register from './auth/Register'
import Posts from './Posts'
import {store} from './store' //zato sto je smesten store u const store = ..

window.eventBus = new Vue()

Vue.use(VueRouter)

const routes = [
    { path: '/login', component: Login },
    { path: '/register', component: Register },
    { path: '/posts', component: Posts },
    { path: '/logout', component: Logout }
]

const router = new VueRouter({
    routes,
    mode:'history'
})

new Vue({
    el:'#app',
    router,
    store, //same as store=store; analogno router
    components:{ Master },
    template:'<Master/>'
})