<template>
<div class="wrapper-div">
  <h2  class="wrapper-div__padding_bottom">Sign up</h2>
    <div class="form-group">
      <input 
        type="text" 
        class="form-control" 
        placeholder="Name" 
        required="required"
        v-model ="name">
    </div>
    <div class="form-group">
      <input 
        type="email" 
        class="form-control"  
        aria-describedby="emailHelp" 
        placeholder="Enter e-mail" 
        required="required"
        v-model ="email">
    </div>
    <div class="form-group">
      <input 
        type="password" 
        class="form-control" 
        placeholder="Password" 
        required="required"
        v-model ="password">
    </div>
    <div class="wrapper-div__padding_bottom">
      <button 
        type="submit" 
        class="btn btn-primary btn-block wrapper-div__bold"
        @click="signup"
        >Sing up
      </button>
    </div>
    <a  href="http://localhost:8000/login">Have an account?</a>
</div>
</template>

<script>
import axios from 'axios'

export default {
    data() {
      return {
          name: "",
          email:"",
          password:""
      }
    },
    methods:{
      signup(){
        axios.post('http://localhost:8000/register',
        {name: this.name ,email: this.email,password: this.password,},
        {headers:{'X-Requested-With':'XMLHttpRequest'}})
        .then(
          (response)=>console.log(response)
        )
        .catch(
          (error) => console.log(error)
        );
    },
    mounted(){

    }, 
  }
}

</script>
