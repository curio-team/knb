<template>
    <div class="root-element section">
       <div class="container content">
           <a style="display:inline-block; margin-bottom: 10px" href="/learn" class="button is-primary"><i class="fa fa-arrow-left"></i> &nbsp; back</a>

      <!--     <div style="cursor:pointer" class="box" v-on:click="startMovie(video)" v-for="video in videos.data" v-if="getTag(video.tags)"> -->
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
                               <h3  class="is-3">{{video.name}}</h3>
                               <p>{{video.description}}</p>
                           </div>


                       <nav class="level is-mobile">
                            <div class="level-left">
                                <a href="" class="level-item">
                                    <a style="display:inline-block; margin-bottom: 10px" target="_blank" v-bind:href="video.link" class="button is-primary"><i class="fa fa-play"></i> Play</a>
                                </a>
                                <div class="level-item" v-if="getLearnData(video).quiz !== false">
                                    <span style="display:inline-block; margin-bottom: 10px;" v-on:click="showQuiz(video)" class="button is-secondary"><i class="fa fa-list-ol"></i> Quiz</span>
                                </div>
                                <div href="" class="level-item" v-if="getLearnData(video).practice !== false">
                                    <span style="display:inline-block; margin-bottom: 10px;" v-on:click="showPractice(video)" class="button is-secondary"><i class="fa fa-graduation-cap"></i> Practice</span>
                                </div>
                            </div>
                       </nav>
                       </div>
                   </article>
               </div>
       </div>
        <div v-if="modalEnabled" class="modal" v-bind:class="{'is-active' : modalEnabled}">
            <div class="modal-background"></div>
                <div class="modal-content" style="width: 80%" v-if="isQuiz">
                    <h3 class="is-3" style="color: white">{{ selectedQuiz.title }}</h3>

                    <div class="box">

                        <div v-for="question in selectedQuiz.questions">
                            <h2 v-html="question.question"></h2>
								<pre v-if="question.code != null" v-html="question.code" class="language-markup"></pre>
                            <ul>
                                <li v-for="answer in question.answers"><button v-html="answer.answer" v-on:click="answer.is_correct ? showCorrect() : showIncorrect()"></button></li>
                            </ul>
							<hr>
                        </div>
                    </div>
                </div>
                <div class="modal-content" style="width: 80%" v-else-if="isPractice">
                    <h3 class="is-3" style="color: white">{{ selectedPractice.title }}</h3>

                    <div class="box">
                        <div v-for="assignment in selectedPractice.assignments" class="content" >
                            <h2 v-html="assignment.assignment"></h2>
                            <span v-html="assignment.description"></span>
							<pre v-if="assignment.code != null" v-html="assignment	.code" class="language-markup"></pre>
                        </div>
                        <hr>
                    </div>
                </div>
                <div class="modal-content" style="width: 80%" v-else>
                    <h3 class="is-3" style="color: white">{{ selectedVideo.name }}</h3>

                    <div  v-html="selectedVideo.embed.html"></div>

                </div>
            <button class="modal-close" v-on:click="closeModal()"></button>
        </div>
    </div>
</template>


<script>
    export default {

        data : function() {
            return {
                videos: [],
                categories: [],
                modalEnabled: false,
                isQuiz: false,
                isPractice: false,
                selectedVideo : {},

                selectedQuiz : {},

                selectedPractice : {}

            }
        },

        props: ['tag'],

        mounted() {
            axios.get('https://api.vimeo.com/channels/amo/videos?sort=manual&access_token=e433335e8d25a8c33089024e2bc30d4d').then(response => this.videos = response.data);
            axios.get('json/series_data.json').then(response => this.categories = response.data);
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
            },

            closeModal: function()
            {
                this.modalEnabled = false;
                this.selectedVideo = undefined;
                this.isPractice = true;
                this.isQuiz = undefined;
            },

            isModalEnabled: function()
            {
                return this.modalEnabled ? true : false
            },

            startMovie: function(video)
            {
                this.modalEnabled = true;
                this.selectedVideo = video;
            },

            getLearnData: function(video)
            {
                for(var c = 0 ; c < this.categories.length; c++){
                    for(var i = 0 ; i < this.categories[c].series.length; i++){
                        if(this.categories[c].series[i].hasOwnProperty("videos") && this.categories[c].series[i].tag === this.tag) {
                            for(var videoId in this.categories[c].series[i].videos){
                                if(video.uri == videoId){
                                    return this.categories[c].series[i].videos[videoId];
                                }
                            }
                        }
                    }
                }

                return {
                    quiz: false,
                    practice: false
                };
            },

            showQuiz: function(video)
            {
                this.modalEnabled = true;

                this.selectedQuiz = this.getLearnData(video).quiz;

                this.isQuiz = true;
            },

            showPractice: function(video)
            {
                this.modalEnabled = true;

                this.selectedPractice = this.getLearnData(video).practice;

                this.isPractice = true;
            },

            showCorrect: function()
            {
                alert('This is the right answer!');
            },

            showIncorrect: function()
            {
                alert('Wrong answer!');
            },
        }
    }


</script>