import Vue from 'vue'
import VueAxios from 'vue-axios'
import bootstrap from './bootstrap'

import VueRouter from 'vue-router'
import Login from './Login'
import Register from './Register'
import Navbar from './Navbar'

Vue.use(VueRouter)

const Foo = {template: '<div>foo</div>'}
const Bar = {template: '<div>bar</div>'}
Vue.component(Navbar)

const router = new VueRouter({
    mode: 'history',
    base: '/',
    routes: [
        {path: '/foo', component: Foo},
        {path: '/bar', component: Bar},
        {path: '/login', component: Login},
        {path: '/register', component: Register}
    ]
})

new Vue({
    router
}).$mount('#app')
