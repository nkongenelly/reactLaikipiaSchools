@extends('layoutsSeller')

@section('content')
    <form action="/features/update/{{ $feature->id }}" method="POST" class="form-horizontal">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <div class="form-control">
           
            <input type="hidden" name="user_id" value="{{ $user['id'] }}">
            <div class="form-group">
                <label>Feature name</label>
                <input type="text" class="form-control" value="{{ $feature->feature_name }}" name="feature_name">
            </div>
            
            <button type="submit" class="btn btn-primary">Edit Feature</button>
           
        </div>
    
    </form>

@endsection