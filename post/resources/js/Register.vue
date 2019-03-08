<template>
    <div class="wrapper-div">
        <h2  class="wrapper-div__padding_bottom">Sign up</h2>
        <div class="form-group">
            <input type="text" v-model="user.name" class="form-control" placeholder="Name" required="required">
        </div>
        <div class="form-group">
            <input type="email" v-model="user.email" class="form-control"  aria-describedby="emailHelp" placeholder="Enter e-mail" required="required">
        </div>
        <div class="form-group">
            <input type="password" v-model="user.password" class="form-control" placeholder="Password" required="required">
        </div>
        <div class="wrapper-div__padding_bottom">
            <button 
                type="button"
                class="btn btn-primary btn-block wrapper-div__bold"
                @click="registerIt"
            >
                Sing up
            </button>
        </div>
        <a  href="/login">Have an account?</a>
    </div>
</template>

<script>
export default {
    data() {
        return {
            user: {
                name: '',
                email: '',
                password: ''
            }
        }
    },
    methods: {
        registerIt() {
            axios.post('/register', this.user)
    },
    mounted() {

    }, 
  }
}
</script>
