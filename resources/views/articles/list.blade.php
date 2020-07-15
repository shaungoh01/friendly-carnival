@foreach($articles as $article)

<div class="shadow p-3 mb-5 bg-white col-12 ">
    <h2>{{$article->title}}</h2>
    <p>{!!nl2br($article->body)!!}</p>
    <a href="/articles/{{$article->id}}" class="btn btn-primary btn-sm float-right">View More</a>
</div>
@endforeach
{!!$articles->links()!!}
