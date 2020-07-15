@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>User: </h1>
        </div>

        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif
        @include('users.list',compact("users"))
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
                    <p id="user-delete-text">Modal body text goes here.</p>
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
        document.getElementById("delete-form").action = "/users/"+btn.dataset.userId;
        document.getElementById("user-delete-text").textContent = "Are you sure you want to delete "+btn.dataset.userName+" user";
    }
</script>
@endpush
