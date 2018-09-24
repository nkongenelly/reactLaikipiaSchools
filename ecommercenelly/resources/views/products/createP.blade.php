@extends('layoutsSeller')

@section('content')
    <form action="/products" method="POST">
    @csrf
        <div class="form-control">
            <div class="form-group">
                <select name="category_id">
                    <option value="0">--No Category--</option>
                
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->category_name}}</option>
                        @endforeach
                
                </select>
            </div>
            <input type="hidden" name="user_id" value="{{ $user['id'] }}">
            <div class="form-group">
                <label>Product name</label>
                <input type="text" class="form-control" placeholder="Type the product name" name="product_name">
            </div>
            <div class="form-group">
                <select name="product_status">
                    <option value="0">--Choose Status--</option>
                    <option value="1">In Stock</option>
                    <option value="2">Out of Stock</option>
                
                </select>
            </div>
            <div class="form-group">
                <label>Product Price</label>
                <input type="text" class="form-control" placeholder="Type the product price" name="product_price">
            </div>
            <div class="form-group">
                <label>Product Description</label>
                <textarea class="form-control" placeholder="Type the product description" name="product_description"></textarea>
            </div>
            <div class="form-group">
                <label>Product Quantity</label>
                <input type="number" class="form-control" placeholder="Type the product price" name="Product_quantity">
            </div>
            <div class="form-group">
            <button type="submit" class="btn btn-primary">Add Product</button>
            </div>
           
        </div>
    
    </form>

@endsection