<template>
    
</template>
<script>
import store from 'store'

export default {
    name:'logout',

    mounted(){
        localStorage.removeItem('token')
        store.commit(LOGOUT)
        router.push('/login')
    }
}
</script>
