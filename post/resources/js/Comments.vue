<template>
    <div>
        <center>
            <h2>Post your comments here</h2>
        </center>
        <div>
            <CreateComment :post-id = postId></CreateComment>
        </div>
        <div v-for="comment in comments" v-bind:key="comment.id" class="card gedf-card wrapper-div">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="d-flex justify-content-between float-left">
                    <div class="mr-2">
                        <img class="rounded-circle gray" width="45" src="https://www.w3schools.com/w3images/avatar3.png">
                    </div>
                    <div class="ml-2">
                        <div class="h5 m-0">@{{comment.user.name}}</div>
                    </div>
                </div>
                <div class="float-right">
                    <a class="dropdown-item"><i class="fa fa-pencil" @click="toggleEdit(comment.id)"></i></a>
                    <a class="dropdown-item" @click="deleteComment(comment.id)"><i class="fa fa-times"></i></a>
                </div>
            </div>
            <div class="card-body">
                <div class="text-muted h7 mb-2"> <i class="fa fa-clock-o"></i>{{comment.created_at}}</div>
                <p class="card-text" v-if="isEdit != comment.id">
                    {{comment.body}}
                </p>
                <textarea v-if="isEdit == comment.id" v-model="body" class="form-control" id="message" rows="3" placeholder="Edit your comment here.."></textarea>
            </div>
            <div class="card-footer float-left" v-if="isEdit==comment.id">
                <button class="btn btn-primary" @click="editComment(comment.id)">Update</button>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios'
import CreateComment from './CreateComment'

export default {
    components:{
        CreateComment
    },
    props:{
        postId: Number
    },
    data(){
        return{
            isEdit:null,
            body:"",
            comments:[]
        }
    },
    mounted(){
        this.getComments()
    },
    methods:{
        getComments(){
            console.log(this.postId)
            const token = localStorage.getItem('token')
            axios.get('/api/post/'+ this.postId + '/comments' +'?token='+ token,
            {headers:{'X-Requested-With':'XMLHttpRequest', Authorization:'Bearer'}}
            ).then(response => {
                    this.comments = response.data
            })
        },
        getCommentfromList(id){
            const comment = this.comments.find( item => {
                return item.id === id
            })
            return comment
        },
        editComment(id) {
            const comment = this.getCommentfromList(id)
            const token = localStorage.getItem('token')
            axios.put('/api/comment/'+ id + '?token=' + token,{body:this.body},
            {headers:{'X-Requested-With':'XMLHttpRequest', Authorization:'Bearer'}})
            .then(() => {
                this.isEdit = null
                comment.body = this.body
            })
        },
        toggleEdit(id) {
            const comment = this.getCommentfromList(id)
            this.isEdit = this.isEdit == id ? null : id
            this.body = comment.body
        },
        deleteComment(id) {
            const token = localStorage.getItem('token')
            if(confirm('Are you sure')){
                axios.delete('/api/comment/'+ id +'?token='+ token ,
                {headers:{'X-Requested-With':'XMLHttpRequest', Authorization:'Bearer'}})
                    .then(data => {
                        this.comments.splice(this.comments.findIndex( item => {
                            return item.id === id
                        }), 1);
                    })
                    .catch(err => console.log(err))
            }
        }
    }
}
</script>

