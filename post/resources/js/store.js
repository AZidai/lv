import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const LOGIN = "LOGIN"
const LOGIN_SUCCESS= "LOGIN_SUCCESS"
const LOGOUT = "LOGOUT"
// obj state

const state = {
    isLoggedin: !!localStorage.getItem('token')
}

const mutations = {
    LOGIN_USER(state){
        state.isLoggedin = true
    },
    LOGOUT_USER(state){
        state.isLoggedin = false
    }
}

export const store = new Vuex.Store({
    state,
    mutations
})