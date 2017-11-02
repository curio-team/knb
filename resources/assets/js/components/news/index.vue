<template>

    <div class="content root-element section">
        <h1>Add news post</h1>
        <p :if="message" class="alert-success">{{message}}</p>
        <form>
            <div class="field">
                <label for="" class="label">Title</label>
                <div class="control">
                    <input type="text" v-model="news.title" class="input" placeholder="">
                </div>
            </div>

            <div class="field">
                <label for="" class="label">Content</label>
                <div class="control">
                    <textarea v-model="news.content" class="textarea" cols="50" rows="40"></textarea>
                </div>
            </div>

            <button @click="save()" class="button is-success">Create Post</button>
        </form>

    </div>
</template>

<script>
    export default {

        data :  function(){
            return {
                news :{},

            }

        },



        mounted : function()
        {

        },

        methods: {
                save() {
                    var that = this;
                    axios.post('../news', {
                        title: that.news.title,
                        content: that.news.content,
                        sticky: 0
                    }).then(function(res){

                    });
                }

        }
    }


</script>


