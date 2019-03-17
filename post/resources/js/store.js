import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const LOGIN = "LOGIN"
const LOGIN_SUCCESS= "LOGIN_SUCCESS"
const LOGOUT = "LOGOUT"
// obj state
export const store = new Vuex.Store({
    state:{
        isLoggedin: !!localStorage.getItem('token')
    },
    // states of user
    mutations:{
        [LOGIN](state){
            state.pending = true
        },
        [LOGIN_SUCCESS](state){
            state.isLoggedin = true
            state.pending = false
        },
        [LOGOUT](state){
            state.isLoggedin = false
        },
    },
    actions:{
        login({commit},creds){
            commit(LOGIN); //show spinner
            return new Promise(resolve=>{
                setTimeout(()=>{
                    localStorage.setItem('token')
                    commit(LOGIN_SUCCESS)
                    resolve()
                },1000)
            })
        }
    }
})