@extends('layoutsAdmin')

@section('content')
    <a href="/categories/create" class="btn btn-warning">Add Category</a>
    <table class="table table-condensed table-striped table-hover table-bordered">
        <tr>
            <th>#</th>
            <th>Category Parent</th>
            <th>Category Name</th>
            <th>Created On</th>
            <th colspan="2">Action</th>
        </tr>
        
        @if(count($categories))
            @foreach($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->category_parent }}</td>
                <td>{{ $category->category_name }}</td>
                <td>{{ $category->created_at->diffForHumans() }}</td>
                <td>
                    <a href="/categories/edit/{{ $category->id }}" class="btn btn-warning">Edit</a>
                </td>
                <td>
                    <a href="/categories/delete/{{ $category->id }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this category?')">Delete</a>
                </td>
            </tr>
            @endforeach
        @endif       
       
    
    </table>

@endsection

