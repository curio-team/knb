    <div class="content">
        <article class="media ">
            <figure class="media-type media-left media-question">
                <img src="{{asset('img/icons/question.png')}}" alt="">
            </figure>
            <div class="media-content">
                <div class="content  media-post">
                    <p>
                        <strong>{{$post->author->name}}</strong>
                    </p>
                    <h4 class="title is-4">{{$post->title}}</h4>
                    <p>{{$post->content}}
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut dolores eos eum harum in ipsa odio provident tempora veniam voluptatum! Accusantium, dolore doloremque eius et libero nisi nobis possimus sed.
                    </p>
                    <a href="" class="button is-info">Give answer</a>
                    <a href="" class="button is-primary">Add comment</a>
                    
                </div>
                <h2 class="is-2">{{count($replies)}} Answers</h2>
                @foreach($replies as $reply)
                <article class="media">
                    @if ($loop->first)
                    <figure class="media-type media-accepted media-left">
                        <img src="{{asset('img/icons/accepted.png')}}" alt="">
                    </figure>
                    @else
                    <figure class="media-type media-answer media-left">
                        <img src="{{asset('img/icons/answer.png')}}" alt="">
                    </figure>
                    @endif
                    <div class="media-content">
                        <div class="content media-post">
                            <p>
                                <strong>{{$reply->author->name}}</strong>
                            </p>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci aliquam asperiores at corporis distinctio eaque eum eveniet, inventore ipsam iusto molestiae nobis porro praesentium quia tempore temporibus vero voluptatibus voluptatum.
                                {{$reply->author->content}}
                            </p>
                            <a href="" class="button is-primary">Add comment</a>

                            <h3 class="is-3">2 comments</h3>

                            <article class="media">
                                <div class="content media-post-comment">
                                    <strong>{{$reply->author->name}}:  </strong>

                                    <p>Vivamus quis semper metus, non tincidunt dolor. Vivamus in mi eu lorem cursus ullamcorper sit amet nec massa.
                                    </p>
                                </div>
                            </article>

                            <article class="media">
                                <div class="content media-post-comment">
                                    <strong>{{$reply->author->name}}</strong>
                                    <p>
                                        Morbi vitae diam et purus tincidunt porttitor vel vitae augue. Praesent malesuada metus sed pharetra euismod. Cras tellus odio, tincidunt iaculis diam non, porta aliquet tortor.
                                    </p>
                                </div>
                            </article>

                        </div>


                    </div>
                </article>
                @endforeach

            </div>
        </article>
        @include('partials/_create-comment')
    </div>
