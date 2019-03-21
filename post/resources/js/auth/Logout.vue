<template>
    
</template>
<script>
import store from 'store'
import router from 'vue-router'

export default {
    name:'logout',

    mounted(){
        localStorage.removeItem('token')
        localStorage.removeItem('user')
        // store.commit(LOGOUT_USER)
        this.$router.push('/login')
    }
}
</script>
