<template>
    <div class="content">
        <article class="media">
            <figure class="media-left">
                <div class="post-type post-type-question">
                    question
                </div>
            </figure>
            <div class="media-content">
                <div class="content">
                    <p>
                        <strong>{{post.author.name}}</strong>
                    </p>
                    <h4 class="title is-4">{{post.title}}</h4>
                    <p>{{post.content}}</p>
                </div>

                <article class="media">
                    <figure class="media-left">
                        <div class="post-type post-type-answer">
                            answer
                        </div>
                    </figure>
                    <div class="media-content">
                        <div class="content">
                            <p>
                                <strong>Sean Brown</strong>
                                <br>
                                Donec sollicitudin urna eget eros malesuada sagittis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aliquam blandit nisl a nulla sagittis, a lobortis leo feugiat.
                                <br>
                                <small><a>Like</a> · <a>Reply</a> · 2 hrs</small>
                            </p>
                        </div>

                        <article class="media">
                            Vivamus quis semper metus, non tincidunt dolor. Vivamus in mi eu lorem cursus ullamcorper sit amet nec massa.
                        </article>

                        <article class="media">
                            Morbi vitae diam et purus tincidunt porttitor vel vitae augue. Praesent malesuada metus sed pharetra euismod. Cras tellus odio, tincidunt iaculis diam non, porta aliquet tortor.
                        </article>
                    </div>
                </article>

                <article class="media">
                    <figure class="media-left">
                        <p class="image is-48x48">
                            <img src="http://bulma.io/images/placeholders/96x96.png">
                        </p>
                    </figure>
                    <div class="media-content">
                        <div class="content">
                            <p>
                                <strong>Kayli Eunice </strong>
                                <br>
                                Sed convallis scelerisque mauris, non pulvinar nunc mattis vel. Maecenas varius felis sit amet magna vestibulum euismod malesuada cursus libero. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Phasellus lacinia non nisl id feugiat.
                                <br>
                                <small><a>Like</a> · <a>Reply</a> · 2 hrs</small>
                            </p>
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