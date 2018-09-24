@extends('layoutsSeller')

@section('content')
    <form action="/features" method="POST" class="form-horizontal">
        {{ csrf_field() }}
        
           
            <input type="hidden" name="user_id" value="{{ $user['id'] }}">
            <div class="form-group">
                <label>Feature name</label>
                <input type="text" class="form-control" placeholder="Type the feature name" name="feature_name">
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Add Feature</button>
           </div>
    
    </form>

@endsection