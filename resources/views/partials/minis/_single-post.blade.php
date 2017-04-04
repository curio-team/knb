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
            </div>
        </div>
    </article>
</div>