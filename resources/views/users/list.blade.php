<table class="table bg-white  table-striped">
    <thead class="thead-dark">
        <tr>
            <th style="width:15%;">Id</th>
            <th style="width:50%;">Title</th>
            <th style="width:35%;">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
    <tr>
        <td>{{$user->id}}</td>
        <td>{{$user->name}}</td>
        <td>
            <a href="/users/{{$user->id}}" class="btn btn-primary btn-sm">Show</a>
            @can('update',$user)
            <a href="/users/{{$user->id}}/edit" class="btn btn-primary btn-sm">Edit</a>
            @endcan
            @can('delete',$user)
            <button  class="btn btn-danger btn-sm" onclick="deleteModal(this)" data-toggle="modal" data-user-id="{{$user->id}}" data-user-name="{{$user->name}}" data-target="#delete-modal">Delete</button>
            @endcan
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
{!!$users->links()!!}
