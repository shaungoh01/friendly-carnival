@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header">
                    <h3>{{$user->name}}</h3>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                </div>
            </div>
            <h4 class="mt-4">User Comments : </h4>
            @foreach($user->comments as $comment)
            <div class="shadow p-3 mb-5 bg-white ">
                <h5>In article [<a href="/articles/{{$comment->article_id}}">{{$comment->article->title}}</a>] </h5>
                <p>{!!nl2br($comment->comment)!!}</p>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
