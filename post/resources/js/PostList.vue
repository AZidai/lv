<template>
<div>
    <div v-for="post in posts" class="card gedf-card wrapper-div">
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
                            <a class="dropdown-item" href="#">Save</a>
                            <a class="dropdown-item" href="#">Hide</a>
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

export default {
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
            getAllPosts : function(){
                axios.get('api/posts')
                    .then(response=>{
                        this.posts = response.data
                    })
                },
        }
    }
</script>