<template>
  <div class="content">
    <h1> Forum </h1>
    <div class="posts" >
        <div class="box" v-for="post in list">
          <article class="media" >

            <figure class="media-left">
              <p class="image is-64x64">
                <img src="http://bulma.io/images/placeholders/128x128.png">
              </p>
            </figure>
              <div class="media-content">
                  <div class="content">
                      <p>
                          <strong>{{post.author.name}}</strong>
                          <br>
                            {{post.title}}

                      </p>
                      <div class="post-meta">
                          <span class="views-amount">
                            4
                          </span>
                          views
                      </div>
                  </div>
              </div>

          </article>
        </div>
    </div>
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


