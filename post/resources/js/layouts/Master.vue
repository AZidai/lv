<template>
<div id ="app">
    <ul class="nav">
        <router-link to="/"><li>Home</li></router-link>
        <router-link to="/about" ><li>About</li></router-link>
        <router-link to="/login"><li>Login</li></router-link>
        <router-link to="/register"><li>Register</li></router-link>
        <router-link to="/posts"><li>Posts</li></router-link>
    </ul>
    <div>
        <router-view></router-view>
    </div>
</div>
</template>

<script>
export default {

}
</script>