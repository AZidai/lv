<template>
<div class="wrapper-div">
  <h2  class="wrapper-div__padding_bottom">Log In</h2>
  <div class="form-group">
    <input type="email" class="form-control"  aria-describedby="emailHelp" placeholder="Enter email" required="required">
  </div>
  <div class="form-group">
    <input type="password" class="form-control" placeholder="Password" required="required">
  </div>
  <div class="wrapper-div__padding_bottom">
    <button type="submit" class="btn btn-primary btn-block wrapper-div__bold">Log in</button>
  </div>
  <a  href="http://localhost:8000/register">Don't have an account?</a>
</div>
</template>

<script>
export default {
    data() {
      return {
          email:"",
          password:""
      }
    },
    methods: {
      login() {
        
      }
    }
}

</script>
