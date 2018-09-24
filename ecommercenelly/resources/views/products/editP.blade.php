@extends('layoutsSeller')

@section('content')
    <form action="/products/update/{{ $product['id'] }}" method="POST" class="form-horizontal">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <div class="form-control">
            <select name="category_id">
                @if($categorys !=0)
            <option value="{{$product->category->id}}">{{$product->category->category_name}}</option>
            @else
            <option value="0"></option>
               @endif
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->category_name}}</option>
                    @endforeach
               
            </select>
            <input type="hidden" name="user_id" value="{{ $user['id'] }}">
            <div class="form-group">
                <label>Product name</label>
                <input type="text" class="form-control" value="{{ $product['product_name'] }}" name="product_name">
            </div>
            <div class="form-group">
                <select name="product_status">
                    <option value="{{ $product['product_status'] }}">{{ $product['product_status'] }}</option>
                    <option value="1">In Stock</option>
                    <option value="2">Out of Stock</option>
                
                </select>
            </div>
            <div class="form-group">
                <label>Product Price</label>
                <input type="text" class="form-control" value="{{ $product->product_price }}" name="product_price">
            </div>
            <div class="form-group">
                <label>Product Description</label>
                <textarea class="form-control" name="product_description">{{ $product->product_description }}</textarea>
            </div>
            <a href="/products" class="btn btn-warning">Back</a>
            <button type="submit" class="btn btn-primary">Edit Product</button>
           
        </div>
    
    </form>

@endsection