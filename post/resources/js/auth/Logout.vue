<template>
    
</template>
<script>
import store from 'store'

export default {
    name:'logout',

    mounted(){
        localStorage.removeItem('token')
        localStorage.removeItem('user')
        store.commit(LOGOUT_USER)
        router.push('/login')
    }
}
</script>
