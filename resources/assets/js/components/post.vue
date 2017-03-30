<template>
    <div class="content">
        dit is een post
    </div>
</template>

<script>
    export default {
        data: function() {
            return {

                comments: [],
                post: {
                    id: "",
                    body: ""
                }
            }
        },

        mounted: function() {
            this.fetchPosts();
        },

        methods : {
            fetchPost : function() {
                this.$http.get('api/post').then(function(res){
                    this.list = res.data;
                })
            }
        }

    }
</script>