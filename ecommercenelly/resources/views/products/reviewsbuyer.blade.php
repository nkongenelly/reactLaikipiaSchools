@extends('layoutsBuyer')

@section('content')
    <form action="/reviewsbuyerstore" method="POST">
    @csrf
        <div class="form-control">
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <div class="form-group">
                <label>Product name</label>
                <input type="text" class="form-control" value="{{ $product->product_name }}" name="product_name">
            </div>
            <div class="form-group">
                <label>Review</label>
                <textarea class="form-control" placeholder="Type the product price" name="review"></textarea>
            </div
            <div class="form-group">
            <button type="submit" class="btn btn-primary">Add Review</button>
            </div>
           
        </div>
    
    </form>

@endsection