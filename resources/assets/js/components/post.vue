<template>
    <div class="content">
        <article class="media ">
            <figure class="media-type media-left media-question">
                <img src="/img/icons/question.png" alt="">
            </figure>
            <div class="media-content">
                <div class="content  media-post">
                    <p>
                        <strong>{{post.author.name}}</strong>
                    </p>
                    <h4 class="title is-4">{{post.title}}</h4>
                    <p>{{post.content}}
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut dolores eos eum harum in ipsa odio provident tempora veniam voluptatum! Accusantium, dolore doloremque eius et libero nisi nobis possimus sed.
                    </p>
                </div>
                <h2 class="is-2">{{replies.length}} Answers</h2>
                <article v-for="(reply, index) in replies" class="media">
                    <figure v-if="index == 0" class="media-type media-accepted media-left">
                        <img src="/img/icons/accepted.png" alt="">
                    </figure>
                    <figure v-else class="media-type media-answer media-left">
                        <img src="/img/icons/answer.png" alt="">
                    </figure>
                    <div class="media-content">
                        <div class="content media-post">
                            <p>
                                <strong>{{reply.author.name}}</strong>
                            </p>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci aliquam asperiores at corporis distinctio eaque eum eveniet, inventore ipsam iusto molestiae nobis porro praesentium quia tempore temporibus vero voluptatibus voluptatum.
                                {{reply.author.content}}
                            </p>

                            <h3 class="is-3">2 comments</h3>

                            <article class="media">
                                <div class="content media-post-comment">
                                    <strong>{{reply.author.name}}:  </strong>

                                    <p>Vivamus quis semper metus, non tincidunt dolor. Vivamus in mi eu lorem cursus ullamcorper sit amet nec massa.
                                    </p>
                                </div>
                            </article>

                            <article class="media">
                                <div class="content media-post-comment">
                                    <strong>{{reply.author.name}}</strong>
                                    <p>
                                        Morbi vitae diam et purus tincidunt porttitor vel vitae augue. Praesent malesuada metus sed pharetra euismod. Cras tellus odio, tincidunt iaculis diam non, porta aliquet tortor.
                                    </p>
                                </div>
                            </article>

                        </div>


                    </div>
                </article>


            </div>
        </article>
        <article class="media">
            <figure class="media-left">
                <p class="image is-64x64">
                    <img src="http://bulma.io/images/placeholders/128x128.png">
                </p>
            </figure>
            <div class="media-content">
                <div class="field">
                    <p class="control">
                        <textarea class="textarea" placeholder="Add a comment..."></textarea>
                    </p>
                </div>
                <div class="field">
                    <p class="control">
                        <button class="button">Post comment</button>
                    </p>
                </div>
            </div>
        </article>
    </div>
</template>

<script>
    export default {

        props: ['post_id'],
        data: function() {
            return {
                'post' : {},
                'replies' : [],
            }
        },

        created: function() {
            var that = this;
            axios.get('api/post/' + this.post_id)
                    .then(function(response){
                        that.post = response.data.op;
                        that.replies = response.data.replies;
                    });
        }

    }
</script>