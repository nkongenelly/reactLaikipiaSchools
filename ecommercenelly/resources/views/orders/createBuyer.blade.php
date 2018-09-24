@extends('layoutsBuyer')

@section('content')
    <form action="/orders" method="POST" class="form-horizontal">
        {{ csrf_field() }}
        <div class="form-control">
            <input type="hidden" name="user_id" value="{{ Auth::user()['id'] }}">
            <input type="hidden" name="order_status_id" value="{{ $orderstatus->id=2 }}">
            <input type="hidden" name="product_id" value="{{ $id }}">
            <div class="form-group">
                <label>Product</label>
                <input type="text" class="form-control" value="{{ $product->product_name }}" name="quantity" disabled>
            </div>
            <div class="form-group">
                <label>Price</label>
                <input type="number" class="form-control" value="{{ $product->product_price }}" name="price" disabled>
            </div>
            <div class="form-group">       
            <div class="form-group">
                <label>Available Quantity</label>
                <input type="number" class="form-control" value="{{ $product->Product_quantity }}" name="Product_quantity" disabled>
            </div>
                 <label>Quantity</label>
                <input type="number" class="form-control" name="quantity">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Place Order</button>  
            </div>         
        </div>
    
    </form>
    @if(!empty($successMsg))
        <div class="alert alert-success"> {{ $successMsg }}</div>
    @endif

@endsection