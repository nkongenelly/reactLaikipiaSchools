@extends('layoutsSeller')

@section('content')
    <table class="table table-condensed table-striped table-hover table-bordered">
        <tr>
            <th>Order No.</th>
            <th>Quantity</th>
            <th>Product Price</th>
            <th>Action</th>
        </tr>
        @if(array($orders))
            @foreach($orders as $order)
                    <tr>                        
                            <td>{{ $order->order_id }}</td>
                            <td>{{ $order->quantity}}</td>
                            <td>{{ $order->price }}</td>
                            <td>
                                <a href="/orderscomplete/{{ $order->user_id }}/{{ $order->order_id }}/{{ $order->product_id }} " class="btn btn-outline-success my-2 my-sm-0">Complete Orders</a>
                            </td>
                        
                    </tr>
                    
            
            @endforeach
        @endif
           
    
    </table>
    

@endsection

