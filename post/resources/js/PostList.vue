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
                    <a class="dropdown-item" v-if="loggedUserId == post.user.id" @click="Showme(post.id)"><i class="fa fa-share-square-o"></i></a>
                    <a class="dropdown-item" v-if="loggedUserId == post.user.id" @click="deletePost(post.id)"><i class="fa fa-times"></i></a>
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
import router from 'vue-router'

import ShowPost from './ShowPost'

export default{
    data() {
        return {
            posts:[]
        }
    },
    mounted: function() {
        this.getAllPosts()
        this.$root.$on('PostAdded', ()=>{
            this.getAllPosts()
        })
    },
    computed: {
        loggedUserId() {
            let logUser = JSON.parse(localStorage.getItem('user'))
            return logUser.hasOwnProperty('id') ? logUser.id : false
            
        }
    }, 
    methods: {
        getAllPosts() {
            axios.get('api/posts')
                .then(response=>{
                    this.posts = response.data
                })
            },
        deletePost(id) {
            const token = localStorage.getItem('token')
            if(confirm('Are you sure')){
                fetch(`api/post/${id}?token=`+ token ,
                {method:'delete'},
                {headers:{'X-Requested-With':'XMLHttpRequest', Authorization:'Bearer'}})
                    // .then(res=> res.json())
                    .then(data => {
                        this.posts.splice(this.posts.findIndex( item => {
                            return item.id === id
                        }), 1);
                    })
                    .catch(err => console.log(err))
            }
        },
        Showme(id) {
            this.$router.push({path:`post/${id}`})
        }
    }
}
</script>
