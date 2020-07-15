@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Edit Article
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="/articles/{{$article->id}}" method="POST">
                        @csrf
                        @method("PATCH")
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{$article->title}}">
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="textArea">Example textarea</label>
                            <textarea class="form-control" id="textArea" rows="3" name="body">{!!$article->body!!}</textarea>

                            @error('body')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>

                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>User Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                         @foreach($article->users as $user)
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>
                            @if($user->pivot->status == "pending")
                                <form action="/articles/{{$article->id}}/approve_collab" method="POST">
                                    @csrf
                                    <input type="hidden" class="form-control" id="title" name="user_id" value="{{$user->id}}">
                                    <button type="submit" class="btn btn-success btn-sm" style="color:black;">Approve</button>
                                </form>
                            @else
                                Approved
                            @endif
                            </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
