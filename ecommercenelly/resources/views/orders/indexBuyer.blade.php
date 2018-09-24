@extends('layoutsBuyer')

@section('content')
<a href="/productsbuyer" class="btn btn-warning">Back</a>

<input type="hidden" name="user_id" value="{{ Auth::user()['id'] }}">
<input type="hidden" name="order_status_id" value="2">
<div class="container">
    <table class="table table-condensed table-striped table-hover table-bordered">
        <tr>
            <th>#</th>
            <th>Product Name</th>
            <th>Product description</th>
            <th>Available No.</th>
            <th>No. of Orders</th>
            <th>Product Price @</th>
</tr>
            
                @foreach($products as $item)
                    <tr>
                        <td ><input type="text" name="id" value="{{ $item['item']->id }}" disabled></td>
                        <td><input type="text" name="product_name" value="{{ $item['item']->product_name }}" disabled></td>      
                        <td><input type="text" name="product_name" value="{{ $item['item']->product_description }}" disabled><td>
                        <td><input id="total" name="quantity" value="{{ $item['item']->Product_quantity }}" disabled></td>
                        <td><input id="total" type="number" name="quantity" value="{{ $item['quantity'] }}"></td>
                        <td><input id="price" disabled value="{{ $item['item']->product_price }}"></td>
                    </tr>
                    <input type="hidden" name="product_id" value="{{ $item['item'] }}">
                 @endforeach
    
           
    
    </table>
    </div>
    <form action="/orders" method="POST" class="form-horizontal">
        {{ csrf_field() }}
 <button type="submit" class="btn btn-outline-success my-2 my-sm-0">Place Orders</button>
  

@endsection


