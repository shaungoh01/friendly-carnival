@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header">
                    <h3>{{$article->title}}</h3>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h4>Article: </h4>
                    {!!nl2br($article->body)!!}
                    <hr>
                    <div class="row">
                        <div class="col-6">
                            <h4>Author: {{$article->creator->name}}</h4>
                        </div>
                        <div class="col-6">
                            @if(Auth::check() && !$article->users->contains(Auth::id()))
                            <form action="/articles/{{$article->id}}/request_collab" method="POST">
                                @csrf
                                <button class="btn btn-primary float-right">
                                    Request for Collaboration
                                </button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <h4 class="mt-4">Comments : </h4>
            @foreach($article->comments as $comment)
            <div class="shadow p-3 mb-5 bg-white ">
                <h5>{{$comment->user->name}} : </h5>
                <p>{!!nl2br($comment->comment)!!}</p>
            </div>
            @endforeach

            <h5>Post Your Comment: </h5>
            @if(Auth::check())
            <form action="/comments" method="POST">
                @csrf
                <label for="title">Comment</label>
                <input type="hidden" name="article_id" value="{{$article->id}}">
                <textarea class="form-control" id="textArea" rows="3" name="comment"></textarea>
                @error('comment')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <button class="btn btn-primary flaot-right">Submit</button>
            </form>
            @else
            <div>
                <h1>Login to comment</h1>
                <a href="/login" class="btn btn-primary">Login</a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
