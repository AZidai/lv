<template>
<div>
    <div class="card gedf-card wrapper-div">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="posts-tab" data-toggle="tab" href="#posts" role="tab" aria-controls="posts" aria-selected="true">Make
                    a publication</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="images-tab" data-toggle="tab" role="tab" aria-controls="images" aria-selected="false" href="#images">Images</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="posts" role="tabpanel" aria-labelledby="posts-tab">
                    <div class="form-group">
                        <label class="sr-only" for="message">post</label>
                        <input v-model="title" class="form-control mb-5" id="title" row="1" type="text" placeholder="Enter post title">
                        <textarea v-model="body" class="form-control" id="message" rows="3" placeholder="What is your post about?"></textarea>
                    </div>
                </div>
                <div class="tab-pane fade" id="images" role="tabpanel" aria-labelledby="images-tab">
                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile">
                            <label class="custom-file-label" for="customFile">Upload image</label>
                        </div>
                    </div>
                    <div class="py-4"></div>
                </div>
            </div>
            <div class="btn-toolbar justify-content-between">
                <div class="btn-group">
                    <button v-on:click="addPost" type="submit" class="btn btn-primary">Share</button>
                </div>
                <div class="btn-group">
                    <button id="btnGroupDrop1" type="button" class="btn btn-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-globe"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnGroupDrop1">
                        <a class="dropdown-item" href="#"><i class="fa fa-globe"></i> Public</a>                                <a class="dropdown-item" href="#"><i class="fa fa-users"></i> Friends</a>
                        <a class="dropdown-item" href="#"><i class="fa fa-user"></i> Just me</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>
<script>
import axios from 'axios'


export default {
    data() {
        return {
            title:"",
            body:""
        }
    },

    methods:{
        addPost() {
            const token = localStorage.getItem('token')
            const post = {
                title: this.title,
                body: this.body,
                user_id:"2"
            }

            axios.post('api/post?token='+ token ,post,
            {headers:{'X-Requested-With':'XMLHttpRequest'}})
            .then(response =>
            {
                this.posts = response.post
                this.$root.$emit('PostAdded')
            })
        }
    },
    computed:{
        
    },
}
</script>

