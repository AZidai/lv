<template>
    <div>
        <center><h2>Post your comments here</h2></center>

        <div v-for="comment in comments" v-bind:key="comment.id" class="card gedf-card wrapper-div">
            <div class="card-header">
                <div class="mr-2">
                    <img class="rounded-circle gray" width="45" src="https://www.w3schools.com/w3images/avatar3.png">
                </div>
                <div class="ml-2">
                    <div class="h5 m-0">@{{comment.user.name}}</div>
                </div>
            </div>
            <div>
                <div class="dropdown">
                    <button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-ellipsis-h"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">
                        <div class="h6 dropdown-header">Configuration</div>
                        <a class="dropdown-item">Show</a>
                        <a class="dropdown-item">Delete</a>
                        <a class="dropdown-item" href="#">Report</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="text-muted h7 mb-2"> <i class="fa fa-clock-o"></i>{{comment.created_at}}</div>
                <p class="card-text">
                    {{comment.body}}
                </p>
            </div>
        </div>
    </div>
</template>
<script>

import axios from 'axios'

export default {
    props:{
        post_id:String
    },
    data(){
        return{
            comments:[]
        }
    },
    mounted(){
        this.getComments()
    },
    methods:{
        getComments(){
            // console.log('cao')
            const token = localStorage.getItem('token')
            axios.get('/api/post/'+ this.post_id + '/comments' +'?token='+ token,
            {headers:{'X-Requested-With':'XMLHttpRequest', Authorization:'Bearer'}}
            ).then(response => {
                    this.comments = response.data
            })
        }
    }
}
</script>

