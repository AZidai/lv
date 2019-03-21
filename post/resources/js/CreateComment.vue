<template>
    <div>
        <div class="card gedf-card wrapper-div">
            <div class="card-body">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="posts" role="tabpanel" aria-labelledby="posts-tab">
                        <div class="form-group">
                            <label class="sr-only" for="message">post</label>
                            <textarea v-model="body" class="form-control" id="message" rows="3" placeholder="Post your comment here.."></textarea>
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
                <div>
                    <button v-on:click="postComment" type="submit" class="btn btn-primary float-right">Share</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios'
import router from 'vue-router'


export default {
    props: {
        postId: Number
    },
    data() {
        return {
            body:""
        }
    },
    methods: {
        postComment() {
            const comment = {
                body: this.body,
                user_id: this.getUserId(),
                post_id: this.postId
            }
            const token  = localStorage.getItem('token')
            axios.post('/api/comment?token=' + token, comment,
            {headers:{'X-Requested-With':'XMLHttpRequest', Authorization:'Bearer'}}
                ).then( response =>{
                    this.comments = response.comment
                    this.body = ""
                })
                .catch(
                    (error) => console.log(error)
                )           
        },
        getUserId() {
            let user = JSON.parse(localStorage.getItem('user'))
            return user.id
        }
    }
}
</script>
