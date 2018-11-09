@extends('layoutsSeller')

@section('content')
    <form action="/productfeatures/update/{{ $pfeatureid }}" method="POST" class="form-horizontal">
        {{ csrf_field() }}
        {{  method_field('PATCH') }}
        <input type="hidden" class="form-control" value="{{ $id }}" name="product_id">
        <a href="/features/create" class="btn btn-warning">Add Feature</a><hr>
        <div class="form-group">
            <select name="feature_id">
                <option value="{{$productfeature}}">{{$featurename}}</option>
                
                   
                    @foreach($featuresall as $featureall){
                        <option value="{{$featureall->id}}">{{$featureall->feature_name}}</option>
                    @endforeach
                      
            </select>
            <input type="hidden" name="user_id" value="{{ $user }}">
        </div>
        <div class="form-control">
            <input type="text" name="name" value="{{ $pfeaturename }}">
        </div>
        <div class="form-control">
        <a href="/products/features/{{ $id }}" class="btn btn-primary">Back</a>
            <button type="submit" class="btn btn-primary">Edit Feature</button>
           
        </div>
    
    </form>

@endsection