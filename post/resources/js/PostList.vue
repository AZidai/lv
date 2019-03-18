<template>
<div>
    <div v-for="post in posts" v-bind:key="post.id" class="card gedf-card wrapper-div">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="mr-2">
                        <img class="rounded-circle gray" width="45" src="https://www.w3schools.com/w3images/avatar3.png"  alt="">
                    </div>
                    <div class="ml-2">
                        <div class="h5 m-0">@{{post.user.name}}</div>
                    </div>
                </div>
                <div>
                    <div class="dropdown">
                        <button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-ellipsis-h"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">
                            <div class="h6 dropdown-header">Configuration</div>
                            <a class="dropdown-item" data-toggle="modal" data-target="#myModal"><button class="btn btn-primary" data-toggle="modal" >Edit</button></a>
                            <a class="dropdown-item" @click="deletePost(post.id)">Delete</a>
                            <a class="dropdown-item" href="#">Report</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="text-muted h7 mb-2"> <i class="fa fa-clock-o"></i>{{post.created_at}}</div>
            <a class="card-link" href="#">
                <h5 class="card-title">{{post.title}}</h5>
            </a>
            <p class="card-text">
                {{post.body}}
            </p>
        </div>
        <div class="card-footer">
            <a href="#" class="card-link"><i class="fa fa-gittip"></i> Like</a>
        </div>
    </div>
</div>
</template>

<script>
import axios from 'axios'
import store from 'store'

export default{
  data: function () {
    return {
      posts:[]
    }
  },
    mounted: function(){
        this.getAllPosts()
        this.$root.$on('PostAdded', ()=>{
            this.getAllPosts()
        })
    },
        
    methods: {
        getAllPosts(){
            axios.get('api/posts',{
                headers:{ Authorization: 'Bearer ' + localStorage.getItem('token')}})
                .then(response=>{
                    this.posts = response.data
                })
            },
        deletePost(id){
            if(confirm('Are you sure')){
                fetch(`post/${id}?token=`+token,{
                    method:'delete'
                },{headers:{'X-Requested-With':'XMLHttpRequest'}})
                    .then(res=> res.json())
                    .then(data => {
                        this.getAllPosts();
                    })
                    .catch(err => console.log(err))
            }
        },
        editPost(id){
            
        }
    }
}
</script>