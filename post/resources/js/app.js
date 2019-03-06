import Vue from 'vue'
import VueRouter from 'vue-router'
import Login from './Login'

Vue.use(VueRouter)

const Foo = {template: '<div>foo</div>'}
const Bar = {template: '<div>bar</div>'}

const router = new VueRouter({
    mode: 'history',
    base: '/',
    routes: [
        {path: '/foo', component: Foo},
        {path: '/bar', component: Bar},
        {path: '/login', component: Login}
    ]
})

new Vue({
    router
}).$mount('#app')
