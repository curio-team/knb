<template>
  <div>
    <h1> Forum </h1>
    <ul class="list-group">
      <li class="list-group-item" v-for="post in list">
        {{ post.title }}
      </li>
    </ul>
  </div>
</template>

<script>
  export default {
    data: function() {
      return {
        edit: false,
        list: [],
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
      fetchPosts : function() {
        this.$http.get('api/post').then(function(res){
          this.list = res.data;
        })
      }
    }


  }


</script>


