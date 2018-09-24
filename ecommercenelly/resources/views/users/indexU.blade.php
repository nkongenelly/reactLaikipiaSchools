@extends('layoutsAdmin')

@section('content')
    <a href="/users/create" class="btn btn-warning">Add User</a>
    <table class="table table-condensed table-striped table-hover table-bordered">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>User Type</th>
            <th>Email</th>
            <th>Created On</th>
            <th colspan="2">Action</th>
        </tr>
        <tr>
        @if(count($users))
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->usertype->user_type }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at->toFormattedDateString() }}</td>
                <td>
                    <a href="/users/edit/{{ $user->id }}" class="btn btn-warning">Edit</a>
                </td>
                <td>
                    <a href="/users/delete/{{ $user->id }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                </td>
            </tr>

            @endforeach
        @endif
    
    </table>

@endsection

