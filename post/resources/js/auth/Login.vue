<template>
<div class="wrapper-div">
  <h2  class="wrapper-div__padding_bottom">Log In</h2>
  <div class="form-group">
    <input 
      type="email" 
      class="form-control" 
      aria-describedby="emailHelp" 
      placeholder="Enter email" 
      required="required"
      v-model="email"
      />
  </div>
  <div class="form-group">
    <input 
      type="password" 
      class="form-control" 
      placeholder="Password" 
      required="required"
      v-model ="password"
      />
  </div>
  <div class="wrapper-div__padding_bottom">
    <button 
      type="submit" 
      class="btn btn-primary btn-block wrapper-div__bold"
      v-on:click="signin"
      >Log in
    </button>
  </div>
  <a  href="http://localhost:8000/register">Don't have an account?></a>
</div>
</template>

<script>
import axios from 'axios'
import store from 'store'

export default {
  data(){
    return {
      email:"",
      password:""
    }
  },
  methods: {
    signin() {
        axios.post('http://localhost:8000/login',
        {email: this.email,password: this.password},
        {headers:{'X-Requested-With':'XMLHttpRequest'}}
        )
        .then(
          (response)=> {
            const token = response.data.token //get it from response
            const user = response.data.user
            const base64Url = token.split('.')[1] //split token to dot , take 2nd index of token , payload
            const base64 = base64Url.replace('-','+').replace('_','/') //replace
            JSON.parse(window.atob(base64)) //return token as json string
            localStorage.setItem('user', JSON.stringify(user));
            localStorage.setItem('token',token) //store raw token that we get from server
            this.$router.push('/posts')
          }
        )
        .catch(
          (error) => console.log(error)
        );
    }
  }
}
</script>
