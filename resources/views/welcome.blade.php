@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Welcome To Sample Article App</h1>
        </div>

        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif
        @include('articles.list',compact("articles"))
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
