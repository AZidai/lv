<template>
    
</template>
<script>
import {store} from 'store'
import router from 'vue-router'

export default {
    name:'logout',

    mounted(){
        localStorage.removeItem('token')
        localStorage.removeItem('user')
        this.$router.push('/login')
    }
}
</script>
