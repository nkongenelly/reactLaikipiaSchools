@extends('layoutsSeller')

@section('content')
    <a href="/featuress/create" class="btn btn-warning">Add Feature</a>
    <a href="/products/{{ Auth::user()->id }}" class="btn btn-warning">Add Product Feature</a>
    <table class="table table-condensed table-striped table-hover table-bordered">
        <tr>
            <th>#</th>
            <th>Feature Name</th>
            <th>Created On</th>
            <th colspan="2">Action</th>
        </tr>
        
        @if(count($features))
            @foreach($features as $feature)
            <tr>
                <td>{{ $feature->id }}</td>
                <td>{{ $feature->feature_name }}</td>
                <td>{{ $feature->created_at->toFormattedDateString() }}</td>
                <td>
                    <a href="/features/edit/{{ $feature->id }}" class="btn btn-warning">Edit</a>
                </td>
                <td>
                    <a href="/features/delete/{{ $feature->id }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this feature?')">Delete</a>
                </td>
            </tr>
            @endforeach
        @endif       
       
    
    </table>

@endsection

