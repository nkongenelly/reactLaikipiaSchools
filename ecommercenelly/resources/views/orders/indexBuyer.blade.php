@extends('layoutsBuyer')

@section('content')
<a href="/productsbuyer" class="btn btn-warning">Back</a>

<input type="hidden" name="user_id" value="{{ Auth::user()['id'] }}">
<input type="hidden" name="order_status_id" value="2">
<div class="container">
@if(Session::has('cart'))
        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">

                <ul class="list-group">
                    @foreach($products as $item)
                            <li class="list-group-item">
                                Available Quantities:<span class="badge">{{ $item['item']->Product_quantity }}</span><br>
                                Product:<strong>{{ $item['item']->product_name }}</strong><br>
                                Order Quantities:<span class="badge">{{ $item['quantity'] }}</span><br>
                                Price:<span class="label label-success">{{ $item['item']->product_price }}</span>
                            </li>
                    @endforeach
                </ul>
           </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                <strong>Total: {{ $totalPrice }}</strong>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                <form action="/orders" method="POST" class="form-horizontal">
                {{ csrf_field() }}
                <button type="submit" class="btn btn-outline-success my-2 my-sm-0">Place Orders</button>
            </div>
        </div>
        @else
            <div class="row">
                <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                    <h2>No Items in Cart!</h2>
                </div>
            </div>
        @endif


          
      

  

@endsection


