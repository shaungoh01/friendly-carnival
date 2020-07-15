@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-6">
            <h1>Articles</h1>
        </div>
        <div class="col-6">
            <div class="float-right">
                <a href="/articles/create" class="btn btn-primary">Create Article</a>
            </div>
        </div>

        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif
        <table class="table bg-white  table-striped">
            <thead class="thead-dark">
                <tr>
                    <th style="width:15%;">Id</th>
                    <th style="width:50%;">Title</th>
                    <th style="width:35%;">Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($articles as $article)
            <tr>
                <td>{{$article->id}}</td>
                <td>{{$article->title}}</td>
                <td>
                    <a href="/articles/{{$article->id}}" class="btn btn-primary btn-sm">Show</a>
                    @can('update',$article)
                    <a href="/articles/{{$article->id}}/edit" class="btn btn-primary btn-sm">Edit</a>
                    @endcan
                    @can('delete',$article)
                    <button  class="btn btn-danger btn-sm" onclick="deleteModal(this)" data-toggle="modal" data-article-id="{{$article->id}}" data-article-title="{{$article->title}}" data-target="#delete-modal">Delete</button>
                    @endcan
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        {!!$articles->links()!!}
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="delete-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="delete-form" action="" method="POST">
                @csrf
                @method("DELETE")
                <div class="modal-header">
                    <h5 class="modal-title">Are you sure to delete?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="article-delete-text">Modal body text goes here.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('js')

<script>
    function deleteModal(btn){
        document.getElementById("delete-form").action = "/articles/"+btn.dataset.articleId;
        document.getElementById("article-delete-text").textContent = "Are you sure you want to delete "+btn.dataset.articleTitle+"article";
    }
</script>
@endpush
