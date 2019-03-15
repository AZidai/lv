<template>
<div class="wrapper-div">
  <h2  class="wrapper-div__padding_bottom">Sign up</h2>
    <div class="form-group">
      <input type="text" class="form-control" placeholder="Name" required="required">
    </div>
    <div class="form-group">
      <input type="email" class="form-control"  aria-describedby="emailHelp" placeholder="Enter e-mail" required="required">
    </div>
    <div class="form-group">
      <input type="password" class="form-control" placeholder="Password" required="required">
    </div>
    <div class="wrapper-div__padding_bottom">
      <button type="submit" class="btn btn-primary btn-block wrapper-div__bold">Sing up</button>
    </div>
    <a  href="http://localhost:8000/login">Have an account?</a>
</div>
</template>

<script>
export default {
    data() {
      return {
          user:{
            email:"",
            password:""
          }
      }
    },
    methods:{
        registerIt(){
          axios.post('http://localhost:8000/register',this.user)
    },
    mounted(){

    }, 
  }
}

</script>
