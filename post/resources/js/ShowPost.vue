<template>
<div class="container">
    <div class="float-left"> 
        <div v-bind:key="id" class="card gedf-card wrapper-div1">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="mr-2">
                            <img class="rounded-circle gray" width="45" src="https://www.w3schools.com/w3images/avatar3.png"  alt="">
                        </div>
                        <div class="ml-2">
                            <div class="h5 m-0">@{{ userName}}</div>
                        </div>
                    </div>
                    <div>
                        <a class="dropdown-item"><i class="fa fa-pencil" @click="isEdit = !isEdit"></i></a>
                        <a class="dropdown-item" @click="deletePost()"><i class="fa fa-times"></i></a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="text-muted h7 mb-2"><i class="fa fa-clock-o"></i>{{post.created_at}}</div>
                    <a class="card-link" href="#">
                        <input v-model="title" v-if="isEdit" class="form-control mb-5" id="title" row="1" type="text" placeholder="Enter post title">
                        <h5 class="card-title" v-if="!isEdit">{{post.title}}</h5>
                    </a>
                    <textarea v-model="body" v-if="isEdit" class="form-control" id="message" rows="3" placeholder="What is your post about?"></textarea>
                    <p class="card-text" v-if="!isEdit">{{post.body}}</p>
            </div>
            <div class="card-footer">
                <button v-if="isEdit" @click="updatePost()" class="btn btn-primary float-right">Share</button>
            </div>
        </div>
        <div class="float-left">
            <Comments :post-id ="parseInt(id)"></Comments>
        </div>
    </div>
</div>
</template>
<script>
import Comments from './Comments'
import router from 'vue-router'
import axios from 'axios'

export default {
    components:{
        Comments
    },
    props:{
        id: String
    },
    data(){
        return {
            isEdit:false,
            body:"",
            title:"",
            post:{},
            userName:""
        }
    },
    mounted: function() {
        this.getPost()
        console.log('showpost',this.id)
    },
    methods:{
        getPost(){
            const token = localStorage.getItem('token')
            axios.get('/api/post/'+ this.id + '?token=' + token,
            {headers:{'X-Requested-With':'XMLHttpRequest', Authorization:'Bearer'}}
            ).then(response => {
                this.post = response.data
                this.userName = this.post.user.name
                this.body = this.post.body
                this.title = this.post.title
            })
        },
        deletePost() {
            const token = localStorage.getItem('token')
            if(confirm('Are you sure')){
                fetch('api/post/' + this.id + '?token='+ token ,
                {method:'delete'},
                {headers:{'X-Requested-With':'XMLHttpRequest', Authorization:'Bearer'}})
                .then(
                    this.$router.push('/posts')
                )

            }
        },
        updatePost() {
            const token = localStorage.getItem('token')
            axios.put('/api/post/'+ this.id + '?token=' + token,{body: this.body ,title:this.title},
            {headers:{'X-Requested-With':'XMLHttpRequest', Authorization:'Bearer'}}
            ).then(() => {
                this.isEdit = false
                this.post.title = this.title
                this.post.body = this.body
            })
        },          
    }
}
</script>
