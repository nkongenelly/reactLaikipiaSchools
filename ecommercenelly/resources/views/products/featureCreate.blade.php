@extends('layoutsSeller')

@section('content')
    <form action="/productfeatures/{{ $product->id }}" method="POST" class="form-horizontal">
        {{ csrf_field() }}
        <input type="hidden" class="form-control" value="{{ $product->id }}" name="product_id">
        <a href="/features/create" class="btn btn-warning">Add Feature</a>
        <div class="form-control">
            <select name="feature_id">
                <option value="0">--ChooseFeature--</option>
               
                    @foreach($features as $feature)
                        <option value="{{$feature->id}}">{{$feature->feature_name}}</option>
                    @endforeach
               
            </select>
        </div>
        <div class="form-control">
            <input type="string" class="form-control"  name="name">
        </div>
            <input type="hidden" name="user_id" value="{{ $user }}">
 
        <div class="form-control">
            <a href="/products/features/{{ $product->id }}" class="btn btn-primary">Back</a>
            <button type="submit" class="btn btn-primary">Add Product Feature</button>
           
        </div>
    
    </form>

@endsection