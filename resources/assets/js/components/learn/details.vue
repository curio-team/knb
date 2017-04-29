<template>
    <div class="root-element section">
       <div class="container content">
           <div class="box" v-for="video in videos.data" v-if="getTag(video.tags)">
                   <article class="media">
                       <div class="media-left">
                           <figure class="image is-64x64">
                               <img v-bind:src="video.pictures.sizes[2].link" alt="">
                           </figure>
                       </div>
                       <div class="media-content">
                           <div class="content">
                               <p><small><b>duur: {{Math.floor(video.duration / 60)}} mins.</b></small></p>
                               <h3  class="is-3"><a target="_blank" v-bind:href="video.link">{{video.name}}</a></h3>
                               <p>{{video.description}}</p>
                           </div>


                       <nav class="level is-mobile">
                            <div class="level-left">
                                <a href="" class="level-item">
                                    <span class="icon-is-small"><a target="_blank" v-bind:href="video.link"><i class="fa fa-play"></i></a></span>
                                </a>
                            </div>
                       </nav>
                       </div>
                   </article>
               </div>


       </div>

    </div>
</template>

<script>
    export default {

        data : function() {
            return {
                videos: [],
            }
        },

        props: ['tag'],

        mounted() {
            axios.get('https://api.vimeo.com/channels/amo/videos?sort=manual&access_token=e433335e8d25a8c33089024e2bc30d4d').then(response => this.videos = response.data);
        },

        methods: {

            getTag: function(tags)
            {
                for(var i = 0 ; i < tags.length; i++){
                    if(tags[i].hasOwnProperty("name") && tags[i].name === this.tag) {
                        return true;
                    }
                }
                return false;
            }

        }
    }


</script>