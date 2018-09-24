@extends('layoutsBuyer')

@section('content')
<a href="/productsbuyer" class="btn btn-warning">Back</a>
    <table class="table table-condensed table-striped table-hover table-bordered">
        <tr>
            <th>Order No.</th>
            <th>Product Name</th>
            <th>Product quantity</th>
            <th>Product Price</th>
        </tr>
        @if(array($orders))
            @foreach($orders as $order)
               
                    <tr>
                       
                                                    
                            <td>{{ $order->id }}</td>
                            <td>{{ $order['product_name'] }}</td>
                                
                            <td>{{ $order['quantity'] }}</td>
                            <td>{{ $order['price'] }}</td>
                            
                      
                    </tr>
                    
               
            @endforeach
        @endif
           
    
    </table>
    

@endsection

