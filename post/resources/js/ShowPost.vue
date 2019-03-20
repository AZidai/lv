<template>
<div>
<div v-bind:key="id" class="card gedf-card wrapper-div">
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
                        <a class="dropdown-item" v-if="loggedUserId == post.user.id" @click="EditMe(post.id)">Edit</a>
                        <a class="dropdown-item" v-if="loggedUserId == post.user.id" @click="deletePost(post.id)">Delete</a>
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
import router from 'vue-router'
import axios from 'axios'

export default {
        props:{
            id: String
        },
        data(){
            return {
                post:{}
            }
        },
        mounted: function() {
            // this.test()
            console.log('123')
            this.test1()
            this.getPostWithComments()
        },
        methods:{
            test1(){
                console.log('test1')
            },
            getPostWithComments(){
                const token = localStorage.getItem('token')
                axios.get('/api/post/'+ this.id + '?token=' + token,
                {headers:{'X-Requested-With':'XMLHttpRequest', Authorization:'Bearer'}})
                    .then(response => {
                        this.post = response.data
                })
            }
        }
}
</script>
